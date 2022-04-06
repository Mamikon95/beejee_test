<?php

namespace app\models;

use core\model\Model;

class UserModel extends Model
{
    public function getTableName(): string
    {
        return 'user';
    }

}