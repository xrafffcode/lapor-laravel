<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\AuthRepositoryInterface;
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showForgotPasswordForm()
    {
        return view('pages.auth.forgot-password');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forgotPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('auth.forgot-password')->withErrors([
                'email' => 'Email tidak ditemukan'
            ]);
        }

        $this->authRepository->sendOtp($request->email);
    }
}
