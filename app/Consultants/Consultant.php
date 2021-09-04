<?php


namespace App\Consultants;


interface Consultant
{
    /**
     * @param bool $isRich
     * @param bool $hasAStrongWill
     * @param bool $hasGoodHealth
     * @param bool $hasEnoughTime
     */
    public function recommend(bool $isRich, bool $hasAStrongWill, bool $hasGoodHealth, bool $hasEnoughTime): string;
}
