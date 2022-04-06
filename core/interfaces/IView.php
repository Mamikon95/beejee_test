<?php

namespace core\interfaces;

interface IView
{
    public function render(string $name, array $params): string;
}