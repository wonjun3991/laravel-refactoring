<?php

namespace App\Consultants;

use Spatie\Enum\Enum;

/**
 * @method static self DIET()
 * @method static self FITNESS()
 * @method static self CLINIC()
 */
class PreferredType extends Enum
{
    protected static function values()
    {
        return [
            'DIET' => 'DIET',
            'FITNESS' => 'FITNESS',
            'CLINIC' => 'CLINIC'
        ];
    }
}
