<?php

class Autoloader
{
    protected static $excludePath;

    private static $addedPaths = [];

    public static function load($class, $paste)
    {
        $dir = __DIR__ . "\\" . $paste;

        if(in_array($dir, self::$addedPaths) || strpos($dir, self::$excludePath) !== false) {
            return;
        }

        foreach ( scandir( $dir ) as $file ) {
            if ( substr( $file, 0, 2 ) !== '._' && preg_match( "/.php$/i" , $file ) ) {
                require $dir . "\\" . $file;
            }else{
                if($file != '.' && $file != '..'){
                    self::load($class, $paste . "\\" . $file);
                }
            }
        }

        self::$addedPaths[] = $dir;
    }

    public static function autoloadsystem($class)
    {
        self::$excludePath = __DIR__ . '\\app\\views';
        self::load($class, 'core\\interfaces');
        self::load($class, 'core');
        self::load($class, 'app');
    }

}