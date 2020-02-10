@include('admin.inc.header')
@include('admin.inc.leftmenu')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Menu</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
    <div class="col-md-6 clo-xs-offset-3">
        <div class="login-logo">
            <a href="#"><b>View</b>Menu</a>
        </div>

    <div class="row">

        <div class="col-md-6">

            <ul class="checktree">

                    @foreach($menus as $item)
                      
                        @if(in_array($item->id, $array))

                    <li><input id="{{$item->id}}" type="checkbox" /><label for="assistantmanager3">{{ $item->menu }}</label></li>
					
                        <li style="list-style: none">
                            <input id="{{$item->id}}" type="checkbox"  /><label for="assistantmanager3">{{ $item->menu }}</label>
                            <a href="{{ $item->id }}"><span>{{ $item->menu }}</span> <i class="fa fa-angle-left pull-right"></i></a>

                            @if(count($item->menus))

                                @include('menu.manageChild',['menus' => $item->menus])

                            @endif
                    @endif

                    @endforeach



            </ul>





        </div>
    </div>


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







