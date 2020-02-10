     <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{{ url('/home') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
						<li>
                            <a href="{{ url('/create') }}"><i class="fa fa-dashboard fa-fw"></i> Create User</a>
                        </li>
						<li>
                            <a href="{{ url('/menu/create') }}"><i class="fa fa-dashboard fa-fw"></i> Create Menu</a>
                        </li>
						<li>
                            <a href="{{ url('/menu/index') }}"><i class="fa fa-dashboard fa-fw"></i> View Menu</a>
                        </li>
						<li>
                            <a href="{{ url('/print') }}"><i class="fa fa-dashboard fa-fw"></i> Print Page</a>
                        </li>
						
						<li>
                            <a href="{{ url('/search') }}"><i class="fa fa-dashboard fa-fw"></i> Passport Search</a>
                        </li>
						
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Additional Services<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Port Androsement</a>
                                </li>
                                <li>
                                    <a href="{{ url('/rap/pap') }}">R.A.P / P.A.P</a>
                                </li>
                                 <li>
                                    <a href="{{ url('/rap/listview') }}">List View</a>
                                </li>
                            
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       
                    </ul>
					

                </div>
                <!-- /.sidebar-collapse -->
            </div>
             </nav>