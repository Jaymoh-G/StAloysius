<div>
    @section('content')
    <main class="main">
        <div
            class="site-breadcrumb"
            style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})"
        >
            <div class="container">
                <h2 class="breadcrumb-title">Project Details</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('projects') }}">Projects</a></li>
                    <li class="active">{{ $project->title }}</li>
                </ul>
            </div>
        </div>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        @if ($project->banner)
                        <img
                            src="{{ asset('storage/' . $project->banner) }}"
                            class="card-img-top"
                            alt="{{ $project->title }}"
                        />
                        @endif
                        <div class="card-body">
                            <h1 class="card-title mb-3">
                                {{ $project->title }}
                            </h1>
                            <div class="mb-3 text-muted">
                                <i class="far fa-calendar-alt"></i>
                                {{ $project->created_at->format('F j, Y') }}
                            </div>
                            <div class="card-text mb-4">
                                {!! $project->description !!}
                            </div>
                            <!-- Add more project details here if needed -->
                            <a
                                href="{{ route('projects') }}"
                                class="btn btn-outline-primary"
                                >Back to Projects</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @endsection
</div>
