<?php

namespace app\interfaces;

interface IUserService
{
    public function login($username, $password): bool;
}