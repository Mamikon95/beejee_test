<?php

namespace app\controller;

use core\controller\BaseController;

class NotFoundController extends BaseController
{
    public function actionIndex()
    {
        header("HTTP/1.0 404 Not Found");
        print_r('Страница не найдена');
    }
}