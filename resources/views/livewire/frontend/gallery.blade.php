<div>
    @section('content')
    <!-- breadcrumb -->
    <div
        class="site-breadcrumb"
        style="background: url(assets/img/breadcrumb/01.jpg)"
    >
        <div class="container">
            <h2 class="breadcrumb-title">Gallery</h2>
            <ul class="breadcrumb-menu">
                <li><a href="index.html">Home</a></li>
                <li class="active">Gallery</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

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
    </style>

    <div class="gallery-area py-120">
        <div class="container">
            <!-- Category Filter -->
            @if($categories->count() > 0)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="gallery-filter">
                        <button class="active" wire:click="resetFilter">All Albums</button>
                        @foreach($categories as $category)
                        <button wire:click="filterByCategory({{ $category->id }})"
                                class="{{ $categoryFilter == $category->id ? 'active' : '' }}">
                            {{ $category->name }}
                        </button>
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
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">No albums available</h4>
                    </div>
                @endif
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
    @endsection
</div>














