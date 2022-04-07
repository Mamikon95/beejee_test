<?php

namespace core\model;

use core\App;
use core\interfaces\IModel;

class Model implements IModel
{
    public function load(array $data): bool
    {
        foreach($data as $attrName => $value) {
            $this->$attrName = $value;
        }

        return true;
    }
}