
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

    <title>{{ config('app.name', 'ИБИЗ') }}</title>

    <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/datatable.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.css">
    <link href="{{ asset('css/ptsans.css') }}" rel="stylesheet">

    @yield('style')

  <style>
    .icon-drop
    {
      height:30px;
      margin:0;
      padding:0;
      border:0;
    }

    .icon-medium
    {
      height:30px;
      margin:0;
      padding:0;
      background-color: #EDEDED;
      border:0;
    }
    table{
      font-size: 12px;
      text-align:left;

    }
    table td{
      padding: .45em;

    }
    .sidebar-dark-primary .sidebar a{
      color: #fff;
    }
    .sidebar-dark-primary .nav-treeview > .nav-item > .nav-link{
      color: #fff;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini @if(Auth::user()->menucollapse==1) sidebar-collapse @else sidebar-open @endif">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light border-bottom" >
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

      <li class="nav-item dropdown">
        @if ( Config::get('app.locale') == 'en')
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img id="imgNavSel" src="{{URL::asset('/images/Rus.png')}}" alt="..." class="img-thumbnail icon-medium">  <span id="lanNavSel"></span> <span class="caret"></span></a>


        @elseif ( Config::get('app.locale') == 'mn' )

          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img id="imgNavSel" src="{{URL::asset('/images/Mon.png')}}" alt="..." class="img-thumbnail icon-medium">  <span id="lanNavSel"></span> <span class="caret"></span></a>

        @endif
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          <a href="{{ url('setlocale/en')}}" id="navRus" class="dropdown-item language"> <img id="imgNavRus" src="{{URL::asset('/images/Rus.png')}}"  class="img-thumbnail icon-drop">   Русский</a>
          <div class="dropdown-divider"></div>
          <a href="{{ url('setlocale/mn')}}" id="navMon" class="dropdown-item language"> <img id="imgNavMon" src="{{URL::asset('/images/Mon.png')}}"  class="img-thumbnail icon-drop">   Монгол</a>

        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-user-circle fa-2x"></i>

        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          <a href="{{ route('profile') }}" class="dropdown-item">
            <i class="fa fa-envelope mr-2"></i> {{ trans('messages.password') }}

          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('logout') }}" class="dropdown-item">
            <i class="fa fa-users mr-2"></i> {{ trans('messages.logout') }}

          </a>

        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #0e6674; color: #fff">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
    <img src="{{ asset('img/ubtz_logo_128.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" {{--style="opacity: .8"--}}>
      <span class="brand-text font-weight-light" style=" color: #fff">НОКС - ИБИЗ</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/256-512.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="color: #fff">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-book"></i>
              <p>
                  {{ trans('messages.burtgel') }}
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('zaswar') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p> {{ trans('messages.zaswar') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('barilga') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p> {{ trans('messages.barilga') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a  href="{{ route('hurungu') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p> {{ trans('messages.hurungu') }}</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-wrench"></i>
              <p>
                  {{ trans('messages.setting') }}
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('prof') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>{{ trans('messages.albantushaal') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('employee') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>{{ trans('messages.ajiltan') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('state') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>{{ trans('messages.ajliintuluv') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('method') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>{{ trans('messages.ajliinarga') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('projecttype') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>{{ trans('messages.ajliinturul') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('executor') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>{{ trans('messages.guitsetgegch') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('constructor') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>{{ trans('messages.zahialagch') }}</p>
                </a>
              </li>



            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-newspaper-o"></i>
              <p>
                  {{ trans('messages.tailan') }}
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('main') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>{{ trans('messages.zaswar') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('mainib') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>{{ trans('messages.barilga') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>{{ trans('messages.hurungu') }}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('geree') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>{{ trans('messages.tailangeree') }}</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('album') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>  {{ trans('messages.tailanphoto') }}</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="" class="nav-link">
              <i class="nav-icon fa fa-bar-chart"></i>
              <p>
                Анализ
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{ route('analyseiz') }}" class="nav-link">
                          <i class="fa fa-circle-o nav-icon"></i>
                          <p>{{ trans('messages.zaswar') }}</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('analyseib') }}" class="nav-link">
                          <i class="fa fa-circle-o nav-icon"></i>
                          <p>{{ trans('messages.barilga') }}</p>
                      </a>
                  </li>
                <li class="nav-item">
                  <a href="{{ route('detailiz') }}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ trans('messages.zaswar') }} /дет/</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('detailib') }}" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ trans('messages.barilga') }} /дет/</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a  class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ trans('messages.hurungu') }}</p>
                  </a>
                </li>
              </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="" class="nav-link">
              <i class="nav-icon fa fa-book"></i>
              <p>
                {{ trans('messages.medeelel') }}

              </p>
            </a>
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

    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 СБМТА <a href="">НЧи Т.Сэлэнгэ</a></strong> 88877833
  </footer>
</div>
<!-- ./wrapper -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script src="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
@yield('script')
<script type="text/javascript">

    $(document).ready(function(){

        var rusImgLink = "{{URL::asset('/images/Rus.png')}}"
        var monImgLink = "{{URL::asset('/images/Mon.png')}}"
        var imgNavSel = $('#imgNavSel');
        var imgNavRus = $('#imgNavRus');
        var imgNavMon = $('#imgNavMon');
        var spanNavSel = $('#lanNavSel');
        imgNavRus.attr("src",rusImgLink);
        imgNavMon.attr("src",monImgLink);


        $( ".language" ).on( "click", function( event ) {

            var currentId = $(this).attr('id');
            if(currentId == "navRus") {
                imgNavSel.attr("src",rusImgLink);

            } else if (currentId == "navMon") {
                imgNavSel.attr("src",monImgLink);

            }

        });
    });
</script>
<script>
    function number_format(number, decimals, decPoint, thousandsSep){
        decimals = decimals || 0;
        number = parseFloat(number);

        if(!decPoint || !thousandsSep){
            decPoint = '.';
            thousandsSep = ',';
        }

        var roundedNumber = Math.round( Math.abs( number ) * ('1e' + decimals) ) + '';
        var numbersString = decimals ? roundedNumber.slice(0, decimals * -1) : roundedNumber;
        var decimalsString = decimals ? roundedNumber.slice(decimals * -1) : '';
        var formattedNumber = "";

        while(numbersString.length > 3){
            formattedNumber += thousandsSep + numbersString.slice(-3)
            numbersString = numbersString.slice(0,-3);
        }

        return (number < 0 ? '-' : '') + numbersString + formattedNumber + (decimalsString ? (decPoint + decimalsString) : '');
    }
</script>
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
    $(".date-picker").datepicker({
        dateFormat: 'yy-mm-dd'
    });
</script>

</body>
</html>
