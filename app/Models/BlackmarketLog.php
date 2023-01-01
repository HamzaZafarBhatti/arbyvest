<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlackmarketLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_id',
        'user_id',
        'amount_sold',
        'amount_exchanged',
        'currency',
        'status', //0, 1
        'completed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function getAmountSold(): Attribute
    {
        return Attribute::make(
            get: fn ($val, $attr) => $attr['currency'] . number_format($attr['amount_sold'], 2)
        );
    }
    protected function getAmountExchanged(): Attribute
    {
        return Attribute::make(
            get: fn ($val, $attr) => '₦' . number_format($attr['amount_exchanged'], 2)
        );
    }
}
