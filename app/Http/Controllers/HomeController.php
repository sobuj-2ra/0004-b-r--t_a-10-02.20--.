<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Tbl_visa_type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use Hash;
use Crypt;

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
//        $curDate = Date('Y-m-d');
//        $updateCheck = Tbl_visa_type::whereDate('update_date',$curDate)->get();
//        if(count($updateCheck) < 1){
//            $tdd_lists = DB::select('CALL getDelDate(" ")');
//            $curDate = Date('Y-m-d h:i:s');
//            foreach($tdd_lists as $tdd){
//                Tbl_visa_type::where('visa_type',$tdd->visaType)->update(['tdd'=>$tdd->DELIVERY,'update_date'=>$curDate]);
//            }
//        }

        return view('admin.home.homeContent');
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
        $data = array();
        $centers = DB::table('tbl_center_type')
            ->get();

        $permission_level = DB::table('users')->where('id', Auth::user()->id)->first();
        $center_t = DB::table('tbl_center_type')->get();
        $permission_id = explode(",", $permission_level->menu_permitted);
        $menus = DB::table('menus')->where('parent_id', '=', 0)->get();
        $j = 0;
        foreach ($menus as $menu) {
            $menus[$j]->sub_menu = DB::table('menus')
                ->whereIn('id', $permission_id)
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
                    ->whereIn('id', $permission_id)
                    ->where('sub_id', $item->id)
                    ->orderBy('id', 'asc')
                    ->get();
                $i++;
                //var_dump($child_menu);
            }
        }



        $roles = Menu::get()->pluck('menu', 'id');
        return view('user.create', ['roles' => $roles, 'settings' => $menus, 'centers' => $centers, 'center_type'=>$permission_level->center_type, 'center_name'=>$permission_level->center_name,'center_t'=>$center_t]);


//        $this->authorize('create', 'App\User');

//        if (auth()->user()->name == 'Admin') {


