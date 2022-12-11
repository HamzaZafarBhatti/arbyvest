<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
}
