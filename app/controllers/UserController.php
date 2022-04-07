<?php

namespace app\controller;

use app\models\UserModel;
use app\services\UserAuthService;
use app\services\UserService;
use core\App;
use core\controller\BaseController;

class UserController extends BaseController
{
    public function actionLogin()
    {
        if(!UserAuthService::isGuest())
        {
            App::$app->request->redirect('/task/index');
        }

        if(App::$app->request->isPost())
        {
            $userModel = new UserModel();
            $userModel->load(App::$app->request->post());

            $userAuthService = new UserAuthService($userModel);

            if($userAuthService->login())
            {
                App::$app->session->setFlash('success', 'Вход выполнен');
                App::$app->request->redirect('/task/index');
            }
            else
            {
                App::$app->session->setFlash('error', 'Не верные данные');
                App::$app->request->redirect('/user/login');
            }
        }

        echo $this->getView()->render('login');
    }

    public function actionLogout() {
        $app = App::$app;

        if(!UserAuthService::isGuest())
        {
            UserAuthService::logout();
        }

        App::$app->request->redirect('/task/index');
    }
}