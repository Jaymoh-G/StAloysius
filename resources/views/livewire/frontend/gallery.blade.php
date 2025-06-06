<div>
    @section('content')
    <!-- breadcrumb -->

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
                    <div
                        class="gallery-filter livewire-filter d-flex justify-content-center flex-wrap"
                    >
                        <a
                            href="{{ route('gallery') }}"
                            wire:navigate
                            class="theme-btn btn-sm m-2 {{
                                empty($categoryFilter) ? 'active' : ''
                            }}"
                        >
                            <i class="fas fa-images me-1"></i> All Albums
                        </a>
                        @foreach($categories as $category)
                        <a
                            href="{{ route('gallery', ['category' => $category->slug]) }}"
                            wire:navigate
                            class="theme-btn btn-sm m-2 {{ $categoryFilter == $category->slug ? 'active' : '' }}"
                        >
                            <i class="fas fa-folder me-1"></i>
                            {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <div class="row g-4">
                @if($albums && $albums->count() > 0) @foreach($albums as $album)
                <div
                    class="col-md-4 wow fadeInUp"
                    data-wow-delay=".{{ ($loop->index % 3) * 25 + 25 }}s"
                >
                    <div class="gallery-item">
                        <div
                            class="gallery-img"
                            style="height: 250px; position: relative"
                        >
                            @if($album->cover_image)
                            <img
                                src="{{ asset('storage/' . $album->cover_image) }}"
                                alt="{{ $album->title }}"
                                class="img-fluid h-100 w-100 object-fit-cover"
                            />
                            @else
                            <div
                                class="bg-light d-flex align-items-center justify-content-center h-100"
                            >
                                <i class="far fa-images fa-3x text-muted"></i>
                            </div>
                            @endif

                            <!-- Position gallery-content only over the image area -->
                            <div
                                class="gallery-content"
                                style="
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 250px;
                                    z-index: 5;
                                "
                            >
                                <div
                                    style="
                                        width: 100%;
                                        height: 100%;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                    "
                                >
                                    <a
                                        class="popup-img gallery-link"
                                        href="{{ asset('storage/' . $album->cover_image) }}"
                                    >
                                        <i class="fal fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div
                            class="gallery-info position-relative bg-white text-dark"
                        >
                            <div
                                class="d-flex justify-content-between align-items-center w-100"
                            >
                                <div>
                                    <h5 class="album-title mb-0 text-dark">
                                        {{ Str::limit($album->title, 35) }}
                                    </h5>
                                    <p class="album-count mb-0 text-muted">
                                        <i class="far fa-images me-1"></i
                                        >{{ $album->images_count }} Photos
                                    </p>
                                </div>
                                <a
                                    href="{{ route('gallery.album', $album->slug) }}"
                                    class="btn-view-album"
                                >
                                    View Album
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach @else
                <div class="col-12 text-center">
                    <p>No albums found for this category.</p>
                </div>
                @endif
            </div>

            <!-- Pagination -->
            @if($albums->hasPages())
            <div class="pagination-area mt-5">
                <div class="row">
                    <div class="col-12 text-center mb-0">
                        <p class="text-muted mb-0">
                            Showing {{ $albums->firstItem() }} to
                            {{ $albums->lastItem() }} of
                            {{ $albums->total() }} albums
                        </p>
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
                    <hr class="divider" />
                </div>
            </div>

            <!-- Video Gallery Section -->
            <div class="gallery-area py-120">
                <div class="container">
                    <div class="section-title text-center mb-4">
                        <h6 class="subtitle">Watch Our Videos</h6>
                        <h2>Video Gallery</h2>
                    </div>
                    <div class="row g-4">
                        @forelse($featuredVideos as $video)
                        <div
                            class="col-md-4 col-lg-4 wow fadeInUp"
                            data-wow-delay=".{{ ($loop->index % 3) * 25 + 25 }}s"
                        >
                            <div class="video-item">
                                <div
                                    class="video-content"
                                    style="background-image: url({{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : 'https://img.youtube.com/vi/' . $video->video_id . '/mqdefault.jpg' }});"
                                >
                                    <div class="video-wrapper">
                                        <a
                                            class="play-btn popup-youtube"
                                            href="https://www.youtube.com/watch?v={{ $video->video_id }}"
                                        >
                                            <i class="fas fa-play"></i>
                                        </a>
                                    </div>
                                    <h5 class="video-title mt-3">
                                        {{ $video->title }}
                                    </h5>
                                    @if($video->category)
                                    <span
                                        class="badge bg-primary"
                                        >{{ $video->category->name }}</span
                                    >
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center">
                            <p>No videos available at the moment.</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('videos') }}" class="theme-btn">
                            View More Videos
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
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
            content: "";
            display: block;
            width: 70px;
            height: 3px;
            background: var(--theme-color);
            margin: 15px auto 0;
        }
        .pagination-area .pagination-wrapper {
            margin-top: -1px;
        }
        .pagination-area p.text-muted {
            margin-bottom: -10px;
            padding-bottom: 0;
        }
        .pagination-wrapper ul.pagination {
            margin-top: 0;
        }

        /* Gallery item styling */
        .gallery-item {
            position: relative;
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
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
            background-color: rgba(0, 0, 0, 0.2);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 5;
            pointer-events: auto;
        }

        .gallery-img:hover .gallery-content {
            opacity: 1;
            background-color: rgba(0, 0, 0, 0.4);
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
            text-transform: uppercase;
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
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
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
            /* Video item styling */
            .video-item {
                position: relative;
                margin-bottom: 30px;
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                background: white;
            }

            .video-item:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
            }

            .video-content {
                position: relative;
                height: 220px;
                background-size: cover;
                background-position: center;
                overflow: hidden;
            }

            .video-wrapper {
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                width: 100%; !important;
                height: 100%; !important;
                background: rgba(0, 0, 0, 0.3);     !important;
                display: flex; !important;
                align-items: center;    !important;
                justify-content: center; !important;
                transition: all 0.3s ease; !important;
            }

            .video-item:hover .video-wrapper {
                background: rgba(0, 0, 0, 0.5);
            }

            .play-btn {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.2);
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
            }

            .play-btn i {
                color: white;
                font-size: 24px;
            }

            .video-item:hover .play-btn {
                transform: scale(1.1);
                background: var(--theme-color);
            }

            .video-info {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                padding: 15px;
                background: linear-gradient(
                    to top,
                    rgba(0, 0, 0, 0.8),
                    transparent
                );
                color: white;
            }

            .video-title {
                margin-bottom: 5px;
                font-size: 16px;
                font-weight: 600;
                text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
            }

            .video-description {
                font-size: 14px;
                color: #666;
                background-color: #f8f9fa;
            }
        }
    </style>

    @endsection
</div>
<script>
    // Listen for URL change events
    window.addEventListener("urlChanged", function (event) {
        console.log("URL changed event received:", event.detail);
        if (event.detail && event.detail.url) {
            history.pushState({}, "", event.detail.url);
        }
    });

    // Add click event listeners to debug button clicks
    document.addEventListener("DOMContentLoaded", function () {
        document
            .querySelectorAll(".gallery-filter button")
            .forEach(function (button) {
                button.addEventListener("click", function () {
                    console.log("Button clicked:", this.innerText.trim());
                });
            });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        console.log(
            "Gallery page loaded with category filter:",
            "{{ $categoryFilter }}"
        );
    });
</script>
