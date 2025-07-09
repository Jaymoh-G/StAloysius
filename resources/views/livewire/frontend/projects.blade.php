<div>
    @section('content')
    <main class="main">
        <div
            class="site-breadcrumb"
            style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})"
        >
            <div class="container">
                <h2 class="breadcrumb-title">Projects</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="/">Home</a></li>
                    <li class="active">Projects</li>
                </ul>
            </div>
        </div>
        <div class="blog-area py-120">
            <div class="container">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline"
                            ><i class="far fa-folder-open"></i
                        ></span>
                        <h2 class="site-title">Our <span>Projects</span></h2>
                        <p>Explore our latest projects and initiatives.</p>
                    </div>
                </div>
                <div class="row">
                    @forelse ($projects as $project)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if ($project->featured_image)
                            <img
                                src="{{ asset('storage/' . $project->featured_image) }}"
                                class="card-img-top"
                                alt="{{ $project->title }}"
                            />
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">
                                    {{ $project->title }}
                                </h5>
                                <p class="card-text">
                                    {{ Str::limit(strip_tags($project->description), 100) }}
                                </p>
                                <a
                                    href="{{ route('project', $project->slug) }}"
                                    class="btn btn-primary mt-auto"
                                    >View Details</a
                                >
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <h4>No projects found.</h4>
                        <p>Check back later for new projects.</p>
                    </div>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $projects->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </main>
    @endsection
</div>
