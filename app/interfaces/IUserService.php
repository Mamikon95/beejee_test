<?php

namespace app\interfaces;

interface IUserService
{
    public static function getUser(string $username, string $password): array;
}