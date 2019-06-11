<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/8
 * Time: 下午2:06
 */
namespace SwoftRewrite\Stdlib\Helper;

class Str
{
    /**
     * @param string $path
     * @return string
     */
    public static function rmPharPrefix(string $path): string
    {
        if (0 === strpos($path, 'phar://')) {
            return preg_replace('/[\w-]+\.phar\//', '', substr($path, 7));
        }

        return $path;
    }
}