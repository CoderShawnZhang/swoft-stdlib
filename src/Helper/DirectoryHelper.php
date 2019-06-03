<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/3
 * Time: 下午2:15
 */
namespace SwoftRewrite\Stdlib\Helper;

class DirectoryHelper
{
    /**
     * 目录迭代器
     */
    public static function recursiveIterator(string $path,int $mode = \RecursiveIteratorIterator::LEAVES_ONLY,int $flags = 0): \RecursiveIteratorIterator
    {
        if(empty($path) || !file_exists($path)){
            throw new \Exception('File path is not exist! Path:' . $path);
        }

        $directoryIterator = new \RecursiveDirectoryIterator($path);

        return new \RecursiveIteratorIterator($directoryIterator,$mode,$flags);
    }
}