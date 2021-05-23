<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Invest - Withdrawal History </title>
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
        @include('admin.navBar')
        <!--**********************************
            Nav header end
        ***********************************-->
		
		<!--**********************************
            Chat box start
        ***********************************-->
		@include('admin.chat')
		<!--**********************************
            Chat box End
        ***********************************-->


		
		
        <!--**********************************
            Header start
        ***********************************-->
        @include('admin.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
       @include('admin.sideBar')
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
                                <h4 class="card-title">Users Withdrawals</h4>
                                 {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProjectSidebar">Withdraw <i class="fa fa-money"></i></button> --}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Amount</th>
                                                <th>Transaction Time</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($withdrawals as $withdrawal)
                                            <tr>
                                                <td>{{ $withdrawal->user->name }}</td>
                                                <td>{{ $withdrawal->user->phone }}</td>
                                                <td>{{ $withdrawal->amount }}</td>
                                                <td>{{ $withdrawal->date }}</td>
                                                
                                                @if($withdrawal->status == 0)
                                                    <td><span class="badge light badge-danger">Pending</span></td>
                                                @else
                                                    <td><span class="badge light badge-primary">Completed</span></td>
                                                @endif
                                                

                                              <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                                       <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                    </button>
                                                     <div class="dropdown-menu">
                                                       <a onclick="completed({{ $withdrawal->id }})" class="dropdown-item" href="#">Completed</a>
                                                       <a onclick="pending({{ $withdrawal->id }})" class="dropdown-item" href="#">Pending</a>
                                                     </div>
                          </div>
                        </td>
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
								<h5 class="modal-title">Withdraw Funds (Minimum withdrawal Ksh 300)</h5>
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
										<button type="button" onclick="withdraw()" class="btn btn-primary">WITHDRAW</button>
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
        @include('admin.footer')
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

  function completed(id)
{
  var url = '{{ route("completed", ":id") }}';
  url = url.replace(':id', id);

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

                      window.location=url
                    
                    }
                  });
}  


function pending(id)
{
  var url = '{{ route("pending", ":id") }}';
  url = url.replace(':id', id);

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

                      window.location=url
                    
                    }
                  });
}

    
function withdraw()
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
                          url : "{{ route('withdrawFunds') }}",
                          type: "POST",
                          data:{'_token':'{{ csrf_token() }}',
                                'amount': $("#amount").val()
                      },
                          dataType: "JSON",
                          success: function(data)
                          {
                           if(data.msg == 0)
                           {
                                Swal.fire({
                                  title: 'Success!',
                                  text: "Request sent successfully!",
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
                            else if(data.msg == 2)
                            {
                                Swal.fire({
                                           title: 'Oops...',
                                            text: 'Sorry, the amount should not be less than Ksh 500!',
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