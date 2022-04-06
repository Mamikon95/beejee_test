<?php

namespace core\controller;

use core\interfaces\IBaseController;
use core\view\View;

abstract class BaseController implements IBaseController
{
    private $view;

    public function getView(): View
    {
        $this->view = $this->view ? $this->view : new View();
        return $this->view;
    }
}