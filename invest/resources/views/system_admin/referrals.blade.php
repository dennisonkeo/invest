<!doctype html>
<html lang="en">

<head>
  <title>Attention Adverts | My Profile</title>
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
            <h1 class="page-title">My Referrals</h1>
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
          <div class="card card-profile">
            <div class="row no-gutters">

              <!-- right column -->
              <div class="col-md-8">
                <div class="profile-right">

                  <div class="form-group row">
                        <label for="signup-firstname" class="col-sm-3 col-form-label badge-success"><i class="fa fa-link"></i> Referral Link </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="signup-firstname" value="{{ asset('/register') }}/{{ Auth::user()->username }}">
                        </div>
                        {{-- <button class="col-sm-2">Copy</button> --}}
                      </div>

                  <!-- tabbed content -->
                  <div class="custom-tabs-line tabs-line-bottom left-aligned">
                    <ul class="nav" role="tablist">
                      <li class="nav-item"><a href="#tab-bottom-left1" class="nav-link active" role="tab" data-toggle="tab">Level <span class="badge badge-pill badge-success">1</span></a></li>
                      <li class="nav-item"><a href="#tab-bottom-left2" class="nav-link" role="tab" data-toggle="tab">Level <span class="badge badge-pill badge-info">2</span></a></li>
                      <li class="nav-item"><a href="#tab-bottom-left3" class="nav-link" role="tab" data-toggle="tab">Level <span class="badge badge-pill badge-secondary">3</span></a></li>
                      <li class="nav-item"><a href="#tab-bottom-left4" class="nav-link" role="tab" data-toggle="tab">Level <span class="badge badge-pill badge-warning">4</span></a></li>
                    </ul>
                  </div>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-bottom-left1">
                      <!-- edit form -->
                <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Level 1 Referrals</h3>
                </div>
                <div class="card">
            <div class="card-body">
               <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="level1" class="table table-striped table-bordered" style="width:100%">
              <thead>
              <tr>
                        {{-- <th>#</th> --}}
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        {{-- <th  style="display: none;"></th>
                        <th  style="display: none;"></th> --}}
              </tr>
             </thead>
        <tbody>
            @foreach($level1 as $one)
                      <tr>
                        {{-- <td>{{ $count }}.</td> --}}
                        <td>{{ $one->user->name }}</td>
                        <td>{{ $one->user->phone_number }}</td>
                        <td>{{ $one->user->email }}</td>
                        <td>{{ $one->user->status }}</td>

                        {{-- <td style="display: none;"> {{ $count=1 }}></td>
                          <td style="display: none;">{{ $count++ }}</td> --}}
                      </tr>
                      
                      @endforeach
                     
        </tbody>
        <tfoot>
            <tr>
                        {{-- <th>#</th> --}}
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                       {{--  <th  style="display: none;"></th>
                        <th  style="display: none;"></th> --}}
            </tr>
        </tfoot>
    </table>
              </div>
            </div>
          </div>
            </div>
          </div>
              </div>
                <!-- END eit form -->
                    </div>
                    <div class="tab-pane fade" id="tab-bottom-left2">
                     <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Level 2 Referrals</h3>
                </div>
                <div class="card">
            <div class="card-body">
               <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="level2" class="table table-striped table-bordered" style="width:100%">
              <thead>
              <tr>
                        {{-- <th>#</th> --}}
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        {{-- <th  style="display: none;"></th>
                        <th  style="display: none;"></th> --}}
              </tr>
             </thead>
        <tbody>
            @foreach($level2 as $one)
                      <tr>
                        {{-- <td>{{ $count }}.</td> --}}
                        <td>{{ $one->user->name }}</td>
                        <td>{{ $one->user->phone_number }}</td>
                        <td>{{ $one->user->email }}</td>
                        <td>{{ $one->user->status }}</td>

                        {{-- <td style="display: none;"> {{ $count=1 }}></td>
                          <td style="display: none;">{{ $count++ }}</td> --}}
                      </tr>
                      
                      @endforeach
                     
        </tbody>
        <tfoot>
            <tr>
                        {{-- <th>#</th> --}}
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        {{-- <th  style="display: none;"></th>
                        <th  style="display: none;"></th> --}}
            </tr>
        </tfoot>
    </table>
              </div>
            </div>
          </div>
            </div>
          </div>
              </div>
                  </div>

                  <div class="tab-pane fade" id="tab-bottom-left3">
                    <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Level 3 Referrals</h3>
                </div>
                <div class="card">
            <div class="card-body">
               <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="level3" class="table table-striped table-bordered" style="width:100%">
              <thead>
              <tr>
                        {{-- <th>#</th> --}}
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        {{-- <th  style="display: none;"></th>
                        <th  style="display: none;"></th> --}}
              </tr>
             </thead>
        <tbody>
            @foreach($level3 as $one)
                      <tr>
                        {{-- <td>{{ $count }}.</td> --}}
                        <td>{{ $one->user->name }}</td>
                        <td>{{ $one->user->phone_number }}</td>
                        <td>{{ $one->user->email }}</td>
                        <td>{{ $one->user->status }}</td>

                        {{-- <td style="display: none;"> {{ $count=1 }}></td>
                          <td style="display: none;">{{ $count++ }}</td> --}}
                      </tr>
                      
                      @endforeach
                     
        </tbody>
        <tfoot>
            <tr>
                        {{-- <th>#</th> --}}
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        {{-- <th  style="display: none;"></th>
                        <th  style="display: none;"></th> --}}
            </tr>
        </tfoot>
    </table>
              </div>
            </div>
          </div>
            </div>
          </div>
              </div>
                  </div> 

                  <div class="tab-pane fade" id="tab-bottom-left4">
                    <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Level 4 Referrals</h3>
                </div>
                <div class="card">
            <div class="card-body">
               <!-- BASIC DATATABLE -->
          <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
              <div class="table-responsive">
             <table id="level4" class="table table-striped table-bordered" style="width:100%">
              <thead>
              <tr>
                        {{-- <th>#</th> --}}
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        {{-- <th  style="display: none;"></th>
                        <th  style="display: none;"></th> --}}
              </tr>
             </thead>
        <tbody>
            @foreach($level4 as $one)
                      <tr>
                        {{-- <td>{{ $count }}.</td> --}}
                        <td>{{ $one->user->name }}</td>
                        <td>{{ $one->user->phone_number }}</td>
                        <td>{{ $one->user->email }}</td>
                        <td>{{ $one->user->status }}</td>

                        {{-- <td style="display: none;"> {{ $count=1 }}></td> --}}
                          
                      </tr>
                      
                      @endforeach

                     
        </tbody>
        <tfoot>
            <tr>
                        {{-- <th>#</th> --}}
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                   {{--      <th  style="display: none;"></th>
                        <th  style="display: none;"></th> --}}
            </tr>
        </tfoot>
    </table>
              </div>
            </div>
          </div>
          <!-- END BASIC DATATABLE -->
            </div>
          </div>
              </div>
                  </div>
                  <!-- end tabbed content -->
                </div>
              </div>
              <!-- end right column -->
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
    $('#level4').DataTable();

} );  

    $(document).ready(function() {
    $('#level3').DataTable();

} );

    $(document).ready(function() {
    $('#level2').DataTable();

} ); 

    $(document).ready(function() {
    $('#level1').DataTable();

} );

  </script>

</body>

</html>