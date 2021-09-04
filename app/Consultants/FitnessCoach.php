<?php


namespace App\Consultants;


use App\Consultants\Solutions\FitnessCoachGxSolution;
use App\Consultants\Solutions\FitnessCoachSolution;

class FitnessCoach implements Consultant
{
    public function recommend(bool $isRich, bool $hasAStrongWill, bool $hasGoodHealth, bool $hasEnoughTime):string
    {
        $fitnessCoachSolutions = FitnessCoachSolution::toValues();
        $fitnessCoachGxSolutions = FitnessCoachGxSolution::toValues();
        $fitnessCoachAllSolutions = array_merge($fitnessCoachSolutions, $fitnessCoachGxSolutions);

        if (!$isRich) {
            return FitnessCoachSolution::CARDIOVASCULAR()->value;
        } elseif ($hasGoodHealth && $hasAStrongWill) {
            return FitnessCoachSolution::CONDITIONING()->value;
        } elseif (!$hasAStrongWill) {
            return array_rand(array_flip($fitnessCoachGxSolutions), 1);
        }

        return array_rand(array_flip($fitnessCoachAllSolutions), 1);
    }
}
