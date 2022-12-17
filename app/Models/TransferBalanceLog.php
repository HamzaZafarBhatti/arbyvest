<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferBalanceLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_id',
        'vendor_account_id',
        'user_account_id',
        'currency',
        'amount'
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_account_id', 'account_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_account_id', 'account_id');
    }
}
