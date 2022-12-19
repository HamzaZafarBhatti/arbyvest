<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    const USD_SYMBOL = '$';
    const GBP_SYMBOL = '£';
    const NGN_SYMBOL = '₦';
    
    protected $photo_path = 'asset/images/';

    protected $fillable = [
        'name',
        'username',
        'phone',
        'parent_id',
        'email',
        'password',
        'account_id',
        'usd_wallet',
        'gbp_wallet',
        'ngn_wallet',
        'image',
        'is_verified',
        'photo',
        'birthdate',
        'document_type_id',
        'document_pic',
        'selfie',
        'pin',
        'whatsapp_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function getUsdWallet(): Attribute
    {
        return Attribute::make(
            get: fn($val, $attr) => '$ '.$attr['usd_wallet']
        );
    }
    protected function getGbpWallet(): Attribute
    {
        return Attribute::make(
            get: fn($val, $attr) => '£ '.$attr['gbp_wallet']
        );
    }
    protected function getNgnWallet(): Attribute
    {
        return Attribute::make(
            get: fn($val, $attr) => '₦ '.$attr['ngn_wallet']
        );
    }

    public function getPhotoPath()
    {
        return $this->photo_path;
    }

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class);
    }
}
