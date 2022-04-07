<?php

namespace core\interfaces;

interface IModel
{
    public function load(array $data, bool $widthId = false): bool;
}