@extends('admin.master')
<!--Page Title-->
@section('page-title')
    RAPPAP
    @endsection

            <!--Page Header-->
@section('page-header')
    R.A.P. / P.A.P. Approval
    @endsection

            <!--Page Content Start Here-->
@section('page-content')

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    {{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}
    <div>
        <br>

        <form action="{{route('print')}}" method="get" role="search">
            {{ csrf_field() }}
            <div class="input-group col-md-4 ">

                <input type="text" class="form-control" name="q" value="{{ old('q') }}"
                       placeholder="Search passport Number"> <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>



                </span>

            </div>
        </form>

    </div>

    <div class="row">


        <div class="col-md-6 ">
            <h4><b>No. DAC/VISA/406/14/2019</b></h4>
        </div>
        <div class="col-md-6 pull-right ">
            <h4 align="center"><b>{{$currentDate}}</b></h4>
        </div>

    </div>

    <div>
        <h4 class="col-xs-offset-3"><b>RESTRICTED / PROTECTED AREA PERMIT</b></h4>
        {{--<h4 class="col-xs-offset-4"><b>(DAC/RAP/PAP/{{$currentDate}}-{{$count}})</b></h4>--}}
    </div>

    {{--<div class="col-xs-offset-1">(Under paragraph 3 & 4 of the Foreigners Restricted Areas Order,1963 as amended)--}}
    {{--</div>--}}
    <br>

    {{--{{dd($pay->serial_no)}}--}}


    <div class="col-md-10">

        <table border="1">
            <thead class="text-center">
            <tr>

                <th width="3%">S.No.</th>
                <th width="8%" class="text-center">Name</th>
                <th width="10%" colspan="1" class="text-center">Designation / Relation</th>
                <th width="15%" colspan="2" class="text-center">Passport No.</th>
                <th width="7%" colspan="3" class="text-center">Arrival Date</th>
                <th width="5%" colspan="3" class="text-center">Departure Date</th>
                <th width="3%" colspan="3" class="text-center">Accept</th>
                {{--<th width="5%" colspan="6" class="text-center">Delete</th>--}}
            </tr>
            </thead>
            <tbody>
            <h1 style="display: none">   {{$sno=1}}</h1>

            <form action="{{url('/accept')}}" method="POST" name="device_edit_form">
                {{--{{dd( $pay->serial_no)}}--}}
                {{csrf_field()}}
                <input type="hidden" name="masterpass" value="{{$squery}}">
                {{--<input name="_method" type="hidden" value="PUT">--}}

                @php if(!empty($users)) { @endphp
                {{--{{dd($users)}}--}}
                @foreach($users as $user)
                    <tr align="center">
                        {{--{{dd($user->serial_no)}}--}}
                        {{--<input type="text" id="passval{{$user->serial_no}}" value="{{$user->serial_no}}" name="sid[]" >--}}
                        <td>{{$sno++}}.</td>
                        {{--<td colspan="1">{{$user->serial_no}}</td>--}}
                        <td colspan="1">{{$user->applicant_name}}</td>
                        <td colspan="1">{{$user->designation}}</td>
                        <td colspan="2">{{$user->passport}}</td>
                        <td colspan="3">{{$user->arrivalDate}}</td>
                        <td colspan="3">{{$user->departureDate}}</td>
                        <td colspan="3">
                            <!--  <input type="hidden" name="allval[]" value="{{$user->serial_no}}">
                            <input type="checkbox" class="chk2" @php if($user->approve_status=='Approved') { @endphp checked @php } @endphp name="accept[]" value="{{$user->serial_no}}">
 -->
                            <input type="hidden" value="0" name="accept{{$user->serial_no}}">
                            <input type="checkbox" class="chk2" name="accept{{$user->serial_no}}"
                                   id="accept{{$user->serial_no}}" value="{{$user->serial_no}}">

                        </td>
                    </tr>
                @endforeach
                @php } @endphp
            </tbody>
        </table>
        <br>

    </div>

    <div class="row">
        <div class="form-group col-md-3">

            {{--<select class="form-control " id="select" required="required">--}}
            <select id="select" required="required" class="form-control">
                <option value="">Select Designation</option>


                @foreach($authorities as $id=>$authority)

                    <option value="{{$authority->id}}" {{ ( $authority->id == $id ) ? ' selected' : '' }}>{{$authority->name}}</option>

                @endforeach

            </select>


            <input type="hidden" id="name" name="name">
            <input type="hidden" id="desi" name="desi">

        </div>

        <div class="col-md-4"><span id="result"></span></div>

    </div>






    {{--</div>--}}
    {{--@php if(isset($users))  { @endphp--}}
    <div class="col-md-10">
        <button type="submit" onclick="return confirm('Are you sure to approve ?');"
                class="btn btn-primary btn-center pull-right">Approve
        </button>
    </div>
    {{--@php } @endphp--}}

    </form>



@endsection


@section('page-script')

    <script>


        $(document).ready(function () {
            $('#select').on('change', function () {

                var id = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({

                    url: './ajax/' + id,


                    type: "POST",

                    dataType: "json",

                    success: function (data) {
//                    alert(data);

                       // console.log(data);

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




