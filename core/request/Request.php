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
        $this->path = ltrim($this->getParseUrl()['path'], '/');;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function get(): array
    {
        return $_GET;
    }

    public function post(): array
    {
        return $_POST;
    }

    private function getParseUrl(): array {
        return parse_url($_SERVER["REQUEST_URI"]);
    }
}