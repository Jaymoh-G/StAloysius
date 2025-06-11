<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Workload: Project Management Admin Dashboard" />
    <meta name="robots" content="index, follow" />
    <meta name="format-detection" content="telephone=no" />

    <title>St Aloysius Gonzaga Seconday School </title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('adminassets/images/favicon.png') }}" />

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Vendor CSS -->
    <link href="{{ asset('adminassets/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminassets/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminassets/vendor/nouislider/nouislider.min.css') }}" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="{{ asset('adminassets/css/style.css') }}" rel="stylesheet" />
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <!-- Main Wrapper -->
    <div id="main-wrapper">
        @include('livewire.dashboard.partials.header')

        <!-- Content Body -->
        <div class="content-body">
            <div class="container-fluid">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="copyright">
                <p>
                    &copy; 2025 Designed & Developed by
                    <a href="https://breezetech.co.ke" target="_blank" rel="noopener noreferrer">Breezetech Systems</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('adminassets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendor/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendor/owl-carousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('adminassets/js/custom.min.js') }}"></script>
    <script src="{{ asset('adminassets/js/dlabnav-init.js') }}"></script>

    <!-- Owl Carousel Init -->
    <script>
        function cardsCenter() {
            jQuery(".card-slider").owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                slideSpeed: 3000,
                paginationSpeed: 3000,
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    576: {
                        items: 2
                    },
                    800: {
                        items: 2
                    },
                    991: {
                        items: 2
                    },
                    1200: {
                        items: 3
                    },
                    1600: {
                        items: 4
                    }
                }
            });
        }

        jQuery(window).on("load", function() {
            setTimeout(cardsCenter, 1000);
        });
    </script>

    @livewireScripts
    @stack('scripts')
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        console.log("Livewire:", window.Livewire);
    </script>
    <style>
        .form-control {
            border: 1px solid #dbd9d6 !important;
        }
    </style>
</body>

</html>
