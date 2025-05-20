<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>{{ $title ?? "St Aloysius Gonzaga Secondary School" }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="{{ asset('assets/img/logo/favicon.png') }}" />

        <!-- CSS -->
        <link
            rel="stylesheet"
            href="{{ asset('assets/css/bootstrap.min.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('assets/css/all-fontawesome.min.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('assets/css/animate.min.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('assets/css/magnific-popup.min.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('assets/css/owl.carousel.min.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

        @livewireStyles
    </head>

    <body>
        <!-- preloader -->
        <!-- <div class="preloader">
        <div class="loader-book">
            <div class="loader-book-page"></div>
            <div class="loader-book-page"></div>
            <div class="loader-book-page"></div>
        </div>
    </div> -->
        <!-- preloader end -->

        <!-- header area -->
        <header class="header">
            <!-- header top -->
            @include('partials.header') @include('partials.menu')
        </header>
        <!-- header area end -->

        <!-- popup search -->
        <div class="search-popup">
            <button class="close-search">
                <span class="far fa-times"></span>
            </button>
            <form action="#">
                <div class="form-group">
                    <input
                        type="search"
                        name="search-field"
                        placeholder="Search Here..."
                        required
                    />
                    <button type="submit"><i class="far fa-search"></i></button>
                </div>
            </form>
        </div>
        <!-- popup search end -->

        <main class="main">@yield('content')</main>

        <!-- footer area -->
        @include('partials.footer')
        <!-- footer area end -->

        <!-- scroll-top -->
        <a href="#" id="scroll-top"><i class="far fa-arrow-up-from-arc"></i></a>
        <!-- scroll-top end -->

        <!-- js -->
        <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{
                asset('assets/js/imagesloaded.pkgd.min.js')
            }}"></script>
        <script src="{{
                asset('assets/js/jquery.magnific-popup.min.js')
            }}"></script>
        <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.appear.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/js/counter-up.js') }}"></script>
        <script src="{{ asset('assets/js/wow.min.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
    </body>
</html>
