<?php

namespace Tests\Unit;

use App\Consultants\ClinicCounselor;
use App\Consultants\DietExpert;
use App\Consultants\FitnessCoach;
use App\Consultants\PersonalTrainer;
use Tests\TestCase;

class PersonalTrainerTest extends TestCase
{
    use AllLifeStyleTagProvider;

    /**
     * @test
     * @testdox 피트니스를 선호할 시 FitnessCoach 객체로 부터 솔루션을 받아야 한다.
     * @dataProvider allLifeStyleTagProvider
     */
    public function 추천_피트니스_선호($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime)
    {
        $clinicCounselor = $this->getClinicCounselor();
        $dietExpert = $this->getDietExpert();
        $fitnessCoach = $this->getFitnessCoach();

        $personalTrainer = new PersonalTrainer($clinicCounselor, $dietExpert, $fitnessCoach);

        $recommend = $personalTrainer->recommend(['FITNESS', 'DIET', 'CLINIC'], $isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);
        $expected = $fitnessCoach->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);

        $this->assertSame($expected, $recommend);
    }

    /**
     * @test
     * @testdox 식이요법을 선호할 시 DietExpert 객체로 부터 솔루션을 받아야 한다.
     * @dataProvider allLifeStyleTagProvider
     */
    public function 추천_식이요법_선호($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime)
    {
        $clinicCounselor = $this->getClinicCounselor();
        $dietExpert = $this->getDietExpert();
        $fitnessCoach = $this->getFitnessCoach();

        $personalTrainer = new PersonalTrainer($clinicCounselor, $dietExpert, $fitnessCoach);

        $recommend = $personalTrainer->recommend(['DIET', 'FITNESS', 'CLINIC'], $isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);
        $expected = $dietExpert->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);

        $this->assertSame($expected, $recommend);
    }

    /**
     * @test
     * @testdox 클리닉을 선호할 시 ClinicCounselor 객체로 부터 솔루션을 받아야 한다.
     * @dataProvider allLifeStyleTagProvider
     */
    public function 추천_클리닉_선호($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime)
    {
        $clinicCounselor = $this->getClinicCounselor();
        $dietExpert = $this->getDietExpert();
        $fitnessCoach = $this->getFitnessCoach();

        $personalTrainer = new PersonalTrainer($clinicCounselor, $dietExpert, $fitnessCoach);

        $recommend = $personalTrainer->recommend(['CLINIC', 'FITNESS', 'DIET'], $isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);
        $expected = $clinicCounselor->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);

        $this->assertSame($expected, $recommend);
    }

    private function getClinicCounselor(): ClinicCounselor
    {
        $clinicCounselor = $this->createMock(ClinicCounselor::class);
        $clinicCounselor->method('recommend')->willReturn('CLINIC');

        return $clinicCounselor;
    }

    private function getDietExpert(): DietExpert
    {
        $dietExpert = $this->createMock(DietExpert::class);
        $dietExpert->method('recommend')->willReturn('DIET');

        return $dietExpert;
    }

    private function getFitnessCoach(): FitnessCoach
    {
        $fitnessCoach = $this->createMock(FitnessCoach::class);
        $fitnessCoach->method('recommend')->willReturn('FITNESS');

        return $fitnessCoach;
    }
}
