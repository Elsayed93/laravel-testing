<?php

namespace Tests\Unit;

use App\Services\CurrencyConvert;
use PHPUnit\Framework\TestCase;

class CurrencyConverterTest extends TestCase
{
    public function test_convert_from_usd_to_euro()
    {
        $result =  (new CurrencyConvert())->convert(100, 'usd', 'euro');

        $this->assertEquals(94, $result);
    }

    public function test_convert_from_usd_to_currency_not_exist_in_settings()
    {
        $result =  (new CurrencyConvert())->convert(100, 'usd', 'egp');

        $this->assertEquals(0, $result);
    }
}
