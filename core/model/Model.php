<?php

namespace core\model;

use core\App;
use core\interfaces\IModel;

class Model implements IModel
{
    public function load(array $data, bool $widthId = false): bool
    {
        foreach($data as $attrName => $value) {
            if($attrName == 'id' && !$widthId) continue;
            $this->$attrName = $value;
        }

        return true;
    }
}