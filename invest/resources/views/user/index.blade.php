<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Invest - User Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
	<link rel="stylesheet" href="{{ asset('invest/vendor/chartist/css/chartist.min.css')}}">
    <link href="{{ asset('invest/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('invest/css/style.css') }}" rel="stylesheet">
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
     @include('user.navBar')
        <!--**********************************
            Nav header end
        ***********************************-->
		
		<!--**********************************
            Chat box start
        ***********************************-->
     @include('user.chat')
		<!--**********************************
            Chat box End
        ***********************************-->
		
		<!--**********************************
            Header start
        ***********************************-->
    @include('user.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('user.sideBar')
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
			<div class="container-fluid">
				
				<div class="row">
					<div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-6">
						<div class="card card-bd bg-info text-white">
							<div class="bg-info card-brder"></div>
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body mr-3">
										<h2 class="num-text text-white font-w700">{{ number_format(Auth::user()->wallet * $multiplier) }}</h2>
										<span class="fs-14">Grand Wallet</span>
									</div>

									<i style="font-size: 36px; color: #fff;" class="fa fa-money"></i>
									{{-- 3ECDFF --}}
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-6">
						<div class="card card-bd bg-secondary text-white">
							<div class="bg-secondary card-brder"></div>
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body mr-3">
										<h2 class="num-text text-white font-w700">{{ number_format(Auth::user()->deposit * $multiplier) }}</h2>
										<span class="fs-14">Deposit Wallet</span>
									</div>

									<i style="font-size: 36px; colr: #864AD1;" class="fa fa-money"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-6">
						<div class="card card-bd bg-dark text-white">
							<div class="bg-secondary card-boder"></div>
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body mr-3">
										<h2 class="num-text text-white font-w700">{{ number_format(Auth::user()->interest * $multiplier) }}</h2>
										<span class="fs-14">Interest Earnings</span>
									</div>
									<i style="font-size: 36px; coor: #864AD1;" class="fa fa-money"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-6">
						<div class="card card-bd bg-warning text-white">
						<div class="bg-warning card-borer"></div>
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body mr-3">
										<h2 class="num-text text-white font-w700">{{ number_format($referralEarning * $multiplier) }}</h2>
										<span class="fs-14">Referral Bonus</span>
									</div>

									<i style="font-size: 36px; coor: #FFB930;" class="fa fa-money"></i>
 
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-6">
						<div class="card card-bd bg-primary text-white">
						<div class="bg-primary card-borer"></div>
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body mr-3">
										<h2 class="num-text text-white font-w700">{{ number_format($referrals) }}</h2>
										<span class="fs-14">Total Referrals</span>
									</div>

									<i style="font-size: 36px; coor: #20F174;" class="fa fa-users"></i>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-xxl-4 col-lg-4 col-sm-6">
						<div class="card card-bd bg-danger text-white">
							<div class="bg-info card-borer"></div>
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body mr-3">
										<h2 class="num-text text-white font-w700">{{ number_format($withdrawn) }}</h2>
										<span class="fs-14">Total Withdrawn</span>
									</div>

									<i style="font-size: 36px; colr: #3ECDFF;" class="fa fa-money"></i>
								</div>
							</div>
						</div>
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
        @include('user.footer')
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
	<script src="invest/vendor/chart.js/Chart.bundle.min.js"></script>
	
	<!-- Chart piety plugin files -->
    <script src="invest/vendor/peity/jquery.peity.min.js"></script>
	
	<!-- Apex Chart -->
	<script src="invest/vendor/apexchart/apexchart.js"></script>
	
	<!-- Dashboard 1 -->
	<script src="invest/js/dashboard/dashboard-1.js"></script>
	
    <script src="invest/js/custom.min.js"></script>
	<script src="invest/js/deznav-init.js"></script>
	<script src="invest/js/demo.js"></script>
    {{-- <script src="invest/js/styleSwitcher.js"></script> --}}
	
</body>

</html>