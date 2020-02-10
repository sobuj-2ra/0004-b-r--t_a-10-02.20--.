<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index (){
        return view('site.index');

    }

    public function sidebar()
    {
        $menus = Menu::where('parent_id', '=', 0)->get();
        $all = Menu::pluck('menu','id')->all();
        return view('sidebar.sidebar', compact('menus','all'));
    }
}
