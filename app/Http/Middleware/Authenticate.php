<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Jika pengguna mengharapkan respon JSON, kembalikan null
        if ($request->expectsJson()) {
            return null;
        }

        // Tambahkan parameter redirect ke URL login jika rute sebelumnya ada
        return route('auth.login', ['redirect' => $request->fullUrl()]);
    }
}
