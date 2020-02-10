@extends('admin.master')
<!--Page Title-->
@section('page-title')
   Center Setup
@endsection

<!--Page Header-->
@section('page-header')
Center Setup

@endsection

<!--Page Content Start Here-->
@section('page-content')
    <div id="app2">
          <section class="content">
              <div class="row">
                  <div class="col-md-12">
                      <div class="main_part gray-back" >
                          <br>
                          <!-- Code Here.... -->
                          <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                  <div class="center-setup">
                                    <form action="{{ URL::to('setting/center-setup/create') }}" method="post">
                                        <div class="col-md-4">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                              <label for="status">Server Name:</label><br>
                                              <input type="text" name="ServerName" value="{{@$serverName}}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                              <label for="status">COMPORT:</label><br>
                                              <input type="text" name="Comport" value="{{@$Comport}}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                              <label for="status">DBQT:</label><br>
                                              <input type="text" name="DBQT" value="{{@$dbqt}}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                              <label for="status">Center Name:</label><br>
                                              <select class="form-control" name="CenterName">
                                                <?php
                                                    if(@$centerName == ''){
                                                ?>
                                                        <option value=""></option>
                                                <?php
                                                    }
                                                    foreach ($centerAll as  $value){
                                                      if($centerName == $value->center_name){
                                                  ?>
                                                        <option value="{{$value->center_name}}" selected>{{$value->center_name}}</option>
                                                  <?php
                                                        }
                                                        else{
                                                  ?>
                                                          <option value="{{$value->center_name}}">{{$value->center_name}}</option>
                                                  <?php
                                                        }
                                                      }
                                                   ?>
                                              </select>
                                            </div>
                                            <div class="form-group">
                                              <label for="status">Payment API:</label><br>
                                              <input type="text" name="payment_api" value="{{@$payment_api}}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                              <label for="back_location">Backup Location:</label><br>
                                              <input  type="file" name="BackupMIN" id="back_location"  class="form-control" webkitdirectory directory multiple="false" >
                                            </div>

                                            <hr>
                                            <div class="footer-box">
                                              <button type="submit" id="submit" class="btn btn-primary">UPDATE</button>
                                              <br><br>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="barcode">Barcode Input:</label><br>
                                            <select  name="Barcode" id="barcode" class="form-control">
                                               <option value="Webfile" <?php if(@$Barcode == 'Webfile'){ echo "selected";}?>>Webfile</option>
                                               <option value="Passport"  <?php if(@$Barcode == 'Passport'){ echo "selected";}?>>Passport</option>
                                            </select>
                                          </div>

                                          <div class="form-group">
                                            <label for="audio_floor">Audio Floor:</label><br>
                                            <input type="text" name="audio_floor" id="audio_floor" value="{{@$audio_floor}}" class="form-control"  style="">
                                          </div>
                                          <div class="form-container">
                                              <label for="backup_int">Backup Interval:</label><br>
                                              <input type="text" name="BackupMIN" id="backup_int" value="{{@$BackupMIN}}" class="input-field form-control" style="width:85%;float:left">
                                              <label for="status" class="after-input-label">&nbsp;MIN</label>
                                          </div>
                                          <div class="form-group">
                                            <label for="upload_int">Upload Interval:</label><br>
                                            <input type="number" id="upload_int" name="UploadMIN" value="{{@$UploadMIN}}" class="form-control" style="width:85%;float:left">
                                            <label for="status" class="after-input-label">&nbsp;MIN</label>
                                          </div>
                                          <div class="form-group">
                                            <label for="debug">Debug:</label><br>
                                            <input type="text" name="debug" value="{{@$debug}}" class="form-control"  style="width:50%">
                                          </div>
                                          <div class="form-group">
                                            <label for="upload_size">Batch Upload Size:</label>
                                            <input type="number" name="UploadSize" value="{{@$UploadSize}}" class="form-control" style="width:50%">
                                          </div>
                                        </div>
                                      </form>
                                      <div class="col-md-4">
                                        @if(Session::has('statusMsg'))
                                          <div class="alert alert-success">
                                              {{Session::get('statusMsg')}}
                                          </div>
                                        @endif
                                      </div>
                                  </div>

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
