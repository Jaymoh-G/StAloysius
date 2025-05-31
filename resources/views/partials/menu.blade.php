<div class="main-navigation">
    <nav class="navbar navbar-expand-lg">
        <div class="container position-relative">
            <a class="navbar-brand" href="index.html">
                <img src="assets/img/logo/logo.png" alt="logo" />
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
            <div class="collapse navbar-collapse" id="main_nav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown"></li>
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
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
                                    href="http://127.0.0.1:8000/our-team/madam-beatrice-maina"
                                    >Principal's Message</a
                                >
                            </li>
                            <li>
                                <a class="dropdown-item" href=""
                                    >Deputy Principal’s Message</a
                                >
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('our-pillars') }}"
                                    >Our Pillars</a
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
                                    href="{{ route('success-stories') }}"
                                    >Success Stories</a
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
                                                <a
                                                    href="#"
                                                    class="menu-about-logo"
                                                    ><img
                                                        src="{{ asset('assets/img/logo/Students.jpg') }}"
                                                        alt=""
                                                /></a>
                                            </div>
                                        </div>

                                        @php
                                            // Get main categories with their departments and subcategories
                                            $mainCategories = App\Models\DepCategory::where('is_main', true)
                                                ->with(['children.departments', 'departments'])
                                                ->get();

                                            // Get standalone categories (for backward compatibility)
                                            $standaloneCategories = App\Models\DepCategory::whereNull('parent_id')
                                                ->where('is_main', false)
                                                ->with('departments')
                                                ->get();
                                        @endphp

                                        @foreach($mainCategories as $mainCategory)
                                        <div class="col-12 col-sm-4 col-md-3">
                                            <h5>{{ $mainCategory->name }}</h5>
                                            <ul class="mega-menu-item">
                                                <!-- Direct departments under main category -->
                                                @foreach($mainCategory->departments as $department)
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('department', $department->slug) }}">
                                                        {{ $department->name }}
                                                    </a>
                                                </li>
                                                @endforeach

                                                <!-- Subcategories with their departments -->
                                                @foreach($mainCategory->children as $subCategory)
                                                <li class="dropdown-submenu">
                                                    <a class="dropdown-item dropdown-toggle" href="{{ route('departments') }}?category={{ $subCategory->slug }}">
                                                        {{ $subCategory->name }}
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        @forelse($subCategory->departments as $department)
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('department', $department->slug) }}">
                                                                {{ $department->name }}
                                                            </a>
                                                        </li>
                                                        @empty
                                                        <li>
                                                            <a class="dropdown-item disabled">No departments available</a>
                                                        </li>
                                                        @endforelse
                                                    </ul>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endforeach

                                        @if($standaloneCategories->count() > 0)
                                        <div class="col-12 col-sm-4 col-md-3">
                                            <h5>Other Departments</h5>
                                            <ul class="mega-menu-item">
                                                @foreach($standaloneCategories as $category)
                                                    @foreach($category->departments as $department)
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('department', $department->slug) }}">
                                                            {{ $department->name }}
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        <div class="col-12 col-sm-4 col-md-3">
                                            <div class="menu-about">
                                                <h5>Our Clubs</h5>
                                                <a href="#" class="menu-about-logo">
                                                    <img src="{{ asset('assets/img/logo/Students.jpg') }}" alt="" />
                                                </a>
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

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('events') }}"
                                    >Events</a
                                >
                            </li>

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('gallery') }}"
                                    >Gallery</a
                                >
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('careers') }}"
                                    >Careers</a
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
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="http://192.168.0.77:8080/cgi-bin/koha/mainpage.pl"
                                    >Student Portal</a
                                >
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="https://onlinesmis.com/index.php?id=nbi_stagss&portal"
                                    >Staff Portal</a
                                >
                            </li>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="https://staloysiusgonzaga.ac.ke/webmail"
                                    >Webmails</a
                                >
                            </li>
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
                        <div class="nav-right-btn mt-2 nav-link dropdown">
                            <a
                                href="{{ route('support-us') }}"
                                class="theme-btn"
                                ><span class="fal fa-pencil"></span>Support
                                Us</a
                            >
                            <ul class="dropdown-menu fade-down">
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route('support-us') }}"
                                        >Donate</a
                                    >
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route('events') }}"
                                        >Projects</a
                                    >
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route('events') }}"
                                        >Volunteer your Services</a
                                    >
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route('events') }}"
                                        >Careers</a
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










