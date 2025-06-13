<div>
    @section('content')
        <main class="main">

            <!-- breadcrumb -->
            <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
                <div class="container">
                    <h2 class="breadcrumb-title">Our Facilities</h2>
                    <ul class="breadcrumb-menu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">Our Facilities</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb end -->

            <!-- facility area -->
            <div class="facility-area py-120">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 mx-auto">
                            <div class="site-heading text-center">
                                <span class="site-title-tagline"><i class="far fa-book-open-reader"></i></span>
                                <h2 class="site-title">Our <span>Facilities</span></h2>
                                <p>Explore our state-of-the-art facilities designed to provide the best learning environment
                                    for our students.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($facilities as $facility)
                            <div class="col-md-6 col-lg-4">
                                <div class="facility-item wow fadeInUp" data-wow-delay=".25s">
                                    <div class="facility-img">
                                        @if ($facility->images->where('is_featured', true)->first())
                                            <img src="{{ asset('storage/' . $facility->images->where('is_featured', true)->first()->path) }}"
                                                alt="{{ $facility->name }}">
                                        @elseif($facility->images->first())
                                            <img src="{{ asset('storage/' . $facility->images->first()->path) }}"
                                                alt="{{ $facility->name }}">
                                        @endif
                                    </div>
                                    <div class="facility-content">
                                        <h3 class="facility-title">
                                            <a href="{{ route('facility', $facility->slug) }}">{{ $facility->name }}</a>
                                        </h3>
                                        <p class="facility-text">
                                            {!! Str::limit(strip_tags($facility->content), 150) !!}
                                        </p>
                                        <div class="facility-arrow">
                                            <a href="{{ route('facility', $facility->slug) }}" class="theme-btn">
                                                Read More<i class="fas fa-arrow-right-long"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- facility area end -->

        </main>
    @endsection

</div>
