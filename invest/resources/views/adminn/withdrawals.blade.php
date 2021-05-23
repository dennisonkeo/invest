<!doctype html>
<html lang="en">

<head>
  <title>Attention Adverts | My Withdrawals</title>
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
            <h1 class="page-title">Withdrawals</h1>
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
          <div class="card card-profile">
            <div class="row no-gutters">

          <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Withdraw <i class="fa fa-money"></i></button><br>
              <!-- right column -->
              <div class="col-md-12">

<!-- BASIC DATATABLE -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Your Withdrawals</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="datatable-basic" class="table table-hover table-bordered">
                  <thead class="thead-light">
                    <tr>
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Phone</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                      <td>{{ $transaction->date }}</td>
                      <td>{{ $transaction->amount }}</td>
                      <td>{{ $transaction->user->phone_number }}</td>
                      @if($transaction->status == "Pending")
                      <td ><span class="alert alert-danger">{{ $transaction->status }} </span></td>
                      @else
                      <td><span class="alert alert-success">{{ $transaction->status }} </span></td>
                      @endif
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
        </div>
      </div>
      <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN -->

    <div class="clearfix"></div>
    
    <!-- footer -->
    @include('admin.footer')
    <!-- end footer -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Withdraw To Mpesa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-auth-small" method="POST" action="mpesa-withdraw">
          {{ csrf_field() }}
          
          <div class="form-group">
            <label for="signup-email" class="control-label sr-only">Phone</label>
            <input type="text" class="form-control" id="signup-email" placeholder="Your phone number" name="phone" value="{{ Auth::user()->phone_number }}" required="" disabled="">
          </div>
          <div class="form-group">
            <label for="signup-password" class="control-label sr-only">Amount</label>
            <input type="text" class="form-control" id="signup-password" placeholder="Amount" name="amount" required="">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Withdraw <i class="fa fa-arrow-right"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>


  </div>
  <!-- END WRAPPER -->

  <!-- Vendor -->
  <script src="admin/assets/js/vendor.min.js"></script>

  <!-- App -->
  <script src="admin/assets/js/app.min.js"></script>

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

</body>

</html>