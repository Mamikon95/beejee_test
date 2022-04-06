<?php

class Autoloader
{
    protected static $fileExt = '.php';

    protected static $pathsTop;

    protected static $excludePath;

    protected static $fileIterator = null;

    public static function loader($className)
    {
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