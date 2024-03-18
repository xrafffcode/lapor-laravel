<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->getId())->first();

            if ($user) {
                Auth::login($user);

                return redirect()->route('home');
            } else {

                $newUser = User::create([
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                ]);

                $newUser->assignRole('resident');

                $username = explode('@', $googleUser->getEmail())[0];

                Resident::create([
                    'user_id' => $newUser->id,
                    'full_name' => $googleUser->getName(),
                    'username' => $username,
                ]);

                Auth::login($newUser);

                return redirect()->route('home');
            }
        } catch (\Throwable $th) {
            Swal::error('Error', $th->getMessage());

            return redirect()->route('login');
        }
    }
}
