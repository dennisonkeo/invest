<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ICMS|Registration</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="register/fonts/themify-icons/themify-icons.css">

    <!-- Main css -->
    <link rel="stylesheet" href="register/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>

    <div class="main">

        <div class="container">
            <h2><span style="color: #066cc4;">ICMS</span> <br> <span style="text-transform: capitalize;">Registration</span></h2>
            <form method="POST" id="signup-form" class="signup-form" action="register">
                {{ csrf_field() }}
                    <h3>
                        <span class="icon"><i class="ti-user"></i></span>
                        <span class="title_text">Basic</span>
                    </h3>
                    <fieldset>
                        <legend>
                            <span class="step-heading">Basic Informaltion: </span>
                            <span class="step-number">Step 1 / 3</span>
                        </legend>
                        <div class="form-group">
                            <label for="first_name" class="form-label required">First name</label>
                            <input type="text" name="first_name" id="first_name" />
                        </div>

                        <div class="form-group">
                            <label for="last_name" class="form-label required">Last name</label>
                            <input type="text" name="last_name" id="last_name" />
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label required">Phone</label>
                            <input type="number" name="phone" id="phone" />
                        </div>

                    </fieldset>

                    <h3>
                        <span class="icon"><i class="ti-home"></i></span>
                        <span class="title_text">Church Info</span>
                    </h3>
                    <fieldset>
                        <legend>
                            <span class="step-heading">Church Informaltion: </span>
                            <span class="step-number">Step 2 / 3</span>
                        </legend>
                        <div class="form-group">
                            <label for="bank_name" class="form-label required">Church Name</label>
                            <input type="text" name="church" id="bank_name" />
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label required">Church Phone</label>
                            <input type="number" name="church_phone" id="phone" />
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label required">Address</label>
                            <input type="text" name="address" id="address" />
                        </div>

                        <div class="form-select">
                            <label for="gender" class="form-label">Subscription Plan</label>
                            <div class="select-list">
                                <select name="subscriptionn" id="gender">
                                    <option value="">Choose One</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Annually">Annually</option>
                                </select>
                            </div>
                        </div>

                        <input type="text" name="subscription" id="subscription" style="display: none;">

                        <div class="form-row">
                            <div class="form-select">
                            <label for="country" class="form-label">No of Churches</label>
                            <div class="select-list">
                                <select name="plann" id="country">
                                    <option value="">Choose One</option>
                                    <option value="Single">Single</option>
                                    <option value="Multiple">Multiple</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="plan" id="plan">
    
                        <div class="form-group" id="church_no" style="display: none;">
                            <label for="phone" class="form-label required">How many?</label>
                            <input type="number" name="no_church" id="phone" />
                        </div>

                        </div>

                        {{-- <div class="form-select">
                            <label for="country" class="form-label">No of Churches</label>
                            <div class="select-list">
                                <select name="country" id="country">
                                    <option value="">Choose One</option>
                                    <option value="Single">Single</option>
                                    <option value="Multiple">America</option>
                                </select>
                            </div>
                        </div> --}}
                    </fieldset>

                    <h3>
                        <span class="icon"><i class="ti-lock"></i></span>
                        <span class="title_text">Account</span>
                    </h3>
                    <fieldset>
                        <legend>
                            <span class="step-heading">Account Informaltion: </span>
                            <span class="step-number">Step 3 / 3</span>
                        </legend>
                        <div class="form-group">
                            <label for="email" class="form-label required">Email</label>
                            <input type="email" name="email" id="email" />
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label required">Password</label>
                            <input type="password" name="password" id="password" />
                        </div>

                    </fieldset>



            </form>

            <footer style="background: #cc6600; color: #fff; width: 80%; margin-left:  auto; margin-right: auto; padding: 5px; border-radius: 5px; text-align: center;">

                    <a href="http://product.icms.co.ke" style=" pading: 10px; color: #fff; ">Already have an Account? Sign in</a>

            </footer>
        </div>

    </div>
    <div class="footer">
        
    </div>

    <!-- JS -->
    <script src="register/vendor/jquery/jquery.min.js"></script>
    <script src="register/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="register/vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="register/vendor/jquery-steps/jquery.steps.min.js"></script>
    <script src="register/vendor/minimalist-picker/dobpicker.js"></script>
    <script src="register/js/main.js"></script>

 <script type="text/javascript">
    $("#country li").click(function() {
    // alert(this.id); // id of clicked li by directly accessing DOMElement property
    // alert($(this).attr('id')); // jQuery's .attr() method, same but more verbose
    // alert($(this).html()); // gets innerHTML of clicked li
    // alert($(this).text()); // gets text contents of clicked li
    if($(this).text() == "Multiple")
    {
        document.getElementById("church_no").style.display = "block";
        $("#plan").val($(this).text());
    }
    else if($(this).text() == "Single")
    {
        document.getElementById("church_no").style.display = "none";
        $("#plan").val($(this).text());
    }
});

$("#gender li").click(function() {
    if($(this).text() == "Choose One")
    {
        // $("#subscription").val($(this).text());
        // alert("Please choose a subscription plan");
    }
    else
    {
        $("#subscription").val($(this).text());
    }

});
</script>
</body>
</html>