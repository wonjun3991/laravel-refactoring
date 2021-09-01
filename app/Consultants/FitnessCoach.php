<?php


namespace App\Consultants;


use App\Consultants\Solutions\FitnessCoachGxSolution;
use App\Consultants\Solutions\FitnessCoachSolution;

class FitnessCoach implements Consultant
{
    public function recommend(bool $isRich, bool $hasAStrongWill, bool $hasGoodHealth, bool $hasEnoughTime)
    {
        $fitnessCoachSolutions = FitnessCoachSolution::getAll();
        $fitnessCoachGxSolutions = FitnessCoachGxSolution::getAll();
        $fitnessCoachAllSolutions = array_merge($fitnessCoachSolutions, $fitnessCoachGxSolutions);

        if (!$isRich) {
            return FitnessCoachSolution::CARDIOVASCULAR;
        } elseif ($hasGoodHealth && $hasAStrongWill) {
            return FitnessCoachSolution::CONDITIONING;
        } elseif (!$hasAStrongWill) {
            return array_rand(array_flip($fitnessCoachGxSolutions), 1);
        }

        return array_rand(array_flip($fitnessCoachAllSolutions), 1);
    }
}
