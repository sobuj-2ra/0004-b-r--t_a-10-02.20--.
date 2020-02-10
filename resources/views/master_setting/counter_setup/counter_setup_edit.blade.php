@extends('admin.master')
<!--Page Title-->
@section('page-title')
   Counter Setup
@endsection

<!--Page Header-->
@section('page-header')
Counter Setup

@endsection

<!--Page Content Start Here-->
@section('page-content')
    <div id="app2">
          <section class="content">
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
                          </div>
                          <div class="col-md-8 col-md-offset-2">


                              <!-- Modal -->
                              <form method="POST" autocomplete="off" action="{{URL::to('setting/counter-setup/update')}}">
                              <div class="panel panel-info">
                                  {{csrf_field()}}
                                <div class="panel-heading ">
                                  <span class="modal-title" id="exampleModalLabel"> </span>
                                </div>
                                <div class="panel-body">
                                    <p class="form_title_center">
                                      <b>-UPDATE COUNTER-</b>
                                    </p>

                                   <div class="row">
                                        <div class="col-md-8">
                                          <div class="form-group">
                                            <label for="username"><b>Host Name:</b></label>
                                            <input type="text" name="host_name" value="{{$CounterData->hostname}}" class="form-control" required>
                                          </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="username"><b>Counter Number:</b></label>
                                            <input type="number" name="counter_no" value="{{$CounterData->counter_no}}" class="form-control" required>
                                          </div>
                                        </div>
                                        <div class="col-md-8">
                                          <div class="form-group">
                                            <label for="username"><b>Counter IP:</b></label>
                                            <input type="text" name="counter_ip" value="{{$CounterData->ip}}" class="form-control"  required>
                                          </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="username"><b>Floor ID:</b></label>
                                            <select class="form-control" name="floor_no" id="floor_no" required>
                                              <option value=""></option>
                                              @foreach($allFloor as $floor)
                                                @if($CounterData->floor_id == $floor->floor_number)
                                                  <option value="{{$floor->floor_number}}" selected>{{$floor->floor_number}}</option>
                                                @else
                                                  <option value="{{$floor->floor_number}}">{{$floor->floor_number}}</option>
                                                @endif
                                              @endforeach
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <label for="username"><b>Service Name:</b></label>
                                            <select name="service_name[]" class=" form-control selectpicker" multiple data-live-search="true" required>
                                              <option value="" ></option>
                                              <?php

                                                $is_match = 0;
                                                foreach($allService as $service){
                                                  foreach($oldSvc as $svc){
                                                    if($svc == $service->svc_name){
                                                      ?><option value="{{$service->svc_name}}" selected>{{$service->svc_name}}</option> <?php
                                                      $is_match = 1;
                                                    }
                                                  }
                                                  if($is_match == 0){
                                                    ?><option value="{{$service->svc_name}}" >{{$service->svc_name}}</option><?php
                                                  }
                                                  
                                                  $is_match = 0;
                                                }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                  <input type="hidden" name="update_id" value="{{$CounterData->id}}">
                                  <button type="reset" class="btn btn-secondary" >Reset</button>
                                  <button type="submit" id="submit" class="btn btn-info">Update</button>
                                </div>
                              </div>
                            </form>

                          </div>
                        </div>
                      </div>
                  </div>
              </div>
          </section>

    </div>
      <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap-select.css')}}" />
      <script src="{{asset('public/assets/js/bootstrap-select.js')}}"></script>
    <script>

        var app = new Vue({
            el:"#app2",
            data:{

            },
            methods:{

            },
            created:function(){

            }
        });

    </script>
    <script type="text/javascript">
        $('select').selectpicker();
    </script>



@endsection
