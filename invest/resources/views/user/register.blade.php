<!DOCTYPE html>
<html lang="en" class="h-100">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Invest - Registration </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
	<link href="invest/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="invest/css/style.css" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<img src="images/logo-full.png" alt="">
									</div>
                                    <h4 class="text-center mb-4">Sign up your account</h4>
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
                                    <form method="POST" action="{{ route('register') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label class="mb-1"><strong>Full Name</strong></label>
                                            <input type="text" class="form-control" placeholder="Full Name" name="name" required="">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Phone Number</strong></label>
                                            <input type="text" class="form-control" placeholder="Phone Number" name="phone" required="">
                                        </div>
                                        <div class="form-group">
                                                <label class="mb-1"><strong>Country</strong></label>
                                                <select class="default-select form-control" id="inlineFormCustomSelect" name="country" required="">
                                                    <option selected>Choose...</option>
                                                    <option value="Kenya">Kenya</option>
                                                    <option value="Tanzania">Tanzania</option>
                                                    <option value="Uganda">Uganda</option>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input type="text" class="form-control" placeholder="username" name="username" required="">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" class="form-control" placeholder="hello@example.com" name="email" required="">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" value="Password" name="password" required="">
                                        </div>

                                        <div class="form-group">
                                            <label class="mb-1"><strong>Sponsor</strong></label>
                                            <input type="text" class="form-control" placeholder="(optional)" name="code">
                                        </div>
                                        <div class="form-group">
                                               <div class="custom-control custom-checkbox ml-1">
                                                    <input type="checkbox" class="custom-control-input" id="basic_checkbox_1" required="">
                                                    <label class="custom-control-label" for="basic_checkbox_1">Terms & Conditions</label>
                                                </div>
                                            </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Already have an account? <a class="text-primary" href="{{ route('login') }}">Sign in</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="invest/vendor/global/global.min.js"></script>
<script src="invest/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="invest/js/custom.min.js"></script>
<script src="invest/js/deznav-init.js"></script>
	<script src="invest/js/demo.js"></script>
    <!-- <script src="invest/js/styleSwitcher.js"></script> -->
</body>

</html>