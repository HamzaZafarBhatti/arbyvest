<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MarketPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_name',
        'symbol',
        'local_rate',
        'black_market_rate',
        'is_active'
    ];

    protected function currency(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attr) {
                return $attr['symbol'] . ' ' . $attr['currency_name'];
            }
        );
    }

    protected function getLocalRate(): Attribute
    {
        return Attribute::make(
            get: fn($val, $attr) => '₦ '.$attr['local_rate']
        );
    }

    protected function getBlackMarketRate(): Attribute
    {
        return Attribute::make(
            get: fn($val, $attr) => '₦ '.$attr['black_market_rate']
        );
    }
}
