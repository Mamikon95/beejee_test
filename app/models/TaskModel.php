<?php

namespace app\models;

use core\model\Model;

class TaskModel extends Model
{
    public $id;
    public $username;
    public $email;
    public $text;
    public $edited;
    public $done;
    public $created_at;
    public $updated_at;

    const IS_EDITED = 1;
    const IS_NOT_EDITED = 0;

    const IS_DONE = 1;
    const IS_NOT_DONE = 0;

    public static function getTableName(): string
    {
        return 'task';
    }

    public function getIsDone(): bool
    {
        return $this->done = self::IS_DONE;
    }

    public function getIsEdited(): bool
    {
        return $this->edited = self::IS_EDITED;
    }

}