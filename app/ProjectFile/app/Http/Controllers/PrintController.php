<?php

namespace App\Http\Controllers;

use App\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PrintController extends Controller
{

    public function index( ){
        $q = Input::get('q');

        $users = Applicant::where('passport', $q)->where('masterPP','=',1)->get();
        // ->latest('updated_at')->orderBy('reply_count', 'desc')->get();

        return view('print.print', ['users' => $users]);

    }

}
