<?php

namespace App\Consultants\Solutions;

use Spatie\Enum\Enum;

/**
 * @method static self MEDICATION()
 * @method static self LIPOSUCTION()
 * @method static self GASTRIC_BYPASS()
 */
class ClinicCounselorSolution extends Enum
{
    protected static function values()
    {
        return [
            'MEDICATION' => 'Medication',
            'LIPOSUCTION' => 'Liposuction',
            'GASTRIC_BYPASS' => 'Gastric Bypass'
        ];
    }
}
