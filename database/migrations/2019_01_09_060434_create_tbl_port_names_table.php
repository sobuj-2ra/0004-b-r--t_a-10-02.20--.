<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPortNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_port_names', function (Blueprint $table) {
           $table->increments('port_id');
            $table->string('port_name', 255)->nullable();
            $table->string('fee', 255)->nullable();
            $table->dateTime('save_time');
            $table->string('service_type', 255)->nullable();
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
        Schema::dropIfExists('tbl_port_names');
    }
}
