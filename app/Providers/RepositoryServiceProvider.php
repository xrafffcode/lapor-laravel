<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $repositories = [
            'AuthRepositoryInterface' => [
                'AuthRepository',
            ]
        ];

        foreach ($repositories as $interface => $repository) {
            $this->app->bind(
                "App\\Interfaces\\{$interface}",
                "App\\Repositories\\{$repository[0]}"
            );
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
