@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Add SBI Branch Name
@endsection

<!--Page Header-->
@section('page-header')
    Add SBI Branch Name & Address
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>
                    @if(Session::has('message'))
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
                        </div>
                @endif
                <!-- Code Here.... -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="change_passport_body" style="width: 100% !important;">
                                <p class="form_title_center">
                                    <i>- Add SBI Branch Name & Address-</i>
                                </p>
                                <form action="{{URL::to('/store-branch-name')}}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>Center Type:</i></label>
                                        <select class="form-control" name="center_type" required>
                                            <option value="">Select Item</option>
                                            @foreach ($centers as $center)
                                                <option value="{{ $center->center_type }}"> {{ $center->center_type }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="form_date"><i>SBI Branch Name:</i></label>
                                            <input type="text" class="form-control" name="branch_name" value=""
                                                   autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>SBI Branch Address:</i></label>
                                        <input type="text" class="form-control" name="address" value=""
                                               autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>SBI Branch Phone:</i></label>
                                        <input type="text" class="form-control" name="phone" value=""
                                               autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>SBI Branch Fax:</i></label>
                                        <input type="text" class="form-control" name="fax" value="" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>SBI Branch Email:</i></label>
                                        <input type="text" class="form-control" name="email" value=""
                                               autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>Enquiry Phone:</i></label>
                                        <input type="text" class="form-control" name="enquery_phone" value=""
                                               autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>Enquiry Email:</i></label>
                                        <input type="text" class="form-control" name="enquery_email" value=""
                                               autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="form_date"><i>Manager Signature:(200px X 55px)</i></label>
                                        <input type="file" name="manager_signature" id="fileToUpload">
                                    </div>
                                    <hr>
                                    <div class="footer-box col-md-3">
                                        <button type="submit" id="submit" class="btn btn-info pull-left">STORE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="table_view" style="padding: 10px">
                                <div class="panel-body">
                                    <table width="100%" class="table-bordered table" style="font-size:13px;">
                                        <thead style="background:#ddd">
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col">Center Tye</th>
                                            <th scope="col">Branch Name</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Fax</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Enquiry Phone</th>
                                            <th scope="col">Enquiry Email</th>
                                            <th scope="col">Signature</th>

                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($names as $center)
                                            <?php $i++; ?>
                                            <tr>
                                                <th scope="row">{{$i}}</th>
                                                <td>{{$center->center_type}}</td>
                                                <td>{{$center->branch_name}}</td>
                                                <td>{{$center->address}}</td>
                                                <td>{{$center->phone}}</td>
                                                <td>{{$center->fax}}</td>
                                                <td>{{$center->email}}</td>
                                                <td>{{$center->enquery_phone}}</td>
                                                <td>{{$center->enquery_email}}</td>
                                                <?php if (isset($center->manager_signature)){ ?>
                                                <td><img src="{{asset('public/uploads/').'/'.$center->manager_signature}}" width="75px" height="55px"> </td>
                                                <?php }else{ ?>
                                                <td> </td>
                                                <?php } ?>


                                                <td>
                                                    <a href="{{URL::to('/edit-branch/'.$center->id)}}">
                                                        <button class="btn btn-warning">Edit</button>
                                                    </a>
                                                    <a href="{{URL::to('/delete-branch/'.$center->id)}}">
                                                        <button class="btn btn-danger">Delete</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <!-- /.table-responsive -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>
@endsection