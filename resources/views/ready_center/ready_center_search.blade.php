@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Delivery/Receive
@endsection

<!--Page Header-->
@section('page-header')
    R.A.P./P.A.P. Ready Centre - ADS
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <!-- Code Here.... -->
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="row" style="background: #a7bdd8">
                                <div class="col-md-6 text-center">
                                    <h4>Count: <span id="count_pass">0</span></h4>
                                </div>
                                <div class="col-md-6 text-center">
                                    <h4>Total Saved: <?php echo $count[0]->t_count; ?></h4>
                                </div>

                            </div>
                            <div class="row" style="">
                                <div class="col-md-6 text-center">
                                    {{--<h4>Count: <span id="count_pass">0</span></h4>--}}
                                </div>
                                <div class="col-md-6 text-center">
                                    {{--<h4>Total Saved: {{$total}}</h4>--}}
                                </div>

                            </div>
                            <hr style="margin: 0px 3px 28px 3px;">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <form action="{{route('/update-ready-center' )}}" method="POST">
                                        {{ csrf_field() }}
                                        @if(session()->has('message'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message') }} (
                                                <?php if (session()->has('passport_no')){
                                                    foreach (session()->get('passport_no') as $item){
                                                        echo $item.',';
                                                    }
                                                } ?>)
                                            </div>
                                        @endif
                                        <div class="form-group" style="width: 288px; padding-left: 120px">
                                            <label for="form_date"><i>Service Type:</i></label>
                                            <select class="form-control" name="service_type" required="">
                                                <option value="R.A.P./P.A.P.">R.A.P./P.A.P.</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="type" id="selected_type">
                                        <div id="color" style="padding-top: 5px;background: #ddd">
                                            <div class="entry" style="margin-left: 120px; width: 800px">
                                                <input type="hidden" id="rsearch" name="rss">

                                                <input type="text" id="colorTextbox1" name="wf_no[]"
                                                       placeholder="Passport Number"
                                                       class="webfile_no">

                                                <input type="hidden" class="ap_name" name="name[]" id="ApName1">


                                                <input type="hidden" class="wb_no" name="wbf[]" id="WebFile1">
                                                <input type="hidden" class="" name="id[]" id="serial_no1">
                                            </div>
                                            <br><br>

                                            <div class="col-md-offset-2" style="padding-bottom: 10px">
                                                <input type="Submit" class="btn btn-primary" name="pass" value="Save"
                                                       id="passport_data">&nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-default" value="Reset">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>

    <script>

        $('select[name="service_type"]').on('change', function () {
            var keyword = $(this).val();
            // console.log(keyword);
            document.getElementById("selected_type").value = keyword;
            if (keyword == 'Port Endorsement') {
                document.getElementById("color").style.background = 'rgba(236, 154, 154, 0.87)';
            }else if(keyword == 'R.A.P./P.A.P.'){
                document.getElementById("color").style.background = '#ddd';
            }else if(keyword == 'Dollar Endorsement'){
                document.getElementById("color").style.background = 'rgba(112, 133, 234, 0.68)';
            }else if(keyword == 'Foreign Passport'){
                document.getElementById("color").style.background = '#5ab587';
            }else{
                document.getElementById("color").style.background = '#fff';
            }


        });
    </script>

    <script>

        $(document).ready(function () {


            var colorCounter = 2;
            var sval = 'rappap';
            var count = 0;
            var old_value = [];
            $(document.body).on('keydown', '.webfile_no', function (event) {
                var key = event.charCode || event.keyCode || 0;
                var res = $("#rsearch").val();
                // var type = document.getElementById("selected_type").value;
                var type = 'R.A.P./P.A.P.';
                console.log(type);
                console.log(res);


                //alert(res);
                if (key == 13) {
                    var count_no = "colorTextbox" + (colorCounter - 1);
                    var my_wf_no = $('#' + count_no).val();
                    var hidden = $('#search').val();

                    var found = old_value.find(function(element) {
                        if (element == my_wf_no){
                            alert(my_wf_no+' -This Passport Already Searched !');

                        }else {

                        }
                    });
                    old_value.push(my_wf_no);
                    var unique = [...new Set(old_value)];
                    document.getElementById("count_pass").innerHTML=unique.length;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var id = $(this).val();
                    $.ajax({
                        url: "{{url('search_ready_center')}}",
                        data: {
                            "my_wf_no": my_wf_no,
                            "rss": res,
                            "type": type
                        },
                        type: "POST",
                        dataType: "json",
                        success: function (data) {
                            console.log(data.result.serial_no);
                            if (data.result==null) {
                                if (data.flg == 0) {
                                    //alert(data.message);
                                }

                            }else{
                                if (data.flg == 0) {
                                    //console.log('paici');
                                    //alert(data.message);
                                } else {
                                    count++;
                                }
                            }

                            //document.getElementById("count_pass").innerHTML = count;
                            var a = data.qq1;
                            $("#rsearch").val(a);

                            var member_no = "Contact" + (colorCounter - 2);
                            var name = "ApName" + (colorCounter - 2);
                            var st_type = "StType" + (colorCounter - 2);
                            var st_no = "StNo" + (colorCounter - 2);
                            var wb_no = "WebFile" + (colorCounter - 2);
                            var sr_no = "serial_no" + (colorCounter - 2);
                            //document.getElementById(member_no).value = data.result.contact;
                            // $('#' + member_no).show();
                            // $('#' + st_type).show();
                            document.getElementById(sr_no).value = data.result.serial_no;
                        }

                    });

                    var newTextBoxDiv = $(document.createElement('div'))
                        .attr({"id": 'ColorTextBoxDiv' + colorCounter, "class": 'testDiv'});
                    newTextBoxDiv.after().html(
                        '<input type="text" name="wf_no[]" style="margin-top: 5px; " placeholder="Passport Number" class="webfile_no" id="colorTextbox' + colorCounter + '" value="" ><input type="hidden" style="width: 50px; display: none" name="name[]" class="ap_name" id="ApName' + colorCounter + '">' +
                        '<input type="hidden" style="width: 50px; display: none" name="wbf[]" class="wb_no" id="WebFile' + colorCounter + '">' +
                        '<input type="hidden" name="id[]" id="serial_no'+ colorCounter +'">');
                    newTextBoxDiv.appendTo(".entry");
                    $('#colorTextbox' + colorCounter).focus();

                    colorCounter++;
                    event.preventDefault();
                    return false;
                }


            });

        });

    </script>
@endsection