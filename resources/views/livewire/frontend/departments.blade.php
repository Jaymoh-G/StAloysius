<div>
    @section('content')
        <main class="main">
            <!-- breadcrumb -->
            <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
                <div class="container">
                    <h2 class="breadcrumb-title">Our Departments</h2>
                    <ul class="breadcrumb-menu">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Our Departments</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb end -->

            <!-- department area -->
            <div class="department-area py-120">
                <div class="container">
                    <!-- Academic Departments -->
                    <div class="row mb-5">
                        <div class="col-lg-6 mx-auto">
                            <div class="site-heading text-center">
                                <span class="site-title-tagline"><i class="far fa-book-open-reader"></i>
                                    Departments</span>
                                <h2 class="site-title">Academic <span>Departments</span></h2>
                                <p>Explore our academic departments dedicated to excellence in education and research.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        @forelse($academicDepts as $dept)
                            <div class="col-lg-4">
                                <div class="department-item">
                                    <div class="department-icon">
                                        <img src="{{ $dept->featuredImage ? asset('storage/' . $dept->featuredImage->path) : asset('assets/img/icon/book.svg') }}"
                                            alt="{{ $dept->name }}" />
                                    </div>
                                    <div class="department-info">
                                        <h4 class="department-title">
                                            <a href="{{ route('department', $dept->slug) }}">{{ $dept->name }}</a>
                                        </h4>
                                        <p class="department-description"
                                            style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                            {!! $dept->content ?? 'Department information coming soon.' !!}</p>
                                        <div class="department-btn">
                                            <a href="{{ route('department', $dept->slug) }}">Read More<i
                                                    class="fas fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <p>No academic departments found.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Non-Academic Departments -->
                    <div class="row">
                        <div class="col-lg-12 mx-auto">
                            <div class="site-heading text-center">
                                <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Departments</span>
                                <h2 class="site-title">Non-Academic <span>Departments</span></h2>
                                <p>Explore our non-academic departments </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @forelse($nonAcademicDepts as $dept)
                            <div class="col-lg-4">
                                <div class="department-item">
                                    <div class="department-icon">
                                        <img src="{{ $dept->featuredImage ? asset('storage/' . $dept->featuredImage->path) : asset('assets/img/icon/support.svg') }}"
                                            alt="{{ $dept->name }}" />
                                    </div>
                                    <div class="department-info">
                                        <h4 class="department-title">
                                            <a href="{{ route('department', $dept->slug) }}">{{ $dept->name }}</a>
                                        </h4>
                                        <p class="department-description"
                                            style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                            {!! $dept->content ?? 'Department information coming soon.' !!}</p>
                                        <div class="department-btn">
                                            <a href="{{ route('department', $dept->slug) }}">Read More<i
                                                    class="fas fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <p>No non-academic departments found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- department area end -->
        </main>
    @endsection
</div>

</div>
