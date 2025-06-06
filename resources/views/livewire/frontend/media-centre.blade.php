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
        <div class="gallery-area py-120">
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

                @php
                    // Get random albums with cover images
                    $randomAlbums = \App\Models\Album::whereNotNull('cover_image')
                        ->inRandomOrder()
                        ->take(8)
                        ->get();
                @endphp

                <div class="gallery-slider owl-carousel owl-theme">
                    @forelse($randomAlbums as $album)
                        <div class="gallery-item">
                            <div class="gallery-img" style="height: 250px;">
                                <img src="{{ asset('storage/' . $album->cover_image) }}" alt="{{ $album->title }}"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                                <div class="gallery-info">
                                    <h5 class="album-title">{{ Str::limit($album->title, 20) }}</h5>
                                    <p class="album-count"><i class="far fa-images me-1"></i>{{ $album->images_count ?? $album->images()->count() }} Photos</p>
                                </div>
                                <div class="gallery-content">
                                    <div class="gallery-action-buttons">
                                        <a class="popup-img gallery-link" href="{{ asset('storage/' . $album->cover_image) }}">
                                            <i class="far fa-plus"></i>
                                        </a>
                                        <a class="gallery-link view-album-link" href="{{ route('gallery.album', $album->slug) }}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="gallery-item">
                            <div class="gallery-img" style="height: 250px;">
                                <img src="assets/img/gallery/01.jpg" alt="Gallery Image"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                                <div class="gallery-info">
                                    <h5 class="album-title">Sample Gallery</h5>
                                    <p class="album-count"><i class="far fa-images me-1"></i>0 Photos</p>
                                </div>
                                <div class="gallery-content">
                                    <div class="gallery-action-buttons">
                                        <a class="popup-img gallery-link" href="assets/img/gallery/01.jpg">
                                            <i class="far fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="text-center mt-5">
                    <a href="{{ route('gallery') }}" class="theme-btn">
                        View Full Gallery <i class="fas fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
        </div>

        <style>
            .gallery-item {
                position: relative;
                margin-bottom: 20px;
                overflow: hidden;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .gallery-item:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            }

            .gallery-img {
                position: relative;
                overflow: hidden;
            }

            .gallery-img img {
                transition: transform 0.5s ease;
            }

            .gallery-item:hover .gallery-img img {
                transform: scale(1.05);
            }

            .gallery-content {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(0, 0, 0, 0.4);
                opacity: 0;
                transition: all 0.3s ease;
            }

            .gallery-item:hover .gallery-content {
                opacity: 1;
            }

            .gallery-action-buttons {
                display: flex;
                gap: 10px;
            }

            .gallery-link {
                width: 40px;
                height: 40px;
                background: var(--theme-color);
                color: #fff;
                border-radius: 10%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                transform: scale(0);
                transition: all 0.3s ease;
            }

            .gallery-item:hover .gallery-link {
                transform: scale(1);
            }

            .view-album-link {
                background: var(--theme-color2);
            }

            .gallery-info {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
                color: #fff;
                padding: 15px;
                opacity: 1;
                transition: all 0.3s ease;
                z-index: 5;
            }

            .gallery-item:hover .gallery-info {
                padding-bottom: 20px;
            }

            .album-title {
                font-size: 16px;
                font-weight: 600;
                margin-bottom: 5px;
                color: #fff;
            }

            .album-count {
                font-size: 13px;
                color: rgba(255, 255, 255, 0.8);
                margin: 0;
            }
        </style>

        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Check if jQuery and Owl Carousel are available
                if (typeof jQuery === 'undefined') {
                    console.error('jQuery is not loaded');
                    return;
                }

                if (typeof jQuery.fn.owlCarousel === 'undefined') {
                    console.error('Owl Carousel is not loaded');
                    return;
                }

                // Initialize the carousel
                jQuery(function($) {
                    $('.gallery-slider').owlCarousel({
                        loop: true,
                        margin: 20,
                        nav: true,
                        dots: true,
                        autoplay: true,
                        autoplayTimeout: 5000,
                        navText: [
                            "<i class='far fa-angle-left'></i>",
                            "<i class='far fa-angle-right'></i>"
                        ],
                        responsive: {
                            0: {
                                items: 1
                            },
                            576: {
                                items: 2
                            },
                            768: {
                                items: 3
                            },
                            992: {
                                items: 4
                            }
                        }
                    });

                    console.log('Gallery carousel initialized');
                });
            });
        </script>
        @endpush
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
                    @if($latestJobs->isEmpty())
                        <div class="col-12 text-center">
                            <p>No job vacancies available at the moment. Please check back later.</p>
                        </div>
                    @else
                        @foreach($latestJobs as $job)
                        <div class="col-md-6 col-lg-6">
                            <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                                <div class="blog-date">
                                    <i class="fal fa-calendar-alt"></i> Deadline: {{ $job->deadline->format('M d, Y') }}
                                </div>
                                <div class="blog-item-info">
                                    <div class="blog-item-meta">
                                        <ul>
                                            <li><a href="#"><i class="far fa-tag"></i> {{ $job->category->name }}</a></li>
                                        </ul>
                                    </div>
                                    <h4 class="blog-title">
                                        <a href="{{ route('careers.show', $job->slug) }}">{{ $job->title }}</a>
                                    </h4>
                                    <p>{{ Str::limit(strip_tags($job->description), 100) }}</p>
                                    <a class="theme-btn" href="{{ route('careers.show', $job->slug) }}">View Details<i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-12 text-center mt-5">
                    <a href="{{ route('careers') }}" class="theme-btn">View All Opportunities<i class="fas fa-arrow-right-long"></i></a>
                </div>
            </div>
        </div>
        <!-- Careers section end -->

       </main>
    @endsection
</div>



















