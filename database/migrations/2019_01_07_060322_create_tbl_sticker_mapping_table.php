<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblStickerMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sticker_mapping', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('sticker',30)->nullable();
            $table->string('center',30)->nullable();
            $table->string('region',30)->nullable();
            $table->string('remarks',30)->nullable();
            $table->dateTime('created_time')->nullable();
            $table->string('created_by',20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_sticker_mapping');
    }
}
