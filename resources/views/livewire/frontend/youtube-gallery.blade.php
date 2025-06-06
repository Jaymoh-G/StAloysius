<div>
    @section('content')
    <!-- breadcrumb -->
    <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
        <div class="container">
            <h2 class="breadcrumb-title">Video Gallery</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Video Gallery</li>
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
                        <a href="{{ route('videos') }}" wire:navigate
                           class="theme-btn btn-sm m-2 {{ empty($categoryFilter) ? 'active' : '' }}">
                            <i class="fas fa-video me-1"></i> All Videos
                        </a>
                        @foreach($categories as $category)
                        <a href="{{ route('videos.categories', ['category' => $category->slug]) }}" wire:navigate
                           class="theme-btn btn-sm m-2 {{ $categoryFilter == $category->slug ? 'active' : '' }}">
                            <i class="fas fa-folder me-1"></i> {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <div class="row g-4">
                @forelse($videos as $video)
                <div class="col-md-4 col-lg-4 wow fadeInUp" data-wow-delay=".{{ ($loop->index % 3) * 25 + 25 }}s">
                    <div class="video-item">
                        <div class="video-content" style="background-image: url({{ $video->thumbnail ? asset('storage/' . $video->thumbnail) : 'https://img.youtube.com/vi/' . $video->video_id . '/mqdefault.jpg' }});">
                            <div class="video-wrapper">
                                <a class="play-btn popup-youtube" href="https://www.youtube.com/watch?v={{ $video->video_id }}">
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                            <div class="video-info">
                                <h5 class="video-title">{{ $video->title }}</h5>
                                @if($video->category)
                                    <span class="badge bg-primary">{{ $video->category->name }}</span>
                                @endif
                            </div>
                        </div>
                        @if($video->description)
                        <div class="video-description p-3">
                            <p class="mb-0">{{ Str::limit($video->description, 100) }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info">
                        <h5>No videos found</h5>
                        <p>There are no videos available in this category.</p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($videos->hasPages())
            <div class="pagination-area mt-5">
                <div class="row">
                    <div class="col-12">
                        <div class="pagination-wrapper">
                            {{ $videos->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <style>
        /* Video item styling */
        .video-item {
            position: relative;
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            background: white;
        }

        .video-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .video-content {
            position: relative;
            height: 220px;
            background-size: cover;
            background-position: center;
            overflow: hidden;
        }

        .video-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .video-item:hover .video-wrapper {
            background: rgba(0,0,0,0.5);
        }

        .play-btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
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
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            color: white;
        }

        .video-title {
            margin-bottom: 5px;
            font-size: 16px;
            font-weight: 600;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }

        .video-description {
            font-size: 14px;
            color: #666;
            background-color: #f8f9fa;
        }
    </style>

    <script>
        // Listen for URL change events
        window.addEventListener('urlChanged', function(event) {
            console.log('URL changed event received:', event.detail);
            if (event.detail && event.detail.url) {
                history.pushState({}, '', event.detail.url);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize YouTube popup
            if (typeof jQuery !== 'undefined' && jQuery.fn.magnificPopup) {
                jQuery('.popup-youtube').magnificPopup({
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false,
                    iframe: {
                        patterns: {
                            youtube: {
                                index: 'youtube.com/',
                                id: 'v=',
                                src: 'https://www.youtube.com/embed/%id%?autoplay=1'
                            }
                        }
                    }
                });
            }
        });
    </script>
    @endsection
</div>


