<?php

namespace core\session;

use core\Formatter\Formatter;
use core\interfaces\ISession;

class Session implements ISession
{
    protected array $flash = [];
    const FLASH_PREFIX = 'flash_';

    public function __construct()
    {
        session_start();
        $this->_checkFlash();
    }

    public function get(string $key)
    {
        return @$_SESSION[$key];
    }

    public function set(string $key, string $value): bool
    {
        return $_SESSION[$key] = $value;
    }

    public function remove(string $key): bool
    {
        if(isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }

        return isset($_SESSION[$key]);
    }

    public function getFlash(string $key)
    {
        return @$this->flash[self::FLASH_PREFIX . $key];
    }

    public function setFlash(string $key, string $value): bool
    {
        return $_SESSION[self::FLASH_PREFIX . $key] = $value;
    }

    public function hasFlash(): bool
    {
        return (bool)count($this->flash);
    }

    protected function _checkFlash()
    {
        $sessions = $_SESSION;

        foreach($sessions as $key => $value) {
            if(Formatter::startsWith($key, self::FLASH_PREFIX)) {
                $this->flash[$key] = $value;
                unset($_SESSION[$key]);
            }
        }
    }
}