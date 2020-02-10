@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Additional Services
@endsection

<!--Page Header-->
@section('page-header')
    Additional Services
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
                                    <h4>Total Saved: {{$total}}</h4>
                                </div>

                            </div>
                            <hr style="margin: 0px 3px 28px 3px;">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <form action="{{route('updateSearch' )}}" method="POST">
                                        {{ csrf_field() }}
                                        @if(session()->has('message'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        <div class="form-group" style="width: 288px; padding-left: 120px">
                                            <label for="form_date"><i>Service Type:</i></label>
                                            <select class="form-control" name="service_type" required="">
                                                <option value="">Select Item</option>
                                                <?php foreach ($services as $ser){ ?>
                                                <option value="<?php echo $ser->Service ?>"> <?php echo $ser->Service ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="type" id="selected_type">
                                        <div class="entry" style="margin-left: 120px; width: 800px">
                                            <input type="hidden" id="rsearch" name="rss">

                                            <input type="text" id="colorTextbox1" name="wf_no[]"
                                                   placeholder="Passport Number"
                                                   class="webfile_no">
                                            <input type="text" class="ap_contact" id="Contact1" name="contact[]"
                                                   placeholder="Contact" style=" margin-left: 5px; display:none ">
                                            <input type="hidden" class="ap_name" name="name[]" id="ApName1">
                                            <input type="text" placeholder="Sticker" class="st_type" name="StType[]"
                                                   id="StType1"
                                                   style=" margin-left: 5px; display:none">
                                            <input type="number" placeholder='StNo' class="st_no" name="StNo[]"
                                                   id="StNo1"
                                                   style="width:50px;margin-left: 2px; display:none">
                                            <input type="hidden" class="wb_no" name="wbf[]" id="WebFile1">
                                            <input type="hidden" class="" name="id[]" id="serial_no1">
                                        </div>
                                        <br><br>

                                        <div class="col-md-offset-5">
                                            <input type="Submit" class="btn btn-primary" name="pass" value="Save"
                                                   id="passport_data">&nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-default" value="Reset">
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
            document.getElementById("selected_type").value = keyword;

        });
    </script>

    <script>

        $(document).ready(function () {


            var colorCounter = 2;
            var sval = 'rappap';
            var count = 0;
            $(document.body).on('keydown', '.webfile_no', function (event) {
                var key = event.charCode || event.keyCode || 0;
                var res = $("#rsearch").val();
                var type = document.getElementById("selected_type").value;
                if (type == ''){
                    alert('Please Select Service Type!');
                }

                //alert(res);
                if (key == 13) {
                    var count_no = "colorTextbox" + (colorCounter - 1);
                    var my_wf_no = $('#' + count_no).val();
                    var hidden = $('#search').val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var id = $(this).val();
                    $.ajax({
                        url: "{{url('search')}}",
                        data: {
                            "my_wf_no": my_wf_no,
                            "rss": res,
                            "type": type
                        },
                        type: "POST",
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            if (data.result==null) {
                                if (data.flg == 0) {
                                    alert(data.message);
                                }else {
                                    alert('This Passport Already Saved !');
                                }

                            }else{
                                if (data.flg == 0) {
                                    console.log('paici');
                                    alert(data.message);
                                } else {
                                    count++;
                                }
                            }

                            document.getElementById("count_pass").innerHTML = count;
                            var a = data.qq1;
                            //alert(a);
                            $("#rsearch").val(a);

//                        var obj = JSON.parse(data);
                            var member_no = "Contact" + (colorCounter - 2);
                            var name = "ApName" + (colorCounter - 2);
                            var st_type = "StType" + (colorCounter - 2);
                            var st_no = "StNo" + (colorCounter - 2);
                            var wb_no = "WebFile" + (colorCounter - 2);
                            var sr_no = "serial_no" + (colorCounter - 2);
                            document.getElementById(member_no).value = data.result.contact;
                            $('#' + member_no).show();
                            $('#' + st_type).show();
//                        $('#'+st_no).show();
//                        document.getElementById(name).value = obj.name;
                            document.getElementById(st_type).value = data.result.sticker;
                            document.getElementById(sr_no).value = data.result.serial_no;
//                        document.getElementById(st_no).value = data.stNo;
//                        document.getElementById(wb_no).value = data.webfile;


                        }

                    });

                    var newTextBoxDiv = $(document.createElement('div'))
                        .attr({"id": 'ColorTextBoxDiv' + colorCounter, "class": 'testDiv'});
                    newTextBoxDiv.after().html(
                        '<input type="text" name="wf_no[]" style="margin-top: 5px; " placeholder="Passport Number" class="webfile_no" id="colorTextbox' + colorCounter + '" value="" ><input type="number" name="contact[]" class="ap_contact" id="Contact' + colorCounter + '" placeholder="Contact" style="margin-left: 10px; display: none"><input type="hidden" style="width: 50px; display: none" name="name[]" class="ap_name" id="ApName' + colorCounter + '"><input type="text"  placeholder="Sticker" style=" margin-left: 9px; display: none" name="StType[]" class="st_type" id="StType' + colorCounter + '"><input type="hidden" placeholder="StNo" style=" margin-left: 5px; display: none" name="StNo[]" class="st_no" id="StNo' + colorCounter + '">' +
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