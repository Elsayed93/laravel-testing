<?php

namespace App\Services;

class CurrencyConvert
{

    const RATES = [
        'usd' => [
            'euro' => 0.94
        ],
    ];


    public function convert(float $price, string $from, string $to) : float
    {
        $rate = self::RATES[$from][$to];
        return round(($price * $rate), 2) ?? 0;
    }
}
