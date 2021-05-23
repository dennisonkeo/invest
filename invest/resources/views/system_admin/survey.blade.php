<!doctype html>
<html lang="en">

<head>
  <title>Attention Adverts | Survey</title>
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
            <h1 class="page-title">Survey Manager</h1>
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

          <button class="btn btn-success" style="margin-right: 10px; " data-toggle="modal" data-target="#exampleModal">Add survey <i class="fa fa-plus"></i></button><br>
          <button class="btn btn-primary" data-toggle="modal" data-target="#quiz">Add Quiz <i class="fa fa-plus"></i></button><br>
              <!-- right column -->
              <div class="col-md-12">

<!-- BASIC DATATABLE -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Surveys</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered" style="width:100%">
                  <thead class="thead-light">
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($surveys as $transaction)
                    <tr>
                      <td>{{ $transaction->id }}</td>
                      <td>{{ $transaction->name }}</td>
                      <td>{{ $transaction->note }}</td>
                      <td>{{ $transaction->date }}</td>
                      @if($transaction->status == "active")
                      <td>
                        <form method="POST" action="{{ route('deactivateSurvey',$transaction->id) }}">
                          {{ csrf_field() }}
                          {{ method_field('PUT') }}
                          {{-- <input type="hidden" name="" _method="PUT"> --}}
                        <button class="btn btn-danger">Deactivate</button>
                      </form>
                      </td>
                      @else
                       <td>
                        <form method="POST" action="{{ route('activateSurvey',$transaction->id) }}">
                          {{ csrf_field() }}
                          {{ method_field('PUT') }}
                          {{-- <input type="hidden" name="" _method="PUT"> --}}
                        <button class="btn btn-success">Activate</button>
                      </form>
                      </td>
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
    @include('system_admin.footer')
    <!-- end footer -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Survey</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-auth-small" method="POST" action="addSurvey">
          {{ csrf_field() }}
          
          <div class="form-group">
            <label for="signup-email" class="control-label sr-only">Title</label>
            <input type="text" class="form-control" placeholder="Title" name="name" required="" >
          </div>
          <div class="form-group">
            <label for="signup-password" class="control-label sr-only">Description</label>
            <textarea class="form-control"  placeholder="Description" name="note" required=""></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="quiz" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Quiz</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-auth-small" method="POST" action="addQuiz">
          {{ csrf_field() }}
          
          <div class="form-group">
            <label for="signup-email" class="control-label sr-only">Survey</label>
            <select class="form-control" name="survey" required="" >
              <option value="">select survey</option>
              @foreach($surveys as $survey)
              <option value="{{ $survey->id }}">{{ $survey->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="signup-password" class="control-label sr-only">Quiz</label>
            <textarea class="form-control"  placeholder="Write Your Quiz" name="quiz" required=""></textarea>
          </div>

          <div class="form-group">
            <label for="signup-email" class="control-label sr-only">Options</label>
            <input type="text" class="form-control" placeholder="Option 1" name="option[]" required="" >
            <input type="text" class="form-control" placeholder="Option 2" name="option[]" required="" >
            <input type="text" class="form-control" placeholder="Option 3" name="option[]" required="" >
            <input type="text" class="form-control" placeholder="Option 4" name="option[]" required="" >
          </div>

          <div class="form-group">
            <label for="signup-email" class="control-label sr-only">Answer</label>
            <input type="text" class="form-control" placeholder="Answer e.g 0" name="answer" required="" >
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


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