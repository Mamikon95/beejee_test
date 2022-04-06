<?php
include 'Autoloader.php';

spl_autoload_register("Autoloader::autoloadsystem");

$config = include_once 'app/config.php';

$app = new \core\App($config);
$app->init();