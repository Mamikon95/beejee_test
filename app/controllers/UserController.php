<?php

namespace app\controller;

use app\models\UserModel;
use app\services\UserService;
use core\controller\BaseController;

class UserController extends BaseController
{
    public function actionLogin()
    {
        $userModel = new UserModel();
        $userService = new UserService($userModel);

        echo $this->getView()->render('login', [
            'text' => 'Hello Worldss'
        ]);
    }
}