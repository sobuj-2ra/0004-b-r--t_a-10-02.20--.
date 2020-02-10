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
    <b class="pull-right">Total approved: {{$count}}</b>
    <div>
        <br>

        <form action="{{route('rap.edit')}}" method="get" role="search">
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

        <br>


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
                <th width="3%" colspan="3" class="text-center">Accept</th>
                {{--<th width="5%" colspan="6" class="text-center">Delete</th>--}}
            </tr>
            </thead>
            <tbody>
            <h1 style="display: none">   {{$sno=1}}</h1>

            <form action="{{url('/update')}}" method="POST" name="device_edit_form">
                
                {{csrf_field()}}
                
                <input type="hidden" name="masterpass" value="{{$squery}}">
                
                @php if(!empty($users)) { @endphp
                @foreach($users as $user)
                    <tr align="center">
                       
                        <td>{{$sno++}}.</td>
                        <td colspan="1">{{$user->applicant_name}}</td>
                        <td colspan="1">{{$user->designation}}</td>
                        <td colspan="2">{{$user->passport}}</td>
                        <td colspan="3">{{$user->arrivalDate}}</td>
                        <td colspan="3">{{$user->departureDate}}</td>
                        <td colspan="3">
                            <input type="hidden" name="allval[]" value="{{$user->serial_no}}">
                            <input type="checkbox" class="chk2" @php if($user->approve_status=='Approved') { @endphp checked @php } @endphp name="accept[]" value="{{$user->serial_no}}">
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
            @php if(!empty($users)) { @endphp

            <select id="select" required="required" name="k" class="form-control">
                <option value="">Select Designation</option>
                @foreach($authorities as $id=>$authority)

                    <option value="{{$authority->id}}" {{ ( $authority->name == $UserName ) ? 'selected' : '' }}>{{$authority->name}}</option>

                @endforeach

            </select>
            @php } @endphp

            <input type="hidden" id="name" name="name">
            <input type="hidden" id="desi" name="desi">

        </div>

        <div class="col-md-4"><span id="result"></span></div>

    </div>

    <div class="col-md-10">
        <div class="col-md-2 pull-right">
            <button type="submit" onclick="return confirm('Are you sure to update ?');"
                    class="btn btn-primary btn-center"  name="action" value="save">Save
            </button>

        </div>




        <div class="col-md-1 pull-right">
            <button type="submit" id="rePrint" name="action" value="Re-Print" onclick="return confirm('Are you sure to Re-Print ?');"
                    class="btn btn-primary btn-center pull-right">Re-Print
            </button>

        </div>



    </div>
    {{--@php } @endphp--}}

    </form>



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

