@extends('master.master')

@section('sidebar')
        <aside class="main-sidebar">

            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{asset('template')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>{{auth()->user()->name}}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                    </div>
                </form>

                <ul class="sidebar-menu tree" data-widget="tree">
                    {{--<li class="header">MAIN NAVIGATION</li>--}}
                    <li class="active treeview">
                        <a href="#">
                            <i class="fa fa-link"></i> <span>Permitted pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>


                        @foreach($menus as $item)


                            @if(in_array($item->id,$array))

                                <ul class="treeview-menu" style="display: none;">
                                    <li class="active"><a href="#"><i class="fa fa-circle-o"></i> {{$item->menu}}</a></li>

                                    @if(count($item->menus))

                                        @include('partial.manageChild',['menus' => $item->menus])

                                    @endif

                                </ul>

                            @endif


                        @endforeach









                    </li>

                </ul>
                <div class="col-xs-offset-1 ">
                    <a class="fa fa-dashboard" href="{{url('/create')}}"> Permission</a>

                </div>



            </section>
            <!-- /.sidebar -->


        </aside>

    @endsection
