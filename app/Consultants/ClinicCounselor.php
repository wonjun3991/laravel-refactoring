<?php


namespace App\Consultants;


use App\Consultants\Solutions\ClinicCounselorSolution;

class ClinicCounselor implements Consultant
{
    public function recommend(bool $isRich, bool $hasAStrongWill, bool $hasGoodHealth, bool $hasEnoughTime)
    {
        if ($isRich && !$hasAStrongWill) {
            return ClinicCounselorSolution::GASTRIC_BYPASS;
        } elseif ($hasGoodHealth) {
            return ClinicCounselorSolution::MEDICATIONS;
        }

        return array_rand(array_flip(ClinicCounselorSolution::getAll()), 1);
    }
}
