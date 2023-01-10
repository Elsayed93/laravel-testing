<?php

namespace App\Models;

use App\Services\CurrencyConvert;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['euro_price'];

    public function getEuroPriceAttribute()
    {
        return (new CurrencyConvert())->convert($this->price, 'usd', 'euro');
    }
}
