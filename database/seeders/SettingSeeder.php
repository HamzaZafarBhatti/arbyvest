<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Setting::create([
            'title' => 'Arbyvest',
            'site_name' => 'Arbyvest',
            'site_desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid, illo?',
            'email' => 'admin@arbyvest.com',
            'mobile' => '0123123123',
            'address' => 'Abc Street, XYZ City, JFK',
            'favicon' => 'favicon.jpg',
            'logo' => 'logo.png'
        ]);
    }
}
