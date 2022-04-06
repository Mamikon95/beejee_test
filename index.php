<?php
include 'Autoloader.php';

Autoloader::setFileExt('.php');
Autoloader::setExcludePath('views');

$dir = __DIR__ . DIRECTORY_SEPARATOR;
//Autoloader::setPaths([$dir . 'core' . DIRECTORY_SEPARATOR . 'interfaces']);
//spl_autoload_register('Autoloader::loadInterfaces');
//
//Autoloader::setPaths([$dir . 'core']);
//spl_autoload_register('Autoloader::loadCore');

//Autoloader::setPaths([$dir . 'app']);
//spl_autoload_register('Autoloader::loadApp');

function autoload( $class, $dir = null ) {

    if ( is_null( $dir ) )
        $dir = '/path/to/project';

    foreach ( scandir( $dir ) as $file ) {

        // directory?
        if ( is_dir( $dir.$file ) && substr( $file, 0, 1 ) !== '.' )
            autoload( $class, $dir.$file.'/' );

        // php file?
        if ( substr( $file, 0, 2 ) !== '._' && preg_match( "/.php$/i" , $file ) ) {

            // filename matches class?
            if ( str_replace( '.php', '', $file ) == $class || str_replace( '.class.php', '', $file ) == $class ) {

                include $dir . $file;
            }
        }
    }
}

$config = include_once 'app/config.php';

$app = new \core\App($config);
$app->init();