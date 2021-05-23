<!doctype html>
<html lang="en" class="fullscreen-bg">

<!-- Mirrored from demo.thedevelovers.com/dashboard/klorofilpro-v2.0/page-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Jul 2020 08:41:38 GMT -->
<head>
  <title>Attention Adverts | Login</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!-- App css -->
  <link href="admin/assets/css/bootstrap-custom.min.css" rel="stylesheet" type="text/css" />
  <link href="admin/assets/css/app.min.css" rel="stylesheet" type="text/css" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">

  <!-- Favicon -->
  <link rel="shortcut icon" href="admin/assets/images/favicon.png">
</head>
<body>
  <!-- WRAPPER -->
  <div id="wrapper" class="d-flex align-items-center justify-content-center" >
    <div class="auth-box register" >
      <div class="content">
        <div class="header">
          <div class="logo text-center" style="font-size: 25PX; font-weight: bold;">ATTENTION ADVERTS</div>
          <p class="lead">Login</p>
          @include('admin.errors')

              @if (session('success'))
                          <div class="alert alert-success alert-dismissable">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              {{ session('success') }}
                          </div>
                         @endif
                          @if (session('warning'))
                          <div class="alert alert-danger">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              {{ session('warning') }}
                          </div>
                         @endif 
        </div>
        <form class="form-auth-small" method="POST" action="login">
          {{ csrf_field() }}
          
          <div class="form-group">
            <label for="signup-email" class="control-label sr-only">Email</label>
            <input type="email" class="form-control" id="signup-email" placeholder="Your email" name="email">
          </div>
          <div class="form-group">
            <label for="signup-password" class="control-label sr-only">Password</label>
            <input type="password" class="form-control" id="signup-password" placeholder="Password" name="password">
          </div>

          <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
          <div class="bottom">
            <span class="helper-text">Don't have an account? <a href="{{ route('register') }}">Register</a></span>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END WRAPPER -->
</body>

<!-- Mirrored from demo.thedevelovers.com/dashboard/klorofilpro-v2.0/page-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Jul 2020 08:41:38 GMT -->
</html>