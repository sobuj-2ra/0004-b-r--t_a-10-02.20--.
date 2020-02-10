<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $table = 'tbl_port_update';
    protected $primaryKey = 'serial_no';
    //public $timestamps = false;
}
