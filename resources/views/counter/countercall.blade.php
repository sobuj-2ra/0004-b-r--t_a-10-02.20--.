@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Counter
@endsection

<!--Page Header-->
@section('page-header')
    @if(isset($counter_no) && $counter_no > 0)
        <div id="page-header">
            Counter: <span class="bold_text">{{$counter_no}}</span> &nbsp;&nbsp;&nbsp; User ID: <span class="bold_text" >{{$user_id}}</span> &nbsp;&nbsp;&nbsp; Center: <span class="bold_text" >{{@$center_name->center_name}}</span><span class="time float-right ">Time: <span class="bold_text">@{{ time }}</span></span></p>

        <!-- <p class="date">@{{ date }}</p> -->


        </div>
        <script>
            var clock = new Vue({
                el: '#page-header',
                data: {
                    time: '',
                    date: ''
                }
            });
            var week = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
            var timerID = setInterval(updateTime, 1000);
            updateTime();
            function updateTime() {
                var cd = new Date();
                clock.time = zeroPadding(cd.getHours(), 2) + ':' + zeroPadding(cd.getMinutes(), 2) + ':' + zeroPadding(cd.getSeconds(), 2);
                clock.date = zeroPadding(cd.getFullYear(), 4) + '-' + zeroPadding(cd.getMonth()+1, 2) + '-' + zeroPadding(cd.getDate(), 2) + ' ' + week[cd.getDay()];
            };

            function zeroPadding(num, digit) {
                var zero = '';
                for(var i = 0; i < digit; i++) {
                    zero += '0';
                }
                return (zero + num).slice(-digit);
            }
        </script>
    @else
        <h1 class="text-center">Opps! This Counter Is Not Registered</h1>
    @endif

@endsection

