@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Manage Queue
@endsection

<!--Page Header-->
@section('page-header')
    Manage Queue

@endsection

<!--Page Content Start Here-->
@section('page-content')
    <div id="app3">
          <section class="content" style="position: relative;">
             <div v-if="onload_display_overlay" class="webfile-preloader_big_dark"><img class="preloader" src="{{asset("public/assets/img/preloader.gif")}}" alt=""><b style="text-align:center;display:inherit">Looding...</b></div>

              <div class="row">
                  <div class="col-md-12">
                      <div class="main_part gray-back" >
                        <div class="row">
                          <div class="col-sm-6 col-sm-offset-3">
                            <br>
                              @if(Session::has('msg'))
                                  <div class="alert alert-{{Session::get('status')}}">
                                      <span>{{Session::get('msg')}}</span>
                                  </div>
                              @endif
                              <div v-if="statusSuccess" class="alert alert-success">
                                  <span>@{{ resSuccessMsg }}</span>
                              </div>
                              <div v-if="statusFaild" class="alert alert-danger">
                                  <span id="msg_faild">Data Couldn\'t Delete</span>
                              </div>
                              <div v-if="statusNotFound" class="alert alert-warning">
                                  <span> Data Not Found</span>
                              </div>

                          </div>
                          <div class="col-md-6 col-md-offset-3">


                              <!-- Modal -->
                              <div class="panel panel-danger">
                               <div v-if="PreloaderImg" class="webfile-preloader"><img class="preloader" src="{{asset("public/assets/img/preloader.gif")}}" alt=""></div>

                                  {{csrf_field()}}
                                <div class="panel-heading ">
                                  <span class="modal-title" id="exampleModalLabel"></span>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-8 col-md-offset-2">
                                      <div class="form-group">
                                        <label for="floor_id"><b>Select Floor:</b></label>
                                          <select class="form-control" name="floor" id="floor_id">
                                              <option value=""></option>
                                              @foreach($allFloor as $floor)
                                                  <option value="{{$floor->floor_number}}">{{$floor->floor_number}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                      <div class="form-group">
                                        <label for="service_id"><b>Select Service:</b></label>
                                          <select class="form-control" name="service" id="service_id">
                                              <option value=""></option>
                                              @foreach($allService as $service)
                                                  <option value="{{$service->svc_number}}">{{$service->svc_name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                      <div class="form-group">
                                        <label for="pending_token"><b>Delete All Pending Token:</b></label>
                                          <button @click="pendingTokenFunc" id="pending_token" class="btn btn-danger">DELETE TOKEN</button>
                                      </div>
                                      <div class="form-group">
                                        <label for="history_token"><b>Delete All Token History:</b></label>
                                          <button @click="historyTokenFunc" id="history_token" class="btn btn-danger">RESTART TOKEN</button>
                                      </div>
                                        <br>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-8">
                                                    <input id="issue_token_id" type="number" class="form-control" placeholder="Enter Issue Token From">
                                                </div>
                                                <div class="col-md-4">
                                                    <button @click="issue_tokenFunc" class="btn btn-info">SET TOKEN</button>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="form-group">
                                                <div class="col-md-8">
                                                    <input type="number" id="create_token_id" class="form-control" placeholder="Enter Token Number">
                                                </div>
                                                <div class="col-md-4">
                                                    <button @click="createTokenFunc" class="btn btn-info">CREATE TOKEN</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
          </section>
        </div>
    <script type="text/javascript">

        var app = new Vue({
            el:"#app3",
            data:{
                PreloaderImg:false,
                statusSuccess:false,
                statusFaild:false,
                statusNotFound:false,
                resSuccessMsg:'',
            },
            methods:{
                pendingTokenFunc:function(e){
                    e.preventDefault();
                    var floor_id = $('#floor_id').val();
                    var service_id = $('#service_id').val();
                    var  _this = this;
                    if(floor_id == ''){
                        alert('Select Floor');
                    }
                    else{
                        if(service_id == ''){
                            alert('Select Service')
                        }
                        else{
                            this.PreloaderImg = true;
                            axios.get("{{URL::to('manage_queue_pending_token_axios')}}",{params:{floor_id:floor_id,service_id:service_id}})
                                .then(function(res){
                                    console.log(res)
                                    var status = res.data.status;
                                    if(status == 'yes'){
                                        _this.resSuccessMsg = 'Token Deleted Successfully';
                                        _this.statusFaild = false;
                                        _this.statusNotFound = false
                                        _this.statusSuccess = true;
                                    }
                                    else{
                                        if(status == 'no'){
                                            _this.statusSuccess = false;
                                            _this.statusNotFound = false
                                            _this.statusFaild = true;
                                        }
                                        else{
                                            _this.statusSuccess = false;
                                            _this.statusFaild = false;
                                            _this.statusNotFound = true
                                        }
                                    }
                                    setTimeout(function() {
                                        location.reload();
                                    }, 3);
                                })
                                .catch(function(error){
                                    console.log(error)
                                })
                        }
                    }
                },
                historyTokenFunc:function(){
                    var floor_id = $('#floor_id').val();
                    var service_id = $('#service_id').val();
                    var  _this = this;
                    if(floor_id == ''){
                        alert('Select Floor');
                    }
                    else{
                        if(service_id == ''){
                            alert('Select Service')
                        }
                        else{
                            this.PreloaderImg = true
                            axios.get("{{URL::to('manage_queue_history_token_axios')}}",{params:{floor_id:floor_id,service_id:service_id}})
                                .then(function(res){
                                    console.log(res)
                                    var status = res.data.status;
                                    if(status == 'yes'){
                                        _this.resSuccessMsg = 'Token Deleted Successfully';
                                        _this.statusFaild = false;
                                        _this.statusNotFound = false
                                        _this.statusSuccess = true;
                                    }
                                    else{
                                        if(status == 'no'){
                                            _this.statusSuccess = false;
                                            _this.statusNotFound = false
                                            _this.statusFaild = true;
                                        }
                                        else{
                                            _this.statusSuccess = false;
                                            _this.statusFaild = false;
                                            _this.statusNotFound = true
                                        }
                                    }

                                    setTimeout(function() {
                                        location.reload();
                                    }, 3);
                                })
                                .catch(function(error){

                                    console.log(error)
                                })
                        }
                    }
                },
                issue_tokenFunc:function(){
                    var issue_token_id = $('#issue_token_id').val();
                    var floor_id = $('#floor_id').val();
                    var service_id = $('#service_id').val();
                    var  _this = this;
                    if(floor_id == ''){
                        alert('Select Floor');
                    }
                    else{
                        if(service_id == ''){
                            alert('Select Service')
                        }
                        else{
                            if(issue_token_id == ''){
                                alert('Empty Issue Token')
                            }
                            else{
                                this.PreloaderImg = true
                                axios.get("{{URL::to('manage_queue_issue_token_axios')}}",{params:{issue_token_id:issue_token_id,floor_id:floor_id,service_id:service_id}})
                                    .then(function(res){
                                        console.log(res)
                                        var status = res.data.status;
                                        if(status == 'yes'){
                                            _this.resSuccessMsg = 'Issue Token Set Successfully';
                                            _this.statusFaild = false;
                                            _this.statusNotFound = false
                                            _this.statusSuccess = true;
                                        }
                                        else{
                                            if(status == 'no'){
                                                _this.statusSuccess = false;
                                                _this.statusNotFound = false
                                                _this.statusFaild = true;
                                            }
                                            else{
                                                _this.statusSuccess = false;
                                                _this.statusFaild = false;
                                                _this.statusNotFound = true
                                            }
                                        }


                                        setTimeout(function() {
                                            location.reload();
                                        }, 3);

                                    })
                                    .catch(function(error){

                                        console.log(error)
                                    })
                            }
                        }
                    }

                },
                createTokenFunc:function() {
                    var create_token_id = $('#create_token_id').val();
                    var floor_id = $('#floor_id').val();
                    var service_id = $('#service_id').val();
                    var _this = this;
                    if (floor_id == '') {
                        alert('Select Floor');
                    }
                    else {
                        if (service_id == '') {
                            alert('Select Service')
                        }
                        else {
                            if (create_token_id == '') {
                                alert('Empty Token Number')
                            }
                            else {
                                this.PreloaderImg = true
                                axios.get("{{URL::to('manage_queue_create_token_axios')}}", {
                                    params: {
                                        create_token_id: create_token_id,
                                        floor_id: floor_id,
                                        service_id: service_id
                                    }
                                })
                                    .then(function (res) {
                                        console.log(res)
                                        var status = res.data.status;
                                        if (status == 'yes') {
                                            _this.resSuccessMsg = 'Token Create Successfully';
                                            _this.statusFaild = false;
                                            _this.statusNotFound = false
                                            _this.statusSuccess = true;
                                        }
                                        else {
                                            if (status == 'no') {
                                                _this.statusSuccess = false;
                                                _this.statusNotFound = false
                                                _this.statusFaild = true;
                                            }
                                            else {
                                                _this.statusSuccess = false;
                                                _this.statusFaild = false;
                                                _this.statusNotFound = true
                                            }
                                        }

                                        setTimeout(function() {
                                            location.reload();
                                        }, 3);
                                    })
                                    .catch(function (error) {

                                        console.log(error)
                                    })
                            }
                        }
                    }
                }



            },
            created:function(){
            }
        });

    </script>
    <script type="text/javascript">

    </script>

@endsection
