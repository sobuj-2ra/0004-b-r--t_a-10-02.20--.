<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Nexmo\User\User;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new User();


        $menus = Menu::where('parent_id', '=', 0)->get();
        $data = explode(',', auth()->user()->menu_permitted);
//dd($data);

        $all = Menu::where('id', '>=', 0)->pluck('id')->toArray();
//        dd($all);
        $array = array();
        foreach ($data as $id) {
            // dd($id);
//            dd(in_array($id,$all));
            if (in_array($id, $all)) {
                $array[] = $id;
//                dd($array);

            }

        }
        $array;
        return view('menu.index', compact('menus', 'array'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();
        return view('menu.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = new Menu();
        $menu->menu = $request->menu;
        $menu->url_link = $request->url_link;
        if ($request->parent_id) {
            $menu->parent_id = $request->parent_id;
        }
        $menu->save();
        return redirect('menu/index');
    }


    public function index1()
    {
        $menus = Menu::where('parent_id', '=', 0)->get();
//        $all = Menu::pluck('menu','id')->all();
        return view('partial.sidebar', compact('menus'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
