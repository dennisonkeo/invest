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
            <h1 class="page-title">Profile</h1>
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
              <!-- left column -->
              <div class="col-md-4">
                <div class="profile-left">
                  <!-- profile header -->
                  <div class="profile-header">
                    <div class="overlay"></div>
                    <div class="profile-main">
                      <img src="user.png" class="rounded-circle" alt="Avatar" style="height: 90px;">
                      <h3 class="name">{{ $user->name }}</h3>
                      <span class="online-status status-available">Online</span>
                    </div>
                    <div class="profile-stat">
                      <div class="row">
                        <div class="col-md-4 stat-item">
                         Ksh {{ $user->walet }} <span>Balance</span>
                        </div>
                        <div class="col-md-4 stat-item">
                         Ksh 0 <span>Withdrawn</span>
                        </div>
                        <div class="col-md-4 stat-item">
                         Ksh 0 <span>Spin Earnings</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end profile header -->

                  <!-- profile detail -->
                  <div class="profile-detail">
                    <div class="profile-info">
                      <h4 class="heading">Basic Info</h4>
                      <dl class="row">
                        <dt class="col-sm-4">Name</dt>
                        <dd class="col-sm-8 text-right">{{ $user->name }}</dd>

                        <dt class="col-sm-4">Phone</dt>
                        <dd class="col-sm-8 text-right">{{ $user->phone_number }}</dd>

                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8 text-right">{{ $user->email }}</dd>

                        <dt class="col-sm-4"> Username</dt>
                        <dd class="col-sm-8 text-right">{{ $user->username }}</dd>
                      </dl>
                    </div>

                    
                  </div>
                  <!-- end profile detail -->
                </div>
              </div>
              <!-- end left column -->

              <!-- right column -->
              <div class="col-md-8">
                <div class="profile-right">

                  <!-- tabbed content -->
                  <div class="custom-tabs-line tabs-line-bottom left-aligned">
                    <ul class="nav" role="tablist">
                      <li class="nav-item"><a href="#tab-bottom-left1" class="nav-link active" role="tab" data-toggle="tab">Edit Profile <span class="badge badge-pill badge-success">Active</span></a></li>
                      <li class="nav-item"><a href="#tab-bottom-left2" class="nav-link" role="tab" data-toggle="tab">Payment Method </a></li>
                    </ul>
                  </div>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-bottom-left1">
                      <!-- edit form -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Edit</h3>
                  </div>
                  <div class="card-body">
                    <form>
                      <div class="form-group row">
                        <label for="signup-firstname" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="signup-firstname" name="name" value="{{ $user->name }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="signup-lastname" class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="signup-lastname" name="phone" value="{{ $user->phone_number }}" disabled="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="signup-username" class="col-sm-3  col-form-label">Username</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="signup-username" name="username" value="{{ $user->username }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="signup-email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="signup-email" name="email" value="{{ $user->email }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="signup-password" class="col-sm-3  col-form-label">New Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="signup-password" name="password">
                        </div>
                      </div>
                      <div class="text-center"><button type="submit" class="btn btn-primary">Edit Profile</button></div>

                    </form>
                  </div>
                </div>
                <!-- END eit form -->
                    </div>
                    <div class="tab-pane fade" id="tab-bottom-left2">
                      <form>
                      <div class="form-group row">
                        <label for="ticket-type" class="col-sm-3 col-form-label">Payment Method</label>
                        <div class="col-sm-9">
                          <select id="ticket-type" name="ticket-type" class="form-control">
                            <option value="">---select option---</option>
                            @foreach($paymethods as $method)
                            <option value="{{ $method->name }}">{{ $method->name }}</option>
                            @endforeach
         
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="signup-lastname" class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="signup-lastname" disabled="" value="{{ $user->phone_number }}">
                        </div>
                      </div>

                      <button type="submit" class="btn btn-success pull-right">Add</button><br><br>

                    </form>
                      <div class="table-responsive">

                    

                        <table class="table project-table">
                          <thead class="thead-light">
                            <tr>
                              <th>Type</th>
                              <th>Network</th>
                              <th>Details</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($user->payMethods as $method)
                            <tr>
                              <td>Image</td>
                              <td>
                                {{ $method->name }}
                              </td>
                              <td>{{ $method->value }}</td>
                              <td><i class="btn btn-danger fas fa-trash"></i></td>
                            </tr>
                            @endforeach

                          </tbody>
                        </table>
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

  <!-- App -->
  <script src="admin/assets/js/app.min.js"></script>
</body>

</html>