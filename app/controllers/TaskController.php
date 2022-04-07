<?php

namespace app\controller;

use app\forms\TaskForm;
use app\models\TaskModel;
use app\services\PaginationService;
use app\services\TaskService;
use app\services\UserAuthService;
use core\App;
use core\controller\BaseController;

class TaskController extends BaseController
{
    public function actionIndex()
    {
        $searchText = (string)App::$app->request->get('search');
        $taskModel = new TaskModel();
        $taskService = new TaskService($taskModel);
        $paginationService = new PaginationService();
        $paginationService->setPage((int)App::$app->request->get('page'));
        $paginationService->setPageSize(3);
        $paginationService->setCount($taskService->getAllTasksCount($searchText));

        $tasks = $taskService->getAllTasks($paginationService->getLimit(), $paginationService->getOffset(), $searchText);

        echo $this->getView()->render('index', [
            'tasks' => $tasks,
            'paginationService' => $paginationService,
            'searchText' => $searchText
        ]);
    }

    public function actionAdd()
    {
        $taskModel = new TaskModel();
        if(App::$app->request->isPost())
        {
            $taskModel->load(App::$app->request->post());

            $taskService = new TaskService($taskModel);

            $taskForm = new TaskForm($taskModel);

            if($taskForm->validate() && $taskService->add())
            {
                App::$app->session->setFlash('success', 'Задача добавлена');
                App::$app->request->redirect('/task/index');
            }
            else
            {
                App::$app->session->setFlash('error', $taskForm->getErrorMessage());
                App::$app->request->redirect('/task/add');
            }
        }
        echo $this->getView()->render('form', [
            'taskModel' => $taskModel
        ]);
    }

    public function actionEdit()
    {
        if(UserAuthService::isGuest())
        {
            App::$app->request->redirect('/task/index');
        }

        $id = (int)App::$app->request->get('id');
        $taskModel = new TaskModel();
        $taskService = new TaskService($taskModel);
        $taskData = $taskService->getTaskById($id);

        if(!$taskData)
        {
            App::$app->request->redirect('/task/index');
        }

        $taskModel->load($taskData, true);

        if(App::$app->request->isPost())
        {
            $postData = App::$app->request->post();
            $postData['done'] = isset($postData['done']) ? $postData['done'] : 0;
            $taskModel->load($postData);
            $taskForm = new TaskForm($taskModel);

            if($taskForm->validate() && $taskService->edit())
            {
                App::$app->session->setFlash('success', 'Задача отредактирована');
                App::$app->request->redirect('/task/index');
            }
            else
            {
                App::$app->session->setFlash('error', $taskForm->getErrorMessage());
                App::$app->request->redirect('/task/add');
            }
        }

        echo $this->getView()->render('form', [
            'taskModel' => $taskModel
        ]);
    }
}