<!doctype html>
<html lang="en">

<head>
  <title>Attention Adverts | Settings</title>
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
            <h1 class="page-title">Settings</h1>
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
           <div class="card" style="width: 60%; margin: 0 auto;">
                  <div class="card-header">
                    <h3 class="card-title">Site Settings</h3>
                  </div>
                  <div class="card-body">
                    <form>
                      <div class="form-group row">
                        <label for="signup-firstname" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="signup-firstname" name="name" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="signup-lastname" class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="signup-lastname" name="phone" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="signup-username" class="col-sm-3  col-form-label">Username</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="signup-username" name="username" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="signup-email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="signup-email" name="email" value="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="signup-password" class="col-sm-3  col-form-label">New Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="signup-password" name="password">
                        </div>
                      </div>
                      <div class="text-right"><button type="submit" class="btn btn-primary">Update</button></div>

                    </form>
                  </div>
                </div>
      </div>
      <!-- END MAIN CONTENT -->

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


  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src=" https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

  <script type="text/javascript">
    
       $(document).ready(function() {
    $('#table').DataTable();

} );

  </script>

</body>

</html>