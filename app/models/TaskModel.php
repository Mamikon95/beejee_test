<?php

namespace app\models;

use core\model\Model;

class TaskModel extends Model
{
    public function getTableName(): string
    {
        return 'task';
    }

}