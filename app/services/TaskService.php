<?php

namespace app\services;

use app\interfaces\ITaskService;
use core\App;

class TaskService implements ITaskService
{
    protected $taskModel;

    public function __construct($taskModel)
    {
        $this->taskModel = $taskModel;
    }

    public function getData(): array
    {
        $connection = App::$app->db->getConnection();

        $result = $connection->prepare('SELECT * FROM ' . $this->taskModel->getTableName() . ' WHERE id=1 LIMIT 1');
        $result->execute();

        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}