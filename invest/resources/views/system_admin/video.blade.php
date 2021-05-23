<!doctype html>
<html lang="en">

<head>
  <title>Attention Adverts | Videos</title>
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
            <h1 class="page-title">Videos</h1>
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
          @include('system_admin.errors')
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
              <!-- right column -->

              <button class="btn btn-success" style="margin-right: 10px; " data-toggle="modal" data-target="#exampleModal">Upload Video <i class="fa fa-upload"></i></button><br>
              <div class="col-md-12">

<!-- BASIC DATATABLE -->
          <div class="card" >
            <div class="card-header">
              <h3 class="card-title">Videos</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered" >
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
                    @foreach($videos as $video)
                    <tr>
                      <td>{{ $video->id }}</td>
                      <td>{{ $video->title }}</td>
                      <td>{{ $video->note }}</td>
                      @if($video->status == "Not Approved")
                      <td ><button onclick="approve({{ $video->id }})" class="btn btn-success" style="background: none; color: #5cb85c ;">Activate </button></td>
                      @else
                      <td ><button class="btn btn-success" style="background: none; color: #5cb85c ;">Active <i class="fa fa-check"></i></button></td>
                      @endif
                      <td>
                        <button onclick="preview('{{ $video->video }}')" data-toggle="tooltip" data-placement="top" title="Preview video"  class="btn btn-primary" stle="background: none; color: #5cb85c ;"> <i class="fa fa-eye"></i></button>
                        <button onclick="deleteVideo({{ $video->id }})" data-toggle="tooltip" data-placement="top" title="Delete Video"  class="btn btn-danger" stye="background: none; color: #5cb85c ;"><i class="fa fa-trash"></i></button>
                        
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
        <h5 class="modal-title" id="exampleModalLabel">New Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-auth-small" method="POST" action="upload_video" enctype="multipart/form-data">
          {{ csrf_field() }}
          
          <div class="form-group">
            <label for="signup-email" class="control-label sr-only">Title</label>
            <input type="text" class="form-control" placeholder="Title" name="title" required="" >
          </div>
          
          <div class="form-group">
            <label for="signup-password" class="control-label sr-only">Description</label>
            <textarea class="form-control"  placeholder="Description" name="note" required=""></textarea>
          </div>

          <div class="form-group">
            <label for="signup-email" class="control-label sr-only">Video</label>
            <input type="file" name="file" id="file" class="form-control" placeholder="Video" required="" >
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


<div class="modal fade" id="videoo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card" style="margin: 0 auto; wikdth: 50%;">
            <div class="card-header">
              <h3 class="card-title">Watch this video to completion <i style="color: red;" class="fa fa-youtube"></i></h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <video style="width: 100%;" controls src="" id="video" poster="https://peach.blender.org/wp-content/uploads/title_anouncement.jpg?x11217">

                 Video tag is not supported in this browser.
              </video> 
              </div>
            </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <button onclick="destroy()" type="button" class="btn btn-secondary" datja-dismiss="modal">Cancel</button>
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

      $(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

function approve(id)
{
  var url = '{{ route("approveBlog", ":id") }}';
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


function preview(name)
{
  console.log(name);
  var url = '{{asset('admin/assets/videos')}}/'+name;
  // url = url.replace(':id', id);

  $('#video').attr('src', url);

  $('#videoo').modal();
}

function destroy()
{
  $("#videoo .close").click();
  location.reload();

}

    function deleteVideo(id)
{
  var url = '{{ route("deleteVideo", ":id") }}';
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

function approve(id)
{
  var url = '{{ route("approveVideo", ":id") }}';
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