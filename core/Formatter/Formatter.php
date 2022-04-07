<?php

namespace core\Formatter;

use core\interfaces\IFormatter;

class Formatter implements IFormatter
{
    public static function dbEscapeString(string $string): string
    {
        return htmlspecialchars(strip_tags($string));
    }

    public static function startsWith(string $string, string $startString): bool
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }
}