<div>
    @section('content')
    <main class="main">
        <!-- breadcrumb -->
        <div
            class="site-breadcrumb"
            style="background: url({{ $howToApply->banner_image ? asset('storage/' . $howToApply->banner_image) : asset('assets/img/breadcrumb/01.jpg') }})"
        >
            <div class="container">
                <h2 class="breadcrumb-title">How To Apply</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">
                        {{ $howToApply->page_name ?? 'How To Apply' }}
                    </li>
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
                                <span class="site-title-tagline"
                                    ><i class="far fa-book-open-reader"></i>
                                    {{ $howToApply->title ?? 'How To Apply' }}</span
                                >
                                <h2 class="site-title">
                                    <span
                                        >{{ $howToApply->title ?? 'How To Apply' }}</span
                                    >.
                                </h2>
                            </div>
                            <p class="content-text">
                                {!! $howToApply->content !!}
                            </p>
                            <p class="content-text mt-2">
                                Sed ut perspiciatis unde omnis iste natus error
                                sit voluptatem accusantium veritatis et quasi
                                architecto beatae vitae dicta sunt explicabo.
                            </p>
                            <div class="row my-3">
                                <div class="col-md-6">
                                    <ul class="content-list">
                                        <li>
                                            <i class="fas fa-check-circle"></i
                                            >Start Online Submission
                                        </li>
                                        <li>
                                            <i class="fas fa-check-circle"></i
                                            >Submit The Form
                                        </li>
                                        <li>
                                            <i class="fas fa-check-circle"></i
                                            >Review The Submission
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="content-list">
                                        <li>
                                            <i class="fas fa-check-circle"></i
                                            >Gather Necessary Documents
                                        </li>
                                        <li>
                                            <i class="fas fa-check-circle"></i
                                            >Interviewing Process
                                        </li>
                                        <li>
                                            <i class="fas fa-check-circle"></i
                                            >Last Decision
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="content-btn">
                                <a href="#" class="theme-btn"
                                    >Apply Now<i
                                        class="fas fa-arrow-right-long"
                                    ></i
                                ></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div
                            class="content-img wow fadeInRight"
                            data-wow-delay=".25s"
                        >
                            <img
                                src="{{ $howToApply->image ? asset('storage/' . $howToApply->image) : asset('assets/img/apply/01.jpg') }}"
                                alt=""
                            />
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
                                <h3 class="mb-3">
                                    {{ $howToApply->section_1_title ?? 'Default Title' }}
                                </h3>
                                <p>
                                    {{ $howToApply->section_1_content }}
                                </p>
                                <p class="mt-2">
                                    It is a long established fact that a reader
                                    will be distracted by the readable content
                                    of a page when looking at its layout. The
                                    point of using Lorem Ipsum is that it has a
                                    more-or-less normal distribution of letters,
                                    as opposed to using Content here content
                                    here making it look like readable English.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="details-right">
                                <h3 class="mb-3">
                                    {{ $howToApply->section_2_title ?? 'Default Title' }}
                                </h3>
                                <p>
                                    {{ $howToApply->section_2_content }}
                                </p>
                                <ul class="content-list mt-2">
                                    <li>
                                        <i class="fas fa-check-circle"></i>Sed
                                        ut perspiciatis unde omnis iste natus
                                        error sit doloremque laudantium.
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle"></i>Totam
                                        rem aperiam eaque ipsa quae ab illo
                                        inventore veritatis.
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle"></i>Nemo
                                        enim ipsam voluptatem quia voluptas sit
                                        aspernatur aut odit.
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle"></i
                                        >Dolores eos qui ratione voluptatem
                                        sequi nesciunte porro quisquam est.
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle"></i
                                        >Adipisci velit sed quia non numquam
                                        eius modi tempora incidunt.
                                    </li>
                                </ul>
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
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"
                                ><i class="far fa-book-open-reader"></i>
                                Features</span
                            >
                            <h2 class="site-title">
                                {{ $howToApply->section_3_title ?? 'Default Title' }}
                            </h2>
                            <p>{{ $howToApply->section_3_content }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- feature area end -->

        <!-- video-area -->
        <div class="video-area">
            <div class="container">
                <div
                    class="video-content"
                    style="background-image: url(assets/img/video/01.jpg)"
                >
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="video-wrapper">
                                <a class="play-btn popup-youtube" href="#">
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- video-area end -->

        <!-- faq area -->
        <div class="faq-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="faq-right">
                            <div class="site-heading mb-3">
                                <span
                                    class="site-title-tagline justify-content-start"
                                    ><i class="far fa-book-open-reader"></i>
                                    Faq's</span
                                >
                                <h2 class="site-title my-3">
                                    {{ $howToApply->section_4_title ?? 'Default Title' }}
                                </h2>
                            </div>
                            <p class="mb-3">
                                {{ $howToApply->section_4_content }}
                            </p>
                            <p class="mb-4">
                                Sed ut perspiciatis unde omnis iste natus error
                                sit voluptatem accusantium doloremque
                                laudantium, totam rem aperiam, eaque ipsa quae
                                ab illo inventore veritatis et quasi architecto
                                beatae vitae dicta sunt explicabo. Nemo enim
                                ipsam voluptatem quia voluptas sit aspernatur
                                aut odit aut fugit.
                            </p>
                            <a href="#" class="theme-btn mt-2"
                                >Have Any Question ?</a
                            >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button
                                        class="accordion-button"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne"
                                        aria-expanded="true"
                                        aria-controls="collapseOne"
                                    >
                                        <span
                                            ><i class="far fa-question"></i
                                        ></span>
                                        {{ $howToApply->section_5_title ?? 'Default Title' }}
                                    </button>
                                </h2>
                                <div
                                    id="collapseOne"
                                    class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample"
                                >
                                    <div class="accordion-body">
                                        {{ $howToApply->section_5_content }}
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo"
                                        aria-expanded="false"
                                        aria-controls="collapseTwo"
                                    >
                                        <span
                                            ><i class="far fa-question"></i
                                        ></span>
                                        {{ $howToApply->section_6_title ?? 'Default Title' }}
                                    </button>
                                </h2>
                                <div
                                    id="collapseTwo"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample"
                                >
                                    <div class="accordion-body">
                                        {{ $howToApply->section_6_content }}
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree"
                                        aria-expanded="false"
                                        aria-controls="collapseThree"
                                    >
                                        <span
                                            ><i class="far fa-question"></i
                                        ></span>
                                        {{ $howToApply->section_7_title ?? 'Default Title' }}
                                    </button>
                                </h2>
                                <div
                                    id="collapseThree"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingThree"
                                    data-bs-parent="#accordionExample"
                                >
                                    <div class="accordion-body">
                                        {{ $howToApply->section_7_content }}
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour"
                                        aria-expanded="false"
                                        aria-controls="collapseFour"
                                    >
                                        <span
                                            ><i class="far fa-question"></i
                                        ></span>
                                        {{ $howToApply->section_8_title ?? 'Default Title' }}
                                    </button>
                                </h2>
                                <div
                                    id="collapseFour"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="headingFour"
                                    data-bs-parent="#accordionExample"
                                >
                                    <div class="accordion-body">
                                        {{ $howToApply->section_8_content }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- faq area end -->
    </main>
    @endsection
</div>
