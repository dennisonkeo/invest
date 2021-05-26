<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Invest - Messages Inbox </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Datatable -->
    <link href="invest/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="invest/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="invest/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="invest/css/style.css" rel="stylesheet">


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
        @if(Auth::user()->role == "admin")
        @include('admin.navBar')
        @else
        @include('user.navBar')
        @endif
        <!--**********************************
            Nav header end
        ***********************************-->
        
        <!--**********************************
            Chat box start
        ***********************************-->
        @if(Auth::user()->role == "admin")
        @include('admin.chat')
        @else
        @include('user.chat')
        @endif
        <!--**********************************
            Chat box End
        ***********************************-->


        
        
        <!--**********************************
            Header start
        ***********************************-->
        @if(Auth::user()->role == "admin")
        @include('admin.header')
        @else
        @include('user.header')
        @endif
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
       @if(Auth::user()->role == "admin")
        @include('admin.sideBar')
        @else
        @include('user.sideBar')
        @endif
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">
			<div class="container-fluid">

                <div class="row">
                   @include('admin.errors')

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

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="email-left-box px-0 mb-3">
                                    <div class="p-0">
                                        <a data-toggle="modal" data-target="#addProjectSidebar" href="javascript:void()" class="btn btn-primary btn-block">Compose</a>
                                    </div>
                                    <div class="mail-list mt-4">
                                        <a href="{{ route('messages') }}" class="list-group-item"><i
                                                class="fa fa-inbox font-18 align-middle mr-2"></i> Inbox <span
                                                class="badge badge-primary badge-sm float-right">{{ $unread }}</span> </a>
                                        <a href="{{ route('sent-messages') }}" class="list-group-item active"><i
                                                class="fa fa-paper-plane font-18 align-middle mr-2"></i>Sent</a>

                                    </div>

                                </div>
                                <div class="email-right-box ml-0 ml-sm-4 ml-sm-0">
                                    <div role="toolbar" class="toolbar ml-1 ml-sm-0">
                                        <div class="btn-group mb-1">

                    </div>
                                        <div class="btn-group mb-1">
                                            <button class="btn btn-primary light px-3" type="button"><i class="ti-reload"></i>
                                            </button>
                                        </div>

                                    </div>
                                    <div class="email-list mt-3">
                                      @if($role == "admin")
                                        @foreach($messages as $msg)
                                        @if($msg->msg_read == 1)
                                        <div class="message" stle="background: #F0F2F3;">

                                          @else
                                           <div class="message" style="font-weight: bold;">
                                          @endif
                                            <div>

                                                <a href="{{ route('sent-message', $msg->id) }}" class="col-mail col-mail-2">
                                                    <div class="subject">{{ $msg->msg }}</div>
                                                    <div class="date">{{ date('h:i A', strtotime($msg->time)) }}</div>
                                                </a>


                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        @foreach($msgs as $msg)
                                        @if($msg->msg_read == 1)
                                        <div class="message" stle="background: #F0F2F3;">

                                          @else
                                           <div class="message" style="font-weight: bold;">
                                          @endif
                                            <div>

                                                <a href="{{ route('sent-message', $msg->id) }}" class="col-mail col-mail-2">
                                                    <div class="subject">{{ $msg->msg }}</div>
                                                    <div class="date">{{ date('h:i A', strtotime($msg->time)) }}</div>
                                                </a>


                                            </div>
                                        </div>
                                        @endforeach
                                       @endif



                                    </div>
                                  
                                  {{-- panel --}}

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- Add package -->
				<div class="modal fade" id="addProjectSidebar">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Compose your message</h5>
								<button type="button" class="close" data-dismiss="modal"><span>&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="POST" action="{{ route('sendMsg') }}">
									{{ csrf_field() }}
                @if($role == "admin")
									<div class="form-group">
										<label class="text-black font-w500">To </label>
										<input type="text" class="form-control" name="username" id="username" placeholder="Enter receiver's username" required="">
									</div>
                @endif

                  <div class="form-group">
                    <label class="text-black font-w500">Subject</label>
                    <input type="text" class="form-control" name="subject" id="subject" required="">
                  </div>

                  <div class="form-group">
                    <label class="text-black font-w500">Message</label>
                    <textarea type="text" class="form-control" name="msg" id="msg" required=""></textarea>
                  </div>

									<div class="form-group">
										<button type="submit" class="btn btn-primary">SEND</button>
									</div>
								</form>
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
    <script src="invest/js/custom.min.js"></script>
    <script src="invest/js/deznav-init.js"></script>
    <script src="invest/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="invest/js/plugins-init/sweetalert.init.js"></script>
    <script src="invest/js/demo.js"></script>
    <!-- Datatable -->
    <script src="invest/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="invest/js/plugins-init/datatables.init.js"></script>

  


</body>

</html>