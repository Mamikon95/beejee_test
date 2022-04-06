<?php
include 'core/Autoloader.php';

Autoloader::setFileExt('.php');
$dir = __DIR__ . DIRECTORY_SEPARATOR;
Autoloader::setPaths([$dir . 'app', $dir . 'core']);
Autoloader::setExcludePath('views');
spl_autoload_register('Autoloader::loader');

$config = include_once 'app/config.php';

$app = new \core\App($config);
$app->init();
?>