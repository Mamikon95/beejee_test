<?php

namespace core\view;

use core\App;
use core\interfaces\IView;

class View implements IView
{
    CONST VIEWS_DIR = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app/views';
    CONST LAYOUT = 'layout.php';

    public function render(string $name, array $params = []): string
    {
        extract($params);

        ob_start();
        include self::VIEWS_DIR . DIRECTORY_SEPARATOR . App::$app->router->getControllerShortName() . DIRECTORY_SEPARATOR . $name . '.php';
        $content = ob_get_contents();
        ob_end_clean();

        ob_start();
        include self::VIEWS_DIR . DIRECTORY_SEPARATOR . self::LAYOUT;
        $renderedView = ob_get_contents();
        ob_end_clean();

        return $renderedView;
    }
}