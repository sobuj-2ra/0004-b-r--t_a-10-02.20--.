    @include('admin.inc.header')
            <!-- /.navbar-top-links -->
    @include('admin.inc.leftmenu')
            <!-- /.navbar-static-side -->

              <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header ">
      <h1>
        @yield('page-header')
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        @yield('page-content')
        
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
     
    @yield('page-script')
    @include('admin.inc.footer')

