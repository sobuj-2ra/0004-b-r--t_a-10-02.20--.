<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPortUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_port_update', function (Blueprint $table) {
            $table->increments('serial_no');
            $table->string('applicant_name',255);
            $table->string('passport',255);
            $table->string('center',255)->nullable();
            $table->string('visa_no',255);
            $table->string('visa_type',255);
            $table->string('contact',255);
            $table->dateTime('rec_cen_time')->nullable();
            $table->string('rec_cen_by',255)->nullable();
            $table->dateTime('sent2hci_time')->nullable();
            $table->string('sent2hci_by',255)->nullable();
            $table->dateTime('recFrmHCI_time')->nullable();
            $table->string('recFrmHCI_by',255)->nullable();
            $table->dateTime('ready_cen_time')->nullable();
            $table->string('ready_cen_by',100)->nullable();
            $table->dateTime('del2app_time')->nullable();
            $table->string('del2app_by',255)->nullable();
            $table->string('status',255)->nullable();
            $table->string('arrivalDate',255)->nullable();
            $table->string('derpartureDate',255)->nullable();
            
            $table->dateTime('uploadTime')->nullable();
            $table->string('region',200)->nullable();
            $table->string('Remarks',300);
            $table->string('Fee',50);
            $table->string('OldPort',500);
            $table->string('NewPort', 500);
            $table->string('sticker',50);
            $table->string('ServiceType',100);
            $table->string('MasterPP',255);
            $table->dateTime('updated_at');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_port_update');
    }
}
