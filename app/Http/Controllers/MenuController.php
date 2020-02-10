<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Nexmo\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission_level = DB::table('users')->where('id', Auth::user()->id)->first();
        $permission_id = explode(",", $permission_level->menu_permitted);
        $menus = DB::table('menus')->where('parent_id', '=', 0)->get();
        $j = 0;
        foreach ($menus as $menu) {
            $menus[$j]->sub_menu = DB::table('menus')
                ->where('parent_id', $menu->id)
                ->where('sub_id', 0)
                ->orderBy('id', 'asc')
                ->get();
            $j++;
        }
        foreach ($menus as $menu_data) {
            $i = 0;
            foreach ($menu_data->sub_menu as $item) {
//                    var_dump($item->parent_id);
                $menu_data->sub_menu[$i]->child_menu = DB::table('menus')
//                        ->where('parent_id', $item->parent_id)
                    ->where('sub_id', $item->id)
                    ->orderBy('id', 'asc')
                    ->get();
                $i++;
                //var_dump($child_menu);
            }
        }
		
		
        return view('menu.index', ['settings' => $menus]);
    }


    public function check_menu($id){

        return $settings = DB::table('menus')
            ->where('parent_id', $id)
//            ->where('url_link', '!=', '#')
            ->orderBy('id', 'asc')
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = DB::table('menus')->where('parent_id', 0)->get();
        $center_type = DB::table('tbl_center_type')->get();
        return view('menu.create', compact('menus','center_type'));
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
        $sub_menu = $request->sub;
        $url_link = $request->url_link;

        $check = DB::table('menus')
            ->where('menu', 'like', $sub_menu)
            ->first();
        if (isset($check) && !empty($check)){
            $sub_id = $check->id;
            $menu->parent_id = $request->parent_id;
            $menu->sub_id = $sub_id;
            $menu->url_link = $request->url_link;
            $menu->menu = $request->menu;
            if (isset($request->center_type) && !empty($request->center_type)){
                $menu->center_type = implode(',', $request->center_type);
            }else{
                $menu->center_type = '';
            }

            $menu->created_at = date('Y-m-d H:i:s');
            $inserted = $menu->save();
            if ($inserted) {
                Session::flash('message', 'Successfully Added Child Menu !');
                Session::flash('alert-class', 'btn-info');
            } else {
                Session::flash('message', 'Fail to Added Child Menu !');
                Session::flash('alert-class', 'btn-danger');
            }
            return redirect('/menu/create');

        }else{
            $menu->parent_id = $request->parent_id;
            $menu->sub_id = 0;
            $menu->url_link = $request->url_link;
            $menu->menu = $request->sub;
            if (isset($request->center_type) && !empty($request->center_type)){
                $menu->center_type = implode(',', $request->center_type);
            }else{
                $menu->center_type = '';
            }

            $menu->created_at = date('Y-m-d H:i:s');
            $inserted = $menu->save();
            if ($inserted) {
                Session::flash('message', 'Successfully Added Sub Menu !');
                Session::flash('alert-class', 'btn-info');
            } else {
                Session::flash('message', 'Fail to Added Sub Menu !');
                Session::flash('alert-class', 'btn-danger');
            }
            return redirect('/menu/create');
        }

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


    public function search_sub_menu(Request $request){
        $ids = $_GET['id'];
        $keyword = $_GET['keyword'];
        $sub_menu = DB::table('menus')->where('parent_id', $ids)->where('sub_id', 0)->where('url_link', '#')->get();
        return response()->json($sub_menu);
    }
}
