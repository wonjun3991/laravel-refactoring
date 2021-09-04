<?php

namespace App\Consultants\Solutions;

use Spatie\Enum\Enum;

/**
 * @method static self INTERMITTENT_FASTING()
 * @method static self EAT_LESS_PLEASE()
 * @method static self LCHF()
 */
class DietExpertSolution extends Enum
{
    protected static function values()
    {
        return [
            'INTERMITTENT_FASTING' => 'Intermittent Fasting',
            'EAT_LESS_PLEASE' => 'Eat less please',
            'LCHF' => 'LCHF'
        ];
    }
}
