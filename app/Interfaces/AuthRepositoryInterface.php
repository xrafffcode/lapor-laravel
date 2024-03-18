<?php

namespace App\Interfaces;

interface AuthRepositoryInterface
{

    /**
     * @param array $credentials
     * @return mixed
     */
    public function login(array $credentials);

    /**
     * @param array $credentials
     * @return mixed
     */
    public function register(array $credentials);

    /**
     * @return mixed
     */
    public function logout();

    /**
     * @return mixed
     */
    public function getUser();

    public function sendOtp($email);
}
