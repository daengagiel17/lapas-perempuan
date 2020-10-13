<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Laravel | Log in</title>
  <!--====== Favicon Icon ======-->
  <link rel="shortcut icon" href="{{ asset('img/favicon.jpg')}}" type="image/jpg">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <i class="icon fas fa-ban"></i> {{ $message }}
    </div>
  @endif

  <div class="login-logo">
    <h2><b>Admin</b>Laravel</h2>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{ route('login.otp') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-default btn-block">
          <i class="fas fa-mobile-alt mr-2"></i> Sign In using Number Phone
        </button>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="{{ route('login.provider', ['provider' => 'facebook' ]) }}" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="{{ route('login.provider', ['provider' => 'twitter' ]) }}" class="btn btn-block btn-info">
          <i class="fab fa-twitter mr-2"></i> Sign in using Twitter
        </a>
        <a href="{{ route('login.provider', ['provider' => 'google' ]) }}" class="btn btn-block btn-danger">
          <i class="fab fa-google mr-2"></i> Sign in using Google
        </a>
        </div>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
