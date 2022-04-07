<?php

namespace core\request;

use core\interfaces\IRequest;

class Request implements IRequest
{
    private string $path;

    public function __construct()
    {
        $this->setPath();
    }

    /**
     * @param mixed $path
     */
    public function setPath(): void
    {
        $this->path = $this->getParseUrl()['path'];
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function get(string $name = '')
    {
        return $name ? @$_GET[$name] : $_GET;
    }

    public function post(string $name = '')
    {
        return $name ? @$_POST[$name] : $_POST;
    }

    private function getParseUrl(): array {
        return parse_url($_SERVER["REQUEST_URI"]);
    }

    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], 'xmlhttprequest') == 0;
    }

    public function redirect(string $url)
    {
        header('Location: '.$url);
        exit;
    }
}