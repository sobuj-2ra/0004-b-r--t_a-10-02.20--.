@extends('admin.master')
<!--Page Title-->
@section('page-title')
    RAPPAP
    @endsection

            <!--Page Header-->
@section('page-header')
    RAP/PAP Approval
    @endsection

            <!--Page Content Start Here-->
@section('page-content')


    <div id="printableArea" class="container">


        <div class="row">

            <br>

            <div class="col-md-6 ">
                <h4><b>No. DAC/VISA/406/14/2019</b></h4>
            </div>
            <div class="col-md-6 pull-right ">
                <h4><b>{{$currentDate}}</b></h4>
            </div>

        </div>

        <div>
            <h4 class="col-xs-offset-3"><b>RESTRICTED / PROTECTED AREA PERMIT</b></h4>
            <h4 class="col-xs-offset-4"><b>(DAC/RAP/PAP/{{$currentDate}}-{{$count}})</b></h4>
        </div>

        <div class="col-xs-offset-1">(Under paragraph 3 & 4 of the Foreigners Restricted Areas Order,1963 as amended)
        </div>
        <br>

        {{--{{dd($pay->serial_no)}}--}}


        <div class="col-md-10">

            <table border="1" cellpadding="0" cellspacing="0">
                <thead class="text-center">
                <tr>

                    <th width="3%">S.No.</th>
                    <th width="8%" class="text-center">Name</th>
                    <th width="10%" colspan="1" class="text-center">Designation / Relation</th>
                    <th width="15%" colspan="2" class="text-center">Passport No.</th>
                    <th width="7%" colspan="3" class="text-center">Arrival Date</th>
                    <th width="8%" colspan="3" class="text-center">Departure Date</th>
                    
                </tr>
                </thead>
                <tbody>
                <h1 style="display: none">   {{$sno=1}}</h1>

                @foreach($users as $user)
                    <tr align="center">
                        {{--{{dd($user->serial_no)}}--}}
{{--<input type="text" id="passval{{$user->serial_no}}" value="{{$user->serial_no}}" name="sid[]" >--}}
                        <td>{{$sno++}}.</td>
                        <td colspan="1">{{$user->applicant_name}}</td>
                        <td colspan="1">{{$user->designation}}</td>
                        <td colspan="2">{{$user->passport}}</td>
                        <td colspan="3">{{$user->arrivalDate}}</td>
                        <td colspan="3">{{$user->departureDate}}</td>
                        

                    </tr>

                    {{--@section('script-page')--}}
                        {{--$(document).ready(function() {--}}
                        {{--$("#chk2").click(function(){--}}

                        {{--alert('test');--}}
                        {{--});--}}

                        {{--});--}}

                  {{--@endsection--}}



                @endforeach


                </tbody>
            </table>
<br>





        </div>



        <div class="col-md-10 col-xs-offset-">
            <br>

            {{--@foreach($address as $address)--}}

            <p class="col-xs-offset-1">You are hereby permitted to <u><b>{{$address['area']}} from {{$arrived}} to {{$departure}}</b></u> for holiday subject to following: </p>

        </div>

        <div class="col-md-10 col-xs-offset-">
            <br>

            <p class="col-xs-offset-1"> (a)&nbsp;&nbsp; Photography of Vulnerable area / Vulnerable Points including
                sensitive Army installation / equipment is not permitted.</p>

            <p class="col-xs-offset-1"> (b)&nbsp;&nbsp;The applicant should not participate in discussion on any
                controversial issues.</p>

        </div>


        <div class="col-md-10">
            <p>2.&nbsp;&nbsp;&nbsp;&nbsp; This permit Here is restricted to the places mentioned in para 1 and is valid
                for <b><u>{{$days+1}} ({{$word}}) days</u></b> as stated in para-1 above.</p>

            <p>3.&nbsp;&nbsp;&nbsp;&nbsp; The applicant is to adhere to the following route for this travel:</p>

            <p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u> "{{$address['OldPort']}}-{{$address['area']}}-{{$address['NewPort']}} ({{$address['mode']}})"</u></b></p>

            {{--@endforeach--}}

            <p>4.&nbsp;&nbsp;&nbsp;&nbsp; The applicant should abide by declared programme and should not disembark
                enroute on other restricted / protected areas and should process necessary documents at all times. </p>

            <p>5. Dos and Dont's: Instructions for PAP/RAP holders:</p>
            <ul>
                <li>The permit is valid for group tourists consisting of two or more persons only.</li>
                <li>The permit is valid for group tourists circuit/route and specific entry / exit point.</li>
                <li>The permit holder must keep sufficient number of photocopies of the permit as he/she may be required
                    to deposit a copy at each point of entry/exit.
                </li>
                <br>
            </ul>
        </div>

        <div class=" col-md-11 ">

            <h4 class="col-xs-offset-8"><b>{{$name}}</b></h4>
            <h4 class="col-xs-offset-8"><b>{{$desi}}</b></h4>


        </div>


    </div>

   <div class="pull-left" style="margin-right: 15px" ><input  type="button" class="search" onclick="printDiv('printableArea')" value="print"/> </div>

    {{--<form action="{{route('approval')}}" method="POST">--}}
        {{--{{dd( $pay->serial_no)}}--}}
        {{--{{csrf_field()}}--}}
        {{--<input name="_method" type="hidden" value="PUT">--}}
    {{--<!-- Button trigger modal -->--}}
    {{----}}
    {{--</button>--}}


  {{----}}
        {{--</form>--}}






    @endsection
            <!--Page Content End Here-->

    <style>
        .container {
            margin-left: auto;
            margin-right: auto;
            /*margin-top: 144px;*/
        }

        input.search {
            width: 70px;  height: 30px;
        }


    </style>

    <script type="text/javascript">
        function printDiv(printableArea) {
            var printContents = document.getElementById(printableArea).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>





