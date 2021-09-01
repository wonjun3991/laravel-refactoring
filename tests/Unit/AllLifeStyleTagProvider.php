<?php


namespace Tests\Unit;


trait AllLifeStyleTagProvider
{
    // [false, false, false, false] 부터 [true, true, true, true] 까지 반환
    public function allLifeStyleTagProvider(): array
    {
        $LIFE_STYLE_TAG_COUNT = 4;

        return array_map(function ($number) use ($LIFE_STYLE_TAG_COUNT) {
            $styleTagArray = [];
            for ($i = 0; $i < $LIFE_STYLE_TAG_COUNT; $i++) {
                $binaryDigit = pow(2, $LIFE_STYLE_TAG_COUNT - $i - 1);
                $styleTagArray[] = intval($number / $binaryDigit) === 1;
                $number = $number % $binaryDigit;
            }
            return $styleTagArray;
        }, range(0, 15));
    }
}
