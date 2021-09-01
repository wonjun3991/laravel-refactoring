<?php


namespace App\Consultants\Solutions;


use App\Utils\EnumUtils;

abstract class Solution
{
    static public function getAll(): array
    {
        return EnumUtils::getConstants(static::class);
    }
}
