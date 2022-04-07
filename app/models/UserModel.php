<?php

namespace app\models;

use core\model\Model;

class UserModel extends Model
{
    public string $id;
    public string $username;
    public string $password;

    public static function getTableName(): string
    {
        return 'user';
    }

}