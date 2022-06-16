<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Setoran Saham | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{  url('') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{  url('') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{  url('') }}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{  url('') }}/index2.html"><b>Sistem Informasi</b> <br/>Setoran Saham Pemda</a>
  </div>

  @if (session()->has('loginError'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('loginError') }}
                            </div>
                        @endif
  <!-- /.login-logo -->
  {{-- {{Hash::make('adminsaham123')}} --}}
  <div class="card">
    <div class="card-body login-card-body">
      {{-- <p class="login-box-msg">Login </p> --}}
      <div class="text-center mb-3">

        <img src="logo_bank_sumut.png" alt="logo" class="w-50 h-50">
      </div>

      {{-- {{bcrypt('adminsaham123')}} --}}
      <form action="/authenticate" method="post">
        @csrf
        <div class="input-group mb-3">
        
          
          <input type="text" class="form-control" placeholder="Username" name="username">
          
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          
          <input type="password" class="form-control" placeholder="Password" name="password">


          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
          <!-- /.col -->
          <div class="col-sm-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    
     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{  url('') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{  url('') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{  url('') }}/dist/js/adminlte.min.js"></script>
</body>
</html>
