<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Invest - Deposit History </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Datatable -->
    <link href="invest/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

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

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Balance {{ number_format(Auth::user()->deposit,2) }}</h4>
                                <div>
                                 
                                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProjectSidebar">Add <i class="fa fa-plus"></i></button>

                                 <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addProjectSidebar2">Transfer <i class="fa fa-exchange"></i></button>
                             </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Amount</th>
                                                <th>Phone</th>
                                                <th>Transaction No</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($deposits as $deposit)
                                            <tr>
                                                <td>{{ number_format($deposit->amount,2) }}</td>
                                                <td>{{ $deposit->phone }}</td>
                                                <td>{{ $deposit->transaction_code }}</td>
                                                <td>{{ $deposit->time }}</td>

                                            </tr>
                                            @endforeach

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- Add package -->
				<div class="modal fade" id="addProjectSidebar">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Deposit Funds</h5>
								<button type="button" class="close" data-dismiss="modal"><span>&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="POST" action="#">
									{{ csrf_field() }}

									<div class="form-group">
										<label class="text-black font-w500">Amount</label>
										<input type="number" class="form-control" name="amount" id="amount" required="">
									</div>
                                    <div class="form-group">
                                        <label class="text-black font-w500">Phone</label>
                                        <input type="text" class="form-control" name="phone" id="phone" value="{{ Auth::user()->phone }}" required="">
                                    </div>

									<div class="form-group">
										<button type="button" onclick="pay()" class="btn btn-primary">DEPOSIT</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>


                <!-- Transfer funds -->
                <div class="modal fade" id="addProjectSidebar2">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Transfer Funds (From Grand Wallet) <span class="badge light badge-primary">Wallet:{{ number_format(Auth::user()->wallet )}}</span></h5>
                                
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="#">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label class="text-black font-w500">Amount</label>
                                        <input type="number" class="form-control" name="amount" id="amount2" required="">
                                    </div>

                                    <div class="form-group">
                                        <button type="button" onclick="transfer()" class="btn btn-primary">TRANSFER</button>
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
    <!-- Datatable -->
    <script src="invest/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="invest/js/plugins-init/datatables.init.js"></script>

  <script type="text/javascript">
    
    function pay()
    {

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
                          url : "{{ route('mpesaDeposit') }}",
                          type: "POST",
                          data:{'_token':'{{ csrf_token() }}',
                                'amount': $('#amount').val(),
                                'phone': $('#phone').val()
                      },
                          dataType: "JSON",
                          success: function(data)
                          {                 
                                Swal.fire({
                                  title: 'Sent!',
                                  text: "Payment request has been sent to your phone, click OK when done!",
                                  type: 'success',
                                  closeButtonText: 'No, cancel!',
                                }
                                ).then((result)=>{

                                  location.reload();
                                }
                                );
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

    function transfer()
    {

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
                          url : "{{ route('transferFunds') }}",
                          type: "POST",
                          data:{'_token':'{{ csrf_token() }}',
                                'amount': $("#amount2").val()
                      },
                          dataType: "JSON",
                          success: function(data)
                          {
                           if(data.msg == 0)
                           {
                                Swal.fire({
                                  title: 'Success!',
                                  text: "Funds transferred successfully!",
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
                                            text: 'Sorry, you do not have sufficient balance in your Wallet!',
                                            type: 'error',
                                          })

                            }

                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                // alert('Error deleting data');
                                Swal.fire({
                                           title: 'Oops...',
                                            text: 'Error transferring funds!',
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