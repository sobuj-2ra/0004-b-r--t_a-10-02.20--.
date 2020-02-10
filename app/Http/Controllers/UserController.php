<?php
namespace App\Http\Controllers;
use App\User;
use Hash;
use Auth;
use Redirect;
use Session;
use Validator;
use DB;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::with('role')->get();
    	return view('menu.index', compact('users'));
    }

    public function store(Request $request){
        $user = new User();
        $user->role()->sync($request->role);
    }

public function login(Request $request) {
        $rules = array (
                
                'email' => 'required',
                'password' => 'required' 
        );
        $validator = Validator::make ( Input::all (), $rules );

        if ($validator->fails ()) {
            return Redirect::back ()->withErrors ( $validator, 'login' )->withInput ();
        } else {
            if (Auth::attempt ( array (
                    
                    'name' => $request->get ( 'username' ),
                    'email' => $request->get ( 'email' ),
                    'password' => $request->get ( 'password' ) 
            ) )) {
                $permission = DB::table('users')->where('name', $request->get ( 'username' ))->or_where('email', $request->get ( 'email' ))->first();
                session ( [
                        'name' => $request->get ( 'username' ),
                        'menu_permission' => $permission->menu_permitted
                ] );
                return Redirect::back ();
            } else {
                Session::flash ( 'message', "Invalid Credentials , Please try again." );
                return Redirect::back ();
            }
        }
    }
    public function register(Request $request) {
        $rules = array (
                'email' => 'required|unique:users|email',
                'name' => 'required|unique:users|alpha_num|min:4',
                'password' => 'required|min:6|confirmed' 
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ()) {
            return Redirect::back ()->withErrors ( $validator, 'register' )->withInput ();
        } else {
            $user = new User ();
            $user->name = $request->get ( 'name' );
            $user->email = $request->get ( 'email' );
            $user->password = Hash::make ( $request->get ( 'password' ) );
            $user->remember_token = $request->get ( '_token' );
            
            $user->save ();
            return Redirect::back ();
        }
    }

    public function save_first_user(Request $request){
        $user = new User();
        $user_name = $request->user_id;
        $pass = $request->password;

        if ($user_name == ''){
            $message = "User ID is required !";
        }elseif ($pass == ''){
            $message = "Password is required !";
        }else{
            $menus_id = DB::table('menus')
                ->select('id')
                ->get();
            foreach ($menus_id as $id){
                $menu[]=$id->id;
            }

            $inserted = DB::table('users')->insert(
                [   'name' => 'Admin',
                    'user_id' => $user_name,
                    'center_name' => 'Admin',
                    'center_type' => 'Admin',
                    'password' => bcrypt($pass),
                    'created_at' => date('Y-m-d H:i:s'),
                    'menu_permitted' =>implode(',', $menu),
                    'status' => 1
                ]);

            if ($inserted){
                Session::flash('message', 'Successfully Create User !');
                Session::flash('alert-class', 'btn-info');
            }else{
                Session::flash('message', 'Fail to Added User !');
                Session::flash('alert-class', 'btn-danger');
            }

        }
        return redirect('/login');
    }


    public function logout() {
        Session::flush ();
        Auth::logout ();
        return Redirect::back ();
    }

    public static function check_user(){
        $user_data = DB::table('users')
            ->get();
        return $user_data->count();
    }



}