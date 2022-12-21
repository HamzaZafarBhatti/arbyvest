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
        Schema::table('transfer_balance_logs', function (Blueprint $table) {
            //
            $table->string('vendor_account_id');
            $table->string('user_account_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transfer_balance_logs', function (Blueprint $table) {
            //
            $table->dropColumn('vendor_account_id');
            $table->dropColumn('user_account_id');
        });
    }
};
