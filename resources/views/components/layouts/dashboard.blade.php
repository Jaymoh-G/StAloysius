<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <meta name="robots" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta
            name="description"
            content="Workload : Workload Project Management Admin  Bootstrap 5 Template"
        />
        <meta
            property="og:title"
            content="Workload : Workload Project Management Admin  Bootstrap 5 Template"
        />
        <meta
            property="og:description"
            content="Workload : Workload Project Management Admin  Bootstrap 5 Template"
        />
        <meta
            property="og:image"
            content="https:/workload.dexignlab.com/xhtml/social-image.png"
        />
        <meta name="format-detection" content="telephone=no" />

        <!-- PAGE TITLE HERE -->
        <title>Workload Project Management</title>

        <!-- FAVICONS ICON -->
        <link
            rel="shortcut icon"
            type="image/png"
            href="{{ asset('adminassets/images/favicon.png') }}"
        />
        <link
            href="{{
                asset(
                    'adminassets/vendor/jquery-nice-select/css/nice-select.css'
                )
            }}"
            rel="stylesheet"
        />
        <link
            href="{{
                asset('adminassets/vendor/owl-carousel/owl.carousel.css')
            }}"
        />
        <link
            rel="stylesheet"
            href="{{
                asset('adminassets/vendor/nouislider/nouislider.min.css')
            }}"
        />

        <!-- Style css -->
        <link
            href="{{ asset('adminassets/css/style.css') }}"
            rel="stylesheet"
        />
    </head>
    <body>
        <!--**********************************
        Main wrapper start
    ***********************************-->
        <div id="main-wrapper">
            @include('livewire.dashboard.partials.header')
            <!--**********************************
            Content body start
        ***********************************-->
            <div class="content-body">
                <div class="container-fluid">
                    <!-- row -->
                    {{ $slot }}
                </div>
            </div>
            <!--**********************************
            Content body end
        ***********************************-->

            <!--**********************************
            Footer start
        ***********************************-->
            <div class="footer">
                <div class="copyright">
                    <p>
                        Copyright © Designed &amp; Developed by
                        <a href="breezetech.co.ke" target="_blank"
                            >Breezetech Systems</a
                        >
                        2025
                    </p>
                </div>
            </div>
            <!--**********************************
            Footer end
        ***********************************-->

            <!--**********************************
           Support ticket button start
        ***********************************-->

            <!--**********************************
           Support ticket button end
        ***********************************-->
        </div>
        <!--**********************************
        Main wrapper end
    ***********************************-->

        <!--**********************************
        Scripts
    ***********************************-->
        <!-- Required vendors -->
        <script src="{{
                asset('adminassets/vendor/global/global.min.js')
            }}"></script>
        <script src="{{
                asset('adminassets/vendor/chart.js/Chart.bundle.min.js')
            }}"></script>
        <script src="{{
                asset(
                    'adminassets/vendor/jquery-nice-select/js/jquery.nice-select.min.js'
                )
            }}"></script>

        <!-- Apex Chart -->
        <!-- <script src="{{ asset('adminassets/vendor/apexchart/apexchart.js') }}"></script> -->
        <!-- <script src="{{ asset('adminassets/vendor/chart.js/Chart.bundle.min.js') }}"></script> -->

        <!-- Chart piety plugin files -->
        <script src="{{
                asset('adminassets/vendor/peity/jquery.peity.min.js')
            }}"></script>

        <!-- Dashboard 1 -->
        <!-- <script src="{{ asset('adminassets/js/dashboard/dashboard-1.js') }}"></script> -->
        <script src="{{
                asset('adminassets/vendor/owl-carousel/owl.carousel.js')
            }}"></script>
        <script src="{{ asset('adminassets/js/custom.min.js') }}"></script>
        <script src="{{ asset('adminassets/js/dlabnav-init.js') }}"></script>

        <script>
            function cardsCenter() {
                /*  testimonial one function by = owl.carousel.js */

                jQuery(".card-slider").owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: false,
                    //center:true,
                    slideSpeed: 3000,
                    paginationSpeed: 3000,
                    dots: false,
                    navText: ["", ""],
                    responsive: {
                        0: {
                            items: 1,
                        },
                        576: {
                            items: 2,
                        },
                        800: {
                            items: 2,
                        },
                        991: {
                            items: 2,
                        },
                        1200: {
                            items: 3,
                        },
                        1600: {
                            items: 4,
                        },
                    },
                });
            }

            jQuery(window).on("load", function () {
                setTimeout(function () {
                    cardsCenter();
                }, 1000);
            });
            console.log("here2");
        </script>
        @stack('scripts') @livewireScripts
    </body>
</html>
