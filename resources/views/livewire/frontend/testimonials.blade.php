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
                    <li class="active">Testimonials</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->
        <div class="container py-5">

           

            <div class="row">
                @forelse($testimonials as $testimonial)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if ($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}" class="card-img-top"
                                    alt="{{ $testimonial->name }}">
                            @endif
                            <div class="card-body">
                                <a href="{{ route('testimonials.show', $testimonial->slug) }}" class="text-decoration-none">
                                    <h5 class="card-title mb-1">{{ $testimonial->name }}</h5>
                                    <small class="text-muted">{{ $testimonial->type }}</small>
                                    <p class="card-text mt-2">{{ $testimonial->testimony }}</p>
                                    @if ($testimonial->rating)
                                        <div>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span class="fa fa-star{{ $i <= $testimonial->rating ? '' : '-o' }}"
                                                    style="color: #f7c948;"></span>
                                            @endfor
                                        </div>
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            No testimonials found.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $testimonials->links() }}
            </div>
        </div>
    @endsection
</div>
