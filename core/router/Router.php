<?php

namespace core\router;

use core\App;
use core\interfaces\IRouter;

class Router implements IRouter
{
    const CONTROLLER_NAMESPACE = 'app\\controller';

    private string $controllerName;
    private string $actionName;

    public function init(): void
    {
        $this->setControllerName();
        $this->setActionName();
        $this->run();
    }

    private function setControllerName(): void
    {
        $path = App::$app->request->getPath();
        $route = App::$app->config['route'];

        $controllerName = '';

        if(isset($route[$path])) {
            $routeArr = explode('/', $route[$path]);
            $controllerName = $routeArr[0];
        }

        $this->controllerName = $controllerName;
    }

    /**
     * @return string
     */
    private function getControllerName(): string
    {
        return $this->controllerName;
    }


    private function setActionName(): void
    {
        $path = App::$app->request->getPath();
        $route = App::$app->config['route'];

        $actionName = '';

        if(isset($route[$path])) {
            $routeArr = explode('/', $route[$path]);
            $actionName = $routeArr[1];
        }

        if($actionName) {
            $actionName = 'action' . ucfirst($actionName);
        }

        $this->actionName = $actionName;
    }

    /**
     * @param string $actionName
     */
    public function getActionName(): string
    {
        return $this->actionName;
    }

    public function getControllerShortName(): string {
        return strtolower(str_replace('Controller', '', $this->controllerName));
    }

    public function run(): void
    {
        if(!$this->controllerName || !$this->actionName) {
            $this->controllerName = 'NotFoundController';
            $this->actionName = 'actionIndex';
        }

        $controller = new (self::CONTROLLER_NAMESPACE . '\\' . self::getControllerName());
        $actionFunction = $this->getActionName();
        $controller->$actionFunction();
    }
}