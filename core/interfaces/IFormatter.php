<?php

namespace core\interfaces;

interface IFormatter
{
    public static function dbEscapeString(string $string): string;

    public static function startsWith(string $string, string $startString): bool;
}