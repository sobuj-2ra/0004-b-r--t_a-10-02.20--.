<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use PHPUnit\Framework\Constraint\IsTrue;
use Session;
use Auth;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['centers'] = DB::table('tbl_center_type')->get();
        $data['names'] = DB::table('tbl_sbi_branch')->get();
        return view('branch.add_branch', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('manager_signature')) {
            $validator = \Validator::make($request->all(),[
                "manager_signature" => "dimensions:width=220,height=55",
            ]);

            if ($validator->fails()) {
                Session::flash('message', "Image Size doesn't match (220X55) !");
                Session::flash('alert-class', 'btn-danger');
                return redirect('/branch-name');
            }else{
                $image = $request->input('manager_signature');
                $photo = $request->file('manager_signature')->getClientOriginalName();
                $ext = $request->file('manager_signature')->getClientOriginalExtension();
                $photo = uniqid('img_') . '.' . $ext;
                $destination = base_path() . '/public/uploads';
                $request->file('manager_signature')->move($destination, $photo);

            }

        }
        if (isset($photo) && !empty($photo)) {
            $file_name = $photo;
        } else {
            $file_name = NULL;
        }
        $center_type = $request->input('center_type');
        $branch_name = $request->input('branch_name');

        $inserted = DB::table('tbl_sbi_branch')->insert(
            ['branch_name' => $branch_name,
                'center_type' => $center_type,
                'address' => $request->address,
                'phone' => $request->phone,
                'fax' => $request->fax,
                'email' => $request->email,
                'enquery_phone' => $request->enquery_phone,
                'enquery_email' => $request->enquery_email,
                'manager_signature' => $file_name,
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->user_id
            ]);

        if ($inserted) {
            Session::flash('message', 'Successfully Added Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Added Data !');
            Session::flash('alert-class', 'btn-danger');
        }

        return redirect('/branch-name');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();
        $data['branch'] = DB::table('tbl_sbi_branch')->where('id', $id)->first();
        return view('branch.edit_branch', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->hasFile('manager_signature')) {
            $validator = \Validator::make($request->all(),[
                "manager_signature" => "dimensions:width=220,height=55",
            ]);

            if ($validator->fails()) {
                Session::flash('message', "Image Size doesn't match (220X55) !");
                Session::flash('alert-class', 'btn-danger');
                return redirect('/branch-name');
            }else{
                $image = $request->input('manager_signature');
                $photo = $request->file('manager_signature')->getClientOriginalName();
                $ext = $request->file('manager_signature')->getClientOriginalExtension();
                $photo = uniqid('img_') . '.' . $ext;
                $destination = base_path() . '/public/uploads';
                $request->file('manager_signature')->move($destination, $photo);

            }

        }

        $id = $request->input('id');

        if (isset($photo) && !empty($photo)) {
            $file_name = $photo;
        } else {
            $get_image = DB::table('tbl_sbi_branch')
                ->where('id', $id)
                ->first();
            $file_name = $get_image->manager_signature;
        }
        $center_typee = $request->input('center_type');
        $branch = $request->input('branch_name');
        $updated = DB::table('tbl_sbi_branch')
            ->where('id', $id)
            ->update([
                'center_type' => $center_typee,
                'branch_name' => $branch,
                'address' => $request->address,
                'phone' => $request->phone,
                'fax' => $request->fax,
                'email' => $request->email,
                'enquery_phone' => $request->enquery_phone,
                'enquery_email' => $request->enquery_email,
                'manager_signature' => $file_name,
                'updated_date' => date('Y-m-d H:i:s'),
                'updated_by' => Auth::user()->user_id
            ]);

        if ($updated) {
            Session::flash('message', 'Successfully Updated Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Update Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/branch-name');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('tbl_sbi_branch')
            ->where('id', $id)
            ->delete();

        if ($data) {
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Delete Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/branch-name');
    }


    // Account type

    public function add_account_type()
    {
        $data = array();
        $data['services'] = DB::table('tbl_ivac_services')->get();
        $data['names'] = DB::table('tbl_account_type')->orderBy('id', 'desc')->get();
        $data['branches'] = DB::table('tbl_sbi_branch')->get();
        return view('account.add_account_type', $data);
    }

    public function store_account_name(Request $request)
    {
        $inserted = DB::table('tbl_account_type')->insert(
            ['ivac_service' => $request->ivac_service,
                'sbi_branch' => $request->sbi_branch,
                'account_name' => $request->account_name,
                'account_no' => $request->account_no,
                'created_date' => date('Y-m-d H:i:s'),
                'create_by' => Auth::user()->user_id
            ]);

        if ($inserted) {
            Session::flash('message', 'Successfully Added Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Added Data !');
            Session::flash('alert-class', 'btn-danger');
        }

        return redirect('/account-type');
    }

    public function delete_account_name($id)
    {
        $data = DB::table('tbl_account_type')
            ->where('id', $id)
            ->delete();

        if ($data) {
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Delete Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/account-type');
    }

    public function edit_account_name($id)
    {
        $data = array();
        $data['account'] = DB::table('tbl_account_type')->where('id', $id)->first();
        $data['services'] = DB::table('tbl_ivac_services')->get();
        $data['branches'] = DB::table('tbl_sbi_branch')->get();
        return view('account.edit_account', $data);
    }

    public function update_account_name(Request $request)
    {
        $id = $request->input('id');
        $updated = DB::table('tbl_account_type')
            ->where('id', $id)
            ->update([
                'ivac_service' => $request->ivac_service,
                'sbi_branch' => $request->sbi_branch,
                'account_name' => $request->account_name,
                'account_no' => $request->account_no,
                'updated_date' => date('Y-m-d H:i:s'),
                'create_by' => Auth::user()->user_id
            ]);

        if ($updated) {
            Session::flash('message', 'Successfully Updated Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Update Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/account-type');
    }

    public function add_commission()
    {
        $data = array();
        $data['names'] = DB::table('tbl_commission')->orderBy('id', 'desc')->get();
        return view('commission.add_commission', $data);
    }

    public function store_commission(Request $request)
    {
        $inserted = DB::table('tbl_commission')->insert(
            ['ivac_service' => $request->ivac_service,
                'commission' => $request->commission,
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->user_id
            ]);

        if ($inserted) {
            Session::flash('message', 'Successfully Added Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Added Data !');
            Session::flash('alert-class', 'btn-danger');
        }

        return redirect('add-commission');
    }

    public function delete_commission($id)
    {
        $data = DB::table('tbl_commission')
            ->where('id', $id)
            ->delete();

        if ($data) {
            Session::flash('message', 'Successfully Deleted Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Delete Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/add-commission');
    }

    public function edit_commission($id)
    {
        $data = array();
        $data['commission'] = DB::table('tbl_commission')->where('id', $id)->first();
        return view('commission.edit_commission', $data);
    }

    public function update_commission(Request $request)
    {
        $id = $request->input('id');
        $updated = DB::table('tbl_commission')
            ->where('id', $id)
            ->update([
                'ivac_service' => $request->ivac_service,
                'commission' => $request->commission,
                'updated_date' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->user_id
            ]);

        if ($updated) {
            Session::flash('message', 'Successfully Updated Data !');
            Session::flash('alert-class', 'btn-info');
        } else {
            Session::flash('message', 'Fail to Update Data !');
            Session::flash('alert-class', 'btn-danger');
        }
        return redirect('/add-commission');
    }


}
