<?php

namespace core\interfaces;

interface IRequest
{
    public function setPath(): void;
    public function getPath(): string;

    public function get(string $name = '');
    public function post(string $name = '');

    public function isPost(): bool;
    public function isAjax(): bool;

    public function redirect(string $url);
}