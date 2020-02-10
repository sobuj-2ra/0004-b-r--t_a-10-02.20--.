@extends('admin.master')
<!--Page Title-->
@section('page-title')
   Center Service
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
                          <div class="col-md-8">
                              &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Add Queue Service
                              </button>

                              <!-- Modal -->
                              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <form method="POST" autocomplete="off" action="{{URL::to('setting/queue-setup/create')}}">
                                      {{csrf_field()}}
                                    <div class="modal-header">
                                      <span class="modal-title" id="exampleModalLabel">Add Queue Service</span>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">

                                        <p class="form_title_center">
                                      <b>-ADD QUEUE SERVICE-</b>
                                    </p>


                                      <div class="row">
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="username"><b>Service Number:</b></label>
                                            <input type="number" name="svc_number" value="" class="form-control" required>
                                          </div>
                                        </div>
                                        <div class="col-md-8">
                                          <div class="form-group">
                                            <label for="username"><b>Service Name:</b></label>
                                            <input type="text" name="svc_name" value="" class="form-control" required>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-4">
                                            <div class="form-group">
                                              <label for="username"><b>Token Qty:</b></label>
                                               <input type="number" name="token_qty" value="" class="form-control" required>
                                            </div>
                                          </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                              <label for="username"><b>Default Qty:</b></label>
                                              <input type="number" name="default_qty" value="" class="form-control" required>
                                            </div>
                                          </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                              <label for="username"><b>Select Time:</b></label>
                                                <input class="timepicker form-control" data-format="hh:mm:ss" >
                                            </div>
                                          </div>
                                          <div class="col-md-4">
                                            <div class="form-group">
                                              <label for="username"><b>Active:</b></label>
                                               <select class="form-control" name="active_status" required>
                                                  <option value="1">Yes</option>
                                                  <option value="0">No</option>
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
                            <h3 class="text-center">All Queue Services </h3>
                            <div class="sanctioned-view-area" style="background: #FFF;margin:15px">
                              <table class="table table-responsive">
                                <thead>
                                  <tr>
                                    <th>Sl</th>
                                    <th>Service Name</th>
                                    <th>Service No</th>
                                    <th>Token Qty</th>
                                    <th>Start WT</th>
                                    <th>Default Qty</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    if(count($allServices) > 0){
                                      $i = 1;
                                      foreach ($allServices as $Item) {
                                  ?>

                                      <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $Item->svc_name; ?></td>
                                        <td><?php echo $Item->svc_number; ?></td>
                                        <td><?php echo $Item->qty; ?></td>
                                        <td><?php echo $Item->startWT; ?></td>
                                        <td><?php echo $Item->defCon; ?></td>
                                        <td>
                                          <?php
                                           if($Item->status == 1)
                                           {echo 'Active';}
                                           else{echo 'Inactive';}
                                           ?>
                                         </td>
                                        <td><a onclick="return confirm('Are you sure! You want to Edit?')" class="btn btn-sm btn-primary" href="{{URL::to('/setting/queue-setup/edit').'/'.$Item->id}}"><i class="fa fa-edit"></i></a> <a onclick="return confirm('Are you sure! You want to Delete?')" class="btn btn-sm btn-danger" href="{{URL::to('/setting/queue-setup/destroy').'/'.$Item->id}}"><i class="fa fa-trash"></i></a></td>
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
    <script src="https://rawgit.com/Eonasdan/bootstrap-datetimepicker/master/build/js/bootstrap-datetimepicker.min.js"></script>



    <script type="text/javascript">
      $(document).ready(function(){
           $('input.timepicker').timepicker({
              timeFormat: 'hh:',
              minTime: '11:45:00' // 11:45:00 AM,
              maxHour: 20,
              maxMinutes: 30,
              startTime: new Date(0,0,0,15,0,0) // 3:00:00 PM - noon
              interval: 15 // 15 minutes
          });
      });
    </script>



@endsection
