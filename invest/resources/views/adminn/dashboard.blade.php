<!doctype html>
<html lang="en">

<head>
  <title>Dashboard | Attention Adverts</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

  <!-- Chartist css -->
  <link href="admin/assets/plugins/chartist/chartist.min.css" rel="stylesheet" type="text/css" />

  <!-- Chart.js css -->
  <link href="admin/assets/plugins/chart.js/Chart.min.css" rel="stylesheet" type="text/css" />

  <!-- Datatables core css -->
  <link href="admin/assets/plugins/datatables.net-bs4/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

  <!-- Datatables extensions css -->
  <link href="admin/assets/plugins/datatables.net-buttons-bs4/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
            <h1 class="page-title">Attention</h1>
            <p class="page-subtitle">User dashboard.</p>
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
          <div class="row">
            <div class="col-lg-9">
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h3 class="card-title">Overview</h3>
                  <div class="right">
                    {{-- <span class="card-info">Period: Oct 14, 2016 - Oct 21, 2016</span> --}}
                  </div>
                </div>
                <div class="card-body">
                  <!-- METRICS -->
                  <div class="row mb-5">
                    <div class="col-md-3 col-6">
                      <div class="widget-metric_6 animate">
                        <span class="icon-wrapper custom-bg-yellow"><i class="fa fa-money"></i></span>
                        <div class="right">
                          <span class="value">{{ number_format(Auth::user()->wallet*$multiplier,2) }}</span>
                          <span class="title">Balance</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-6">
                      <div class="widget-metric_6 animate">
                        <span class="icon-wrapper custom-bg-orange"><i class="fas fa-money"></i></span>
                        <div class="right">
                          <span class="value">{{ number_format($withdrawals*$multiplier,2) }}</span>
                          <span class="title">Withdrawn</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-6">
                      <div class="widget-metric_6 animate">
                        <span class="icon-wrapper custom-bg-blue3"><i class="fa fa-users"></i></span>
                        <div class="right">
                          <span class="value">{{ count($referals) }}</span>
                          <span class="title">Direct Referrals</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-6">
                      <div class="widget-metric_6 animate">
                        <span class="icon-wrapper custom-bg-green2"><i class="fa fa-money"></i></span>
                        <div class="right">
                          <span class="value">{{ number_format($spinEarnings*$multiplier,2) }}</span>
                          <span class="title">Spin Earnings</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
            <h3 class="card-header">New Users</h3>
            <div class="card-body">
              <div class="table-responsive">
                <table id="datatable-export" class="table table-striped">
                  <thead class="thead-light">
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Date Joined</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- @foreach($recentUsers as $user) --}}
                    <tr>

                      {{-- <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',  $user->created_on)->format('Y-m-d') }}</td> --}}
                    </tr>
                    {{-- @endforeach --}}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
                  <!-- END METRICS -->

                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <!-- VERTICAL METRICS -->
              <div class="card">
                <div class="card-body p-0">
                  <ul class="list-unstyled list-widget-vertical" id="growth-vertical-metric">
                    <li>
                      <div class="widget-metric_2">
                        <i class="fa fa-money icon"></i>
                        <div class="right">
                          <span class="title">Video Earnings</span>
                          <span class="value"> {{ number_format(0,2) }}</span>
                          {{-- <span class="percentage text-indicator-green"><i class="fa fa-level-up"></i>  25.13%</span> --}}
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="widget-metric_2">
                        <i class="fa fa-money icon"></i>
                        <div class="right">
                          <span class="title">Survey Earnings</span>
                          <span class="value"> {{ number_format($survey*$multiplier,2) }}</span>
                          {{-- <span class="percentage text-indicator-red"><i class="fa fa-level-down"></i> 2.67%</span> --}}
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="widget-metric_2">
                        <i class="fa fa-money icon"></i>
                        <div class="right">
                          <span class="title">Blog Earnings</span>
                          <span class="value"> {{ number_format($blogEarnings,2) }}</span>
                          {{-- <span class="percentage text-indicator-green"><i class="fa fa-level-up"></i> 14.86%</span> --}}
                        </div>
                      </div>
                    </li>

                  </ul>
                </div>
              </div>
              <!-- END VERTICAL METRICS -->
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

    <!-- DEMO PANEL -->
    	<!-- for demo purpose only, you should remove it on your project directory -->
    	<script type="text/javascript">
    		var toggleDemoPanel = function(e) {
    			e.preventDefault();

    			var panel = document.getElementById( 'demo-panel' );
    			if ( panel.className ) panel.className = '';
    			else panel.className = 'active';
    		}
    	</script>

    	{{-- <div id="demo-panel">
    		<a href="#" onclick="toggleDemoPanel(event);"><i class="fa fa-cog fa-spin"></i></a>
    		<iframe src="demo-panel.html"></iframe>
    	</div> --}}
    	<!-- END DEMO PANEL -->

  </div>
  <!-- END WRAPPER -->

  <!-- Vendor -->
  <script src="admin/assets/js/vendor.min.js"></script>

  <!-- Plugins -->
  <script src="admin/assets/plugins/chart.js/Chart.min.js"></script>
  <script src="admin/assets/plugins/chartist/chartist.min.js"></script>
  <script src="admin/assets/plugins/flot/jquery.canvaswrapper.js"></script>
  <script src="admin/assets/plugins/flot/jquery.colorhelpers.js"></script>
  <script src="admin/assets/plugins/flot/jquery.flot.js"></script>
  <script src="admin/assets/plugins/flot/jquery.flot.saturated.js"></script>
  <script src="admin/assets/plugins/flot/jquery.flot.browser.js"></script>
  <script src="admin/assets/plugins/flot/jquery.flot.drawSeries.js"></script>
  <script src="admin/assets/plugins/flot/jquery.flot.uiConstants.js"></script>
  <script src="admin/assets/plugins/flot/jquery.flot.resize.js"></script>
  <script src="admin/assets/plugins/easy-pie-chart/jquery.easypiechart.min.js"></script>
  <script src="admin/assets/plugins/datatables.net/jquery.dataTables.min.js"></script>
  <script src="admin/assets/plugins/datatables.net-bs4/dataTables.bootstrap4.min.js"></script>
  <script src="admin/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="admin/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="admin/assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="admin/assets/plugins/jszip/jszip.min.js"></script>
  <script src="admin/assets/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="admin/assets/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="admin/assets/plugins/datatables.net-buttons-bs4/buttons.bootstrap4.min.js"></script>

  <!-- Init -->
  <script src="admin/assets/js/pages/dashboard3.init.js"></script>

  <!-- App -->
  <script src="admin/assets/js/app.min.js"></script>
</body>

</html>