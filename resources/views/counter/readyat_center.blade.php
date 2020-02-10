@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Ready At Center
@endsection

<!--Page Header-->
@section('page-header')
Ready at Center

@endsection

<!--Page Content Start Here-->
@section('page-content')
    @php
        $curDate = Date('d-m-Y');
    @endphp
    <div id="app1">
        <section class="content ">
            <div class="row">
                <div class="col-md-12">
                    <div class="main_part countercall-area" >
                        @if(Session::has('message'))
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4 alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
                            </div>
                        @endif
                    <!-- Code Here.... -->

                        <div class="row">
                            <div class="col-md-9">
                                <div v-show="webfilePreloader" class="webfile-preloader"><img class="preloader" src="{{asset("public/assets/img/preloader.gif")}}" alt=""></div>

                                <div class="col-md-12">
                                    <div class="readyat-data-info-area">
                                        {{--{{Hash::make('password')}}--}}
                                        <span>Select Date: <input name="selected_date" class="datepicker datepicker_style input_values" style="width:120px" type="text" value="{{$curDate}}"></span>
                                        <div class="float-right">
                                            <span>Total Saved: <b>@{{ total_save }}</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
                                            <span>Total Data Not Found: <b>@{{ total_failed}}</b></span><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="readyat-content-area">
                                    <div class="readyat-list-show">
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Sl</th>
                                                    <th>Passport Number <span><b>( @{{ totalCount }} )</b></span></th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in readyatArr">
                                                    <td>@{{ index+1 }}</td>
                                                    <td>@{{ item.passport }} <input class="input_values" type="hidden" :value="item.passport" name="passport[]"></td>
                                                    <td>@{{ item.remark }} <input type="hidden" class="input_values" :value="item.remark" name="remark[]"></td>
                                                    <input type="hidden" class="input_values" name="_token" value="{!! csrf_token() !!}">
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="readyat-center-section">
                                    <div class="row">
                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="readyat-top-left">

                                                Passport: <input @keyup.enter="passportEnterFunc" v-model="passInputVal" id="passfieldId" type="text" style="margin-bottom:10px;" placeholder="Press Enter"> <input @click="remarkParmitFunc" v-model="remarkParmitMod" type="checkbox"> <input @keyup.enter="passportEnterFunc" v-model="remarkInputVal" v-if="remarkParmitMod" type="text" id="remark_field_id" placeholder="Remarks ">
                                                <spna class="float-right">Recent Saved: <b id="rec_save" style="color:green">0</b> &nbsp;&nbsp;Data Not Found: <b id="rec_fail" style="color:red">0</b></spna>
                                                <br>
                                                <input @click="passReadySubFunc" type="button" style="margin-left:60px;" class="btn btn-primary" value="Save"> <input @click="clearDataFunc" type="reset" class="btn btn-danger" value="Clear">
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="recent_fail_data_area" style="background: #FFF">
                                    <div style="background:#E5E7E9;width: 100%;text-align:center;border-left:5px solid #FFF;border-right:5px solid #FFF;">
                                        <b>Recent</b><br>
                                    <span style="color:red;font-weight:bold">Data Not Found (<b id="rec_fail2" style="color:red">0</b>)</span>
                                    </div>
                                    <table class="table table-responsive">
                                        <tr>
                                            <th>SL</th>
                                            <th>Passport</th>
                                        </tr>
                                        <tr v-for="(itemF,i) in recentFData">
                                            <td>@{{i+1}}</td>
                                            <td>@{{itemF.passport}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </section>
    </div>
        @php
            $url = "url::()";
        @endphp
    <script>
        $( ".selector" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    </script>
    <script>

        var app = new Vue({
            el:'#app1',
            data:{
                webfilePreloader:false,
                remarkParmitMod:false,
                remarkInputVal: '',
                passInputVal: '',
                readyatArr:[],
                dataArr:[],
                totalCount:0,
                checkDouble:false,
                total_save:0,
                total_failed:0,
                recentFData:[],

            },
            methods:{
                remarkParmitFunc: function(){
                    this.remarkParmitMod = true;
                    $('#remark_field_id').focus();
                },
                passportEnterFunc: function(){
                    var InVal = this.passInputVal.toUpperCase()
                    this.passInputVal = InVal.split(' ').join('');
                    this.remarkInputVal = this.remarkInputVal.toUpperCase()
                    var cuVal = this.passInputVal;


                    if(cuVal != '')
                    {
                        this.checkDouble = false;
                        var readyatArr = this.readyatArr;


                        // check double data in loop //
                        for(item in this.dataArr){
                            if(this.dataArr[item] == this.passInputVal){
                                this.checkDouble = true;
                            }
                        }


                        // push another array for loop//
                        this.dataArr.push(this.passInputVal);

                        /// if all ok then push data in main array //
                        if(this.checkDouble == false)
                        {
                            this.readyatArr.push(
                                {
                                    passport:this.passInputVal,
                                    remark:this.remarkInputVal
                                }
                            );
                        }
                        else
                        {
                            alert('This Passport Already Taken');

                        }
                    }
                    else{
                        alert('Please input vlaue');
                    }

                    $('#passfieldId').focus();
                    this.totalCount = this.readyatArr.length;
                    this.remarkParmitMod = false;
                    this.checkDouble = false;
                    this.remarkInputVal = '';
                    this.passInputVal = '';
                },
                clearDataFunc: function()
                {
                    if(this.totalCount > 0)
                    {
                        var sure = confirm('Are you sure! You want to clear?');
                        if(sure)
                        {
                                this.dataArr = [];
                                this.readyatArr = [];
                                this.totalCount = 0;
                                this.remarkParmitMod = false;
                                this.checkDouble = false;
                                this.remarkInputVal = '';
                                this.passInputVal = '';
                        }
                    }
                    else{
                        alert('Opps! Nothing to clear');
                    }
                },
                passReadySubFunc: function()
                {
                    var _this = this
//                    var data = this.readyatArr.serialize()
////                    console.log(data);
//                    const myObjStr = JSON.stringify(this.readyatArr);
//                    console.log(myObjStr)
                    var objectData = $('.input_values').serialize();
//                    console.log(objectData);
//                    $.post({
//                        type:"post"
//                    })
//                    $.post('ready-center-passport-datas',objectData,function(res){
////                        _this.webfilePreloader = false;
//                        _this.total_save = res.total_save;
//                        _this.total_failed = res.total_fail;
//                        _this.dataArr = [];
//                        _this.readyatArr = [];
//                        _this.totalCount = 0;
//                        _this.remarkParmitMod = false;
//                        _this.checkDouble = false;
//                        _this.remarkInputVal = '';
//                        _this.passInputVal = '';
//
//                    });
                    if(this.totalCount > 0){
                        axios.post('ready-center-passport-datas',objectData,this.webfilePreloader = true)
                            .then(function(res){
                                _this.webfilePreloader = false;
                                _this.total_save = res.data.total_save;
                                _this.total_failed = res.data.total_fail;
                                _this.dataArr = [];
                                _this.readyatArr = [];
                                _this.totalCount = 0;
                                _this.remarkParmitMod = false;
                               _this.checkDouble = false;
                                _this.remarkInputVal = '';
                                _this.passInputVal = '';
                                _this.recentFData = res.data.reject;
                                document.getElementById('rec_save').innerText = res.data.rec_save;
                                document.getElementById('rec_fail').innerText = res.data.rec_fail;
                                document.getElementById('rec_fail2').innerText = res.data.rec_fail;
                            })
                            .catch(function(error){
                                console.log(res);
                                _this.webfilePreloader = false;
                            })

                    }else{
                        alert('Empty Passport Number')
                    }
                }


            },
            created:function() {
                var _this = this;
                axios.get('onload-readyat-center-datas',{params:{}})
                    .then(function (res) {
                        _this.webfilePreloader = false;
                        _this.total_save = res.data.total_save;
                        _this.total_failed = res.data.total_fail;
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        });

    </script>

@endsection
