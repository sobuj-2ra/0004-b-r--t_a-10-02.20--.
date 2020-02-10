<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblVisaTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_visa_type', function (Blueprint $table) {
            $table->increments('visa_type_id');
            $table->string('visa_type', 255)->nullable();
            $table->string('symbol', 255)->nullable();
            $table->string('days', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_visa_type');
    }
}
