<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class FatControllerTest extends TestCase
{
    const ROUTE_NAME = 'refactoring';

    const PREFERRED_TYPES_FITNESS = 'FITNESS';
    const PREFERRED_TYPES_DIET = 'DIET';
    const PREFERRED_TYPES_CLINIC = 'CLINIC';

    const LIFE_STYLES_RICH = 'rich';
    const LIFE_STYLES_TIME = 'enough_time';
    const LIFE_STYLES_HEALTH = 'healthy';
    const LIFE_STYLES_WILL = 'strong_will';

    private $preferredTypesOrder = [
        self::PREFERRED_TYPES_FITNESS,
        self::PREFERRED_TYPES_DIET,
        self::PREFERRED_TYPES_CLINIC,
    ];

    private $lifeStyleTag = [
        self::LIFE_STYLES_RICH,
        self::LIFE_STYLES_TIME,
        self::LIFE_STYLES_HEALTH,
        self::LIFE_STYLES_WILL,
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['Accept' => 'application/json']);
    }

    /**
     * @test
     * @testdox 선호하는 타입들과 스타일 태그가 올바르게 넘겨졌을때 200 반환
     */
    public function 선호하는_타입과_스타일_태그가_받아졌을때_성공()
    {
        $route = route(self::ROUTE_NAME,
            ['life_style_tag' => $this->lifeStyleTag, 'preferred_types_order' => $this->preferredTypesOrder]
        );

        $response = $this->get($route);
        $response->assertStatus(Response::HTTP_OK);
    }


    /**
     * @test
     * @testdox 선호하는 타입은 정해진 값들 중에서 넘어와야 하며 최소 하나 이상의 값이 넘어와야함 그렇지 않을 경우 422 error 발생
     * @dataProvider invalidPreferredTypesOrderProvider
     */
    public function 선호하는_타입이_올바르지_않은_값일때($invalidPreferredTypesOrder)
    {
        $route = route(self::ROUTE_NAME,
            ['life_style_tag' => $this->lifeStyleTag, 'preferred_types_order' => $invalidPreferredTypesOrder]
        );

        $response = $this->get($route);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     * @testdox 라이프 스타일 태그는 정해진 값들 중에서 넘어와야 하며 최소 하나 이상의 값이 넘어와야함 그렇지 않을 경우 422 error 발생
     * @dataProvider invalidLifeStyleTagProvider
     */
    public function 라이프_스타일_태그가_올바르지_않은_값일때($invalidLifeStyleTag)
    {
        $route = route(self::ROUTE_NAME,
            ['life_style_tag' => $invalidLifeStyleTag, 'preferred_types_order' => $this->preferredTypesOrder]
        );
        $response = $this->get($route);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function invalidPreferredTypesOrderProvider()
    {
        return [
            [[]],
            [['invalidPreferredTypes']],
            [[self::PREFERRED_TYPES_CLINIC, 'invalidPreferredTypes']],
        ];
    }

    public function invalidLifeStyleTagProvider()
    {
        return [
            [[]],
            [[self::LIFE_STYLES_TIME, 'invalidLifeStyleTag']],
            [['invalidLifeStyleTag']],
        ];
    }

//    /**
//     * @return array|array[]
//     */
//    public function validPreferredTypesOrderProvider(): array
//    {
//        return $this->getAllValidCases($this->preferredTypesOrder);
//    }
//
//    /**
//     * @return array|array[]
//     */
//    public function validLifeStyleTagProvider(): array
//    {
//        return $this->getAllValidCases($this->lifeStyleTag);
//    }
//
//    /**
//     * 전달받은 리스트들이 하나부터 전체까지 존재하는 경우의 수들을 전부 반환
//     * @param $list
//     * @return array
//     */
//    private function getAllValidCases($list): array
//    {
//        $listCount = count($list);
//
//        return array_map(function ($number) use ($listCount, $list) {
//            $caseList = [];
//            for ($i = 0; $i < $listCount; $i++) {
//                $binaryDigit = pow(2, $listCount - $i - 1);
//                if (intval($number / $binaryDigit) === 1) {
//                    $caseList[] = $list[$i];
//                }
//                $number = $number % $binaryDigit;
//            }
//            return $caseList;
//        }, range(1, pow(2, $listCount) - 1));
//    }
}
