<?php

namespace Tests\Unit;

use App\Consultants\DietExpert;
use Tests\TestCase;

class DietExpertTest extends TestCase
{
    use AllLifeStyleTagProvider;

    const INTERMITTENT_FASTING = 'Intermittent Fasting';
    const EAT_LESS_PLEASE = 'Eat less please';
    const LCHF = 'LCHF';

    private $expectedSolutions = [
        self::INTERMITTENT_FASTING,
        self::EAT_LESS_PLEASE,
        self::LCHF
    ];

    /**
     * @test
     * @testdox 반환되는 솔루션은 DietExpert 클래스 내부의 solutions 안에 정의되어 있어야한다.
     * @dataProvider allLifeStyleTagProvider
     */
    public function 추천_모든_경우의_수($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime)
    {
        $dietExpert = new DietExpert();

        $solution = $dietExpert->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);

        $solutions = $this->expectedSolutions;
        $this->assertTrue(in_array($solution, $solutions));
    }

    /**
     * @test
     * @testdox 의지가 있을 경우 'Eat less please' (적당히 쳐먹으세요) 가 반환되어야 한다.
     * @dataProvider allLifeStyleTagProvider
     */
    public function 추천_의지가_있으면_적당히_드세요($isRich, $hasGoodHealth, $hasEnoughTime)
    {
        $dietExpert = new DietExpert();
        $hasAStrongWill = true;
        $expected = self::EAT_LESS_PLEASE;

        $solution = $dietExpert->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);

        $this->assertSame($expected, $solution);
    }

    /**
     * @test
     * @testdox 의지가 없고 돈이 있으면 'LCHF' (저탄수 고지방 식이요법) 가 반환되어야 한다.
     * @testWith [false, false]
     * [false, true]
     * [true, false]
     * [true, true]
     */
    public function 추천_의지가_없고_돈이_있으면_저탄고지($hasGoodHealth, $hasEnoughTime)
    {
        $dietExpert = new DietExpert();
        $hasAStrongWill = false;
        $isRich = true;

        $solution = $dietExpert->recommend($isRich, $hasAStrongWill, $hasGoodHealth, $hasEnoughTime);

        $expected = self::LCHF;
        $this->assertSame($expected, $solution);
    }
}
