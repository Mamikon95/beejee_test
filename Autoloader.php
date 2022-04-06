<?php

class Autoloader
{
    protected static $fileExt = '.php';

    protected static $pathsTop;

    protected static $excludePath;

    protected static $fileIterator = null;

    private static $addedPaths = [];

    public static function loadInterfaces($className)
    {
        self::load($className);
    }

    public static function loadCore($className) {
        self::load($className);
    }

    public static function loadApp($className) {
        self::load($className);
    }

    public static function load($className) {
        foreach(self::$pathsTop as $pathTop)
        {
            $directory = new RecursiveDirectoryIterator($pathTop, RecursiveDirectoryIterator::SKIP_DOTS);

            static::$fileIterator = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::LEAVES_ONLY);

            $filename = $className . static::$fileExt;

            foreach (static::$fileIterator as $file) {
                if($file->getPathInfo()->getFileName() == self::$excludePath ||
                    $file->getPathInfo()->getPathInfo()->getFileName() == self::$excludePath) {
                    continue;
                }

                if ($file->isReadable()) {
                    var_dump($file->getPathname() . '<br>');
                    if(in_array($file->getPathname(), self::$addedPaths)) {
                        continue;
                    }

                    self::$addedPaths[] = $file->getPathname();
                    include_once $file->getPathname();
                }

            }
        }
    }

    public static function setFileExt($fileExt)
    {
        static::$fileExt = $fileExt;
    }

    public static function setPaths($paths)
    {
        static::$pathsTop = $paths;
    }

    public static function setExcludePath($excludePath)
    {
        static::$excludePath = $excludePath;
    }

}