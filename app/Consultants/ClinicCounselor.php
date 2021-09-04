<?php


namespace App\Consultants;


use App\Consultants\Solutions\ClinicCounselorSolution;

class ClinicCounselor implements Consultant
{
    public function recommend(bool $isRich, bool $hasAStrongWill, bool $hasGoodHealth, bool $hasEnoughTime):string
    {
        if ($isRich && !$hasAStrongWill) {
            return ClinicCounselorSolution::GASTRIC_BYPASS()->value;
        } elseif ($hasGoodHealth) {
            return ClinicCounselorSolution::MEDICATION()->value;
        }

        return array_rand(array_flip(ClinicCounselorSolution::toValues()), 1);
    }
}
