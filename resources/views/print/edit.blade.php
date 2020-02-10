@extends('admin.master')
<!--Page Title-->
@section('page-title')
    RAPPAP
    @endsection

            <!--Page Header-->
@section('page-header')
    R.A.P. / P.A.P. Approval Edit
    @endsection

            <!--Page Content Start Here-->
@section('page-content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <section class="content">
    <div class="row">
        <div class="col-md-12">
        @if (Session::has('message'))
        <div class="col-md-4 col-md-offset-4" style="padding-top:10px">
        <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4> {{ Session::get('message') }}</h4>
        </div>
        </div>
        @endif
            <div class="main_part">
                <form action="{{route('rap.edit')}}" method="get" role="search">
                {{ csrf_field() }}
                    <div class="passport_search">
                        <input type="search" name="q" value="{{ old('q') }}" placeholder="Passport Search">
                        <button type="submit" class="btn_search">Search</button>
                    </div>
                </form>    
                <div class="result_body">
                    <div class="result_top">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 style="margin-left: 36px"><b>No. DAC/VISA/406/14/2019</b></h4>
                            </div>
                            <div class="col-md-6">
                                <h4 style="float: right;margin-right: 36px"><b><?php echo date('d M Y') ?></b></h4>
                            </div>
                        </div>
                    </div>
                    <div class="result_title">
                        <h4><b>RESTRICTED / PROTECTED AREA PERMIT</b></h4>
                        <h4>Total approved: {{$count}}</h4>
                    </div>
                    <div class="result_table">
                        <table class="table table-bordered">
                            <thead style="background:#ddd">
                                <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Designation / Relation</th>
                                <th>Passport No.</th>
                                <th>Arrival Date</th>
                                <th>Departure Date</th>
                                <th>Accept</th>
                            </tr>
                            </thead>
                            <tbody>
                            <h1 style="display: none">   {{$sno=1}}</h1>
                            <form action="{{url('/update')}}" method="POST" name="device_edit_form">
                            {{csrf_field()}}
                            <input type="hidden" name="masterpass" value="{{$squery}}">
                            @php if(!empty($users)) { @endphp
                            @foreach($users as $user)
                                <tr>
                                <th>{{$sno++}}.</th>
                                <th>{{$user->applicant_name}}</th>
                                <th>{{$user->designation}}</th>
                                <th>{{$user->passport}}</th>
                                <th>{{$user->arrivalDate}}</th>
                                <th>{{$user->departureDate}}</th>
                                <th>
                                    <input type="hidden" name="allval[]" value="{{$user->serial_no}}">
                                    <input type="checkbox" @php if($user->approve_status=='Approved') { @endphp checked @php } @endphp name="accept[]" value="{{$user->serial_no}}"></th>
                                </tr>
                                @endforeach
                                @php } @endphp
                            </tbody>
                        </table>
                    </div>
                    <div class="result_buttom">
                        <div class="row">
                            <div class="col-md-4">
                            <?php if(!empty($users)) { ?>
                            <select class="form-control select_designation" id="select" required="required" name="k">
                                <option value="">Select Designation</option>
                                @foreach($authorities as $id=>$authority)
                                <option value="{{$authority->id}}" {{ ( $authority->name == $UserName ) ? 'selected' : '' }}>{{$authority->name}}</option>
                                @endforeach
                            </select>
                            <?php } ?>
                            <input type="hidden" id="name" name="name">
                            <input type="hidden" id="desi" name="desi">
                            </div>
                            <div class="col-md-2"><span id="result"></span></div>

                            <div class="col-md-2" style="float: right;"><button type="submit" onclick="return confirm('Are you sure to update ?');" class="btn_approved"  name="action" value="save">Save</button></div>
                            <div class="col-md-4" style="float: left;"><button type="submit" id="rePrint" name="action" value="Re-Print" onclick="return confirm('Are you sure to Re-Print ?');" class="btn_approved">Re-print</button></div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



@section('page-script')

    <script  type="text/javascript">

     //   document.forms['device_edit_form'].elements['select'].value = <?php echo $name; ?>


        $(document).ready(function () {
            $( "#select option:selected" ).val();
            $('#select').on('change', function () {

                var id = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({

                    url: './ajax/'+id,


                    type: "POST",

                    dataType: "json",

                    success: function (data) {


                        $.each(data, function (key, value) {
                            $('#name').val(value.name);

                            $('#desi').val(value.designation);
                            $("#result").html(value.designation);



                        });


                    }

                });


            });

        });


    </script>

@endsection

