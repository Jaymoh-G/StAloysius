        <!--**********************************
            logo start
        ***********************************-->
	@include('livewire.dashboard.partials.logo')
        <!--**********************************
          logo end
        ***********************************-->

		<!--**********************************
            Header start
        ***********************************-->
        <div class="header border-bottom">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
							<div class="dashboard_bar">
                                Dashboard
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
							<li class="nav-item d-flex align-items-center">
								<div class="input-group search-area">
									<input type="text" class="form-control" placeholder="Search here...">
									<span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
								</div>
							</li>

							<li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                    <img src="images/user.jpg" width="20" alt=""/>
									<div class="header-info ms-3">
										<span class="fs-18 font-w500 mb-2">Franklin Jr.</span>
										<small class="fs-12 font-w400">demo@gmail.com</small>
									</div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="./app-profile.html" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ms-2">Profile </span>
                                    </a>
                                    <a href="./email-inbox.html" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                        <span class="ms-2">Inbox </span>
                                    </a>
                                    <a href="./login.html" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ms-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
				</nav>
			</div>
		</div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
				<ul class="metismenu" id="menu">
                    <li><a href="">
							<i class="fas fa-home"></i>
							<span class="nav-text">Dashboard</span>
						</a>


                    </li>

                    <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
						<i class="fas fa-info-circle"></i>
							<span class="nav-text">Pages</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="./app-profile.html">Profile</a></li>
							<li><a href="./post-details.html">Post Details</a></li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Email</a>
                                <ul aria-expanded="false">
                                    <li><a href="./email-compose.html">Compose</a></li>
                                    <li><a href="./email-inbox.html">Inbox</a></li>
                                    <li><a href="./email-read.html">Read</a></li>
                                </ul>
                            </li>
                            <li><a href="./app-calender.html">Calendar</a></li>
							<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Shop</a>
                                <ul aria-expanded="false">
                                    <li><a href="./ecom-product-grid.html">Product Grid</a></li>
									<li><a href="./ecom-product-list.html">Product List</a></li>
									<li><a href="./ecom-product-detail.html">Product Details</a></li>
									<li><a href="./ecom-product-order.html">Order</a></li>
									<li><a href="./ecom-checkout.html">Checkout</a></li>
									<li><a href="./ecom-invoice.html">Invoice</a></li>
									<li><a href="./ecom-customers.html">Customers</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-table"></i>
							<span class="nav-text">Our Team</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('dashboard.team.index')}}">View Team</a></li>
                            <li><a href="{{route('dashboard.team.create')}}">Add Member </a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-clone"></i>
							<span class="nav-text">Media Centre</span>
						</a>
                        <ul aria-expanded="false">
                              <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">News</a>
                                <ul aria-expanded="false">
                                    <li><a href="{{route('dashboard.blog.index')}}">News</a></li>
                                    <li><a href="{{route('dashboard.blog.create')}}">Add News</a></li>
                                    <li><a href="{{route('dashboard.blog.categories.index')}}">News Categories</a></li>
                                </ul>
                            </li>
                            <li><a class="has-arrow" href="#" aria-expanded="false">Events</a>
                                <ul aria-expanded="false">
                                    <li><a href="{{route('dashboard.events.index')}}">View Events</a></li>
                                    <li><a href="{{route('dashboard.events.create')}}">Add an Events</a></li>
                                    <li><a href="{{route('dashboard.events.categories.index')}}">Event Categories</a></li>
                                </ul>
                            </li>
							<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Gallery</a>
                                <ul aria-expanded="false">
                                    <li><a href="{{ route('dashboard.gallery.albums') }}">Albums</a></li>
                                    <li><a href="{{ route('dashboard.gallery.images') }}">Images</a></li>
                                    <li><a href="{{ route('dashboard.gallery.categories') }}">Album Categories</a></li>
                                </ul>
                            </li>
                            <li><a href="./page-lock-screen.html">Downloads</a></li>
                            <li><a href="./empty-page.html">Empty Page</a></li>
                        </ul>
                    </li>
					     <li>

						   <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-table"></i>
							<span class="nav-text">Departments</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('departments.index')}}">List</a></li>
                            <li><a href="{{route('departments.create')}}">Add</a></li>
                            <li><a href="{{route('departments.categories.index')}}">Categories</a></li>
                        </ul>
                    </li>		  	      	   <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-table"></i>
							<span class="nav-text">Users</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="table-bootstrap-basic.html">List</a></li>
                            <li><a href="table-datatable-basic.html">Add</a></li>
                        </ul>
                    </li>
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-table"></i>
							<span class="nav-text">Testimonials</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="table-bootstrap-basic.html">List</a></li>
                            <li><a href="table-datatable-basic.html">Add</a></li>
                        </ul>
                    </li>	<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-table"></i>
							<span class="nav-text">Facilities</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="table-bootstrap-basic.html">List</a></li>
                            <li><a href="table-datatable-basic.html">Add</a></li>
                        </ul>
                    </li>	<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-table"></i>
							<span class="nav-text">Admissions</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                            <li><a href="table-datatable-basic.html">Datatable</a></li>
                        </ul>
                    </li>	 <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-table"></i>
							<span class="nav-text">Support Us</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                            <li><a href="table-datatable-basic.html">Datatable</a></li>
                        </ul>
                    </li>

					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-table"></i>
							<span class="nav-text">Portals</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                            <li><a href="table-datatable-basic.html">Datatable</a></li>
                        </ul>
                    </li>
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-table"></i>
							<span class="nav-text">Settings</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                            <li><a href="table-datatable-basic.html">Datatable</a></li>
                        </ul>
                    </li>
					   <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="fas fa-table"></i>
							<span class="nav-text">Logout</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                            <li><a href="table-datatable-basic.html">Datatable</a></li>
                        </ul>
                    </li>
                    </li>
                </ul>



			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->




