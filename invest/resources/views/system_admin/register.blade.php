<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
  <title>Attention Adverts | Register</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!-- App css -->
  <link href="{{ asset('admin/assets/css/bootstrap-custom.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}">

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
</head>
<body>
  <!-- WRAPPER -->
  <div id="wrapper" class="d-flex align-items-center justify-content-center" >
    <div class="auth-box register">
      <div class="content">
        <div class="header">
          <div class="logo text-center" style="font-size: 25PX; font-weight: bold;">ATTENTION ADVERTS</div>
          <p class="lead">Create an account</p>
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
        <form class="form-auth-small" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
                  <div class="form-group">
            <label for="signup-email" class="control-label sr-only">Mpesa Name</label>
            <input type="text" class="form-control" placeholder="Mpesa Name" name="name">
          </div>
          <div class="form-group">
            <label for="signup-email" class="control-label sr-only">Username</label>
            <input type="text" class="form-control" placeholder="Username" name="username">
          </div>

          <div class="form-group">
            <label for="signup-email" class="control-label sr-only">Phone</label>
            <input type="text" class="form-control" placeholder="Phone" name="phone_number" required="">
            <small>Format:2547xxxxxxxx</small>
          </div>

          <div class="form-group row">
                        {{-- <label for="ticket-type" class="col-sm-3 col-form-label">Payment Method</label> --}}
                        <div class="col-sm-12">
                          <select id="ticket-type" name="ticket-type" class="form-control" name="" required="">
                            <option value="">---select country---</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Tanzania">Tanzania</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Burundi">Burundi</option>
         
                          </select>
                        </div>
                        <input type="hidden" name="country" id="country">
                      </div>

          
          <div class="form-group">
            <label for="signup-email" class="control-label sr-only">Email</label>
            <input type="email" class="form-control" id="signup-email" placeholder="Your email" name="email">
          </div>
          <div class="form-group">
            <label for="signup-password" class="control-label sr-only">Password</label>
            <input type="password" class="form-control" id="signup-password" placeholder="Password" name="password">
          </div>

          <div class="form-group">
            <label for="signup-email" class="control-label sr-only">Referral Code</label>
            <input type="text" class="form-control" placeholder="Referral Code (optional)" value="{{ $username }}" name="code">
          </div>

          <button type="submit" class="btn btn-primary btn-lg btn-block">REGISTER</button>
          <div class="bottom">
            <span class="helper-text">Already have an account? <a href="{{ route('login') }}">Login</a></span>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END WRAPPER -->



  <script type="text/javascript">
    
      $('#ticket-type').on('change', function(e) {
   
    var option = e.target.value;
    $('#country').val(option);

  }); 

  </script>
</body>

</html>