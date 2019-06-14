<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/14
 * Time: 下午2:22
 */

namespace SwoftRewrite\Stdlib;


final class Reflections
{
    private static $pool = [];

    public static function get(string $className)
    {
        if(!isset(self::$pool[$className])){
            self::cache($className);
        }
        return self::$pool[$className];
    }

    public static function cache(string $className)
    {
        if(isset(self::$pool[$className])){
            return;
        }

        $reflectionClass = new \ReflectionClass($className);
        self::cacheReflectionClass($reflectionClass);
    }

    public static function cacheReflectionClass(\ReflectionClass $reflectionClass)
    {
        $className = $reflectionClass->getName();
        if(isset(self::$pool[$className])){
            return;
        }
        $reflectionMethods = $reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC);

        self::$pool[$className]['name'] = $reflectionClass->getName();
        self::$pool[$className]['comments'] = $reflectionClass->getDocComment();

        foreach($reflectionMethods as $reflectionMethod){
            $methodName = $reflectionMethod->getName();
            $methodParams = [];
            foreach($reflectionMethod->getParameters() as $parameter){
                $defaultValue = null;
                if($parameter->isDefaultValueAvailable()){
                    $defaultValue = $parameter->getDefaultValue();
                }

                $methodParams[] = [
                    $parameter->getName(),
                    $parameter->getType(),
                    $defaultValue
                ];
            }
            self::$pool[$className]['methods'][$methodName]['params'] = $methodParams;
            self::$pool[$className]['methods'][$methodName]['comments'] = $reflectionMethod->getDocComment();
            self::$pool[$className]['methods'][$methodName]['returnType'] = $reflectionMethod->getReturnType();

        }
    }
}