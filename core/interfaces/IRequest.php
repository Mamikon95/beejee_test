<?php

namespace core\interfaces;

interface IRequest
{
    public function setPath(): void;
    public function getPath(): string;

    public function get(string $name): array;
    public function post(string $name): array;
}