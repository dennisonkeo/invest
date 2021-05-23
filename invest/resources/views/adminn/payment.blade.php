<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
  <title>Attention Adverts | Activate Account</title>
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

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
  <!-- WRAPPER -->
  <div id="wrapper" class="d-flex align-items-center justify-content-center" >
    <div class="auth-box register" >
      <div class="content">
        <div class="header">
          <div class="logo text-center" style="font-size: 25PX; font-weight: bold;">ATTENTION ADVERTS</div>
          <h4 class="lead" style="font-weight: bold;">Account Activation</h4>
          <div class="text-center"><img src="mpesa.jpg" style="width: 100%; height: 60px;"></div>
          <p>Whatsapp <b>0731670802</b> incase of any problem.</p>
          <ol>
            <li>Enter Phone number</li>
            <li>Click Make Payment</li>
            <li>Wait Mpesa Pop up</li>
            <li>Enter Mpesa pin</li>
          </ol>

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
        <form class="form-auth-small" method="POST" action="{{ route('make-payment') }}">
          {{ csrf_field() }}
          
          <div class="form-group">
            <label for="signup-email" class="control-label sr-only">Phone</label>
            <input type="text" class="form-control" id="signup-email" placeholder="Your phone number" value="{{ Auth::user()->phone_number }}" name="phone" required="" disabled="">
          </div>
          <div class="form-group">
            <label for="signup-password" class="control-label sr-only">Amount</label>
            <input type="text" class="form-control" id="signup-password" placeholder="Amount" value="500" name="amount" disabled="">
          </div>

          <button type="button" onclick="pay()" class="btn btn-primary btn-lg btn-block">Make Payment</button>
          <div class="bottom">
            <span class="helper-text">Have made payments? <a href="{{ route('login') }}">Login Now</a></span>
          </div>
        </form>
      </div>
    </div>
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script type="text/javascript">
    
    function pay()
    {
      Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    showLoaderOnConfirm: true,
                  }).then((result) => {
                    if (result.value) {
                         $.ajax({
                          url : "{{ route('make-payment') }}",
                          type: "POST",
                          data:{'_token':'{{ csrf_token() }}'},
                          dataType: "JSON",
                          success: function(data)
                          {                 
                                Swal.fire({
                                  title: 'Sent!',
                                  text: "Payment request has been sent to your phone, click OK when done!",
                                  icon: 'success',
                                  closeButtonText: 'No, cancel!',
                                }
                                ).then((result)=>{

                                  window.location.href = "{{ route('/') }}";
                                }
                                );
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                // alert('Error deleting data');
                                Swal.fire({
                                           title: 'Oops...',
                                            text: 'Error sending request!',
                                            icon: 'error',
                                          })
                            }
                        });                     
                    }
                  });
    }
  </script>
  <!-- END WRAPPER -->
</body>


</html>