<?php

namespace app\services;

use app\interfaces\IUserAuthService;
use app\models\UserModel;
use core\App;
use core\Formatter\Formatter;

class UserAuthService implements IUserAuthService
{
    protected $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function login(): bool
    {
        $this->userModel->password = md5($this->userModel->password);
        $this->userModel->username = Formatter::dbEscapeString($this->userModel->username);
        $findUser = UserService::getUser($this->userModel->username, $this->userModel->password);

        if($findUser && $this->userModel->load($findUser, true)) {
            return App::$app->session->set('userId', $this->userModel->id);
        }

        return false;
    }

    public static function logout(): bool
    {
        if(App::$app->session->get('userId')) {
            return App::$app->session->remove('userId');
        }

        return false;
    }

    public static function isGuest(): bool
    {
        return !(bool)App::$app->session->get('userId');
    }
}