<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-Exam Smart</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="icon" href="{{ asset('assets_web/logo.png') }}" type="image/x-icon" />
  <link rel="shortcut icon" href="{{ asset('assets_web/logo.png') }}" type="image/x-icon" />
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
  <style>
.hide{
  display: none !important;
}
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('assets_web/logo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
      @auth('admin')
      <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" href="{{ route('logout') }} ">@lang('panel.dashboard.logout')</a>
      </li>
      @endauth
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets_web/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">@lang('panel.side_menue.smart_exam')</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          @auth('admin')
            <a href="" class="d-block">@lang('panel.side_menue.dashboard')</a>            
          @endauth

        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         @auth('admin')
          <li class="nav-item">
            <a href="" class="nav-link {{ request()->segment(2) == 'levels' ? 'active' : ''  }} ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  @lang('panel.side_menue.levels')
              </p>
            </a>
          </li>
          @endauth
          @auth('admin')
          <li class="nav-item">
            <a href="" class="nav-link {{ request()->segment(2) == 'departments' ? 'active' : ''  }}">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                @lang('panel.side_menue.departments')
              </p>
            </a>
          </li>
          @endauth
          @auth('admin')
          <li class="nav-item">
            <a href="" class="nav-link {{ request()->segment(2) == 'subjects' ? 'active' : '' }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                @lang('panel.side_menue.subjects')
              </p>
            </a>
          </li>
          @endauth
          @auth('admin')
          <li class="nav-item">
            <a href="" class="nav-link {{ request()->segment(2) == 'exams' ? 'active' : ''  }}">
              <i class="nav-icon fas fa-scroll"></i>
              <p>
                @lang('panel.side_menue.exams')
              </p>
            </a>
          </li>
          @endauth
          @auth('admin')
          <li class="nav-item">
            <a href="" class="nav-link {{ request()->segment(2) == 'professors' ? 'active' : ''  }}">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                @lang('panel.side_menue.professors')
              </p>
            </a>
          </li>
          @endauth
          @auth('admin')
          <li class="nav-item">
            <a href="" class="nav-link {{ request()->segment(2) == 'students' ? 'active' : ''  }}">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                @lang('panel.side_menue.students')
              </p>
            </a>
          </li>
          @endauth
          @auth('admin')
          <li class="nav-item">
            <a href="" class="nav-link {{ request()->segment(2) == 'admins' ? 'active' : ''  }}">
              <i class="nav-icon fas fa-user-lock"></i>
              <p>
                @lang('panel.side_menue.admins')
              </p>
            </a>
          </li>
          @endauth
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

@yield('content')
            <footer class="main-footer">
                <strong>Copyright &copy; 2022 <a href="/">Smart Exam</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                  <b>Design by Abdallah Fathy</b>
                </div>
              </footer>
            
              </aside>
              <!-- /.control-sidebar -->
            </div>
            <!-- ./wrapper -->
            
            <!-- jQuery -->
            <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
            <!-- jQuery UI 1.11.4 -->
            <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
            <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
            <script>
              $.widget.bridge('uibutton', $.ui.button)
            </script>
            <!-- Bootstrap 4 -->
            <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
            <!-- ChartJS -->
            <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
            <!-- Sparkline -->
            <script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
            <!-- JQVMap -->
            <script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
            <!-- jQuery Knob Chart -->
            <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
            <!-- daterangepicker -->
            <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
            <!-- Tempusdominus Bootstrap 4 -->
            <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
            <!-- Summernote -->
            <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
            <!-- overlayScrollbars -->
            <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
            <!-- AdminLTE App -->
            <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="{{ asset('assets/dist/js/demo.js') }}"></script>
            <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
            <script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
            <script>
              var res;
              $(".correct").click(function() {
                  res = $(this).parent().parent().parent().find("input[type='text']").val();
                  $("#correct").val(res);
              });
              
          </script>
            </body>
            </html>
            