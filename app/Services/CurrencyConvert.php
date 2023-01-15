<?php

namespace App\Services;

class CurrencyConvert
{

    const RATES = [
        'usd' => [
            'euro' => 0.94
        ],
    ];


    public function convert(float $price, string $from, string $to): float
    {
        $rate = isset(self::RATES[$from][$to]) ?  self::RATES[$from][$to] : 0;
        return round(($price * $rate), 2);
    }
}
