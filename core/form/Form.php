<?php

namespace core\form;

use core\interfaces\IForm;

class Form implements IForm
{
    protected string $errorMsg = '';

    public function getErrorMessage(): string
    {
        return $this->errorMsg;
    }

    protected function setErrorMessage(string $errorMsg): void
    {
        $this->errorMsg = $errorMsg;
    }

}