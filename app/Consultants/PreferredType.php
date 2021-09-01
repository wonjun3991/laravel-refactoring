<?php


namespace App\Consultants;


use App\Utils\EnumUtils;

class PreferredType
{
    const DIET = 'DIET';
    const FITNESS = 'FITNESS';
    const CLINIC = 'CLINIC';

    static public function getPreferredTypes(): array
    {
        return EnumUtils::getConstants(static::class);
    }
}
