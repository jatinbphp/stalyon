<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"> -->
  <link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">


  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 
  <!-- <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
  <link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

  
  <!-- <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
  <link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

 
  <!-- <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css"> -->
  <link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/jqvmap/jqvmap.min.css') }}">

 
  <!-- <link rel="stylesheet" href="dist/css/adminlte.min.css"> -->
  <link rel="stylesheet" href="{{ URL::asset('assets/admin/dist/css/adminlte.min.css') }}">

  <!-- <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
  <link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
 
  <!-- <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css"> -->
  <link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/daterangepicker/daterangepicker.css') }}">


  <!-- <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css"> -->
  <link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/summernote/summernote-bs4.min.css') }}">

  <!-- //datatable -->

    <link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

     <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ url('admin/dashboard') }}" class="nav-link"></a>
            </li>
        </ul>
    </nav>
 
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" id="left-menubar" style="height: 100%; min-height:0!important; overflow-x: hidden;">
        <a href="{{ url('admin/dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light" style="padding-right: 50px;"><b>{{ config('app.name', 'Stalyon') }} Admin</b></span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview @if(isset($menu) && $menu=='Edit Profile') menu-open  @endif" style="border-bottom: 1px solid #4f5962; margin-bottom: 4.5%;">

                        <a href="#" class="nav-link @if(isset($menu) && $menu=='Edit Profile') active  @endif">
                            @if (!empty(Auth::guard('admin_web')->user()->image) && file_exists(Auth::guard('admin_web')->user()->image))
                                <img src=" {{asset(Auth::guard('admin_web')->user()->image)}}" class="img-circle elevation-2"  style="width: 2.1rem; margin-right: 1.5%;">
                            @else
                            <img src="{{url('assets/admin/dist/img/no-image.png')}}" class="img-circle elevation-2" style="width: 50px; margin-right: 1.5%;">
                            @endif
                            <p style="padding-right: 6.5%;">
                            {{ ucfirst(Auth::guard('admin_web')->user()->name) }}
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <?php $eid = \Illuminate\Support\Facades\Auth::guard('admin_web')->user()->id; ?>
                                <a href="{{ route('agents.index',['profile_update'=>$eid]) }}" class="nav-link @if(isset($menu) && $menu=='Edit Profile') active @endif">
                                    <i class="nav-icon fa fa-pencil"></i><p class="text-warning">Edit Profile</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.logout') }}" class="nav-link">
                                    <i class="nav-icon fa fa-sign-out"></i><p class="text-danger">Log out</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link @if(isset($menu) && $menu=='Dashboard') active @endif">
                            <i class="nav-icon fa fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
        
                     <li class="nav-item">
                        <a href="{{ route('agents.index') }}"class="nav-link @if(isset($menu) && $menu=='Agents') active @endif">
                            <i class="nav-icon fa fa-user-tie"></i>
                            <p>Agents</p>
                        </a>
                     </li>
                </ul>
            </nav>
        </div>
    </aside>
  @yield('content')


  <footer class="main-footer">
        <strong>{{ config('app.name', 'Stalyon') }} Admin</strong>
    </footer>
    
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/admin/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('assets/admin/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('assets/admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('assets/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/admin/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('assets/admin/dist/js/pages/dashboard.js') }}"></script>

<!-- datatable -->
<script src="{{ URL('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ URL('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ URL('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ URL('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ URL('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ URL('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ URL('assets/admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ URL('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
    function AjaxUploadImage(obj,id){
        var file = obj.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
        {
            $('#previewing'+URL).attr('src', 'noimage.png');
            alert("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
            return false;
        } else{
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(obj.files[0]);
        }

        function imageIsLoaded(e){
            $('#DisplayImage').css("display", "block");
            $('#DisplayImage').css("margin-top", "1.5%");
            $('#DisplayImage').attr('src', e.target.result);
            $('#DisplayImage').attr('width', '150');
        }
    }
</script>
@yield('jquery')
</body>
</html>
