<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index (){
        return view('worker.index');

    }

//    public function sidebar()
//    {
//        $menus = Menu::where('parent_id', '=', 0)->get();
//        $all = Menu::pluck('menu','id')->all();
//        return view('partial.sidebar', compact('menus','all'));
//    }
}
