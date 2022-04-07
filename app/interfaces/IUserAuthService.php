<?php

namespace app\interfaces;

interface IUserAuthService
{
    public function login(): bool;

    public static function logout(): bool;

    public static function isGuest(): bool;
}