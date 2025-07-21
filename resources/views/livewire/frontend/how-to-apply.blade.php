<div>

        <main class="main">

            <!-- breadcrumb -->
            <div class="site-breadcrumb"
                style="background: url({{ $howToApply && $howToApply->banner_image ? asset('storage/' . $howToApply->banner_image) : 'assets/img/breadcrumb/01.jpg' }})">
                <div class="container">
                    <h2 class="breadcrumb-title">{{ $howToApply ? $howToApply->title : 'How To Apply' }}</h2>
                    <ul class="breadcrumb-menu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">{{ $howToApply ? $howToApply->title : 'How To Apply' }}</li>
                    </ul>
                </div>
            </div>

            <!-- how apply -->
            <div class="how-apply pt-120">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="content-info wow fadeInUp" data-wow-delay=".25s">
                                <div class="site-heading mb-3">
                                    <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> </span>
                                    {{-- section_1_title --}}
                                    <h2 class="site-title">
                                        {{ $howToApply ? $howToApply->title : '' }}
                                    </h2>
                                </div>
                                {{-- section_1_content --}}
                                <p class="content-text">
                                    {!! $howToApply ? $howToApply->content : '' !!}
                                </p>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="content-img wow fadeInRight" data-wow-delay=".25s">
                                @if ($howToApply && $howToApply->images()->where('category', 'general')->first())
                                            <img class="img-1"
                                                src="{{ asset('storage/' . $howToApply->images()->where('category', 'general')->first()->path) }}"
                                                alt="">
                                        @else
                                            <img src="{{ asset('assets/img/apply/01.jpg') }}" alt="">
                                        @endif

                            </div>
                        </div>
                    </div>
                    <div class="content-btn">
                            <a href="{{ route('student-application') }}" class="theme-btn">Apply Now<i class="fas fa-arrow-right-long"></i></a>
                        </div>
            </div>
                </div>

            <!-- how apply end-->
            <!-- breadcrumb end -->


            <!-- scholarship -->
            <div class="scholarship pt-120">
                <div class="container">

                    <div class="athletic-content">

                        <div class="my-4">
                            <h3 class="mb-2">{{ $howToApply ? $howToApply->section_1_title : '' }}
                            </h3>
                            <p>{{ $howToApply ? $howToApply->section_1_content : '' }}</p>
                        </div>
                        <div class="my-4">
                            <h3 class="mb-2">{{ $howToApply ? $howToApply->section_2_title : '' }}
                            </h3>
                            <p>{{ $howToApply ? $howToApply->section_2_content : '' }}</p>
                        </div>
                        <div class="row">

                            <div class="col-md-6 mb-20">
                                @if ($howToApply && $howToApply->images()->where('category', 'section_1')->first())
                                    <img class="img-1"
                                        src="{{ asset('storage/' . $howToApply->images()->where('category', 'section_1')->first()->path) }}"
                                        alt="">

                                @endif

                            </div>
                            <div class="col-md-6 mb-20">
                                @if ($howToApply && $howToApply->images()->where('category', 'section_1')->skip(1)->first())
                                    <img class="img-1"
                                        src="{{ asset('storage/' . $howToApply->images()->where('category', 'section_1')->skip(1)->first()->path) }}"
                                        alt="">

                                @endif

                            </div>
                        </div>
                        <div class="my-4">
                            <h3 class="mb-2">{{ $howToApply ? $howToApply->section_3_title : '' }}
                            </h3>
                            <p>{{ $howToApply ? $howToApply->section_3_content : '' }}</p>
                        </div>
                        <div class="my-4">
                            <h3 class="mb-2">{{ $howToApply ? $howToApply->section_4_title : '' }}
                            </h3>
                            <p>{{ $howToApply ? $howToApply->section_4_content : '' }}</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-20">
                                @if ($howToApply && $howToApply->images()->where('category', 'section_2')->first())
                                    <img class="img-1"
                                        src="{{ asset('storage/' . $howToApply->images()->where('category', 'section_2')->first()->path) }}"
                                        alt="">

                                @endif
                            </div>
                            <div class="col-md-6 mb-20">
                                @if ($howToApply && $howToApply->images()->where('category', 'section_5')->first())
                                    <img class="img-1"
                                        src="{{ asset('storage/' . $howToApply->images()->where('category', 'section_5')->first()->path) }}"
                                        alt="">

                                @endif
                            </div>
                        </div>
                        <div class="my-4">
                            <h3 class="mb-2">{{ $howToApply ? $howToApply->section_7_title : 'How To Apply' }}
                            </h3>
                            <p>{{ $howToApply ? $howToApply->section_7_content : 'How To Apply' }}</p>
                        </div>
                        <div class="my-4">
                            <h3 class="mb-2">{{ $howToApply ? $howToApply->section_8_title : 'How To Apply' }}
                            </h3>
                            <p>{{ $howToApply ? $howToApply->section_8_content : 'How To Apply' }}</p>
                        </div>

                    </div>

                </div>
            </div>
            <!-- scholarship end -->




        </main>

</div>
