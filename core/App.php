<?php

namespace core;

use core\db\Db;
use core\interfaces\IApp;
use core\request\Request;
use core\router\Router;
use core\session\Session;

final class App implements IApp
{
    public Session $session;
    public Request $request;
    public Router $router;
    public Db $db;
    public array $config;
    public static $app;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function init(): void
    {
        self::$app = $this;
        $this->_initDB();
        $this->_initRequest();
        $this->_initSession();
        $this->_initRouter();
    }

    private function _initDB(): void
    {
        $this->db = new Db(
            $this->config['db']['host'],
            $this->config['db']['user'],
            $this->config['db']['password'],
            $this->config['db']['dbName']
        );
    }

    private function _initRequest(): void
    {
        $this->request = new Request();
    }

    private function _initSession(): void
    {
        $this->session = new Session();
    }

    private function _initRouter(): void
    {
        $this->router = new Router();
        $this->router->init();
    }
}