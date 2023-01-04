<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $logo_path = 'asset/images/';
    protected $favicon_path = 'asset/images/';

    protected $fillable = [
        'title',
        'site_name',
        'site_desc',
        'email',
        'mobile',
        'address',
        'favicon',
        'logo',
        'withdraw_fee',
        'min_withdrawal',
        'max_withdrawal',
        'usd_black_market_counter',
        'gbp_black_market_counter',
        'usd_referral_bonus',
        'gbp_referral_bonus',
    ];

    public function getLogoPath()
    {
        return $this->logo_path;
    }

    public function getFaviconPath()
    {
        return $this->favicon_path;
    }
}
