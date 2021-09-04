<?php


namespace App\Consultants\Solutions;


use Spatie\Enum\Enum;

/**
 * @method static self YOGA()
 * @method static self SPINNING()
 * @method static self ZUMBA()
 * @method static self BODY_SCULPT()
 */
class FitnessCoachGxSolution extends Enum
{
    protected static function values(): array
    {
        return [
            'YOGA' => 'Yoga',
            'SPINNING' => 'Spinning',
            'ZUMBA' => 'Zumba',
            'BODY_SCULPT' => 'Body Sculpt'
        ];
    }
}
