<div>

    <main class="main">
        <!-- breadcrumb -->
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
        <!-- breadcrumb end -->

        <!-- blog area -->
        <div class="blog-area py-120">
            <div class="container">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline"
                            ><i class="far fa-folder-open"></i
                        ></span>
                        <h2 class="site-title">Our <span>Projects</span></h2>
                        <p>
                            Explore our latest projects and initiatives that
                            showcase our commitment to excellence and
                            innovation.
                        </p>
                    </div>
                </div>
                <div class="row">
                    @forelse ($projects as $project)
                    <div class="col-md-6 col-lg-4">
                        <div
                            class="blog-item wow fadeInUp"
                            data-wow-delay=".25s"
                        >

                            <div class="blog-item-img">
                                @if ($project->featuredImage)
                                <img
                                    src="{{ asset('storage/' . $project->featuredImage->path) }}"
                                    alt="{{ $project->title }}"
                                />
                                @else
                                <img
                                    src="{{ asset('assets/img/blog/01.jpg') }}"
                                    alt="{{ $project->title }}"
                                />
                                @endif
                            </div>
                            <div class="blog-item-info">
                                <div class="blog-item-meta">
                                    <ul>
                                        <li>
                                            @if ($project->status)
                                              <i class="far fa-flag"></i>
                                            <span
                                                class="badge {{ $project->status_badge ?? 'bg-secondary text-white' }}"
                                                style="
                                                    font-size: 0.75rem;
                                                    padding: 0.25rem 0.5rem;
                                                "
                                            >

                                                {{ $project->status_text ?? 'Unknown' }}
                                            </span>
                                            @endif
                                        </li>
                                        <li>
                                            @if ($project->department)
                                            <a
                                                href="{{ route('department', $project->department->slug) }}"
                                            >
                                                <i class="far fa-tag"></i>
                                                {{ $project->department->name }}
                                            </a>
                                            @else
                                            <a href="#"
                                                ><i class="far fa-tag"></i>
                                                General</a
                                            >
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                                <h4 class="{{ $project->title }}">
                                    <a
                                        href="{{ route('project', $project->slug) }}"
                                        >{{ Str::limit(strip_tags($project->description), 60) }}</a
                                    >
                                </h4>
                                <a
                                    class="theme-btn"
                                    href="{{ route('project', $project->slug) }}"
                                    >View Project<i
                                        class="fas fa-arrow-right-long"
                                    ></i
                                ></a>
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

                {{ $projects->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
        <!-- blog area end -->
    </main>
    
</div>
