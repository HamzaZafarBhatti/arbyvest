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
        Schema::create('blackmarket_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id');
            $table->foreignId('user_id');
            $table->float('amount_sold');
            $table->float('amount_exchanged');
            $table->string('currency', 3);
            $table->boolean('status')->default(0);
            $table->dateTime('completed_at');
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
        Schema::dropIfExists('blackmarket_logs');
    }
};
