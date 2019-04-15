
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ЗТҮС') }}</title>

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css') }}">
    <link href="{{ asset('css/ptsans.css') }}" rel="stylesheet">

    @yield('style')
</head>
<body class="hold-transition sidebar-mini @if(Auth::user()->menucollapse==1) sidebar-collapse @else sidebar-open @endif">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" id="pushmenu"><i class="fa fa-bars"></i></a>
      </li>

    </ul>

    <!-- SEARCH FORM 
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('logout') }}" class="nav-link">Системээс гарах</a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
    <img src="{{ asset('img/ubtz_logo_128.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" {{--style="opacity: .8"--}}>
      <span class="brand-text font-weight-light">НОКС - ИБИЗ</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user8-128x128.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Бүртгэл
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('barilga') }}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Их барилга</p>
                      </a>
                    </li>

            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Тохиргоо
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('prof') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Албан тушаал</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('employee') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Ажилтан</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('state') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Ажлын төлөв</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('method') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Ажлын арга</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('projecttype') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Ажлын төрөл</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('executor') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Гүйцэтгэгч</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('constructor') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Захиалагч</p>
                </a>
              </li>




            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 СБМТА <a href="">НЧи Т.Сэлэнгэ</a></strong> 88877833
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- AdminLTE App -->
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js') }}"></script>
@yield('script')
<script>
    // Show active menu
    var url = window.location;
    let menu = $('ul.nav-treeview a').filter(function() {
        return this.href == url;
    }).siblings();
    menu.removeClass('active').end().addClass('active');

    let parent = $('li.has-treeview a').filter(function() {
        return this.href == url;
    }).parentsUntil(".nav-treeview > .has-treeview").siblings();
    parent.removeClass('menu-open').end().addClass('menu-open');
    parent.find(".has-treeview > .nav-link").removeClass('active').end().addClass('active');

    //save user menu state
    $('#pushmenu').click(function() {
        let val = 0;
        if($('body,html').hasClass('sidebar-open')) {
            val = 1;
        }
        $.get( "/collapsemenu/"+val);
    });
</script>
</body>
</html>
