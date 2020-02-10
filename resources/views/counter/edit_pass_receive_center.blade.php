@extends('admin.master')
<!--Page Title-->
@section('page-title')
   Edit Passport Receive Center
@endsection

<!--Page Header-->
@section('page-header')
Edit Regular Passport

@endsection

<!--Page Content Start Here-->
@section('page-content')
    <div id="app2">
        <!--Calling Controller here-->
        <div class="row" style="margin-left: 0px !important;margin-right: 0px !important; padding-top: 20px;padding-left:20px; padding-bottom: 20px">
            <div class="col-md-12">
                <div class="row" style="padding: 10px;margin-right: 0px;margin-left: 0px;">
                    <div class="col-md-6">
                        @if (Session::has('message'))
                            <div class="alert {{ Session::get('msgType') }}">{{ Session::get('message') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row main_part">
                    @if(isset($readyEditData))
                        <div class="col-md-12">
                            <div class="edit-receive-pass-area">
                                <form action="{{URL::to('passport/receive/edit-store')}}" method="post" class="">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-3">
                                            <hr>
                                            <div class="form-group">
                                                <label for="webfileNoId">Webfile No.</label>
                                                <input type="text" name="WebFile_no" value="{{$readyEditData->WebFile_no}}" id="webfileNoId" class="form-control" disabled>
                                                <input type="hidden" name="WebFile_no" value="{{$readyEditData->WebFile_no}}">
                                                <input type="hidden" name="Passport" value="{{$readyEditData->Passport}}">
                                                <input type="hidden" name="appx_Del_Date" value="{{$readyEditData->appx_Del_Date}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="passportNoId">Passport No.</label>
                                                <input type="text" name="Passport" value="{{$readyEditData->Passport}}" id="passportNoId" class="form-control" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="visatypeId">Visa Type:</label>
                                                <select @change="visaTypeFunc"  name="Visa_type" id="visatypeId" class="form-control">
                                                    @foreach($visaTypeData as $visaItem)
                                                        <option value="{{$visaItem->visa_type}}" <?php if($readyEditData->Visa_type == $visaItem->visa_type){ echo 'selected'; }?>  >{{$visaItem->visa_type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                           
                                        </div>
                                        <div class="col-md-3">
                                            <hr>
                                             
                                            <div class="form-group">
                                                <label for="nameId">Name: </label>
                                                <input type="text" name="Applicant_name" value="{{@$readyEditData->Applicant_name}}" id="nameId" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="contactNoId">Contact No.</label>
                                                <input type="text" name="Contact" value="{{@$readyEditData->Contact}}" id="contactNoId" class="form-control">
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-2">
                                            <hr>
                                            <div class="form-group">
                                                <label for="stikerTypeId">Stiker Type: </label>
                                                <select  @change="stickerCheckFunc" name="Sticker_type" id="stikerTypeId" class="form-control">
                                                    @if($readyEditData->Sticker_type == '')
                                                        <option value=""></option>
                                                    @endif
                                                    @foreach($allSticker as $sticker)
                                                        @if($sticker->StickerSymbol == $readyEditData->Sticker_type)
                                                            <option value="{{$sticker->StickerSymbol}}" selected>{{$sticker->StickerSymbol}}</option>
                                                        @else
                                                            <option value="{{$sticker->StickerSymbol}}">{{$sticker->StickerSymbol}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="RoundStickerId">Sticker No. </label>
                                                <input @change="stickerCheckFunc" type="number" name="RoundSticker" id="RoundSticker"  value="{{@$readyEditData->RoundSticker}}" id="RoundStickerId" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="tddDateId">TDD:</label>
                                                <input type="text" name="appx_Del_Date" value="<?php  if(isset($readyEditData->appx_Del_Date)){ echo Date('d-m-Y',strtotime($readyEditData->appx_Del_Date)); } ?>" id="tddDateId"  data-date-format="dd/mm/yyyy"  autocomplete="off" class="form-control datepicker" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="oldPassportId">Old Passport:</label>
                                                <input type="text" name="OldPassQty" value="{{@$readyEditData->OldPassQty}}" id="oldPassportId" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <input v-if="submitPermit" type="submit" name="submit" value="Update" class="btn btn-primary" id="UpdateBtn" style="padding:6px 30px;"><input onclick="alert('This sticker number already used')" v-else="submitPermit" type="button" value="Update" class="btn btn-primary" style="padding:6px 30px;"> <a  onclick="return confirm('Are you sure! Do you want to Delete?')" href="{{URL::to('passport/receive/edit-destroy').'/'.$readyEditData->WebFile_no}}" name="delete" value="Delete" class="btn btn-danger">Delete</a>
                                            <p></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="col-md-4" style="padding: 30px 30px 100px 30px">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Please Fill up the below field
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            {!! Form::open(['url' => '/edit-receive-passport','id' => 'applicant_edit_form']) !!}
                                            <div class="form-group">
                                                <input class="form-control" name="webfile_no" placeholder="Enter Webfile No"
                                                       required="required">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Search</button>
                                            <button type="reset" class="btn btn-default">Reset</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>

                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <br>
                            <a href="{{URL::to('/edit-receive-passport')}}" style="padding-left: 16px"><button type="submit" class="btn btn-outline-info"> Refresh &nbsp;<i class="fa fa-refresh" aria-hidden="true"></i></button></a>
                        </div>
                        <div class="col-md-8"></div>

                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>

        var app = new Vue({
            el:"#app2",
            data:{
                submitPermit:true,
            },
            methods:{
                stickerCheckFunc: function(){
                    var _this = this;
                    var validStikerType = document.getElementById('stikerTypeId').value;
                    var validSticker = document.getElementById('RoundSticker').value;
                    axios.get('check_valid_sticker_axios',{params:{validSticker:validSticker,validStikerType:validStikerType}})
                        .then(function(res){
                            console.log(res.data);
                            if(res.data.validStatus == 'Yes'){
                                _this.submitPermit = true;
                            }
                            else{
                                if(_this.oldStkrType != validStikerType && _this.oldstkr != validSticker ){
                                    _this.submitPermit = false;
                                    alert('This sticker number already used');
                                }
                            }
                        })
                        .catch(function(error){
                            console.log(error);
                        })
                },
                visaTypeFunc:function(){
                    var visa_type = document.getElementById('visatypeId').value;

                axios.get('get_ttd_pass_edit_axios',{params:{visa_type:visa_type}})
                    .then(function(res){
                        var visatdd = res.data.visa_type.tdd.split(' ');
                        var visatddF = visatdd[0].split('-');
                        var vt_year = visatddF[0];
                        var vt_month = visatddF[1];
                        var vt_day = visatddF[2];
                        var finalTdd = vt_day+'-'+vt_month+'-'+vt_year;

                        document.getElementById('tddDateId').value = finalTdd;
                    })
                    .catch(function(error){
                      // window.reload();
                        console.log(error);
                    })
                }
            },
            created:function(){
            
            }
        });

    </script>
    <script type="text/javascript">
      $('#webfileNoId').on('keypress', function (event) {
          var regex = new RegExp("^[a-zA-Z0-9]+$");
          var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
          if (!regex.test(key)) {
             event.preventDefault();
             return false;
          }
      });
      $('#passportNoId').on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
          event.preventDefault();
          return false;
        }
      });

      $("#tokenNoId").on("keypress keyup blur", function (event) {
          //this.value = this.value.replace(/[^0-9\.]/g,'');
          $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
          if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
              event.preventDefault();
          }
      });
      $("#tokenNoId").on("input", function() {
          if (/^0/.test(this.value)) {
              this.value = this.value.replace(/^0/, "")
          }
      });


      $("#procFeeId").on("keypress keyup blur", function (event) {
          //this.value = this.value.replace(/[^0-9\.]/g,'');
          $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
          if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
              event.preventDefault();
          }
      });
      $("#procFeeId").on("input", function() {
          if (/^0/.test(this.value)) {
              this.value = this.value.replace(/^0/, "")
          }
      });


      $("#RoundSticker").on("keypress keyup blur", function (event) {
          //this.value = this.value.replace(/[^0-9\.]/g,'');
          $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
          if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
              event.preventDefault();
          }
      });
      $("#RoundSticker").on("input", function() {
          if (/^0/.test(this.value)) {
              this.value = this.value.replace(/^0/, "")
          }
      });


      $("#specialFeeId").on("keypress keyup blur", function (event) {
          //this.value = this.value.replace(/[^0-9\.]/g,'');
          $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
          if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
              event.preventDefault();
          }
      });
      $("#specialFeeId").on("input", function() {
          if (/^0/.test(this.value)) {
              this.value = this.value.replace(/^0/, "")
          }
      });
    </script>


@endsection
