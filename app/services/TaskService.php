<?php

namespace app\services;

use app\interfaces\ITaskService;
use app\models\TaskModel;
use core\App;
use core\Formatter\Formatter;

class TaskService implements ITaskService
{
    protected TaskModel $taskModel;

    public function __construct(TaskModel $taskModel)
    {
        $this->taskModel = $taskModel;
    }

    public function getAllTasks(int $limit, int $offset, string $searchText = ''): array
    {
        $connection = App::$app->db->getConnection();

        $sql = 'SELECT * FROM ' . TaskModel::getTableName();
        $executeData = [];

        if($searchText)
        {
            $searchText = Formatter::dbEscapeString($searchText);

            $sql .= ' WHERE `username` LIKE ? OR `email` LIKE ? OR `text` LIKE ?';
            $searchText = '%' . $searchText . '%';
            $executeData = [$searchText, $searchText, $searchText];
        }

        $executeData[] = $limit;
        $executeData[] = $offset;

        $sql .= ' ORDER BY created_at DESC LIMIT ? OFFSET ?';
        $result = $connection->prepare($sql);
        $result->execute($executeData);

        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAllTasksCount(string $searchText = ''): int
    {
        $connection = App::$app->db->getConnection();

        $sql = 'SELECT COUNT(*) FROM ' . TaskModel::getTableName();
        $executeData = [];

        if($searchText)
        {
            $searchText = Formatter::dbEscapeString($searchText);

            $sql .= ' WHERE `username` LIKE ? OR `email` LIKE ? OR `text` LIKE ?';
            $searchText = '%' . $searchText . '%';
            $executeData = [$searchText, $searchText, $searchText];
        }

        $result = $connection->prepare($sql);
        $result->execute($executeData);

        return $result->fetchColumn();
    }

    public function add(): bool
    {
        $addData = [
            Formatter::dbEscapeString($this->taskModel->username),
            Formatter::dbEscapeString($this->taskModel->email),
            Formatter::dbEscapeString($this->taskModel->text),
            time(),
            time(),
        ];

        $connection = App::$app->db->getConnection();
        $prepare = $connection->prepare('INSERT INTO ' .
            TaskModel::getTableName() .
            ' (username, email, text, created_at, updated_at) VALUES (?, ?, ?, ?, ?)');

        return $prepare->execute($addData);
    }

    public function edit(): bool
    {
        $editData = [
            Formatter::dbEscapeString($this->taskModel->text),
            (bool)$this->taskModel->done,
            TaskModel::IS_EDITED,
            time(),
            $this->taskModel->id
        ];

        $connection = App::$app->db->getConnection();
        $prepare = $connection->prepare('UPDATE ' .
            TaskModel::getTableName() .
            ' SET text=?, done=?, edited=?, updated_at=? WHERE id=?');

        return $prepare->execute($editData);
    }

    public function getTaskById(int $id): array
    {
        $connection = App::$app->db->getConnection();
        $prepare = $connection->prepare('SELECT * FROM ' . TaskModel::getTableName() . ' WHERE id = ? LIMIT 1');
        $prepare->execute([$id]);
        $data = $prepare->fetch(\PDO::FETCH_ASSOC);

        return $data ? $data : [];
    }
}