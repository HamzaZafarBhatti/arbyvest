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
