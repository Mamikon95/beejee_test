<?php

namespace core\interfaces;

interface IRequest
{
    public function setPath(): void;
    public function getPath(): string;

    public function get(): array;
    public function post(): array;
}