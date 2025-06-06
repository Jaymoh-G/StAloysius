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
            <div class="row popup-gallery g-3">
                @if($albums && $albums->count() > 0)
                    <!-- First column -->
                    <div class="col-md-4 wow fadeInUp" data-wow-delay=".25s">
                        @foreach($albums->take(2) as $album)
                            <div class="gallery-item mb-3">
                                <div class="gallery-img" style="height: 300px;">
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
                                    <h5 class="album-title d-inline-block me-3">{{ $album->title }}</h5>
                                    <p class="album-count d-inline-block"><i class="far fa-images me-1"></i>{{ $album->images ? $album->images->count() : 0 }} Photosc</p>

                                </div>
                                <a href="{{ route('gallery.album', $album->slug) }}">
                                        <button class="theme-btn btn-sm">View Album</button>
                                    </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Second column -->
                    <div class="col-md-4 wow fadeInUp" data-wow-delay=".50s">
                        @foreach($albums->skip(2)->take(3) as $album)
                            <div class="gallery-item mb-3">
                                <div class="gallery-img" style="height: 200px;">
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
                                    <h5 class="album-title d-inline-block me-3">{{ $album->title }}</h5>
                                    <p class="album-count d-inline-block"><i class="far fa-images me-1"></i>{{ $album->images ? $album->images->count() : 0 }} Photos</p>
                                </div>
                                <a href="{{ route('gallery.album', $album->slug) }}">
                                        <button class="theme-btn btn-sm">View Album</button>
                                    </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Third column -->
                    <div class="col-md-4 wow fadeInUp" data-wow-delay=".75s">
                        @foreach($albums->skip(5)->take(2) as $album)
                            <div class="gallery-item mb-3">
                                <div class="gallery-img" style="height: {{ $loop->first ? '180px' : '320px' }};">
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
                                    <h5 class="album-title d-inline-block me-3">{{ $album->title }}</h5>
                                    <p class="album-count d-inline-block"><i class="far fa-images me-1"></i>{{ $album->images ? $album->images->count() : 0 }} Photos</p>
                                </div>
                                <a href="{{ route('gallery.album', $album->slug) }}">
                                        <button class="theme-btn btn-sm">View Album</button>
                                    </a>
                            </div>
                        @endforeach
                    </div>
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











