<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class LoginController extends Controller
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
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('pages.auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($this->authRepository->login($credentials)) {
            $user = $this->authRepository->getUser();

            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }

            if ($user->hasRole('resident')) {
                if ($request->redirect) {
                    return redirect($request->redirect);
                }

                return redirect()->route('home');
            }
        }

        return redirect()->route('auth.login.store')->withErrors([
            'email' => 'Email atau password salah'
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        $this->authRepository->logout();

        return redirect()->route('home')->with('success', 'Berhasil logout');
    }
}
