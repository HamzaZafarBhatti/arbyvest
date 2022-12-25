<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'bank_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bank_user()
    {
        return $this->belongsTo(BankUser::class);
    }

    protected function getAmount(): Attribute
    {
        return Attribute::make(
            get: fn($val, $attr) => '₦ '.number_format($attr['amount'],2)
        );
    }
}
