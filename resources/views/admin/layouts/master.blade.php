<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <link rel="shortcut icon" href="{{ asset('admin/img/ico.png') }}" >
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/1efdbeb1a4.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="{{asset('admin/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/skins/skin-blue.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/admin.css')}}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{asset('fav/apple-touch-icon.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('fav/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('fav/favicon-16x16.png')}}">
  <link rel="manifest" href="{{asset('fav/site.webmanifest')}}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  @yield('styles')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->

<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{route('home')}}" class="logo">
      Home
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
        <li class="{{{ (Request::is('adminpanel') ? 'active' : '') }}}"><a href="{{route('adminpanel')}}"><i class="fa fa-copy"></i> <span>Adminpanel</span></a></li>
        <li class="{{{ (Request::is('adminpanel/tutors') ? 'active' : '') }}}"><a href="{{route('admin.tutors')}}"><i class="fa fa-copy"></i> <span>Tutors</span></a></li>
        <li class="{{{ (Request::is('adminpanel/students') ? 'active' : '') }}}"><a href="{{route('admin.students')}}"><i class="fa fa-copy"></i> <span>Students</span></a></li>
        <li class="{{{ (Request::is('adminpanel/countries') ? 'active' : '') }}}"><a href="{{route('admin.countries')}}"><i class="fa fa-copy"></i> <span>Locations</span></a></li>
        <li class="{{{ (Request::is('adminpanel/disciplines') ? 'active' : '') }}}"><a href="{{route('admin.disciplines')}}"><i class="fa fa-copy"></i> <span>Disciplines</span></a></li>
        <li class="{{{ (Request::is('adminpanel/levels') ? 'active' : '') }}}"><a href="{{route('admin.levels')}}"><i class="fa fa-copy"></i> <span>Levels</span></a></li>
        <li class="{{{ (Request::is('adminpanel/settings') ? 'active' : '') }}}"><a href="{{route('admin.settings')}}"><i class="fa fa-copy"></i> <span>Settings</span></a></li>
        <li class="{{{ (Request::is('adminpanel/admins') ? 'active' : '') }}}"><a href="{{route('admin.admins')}}"><i class="fa fa-copy"></i> <span>Admins</span></a></li>
        <li class="{{{ (Request::is('adminpanel/add-admin') ? 'active' : '') }}}"><a href="{{route('admin.add.admin')}}"><i class="fa fa-copy"></i> <span>Add Admins</span></a></li>
        {{-- <li {{{ (Request::is('adminpanel/topics') ? 'active' : '') }}}"><a href="{{route('topics')}}"><i class="fa fa-comments"></i> <span>Teachers</span></a></li>
        <li class="treeview  {{{ (Request::is('adminpanel/insights') ? 'active' : '') }}}">
          <a href="#">
            <i class="fa fa-eye"></i> <span>Insights</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {{{ (Request::is('adminpanel/insights') ? 'class=active' : '') }}}><a href="{{route('insights')}}"><i class="fa fa-circle-o"></i>All</a></li>
            <li {{{ (Request::is('adminpanel/add-insight') ? 'class=active' : '') }}}><a href="{{route('add.insight')}}"><i class="fa fa-circle-o"></i>Add New</a></li>
          </ul>
        </li>
        <li class="treeview  {{{ (Request::is('adminpanel/series') ? 'active' : '') }}}">
          <a href="#">
            <i class="fa fa-calendar"></i> <span>Series</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li {{{ (Request::is('adminpanel/series') ? 'class=active' : '') }}}><a href="{{route('series')}}"><i class="fa fa-circle-o"></i>All</a></li>
            <li {{{ (Request::is('adminpanel/add-series') ? 'class=active' : '') }}}><a href="{{route('add.series')}}"><i class="fa fa-circle-o"></i>Add New</a></li>
          </ul>
        </li> --}}


        {{-- @endif --}}
        <hr>
        {{-- <li style="background: #962400"><a href="{{route('')}}"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li> --}}
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session()->has('message'))
    <div class="alert alert-danger">
      {{session()->get('message')}}
    </div>
    @endif
    <!-- Main content -->
    <section class="content">

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('admin/js/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
{{-- <!-- SlimScroll -->
<script src="{{asset('js/jquery.min.js')}}../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{asset('js/jquery.min.js')}}../../bower_components/fastclick/lib/fastclick.js"></script> --}}
<!-- AdminLTE App -->
<script src="{{asset('admin/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{asset('js/adminlte.min.js')}}../../dist/js/demo.js"></script> --}}
<script type="text/javascript" src="{{asset('admin/js/tinymce/tinymce.min.js')}}"></script>
{{-- <script src="{{asset('js/moment.js')}}"></script> --}}
<script src="{{asset('admin/js/jquery-ui.min.js')}}"></script>
@yield('scripts')
</body>
</html>