<!--Page Content Start Here-->
@section('page-content')
    @if(isset($counter_no) && $counter_no > 0)
    <div id="app1">
        <section class="content " style="position: relative;">
            <div v-if="onload_display_overlay" class="webfile-preloader_big_dark"><img class="preloader" src="{{asset("public/assets/img/preloader.gif")}}" alt=""><b style="text-align:center;display:inherit">Looding...</b></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="main_part countercall-area" >
                        <br>
                        @if(Session::has('message'))
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4 alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
                            </div>
                    @endif
                    <!-- Code Here.... -->

                        <div class="row">
                            <div class="col-md-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="service_type" style="font-weight:normal">Service Type</label>
                                        <select @change="svcNameFunc($event)" name="service_type" id="service_type" class="form-control">
                                            <option value=""></option>
                                            @foreach($counter_services as $service)
                                                <option value="{{$service}}">{{$service}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input id="counter_id" type="hidden" value="{{$counter_no}}">
                                    <input id="center_name" type="hidden" value="{{$center_name->center_name}}">
                                    <input id="user_id" type="hidden" value="{{$user_id}}">
                                    <input id="floor_id" type="hidden" value="{{$floor_id}}">
                                </div>
                                <div class="single-datadisplaybox-left">
                                    <div @click="regularAreaCLickFunc" class="single-datadisplaybox">
                                        <p class="datadisplaybox-header regular-header">Current Q</p>
                                        <div class="regular-area datadisplaybox-regular">
                                            <li v-for="regular in regularDataList">@{{ regular.token_number }}</li>
                                        </div>
                                    </div>
                                </div>

                                <div  class="single-datadisplaybox-right">
                                    <div class="single-datadisplaybox">
                                        <button @click="sendToWaitingFunc"  class="btn btn-info">To Wait</button>
                                        <p class="datadisplaybox-header waiting-header">Waiting Q</p>
                                        <div id="waiting_list" class="waiting-area datadisplaybox-waiting">
                                            <li v-for="waiting in waitingDataList"><a @click="waitingItemClick">@{{ waiting.token_number }}</a></li>

                                        </div>
                                    </div>
                                    <div  class="single-datadisplaybox">
                                        <input @keyup.enter="sendToRecallFunc" style="width:70px" type="text" id="send_recall_id" placeholder="Press Enter">
                                        <p class="datadisplaybox-header recall-header">Recall Q</p>
                                        <div class="recall-area datadisplaybox-recall">
                                            <li v-for="recall in recallDataList"><a @click="recallItemClick">@{{ recall.token_number }}</a></li>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="calltoken-area-center">
                                    <div v-show="webfilePreloader" class="webfile-preloader"><img class="preloader" src="{{asset("public/assets/img/preloader.gif")}}" alt=""></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="calltoken-right-content">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div style=" margin-bottom:30px;"><span  style="width:200px;display:inline-block;color:#000;font-size:25px;font-weight:300">Token No: &nbsp;<b id="selectedTokenDisplay">@{{selectedTokenval}}</b></span> <button  @click="sendToCallAgain" class="btn btn-success float-right">Call Again</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>

        var app = new Vue({
            el:'#app1',
            data:{
                onload_display_overlay:false,
                selectedToken:true,
                svc_name:'',
                regular:true,
                stkr_str:'',
                stkr_end:'',
                regularData:'',
                regularDataList:[],
                waitingDataList:[],
                recallDataList:[],
                passType:0,
                tokenNumber:'',
                test:'',
                webfileData:false,
                webfileDataNull:false,
                webfilePreloader:false,
                passportSearch:false,
                webfileUC:'',
                webfile2Value:'',
                cleanBtn:false,
                submitBtn:false,
                correctionShow:false,
                correctionList:[],
                corAllSelected:false,
                corItem:[],
                paytypeOptions:[],
                rejectCauseData:[],
                rejectItem:[],
                selectRejectAll: false,
                sslResMessage:'',
                submitModalShow:false,
                rejectModalShow:false,
                ivac_svc_fee:0,
                ttdDelDate:'',
                correctionFee:'',
                visaChecklist:[],
                txnNumber:'',
                txnDate:'',
                storeResMsg:'',
                storeResStatus:false,
                rejectResMsg:'',
                rejectResStatus:false,
                selectedTokenval:'',
                selectedTokenQty:'',
                styleRelative:'relative',
                styleIndex:'-2',

            },
            methods: {

                svcNameFunc: function (event) {
                    this.svc_name = event.target.value;
                    this.getdataserver = true;
                    //console.log(event.target.value);
                },
                clickFunc: function (event) {
                    console.log(event);
                },
                regularAreaCLickFunc: function () {
                    _this = this;
                    var service_type = document.getElementById('service_type').value;
                    var counter_id = document.getElementById('counter_id').value;
                    var user_id = document.getElementById('user_id').value;
                    var floor_id = document.getElementById('floor_id').value;
                    floor_id = Number(floor_id);
                    axios.get('call_token_data_axios', {
                        params: {
                            svc_name: service_type,
                            token_type: '1',
                            counter_id: counter_id,
                            floor_id: floor_id
                        }
                    })
                    .then(function (res) {
                        //_this.tokenNumber = res.token_res[0];
                        var obj = res.data.token_res[0];
                        const resultArray = Object.keys(obj).map(function (key) {
                            return [Number(key), obj[key]];
                        });
                        _this.selectedTokenval = resultArray[0][1];
                    })
                    .catch(function (error) {
                        console.log(error);
                    })

                },
                waitingItemClick: function () {
                    _this = this;
                    var wattkn_no = event.target;
                    wattkn_no = wattkn_no.innerHTML;
                    var service_type = document.getElementById('service_type').value;
                    var counter_id = document.getElementById('counter_id').value;
                    var user_id = document.getElementById('user_id').value;
                    var floor_id = document.getElementById('floor_id').value;
                    floor_id = Number(floor_id);

                    axios.get('call_token_data_axios', {
                        params: {
                            svc_name: service_type,
                            token_type: '2',
                            counter_id: counter_id,
                            user_id: user_id,
                            tkn_no: wattkn_no,
                            floor_id: floor_id
                        }
                    })
                        .then(function (res) {
                            var obj = res.data.token_res[0];
                            const resultArray = Object.keys(obj).map(function (key) {
                                return [Number(key), obj[key]];
                            });
                            _this.selectedTokenval = resultArray[0][1];
                            _this.selectedTokenQty = resultArray[1][1];
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                },
                recallItemClick: function () {
                    _this = this;
                    var retkn_no = event.target;
                    retkn_no = retkn_no.innerHTML;
                    var service_type = document.getElementById('service_type').value;
                    var counter_id = document.getElementById('counter_id').value;
                    var user_id = document.getElementById('user_id').value;
                    var floor_id = document.getElementById('floor_id').value;
                    axios.get('call_token_data_axios', {
                        params: {
                            svc_name: service_type,
                            token_type: '2',
                            counter_id: counter_id,
                            user_id: user_id,
                            tkn_no: retkn_no,
                            floor_id: floor_id
                        }
                    })
                        .then(function (res) {
                            var obj = res.data.token_res[0];
                            const resultArray = Object.keys(obj).map(function (key) {
                                return [Number(key), obj[key]];
                            });
                            _this.selectedTokenval = resultArray[0][1];
                            _this.selectedTokenQty = resultArray[1][1];
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                },
                sendToWaitingFunc: function () {
                    if (this.selectedTokenval != '') {
                        console.log(this.selectedTokenval);
                        var service_type = document.getElementById('service_type').value
                        var floor_id = document.getElementById('floor_id').value
                        axios.get('send-token-to-waiting-axios', {
                            params: {
                                token: this.selectedTokenval,
                                type: '2',
                                service_type: service_type,
                                floor_id: floor_id
                            }
                        })
                            .then(function (res) {
                                console.log(res);
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    }
                    else {
                        alert('Please Select Token')
                    }
                },
                sendToRecallFunc: function () {
                    //console.log(this.selectedTokenval);
                    var recallVal = document.getElementById('send_recall_id').value;
                    var service_type = document.getElementById('service_type').value;
                    var floor_id = document.getElementById('floor_id').value;
                    if(service_type != ''){
                        axios.get('send-token-to-recall-axios', {
                            params: {
                                token: recallVal,
                                type: '3',
                                service_type: service_type,
                                floor_id: floor_id
                            }
                        })
                            .then(function (res) {
                                console.log(res);
                                document.getElementById('send_recall_id').value = '';
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    }
                    else{
                        alert('Please Select Service Type');
                    }

                },
                sendToCallAgain: function(){



                    var token = this.selectedTokenval;
                    var counter_id = document.getElementById('counter_id').value;
                    var user_id = document.getElementById('user_id').value;
                    var floor_id = document.getElementById('floor_id').value;
                    var service_type = document.getElementById('service_type').value;
                    if(service_type == ''){
                      alert('Select Service Type');
                    }
                    else{
                          if(token == ''){
                            alert('Please Select Token');
                          }
                          else{
                              axios.get('send_for_call_again', {
                                  params: {
                                      token: token,
                                      counter_id: counter_id,
                                      user_id: user_id,
                                      floor_id: floor_id,
                                      svc_name: service_type,
                                  }
                              })
                              .then(function (res) {
                                  console.log('hello');
                              })
                              .catch(function (error) {
                                  console.log('error');
                              })
                          }
                    }
                },
            },
            created:function(){

                var _this = this;
                this.svc_name = document.getElementById('service_type').value;
                //this.selectedToken = false;


                setInterval(function(){
                    var svc_isset = _this.svc_name;
                    if(!svc_isset == ''){
                        axios.get('counter_call_get_data',{params:{svc_name:_this.svc_name}})
                            .then(function(res){
                                _this.regularDataList = res.data.regulars;
                                _this.waitingDataList = res.data.waitings;
                                _this.recallDataList = res.data.recalls;
                                //console.log(res.data);
                                //console.log(res.data.regulars);
                            })
                            .catch(function(error){
                                console.log(error);
                            })
                    }

                    //_this.selectedTokenval

                    if(_this.selectedTokenval == ''){
                        _this.selectedToken = false;
                    }else{
                        _this.selectedToken = true;
                    }

                },5000);

                _this = this;
                axios.get('get_data_onload_axios').then(function(res){
                    _this.rejectCauseData = res.data.rejectCause;
                    _this.correctionList = res.data.correctionFee;
                    _this.correctionFee = res.data.corFee.corrFee;
                    // document.getElementById('total_save_count').innerText = res.data.total_save;
                    // document.getElementById('total_reject_count').innerText = res.data.rejectCount;

                    //console.log(res.data);
                })
                .catch(function(error){
                    console.log(error);
                })
            }

        });

    </script>

    @endif
@endsection
