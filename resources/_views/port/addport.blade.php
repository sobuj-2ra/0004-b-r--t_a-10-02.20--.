@include('admin.inc.header')
@include('admin.inc.leftmenu')

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Port</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Port Endorsement
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                	{!! Form::open(['url' => 'port']) !!}
    

                                     
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" placeholder="Enter Name">
                                            <p class="help-block"></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input class="form-control" placeholder="Enter Designation">
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
                                    {!! Form::close() !!}
                                </div>
                               
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

@include('admin.inc.footer')