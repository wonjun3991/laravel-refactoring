<?php


namespace App\Consultants;


use Spatie\Enum\Enum;


/**
 * @method static self RICH()
 * @method static self TIME()
 * @method static self HEALTH()
 * @method static self WILL()
 */
class LifeStyleTag extends Enum
{
    protected static function values()
    {
        return [
            'RICH' => 'rich',
            'TIME' => 'enough_time',
            'HEALTH' => 'healthy',
            'WILL' => 'strong_will'
        ];
    }
}
