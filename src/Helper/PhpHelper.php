<?php
/**
 * Created by PhpStorm.
 * User: zhanghongbo
 * Date: 2019/6/3
 * Time: 下午4:15
 */

namespace SwoftRewrite\Stdlib\Helper;

class ObjectHelper
{
    public static function init($object,array $options)
    {
        foreach($options as $property => $value){
            if(is_numeric($property)){
                continue;
            }
            $setter = 'set' . ucfirst($property);
            if(method_exists($object,$setter)){
                $object->$setter($value);
            } elseif (property_exists($object,$property)){
                $object->$property = $value;
            }
        }
        return $object;
    }
}