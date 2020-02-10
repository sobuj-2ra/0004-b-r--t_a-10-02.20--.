<?php

namespace App\Http\Controllers;

use App\Applicant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;

class ApplicantController extends Controller
{

    public function search()
    {
       // dd($id);


        $q = Input::get('q');

        $users = Applicant::where('passport', $q)->get();
           // ->latest('updated_at')->orderBy('reply_count', 'desc')->get();

        return view('search.search', ['users' => $users]);


    }

//    public function update(Request $request, Quiz $quiz)
//    {
//        $quiz->name = $request->name;
//        $quiz->description = $request->description;
//        $quiz->save();
//        return redirect()->route('quizzes.index');
//    }

    public function store(Request $request ,$id)
    {
        //dd($id);
       // dd($request->all());
        $applicantId = Applicant::find(3);
//        dd($applicantId);

        $dateTime = Carbon::parse($request->recFrmHCI_time);

        $applicantId->recFrmHCI_time = $dateTime->format('Y-m-d H:i:s');
        $applicantId->recFrmHCI_by = auth()->user()->name;
        $applicantId->status = 2;
        $applicantId->save();
        return view('search.search' , ['id'=>$applicantId]);


    }
}
