@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Counter
@endsection

<!--Page Header-->
@section('page-header')


@endsection

<!--Page Content Start Here-->
@section('page-content')
    
    <div id="app4">
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
                                            @foreach($allService as $service)
                                                <option value="{{$service->svc_name}}">{{$service->svc_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="single-datadisplaybox-left">
                                    <div class="single-datadisplaybox">
                                        <p class="datadisplaybox-header regular-header">Current Q</p>
                                        <div class="regular-area datadisplaybox-regular">
                                            <li v-for="regular in regularDataList">@{{ regular.token_number }}</li>
                                        </div>
                                    </div>
                                </div>

                                <div  class="single-datadisplaybox-right">
                                    <div class="single-datadisplaybox">
                                        {{-- <button @click="sendToWaitingFunc"  class="btn btn-info">To Wait</button> --}}
                                        <p class="datadisplaybox-header waiting-header">Waiting Q</p>
                                        <div id="waiting_list" class="waiting-area datadisplaybox-waiting" style="height:245px">
                                            <li v-for="waiting in waitingDataList"><a>@{{ waiting.token_number }}</a></li>

                                        </div>
                                    </div>
                                    <div  class="single-datadisplaybox">
                                        {{-- <input @keyup.enter="sendToRecallFunc" style="width:70px" type="text" id="send_recall_id" placeholder="Press Enter"> --}}
                                        <p class="datadisplaybox-header recall-header">Recall Q</p>
                                        <div class="recall-area datadisplaybox-recall"  style="height:245px">
                                            <li v-for="recall in recallDataList"><a>@{{ recall.token_number }}</a></li>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="calltoken-area-center">
                                    <div v-show="webfilePreloader" class="webfile-preloader"><img class="preloader" src="{{asset("public/assets/img/preloader.gif")}}" alt=""></div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class=active-token-content">
                                                <h3 class="text-center">Active Token</h3>
                                                <table class="table table-responsive table-bordered" style="background:#FFF">
                                                    <thead>
                                                        <tr>
                                                            <th>Counter</th>
                                                            <th>Token</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(isset($activeToken))
                                                            @foreach ($activeToken as $item)
                                                                <tr>
                                                                    <td>{{$item->counterNo}}</td>
                                                                    <td>{{$item->token_number}}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="col-md-12">
                                                <div class="token-search-area" style="width:200px;float:right">
                                                    <div class="input-group">
                                                        <input type="search" id="token_search" class="form-control" placeholder="Enter Token" style="border:1px solid #ddd">
                                                        <span class="input-group-btn">
                                                            <button @click="searchTokenFunc" class="btn btn-default" type="button">Search</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="seach-token-info-area" style="background:#FFF;min-height:300px;border:1px solid #ddd;">
                                                    <table  v-if="serachTokenData" class="table table-responsive">
                                                            <thead>
                                                                <tr>
                                                                    <td>Token No</td>
                                                                    <td>Start Time(Sec)</td>
                                                                    <td>Stop Time(Sec)</td>
                                                                    <td>Waiting(Sec)</td>
                                                                    <td>Service(Sec)</td>
                                                                    <td>Counter</td>
                                                                    <td>Service By</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <tr v-for="(info,i) in searchTokenInfo" >
                                                                    <td>@{{info.tokenno}}</td>
                                                                    <td>@{{info.ststart}}</td>
                                                                    <td>@{{info.ststop}}</td>
                                                                    <td>@{{info.waiting}}</td>
                                                                    <td>@{{info.service}}</td>
                                                                    <td>@{{info.cno}}</td>
                                                                    <td>@{{info.servedby}}</td>
                                                                </tr>
                                                            </tbody>
                                                    </table>
                                                     <div  v-else="serachTokenData" class="table table-responsive table-striped">
                                                        <h3 class="text-center" style="color:#ddd">@{{token_info_not_found_msg}}</h3 class="text-center" style="color:#ddd">
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
            el:'#app4',
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
                serachTokenData:false,
                token_info_not_found_msg:'No Data Here',
                searchTokenInfo:[],

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

                    axios.get('call_token_data_axios', {
                        params: {
                            svc_name: service_type,
                            token_type: '2',
                            counter_id: counter_id,
                            user_id: user_id,
                            tkn_no: retkn_no
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
                searchTokenFunc: function(){
                    var _this = this;
                    var token_no = $('#token_search').val();
                    axios.get('search_token_info',{params:{token_no:token_no}})
                    .then(function(res){
                        console.log(res)
                        var status = res.data.status;
                        _this.serachTokenData = false;
                        if(status == 1){
                            _this.serachTokenData = true;
                            _this.searchTokenInfo = res.data.token_info;
                        }
                        else{
                            _this.serachTokenData = false;
                            _this.token_info_not_found_msg = 'Data Not Found';
                        }
                    })
                    .catch(function(error){
                        _this.serachTokenData = false;
                        console.log(error);
                    })
                }
            },
            created:function(){

                var _this = this;
                this.svc_name = document.getElementById('service_type').value;
                //this.selectedToken = false;


                setInterval(function(){
                    var svc_isset = _this.svc_name;
                    if(!svc_isset == ''){
                        axios.get('counter_call_get_data2',{params:{svc_name:_this.svc_name}})
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
                },5000);

               
            }

        });

    </script>

@endsection