//            return view('user.create', ['roles' => $roles, 'settings' => $settings, 'operations' => $operations, 'reports' => $reports]);
//            return view('user.create', ['roles' => $roles],$data);
//        } else {
//            return redirect('/');
//        }


    }

    public function check_menu($id)
    {

        return $settings = DB::table('menus')
            ->where('parent_id', $id)
//            ->where('url_link', '!=', '#')
            ->orderBy('id', 'asc')
            ->get();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if ($request->password == $request->cfmPassword){
            $user = new User();
            $user->name = $request->name;
            $user_id = $request->user_id;
            $new_email = $request->email;

            $new_uname = $user_id;

            $existUser = DB::table('users')->select('user_id')->where('user_id', $user_id)->get();


            // print_r( $existEmail ); exit;

            if (count($existUser) > 0) {

                $exist_user = $existUser[0]->user_id;

                if ($exist_user == $new_uname) {
                    Session::flash('message', 'User ID name already exist!');
                    Session::flash('alert-class', 'btn-danger');
                }

                return redirect("/create");

            } else {
                $user->name = $request->name;
                $user->remember_token = $request->_token;
                $user->user_id = $request->user_id;
                $user->center_type = $request->center_type;
                $user->center_name = $request->center_name;
                $user->sbi_branch_name = $request->branch_name;
                $user->status = 1;
                $user->created_by = Auth::user()->id;
                $user->created_at = date('Y-m-d H:i:s');


                if (!empty($request->permission))
                    $user->menu_permitted = $request->permission;
                $user->password = bcrypt($request->password);
                $user->save();

                Session::flash('message', 'New user created successfully !');
                Session::flash('alert-class', 'btn-info');

                return redirect("/create");
            }
        }else{
            Session::flash('message', 'Password And Confirm Password Does Not Match !');
            Session::flash('alert-class', 'btn-danger');
            return redirect("/create");
        }


    }

    public function user_list()
    {
        $data =array();
        $permission_level = DB::table('users')->where('id', Auth::user()->id)->first();
        //return $permission_level->center_name;
        if ($permission_level->center_type == 'Admin'){
            $data['users_list'] = DB::table('users')
                ->orderBy('id', 'asc')
                ->get();
        }else{
            $data['users_list'] = DB::table('users')
                ->where('center_name', '!=', 'Admin')
                ->where('center_type', '!=', 'Admin')
                ->orderBy('id', 'asc')
                ->get();
        }


        return view('user.list', $data);
    }

    public function search_center_name()
    {
        $keyword = $_GET['keyword'];
        $data = DB::table('tbl_center_info')->where('center_type', $keyword)->get();
        return response()->json($data);
    }

    public function search_branch_name(){
        $keyword = $_GET['keyword'];
        $data = DB::table('tbl_sbi_branch')->where('center_type', $keyword)->get();
        return response()->json($data);
    }

    public function search_menu_permission()
    {
        $keyword = $_GET['keyword'];
        //$data = DB::table('menus')->where('center_type', 'like', '%' . $keyword . '%')->get();
        //return response()->json($data);

        $menus = DB::table('menus')->where('parent_id', '=', 0)->get();
        $j = 0;
        foreach ($menus as $menu) {
            $menus[$j]->sub_menu = DB::table('menus')
                ->where('center_type', 'like', '%' . $keyword . '%')
                ->where('parent_id', $menu->id)
                ->where('sub_id', 0)
                ->orderBy('id', 'asc')
                ->get();
            $j++;
        }
        foreach ($menus as $menu_data) {
            $i = 0;
            foreach ($menu_data->sub_menu as $item) {
                $menu_data->sub_menu[$i]->child_menu_for_search = DB::table('menus')
                    ->where('center_type', 'like', '%' . $keyword . '%')
                    ->where('sub_id', $item->id)
                    ->orderBy('id', 'asc')
                    ->get();
                $i++;
            }
        }
        return response()->json($menus);

    }

    public function delete_user($id){
        $data = DB::table('users')
            ->where('id', $id)
            ->delete();

        if ($data){
            Session::flash('message', 'Successfully Deleted User !');
            Session::flash('alert-class', 'btn-info');
        }else{
            Session::flash('message', 'Fail to Delete User !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/user-list');
    }

    public function edit_user($id){
        $edit_data = DB::table('users')->where('id', $id)->first();
        $keyword = $edit_data->center_type;
        $parent_permission = DB::table('users')->where('id', Auth::user()->id)->first();
        $permission_id = explode(",", $edit_data->menu_permitted);
        $permission = explode(",", $parent_permission->menu_permitted);
        $menus = DB::table('menus')->where('parent_id', '=', 0)->get();
        if ($edit_data->center_type == 'Admin'){
            $j = 0;
            foreach ($menus as $menu) {
                $menus[$j]->sub_menu = DB::table('menus')
                    ->whereIn('id', $permission_id)
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
                        ->whereIn('id', $permission_id)
                        ->where('sub_id', $item->id)
                        ->orderBy('id', 'asc')
                        ->get();
                    $i++;
                    //var_dump($child_menu);
                }
            }
        }else{
            $j = 0;
            foreach ($menus as $menu) {
                $menus[$j]->sub_menu = DB::table('menus')
                    ->whereIn('id', $permission)
                    ->where('center_type', 'like', '%' . $keyword . '%')
                    ->where('parent_id', $menu->id)
                    ->where('sub_id', 0)
                    ->orderBy('id', 'asc')
                    ->get();
                $j++;
            }
            foreach ($menus as $menu_data) {
                $i = 0;
                foreach ($menu_data->sub_menu as $item) {
                    $menu_data->sub_menu[$i]->child_menu = DB::table('menus')
                        ->whereIn('id', $permission)
                        ->where('center_type', 'like', '%' . $keyword . '%')
                        ->where('sub_id', $item->id)
                        ->orderBy('id', 'asc')
                        ->get();
                    $i++;
                }
            }
        }



        return view('user.edit_user', ['edit_data'=>$edit_data, 'settings' => $menus,'permission_id' =>$permission_id]);
    }

    public function update_user(Request $request){
        $id = $request->input('u_id');
        $user_id = $request->input('user_id');
        $name = $request->input('name');
        $center_type = $request->input('center_type');
        $center_name = $request->input('center_name');
        $paas = $request->input('password');
        $cfmPassword = $request->input('cfmPassword');

        $permission = implode(',', $request->input('id'));

        if (isset($paas) && !empty($paas)){
            $password = bcrypt($paas);
            if($paas == $cfmPassword)
            {
                $updated = DB::table('users')
                    ->where('id', $id)
                    ->update([
                        'user_id' => $user_id,
                        'name' => $name,
                        'center_type' => $center_type,
                        'center_name' => $center_name,
                        'password' => $password,
                        'menu_permitted' => $permission,
                        'status' => 1,
                        'updated_by' => Auth::user()->id,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);

                if ($updated){
                    Session::flash('message', 'Successfully Updated Data !');
                    Session::flash('alert-class', 'btn-info');
                }else{
                    Session::flash('message', 'Fail to Update Data !');
                    Session::flash('alert-class', 'btn-danger');
                }
                return redirect('/user-list');
            }else{
                Session::flash('message', 'Password & Confirm Password does not Match!');
                Session::flash('alert-class', 'btn-danger');
                return redirect('/edit_user/'.$id);
            }
        }else{
            $updated = DB::table('users')
                ->where('id', $id)
                ->update([
                    'user_id' => $user_id,
                    'name' => $name,
                    'center_type' => $center_type,
                    'center_name' => $center_name,
                    'menu_permitted' => $permission,
                    'status' => 1,
                    'updated_by' => Auth::user()->id,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

            if ($updated){
                Session::flash('message', 'Successfully Updated Data !');
                Session::flash('alert-class', 'btn-info');
            }else{
                Session::flash('message', 'Fail to Update Data !');
                Session::flash('alert-class', 'btn-danger');
            }
            return redirect('/user-list');
        }
    }

    public function change_password(){
        $data = array();
        $data['user_data'] = DB::table('users')
            ->where('id', '=', Auth::user()->id)
            ->first();

        return view('user.change_password', $data);
    }

    public function search_old_password(){
        $keyword = $_GET['keyword'];
        $current_password= Auth::user()->password;
        if(Hash::check($keyword, $current_password))
        {
            $data = true;
        }else{
            $data = false;
        }
        return response()->json($data);
    }

    public function password_changed(Request $request){

        $user_data = DB::table('users')
            ->where('id', '=', Auth::user()->id)
            ->first();
        $current_password= Auth::user()->password;
        if (Hash::check($request->input('old_password'), $current_password)){
            if ($request->input('password') == $request->input('cfmPassword')){
                $updated = DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update([
                        'password' => bcrypt($request->input('password')),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                if ($updated){
                    Session::flash('message', 'Successfully Updated Password !');
                    Session::flash('alert-class', 'btn-info');
                }else{
                    Session::flash('message', 'Fail to Updated Password !');
                    Session::flash('alert-class', 'btn-danger');
                }
            }else{
                Session::flash('message', 'New Password And Confirm Password Does Not Match!');
                Session::flash('alert-class', 'btn-danger');
            }

        }else{
            Session::flash('message', 'Old Password Does Not Match !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/change-password');
    }


}