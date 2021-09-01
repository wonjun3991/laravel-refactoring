<?php


namespace App\Consultants;


use App\Consultants\Solutions\DietExpertSolution;

class DietExpert implements Consultant
{
    const INTERMITTENT_FASTING = 'Intermittent Fasting';
    const EAT_LESS_PLEASE = 'Eat less please';
    const LCHF = 'LCHF';

    public function recommend(bool $isRich, bool $hasAStrongWill, bool $hasGoodHealth, bool $hasEnoughTime)
    {
        if ($hasAStrongWill) {
            return DietExpertSolution::EAT_LESS_PLEASE;
        } else if ($isRich) {
            return DietExpertSolution::LCHF;
        }

        return array_rand(array_flip(DietExpertSolution::getAll()), 1);
    }
}
