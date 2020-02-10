@extends('admin.master')
<!--Page Title-->
@section('page-title')
   Queue Service
@endsection

<!--Page Header-->
@section('page-header')
Queue Service

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
                              <form method="POST" autocomplete="off" action="{{URL::to('setting/queue-setup/update')}}">
                              <div class="panel panel-info">
                                  {{csrf_field()}}
                                <div class="panel-heading ">
                                  <span class="modal-title" id="exampleModalLabel"></span>
                                </div>
                                <div class="panel-body">
                                  <p class="form_title_center">
                                  <b>-UPDATE QUEUE SERVICE-</b>
                                </p>


                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="username"><b>Service Number:</b></label>
                                        <input type="number" name="svc_number" value="{{$ServiceData->svc_number}}" class="form-control" required>
                                      </div>
                                    </div>
                                    <div class="col-md-8">
                                      <div class="form-group">
                                        <label for="username"><b>Service Name:</b></label>
                                        <input type="text" name="svc_name" value="{{$ServiceData->svc_name}}" class="form-control" required>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="username"><b>Token Qty:</b></label>
                                           <input type="number" name="token_qty" value="{{$ServiceData->qty}}" class="form-control" required>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="username"><b>Default Qty:</b></label>
                                          <input type="number" name="default_qty" value="{{$ServiceData->defCon}}" class="form-control" required>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="username"><b>Active:</b></label>
                                           <select class="form-control" name="active_status" required>
                                              <option value="1" <?php if($ServiceData->status == '1'){echo 'selected';} ?> >Yes</option>
                                              <option value="0" <?php if($ServiceData->status == '0'){echo 'selected';} ?> >No</option>
                                           </select>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                                <div class="panel-footer">
                                  <input type="hidden" name="update_id" value="{{$ServiceData->id}}">
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

    </script>



@endsection
