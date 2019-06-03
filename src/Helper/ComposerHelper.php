<?php
/**
 * 处理Composer 工具类
 */
namespace SwoftRewrite\Stdlib\Helper;

use Composer\Autoload\ClassLoader;

class ComposerHelper
{
    protected static $composerLoader;

    public static function getClassLoader(): ClassLoader
    {
        if(self::$composerLoader){
            return self::$composerLoader;
        }

        $autoloadFunctions = spl_autoload_functions();
        foreach($autoloadFunctions as $autoloader){
            $t= $autoloader;
        }
    }
}

