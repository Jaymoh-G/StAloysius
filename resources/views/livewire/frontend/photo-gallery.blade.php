<div>
    @section('content')
    <!-- breadcrumb -->
    <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
        <div class="container">
            <h2 class="breadcrumb-title">Photo Gallery</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">Photo Gallery</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <div class="gallery-area py-120">
        <div class="container">
            <!-- Category Filter -->
            @if($categories->count() > 0)
            <div class="row mb-5">
                <div class="col-12">

                    <div class="gallery-filter livewire-filter d-flex justify-content-center flex-wrap">
                        <a href="{{ route('photos') }}" wire:navigate
                           class="theme-btn btn-sm m-2 {{ empty($categoryFilter) ? 'active' : '' }}">
                            <i class="fas fa-images me-1"></i> All Albums
                        </a>
                        @foreach($categories as $category)
                        <a href="{{ route('photos.categories', ['category' => $category->slug]) }}" wire:navigate
                           class="theme-btn btn-sm m-2 {{ $categoryFilter == $category->slug ? 'active' : '' }}">
                            <i class="fas fa-folder me-1"></i> {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <div class="row g-4">
                @forelse($albums as $album)
                <div class="col-md-4 wow fadeInUp" data-wow-delay=".{{ ($loop->index % 3) * 25 + 25 }}s">
                    <div class="gallery-item">
                        <div class="gallery-img" style="height: 250px; position: relative;">
                            @if($album->cover_image)
                                <img src="{{ asset('storage/' . $album->cover_image) }}" alt="{{ $album->title }}"
                                     class="img-fluid h-100 w-100 object-fit-cover" />
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center h-100">
                                    <i class="far fa-images fa-3x text-muted"></i>
                                </div>
                            @endif

                            <!-- Position gallery-content only over the image area -->
                            <div class="gallery-content" style="position: absolute; top: 0; left: 0; width: 100%; height: 250px; z-index: 5;">
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                    <a class="popup-img gallery-link" href="{{ $album->cover_image ? asset('storage/' . $album->cover_image) : '' }}">
                                        <i class="fal fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-info position-relative bg-white text-dark">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div>
                                    <h5 class="album-title mb-0 text-dark">{{ Str::limit($album->title, 35) }}</h5>
                                    <p class="album-count mb-0 text-muted"><i class="far fa-images me-1"></i>{{ $album->images_count }} Photos</p>
                                </div>
                                <a href="{{ route('gallery.album', $album->slug) }}" class="btn-view-album">
                                    View Album
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info">
                        <h5>No albums found</h5>
                        <p>There are no photo albums available in this category.</p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($albums->hasPages())
            <div class="pagination-area mt-5">
                <div class="row">
                    <div class="col-12">
                        <div class="pagination-wrapper">
                            {{ $albums->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <style>
        /* Gallery item styling */
        .gallery-item {
            position: relative;
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .gallery-img {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
        }

        .gallery-img img {
            transition: transform 0.5s ease;
        }

        .gallery-item:hover .gallery-img img {
            transform: scale(1.05);
        }

        /* Gallery content with plus icon */
        .gallery-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0,0,0,0.2);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 5;
            pointer-events: auto;
        }

        .gallery-img:hover .gallery-content {
            opacity: 1;
            background-color: rgba(0,0,0,0.4);
        }

        .gallery-link {
            width: 45px;
            height: 45px;
            background: var(--theme-color);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transform: scale(0);
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 10;
        }

        .gallery-item:hover .gallery-link {
            transform: scale(1);
        }

        .gallery-link:hover {
            background: var(--theme-color2);
            color: #fff;
        }

        /* Gallery info overlay */
        .gallery-info {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            color: #fff;
            padding: 15px;
            opacity: 1;
            transition: all 0.3s ease;
        }

        .gallery-item:hover .gallery-info {
            padding-bottom: 20px;
        }

        .album-title {
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            transition: all 0.3s ease;
            margin: 0;
        }

        .gallery-item:hover .album-title {
            color: var(--theme-color2);
        }

        .album-count {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            gap: 5px;
            margin: 0;
            white-space: nowrap;
        }

        .album-count i {
            font-size: 12px;
            opacity: 0.8;
        }

        .btn-view-album {
            background-color: var(--theme-color);
            color: white;
            border: none;
            border-radius: 30px;
            padding: 5px 15px;
            font-size: 12px;
            font-weight: 500;
            text-transform: capitalize;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-view-album:hover {
            background-color: var(--theme-color2);
            color: white;
            transform: translateY(-2px);
        }

        /* Gallery filter buttons */
        .gallery-filter {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .gallery-filter .theme-btn {
            transition: all 0.3s ease;
            border-radius: 30px;
            font-size: 14px;
            padding: 8px 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            margin: 5px;
        }

        .gallery-filter .theme-btn:not(.active) {
            background-color: #fff;
            color: var(--body-text-color);
            border: 1px solid #eee;
        }

        .gallery-filter .theme-btn.active {
            background-color: var(--theme-color);
            color: #fff;
        }

        .gallery-filter .theme-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .gallery-info {
                padding: 10px;
            }

            .album-title {
                font-size: 14px;
            }

            .album-count {
                font-size: 12px;
            }

            .btn-view-album {
                padding: 3px 10px;
                font-size: 10px;
            }

            .gallery-filter .theme-btn {
                font-size: 12px;
                padding: 6px 15px;
            }
        }
    </style>

    <script>
        // Listen for URL change events
        window.addEventListener('urlChanged', function(event) {
            if (event.detail && event.detail.url) {
                history.pushState({}, '', event.detail.url);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Magnific Popup for gallery
            if (typeof jQuery !== 'undefined' && jQuery.fn.magnificPopup) {
                jQuery('.popup-img').magnificPopup({
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    callbacks: {
                        elementParse: function(item) {
                            // Skip items with empty href
                            if (!item.el.attr('href')) {
                                return false;
                            }
                        },
                        open: function() {
                            // Fix for positioning issue
                            var magnificPopup = $.magnificPopup.instance;
                            if (magnificPopup && magnificPopup.contentContainer) {
                                setTimeout(function() {
                                    magnificPopup.updateSize();
                                }, 100);
                            }
                        }
                    }
                });
            }
        });
    </script>
    @endsection
</div>




















