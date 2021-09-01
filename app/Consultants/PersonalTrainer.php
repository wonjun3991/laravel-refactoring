<?php


namespace App\Consultants;


class PersonalTrainer
{
    /**
     * @var ClinicCounselor
     */
    protected $clinicCounselor;
    /**
     * @var DietExpert
     */
    protected $dietExpert;
    /**
     * @var FitnessCoach
     */
    protected $fitnessCoach;

    /**
     * PersonalTrainer constructor.
     * @param ClinicCounselor $clinicCounselor
     * @param DietExpert $dietExpert
     * @param FitnessCoach $fitnessCoach
     */
    public function __construct(
        ClinicCounselor $clinicCounselor,
        DietExpert $dietExpert,
        FitnessCoach $fitnessCoach
    )
    {
        $this->clinicCounselor = $clinicCounselor;
        $this->dietExpert = $dietExpert;
        $this->fitnessCoach = $fitnessCoach;
    }

    public function recommend(array $preferredTypes, bool $isRich, bool $hasAStrongWill, bool $hasGoodHealth, bool $hasEnoughTime)
    {
        foreach ($preferredTypes as $preferredType) {
            switch ($preferredType) {
                case PreferredType::DIET:
                    return $this->dietExpert->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);
                case PreferredType::FITNESS:
                    return $this->fitnessCoach->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);
                case PreferredType::CLINIC:
                    return $this->clinicCounselor->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);
            }
        }
    }
}
