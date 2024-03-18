<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class VerifyController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showVerifyForm()
    {
        return view('pages.auth.verify');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        $users = User::where('email', Auth::user()->email)->first();

        $otp = Otp::where('user_id', Auth::id())->first();

        if ($otp->otp !== $request->otp) {
            return redirect()->back()->withErrors([
                'otp' => 'OTP yang anda masukkan tidak valid',
            ]);
        }

        if ($otp->expired_at < now()) {
            return redirect()->back()->withErrors([
                'otp' => 'OTP yang anda masukkan sudah kadaluarsa',
            ]);
        }

        $users->update([
            'email_verified_at' => now(),
        ]);

        $otp->delete();


        return redirect()->route('home')->with('registerSuccess', true);
    }
}
