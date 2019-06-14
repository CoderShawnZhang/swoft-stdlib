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

    public static function getClassName(string $class, string $suffix): string
    {
        if (empty($suffix)) {
            return $class;
        }

        // \\(\w+)Helper$
        if (strpos($class, $suffix) > 0) {
            $regex = '/\\\(\w+)' . $suffix . '$/';
            $ok    = preg_match($regex, $class, $match);
        } else {
            $ok    = true;
            $match = [1 => $class];
        }

        return $ok ? lcfirst($match[1]) : '';
    }

    public static function explode(string $str, string $separator = ',', int $limit = 0): array
    {
        return static::toArray($str, $separator, $limit);
    }

    public static function toArray(string $string, string $delimiter = ',', int $limit = 0): array
    {
        $string = trim($string, "$delimiter ");
        if ($string === '') {
            return [];
        }

        $values  = [];
        $rawList = $limit < 1 ? explode($delimiter, $string) : explode($delimiter, $string, $limit);

        foreach ($rawList as $val) {
            if (($val = trim($val)) !== '') {
                $values[] = $val;
            }
        }

        return $values;
    }

    /**
     * @param string $str
     * @return string
     */
    public static function firstLine(string $str): string
    {
        if (!$str = trim($str)) {
            return '';
        }

        if (strpos($str, "\n") > 0) {
            return explode("\n", $str)[0];
        }

        return $str;
    }
}