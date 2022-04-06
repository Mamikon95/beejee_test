<?php

namespace app\controller;

use app\models\TaskModel;
use app\services\TaskService;
use core\controller\BaseController;

class TaskController extends BaseController
{
    public function actionIndex()
    {
        $taskModel = new TaskModel();
        $taskService = new TaskService($taskModel);

        echo $this->getView()->render('index', [
            'text' => 'Hello Worldss'
        ]);
    }
}