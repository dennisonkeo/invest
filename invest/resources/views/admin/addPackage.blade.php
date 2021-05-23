<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Invest - Add Package </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    	<link href="invest/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
        <link href="invest/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
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

                    <div class="col-lg-12">
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
                        <div class="card">
                            <div class="card-header">
                            	

                                <h4 class="card-title">Available Packages</h4>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProjectSidebar">Add <i class="fa fa-plus"></i></button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th><strong>PACKAGE NAME</strong></th>
                                                <th><strong>DETAILS</strong></th>
                                                <th><strong>PRICE</strong></th>
                                                <th><strong>SUBSCRIBED USERS</strong></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($packages as $package)
                                            <tr>
                                                <td>{{ $package->name }}</td>
                                                <td>{{ $package->details }}</td> 
                                                <td>{{ $package->amount }}</td>
                                                <td><span class="badge light badge-success">{{ count($package->packageUsers) }}</span></td>
                                                <td>
													<div class="dropdown">
														<button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
															<svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
														</button>
														<div class="dropdown-menu">
															<a onclick="editPackage({{ $package->id }})" class="dropdown-item" href="#">Edit</a>
															<a onclick="deletePackage({{ $package->id }})" class="dropdown-item" href="#">Delete</a>
														</div>
													</div>
												</td>
                                            </tr>
                                            @endforeach

                                        </tbody>
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
								<h5 class="modal-title">Create Package</h5>
								<button type="button" class="close" data-dismiss="modal"><span>&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="POST" action="{{ route('addPackages') }}">
									{{ csrf_field() }}
									<div class="form-group">
										<label class="text-black font-w500">Package Name</label>
										<input type="text" class="form-control" name="name" required="">
									</div>
									<div class="form-group">
										<label class="text-black font-w500">Price</label>
										<input type="number" class="form-control" name="amount" required="">
									</div>
									<div class="form-group">
										<label class="text-black font-w500">Details</label>
										<textarea type="text" class="form-control" name="details" required=""></textarea>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">CREATE</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>


                <!-- edit package -->
                <div class="modal fade" id="edit">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Package</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('updatePackage') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label class="text-black font-w500">Package Name</label>
                                        <input type="text" class="form-control" name="name" id="name" required="">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-black font-w500">Price</label>
                                        <input type="number" class="form-control" name="amount" id="amount" required="">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-black font-w500">Details</label>
                                        <textarea type="text" class="form-control" name="details" id="details" required=""></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">EDIT</button>
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
        <script src="invest/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="invest/js/plugins-init/sweetalert.init.js"></script>
	<script src="invest/js/deznav-init.js"></script>
	<script src="invest/js/demo.js"></script>


    <script type="text/javascript">
        
function editPackage(id)
{
 
 var url = '{{ route("getPackage", ":id") }}';
  url = url.replace(':id', id);

$.ajax({
                          url : url,
                          type: "Get",
                        data: {'id': id},
                          dataType: "JSON",
                          success: function(data)
                          {



                            console.log(data[0]['username']);

                            $('#name').val(data[0]['name']);
                            
                            $('#details').val(data[0]['details']);
                            $('#amount').val(data[0]['amount']);
                            $('#id').val(data[0]['id']);
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

        $('#edit').modal(); 

}

function deletePackage(id)
{
  var url = '{{ route("deletePackage", ":id") }}';
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

</script>
</body>

</html>