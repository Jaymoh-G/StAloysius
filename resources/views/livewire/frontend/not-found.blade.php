<div>


    <!-- breadcrumb -->
    <div
        class="site-breadcrumb"
        style="background: url('{{ asset('storage/banner/404.jpg') }}')"
    >
        <div class="container">
            <h2 class="breadcrumb-title">404 Error</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">404 Error</li>
            </ul>
        </div>
    </div>

    <!-- Error Section -->
    <section class="py-120">
        <div class="container">
            <div class="error-wrapper">

  <!-- Error Image (Optional) -->
                <div class="mb-50">
                    <img
                        src="{{ asset('assets/img/error/01.png') }}"
                        alt="404 Error"
                        style="max-width: 400px; height: auto"
                    />
                </div>
                <!-- Error Message -->
                <h2>Oops! Page Not Found</h2>
                <p class="mb-50">
                    The page you are looking for might have been removed, had
                    its name changed, or is temporarily unavailable.
                </p>



                <!-- Action Buttons -->
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('home') }}" class="theme-btn">
                        <i class="fas fa-home"></i>
                        <span>Go Home</span>
                    </a>

                    <button
                        onclick="history.back()"
                        class="theme-btn theme-btn2"
                    >
                        <i class="fas fa-arrow-left"></i>
                        <span>Go Back</span>
                    </button>
                </div>

                <!-- Helpful Links -->
                <div class="mt-60 pt-40 border-top">
                    <h4 class="mb-30">You might be looking for:</h4>
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-md-3 col-6 mb-20">
                                    <a
                                        href="{{ route('about-us') }}"
                                        class="d-block text-center p-20 bg-light rounded"
                                    >
                                        <i
                                            class="fas fa-info-circle fa-2x mb-10 text-theme-color"
                                        ></i>
                                        <h6>About Us</h6>
                                    </a>
                                </div>
                                <div class="col-md-3 col-6 mb-20">
                                    <a
                                        href="{{ route('contact') }}"
                                        class="d-block text-center p-20 bg-light rounded"
                                    >
                                        <i
                                            class="fas fa-envelope fa-2x mb-10 text-theme-color"
                                        ></i>
                                        <h6>Contact Us</h6>
                                    </a>
                                </div>

                                <div class="col-md-3 col-6 mb-20">
                                    <a
                                        href="{{ route('gallery') }}"
                                        class="d-block text-center p-20 bg-light rounded"
                                    >
                                        <i
                                            class="fas fa-images fa-2x mb-10 text-theme-color"
                                        ></i>
                                        <h6>Gallery</h6>
                                    </a>
                                </div>
                                 <div class="col-md-3 col-6 mb-20">
                                    <a
                                        href="{{ route('donations') }}"
                                        class="d-block text-center p-20 bg-light rounded"
                                    >
                                        <i
                                            class="fas fa-donate fa-2x mb-10 text-theme-color"
                                        ></i>
                                        <h6>Donate</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>


</div>
