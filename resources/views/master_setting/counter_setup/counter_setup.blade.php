@extends('admin.master')
<!--Page Title-->
@section('page-title')
   Counter Setup

@endsection

<!--Page Header-->
@section('page-header')
Counter Setup
       <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"> -->


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
                          <div class="col-md-8">
                              &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Add New Counter
                              </button>

                              <!-- Modal -->
                              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <form method="POST" autocomplete="off" action="{{URL::to('setting/counter-setup/create')}}">
                                      {{csrf_field()}}
                                    <div class="modal-header">
                                      <span class="modal-title" id="exampleModalLabel">Add New Counter</span>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="form_title_center">
                                      <b>-ADD NEW COUNTER-</b>
                                    </p>
                                      <div class="row">
                                        <div class="col-md-8">
                                          <div class="form-group">
                                            <label for="username"><b>Host Name:</b></label>
                                            <input type="text" name="host_name" value="" class="form-control" required>
                                          </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="username"><b>Counter Number:</b></label>
                                            <input type="number" name="counter_no" value="" class="form-control" required>
                                          </div>
                                        </div>
                                        <div class="col-md-8">
                                          <div class="form-group">
                                            <label for="username"><b>Counter IP:</b></label>
                                            <input type="text" name="counter_ip" value="" class="form-control" required>
                                          </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="username"><b>Floor ID:</b></label>
                                            <select class="form-control" name="floor_no" id="floor_no" required>
                                              <option value=""></option>
                                              @foreach($allFloor as $floor)
                                                <option value="{{$floor->floor_number}}">{{$floor->floor_number}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <label for="username"><b>Service Name:</b></label>
                                            <select name="service_name[]" class=" form-control selectpicker" multiple data-live-search="true" required>
                                              <option value="" ></option>
                                              @foreach($allService as $service)
                                                <option value="{{$service->svc_name}}">{{$service->svc_name}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                     
                                    </div>
                                    <div class="modal-footer">
                                      <button type="reset" class="btn btn-secondary" >Reset</button>
                                      <button type="submit" id="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <div class="col-md-4">
                            <div class="flash-message-area">

                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h3 class="text-center">All Counter List </h3>
                            <div class="sanctioned-view-area" style="background: #FFF;margin:15px">
                              <table class="table table-responsive">
                                <thead>
                                  <tr>
                                    <th>Counter No</th>
                                    <th>Host Name</th>
                                    <th>IP</th>
                                    <th>Service Name</th>
                                    <th>Entry By</th>
                                    <th>Floor Id</th>
                                    <th>Entry Date</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    if(count($allCounter) > 0){
                                      $i = 1;
                                      foreach ($allCounter as $Item) {
                                  ?>

                                      <tr>
                                        <td><?php echo $Item->counter_no; ?></td>
                                        <td><?php echo $Item->hostname; ?></td>
                                        <td><?php echo $Item->ip; ?></td>
                                        <td><?php echo $Item->svc_name; ?></td>
                                        <td><?php echo $Item->entryby; ?></td>
                                        <td><?php echo $Item->floor_id; ?></td>
                                        <td><?php echo $Item->entrydate; ?></td>
                                        <td><a onclick="return confirm('Are you sure! You want to Edit?')" class="btn btn-sm btn-primary" href="{{URL::to('/setting/counter-setup/edit').'/'.$Item->id}}"><i class="fa fa-edit"></i></a> <a onclick="return confirm('Are you sure! You want to Delete?')" class="btn btn-sm btn-danger" href="{{URL::to('/setting/counter-setup/destroy').'/'.$Item->id}}"><i class="fa fa-trash"></i></a></td>
                                      </tr>
                                  <?php
                                    $i++;
                                      }
                                  }

                                  ?>
                                </tbody>

                              </table>
                            </div>
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
