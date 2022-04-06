<?php

namespace core\interfaces;

interface IRouter
{
    public function init(): void;
    public function run(): void;
    public function getControllerShortName(): string;
}