<?php

include 'app/config.php';

class Autoloader
{
    private static $includeDirs;

    public static function autoloadRegister()
    {
        spl_autoload_register(function ($className) {
            foreach ( static::getIncludeDirs() as $dir ){
                $path = "$dir/$className.php";
                if ( file_exists( $path) ){
                    require $path;
                }
            }
        });
    }

    public static function getIncludeDirs()
    {
        if ( static::$includeDirs == null ){
            static::$includeDirs = [];
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator(__DIR__)
            );
            foreach ($iterator as $file) {
                if ($file->isDir() && $file->getBasename() == '.'){
                    static::$includeDirs[] = $file->getPath();
                }
            }
        }
        return static::$includeDirs;
    }
}

Autoloader::autoloadRegister();