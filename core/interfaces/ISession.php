<?php

namespace core\interfaces;

interface ISession
{
    public function set(string $key, string $value): bool;

    public function get(string $key);

    public function remove(string $key);

    public function setFlash(string $key, string $value): bool;

    public function getFlash(string $key);

    public function hasFlash(): bool;
}