<?php

namespace App\Http\Controllers;

use App\Menu;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function index1()
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


    public function sidebar()
    {
        $user = new User();
//      $menus= DB::table('menus')->pluck('id');
        $menus = Menu::where('id', '>=', 0)->get();
        $data = explode(',', auth()->user()->menu_permitted);
//        $permission = auth()->user()->menu_permitted;

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
        //dd($array);
//        $menus = Menu::where('parent_id', '=', 0)->get();

        return view('partial.sidebar', ['menus' => $menus, 'array' => $array]);
    }

    public function create()
    {

        $roles = Menu::get()->pluck('menu', 'id');
//        $this->authorize('create', 'App\User');
        return view('user.create', ['roles' => $roles]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
//       $this->authorize('create', User::class);
         dd($request->all());

        //dd($request->roles);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->menu_permitted = implode(',', $request->roles);
        $user->password = bcrypt($request->password);
        $user->save();

//        dd(explode(',', $user->menu_permitted));

        return redirect('/');

    }


}
