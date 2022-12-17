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
        Schema::create('transfer_balance_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id');
            $table->foreignId('vendor_account_id');
            $table->foreignId('user_account_id');
            $table->string('currency');
            $table->float('amount');
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
        Schema::dropIfExists('transfer_balance_logs');
    }
};
