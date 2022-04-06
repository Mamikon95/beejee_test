<?php

namespace app\services;

use app\interfaces\ITaskService;
use app\interfaces\IUserService;

class UserService implements IUserService
{
    protected $userModel;

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }

    public function login($username, $password): bool
    {
        return true;
    }
}