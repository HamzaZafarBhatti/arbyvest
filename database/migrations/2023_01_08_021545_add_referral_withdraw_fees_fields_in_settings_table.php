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
        Schema::table('settings', function (Blueprint $table) {
            //
            $table->integer('referral_withdraw_fee')->default(0);
            $table->integer('min_withdrawal_referral')->default(0);
            $table->integer('max_withdrawal_referral')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
            $table->dropColumn('referral_withdraw_fee');
            $table->dropColumn('min_withdrawal_referral');
            $table->dropColumn('max_withdrawal_referral');
        });
    }
};
