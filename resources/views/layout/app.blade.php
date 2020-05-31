<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Usaha Anak Nagari</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ url('css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('css/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ url('css/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url('css/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('css/summernote-bs4.css') }}">
    <!-- Select2 -->
    <!-- <link rel="stylesheet" href="{{ url('css/select2.min.css') }}"> -->
    <!-- <link rel="stylesheet" href="{{ url('css/select2-bootstrap4.min') }}"> -->

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- jQuery -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/r-2.2.5/sp-1.1.1/datatables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <style>
        li .select2-selection{
            width: 200px !important;
            height: calc(1.8125rem + 2px) !important;
        }
        li .select2-selection__arrow{
            height: calc(1.8125rem + 2px) !important;
            right: 8px !important;
        }
        li .select2-container--default .select2-selection--single .select2-selection__rendered{
            line-height: 16.5px !important;
        }
    </style>
    @yield('css')
    @if(!Auth::guard('admin')->check() && !Auth::guard('web')->check())
    <style>
        a.text-primary:hover{
            color: white !important;
        }
    </style>
    @endif
    @toastr_css
    @yield('script')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
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
                <!-- Messages Dropdown Menu -->
                @if(Auth::guard('admin')->check() || Auth::guard('web')->check())
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                        @if(Auth::guard('web')->check()){{ Auth::guard('web')->user()->username }} @elseif(Auth::guard('admin')->check()){{ Auth::guard('admin')->user()->username }} @else Guest @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item mb-3">
                            <!-- Message Start -->
                            <div class="text-center">
                                <img src="{{ url('img/avatar04.png') }}" alt="User Avatar" class="img-size-50 mx-auto d-block img-circle">
                            </div>
                            <div class="text-center">
                                <h3 class="dropdown-item-title">
                                    @if(Auth::guard('web')->check()){{ Auth::guard('web')->user()->username }} @elseif(Auth::guard('admin')->check()){{ Auth::guard('admin')->user()->username }} @else Guest @endif
                                </h3>
                            </div>
                            <!-- Message End -->
                        </a>
                        <a href="#" class="text-dark">
                            <p class="text-sm text-center">Ubah Password?</p>
                        </a>
                        <div class="dropdown-divider mt-2"></div>
                        <a href="{{ route('logOut') }}" class="dropdown-item dropdown-footer"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>
                @else
                <li class="nav-item mr-3">
                    <a href="{{ route('login') }}" class="nav-link btn btn-primary text-white">Login</a>
                </li>
                <li class="nav-item mr-3">
                    <a href="{{ route('register') }}" class="nav-link btn btn-outline-primary text-primary">Daftar</a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ url('img/uan.png') }}" alt="Usaha Anak Nagari" class="rounded mx-auto d-block" style="filter: brightness(0) invert(1); margin-top:-11%; margin-bottom:-10%"  height="80">
                <span class="brand-text font-weight-light"></span>
            </a>
            <!-- ./brand-logo -->

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ url('img/avatar04.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">@if(Auth::guard('web')->check()){{ Auth::guard('web')->user()->username }} @elseif(Auth::guard('admin')->check()){{ Auth::guard('admin')->user()->username }} @else Guest @endif</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                        <!-- Dashboard -->
                        <li class="nav-item has-treeview menu-open">
                            <a href="{{ url('/') }}" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        @if(Auth::guard('web')->check() || Auth::guard('admin')->check())
                        <!-- Usaha -->
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Usaha
                                    <span class="right badge badge-info">78</span>
                                </p>
                            </a>
                        </li>
                        @endif

                        @if(Auth::guard('admin')->check())
                        <!-- Pemilik -->
                        <li class="nav-item has-treeview">
                            <a href="{{ route('owners.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Pemilik
                                    <span class="badge badge-info right">15</span>
                                </p>
                            </a>
                        </li>

                        <!-- Jenis Usaha -->
                        <li class="nav-item has-treeview">
                            <a href="{{ route('jenisusaha.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Jenis Usaha
                                    <span class="badge badge-info right">8</span>
                                </p>
                            </a>
                        </li>
                        @endif

                        <!-- Search by Name -->
                        <li class="nav-header" style="margin-bottom: -20px">
                            <div class="form-group">
                                <label for="usaha">Search by Name</label><br>
                                <input type="text" class="form-control-sm" style="width: 100%; height: 35px; border-radius:5px;" placeholder="Masukkan Nama Usaha ..." id="usaha">
                            </div>
                        </li>


                        <!-- Search by Radius -->
                        <li class="nav-header" style="margin-bottom: -20px">
                            <div class="form-group">
                                <label for="">Search by Radius</label><br>
                                <p>Radius: <span id="value"></span> m</p>
                                <input type="range" min="1" max="10000" value="0" id="regionRange" style="width: 100%;">
                                <div>
                                    <p style="float: left;">0</p>
                                    <p class="text-right">10000</p>
                                </div>
                                
                            </div>
                        </li>

                        <!-- Search by Region -->
                        <li class="nav-header" style="margin-bottom: -20px;">
                            <div class="form-group">
                                <label for="">Search by Region</label><br>
                                <select class="select2" style="width: 100%;">
                                    <option selected="selected" disabled>Choose Region</option>
                                    <option>Kota Padang</option>
                                    <option>Kab. Solok</option>
                                    <option>Kab. 50 Kota</option>
                                </select>
                            </div>
                        </li>

                        <!-- Search by Business Type -->
                        <li class="nav-header">
                            <div class="form-group">
                                <label for="">Search by Business Type</label><br>
                                <select class="select2" style="width: 100%;">
                                    <option selected="selected" disabled>Choose Business Type</option>
                                    <option>Makanan Atau Bahan Makanan</option>
                                    <option>Photocopy/Print</option>
                                    <option>Toko Kelontong</option>
                                </select>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- /.main-sidebar -->




        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <footer class="main-footer text-center text-small">
            Copyright &copy; 2020 KKN Tematik FTI Unand
        </footer>
        <!-- /.footer -->

    </div>
    <!-- ./wrapper -->

    
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ url('js/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ url('js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ url('js/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ url('js/jquery.vmap.min.js') }}"></script>
    <script src="{{ url('js/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ url('js/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ url('js/moment.min.js') }}"></script>
    <script src="{{ url('js/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ url('js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ url('js/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ url('js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ url('js/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('js/demo.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/r-2.2.5/sp-1.1.1/datatables.min.js"></script>
    @yield('js')
    <!-- Select2 -->
    <!-- <script src="{{ url('js/select2.full.min.js') }}"></script> -->
    <script>
        // Select2
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            // $('.select2bs4').select2({
            // theme: 'bootstrap4'
            // })
        })

        // Range Slider
        var slider = document.getElementById("regionRange");
        var output = document.getElementById("value");
        output.innerHTML = slider.value; // Display the default slider value

        // Update the current slider value (each time you drag the slider handle)
        slider.oninput = function() {
            output.innerHTML = this.value;
        }

    </script>
</body>
    @toastr_js
    @toastr_render
</html>
