<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Invest - User Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="invest/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="invest/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="invest/css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        @include('user.navBar')
        <!--**********************************
            Nav header end
        ***********************************-->
		
		<!--**********************************
            Chat box start
        ***********************************-->
		@include('user.chat')
		<!--**********************************
            Chat box End
        ***********************************-->


		
		
        <!--**********************************
            Header start
        ***********************************-->
        @include('user.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
       @include('user.sideBar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">
			<div class="container-fluid">

                <div class="row">                   

                {{-- <a href="javascript:void(0);" class="btn btn-primary" disabled >Enrolled <i class="fa fa-check-circle-o"></i></a> --}}


                    @foreach($packages as $package)

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header bg-scondary" style="background: #2A2A2A;">
                                <h5 class="card-title text-white">{{ $package->name }}</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $package->details }}</p>
                            </div>
                            <div class="card-footer d-sm-flex justify-content-between align-items-center">
                                <div class="card-footer-link mb-4 mb-sm-0">
                                    <p class="card-text text-dark d-inline"><span class="badge light badge-dark">Price:{{ number_format($package->amount )}}</span> </p>
                                </div>
                                @if($package->packageUsers->where('user_id', Auth::user()->id)->where('status', 1)->first())
                                  <a href="javascript:void(0);" class="btn btn-primary" disabled >Enrolled <i class="fa fa-check-circle-o"></i></a>
                                
                                @else
                                     <a onclick="enroll({{ $package->id }})" href="javascript:void(0);" class="btn btn-primary">Enroll Now</a>
                                @endif
                                {{-- {{ $package->packageUsers->where('user_id', Auth::user()->id)->where('status', 1) }} --}}

                                
                            </div>
                        </div>
                    </div>
                   @endforeach

                </div>
            </div>
        </div>


        <!-- enroll to package -->
				<div class="modal fade" id="addProjectSidebar">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Enroll To This Package</h5>
								<button type="button" class="close" data-dismiss="modal"><span>&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="POST" action="#">
									{{ csrf_field() }}

									<div class="form-group">
										<label class="text-black font-w500">Pay using</label>
										<select class="default-select form-control" id="inlineFormCustomSelect" name="method" required="">
          
                                           <option value="">Choose one...</option>
                                           <option value="grand">Grand Wallet</option>
                                           <option value="deposit">Deposit Wallet</option>
                                        </select>
									</div>
                                    <input type="hidden" name="id" id="id">

									<div class="form-group">
										<button type="button" onclick="pay()" class="btn btn-primary">ENROLL</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        @include('user.footer')
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->

        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="invest/vendor/global/global.min.js"></script>
	<script src="invest/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="invest/js/custom.min.js"></script>
	<script src="invest/js/deznav-init.js"></script>
	<script src="invest/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="invest/js/plugins-init/sweetalert.init.js"></script>
	<script src="invest/js/demo.js"></script>

	<script>

		function enroll(id)
		{
			// console.log(id);
			$("#id").val(id);
			$('#addProjectSidebar').modal('show');
		}
    
     function pay()
    {
    	var method = $('#inlineFormCustomSelect option:selected').val();

  //   $('#inlineFormCustomSelect').on('change', function(e) {
   
  //   var option = e.target.value;

  //   console.log($('#inlineFormCustomSelect option:selected').val());
  //   method = option;

  // });

    if($('#inlineFormCustomSelect option:selected').val() == "")
    {
    	alert('Choose payment option');
    	return false;
    }


      Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    showLoaderOnConfirm: true,
                  }).then((result) => {
                    if (result.value) {
                         $.ajax({
                          url : "{{ route('packageSub') }}",
                          type: "POST",
                          data:{'_token':'{{ csrf_token() }}',
                                'id': $("#id").val(),
                                'method': method
                      },
                          dataType: "JSON",
                          success: function(data)
                          {
                           if(data.msg == 0)
                           {
                                Swal.fire({
                                  title: 'Sent!',
                                  text: "You've successfully enrolled to this package!",
                                  type: 'success',
                                  closeButtonText: 'No, cancel!',
                                }
                                ).then((result)=>{

                                  location.reload();
                                }
                                );
                            }
                            else if(data.msg == 1)
                            {
                            	Swal.fire({
                                           title: 'Oops...',
                                            text: 'Sorr, you have already enrolled to this package!',
                                            type: 'error',
                                          })

                            }
                            else if(data.msg == 2)
                            {
                            	Swal.fire({
                                           title: 'Oops...',
                                            text: 'Sorry, you do not have sufficient balance to enroll to this package!',
                                            type: 'error',
                                          })

                            }

                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                // alert('Error deleting data');
                                Swal.fire({
                                           title: 'Oops...',
                                            text: 'Error sending request!',
                                            type: 'error',
                                          })
                            }
                        });                     
                    }
                  });
    }
  </script>
</body>

</html>