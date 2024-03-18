<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegisterRequest;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\Otp;
use App\Models\User;
use App\Notifications\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class RegisterController extends Controller
{
    private AuthRepositoryInterface $authRepository;

    /**
     * LoginController constructor.
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
    public function showRegisterForm()
    {
        return view('pages.auth.register');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(StoreRegisterRequest $request)
    {
        $credentials = $request->only('full_name', 'email', 'password');

        try {
            $this->authRepository->register($credentials);

            $this->authRepository->login([
                'email' => $credentials['email'],
                'password' => $credentials['password'],
            ]);

            $this->authRepository->sendOtp($credentials['email']);


            return redirect()->route('auth.verify');
        } catch (\Exception $e) {
            Swal::error('Error', $e->getMessage());

            return redirect()->back();
        }
    }
}
