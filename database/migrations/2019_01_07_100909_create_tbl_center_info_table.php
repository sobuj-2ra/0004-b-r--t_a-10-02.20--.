<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCenterInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_center_info', function (Blueprint $table) {
           
            $table->increments('centerinfo_id');
            $table->string('sp_fee')->nullable();
            $table->string('proc_fee')->nullable();
            $table->string('center_name', 255)->nullable();
            $table->string('center_phone', 255)->nullable();
            $table->string('center_fax', 255)->nullable();
            $table->string('center_web', 255)->nullable();
            $table->string('modify_by', 255)->nullable();
            $table->dateTime('modify_date')->nullable();
            $table->string('delivery_lead',255)->nullable();
            $table->dateTime('del_time')->nullable();
            $table->string('slip_copy',)->nullable();
            $table->string('sticker_symbol',100)->nullable();
            $table->string('center_info',255)->nullable();
            $table->string('center_type',255)->nullable();
            $table->string('region',255)->nullable();
            $table->string('corr_fee',255)->nullable();
            $table->string('port_lead',255)->nullable();
            $table->string('port_copy',255)->nullable();
            $table->string('letter_head',255)->nullable();
            $table->string('letter_sub',255)->nullable();
            $table->string('letter_body',255)->nullable();
            $table->string('letter_footer',255)->nullable();
            $table->string('port_fee',255)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_center_info');
    }
}
