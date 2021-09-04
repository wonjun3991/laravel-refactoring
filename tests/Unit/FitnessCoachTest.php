<?php

namespace Tests\Unit;

use App\Consultants\FitnessCoach;
use App\Consultants\Solutions\FitnessCoachGxSolution;
use App\Consultants\Solutions\FitnessCoachSolution;
use Tests\TestCase;

/**
 * @coversDefaultClass \App\Consultants\FitnessCoach
 */
class FitnessCoachTest extends TestCase
{
    use AllLifeStyleTagProvider;

    /**
     * @test
     * @testdox 반환되는 솔루션은 FitnessCoach 클래스 내부의 solutions 와 gx_solutions 안에 정의되어 있어야한다.
     * @covers ::recommend
     * @dataProvider allLifeStyleTagProvider
     */
    public function 추천_모든_경우의_수($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime)
    {
        $fitnessCoach = new FitnessCoach();

        $solution = $fitnessCoach->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);

        $expectedSolutions = array_merge(FitnessCoachSolution::toValues(), FitnessCoachGxSolution::toValues());
        $this->assertTrue(in_array($solution, $expectedSolutions));
    }

    /**
     * @test
     * @testdox 돈이 없으면 'Cardiovascular' 가 반환되어야 한다.
     * @covers ::recommend
     * @dataProvider allLifeStyleTagProvider
     */
    public function 추천_돈이없으면_Cardiovascular($hasAStrongWill, $hasGoodHealth, $hasEnoughTime)
    {
        $fitnessCoach = new FitnessCoach();
        $isRich = false;

        $solution = $fitnessCoach->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);

        $expected = FitnessCoachSolution::CARDIOVASCULAR()->value;
        $this->assertSame($expected, $solution);
    }

    /**
     * @test
     * @testdox 돈이 있고 건강과 의지까지 있으면 'Conditioning' 이 반환되어야 한다.
     * @covers ::recommend
     * @testWith [true]
     * [false]
     */
    public function 추천_돈있고_건강있고_의지있으면_Conditioning($hasEnoughTime)
    {
        $fitnessCoach = new FitnessCoach();
        $isRich = true;
        $hasGoodHealth = true;
        $hasAStrongWill = true;

        $solution = $fitnessCoach->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);

        $expected = FitnessCoachSolution::CONDITIONING()->value;
        $this->assertSame($expected, $solution);
    }

    /**
     * @test
     * @testdox 돈이 있고 의지가 없으면 gx_solutions에서 값을 반환한다.
     * @covers ::recommend
     * @testWith [false, false]
     * [false, true]
     * [true, false]
     * [true, true]
     */
    public function 추천_돈은_있으나_의지가_없으면_gx_solution($hasGoodHealth, $hasEnoughTime)
    {
        $fitnessCoach = new FitnessCoach();
        $isRich = true;
        $hasAStrongWill = false;

        $solution = $fitnessCoach->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);

        $expectedSolutions = FitnessCoachGxSolution::toValues();
        $this->assertTrue(in_array($solution, $expectedSolutions));
    }
}
