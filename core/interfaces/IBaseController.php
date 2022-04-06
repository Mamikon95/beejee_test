<?php

namespace core\interfaces;

use core\view\View;

interface IBaseController
{
    public function getView(): View;
}