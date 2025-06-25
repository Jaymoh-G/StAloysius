<div>
@section('content')
  <!-- breadcrumb -->
        <div
            class="site-breadcrumb"
            style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})"
        >
            <div class="container">
                <h2 class="breadcrumb-title">Testimonials</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('testimonials') }}">Testimonials</a></li>
                    <li class="active">{{ $testimonial->name }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->
<div class="container py-5">

    
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4 shadow-sm">
                @if ($testimonial->image)
                    <img src="{{ asset('storage/' . $testimonial->image) }}" class="card-img-top"
                        alt="{{ $testimonial->name }}">
                @endif
                <div class="card-body">
                    <h3 class="card-title">{{ $testimonial->name }}</h3>
                    <span class="badge bg-primary mb-2">{{ $testimonial->type }}</span>
                    <div class="mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="fa fa-star{{ $i <= $testimonial->rating ? '' : '-o' }}"
                                style="color: #f7c948;"></span>
                        @endfor
                    </div>
                    <blockquote class="blockquote">
                        <p>{{ $testimonial->testimony }}</p>
                    </blockquote>
                    <small class="text-muted">
                        <i class="fa fa-calendar"></i> {{ $testimonial->created_at->format('F j, Y') }}
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <strong>Related Testimonials</strong>
                </div>
                <div class="card-body">
                    @forelse($relatedTestimonials as $related)
                        <div class="d-flex mb-3">
                            @if ($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}"
                                    class="me-3 rounded" style="width: 60px; height: 60px; object-fit: cover;">
                            @endif
                            <div>
                                <h6 class="mb-1">
                                    <a href="{{ route('testimonials.show', $related->slug) }}"
                                        class="text-decoration-none">
                                        {{ $related->name }}
                                    </a>
                                </h6>
                                <small class="text-muted">{{ $related->type }}</small>
                                <div>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="fa fa-star{{ $i <= $related->rating ? '' : '-o' }}"
                                            style="color: #f7c948; font-size: 12px;"></span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No related testimonials found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
</div>
