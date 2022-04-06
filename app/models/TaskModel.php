<?php

namespace app\models;

use core\App;
use core\model\Model;

class TaskModel extends Model
{
    public function getTableName(): string
    {
        return 'task';
    }

}