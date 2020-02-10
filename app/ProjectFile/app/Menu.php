<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
//    public $fillable = ['menu','parent_id'];
    protected $table = 'menus';



    public function menus()
    {
        return $this->hasMany('App\Menu','parent_id','id');
    }

    public function users()
    {
        return $this->hasMany('App\User','menu_permitted');
    }
}
