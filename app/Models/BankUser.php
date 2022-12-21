<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class BankUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_id',
        'user_id',
        'account_number',
        'account_type',
        'account_name',
        'status', //1 for primary, 2 for secondary and so on
        'is_active'
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    protected function getFullAccount(): Attribute
    {
        return Attribute::make(
            get: fn ($val, $attr) => $this->bank->name . ' - ' . $attr['account_number']
        );
    }
}
