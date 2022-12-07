<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Arbyvest');
            $table->string('site_name')->default('Arbyvest');
            $table->mediumText('site_desc')->default('Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid, illo?');
            $table->string('email')->default('admin@arbyvest.com');
            $table->string('mobile')->default('0123123123');
            $table->string('address')->default('Abc Street, XYZ City, JFK');
            $table->string('favicon')->default('favicon.jpg');
            $table->string('logo')->default('logo.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
