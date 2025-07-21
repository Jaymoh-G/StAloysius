<main class="main">
    <!-- breadcrumb -->
    <div
        class="site-breadcrumb"
        style="background: url({{ $scholarshipPage && $scholarshipPage->banner_image ? asset('storage/' . $scholarshipPage->banner_image) : 'assets/img/breadcrumb/01.jpg' }})"
    >
        <div class="container">
            <h2 class="breadcrumb-title">
                {{ $scholarshipPage ? $scholarshipPage->title : 'Scholarships' }}
            </h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">
                    {{ $scholarshipPage ? $scholarshipPage->title : 'Scholarships' }}
                </li>
            </ul>
        </div>
    </div>

    <!-- how apply -->
    <div class="how-apply pt-120">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div
                        class="content-info wow fadeInUp"
                        data-wow-delay=".25s"
                    >
                        <div class="site-heading mb-3">
                            <span class="site-title-tagline"
                                ><i class="far fa-book-open-reader"></i>
                            </span>
                            {{-- section_1_title --}}
                            <h2 class="site-title">
                                {{ $scholarshipPage ? $scholarshipPage->title : 'Scholarships' }}
                            </h2>
                        </div>
                        {{-- section_1_content --}}
                        <p class="content-text">
                            {!! $scholarshipPage ? $scholarshipPage->content :
                            'Scholarships' !!}
                        </p>
                        {{-- section_2_content --}}
                        <p class="content-text mt-2">
                            {{ $scholarshipPage ? $scholarshipPage->section_1_content : 'Scholarships' }}
                        </p>

                        <p class="content-text mt-2">
                            {{ $scholarshipPage ? $scholarshipPage->section_2_content : 'Scholarships' }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div
                        class="content-img wow fadeInRight"
                        data-wow-delay=".25s"
                    >
                        @if ($scholarshipPage &&
                        $scholarshipPage->images()->where('category',
                        'section_1')->first())
                        <img
                            class="img-1"
                            src="{{ asset('storage/' . $scholarshipPage->images()->where('category', 'section_1')->first()->path) }}"
                            alt=""
                        />
                        @else
                        <img
                            src="{{ asset('assets/img/apply/01.jpg') }}"
                            alt=""
                        />
                        @endif
                    </div>
                </div>
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
                    <h3 class="mb-2">
                        {{ $scholarshipPage ? $scholarshipPage->section_3_title : 'Scholarships' }}
                    </h3>
                    <p>
                        {{ $scholarshipPage ? $scholarshipPage->section_3_content : 'Scholarships' }}
                    </p>
                </div>
                <div class="my-4">
                    <h3 class="mb-2">
                        {{ $scholarshipPage ? $scholarshipPage->section_4_title : 'Scholarships' }}
                    </h3>
                    <p>
                        {{ $scholarshipPage ? $scholarshipPage->section_4_content : 'Scholarships' }}
                    </p>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-20">
                        @if ($scholarshipPage &&
                        $scholarshipPage->images()->where('category',
                        'section_2')->first())
                        <img
                            class="img-1"
                            src="{{ asset('storage/' . $scholarshipPage->images()->where('category', 'section_2')->first()->path) }}"
                            alt=""
                        />
                        @else
                        <img
                            class="img-1"
                            src="{{ asset('assets/img/about/01.jpg') }}"
                            alt=""
                        />
                        @endif
                    </div>
                    <div class="col-md-6 mb-20">
                        @if ($scholarshipPage &&
                        $scholarshipPage->images()->where('category',
                        'section_3')->first())
                        <img
                            class="img-1"
                            src="{{ asset('storage/' . $scholarshipPage->images()->where('category', 'section_3')->first()->path) }}"
                            alt=""
                        />
                        @else
                        <img
                            class="img-1"
                            src="{{ asset('assets/img/about/01.jpg') }}"
                            alt=""
                        />
                        @endif
                    </div>
                </div>
                <div class="my-4">
                    <h3 class="mb-2">
                        {{ $scholarshipPage ? $scholarshipPage->section_5_title : 'Scholarships' }}
                    </h3>
                    <p>
                        {{ $scholarshipPage ? $scholarshipPage->section_5_content : 'Scholarships' }}
                    </p>
                </div>
                <div class="my-4">
                    <h3 class="mb-2">
                        {{ $scholarshipPage ? $scholarshipPage->section_6_title : 'Scholarships' }}
                    </h3>
                    <p>
                        {{ $scholarshipPage ? $scholarshipPage->section_6_content : 'Scholarships' }}
                    </p>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-20">
                        @if ($scholarshipPage &&
                        $scholarshipPage->images()->where('category',
                        'section_4')->first())
                        <img
                            class="img-1"
                            src="{{ asset('storage/' . $scholarshipPage->images()->where('category', 'section_4')->first()->path) }}"
                            alt=""
                        />
                        @else
                        <img
                            class="img-1"
                            src="{{ asset('assets/img/about/01.jpg') }}"
                            alt=""
                        />
                        @endif
                    </div>
                    <div class="col-md-6 mb-20">
                        @if ($scholarshipPage &&
                        $scholarshipPage->images()->where('category',
                        'section_5')->first())
                        <img
                            class="img-1"
                            src="{{ asset('storage/' . $scholarshipPage->images()->where('category', 'section_5')->first()->path) }}"
                            alt=""
                        />
                        @else
                        <img
                            class="img-1"
                            src="{{ asset('assets/img/about/01.jpg') }}"
                            alt=""
                        />
                        @endif
                    </div>
                </div>
                <div class="my-4">
                    <h3 class="mb-2">
                        {{ $scholarshipPage ? $scholarshipPage->section_7_title : 'Scholarships' }}
                    </h3>
                    <p>
                        {{ $scholarshipPage ? $scholarshipPage->section_7_content : 'Scholarships' }}
                    </p>
                </div>
                <div class="my-4">
                    <h3 class="mb-2">
                        {{ $scholarshipPage ? $scholarshipPage->section_8_title : 'Scholarships' }}
                    </h3>
                    <p>
                        {{ $scholarshipPage ? $scholarshipPage->section_8_content : 'Scholarships' }}
                    </p>
                </div>
                <div class="content-btn">
                    <a href="{{ route('student-application') }}" class="theme-btn"
                        >Apply Now<i class="fas fa-arrow-right-long"></i
                    ></a>
                </div>
            </div>
        </div>
    </div>
    <!-- scholarship end -->
</main>
