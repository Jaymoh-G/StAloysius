<div>
    @section('content')
        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})">
            <div class="container">
                <h2 class="breadcrumb-title">{{ $album->title }}</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('gallery') }}">Gallery</a></li>
                    <li class="active">{{ $album->title }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- album-detail-area -->
        <div class="gallery-area py-120 album-view">
            <div class="container">
                @if($album->description)
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="album-description">
                            <h4>About This Album</h4>
                            <p>{{ $album->description }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="row popup-gallery">
                    <!-- Debug information -->
                    <div class="col-12 mb-4">
                        <div class="alert alert-info">
                            <p>Album ID: {{ $album->id }}</p>
                            <p>Images Count: {{ $images->count() }}</p>
                        </div>
                    </div>

                    @if($images->count() > 0)
                        @foreach($images as $image)
                            <div class="col-md-4 wow fadeInUp" data-wow-delay=".{{ 25 + ($loop->index % 3) * 25 }}s">
                                <div class="gallery-item">
                                    <div class="gallery-img">
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->caption }}">
                                    </div>
                                    <div class="gallery-content">
                                        <a class="popup-img gallery-link" href="{{ asset('storage/' . $image->path) }}">
                                            <i class="fal fa-plus"></i>
                                        </a>
                                    </div>
                                    @if($image->caption)
                                        <div class="gallery-info">
                                            <h5>{{ $image->caption }}</h5>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center py-5">
                            <h4 class="text-muted">No images available in this album</h4>
                            <p>Please add images to this album from the dashboard.</p>
                        </div>
                    @endif
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <a href="{{ route('gallery') }}" class="theme-btn">
                            <i class="far fa-arrow-left"></i> Back to Gallery
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- album-detail-area end -->
    @endsection
</div>

