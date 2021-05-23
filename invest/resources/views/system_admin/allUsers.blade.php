<!doctype html>
<html lang="en">

<head>
  <title>Attention Adverts | Users</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!-- Datatables core css -->
  <link href="admin/assets/plugins/datatables.net-bs4/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

  <!-- Datatables extensions css -->
  <link href="admin/assets/plugins/datatables.net-buttons-bs4/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="admin/assets/plugins/datatables.net-colreorder-bs4/colreorder.bootstrap4.min.html" rel="stylesheet" type="text/css" />

  <!-- App css -->
  <link href="admin/assets/css/bootstrap-custom.min.css" rel="stylesheet" type="text/css" />
  <link href="admin/assets/css/app.min.css" rel="stylesheet" type="text/css" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">

  <!-- Favicon -->
  <link rel="shortcut icon" href="admin/assets/images/favicon.png">

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>
  <!-- WRAPPER -->
  <div id="wrapper">

    <!-- NAVBAR -->
@include('system_admin.navBar')
    <!-- END NAVBAR -->

    <!-- LEFT SIDEBAR -->
    @include('system_admin.sideBar')
    <!-- END LEFT SIDEBAR -->

    <!-- MAIN -->
    <div class="main">

      <!-- MAIN CONTENT -->
      <div class="main-content">

        <div class="content-heading">
          <div class="heading-left">
            <h1 class="page-title">Users</h1>
            <p class="page-subtitle">All Users.</p>
          </div>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">Parent</a></li>
              <li class="breadcrumb-item active">Current</li>
            </ol>
          </nav>
        </div>

        <div class="container-fluid">


          <!-- FILTER COLUMN -->
          <div class="card" style="display: none;">
            <div class="card-header">
              <h3 class="card-title">Column Filter Enabled</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="datatable-column-filter" class="table">
                  <thead class="thead-light">
                    
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- END FILTER COLUMN -->


          <!-- BASIC DATATABLE -->
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
              <h3 class="card-title">All Users</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="datatable-basic" class="table table-striped">
                  <thead class="thead-light">
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Username</th>
                      <th>Phone</th>
                      <th>Status</th>
                      <th>Joined</th>
                      <th>ACTION</th>
                      {{-- <th>Date Joined</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->username }}</td>
                      <td>{{ $user->phone_number }}</td>
                      <td>{{ $user->status }}</td>
                      <td>{{ $user->date }}</td>
                      <td>
                        <button onclick="resetPass({{ $user->id }})" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Reset Password" ><i class="fa fa-key"></i></button>
                        @if($user->status == "inactive")
                        <button onclick="activate({{ $user->id }})" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Activate User"><i class="fa fa-check"></i></button>
                        @else
                          <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="User Activated"><i class="fa fa-check"></i>
                          </button>
                        @endif
                        <button onclick="deleteUser({{ $user->id }})" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete User"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- END BASIC DATATABLE -->
        </div>
      </div>
      <!-- END MAIN CONTENT -->



<!-- Modal -->
<div class="modal fade" id="resetPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-auth-small" method="POST" action="{{ route('resetUserPass') }}">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="PUT">
          
          <div class="form-group">
            <label for="signup-email" class="control-label sr-only">Password</label>
            <input type="password" class="form-control" id="signup-email" placeholder="Password" name="password" required="" >
          </div>
          <input type="hidden" name="id" id="id">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Reset</button>
      </div>
      </form>
    </div>
  </div>
</div>




    </div>
    <!-- END MAIN -->

    <div class="clearfix"></div>
    
    <!-- footer -->
    @include('system_admin.footer')
    <!-- end footer -->

  </div>
  <!-- END WRAPPER -->

  <!-- Vendor -->
  <script src="admin/assets/js/vendor.min.js"></script>

  <!-- Datables Core -->
  <script src="admin/assets/plugins/datatables.net/jquery.dataTables.min.js"></script>
  <script src="admin/assets/plugins/datatables.net-bs4/dataTables.bootstrap4.min.js"></script>

  <!-- Datables Extension -->
  <script src="admin/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="admin/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="admin/assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="admin/assets/plugins/jszip/jszip.min.js"></script>
  <script src="admin/assets/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="admin/assets/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="admin/assets/plugins/datatables.net-buttons-bs4/buttons.bootstrap4.min.js"></script>
  <script src="admin/assets/plugins/datatables.net-colreorder/dataTables.colReorder.min.js"></script>
  <script src="admin/assets/plugins/datatables.net-colreorder-bs4/colReorder.bootstrap4.min.js"></script>

  <!-- Datatables Init -->
  <script src="admin/assets/js/pages/tables-dynamic.init.min.js"></script>

  <!-- App -->
  <script src="admin/assets/js/app.min.js"></script>

  <script type="text/javascript">
    
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

function resetPass(id)
{
  console.log(id);

  $('#resetPass').modal();
  $('#id').val(id);
}

function activate(id)
{
  var url = '{{ route("activateUser", ":id") }}';
  url = url.replace(':id', id);

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

                      window.location=url
                    
                    }
                  });
}

function deleteUser(id)
{
  var url = '{{ route("deleteUser", ":id") }}';
  url = url.replace(':id', id);

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

                      window.location=url
                    
                    }
                  });
}
    
  </script>
</body>

</html>