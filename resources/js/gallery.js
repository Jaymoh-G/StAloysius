// Initialize when the document is ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Magnific Popup for gallery
    if (typeof jQuery !== 'undefined' && jQuery.fn.magnificPopup) {
        jQuery('.popup-gallery').magnificPopup({
            delegate: 'a.popup-img',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1]
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
            }
        });
    }

    // Initialize Isotope for masonry layout and filtering
    if (typeof Isotope !== 'undefined') {
        var grid = document.querySelector('.popup-gallery');
        if (grid) {
            // Wait for all images to load before initializing Isotope
            imagesLoaded(grid, function() {
                var iso = new Isotope(grid, {
                    itemSelector: '.gallery-item',
                    percentPosition: true,
                    masonry: {
                        columnWidth: '.gallery-sizer',
                        gutter: 20
                    }
                });

                // Filter items on button click
                var filterBtns = document.querySelector('.gallery-filter');
                if (filterBtns) {
                    filterBtns.addEventListener('click', function(event) {
                        if (event.target.tagName === 'BUTTON') {
                            var filterValue = event.target.getAttribute('data-filter');
                            iso.arrange({ filter: filterValue });

                            // Toggle active class
                            var buttons = document.querySelectorAll('.gallery-filter button');
                            buttons.forEach(function(btn) {
                                btn.classList.remove('active');
                            });
                            event.target.classList.add('active');
                        }
                    });
                }
            });
        }
    }
});
