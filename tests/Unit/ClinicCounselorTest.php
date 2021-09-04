<?php

namespace Tests\Unit;

use App\Consultants\ClinicCounselor;
use App\Consultants\Solutions\ClinicCounselorSolution;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Consultants\ClinicCounselor
 */
class ClinicCounselorTest extends TestCase
{
    use AllLifeStyleTagProvider;

    /**
     * @test
     * @testdox ClinicCounselor 가 반환하는 솔루션은 어떠한 경우에도 ClinicCounselor 클래스 내부의 solutions 안에 정의되어 있어야한다.
     * @dataProvider allLifeStyleTagProvider
     * @covers ::recommend
     */
    public function 추천_모든_경우의_수($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime)
    {
        $clinicCounselor = new ClinicCounselor();

        $solution = $clinicCounselor->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);


        $solutions = ClinicCounselorSolution::toValues();
        $this->assertTrue(in_array($solution, $solutions));
    }

    /**
     * @test
     * @testdox isRich 가 true 고 hasAStrongWill 이 false 일 경우 'Gastric Bypass' (위장접합술)을 추천해야 한다.
     * @covers ::recommend
     * @testWith [false, false]
     * [false, true]
     * [true, false]
     * [true, true]
     */
    public function 추천_돈많고_의지없으면_위장접합술($hasGoodHealth, $hasEnoughTime)
    {
        $clinicCounselor = new ClinicCounselor();
        $isRich = true;
        $hasAStrongWill = false;

        $solution = $clinicCounselor->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);

        $expected = ClinicCounselorSolution::GASTRIC_BYPASS()->value;
        $this->assertSame($expected, $solution);
    }

    /**
     * @test
     * @testdox isRich 가 false 이거나 hasAStrongWill 이 true 고 hasGoodHealth가 true 면 'Medications' (약물)을 추천해야 한다.
     * @covers ::recommend
     * @testWith [true]
     * [false]
     */
    public function 추천_돈없거나_의지가있고_건강이_좋으면_약물($hasEnoughTime)
    {
        $clinicCounselor = new ClinicCounselor();

        // 이 테스트에서 모든 기대 값은 MEDICATION 이다.
        $expected = ClinicCounselorSolution::MEDICATION()->value;

        $hasGoodHealth = true;
        // 돈 없고 의지도 없을 때
        // isRich 가 false 이고 hasAStrongWill 이 false 일때
        $isRich = false;
        $hasAStrongWill = false;


        $solution = $clinicCounselor->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);

        $this->assertSame($expected, $solution);

        // 돈없고 의자가 있을 때
        // isRich 가 false 이고 hasAStrongWill 이 true 일때
        $isRich = false;
        $hasAStrongWill = true;

        $solution = $clinicCounselor->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);
        $this->assertSame($expected, $solution);

        // 돈있고 의자기 있을 때
        // isRich 가 true 이고 hasAStrongWill 이 true 일때
        $isRich = true;
        $hasAStrongWill = true;

        $solution = $clinicCounselor->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);
        $this->assertSame($expected, $solution);
    }
}
