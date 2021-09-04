<?php


namespace App\Consultants\Solutions;


use Spatie\Enum\Enum;

/**
 * @method static self CONDITIONING()
 * @method static self CARDIOVASCULAR()
 * @method static self STRENGTH()
 */
class FitnessCoachSolution extends Enum
{
    protected static function values(): array
    {
        return [
            'CONDITIONING' => 'Conditioning',
            'CARDIOVASCULAR' => 'Cardiovascular',
            'STRENGTH' => 'Strength'
        ];
    }
}
