<?php

namespace Tests\Feature;

use App\Consultants\LifeStyleTag;
use App\Consultants\PreferredType;
use Illuminate\Http\Response;
use Tests\TestCase;

class FatControllerTest extends TestCase
{
    const ROUTE_NAME = 'refactoring';

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
            ['life_style_tag' => LifeStyleTag::toValues(), 'preferred_types_order' => PreferredType::toValues()]
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
            ['life_style_tag' => LifeStyleTag::toValues(), 'preferred_types_order' => $invalidPreferredTypesOrder]
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
            ['life_style_tag' => $invalidLifeStyleTag, 'preferred_types_order' => PreferredType::toValues()]
        );
        $response = $this->get($route);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function invalidPreferredTypesOrderProvider()
    {
        return [
            [[]],
            [['invalidPreferredTypes']],
            [[PreferredType::CLINIC()->value, 'invalidPreferredTypes']],
        ];
    }

    public function invalidLifeStyleTagProvider()
    {
        return [
            [[]],
            [[LifeStyleTag::TIME()->value, 'invalidLifeStyleTag']],
            [['invalidLifeStyleTag']],
        ];
    }
}
