// Add this to your existing JS files or include it in your layout
document.addEventListener('DOMContentLoaded', function() {
    // Check if we have a Livewire filter
    if (document.querySelector('.livewire-filter')) {
        // Don't initialize Isotope on Livewire filters
        return;
    }

    // Initialize isotope if the library is available
    if (typeof Isotope !== 'undefined') {
        var grid = document.querySelector('.gallery-items');
        var iso = new Isotope(grid, {
            itemSelector: '.gallery-item',
            layoutMode: 'fitRows'
        });

        // Filter items on button click
        document.querySelector('.gallery-filter').addEventListener('click', function(event) {
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

