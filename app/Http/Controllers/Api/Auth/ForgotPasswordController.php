<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    private AuthRepositoryInterface $authRepository;

    /**
     * ForgotPasswordController constructor.
     * @param AuthRepositoryInterface $authRepository
     */
    public function __construct(
        AuthRepositoryInterface $authRepository
    ) {
        $this->authRepository = $authRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak ditemukan'
            ], 404);
        }

        $this->authRepository->sendOtp($request->email);

        return response()->json([
            'success' => true,
            'message' => 'Kode OTP telah dikirim ke email anda'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak ditemukan'
            ], 404);
        }

        $otp = Otp::where('user_id', $user->id)->where('otp', $request->otp)->first();

        if (!$otp) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP tidak valid'
            ], 400);
        }

        $otp->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kode OTP valid'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak ditemukan'
            ], 404);
        }

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diubah'
        ]);
    }
}
