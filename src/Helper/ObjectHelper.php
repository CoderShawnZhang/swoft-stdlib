<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/14
 * Time: 下午3:42
 */

namespace SwoftRewrite\Stdlib\Helper;


class PhpHelper
{
    /**
     * Call by callback
     *
     * @param callable $cb   callback
     * @param array    $args arguments
     *
     * @return mixed
     */
    public static function call($cb, ...$args)
    {
        if (is_string($cb)) {
            // className::method
            if (strpos($cb, '::') > 0) {
                $cb = explode('::', $cb, 2);
                // function
            } elseif (function_exists($cb)) {
                return $cb(...$args);
            }
        } elseif (is_object($cb) && method_exists($cb, '__invoke')) {
            return $cb(...$args);
        }

        if (is_array($cb)) {
            [$obj, $mhd] = $cb;

            return is_object($obj) ? $obj->$mhd(...$args) : $obj::$mhd(...$args);
        }

        return $cb(...$args);
    }
}