<?php

namespace App\Repositories;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\Otp;
use App\Models\Resident;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\EmailVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthRepository implements AuthRepositoryInterface
{

    /**
     * @param array $credentials
     * @return mixed
     */
    public function login(array $credentials)
    {
        return auth()->attempt($credentials);
    }

    /**
     * @param array $credentials
     * @return mixed
     */
    public function register(array $credentials)
    {
        DB::beginTransaction();

        $user = User::create([
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
        ]);

        $user->assignRole('resident');

        Resident::create([
            'user_id' => $user->id,
            'username' => explode('@', $credentials['email'])[0],
            'full_name' => $credentials['full_name'],
        ]);

        DB::commit();

        return $user;
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        return auth()->logout();
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return auth()->user();
    }

    public function sendOtp($email)
    {
        $otp = Str::random(6);
        $expired_at = now()->addMinutes(5);

        $user = User::where('email', $email)->first();

        Otp::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expired_at' => $expired_at,
        ]);

        $user = User::find($user->id);

        $user->notify(new EmailVerification($otp));

        return $user;
    }
}
