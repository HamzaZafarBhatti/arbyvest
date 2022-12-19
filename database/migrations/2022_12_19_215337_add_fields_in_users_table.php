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
            $table->string('photo')->nullable();
            $table->date('birthdate')->nullable();
            $table->foreignId('document_type_id')->nullable();
            $table->string('document_pic')->nullable();
            $table->string('selfie')->nullable();
            $table->string('pin')->nullable();
            $table->string('whatsapp_number')->nullable();
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
            $table->dropColumn('photo');
            $table->dropColumn('birthdate');
            $table->dropColumn('document_type_id');
            $table->dropColumn('document_pic');
            $table->dropColumn('selfie');
            $table->dropColumn('pin');
            $table->dropColumn('whatsapp_number');
        });
    }
};
