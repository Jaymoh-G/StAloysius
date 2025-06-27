<div>
    @section('content')
        <!-- hero slider -->
        <div class="hero-section">
            <div class="hero-slider owl-carousel owl-theme">
                @if ($sliderContent)
                    @for ($i = 1; $i <= 10; $i++)
                        @php
                            $titleField = "section_{$i}_title";
                            $contentField = "section_{$i}_content";
                            $title = $sliderContent->$titleField;
                            $content = $sliderContent->$contentField;
                        @endphp

                        @if ($title || $content)
                            <div class="hero-single"
                                style="background: url({{ $sliderContent->banner_image ? asset('storage/' . $sliderContent->banner_image) : asset('assets/img/slider/s' . $i . '.jpg') }})">
                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-md-12 col-lg-7">
                                            <div class="hero-content">
                                                @if ($title)
                                                    <h6 class="hero-sub-title" data-animation="fadeInDown" data-delay=".25s">
                                                        <i class="far fa-book-open-reader"></i>
                                                        St. Aloysius Gonzaga Sch
                                                    </h6>
                                                @endif
                                                <h1 class="hero-title" data-animation="fadeInRight" data-delay=".50s">

                                                </h1>
                                                <p data-animation="fadeInLeft" data-delay=".75s"> {!! $content !!}
                                                </p>
                                                <div class="hero-btn" data-animation="fadeInUp" data-delay="1s">
                                                    <a href="about.html" class="theme-btn">About More<i
                                                            class="fas fa-arrow-right-long"></i></a>
                                                    <a href="contact.html" class="theme-btn theme-btn2">Learn More<i
                                                            class="fas fa-arrow-right-long"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endfor
                @endif


            </div>
        </div>
        <!-- hero slider end -->

        <!-- Homepage Content from Static Pages -->
        @if ($homeContent)
            @for ($i = 1; $i <= 10; $i++)
                @php
                    $titleField = "section_{$i}_title";
                    $contentField = "section_{$i}_content";
                    $title = $homeContent->$titleField;
                    $content = $homeContent->$contentField;
                @endphp
            @endfor
        @endif

        <!-- about area -->
        <div class="about-area py-120">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="about-left wow fadeInLeft" data-wow-delay=".25s">
                            <div class="about-img">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        @if ($homeContent && $homeContent->images()->where('category', 'section_1')->first())
                                            <img class="img-1"
                                                src="{{ asset('storage/' . $homeContent->images()->where('category', 'section_1')->first()->path) }}"
                                                alt="">
                                        @else
                                            <img class="img-1" src="{{ asset('assets/img/about/01.jpg') }}" alt="">
                                        @endif
                                        <div class="about-experience mt-4">
                                            <div class="about-experience-icon">
                                                <img src="{{ asset('assets/img/icon/exchange-idea.svg') }}" alt="">
                                            </div>
                                            <b class="text-start">30 Years Of <br> Quality Service</b>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($homeContent && $homeContent->images()->where('category', 'section_2')->first())
                                            <img class="img-2"
                                                src="{{ asset('storage/' . $homeContent->images()->where('category', 'section_2')->first()->path) }}"
                                                alt="">
                                        @else
                                            <img class="img-2" src="{{ asset('assets/img/about/02.jpg') }}" alt="">
                                        @endif
                                        @if ($homeContent && $homeContent->images()->where('category', 'section_3')->first())
                                            <img class="img-3 mt-4"
                                                src="{{ asset('storage/' . $homeContent->images()->where('category', 'section_3')->first()->path) }}"
                                                alt="">
                                        @else
                                            <img class="img-3 mt-4" src="{{ asset('assets/img/about/03.jpg') }}"
                                                alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-right wow fadeInRight" data-wow-delay=".25s">
                            <div class="site-heading mb-3">
                                <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> About Us</span>
                                <h2 class="site-title">
                                    {!! $homeContent ? $homeContent->section_1_title : '' !!}
                                </h2>
                            </div>
                            <p class="about-text">
                                {!! $homeContent
                                    ? $homeContent->section_1_content
                                    : 'There are many variations of passages available but the majority have suffered alteration in some form by injected humour randomised words which don\'t look even slightly believable. If you are going to use passage.' !!}
                            </p>
                            <div class="about-content">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="about-item">
                                            <div class="about-item-icon">
                                                <img src="{{ asset('assets/img/icon/open-book.svg') }}" alt="">
                                            </div>
                                            <div class="about-item-content">
                                                <h5>{!! $homeContent ? $homeContent->section_2_title : 'Education Services' !!}</h5>
                                                <p>{!! $homeContent
                                                    ? $homeContent->section_2_content
                                                    : 'It is a long established fact that reader will to using content.' !!}</p>
                                            </div>
                                        </div>
                                        <div class="about-item">
                                            <div class="about-item-icon">
                                                <img src="{{ asset('assets/img/icon/global-education.svg') }}"
                                                    alt="">
                                            </div>
                                            <div class="about-item-content">
                                                <h5>{!! $homeContent ? $homeContent->section_3_title : 'International Hubs' !!}</h5>
                                                <p>{!! $homeContent
                                                    ? $homeContent->section_3_content
                                                    : 'It is a long established fact that reader will to using content.' !!}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="about-bottom">
                                <a href="about.html" class="theme-btn">Discover More<i
                                        class="fas fa-arrow-right-long"></i></a>
                                <div class="about-phone">
                                    <div class="icon"><i class="fal fa-headset"></i></div>
                                    <div class="number">
                                        <span>Call Now</span>
                                        <h6><a href="tel:+21236547898">+2 123 654 7898</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- about area end -->








        <!-- video-area -->
        <div class="video-area">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 wow fadeInLeft" data-wow-delay=".25s">
                        <div class="site-heading mb-3">
                            <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Latest Videos</span>
                            @if ($featuredVideos)
                            <h2 class="site-title">
                                {{ $featuredVideos->title }}
                            </h2>
                            @endif
                        </div>
                        @if ($featuredVideos)
                        <p class="about-text">
                            {{ Str::limit($featuredVideos->description, 150) }}
                            </p>
                        @endif
                        @if ($featuredVideos)
                            <a href="{{ route('videos') }}" class="theme-btn mt-30">View All Videos<i
                                class="fas fa-arrow-right-long"></i></a>
                        @endif
                    </div>
                    <div class="col-lg-8 wow fadeInRight" data-wow-delay=".25s">
                        @if ($featuredVideos)
                            <div class="video-content"
                                style="background-image: url({{ $featuredVideos->thumbnail ? asset('storage/' . $featuredVideos->thumbnail) : 'https://img.youtube.com/vi/' . $featuredVideos->video_id . '/mqdefault.jpg' }});">
                                <div class="row align-items-center">
                                    <div class="col-lg-12">
                                        <div class="video-wrapper">
                                            <a class="play-btn popup-youtube"
                                                href="https://www.youtube.com/watch?v={{ $featuredVideos->video_id }}">
                                                <i class="fas fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="video-content"
                                style="background-image: url({{ asset('assets/img/video/01.jpg') }});">
                                <div class="row align-items-center">
                                    <div class="col-lg-12">
                                        <div class="video-wrapper">
                                            <a class="play-btn popup-youtube"
                                                href="https://www.youtube.com/watch?v=ckHzmP1evNU">
                                                <i class="fas fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- video-area end -->


        <!-- department area -->
        <div class="department-area bg py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Department</span>
                            <h2 class="site-title">Browse Our <span>Department</span></h2>
                            <p>Explore our academic and non-academic departments dedicated to excellence in education and
                                research.</p>
                        </div>
                    </div>
                </div>
                <div class="department-slider owl-carousel owl-theme">
                    @foreach ($departments as $department)
                        <div class="department-item">
                            <div class="department-icon">
                                <img src="{{ asset('storage/' . $department->banner) }}" alt="{{ $department->name }}">
                            </div>
                            <div class="department-info">
                                <h4 class="department-title"><a
                                        href="{{ route('department', $department->slug) }}">{{ $department->name }}</a>
                                </h4>
                                <p class="department-description"
                                    style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                    {!! $department->content ?? 'Department information coming soon.' !!}</p>
                                <div class="department-btn">
                                    <a href="{{ route('department', $department->slug) }}">Read More<i
                                            class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- department area end -->





        <!-- choose-area -->
        <div class="choose-area pb-80 pt-80">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="choose-content wow fadeInUp" data-wow-delay=".25s">
                            <div class="choose-content-info">
                                <div class="site-heading mb-0">
                                    <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Why Choose
                                        Us</span>
                                    <h2 class="site-title mb-10 text-white">
                                        {!! $homeContent ? $homeContent->section_4_title : '' !!}
                                    </h2>
                                    <p class="text-white">
                                        {!! $homeContent ? $homeContent->section_4_content : '' !!}
                                    </p>
                                </div>
                                <div class="choose-content-wrap">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="choose-item">
                                                <div class="choose-item-icon">
                                                    <img src="assets/img/icon/teacher-2.svg" alt="">
                                                </div>
                                                <div class="choose-item-info">
                                                    <h4>{!! $homeContent ? $homeContent->section_5_title : '' !!}</h4>
                                                    <p>{!! $homeContent ? $homeContent->section_5_content : '' !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="choose-item">
                                                <div class="choose-item-icon">
                                                    <img src="assets/img/icon/course-material.svg" alt="">
                                                </div>
                                                <div class="choose-item-info">
                                                    <h4>{!! $homeContent ? $homeContent->section_6_title : '' !!}</h4>
                                                    <p>{!! $homeContent ? $homeContent->section_6_content : '' !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="choose-item">
                                                <div class="choose-item-icon">
                                                    <img src="{{ asset('assets/img/icon/online-course.svg') }}"
                                                        alt="">
                                                </div>
                                                <div class="choose-item-info">
                                                    <h4>{!! $homeContent ? $homeContent->section_7_title : '' !!}</h4>
                                                    <p>{!! $homeContent ? $homeContent->section_7_content : '' !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="choose-item">
                                                <div class="choose-item-icon">
                                                    <img src="assets/img/icon/money.svg" alt="">
                                                </div>
                                                <div class="choose-item-info">
                                                    <h4>{!! $homeContent ? $homeContent->section_8_title : '' !!}</h4>
                                                    <p>{!! $homeContent ? $homeContent->section_8_content : '' !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($homeContent && $homeContent->images()->where('category', 'section_4')->first())
                    <div class="col-lg-6">
                        <div class="choose-img wow fadeInRight" data-wow-delay=".25s">
                                    <img src="{{ asset('storage/' . $homeContent->images()->where('category', 'section_4')->first()->path) }}" alt="">
                                </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- choose-area end -->




        <!-- event area -->
        <div class="event-area bg py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Events</span>
                            <h2 class="site-title">Our Upcoming <span>Events</span></h2>
                            <p>It is a long established fact that a reader will be distracted by the readable content of
                                a page when looking at its layout.</p>
                        </div>
                    </div>
                </div>
                @if ($events->count() > 0)
                    <div class="event-slider owl-carousel owl-theme">
                        @foreach ($events as $event)
                            <div class="event-item">
                                <div class="event-location">
                                    <span><i class="far fa-map-marker-alt"></i> {{ $event->location }}</span>
                                </div>
                                <div class="event-img">
                                    @if ($event->featuredImage)
                                        <img src="{{ asset('storage/' . $event->featuredImage->path) }}"
                                            alt="{{ $event->name }}">
                                    @elseif($event->banner)
                                        <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->name }}">
                                    @else
                                        <img src="{{ asset('assets/img/event/default.jpg') }}"
                                            alt="{{ $event->name }}">
                                    @endif
                                </div>
                                <div class="event-info">
                                    <div class="event-meta">
                                        <span class="event-date"><i
                                                class="far fa-calendar-alt"></i>{{ formattedDate($event->start_date) }}</span>
                                        <span class="event-time"><i
                                                class="far fa-clock"></i>{{ formattedTime($event->start_time) }} -
                                            {{ formattedTime($event->end_time) }}</span>
                                    </div>
                                    <h4 class="event-title"><a
                                            href="{{ route('event', $event->slug) }}">{{ $event->name }}</a></h4>
                                    <p> {{ str(strip_tags($event->content))->limit(80) }}
                                    </p>
                                    <div class="event-btn">
                                        <a href="{{ route('event', $event->slug) }}" class="theme-btn">Read more<i
                                                class="fas fa-arrow-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center">
                        <p>No upcoming events scheduled at this time.</p>
                    </div>
                @endif
            </div>
        </div>
        <!-- event area end -->


        <!-- enroll area-->
        <div class="enroll-area pb-80 pt-80">
            <div class="container">
                <div class="col-lg-12">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6">
                            <div class="enroll-left wow fadeInLeft" data-wow-delay=".25s">
                                <div class="enroll-form">
                                    <div class="enroll-form-header">
                                        <h3>Start Your Enrollment</h3>
                                        <p>We are variations of passages the have suffered.</p>
                                    </div>
                                    <form action="#">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Your Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Email Address">
                                        </div>

                                        <div class="form-group">
                                            <textarea name="message" class="form-control" placeholder="Type Message" rows="4"></textarea>
                                        </div>
                                        <button class="theme-btn">Enroll Now<i
                                                class="fas fa-arrow-right-long"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="enroll-right wow fadeInUp" data-wow-delay=".25s">
                                <div class="skill-content">
                                    <div class="site-heading mb-3">
                                        <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Our
                                            Skills</span>
                                        <h2 class="site-title text-white">
                                            Explore Your <span>Creativity And Talent</span> With Us
                                        </h2>
                                    </div>
                                    <p class="text-white">
                                        There are many variations of passages available but the majority have suffered
                                        alteration in some form by injected humour randomised words which don't look even
                                        slightly believable. If you are going to use passage you need sure there anything
                                        embarrassing first true generator on the Internet.
                                    </p>

                                    <a href="contact.html" class="theme-btn mt-5">Learn More<i
                                            class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- enroll area end -->


        <!-- team-area -->
        <div class="team-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Our Team</span>
                            <h2 class="site-title">Meet Our <span>Team</span></h2>
                            <p>Our team is dedicated to providing the best possible service to our clients.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @forelse ($teamMembers as $member)
                        <div class="col-md-6 col-lg-3">
                            <div class="team-item wow fadeInUp" data-wow-delay=".{{ $loop->index * 0.25 }}s">
                                <div class="team-img">
                                    @if ($member->image)
                                        <img src="{{ asset('storage/' . $member->image) }}" alt="thumb">
                                    @else
                                        <img src="{{ asset('assets/img/team/default.jpg') }}" alt="thumb">
                                    @endif
                                </div>
                            </div>
                            <div class="team-social">
                                @if (isset($member->socials['facebook']))
                                    <a href="{{ $member->socials['facebook'] }}" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a>
                                @endif
                                @if (isset($member->socials['linkedin']))
                                    <a href="{{ $member->socials['linkedin'] }}" target="_blank"><i
                                            class="fab fa-linkedin-in"></i></a>
                                @endif
                                @if (isset($member->socials['youtube']))
                                    <a href="{{ $member->socials['youtube'] }}" target="_blank"><i
                                            class="fab fa-youtube"></i></a>
                                @endif
                                @if (isset($member->socials['website']))
                                    <a href="{{ $member->socials['website'] }}" target="_blank"><i
                                            class="fas fa-globe"></i></a>
                                @endif
                            </div>
                            <div class="team-content">
                                <div class="team-bio">
                                    <h5><a
                                            href="{{ route('frontend.team.show', $member->slug) }}">{{ $member->name }}</a>
                                    </h5>
                                    <span>{{ $member->position }}</span>
                                </div>
                            </div>
                            @if (isset($member->socials) && !empty($member->socials))
                                <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                            @endif
                        </div>
                    @empty
                        <div class="col-md-12">
                            <div class="text-center">
                                <p>No team members found.</p>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
        <!-- team-area end -->


        <!-- testimonial area -->
        <div class="testimonial-area ts-bg pb-80 pt-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Testimonials</span>
                            <h2 class="site-title text-white">What Our Students & Parents <span>Say</span></h2>
                            <p class="text-white">It is a long established fact that a reader will be distracted by the
                                readable content of
                                a page when looking at its layout.</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slider owl-carousel owl-theme">
                    @forelse($testimonials as $testimonial)
                        <div class="testimonial-item">
                            <div class="testimonial-rate">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-o' }}"></i>
                                @endfor
                            </div>
                            <div class="testimonial-quote">
                                <p>{{ Str::limit($testimonial->testimony, 150) }}</p>
                            </div>
                            <div class="testimonial-content">
                                <div class="testimonial-author-img">
                                    @if ($testimonial->image)
                                        <img src="{{ asset('storage/' . $testimonial->image) }}"
                                            alt="{{ $testimonial->name }}">
                                    @else
                                        <img src="{{ asset('assets/img/testimonial/default.jpg') }}"
                                            alt="{{ $testimonial->name }}">
                                    @endif
                                </div>
                                <div class="testimonial-author-info">
                                    <h4>{{ $testimonial->name }}</h4>
                                    <p>{{ $testimonial->type }}</p>
                                </div>
                            </div>
                            <span class="testimonial-quote-icon"><i class="far fa-quote-right"></i></span>
                        </div>
                    @empty
                        <div class="testimonial-item">
                            <div class="testimonial-rate">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="testimonial-quote">
                                <p>
                                    There are many variations of tend to repeat chunks some all form necessary injected for
                                    the
                                    going are humour words.
                                </p>
                            </div>
                            <div class="testimonial-content">
                                <div class="testimonial-author-img">
                                    <img src="{{ asset('assets/img/testimonial/01.jpg') }}" alt="">
                                </div>
                                <div class="testimonial-author-info">
                                    <h4>Anthony Nicoll</h4>
                                    <p>Student</p>
                                </div>
                            </div>
                            <span class="testimonial-quote-icon"><i class="far fa-quote-right"></i></span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- testimonial area end -->


        <!-- blog area -->
        <div class="blog-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Our Blog</span>
                            <h2 class="site-title">Latest News & <span>Articles</span></h2>
                            <p>It is a long established fact that a reader will be distracted by the readable content of
                                a page when looking at its layout.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($latestPosts as $post)
                        <div class="col-md-6 col-lg-4">
                            <div class="blog-item wow fadeInUp" data-wow-delay=".{{ ($loop->index % 3) * 25 + 25 }}s">
                                <div class="blog-date"><i class="fal fa-calendar-alt"></i>
                                    {{ formattedDate($post->update_at) }}</div>
                                <div class="blog-item-img">
                                    <img src="{{ asset('storage/' . $post->banner) }}" alt="{{ $post->title }}">
                                </div>
                                <div class="blog-item-info">
                                    <div class="blog-item-meta">
                                        <ul>
                                            <li><a href="#"><i class="far fa-user-circle"></i> By James Mbatia</a>
                                            </li>
                                            <li><a href="#"><i class="far fa-comments"></i> 03 Comments</a></li>
                                        </ul>
                                    </div>
                                    <h4 class="blog-title">
                                        <a href="{{ route('news.single', $post->slug) }}">{{ $post->title }}</a>
                                    </h4>
                                    <a class="theme-btn" href="{{ route('news.single', $post->slug) }}">Read More<i
                                            class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- blog area end -->


        <!-- partner area -->
        <div class="partner-area bg pt-50 pb-50">
            <div class="container">
                <div class="partner-wrapper partner-slider owl-carousel owl-theme">
                    <img src="assets/img/partner/01.png" alt="thumb">
                    <img src="assets/img/partner/02.png" alt="thumb">
                    <img src="assets/img/partner/03.png" alt="thumb">
                    <img src="assets/img/partner/04.png" alt="thumb">
                    <img src="assets/img/partner/01.png" alt="thumb">
                    <img src="assets/img/partner/02.png" alt="thumb">
                    <img src="assets/img/partner/04.png" alt="thumb">
                </div>
            </div>
        </div>
        <!-- partner area end -->

    @endsection
</div>
