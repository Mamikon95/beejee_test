<?php

namespace app\services;

use app\interfaces\IUserService;
use app\models\UserModel;
use core\App;

class UserService implements IUserService
{
    public static function getUser(string $username, string $password): array
    {
        $connection = App::$app->db->getConnection();
        $prepare = $connection->prepare('SELECT * FROM ' . UserModel::getTableName() . ' WHERE username = ? AND password = ? LIMIT 1');
        $prepare->execute([$username, $password]);
        $data = $prepare->fetch(\PDO::FETCH_ASSOC);

        return $data ? $data : [];
    }
}