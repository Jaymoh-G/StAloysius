<div>
    @section('content')
    <main class="main">
        <!-- breadcrumb -->
        <div
            class="site-breadcrumb"
            style="background: url('{{ $project->featured_image ? asset('storage/' . $project->featured_image) : asset('assets/img/breadcrumb/01.jpg') }}')"
        >
            <div class="container">
                <h2 class="breadcrumb-title">{{ $project->title }}</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('projects') }}">Projects</a></li>
                    <li class="active">{{ $project->title }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- blog single area -->
        <div class="blog-single-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-single-wrapper">
                            <div class="blog-single-content">
                                @if ($project->featured_image)
                                <div class="blog-thumb-img">
                                    <img
                                        src="{{ asset('storage/' . $project->featured_image) }}"
                                        alt="{{ $project->title }}"
                                    />
                                </div>
                                @endif
                                <div class="blog-info">
                                    <div class="blog-meta">
                                        <div class="blog-meta-left">
                                            <ul>
                                                <li>
                                                    <i class="far fa-user"></i
                                                    ><a href="#"
                                                        >Admin</a
                                                    >
                                                </li>
                                                <li>
                                                    @if ($project->department)
                                                        Department: {{ $project->department->name }}
                                                    @else
                                                        Department: General
                                                    @endif
                                                </li>
                                                <li>
                                                    <i class="far fa-calendar-alt"></i>
                                                    {{ $project->created_at->format('M d, Y') }}
                                                </li>
                                                <li>
                                                    <i class="far fa-clock"></i>
                                                    Status: <span class="badge {{ $project->status_badge }}">{{ ucfirst(str_replace('_', ' ', $project->status)) }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="blog-meta-right">
                                            <a href="#" class="share-link"
                                                ><i class="far fa-share-alt"></i
                                                >Share</a
                                            >
                                        </div>
                                    </div>
                                    <div class="blog-details">
                                        <h3 class="blog-details-title mb-20">
                                            {{ $project->title }}
                                        </h3>

                                        @if ($project->short_description)
                                        <p class="mb-20">
                                            <strong>{{ $project->short_description }}</strong>
                                        </p>
                                        @endif

                                        <p class="mb-20">
                                            {!! $project->description !!}
                                        </p>

                                        @if ($project->start_date && $project->end_date)
                                        <div class="row mb-20">
                                            <div class="col-md-6">
                                                <h5><i class="far fa-calendar-plus"></i> Start Date</h5>
                                                <p>{{ $project->start_date->format('F j, Y') }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5><i class="far fa-calendar-check"></i> End Date</h5>
                                                <p>{{ $project->end_date->format('F j, Y') }}</p>
                                            </div>
                                        </div>
                                        @endif

                                        @if ($project->duration)
                                        <div class="mb-20">
                                            <h5><i class="far fa-clock"></i> Duration</h5>
                                            <p>{{ $project->duration }}</p>
                                        </div>
                                        @endif

                                        @if ($project->technologies_used)
                                        <div class="mb-20">
                                            <h5><i class="far fa-tools"></i> Technologies Used</h5>
                                            <p>{{ $project->technologies_used }}</p>
                                        </div>
                                        @endif

                                        @if ($project->images->count() > 0)
                                        <div class="row mb-20">
                                            @foreach ($project->images->take(4) as $image)
                                            <div class="col-md-6 mb-20">
                                                <img
                                                    src="{{ asset('storage/' . $image->path) }}"
                                                    alt="{{ $image->caption ?? $project->title }}"
                                                    class="img-fluid"
                                                />
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif

                                        @for ($i = 1; $i <= 21; $i++)
                                            @php
                                                $paragraph = $project->{'paragraph' . $i};
                                            @endphp
                                            @if (!empty($paragraph))
                                            <div class="mb-20">
                                                {!! $paragraph !!}
                                            </div>
                                            @endif
                                        @endfor

                                        <hr />
                                        <div class="blog-details-tags pb-20">
                                            <h5>Project Tags :</h5>
                                            <ul>
                                                @if ($project->department)
                                                <li><a href="{{ route('department', $project->department->slug) }}">{{ $project->department->name }}</a></li>
                                                @endif
                                                <li><a href="#">{{ ucfirst($project->status) }}</a></li>
                                                @if ($project->is_featured)
                                                <li><a href="#">Featured</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="blog-author">
                                        <div class="blog-author-img">
                                            <img
                                                src="{{ asset('assets/img/blog/author.jpg') }}"
                                                alt=""
                                            />
                                        </div>
                                        <div class="author-info">
                                            <h6>Project Manager</h6>
                                            <h3 class="author-name">
                                                St. Aloysius College
                                            </h3>
                                            <p>
                                                This project represents our commitment to excellence and innovation in education.
                                                We strive to provide the best learning experiences for our students and community.
                                            </p>
                                            <div class="author-social">
                                                <a href="#"
                                                    ><i
                                                        class="fab fa-facebook-f"
                                                    ></i
                                                ></a>
                                                <a href="#"
                                                    ><i
                                                        class="fab fa-linkedin-in"
                                                    ></i
                                                ></a>
                                                <a href="#"
                                                    ><i
                                                        class="fab fa-instagram"
                                                    ></i
                                                ></a>
                                                <a href="#"
                                                    ><i
                                                        class="fab fa-whatsapp"
                                                    ></i
                                                ></a>
                                                <a href="#"
                                                    ><i
                                                        class="fab fa-youtube"
                                                    ></i
                                                ></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <aside class="sidebar">
                            <!-- search-->
                            <div class="widget search">
                                <h5 class="widget-title">Search Projects</h5>
                                <form class="search-form">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Search Projects..."
                                    />
                                    <button type="submit">
                                        <i class="far fa-search"></i>
                                    </button>
                                </form>
                            </div>
                            <!-- project status -->
                            <div class="widget category">
                                <h5 class="widget-title">Project Status</h5>
                                <div class="category-list">
                                    <a href="#"><i class="far fa-arrow-right"></i> Planning <span>({{ \App\Models\Project::where('status', 'planning')->count() }})</span></a>
                                </div>
                                <div class="category-list">
                                    <a href="#"><i class="far fa-arrow-right"></i> In Progress <span>({{ \App\Models\Project::where('status', 'in_progress')->count() }})</span></a>
                                </div>
                                <div class="category-list">
                                    <a href="#"><i class="far fa-arrow-right"></i> Completed <span>({{ \App\Models\Project::where('status', 'completed')->count() }})</span></a>
                                </div>
                                <div class="category-list">
                                    <a href="#"><i class="far fa-arrow-right"></i> On Hold <span>({{ \App\Models\Project::where('status', 'on_hold')->count() }})</span></a>
                                </div>
                                <div class="category-list">
                                    <a href="#"><i class="far fa-arrow-right"></i> Cancelled <span>({{ \App\Models\Project::where('status', 'cancelled')->count() }})</span></a>
                                </div>
                            </div>
                            <!-- recent projects -->
                            <div class="widget recent-post">
                                <h5 class="widget-title">Recent Projects</h5>
                                @foreach (\App\Models\Project::where('is_published', true)->orderBy('created_at', 'desc')->take(5)->get() as $recentProject)
                                <div class="recent-post-single">
                                    <div class="recent-post-img">
                                        @if ($recentProject->featured_image)
                                            <img
                                                src="{{ asset('storage/' . $recentProject->featured_image) }}"
                                                alt="{{ $recentProject->title }}"
                                            />
                                        @else
                                            <img
                                                src="{{ asset('assets/img/blog/01.jpg') }}"
                                                alt="{{ $recentProject->title }}"
                                            />
                                        @endif
                                    </div>
                                    <div class="recent-post-bio">
                                        <h6>
                                            <a href="{{ route('project', $recentProject->slug) }}">{{ $recentProject->title }}</a>
                                        </h6>
                                        <span
                                            ><i class="far fa-clock"></i
                                            >{{ $recentProject->created_at->format('M d, Y') }}</span
                                        >
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- social share -->
                            <div class="widget social-share">
                                <h5 class="widget-title">Follow Us</h5>
                                <div class="social-share-link">
                                    <a href="#"
                                        ><i class="fab fa-facebook-f"></i
                                    ></a>
                                    <a href="#"
                                        ><i class="fab fa-linkedin-in"></i
                                    ></a>
                                    <a href="#"
                                        ><i class="fab fa-dribbble"></i
                                    ></a>
                                    <a href="#"
                                        ><i class="fab fa-whatsapp"></i
                                    ></a>
                                    <a href="#"
                                        ><i class="fab fa-youtube"></i
                                    ></a>
                                </div>
                            </div>
                            <!-- Project Tags -->
                            <div class="widget sidebar-tag">
                                <h5 class="widget-title">Project Tags</h5>
                                <div class="tag-list">
                                    <a href="#">Education</a>
                                    <a href="#">Innovation</a>
                                    <a href="#">Technology</a>
                                    <a href="#">Research</a>
                                    <a href="#">Development</a>
                                    <a href="#">Students</a>
                                    <a href="#">Academic</a>
                                    <a href="#">Community</a>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog single area end -->
    </main>
    @endsection
</div>
