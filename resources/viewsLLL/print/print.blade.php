@include('admin.inc.header')
@include('admin.inc.leftmenu')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Print Preview</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
     
    <div class="row">


        <div class="col-md-6">
            <div class="register-logo">
                <a class="text-center" href="#"><b>Create</b></a>
            </div>

<div >
    <br>
    <form   action="{{route('print')}}" method="get" role="search" >
        {{ csrf_field() }}
        <div class="input-group col-md-4 ">
            <input type="text" class="form-control" name="q"
                   placeholder="Search passport Number"> <span class="input-group-btn">
					<button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>



				</span>

        </div>
</form>

</div>

<div id="printableArea" class="container">


    <div class="row">

        <br>
        <div class="col-md-6 ">
            <h4><b>No. DAC/VISA/406/14/2018</b></h4>
        </div>
        <div class="col-md-6 pull-right ">
            <h4><b>31 December 2018</b></h4>
        </div>

    </div>

    <div>
        <h4 class="col-xs-offset-3"><b>RESTRICTED / PROTECTED AREA PERMIT</b></h4>
        <h4 class="col-xs-offset-4"><b>(DAC/RAP/PAP/31DEC2018-5)</b> </h4>
    </div>

    <div class="col-xs-offset-1">(Under paragraph 3 & 4 of the Foreigners Restricted Areas Order,1963 as amended) </div>
    <br>

    <div class="col-md-10">
        <table border="1">
            <thead class="text-center">
            <tr>

                <th width="5%">S.No.</th>
                <th width="8%" class="text-center">Name</th>
                <th width="10%" colspan="1" class="text-center">Designation / Relation</th>
                <th width="15%" colspan="2" class="text-center">Passport No.</th>
                <th width="5%" colspan="3" class="text-center">Arrival Date</th>
                <th width="5%" colspan="3" class="text-center">Departure Date</th>
                <th width="5%" colspan="3" class="text-center">Accept</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)

            <tr align="center">

                <td>{{$user->serial_no}}.</td>
                <td colspan="1">{{$user->applicant_name}}</td>
                <td colspan="1">BUSINESS</td>
                <td colspan="2">{{$user->passport}}</td>
                <td colspan="3">{{$user->arrivalDate}}</td>
                <td colspan="3">{{$user->departureDate}}</td>
                <td colspan="3"><input type="checkbox"></td>
            </tr>
            {{--<tr align="center">--}}

            {{--<td>2.</td>--}}
            {{--<td colspan="1">HALIMA BEGUM EVA</td>--}}
            {{--<td colspan="1">SPOUSE</td>--}}
            {{--<td colspan="2">BC0765117</td>--}}
            {{--<td colspan="3">07.01.2019</td>--}}
            {{--<td colspan="3">13.01.2019</td>--}}
            {{--</tr>--}}

            @endforeach
            {{--<tr align="center">--}}
               {{----}}
            {{--<tr>--}}
                {{--<td>{{$user->passport}}</td>--}}
                {{--<td>{{$user->sticker}}</td>--}}
                {{--<td>{{$user->contact}}</td>--}}
            {{--</tr>--}}

                {{--<td>2.</td>--}}
                {{--<td colspan="1">HALIMA BEGUM EVA</td>--}}
                {{--<td colspan="1">SPOUSE</td>--}}
                {{--<td colspan="2">BC0765117</td>--}}
                {{--<td colspan="3">07.01.2019</td>--}}
                {{--<td colspan="3">13.01.2019</td>--}}
            {{--</tr>--}}

            </tbody>
        </table>
    </div>


    <div class="col-md-10 col-xs-offset-">
        <br>

        <p class="col-xs-offset-1">You are hereby permitted to <u><b>Gangtok,Sikkim from 07 January to 13 January 2019 </b></u> for holiday subject to following: </p>

    </div>

    <div class="col-md-10 col-xs-offset-">
        <br>

        <p class="col-xs-offset-1"> (a)&nbsp;&nbsp; Photography of Vulnerable area / Vulnerable Points including sensitive Army installation / equipment is not permitted.</p>

        <p class="col-xs-offset-1"> (b)&nbsp;&nbsp;The applicant should not participate in discussion on any controversial issues.</p>

    </div>

    <div class="col-md-10">
        <p>2.&nbsp;&nbsp;&nbsp;&nbsp; This permit Here is restricted to the places mentioned in para 1 and is valid for <b><u>{{$days+1}} (seven) days</u></b> as stated in para-1 above.</p>

        <p>3.&nbsp;&nbsp;&nbsp;&nbsp; The applicant is to adhere to the following route for this travel:</p>
        <p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u> "Dhaka-Gede-Gangtok (By Rail/Road)"</u></b></p>

        <p>4.&nbsp;&nbsp;&nbsp;&nbsp; The applicant should abide by declared programme and should not disembark enroute on other restricted / protected areas and should process necessary documents at all times. </p>
        <p>5. Dos and Dont's: Instructions for PAP/RAP holders:</p>
        <ul>
        <li >The permit is valid for group tourists consisting of two or more persons only.</li>
        <li>The permit is valid for group tourists circuit/route and specific entry / exit point.</li>
        <li>The permit holder must keep sufficient number of photocopies of the permit as he/she may be required to deposit a copy at each point of entry/exit.</li>
        <br>
        </ul>
    </div>

    <div class=" col-md-10 col-xs-offset-8">

        <h4><b>Vishal J. Das</b></h4>
        <h4><b>Secondary Secretary</b></h4>


    </div>


</div>
<input class="col-xs-offset-3" type="button" onclick="printDiv('printableArea')" value="print"/>


                  </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

@include('admin.inc.footer')





