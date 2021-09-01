<?php


namespace App\Utils;


use ReflectionClass;

class EnumUtils
{
    public static function getConstants(string $className)
    {
        $reflectionClass = new ReflectionClass($className);
        return array_values($reflectionClass->getConstants());
    }
}
