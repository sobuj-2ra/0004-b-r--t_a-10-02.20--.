@extends('admin.master')
<!--Page Title-->
@section('page-title')
    R.A.P. / P.A.P. Basic Print
@endsection

<!--Page Header-->
@section('page-header')
    R.A.P. / P.A.P. Basic Print
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
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
                    <div class="" style="width:100% !important;">
                        <form action="{{route('basic')}}" method="get" role="search">
                            {{ csrf_field() }}
                            <div class="passport_search">
                                <input type="search" name="q" placeholder="Passport Search" value="{{ old('q') }}" auto-complete="off">
                                <button type="submit" class="btn_search">Search</button>
                            </div>
                        </form>
                    </div>
                    <br>
                    {{--<div class="row">--}}
                        <div class="col-md-6 ">
                            <h4><b>No. DAC/VISA/406/14/2019</b></h4>
                        </div>
                        <div class="col-md-6 pull-right ">
                            <h4 align="center"><b>{{$currentDate}}</b></h4>
                        </div>
                    {{--</div>--}}
                    <div>
                        <h4 class="col-xs-offset-3"><b>RESTRICTED / PROTECTED AREA PERMIT</b></h4>
                    </div>
                    <br>
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
                                {{--<th width="3%" colspan="3" class="text-center">Accept</th>--}}
                                {{--<th width="5%" colspan="6" class="text-center">Delete</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            <h1 style="display: none">   {{$sno=1}}</h1>
                            <form action="{{url('/hci/basic/printPage')}}" method="POST" name="device_edit_form">
                                {{csrf_field()}}
                                <input type="hidden" name="masterpass" value="{{$squery}}">
                                <?php if(!empty($users)) { ?>
                                @foreach($users as $user)
                                    <tr align="center">
                                        <td>{{$sno++}}.</td>
                                        <td colspan="1">{{$user->applicant_name}}</td>
                                        <td colspan="1">{{$user->designation}}</td>
                                        <td colspan="2">{{$user->passport}}</td>
                                        <td colspan="3">{{ \Carbon\Carbon::parse($user->arrivalDate)->format('d-m-Y')}}</td>
                                        <td colspan="3">{{ \Carbon\Carbon::parse($user->departureDate)->format('d-m-Y')}}</td>
                                    </tr>
                            @endforeach
                            <?php } ?>
                            </tbody>
                        </table>
                        <br>
                        <button type="submit" onclick="return confirm('Are you sure to approve ?');"
                                class="btn btn-primary btn-center pull-right">Print
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><span id="result"></span></div>
                    </div>
                    <div class="col-md-10">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
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







