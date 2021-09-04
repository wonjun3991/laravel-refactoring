<?php


namespace App\Consultants;


use App\Consultants\Solutions\DietExpertSolution;

class DietExpert implements Consultant
{
    public function recommend(bool $isRich, bool $hasAStrongWill, bool $hasGoodHealth, bool $hasEnoughTime):string
    {
        if ($hasAStrongWill) {
            return DietExpertSolution::EAT_LESS_PLEASE()->value;
        } else if ($isRich) {
            return DietExpertSolution::LCHF()->value;
        }

        return array_rand(array_flip(DietExpertSolution::toValues()), 1);
    }
}
