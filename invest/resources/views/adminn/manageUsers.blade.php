<!doctype html>
<html lang="en">

<head>
  <title>Manage Users | ICMS</title>
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

  {{-- <script src="admin/assets/nic-edit/nicEdit.js"></script> --}}
  {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css" rel="stylesheet" type="text/css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.js"></script>
</head>
<body>
  <!-- WRAPPER -->
  <div id="wrapper">

    <!-- NAVBAR -->
@include('admin.navBar')
    <!-- END NAVBAR -->

    <!-- LEFT SIDEBAR -->
    @include('admin.sideBar')
    <!-- END LEFT SIDEBAR -->

    <!-- MAIN -->
    <div class="main">

      <!-- MAIN CONTENT -->
      <div class="main-content">

        <div class="content-heading">
          <div class="heading-left">
            <h1 class="page-title">Users</h1>
            <p class="page-subtitle">Manage Users.</p>
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
            <div class="card-header">
              <h3 class="card-title">Manage Users</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="datatable-basic" class="table table-hover table-bordered">
                  <thead class="thead-light">
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td>{{ $user->first_name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->Phone_No }}</td>
                      <td>
                        {{-- <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit"> <i class="fa fa-pencil-square-o"></i> </button> --}}
                        <button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Deactivate"><i class="fas fa-key"></i></button>
                        <button class="btn btn-danger" onclick="delete_user({{ $user->id }})" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
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



    </div>
    <!-- END MAIN -->

    <div class="clearfix"></div>
    
    <!-- footer -->
    @include('admin.footer')
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
    
    function delete_user(id)
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
                         $.ajax({
                          url : url,
                          type: "DELETE",
                          data: {_token: '{{csrf_token()}}'},
                          dataType: "JSON",
                          success: function(data)
                          {                 
                                Swal.fire({
                                  title: 'Deleted!',
                                  text: "User has been deleted successfully!",
                                  icon: 'success',
                                  closeButtonText: 'No, cancel!',
                                }
                                ).then((result)=>{
                                  location.reload()
                                }
                                );
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                // alert('Error deleting data');
                                Swal.fire({
                                           title: 'Oops...',
                                            text: 'Error deleting user!',
                                            icon: 'error',
                                          })
                            }
                        });                     
                    }
                  });
    }

    function deactivate_user(id)
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
                         $.ajax({
                          url : url,
                          type: "DELETE",
                          data: {_token: '{{csrf_token()}}'},
                          dataType: "JSON",
                          success: function(data)
                          {                 
                                Swal.fire({
                                  title: 'Deleted!',
                                  text: "User has been deleted successfully!",
                                  icon: 'success',
                                  closeButtonText: 'No, cancel!',
                                }
                                ).then((result)=>{
                                  location.reload()
                                }
                                );
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                // alert('Error deleting data');
                                Swal.fire({
                                           title: 'Oops...',
                                            text: 'Error deleting user!',
                                            icon: 'error',
                                          })
                            }
                        });                     
                    }
                  });
    }

  </script>
</body>

</html>