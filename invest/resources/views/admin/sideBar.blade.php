<div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">

                    <li>
                        <a href="{{ route('/') }}" class="ai-icon" aria-expanded="false">
							<i class="fa fa-dashboard"></i>
							<span class="nav-text">Dashboard</span>
						</a>
					</li>

                    {{-- <li>
                        <a href="#" class="ai-icon" aria-expanded="false">
                            <i class="fa fa-user"></i>
                            <span class="nav-text">My Profile</span>
                        </a>
                    </li> --}}

                    <li>
                        <a href="{{ route('registered-users') }}" class="ai-icon" aria-expanded="false">
                            <i class="fa fa-users"></i>
                            <span class="nav-text">Users</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('quick-search') }}" class="ai-icon" aria-expanded="false">
                            <i class="fa fa-search"></i>
                            <span class="nav-text">Quick Search</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('add-package') }}" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-024-dashboard"></i>
                            <span class="nav-text">Packages</span>
                        </a>
                    </li>

                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-money"></i>
                            <span class="nav-text">Payments</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('withdrawals') }}">B2C</a></li>
                            <li><a href="{{ route('deposits') }}">C2B</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="ai-icon" aria-expanded="false">
                            <i class="fa fa-envelope"></i>
                            <span class="nav-text">LiveChat</span>
                        </a>
                    </li>

                </ul>
			</div>
        </div>