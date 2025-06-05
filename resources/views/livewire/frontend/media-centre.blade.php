<div>
    @section('content')
       <main class="main">

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Media Centre</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="/">Home</a></li>
                    <li class="active">Media Centre</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->



        <!-- Events section -->
        <div class="event-area bg-light py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div class="site-heading mb-0">

                                <h2 class="site-title">Upcoming <span>Events</span></h2>
                                <p class="mb-0">Join us for these exciting upcoming events and activities at our school.</p>
                            </div>
                            <div>
                                <a href="{{ route('events') }}" class="theme-btn">View All Events<i class="fas fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if($upcomingEvents->isEmpty())
                        <div class="col-12 text-center">
                            <p>No upcoming events scheduled. Check back soon!</p>
                        </div>
                    @else
                        @foreach($upcomingEvents as $event)
                        <div class="col-lg-4">
                            <div class="event-item">
                                <div class="event-location">
                                    <span><i class="far fa-map-marker-alt"></i> {{ $event->location }}</span>
                                </div>
                                <div class="event-img">
                                    @if($event->featuredImage)
                                        <img src="{{ asset('storage/' . $event->featuredImage->path) }}" alt="{{ $event->name }}">
                                    @elseif($event->banner)
                                        <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->name }}">
                                    @else
                                        <img src="{{ asset('assets/img/event/default.jpg') }}" alt="{{ $event->name }}">
                                    @endif
                                </div>
                                <div class="event-info">
                                    <div class="event-meta">
                                        <span class="event-date"><i class="far fa-calendar-alt"></i> {{ formattedDate($event->start_date) }}</span>
                                        <span class="event-time"><i class="far fa-clock"></i> {{ formattedTime($event->start_time) }} - {{ formattedTime($event->end_time) }}</span>
                                    </div>
                                    <h4 class="event-title"><a href="{{ route('event', $event->slug) }}">{{ $event->name }}</a></h4>
                                    <p>{{ str(strip_tags($event->content))->limit(80) }}</p>
                                    <div class="event-btn">
                                        <a href="{{ route('event', $event->slug) }}" class="theme-btn">View Details<i class="fas fa-arrow-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- Events section end -->

        <!-- News section -->
        <div class="blog-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div class="site-heading mb-0">

                                <h2 class="site-title">Latest <span>News</span></h2>
                                <p class="mb-0">Stay updated with the latest news and announcements from our school.</p>
                            </div>
                            <div>
                                <a href="{{ route('news') }}" class="theme-btn">View All News<i class="fas fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if($latestNews->isEmpty())
                        <div class="col-12 text-center">
                            <p>No news articles available. Check back soon!</p>
                        </div>
                    @else
                        @foreach($latestNews as $news)
                        <div class="col-md-6 col-lg-4">
                            <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                                <div class="blog-date">
                                    <i class="fal fa-calendar-alt"></i> {{ formattedDate($news->created_at) }}
                                </div>
                                <div class="blog-item-img">
                                    @if($news->banner)
                                        <img src="{{ asset('storage/' . $news->banner) }}" alt="{{ $news->title }}">
                                    @else
                                        <img src="{{ asset('assets/img/blog/01.jpg') }}" alt="{{ $news->title }}">
                                    @endif
                                </div>
                                <div class="blog-item-info">
                                    <div class="blog-item-meta">
                                        <ul>
                                            <li><a href="#"><i class="far fa-user-circle"></i> By Admin</a></li>
                                            @if($news->category)
                                            <li><a href="#"><i class="far fa-tag"></i> {{ $news->category->name }}</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <h4 class="blog-title">
                                        <a href="{{ route('news.single', $news->slug) }}">{{ $news->title }}</a>
                                    </h4>
                                    <p>{{ str(strip_tags($news->content))->limit(80) }}</p>
                                    <a class="theme-btn" href="{{ route('news.single', $news->slug) }}">Read More<i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- News section end -->

        <!-- Gallery section -->
        <div class="gallery-area bg-light py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="far fa-images"></i></span>
                            <h2 class="site-title">Photo <span>Gallery</span></h2>
                            <p>Explore moments captured from various school activities and events.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <div class="gallery-item">
                            <img src="assets/img/gallery/01.jpg" alt="Gallery Image">
                            <div class="gallery-item-content">
                                <div class="gallery-item-icon">
                                    <a href="assets/img/gallery/01.jpg" class="popup-img">
                                        <i class="far fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- More gallery items -->
                    <div class="col-12 text-center mt-5">
                        <a href="{{ route('gallery') }}" class="theme-btn">View Full Gallery<i class="fas fa-arrow-right-long"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery section end -->

        <!-- Careers section -->
        <div class="career-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="far fa-briefcase"></i></span>
                            <h2 class="site-title">Career <span>Opportunities</span></h2>
                            <p>Join our team of dedicated educators and staff. Explore current openings.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="career-item">
                            <div class="career-content">
                                <h4><a href="{{ route('careers') }}">Mathematics Teacher</a></h4>
                                <p>We're looking for an experienced Mathematics teacher to join our secondary school faculty.</p>
                                <div class="career-meta">
                                    <span><i class="far fa-map-marker-alt"></i> On-site</span>
                                    <span><i class="far fa-clock"></i> Full-time</span>
                                </div>
                            </div>
                            <div class="career-link">
                                <a href="{{ route('careers') }}"><i class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- More career items -->
                    <div class="col-12 text-center mt-5">
                        <a href="{{ route('careers') }}" class="theme-btn">View All Opportunities<i class="fas fa-arrow-right-long"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Careers section end -->

       </main>
    @endsection
</div>




