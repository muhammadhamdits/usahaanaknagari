

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Usaha Anak Nagari | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ url('css/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}">Usaha Anak Nagari</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <div class="text-center">
                    <a href="{{ url('/') }}">
                        <img src="{{ url('img/LOGO-KKN3.png') }}" alt="" width="100" class="mb-3">
                    </a>
                </div>
                <p class="login-box-msg">Login to your account</p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mt-1">
                        <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('username')
                        <p class="text-danger text-sm">{{ $message }}</p>
                    @enderror
                    <div class="input-group mt-3">
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-danger text-sm">{{ $message }}</p>
                    @enderror
                    <p class="text-right text-sm mt-3">
                        <a href="" class="text-right">Lupa password?</a>
                    </p>
                    <div class="row mb-3">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <button type="reset" class="btn btn-secondary btn-block">Reset</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <p class="text-left text-sm">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang!</a>
                    </p>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <p class="text-right text-sm text-secondary float-right">
        Copyright &copy 2020 KKN Tematik FTI Unand
    </p>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ url('js/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('js/adminlte.min.js') }}"></script>

</body>
</html>