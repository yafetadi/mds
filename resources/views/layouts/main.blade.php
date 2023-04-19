<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PT. Mitra Distrindo Sejati</title>

  <!-- Styles -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  @stack('style')
  <style type="text/css">
    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: whitesmoke;
    }
    .preloader .loading {
      position: absolute;
      text-align: center;
      left: 50%;
      top: 50%;
      transform: translate(-50%,-50%);
      font: 14px arial;
    }
    .loading img {
      margin-top: 5px;
      margin-bottom: 5px;
    }
  </style>
  <!-- /.styles -->
</head>
<body class="hold-transition sidebar-mini" ng-app="appModule">
<div class="preloader">
  <div class="loading">
    <img src="{{ asset('logo.png') }}" width="90px"><br>
    <img src="{{ asset('loading.gif') }}">
    <p>Harap Tunggu</p>
  </div>
</div>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#modal-password" href="#">
          <i class="fas fa-key"></i>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" role="button" 
          href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="fas fa-power-off"></i>
        </a>
      </li>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar')
  <!-- /.main-sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer text-sm">
    <strong>Copyright &copy; 2023.</strong> PT. Mitra Distrindo Sejati
  </footer>
</div>
<!-- ./wrapper -->

<!-- Modal -->
<div class="modal fade" id="modal-password">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" action="{{ route('change-password', Auth::user()->id) }}">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Ganti Password {{ Auth::user()->name }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="text" name="id" value="{{ Auth::user()->id }}" hidden>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input id="password" class="form-control"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input id="password_confirmation" class="form-control"
                                            type="password"
                                            name="password_confirmation" required />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Scripts -->

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<!-- <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script> -->
<!-- <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script> -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mask/jquery.mask.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/adminlte.min.js') }}"></script>
@stack('script')
<script>
  $(document).ready(function(){
    $(".preloader").fadeOut();
  })
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#example2").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

    $("#example3").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false,
      "paging": false, "info": false, "searching": false
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

    $("#example4").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false,
      "paging": false, "info": false, "searching": true
    }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');

    $("#category-table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false,
      "info": false, "searching": false, "pageLength": 5
    }).buttons().container().appendTo('#category-table_wrapper .col-md-6:eq(0)');

    $("#report").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false,
      "paging": false, "info": false, "searching": false
    }).buttons().container().appendTo('#report_wrapper .col-md-6:eq(0)');

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $(document).ready(function(){
        $( '.uang' ).mask('000.000.000', {reverse: true});
    })

    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    @if (Session::get('success'))
      toastr.success("{{ Session::get('success') }}");
    @endif

    @if (Session::get('error'))
      toastr.error("{{ Session::get('error') }}");
    @endif
  });
</script>
<!-- ./script -->
</body>
</html>