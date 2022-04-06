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

        $controllerName = App::$app->config['defaultController'] . 'Controller';

        if($path) {
            $pathSplit = explode('/', $path);
            $controllerName = ucfirst(strtolower($pathSplit[0]));
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

        $actionName = 'Index';

        $pathSplit = explode('/', $path);
        if(isset($pathSplit[1])) {
            $actionName = strtolower($pathSplit[1]);
        }

        $this->actionName = 'action' . $actionName;
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
        $controller = new (self::CONTROLLER_NAMESPACE . '\\' . self::getControllerName());
        $actionFunction = $this->getActionName();
        $controller->$actionFunction();
    }
}