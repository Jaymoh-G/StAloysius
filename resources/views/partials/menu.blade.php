<div class="main-navigation">
    <nav class="navbar navbar-expand-lg">
        <div class="position-relative container">
            <a href="{{ route('home') }}">
                <div
                    class="navbar-brand"
                    style="display: flex; align-items: center"
                >
                    <img
                        src="{{
                            asset('assets/img/logo/St_Aloysius_Sch_Logo.png')
                        }}"
                        alt="logo"
                        class="brand-logo-img"
                        style="
                            max-height: 140px;
                            display: block;
                            align-items: center;
                        "
                    />
                </div>
            </a>

            <div class="mobile-menu-right">
                <div class="search-btn">
                    <button
                        type="button"
                        class="nav-right-link search-box-outer"
                    >
                        <i class="far fa-search"></i>
                    </button>
                </div>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#main_nav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-mobile-icon"
                        ><i class="far fa-bars"></i
                    ></span>
                </button>
            </div>

            <div class="navbar-collapse collapse" id="main_nav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="{{ route('about-us') }}"
                            data-bs-toggle="dropdown"
                            >About Us</a
                        >
                        <ul class="dropdown-menu fade-down">
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('our-team') }}"
                                    >Our Team</a
                                >
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="/news/a-message-from-the-principal"
                                    >Principal's Message</a
                                >
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('our-facilities') }}"
                                    >Facilities</a
                                >
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('testimonials') }}"
                                    >Testimonials</a
                                >
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('clc') }}"
                                    >Christian Life Community</a
                                >
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item mega-menu dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="{{ route('departments') }}"
                            data-bs-toggle="dropdown"
                            >Departments</a
                        >
                        <div class="dropdown-menu fade-down">
                            <div class="mega-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12 col-sm-4 col-md-3">
                                            <div class="menu-about">
                                                @if (setting('main_menu_logo_1'))
                                                <a
                                                    href="#"
                                                    class="menu-about-logo"
                                                >
                                                    <img
                                                        src="{{
                                                            asset(
                                                                'storage/'.setting(
                                                                    'main_menu_logo_1'
                                                                )
                                                            )
                                                        }}"
                                                        alt="Menu Logo 1"
                                                        style="
                                                            max-width: 100%;
                                                            height: auto;
                                                        "
                                                    />
                                                </a>
                                                @else
                                                <a
                                                    href="#"
                                                    class="menu-about-logo"
                                                >
                                                    <img
                                                        src="{{
                                                            asset(
                                                                'assets/img/logo/Students1.jpg'
                                                            )
                                                        }}"
                                                        alt="Default Menu Logo"
                                                        style="
                                                            max-width: 100%;
                                                            height: auto;
                                                        "
                                                    />
                                                </a>
                                                @endif
                                            </div>
                                        </div>

                                        @php $mainCategories =
                                        App\Models\DepCategory::where('is_main',
                                        true)->with(['children.departments',
                                        'departments'])->get();
                                        $standaloneCategories =
                                        App\Models\DepCategory::whereNull('parent_id')->where('is_main',
                                        false)->with('departments')->get();
                                        @endphp @foreach ($mainCategories as $mainCategory)
                                        <div class="col-12 col-sm-4 col-md-3">
                                            <h5>{{ $mainCategory->name }}</h5>
                                            <ul class="mega-menu-item">
                                                @foreach($mainCategory->departments
                                                as $department)
                                                <li>
                                                    <a
                                                        class="dropdown-item"
                                                        href="{{ route('department', $department->slug) }}"
                                                    >
                                                        {{ $department->name }}
                                                    </a>
                                                </li>
                                                @endforeach
                                                @foreach($mainCategory->children as $subCategory)
                                                <li class="dropdown-submenu">
                                                    <a
                                                        class="dropdown-item dropdown-toggle"
                                                        href="{{
                                                            route('departments')
                                                        }}?category={{ $subCategory->slug }}"
                                                    >
                                                        {{ $subCategory->name }}
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        @forelse($subCategory->departments
                                                        as $department)
                                                        <li>
                                                            <a
                                                                class="dropdown-item"
                                                                href="{{ route('department', $department->slug) }}"
                                                            >
                                                                {{ $department->name }}
                                                            </a>
                                                        </li>
                                                        @empty
                                                        <li>
                                                            <a
                                                                class="dropdown-item disabled"
                                                                >No departments
                                                                available</a
                                                            >
                                                        </li>
                                                        @endforelse
                                                    </ul>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endforeach @if ($standaloneCategories->count() > 0)
                                        <div class="col-12 col-sm-4 col-md-3">
                                            <h5>Other Departments</h5>
                                            <ul class="mega-menu-item">
                                                @foreach($standaloneCategories as $category)
                                                @foreach($category->departments as $department)
                                                <li>
                                                    <a
                                                        class="dropdown-item"
                                                        href="{{ route('department', $department->slug) }}"
                                                    >
                                                        {{ $department->name }}
                                                    </a>
                                                </li>
                                                @endforeach @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        <div class="col-12 col-sm-4 col-md-3">
                                            <div class="menu-about">
                                                @if(setting('main_menu_logo_2'))
                                                <a
                                                    href="#"
                                                    class="menu-about-logo"
                                                >
                                                    <img
                                                        src="{{
                                                            asset(
                                                                'storage/'.setting(
                                                                    'main_menu_logo_2'
                                                                )
                                                            )
                                                        }}"
                                                        alt="Menu Logo 2"
                                                        style="
                                                            max-width: 100%;
                                                            height: auto;
                                                        "
                                                    />
                                                </a>
                                                @else
                                                <a
                                                    href="#"
                                                    class="menu-about-logo"
                                                >
                                                    <img
                                                        src="{{
                                                            asset(
                                                                'assets/img/logo/Students.jpg'
                                                            )
                                                        }}"
                                                        alt="Default Menu Logo 2"
                                                        style="
                                                            max-width: 100%;
                                                            height: auto;
                                                        "
                                                    />
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            data-bs-toggle="dropdown"
                            >Admissions</a
                        >
                        <ul class="dropdown-menu fade-down">
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('admission-policy') }}"
                                    >Admission Policy</a
                                >
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('scholarships') }}"
                                    >Scholarships</a
                                >
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('fee-paying-students') }}"
                                    >Fees Paying Students</a
                                >
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('how-to-apply') }}"
                                    >How to Apply</a
                                >
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="{{ route('media-centre') }}"
                            data-bs-toggle="dropdown"
                            >Media Centre</a
                        >
                        <ul class="dropdown-menu fade-down">
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('news') }}"
                                    >News</a
                                >
                            </li>
                            <li class="nav-item dropdown-submenu">
                                <a
                                    class="dropdown-item dropdown-toggle"
                                    href="{{ route('events') }}"
                                    >Events</a
                                >
                                <ul class="dropdown-menu">
                                    <li>
                                        <a
                                            class="dropdown-item"
                                            href="{{
                                                route('upcoming-events')
                                            }}"
                                            >Upcoming Events</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="dropdown-item"
                                            href="{{ route('past-events') }}"
                                            >Past Events</a
                                        >
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown-submenu">
                                <a
                                    class="dropdown-item dropdown-toggle"
                                    href="{{ route('gallery') }}"
                                    >Gallery</a
                                >
                                <ul class="dropdown-menu">
                                    <li>
                                        <a
                                            class="dropdown-item"
                                            href="{{ route('photos') }}"
                                            >Photo Gallery</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="dropdown-item"
                                            href="{{ route('videos') }}"
                                            >Video Gallery</a
                                        >
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('careers') }}"
                                    >Careers</a
                                >
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('downloads') }}"
                                    >Downloads</a
                                >
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            data-bs-toggle="dropdown"
                            >School Portals</a
                        >
                        <ul class="dropdown-menu fade-down">
                            @if (setting('student_portal'))
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ setting('student_portal') }}"
                                    >Student Portal</a
                                >
                            </li>
                            @else
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="http://192.168.0.77:8080/cgi-bin/koha/mainpage.pl"
                                    >Student Portal</a
                                >
                            </li>
                            @endif @if (setting('staff_portal'))
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ setting('staff_portal') }}"
                                    >Staff Portal</a
                                >
                            </li>
                            @else
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="https://onlinesmis.com/index.php?id=nbi_stagss&portal"
                                    >Staff Portal</a
                                >
                            </li>
                            @endif @if (setting('webmail_portal'))
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ setting('webmail_portal') }}"
                                    >Webmails</a
                                >
                            </li>
                            @else
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="https://staloysiusgonzaga.ac.ke/webmail"
                                    >Webmails</a
                                >
                            </li>
                            @endif
                        </ul>
                    </li>
                </ul>

                <div class="nav-right">
                    <div class="search-btn">
                        <button
                            type="button"
                            class="nav-right-link search-box-outer"
                        >
                            <i class="far fa-search"></i>
                        </button>
                    </div>

                    <div class="nav-item dropdown">
                        <div class="nav-right-btn nav-link dropdown mt-2">
                            <a
                                href="{{ route('support-us') }}"
                                class="theme-btn"
                            >
                                <span class="fal fa-pencil"></span>Support Us
                            </a>
                            <ul class="dropdown-menu fade-down">
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route('donations') }}"
                                        >Donate</a
                                    >
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route('projects') }}"
                                        >Projects</a
                                    >
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route('volunteer') }}"
                                        >Volunteer your Services</a
                                    >
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
