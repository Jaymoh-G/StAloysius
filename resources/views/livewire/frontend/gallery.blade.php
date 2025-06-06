<div>
    @section('content')
    <!-- breadcrumb -->


    <style>
        /* Inline style override to ensure our styles are applied */
        .gallery-content {
            background-color: transparent !important;
            background: none !important;
        }
        .gallery-item:hover .gallery-content {
            background-color: transparent !important;
            background: none !important;
        }
        .gallery-content::before {
            display: none !important;
        }

        /* Category filter styling */
        .gallery-filter .theme-btn {
            transition: all 0.3s ease;
            border-radius: 30px;
            font-size: 14px;
            padding: 8px 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .gallery-filter .theme-btn:not(.active) {
            background-color: #fff;
            color: var(--body-text-color);
            border: 1px solid #eee;
        }

        .gallery-filter .theme-btn:not(.active):hover {
            background-color: var(--theme-color-light);
            color: #ffffff;
            transform: translateY(-2px);
        }

        .gallery-filter .theme-btn.active {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }

        /* Section title enhancement */
        .section-title .subtitle {
            color: var(--theme-color);
            font-weight: 500;
            letter-spacing: 1px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .section-title h2 {
            font-weight: 700;
            margin-bottom: 15px;
            position: relative;
        }

        .section-title h2:after {
            content: '';
            display: block;
            width: 70px;
            height: 3px;
            background: var(--theme-color);
            margin: 15px auto 0;
        }
    </style>

    <div class="gallery-area py-120">
        <div class="container">
            <!-- Category Filter -->
            @if($categories->count() > 0)
            <div class="row mb-5">
                <div class="col-12">
                    <div class="section-title text-center mb-4">
                        <h6 class="subtitle">Browse Our Collection</h6>
                        <h2>Photo Gallery</h2>
                    </div>
                    <div class="gallery-filter livewire-filter d-flex justify-content-center flex-wrap">
                        <a href="{{ route('gallery') }}" wire:navigate
                           class="theme-btn btn-sm m-2 {{ empty($categoryFilter) ? 'active' : '' }}">
                            <i class="fas fa-images me-1"></i> All Albums
                        </a>
                        @foreach($categories as $category)
                        <a href="{{ route('gallery', ['category' => $category->slug]) }}" wire:navigate
                           class="theme-btn btn-sm m-2 {{ $categoryFilter == $category->slug ? 'active' : '' }}">
                            <i class="fas fa-folder me-1"></i> {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif



            <div class="row popup-gallery g-3 gallery-listing">
                @if($albums && $albums->count() > 0)
                    @foreach($albums as $album)
                    <div class="col-md-4 wow fadeInUp" data-wow-delay=".{{ ($loop->index % 3) * 25 + 25 }}s">
                        <div class="gallery-item mb-3">
                            <div class="gallery-img" style="height: 250px;">
                                @if($album->cover_image)
                                    <img src="{{ asset('storage/' . $album->cover_image) }}" alt="{{ $album->title }}"
                                         class="img-fluid h-100 w-100 object-fit-cover" />
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center h-100">
                                        <i class="far fa-images fa-3x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="gallery-content">
                                <a class="popup-img gallery-link" href="{{ asset('storage/' . $album->cover_image) }}">
                                    <i class="fal fa-plus"></i>
                                </a>
                            </div>
                            <div class="gallery-info">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <div>
                                        <h5 class="album-title mb-0">{{ $album->title }}</h5>
                                        <p class="album-count mb-0"><i class="far fa-images me-1"></i>{{ $album->images_count }} Photos</p>
                                    </div>
                                    <a href="{{ route('gallery.album', $album->slug) }}">
                                        <button class="theme-btn btn-sm">View Album</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p>No albums found for this category.</p>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if($albums->hasPages())
            <div class="pagination-area mt-5">
                <div class="row">
                    <div class="col-12 text-center mb-1">
                        <p class="text-muted">Showing {{ $albums->firstItem() }} to {{ $albums->lastItem() }} of {{ $albums->total() }} albums</p>
                    </div>
                    <div class="col-12">
                        <div class="pagination-wrapper">
                            {{ $albums->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
                     <!-- Divider -->
            <div class="row my-5">
                <div class="col-12">
                    <hr class="divider">
                </div>
            </div>


            <!-- Video Gallery Section -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="section-title text-center mb-4">
                        <h6 class="subtitle">Watch Our Videos</h6>
                        <h2>Video Gallery</h2>
                    </div>
                    <div class="row g-4">
                        <!-- Video Item 1 -->
                        <div class="col-md-4">
                            <div class="video-item">
                                <div class="video-content" style="background-image: url(assets/img/video/01.jpg);">
                                    <div class="video-wrapper">
                                        <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=ckHzmP1evNU">
                                            <i class="fas fa-play"></i>
                                        </a>
                                    </div>
                                    <h5 class="video-title mt-3">School Annual Day Celebration</h5>
                                </div>
                            </div>
                        </div>
                        <!-- Video Item 2 -->
                        <div class="col-md-4">
                            <div class="video-item">
                                <div class="video-content" style="background-image: url(assets/img/video/02.jpg);">
                                    <div class="video-wrapper">
                                        <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                                            <i class="fas fa-play"></i>
                                        </a>
                                    </div>
                                    <h5 class="video-title mt-3">Sports Day Highlights</h5>
                                </div>
                            </div>
                        </div>
                        <!-- Video Item 3 -->
                        <div class="col-md-4">
                            <div class="video-item">
                                <div class="video-content" style="background-image: url(assets/img/video/03.jpg);">
                                    <div class="video-wrapper">
                                        <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v=9bZkp7q19f0">
                                            <i class="fas fa-play"></i>
                                        </a>
                                    </div>
                                    <h5 class="video-title mt-3">Cultural Program</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





    </div> </div>

    <script>
        // Listen for URL change events
        window.addEventListener('urlChanged', function(event) {
            console.log('URL changed event received:', event.detail);
            if (event.detail && event.detail.url) {
                history.pushState({}, '', event.detail.url);
            }
        });

        // Add click event listeners to debug button clicks
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.gallery-filter button').forEach(function(button) {
                button.addEventListener('click', function() {
                    console.log('Button clicked:', this.innerText.trim());
                });
            });
        });
    </script>

    @endsection
</div>
















































<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Gallery page loaded with category filter:', '{{ $categoryFilter }}');
    });
</script>


