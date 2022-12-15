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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('account_id')->nullable();
            $table->float('usd_wallet')->default(0);
            $table->float('gbp_wallet')->default(0);
            $table->float('ngn_wallet')->default(0);
            $table->boolean('is_verified')->default(0);
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('account_id');
            $table->dropColumn('usd_wallet');
            $table->dropColumn('gbp_wallet');
            $table->dropColumn('ngn_wallet');
            $table->dropColumn('is_verified');
            $table->dropColumn('image');
        });
    }
};
