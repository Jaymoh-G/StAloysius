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
                    <div class="navbar-collapse justify-content-between collapse">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                Dashboard
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">


                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">

                                    <div class="header-info ms-3">
                                        <span class="fs-18 font-w500 mb-2">{{ Auth::user()->name }}</span>
                                        <small class="fs-12 font-w400">{{ Auth::user()->email }}</small>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{ route('profile') }}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                            width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ms-2">Profile </span>
                                    </a>

                                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item ai-icon" style="background: none; border: none; width: 100%; text-align: left; padding: 0.5rem 1rem;">
                                            <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                                width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                <polyline points="16 17 21 12 16 7"></polyline>
                                                <line x1="21" y1="12" x2="9" y2="12"></line>
                                            </svg>
                                            <span class="ms-2">Logout </span>
                                        </button>
                                    </form>
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
                    <li><a href="{{ route('dashboard.index') }}">
                            <i class="fas fa-home"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
    <li>
                        @canView('blog')
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-newspaper"></i>
                            <span class="nav-text">Media Centre</span>
                        </a>
                        @endcanView
                        <ul aria-expanded="false">
                            @canView('blog')
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">News</a>
                                <ul aria-expanded="false">
                                    <li><a href="{{ route('dashboard.blog.index') }}">News</a></li>
                                    @canCreate('blog')
                                    <li><a href="{{ route('dashboard.blog.create') }}">Add News</a></li>
                                    @endcanCreate
                                    <li><a href="{{ route('dashboard.blog.categories.index') }}">News Categories</a>
                                    </li>
                                    <li><a href="{{ route('dashboard.comments.index') }}">Comments</a></li>
                                </ul>
                            </li>
                            @endcanView
                            @canView('events')
                            <li><a class="has-arrow" href="#" aria-expanded="false">Events</a>
                                <ul aria-expanded="false">
                                    <li><a href="{{ route('dashboard.events.index') }}">View Events</a></li>
                                    @canCreate('events')
                                    <li><a href="{{ route('dashboard.events.create') }}">Add an Events</a></li>
                                    @endcanCreate
                                    <li><a href="{{ route('dashboard.events.categories.index') }}">Event Categories</a>
                                    </li>
                                </ul>
                            </li>
                            @endcanView
                            @canView('gallery')
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Gallery</a>
                                <ul aria-expanded="false">
                                    <li><a href="{{ route('dashboard.gallery.categories') }}">Gallery Categories</a>
                                    </li>
                                    <li><a href="{{ route('dashboard.gallery.images') }}">Images</a></li>
                                    <li><a href="{{ route('dashboard.gallery.albums') }}">Albums</a></li>
                                    @canView('youtube')
                                    <li><a href="{{ route('dashboard.youtube.index') }}">Youtube Videos</a></li>
                                    @endcanView
                                </ul>
                            </li>
                            @endcanView
                            @canView('careers')
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Careers</a>
                                <ul aria-expanded="false">
                                    <li><a href="{{ route('dashboard.careers.index') }}">Job Vacancies</a></li>
                                    @canCreate('careers')
                                    <li><a href="{{ route('dashboard.careers.create') }}">Add Job Vacancy</a></li>
                                    @endcanCreate
                                    <li><a href="{{ route('dashboard.careers.categories') }}">Job Categories</a></li>
                                </ul>
                            </li>
                            @endcanView
                        </ul>
                    </li>


                    @canView('team')
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <span class="nav-text">Our Team</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('dashboard.team.index') }}">View Team</a></li>
                            @canCreate('team')
                            <li><a href="{{ route('dashboard.team.create') }}">Add Member </a></li>
                            @endcanCreate
                        </ul>
                    </li>
                    @endcanView


                    <li>

                    @canView('departments')
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-building"></i>
                            <span class="nav-text">Departments</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('dashboard.departments.index') }}">List</a></li>
                            @canCreate('departments')
                            <li><a href="{{ route('dashboard.departments.create') }}">Add</a></li>
                            @endcanCreate
                            <li><a href="{{ route('dashboard.departments.categories.index') }}">Categories</a></li>
                        </ul>
                    </li>
                    @endcanView

                         @canView('testimonials')
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-comment-dots"></i>
                            <span class="nav-text">Testimonials</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('dashboard.testimonials.index') }}">List</a></li>
                            @canCreate('testimonials')
                            <li><a href="{{ route('dashboard.testimonials.create') }}">Add</a></li>
                            @endcanCreate
                        </ul>
                    </li>
                    @endcanView
                    @canView('facilities')
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-school"></i>
                            <span class="nav-text">Facilities</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('dashboard.facilities.index') }}">List</a></li>
                            @canCreate('facilities')
                            <li><a href="{{ route('dashboard.facilities.create') }}">Add</a></li>
                            @endcanCreate
                        </ul>
                    </li>
                    @endcanView
                    @canView('projects')
                         <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-school"></i>
                            <span class="nav-text">Projects</span>
                        </a>

                        <ul aria-expanded="false">
                            <li><a href="{{ route('dashboard.projects.index') }}">List</a></li>
                            @canCreate('projects')
                            <li><a href="{{ route('dashboard.projects.create') }}">Add</a></li>
                            @endcanCreate
                        </ul>
                    </li>
                    @endcanView
                    @canView('volunteer_applications')
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-heart"></i>
                            <span class="nav-text">Volunteers</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('dashboard.volunteer-applications.index') }}">Applications</a></li>
                        </ul>
                    </li>
                    @endcanView
                    @canView('student_applications')
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-user-graduate"></i>
                            <span class="nav-text">Students</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('dashboard.student-applications.index') }}">Applications</a></li>
                        </ul>
                    </li>
                    @endcanView

                    @canView('donations')
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-hand-holding-heart"></i>
                            <span class="nav-text">Donations</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('dashboard.donations.index') }}">Manage Donations</a></li>
                        </ul>
                    </li>
                    @endcanView

                    @canView('downloads')
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-download"></i>
                            <span class="nav-text">Downloads</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('dashboard.downloads.index') }}">Manage Downloads</a></li>
                            @canCreate('downloads')
                            <li><a href="{{ route('dashboard.downloads.create') }}">Add Download</a></li>
                            @endcanCreate
                        </ul>
                    </li>
                    @endcanView

                    @canView('static_pages')
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-file-alt"></i>
                            <span class="nav-text">Pages</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('dashboard.static-pages.index') }}">Static Pages</a></li>
                            @canCreate('static_pages')
                            <li><a href="{{ route('dashboard.static-pages.create') }}">Add New Page</a></li>
                            @endcanCreate
                        </ul>
                    </li>
                    @endcanView
                    @canView('users')
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-user-shield"></i>
                            <span class="nav-text">Users & Roles</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('dashboard.users.index') }}">Users</a></li>
                            @canCreate('users')
                            <li><a href="{{ route('dashboard.users.create') }}">Add User</a></li>
                            @endcanCreate
                            @canView('roles')
                            <li><a href="{{ route('dashboard.roles.index') }}">Roles</a></li>
                            @canCreate('roles')
                            <li><a href="{{ route('dashboard.roles.create') }}">Add Role</a></li>
                            @endcanCreate
                            @endcanView
                        </ul>
                    </li>
                    @endcanView

                    <li><a class="" href="{{ route('dashboard.activities.index') }}" aria-expanded="false">
                            <i class="fas fa-clock"></i>
                            <span class="nav-text">Activity Logs</span>
                        </a>
                    </li>

                    @canView('settings')
                    <li><a class="" href="{{ route('dashboard.settings.index') }}" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                            <span class="nav-text">Settings</span>
                        </a>
                    </li>
                    @endcanView

                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="" style="background: none; border: none; width: 100%; text-align: left; padding: 0.75rem 1.5rem; color: inherit; text-decoration: none; display: flex; align-items: center;">
                                <i class="fas fa-sign-out-alt"></i>
                                <span class="nav-text">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
                </ul>



            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
