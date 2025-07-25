<div>

    <main class="main">
        <!-- breadcrumb -->
        <div
            class="site-breadcrumb"
            style="background: url(assets/img/breadcrumb/01.jpg)"
        >
            <div class="container">
                @if($aboutUsPage->title)
                <h2 class="breadcrumb-title">{{ $aboutUsPage->title }}</h2>
                @endif
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    @if($aboutUsPage->title)
                    <li class="active">{{ $aboutUsPage->title }}</li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- how apply -->
        <div class="how-apply pt-120 pb-80">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div
                            class="content-info wow fadeInUp"
                            data-wow-delay=".25s"
                        >
                            <div class="site-heading mb-3">
                                @if($aboutUsPage->title)
                                <h2 class="site-title">
                                    {{ $aboutUsPage->title }}
                                </h2>
                                @endif
                            </div>
                            <p class="content-text">
                                {!! $aboutUsPage->paragraph1 !!}
                            </p>

                            <p class="content-text mt-2">
                                {!! $aboutUsPage->paragraph2 !!}
                            </p>
                            <p class="content-text mt-2">
                                {!! $aboutUsPage->paragraph3 !!}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div
                            class="content-img wow fadeInRight"
                            data-wow-delay=".25s"
                        >
                            @if($aboutUsPage->images->count() > 0)
                            <img
                                src="{{ asset('storage/' . $aboutUsPage->images->first()->path) }}"
                                alt="{{ $aboutUsPage->title ?? 'About Us' }}"
                            />
                            @else
                            <img
                                src="{{ asset('assets/img/apply/01.jpg') }}"
                                alt="{{ $aboutUsPage->title ?? 'About Us' }}"
                            />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- how apply end-->

        <!-- apply details -->
        <div class="apply-details">
            <div class="container">
                <div class="details-wrapper">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="details-left">
                                {!! $aboutUsPage->paragraph4 !!}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="details-right">
                                <p class="mt-2">
                                    {!! $aboutUsPage->paragraph5 !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- apply details end -->

        <!-- feature area -->
        <div class="feature-area fa2 py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"
                                ><i class="far fa-book-open-reader"></i>
                            </span>

                            <p>{!! $aboutUsPage->paragraph6 !!}</p>
                            <p>{!! $aboutUsPage->paragraph7 !!}</p>
                            <p>{!! $aboutUsPage->paragraph8 !!}</p>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div
                            class="feature-item wow fadeInUp"
                            data-wow-delay=".25s"
                        >
                            <span class="count">01</span>
                            <div class="feature-icon">
                                <img
                                    src="assets/img/icon/scholarship.svg"
                                    alt=""
                                />
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">Human Dignity</h4>
                                <p>
                                    Upholding respect for the inherent dignity
                                    of every individual.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div
                            class="feature-item active wow fadeInDown"
                            data-wow-delay=".25s"
                        >
                            <span class="count">02</span>
                            <div class="feature-icon">
                                <img src="assets/img/icon/teacher.svg" alt="" />
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">Integrity</h4>
                                <p>
                                    Fostering accountability, transparency, and
                                    honesty in all actions.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div
                            class="feature-item wow fadeInUp"
                            data-wow-delay=".25s"
                        >
                            <span class="count">03</span>
                            <div class="feature-icon">
                                <img src="assets/img/icon/library.svg" alt="" />
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">Solidarity</h4>
                                <p>
                                    Encouraging a spirit of unity and service,
                                    being for and with others.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div
                            class="feature-item wow fadeInUp"
                            data-wow-delay=".25s"
                        >
                            <span class="count">04</span>
                            <div class="feature-icon">
                                <img src="assets/img/icon/money.svg" alt="" />
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">Affordable Price</h4>
                                <p>
                                    It is a long established fact that a reader
                                    will be distracted.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div
                            class="feature-item wow fadeInUp"
                            data-wow-delay=".25s"
                        >
                            <span class="count">05</span>
                            <div class="feature-icon">
                                <img src="assets/img/icon/money.svg" alt="" />
                            </div>
                            <div class="feature-content">
                                <h4 class="feature-title">
                                    5. Social Justice with Special Attention to
                                    Gender Equity
                                </h4>
                                <p>
                                    Advocating for fairness and equality, with a
                                    focus on addressing gender disparities.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="site-heading text-center">
                        <p>{!! $aboutUsPage->paragraph10 !!}</p>
                    </div>
                </div>
                <div class="col-lg-12 mx-auto"></div>
            </div>
        </div>
        <!-- feature area end -->

        <!-- video-area -->
        @if($featuredVideo)
        <div class="video-area">
            <div class="container">
                <div
                    class="video-content"
                    style="background-image: url({{ $featuredVideo->thumbnail ? asset('storage/' . $featuredVideo->thumbnail) : 'https://img.youtube.com/vi/' . $featuredVideo->video_id . '/maxresdefault.jpg' }});"
                >
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="video-wrapper">
                                <a
                                    class="play-btn popup-youtube"
                                    href="https://www.youtube.com/watch?v={{ $featuredVideo->video_id }}"
                                >
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- video-area end -->

        <!-- faq area -->
        <div class="faq-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">


{!! $aboutUsPage->paragraph11 !!}
                                {!! $aboutUsPage->paragraph12 !!} {!!
                                $aboutUsPage->paragraph13 !!} {!!
                                $aboutUsPage->paragraph14 !!} {!!
                                $aboutUsPage->paragraph15 !!}



                            <a href="{{ route('contact') }}" class="theme-btn mt-2"
                                >Have Any Question ?</a
                            >
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- faq area end -->
    </main>

</div>
