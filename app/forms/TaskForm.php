<?php

namespace app\forms;

use app\models\TaskModel;
use core\form\Form;

class TaskForm extends Form
{
    protected TaskModel $taskModel;

    public function __construct(TaskModel $taskModel)
    {
        $this->taskModel = $taskModel;
    }

    public function validate(): bool
    {
        if(!$this->taskModel->username || !$this->taskModel->email || !$this->taskModel->text)
        {
            $this->setErrorMessage('Не заполнены все поля');
            return false;
        }

        if(mb_strlen($this->taskModel->username) > 32)
        {
            $this->setErrorMessage('"Имя пользователя" превышает допустимую длину(32)');
            return false;
        }

        if(mb_strlen($this->taskModel->email) > 64)
        {
            $this->setErrorMessage('"Почта" превышает допустимую длину(64)');
            return false;
        }

        if(mb_strlen($this->taskModel->text) > 5000)
        {
            $this->setErrorMessage('"Текст задачи" превышает допустимую длину(64)');
            return false;
        }

        if (!filter_var($this->taskModel->email, FILTER_VALIDATE_EMAIL))
        {
            $this->setErrorMessage('Неверный формат почты');
            return false;
        }

        return true;
    }
}