<?php


namespace App\Consultants;


use App\Utils\EnumUtils;

class LifeStyleTag
{
    const RICH = 'rich';
    const TIME = 'enough_time';
    const HEALTH = 'healthy';
    const WILL = 'strong_will';

    static public function getLifeStyleTags(): array
    {
        return EnumUtils::getConstants(static::class);
    }
}
