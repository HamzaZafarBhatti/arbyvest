<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'upline_id',
        'downline_id',
        'amount',
        'currency',
        'type' // 1 => transfer, 2 => flutterwave
    ];

    public function downline()
    {
        return $this->belongsTo(User::class, 'downline_id');
    }

    protected function getAmount(): Attribute
    {
        return Attribute::make(
            get: fn ($val, $attr) => $attr['currency'] . number_format($attr['amount'], 2)
        );
    }
}
