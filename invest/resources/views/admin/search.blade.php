<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Invest - All Users </title>
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

                    <div class="col-12">
                        <div class="card">
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
                            <div class="card-header">
                                
                                <h5 class="card-title" style="font-size: 14px;">Search user by username, email or phone number</h5>

                                <form  method="GET" action="{{ route('quick-search') }}">

                                  <div class="input-group">
                   
                                   <input class="form-control" type="text" name="search" required>
                                   <span class="input-group-append"><button type="submit" class="btn btn-primary" type="button">Search</button></span>
                    
                                  </div>
                                 </form><br>

                            

                            </div>
                            <div class="card-body">
                            @if($user)
                                <div class="table-responsive" stle="display: none;">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                               <th>Name</th>
                                               <th>Email</th>
                                               <th>Username</th>
                                               <th>Phone</th>
                                               <th>Deposit</th>
                                               <th>Wallet</th>
                                               <th>Joined</th>
                                               <th>Upline</th>
                      
                                               <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->deposit }}</td>
                                                <td>{{ $user->wallet }}</td>
                                                <td>{{ $user->date }}</td>
                                                <td>{{ $user->where('id',$user->referrals()->where('level', 1)->first()['referrer'])->first()['username'] }}</td>
                                                
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a onclick="editUserr({{ $user->id }})" class="dropdown-item" href="#">Edit</a>
                                                            <a onclick="resetPass({{ $user->id }})" class="dropdown-item" href="#">Reset Password</a>
                                                            <a onclick="changeUpline({{ $user->id }})" class="dropdown-item" href="#">Change Upline</a>
                                                            <a onclick="deposit({{ $user->id }})" class="dropdown-item" href="#">Credit Account</a>
                                                            <a onclick="deleteUser({{ $user->id }})" class="dropdown-item" href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        

                                        </tfoot>
                                    </table>
                                </div>
                                @else
                                <div class="alert alert-info">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              There's no user found!
                          </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>



        <!-- edit user -->
                <div class="modal fade" id="resetPass">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Reset User Password</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" method="POST" action="{{ route('resetUserPass') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="id" id="id">

                                    <div class="form-group">
                                        <label class="text-black font-w500">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="New Password" id="password" required="">
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">RESET</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- upline -->
                <div class="modal fade" id="upline">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Change User Upline</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" method="POST" action="{{ route('changeUplink') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="id" id="up_id">

                                    <div class="form-group">
                                        <label class="text-black font-w500">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" required="">
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Change</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- upline -->
                <div class="modal fade" id="edit">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit User</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" method="POST" action="{{ route('updateUser') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="id" id="user_id">

                                    <div class="form-group">
                                        <label class="text-black font-w500">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" required="">
                                    </div>

                                    <div class="form-group">
                                        <label class="text-black font-w500">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" required="">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-black font-w500">Username</label>
                                        <input type="text" class="form-control" name="username" id="usernam" required="">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-black font-w500">Phone</label>
                                        <input type="text" class="form-control" name="phone" id="phone" required="">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-black font-w500">Account Balance</label>
                                        <input type="text" class="form-control" name="wallet" id="wallet" required="">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-black font-w500">Country</label>
                                        <input type="text" class="form-control" name="country" id="country" required="">
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- deposit -->
                <div class="modal fade" id="deposit">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Deposit Funds For User</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('depositForUser') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="id" id="deposit_id">


                                    <div class="form-group">
                                        <label class="text-black font-w500">Amount</label>
                                        <input type="number" class="form-control" name="amount" id="amount" required="">
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">CREDIT</button>
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

  function deposit(id)
{
  console.log(id);

  $('#deposit').modal();
  $('#deposit_id').val(id);
}

    function resetPass(id)
{
  console.log(id);

  $('#resetPass').modal();
  $('#id').val(id);
}

  
  function editUserr(id)
{
 
 var url = '{{ route("getUser", ":id") }}';
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
                            
                            $('#email').val(data[0]['email']);
                            $('#country').val(data[0]['country']);
                            $('#phone').val(data[0]['phone']);
                            $('#wallet').val(data[0]['wallet']);
                            $('#usernam').val(data[0]['username']);
                            $('#user_id').val(data[0]['id']);
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
    
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

function resetPass(id)
{
  console.log(id);

  $('#resetPass').modal();
  $('#id').val(id);
}

function changeUpline(id)
{
  console.log(id);

  $('#upline').modal();
  $('#up_id').val(id);
}



function deleteUser(id)
{
  var url = '{{ route("deleteUser", ":id") }}';
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