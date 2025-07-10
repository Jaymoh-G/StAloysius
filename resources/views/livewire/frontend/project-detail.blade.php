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
                                @if ($project->featuredImage)
                                <div class="blog-thumb-img">
                                    <img
                                        src="{{ asset('storage/' . $project->featuredImage->path) }}"
                                        alt="{{ $project->title }}"
                                    />
                                </div>
                                @endif
                                <h3 class="blog-details-title mb-20">
                                    {{ $project->title }}
                                </h3>
                                <div class="blog-info">
                                    <div class="blog-meta">
                                        <div class="blog-meta-left">
                                            <ul>
                                                <li>
                                                    @if ($project->department)

                                                    <i class="far fa-tag"></i>
                                                    {{ $project->department->name }}
                                                    @else Department: General
                                                    @endif
                                                </li>
                                                <li>
                                                    <i
                                                        class="far fa-calendar-alt"
                                                    ></i>
                                                    {{ $project->created_at->format('M d, Y') }}
                                                </li>
                                                <li>
                                                    <i class="far fa-clock"></i>
                                                    Status:
                                                    <span
                                                        class="badge {{ $project->status_badge }}"
                                                        >{{ ucfirst(str_replace('_', ' ', $project->status)) }}</span
                                                    >
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="blog-meta-right">
                                            <div class="dropdown">
                                                <a
                                                    href="#"
                                                    class="share-link dropdown-toggle"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false"
                                                >
                                                    <i
                                                        class="far fa-share-alt"
                                                    ></i
                                                    >Share
                                                </a>
                                                <ul
                                                    class="dropdown-menu dropdown-menu-end"
                                                >
                                                    <li>
                                                        <a
                                                            class="dropdown-item"
                                                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}&quote={{ urlencode($project->title) }}"
                                                            target="_blank"
                                                        >
                                                            <i
                                                                class="fab fa-facebook-f text-primary me-2"
                                                            ></i
                                                            >Facebook
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a
                                                            class="dropdown-item"
                                                            href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($project->title) }}&hashtags=StAloysius,Projects"
                                                            target="_blank"
                                                        >
                                                            <i
                                                                class="fab fa-twitter text-info me-2"
                                                            ></i
                                                            >Twitter
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a
                                                            class="dropdown-item"
                                                            href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                                            target="_blank"
                                                        >
                                                            <i
                                                                class="fab fa-linkedin-in text-primary me-2"
                                                            ></i
                                                            >LinkedIn
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a
                                                            class="dropdown-item"
                                                            href="https://wa.me/?text={{ urlencode($project->title . ' - ' . request()->url()) }}"
                                                            target="_blank"
                                                        >
                                                            <i
                                                                class="fab fa-whatsapp text-success me-2"
                                                            ></i
                                                            >WhatsApp
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a
                                                            class="dropdown-item"
                                                            href="mailto:?subject={{ urlencode($project->title) }}&body={{ urlencode('Check out this project: ' . request()->url()) }}"
                                                        >
                                                            <i
                                                                class="fas fa-envelope text-secondary me-2"
                                                            ></i
                                                            >Email
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <hr
                                                            class="dropdown-divider"
                                                        />
                                                    </li>
                                                    <li>
                                                        <a
                                                            class="dropdown-item"
                                                            href="#"
                                                            onclick="copyToClipboard('{{ request()->url() }}'); return false;"
                                                        >
                                                            <i
                                                                class="fas fa-link text-dark me-2"
                                                            ></i
                                                            >Copy Link
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blog-details">
                                        @if ($project->short_description)
                                        <p class="mb-20">
                                            <strong
                                                >{{ $project->short_description }}</strong
                                            >
                                        </p>
                                        @endif @if ($project->start_date &&
                                        $project->end_date)
                                        <div class="row mb-20">
                                            <div class="col-md-4">
                                                <h5>
                                                    <i
                                                        class="far fa-calendar-plus"
                                                    ></i>
                                                    Start Date
                                                </h5>
                                                <p>
                                                    {{ $project->start_date->format('F j, Y') }}
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <h5>
                                                    <i
                                                        class="far fa-calendar-check"
                                                    ></i>
                                                    End Date
                                                </h5>
                                                <p>
                                                    {{ $project->end_date->format('F j, Y') }}
                                                </p>
                                            </div>
                                            @if ($project->duration)
                                            <div class="col-md-4">
                                                <h5>
                                                    <i class="far fa-clock"></i>
                                                    Duration
                                                </h5>
                                                <p>{{ $project->duration }}</p>
                                            </div>
                                            @endif
                                        </div>
                                        @endif

                                        <p class="mb-20">
                                            {!! $project->description !!}
                                        </p>

                                        <!-- First 3 paragraphs -->
                                        @for ($i = 1; $i <= 3; $i++) @php
                                        $paragraph = $project->{'paragraph' .
                                        $i}; @endphp @if (!empty($paragraph))
                                        <div class="mb-20">
                                            {!! $paragraph !!}
                                        </div>
                                        @endif @endfor

                                        <!-- First 2 images -->
                                        @if ($project->images->count() > 0)
                                        <div class="row mb-20">
                                            @foreach ($project->images->take(2)
                                            as $image)
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

                                        <!-- Next 4 paragraphs (paragraphs 4-7) -->
                                        @for ($i = 4; $i <= 7; $i++) @php
                                        $paragraph = $project->{'paragraph' .
                                        $i}; @endphp @if (!empty($paragraph))
                                        <div class="mb-20">
                                            {!! $paragraph !!}
                                        </div>
                                        @endif @endfor

                                        <!-- Next 2 images (images 3-4) -->
                                        @if ($project->images->count() > 2)
                                        <div class="row mb-20">
                                            @foreach($project->images->skip(2)->take(2)
                                            as $image)
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

                                        <!-- Remaining paragraphs (paragraphs 8-21) -->
                                        @for ($i = 8; $i <= 21; $i++) @php
                                        $paragraph = $project->{'paragraph' .
                                        $i}; @endphp @if (!empty($paragraph))
                                        <div class="mb-20">
                                            {!! $paragraph !!}
                                        </div>
                                        @endif @endfor

                                        <!-- Remaining images (images 5+) -->
                                        @if ($project->images->count() > 4)
                                        <div class="row mb-20">
                                            @foreach ($project->images->skip(4)
                                            as $image)
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

                                        <hr />
                                        <div class="blog-details-tags pb-20">
                                            <h5>Project Department :</h5>
                                            <ul>
                                                @if ($project->department)
                                                <li>
                                                    <a
                                                        href="{{ route('department', $project->department->slug) }}"
                                                        >{{ $project->department->name }}</a
                                                    >
                                                </li>
                                                @endif
                                                <h5>Project Status :</h5>
                                                <li>
                                                    <a
                                                        href="#"
                                                        >{{ ucfirst($project->status) }}</a
                                                    >
                                                </li>
                                                @if ($project->is_featured)
                                                <li>
                                                    <a href="#">Featured</a>
                                                </li>
                                                @endif
                                            </ul>
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

                            <!-- recent projects -->
                            <div class="widget recent-post">
                                <h5 class="widget-title">Recent Projects</h5>
                                @foreach(\App\Models\Project::orderBy('created_at','desc')->take(5)->get()
                                as $recentProject)
                                <div class="recent-post-single">
                                    <div class="recent-post-img">
                                        @if ($recentProject->featuredImage)
                                        <img
                                            src="{{ asset('storage/' . $recentProject->featuredImage->path) }}"
                                            alt="{{ $recentProject->title }}"
                                        />
                                        @else
                                        <img
                                            src="{{
                                                asset('assets/img/blog/01.jpg')
                                            }}"
                                            alt="{{ $recentProject->title }}"
                                        />
                                        @endif
                                    </div>
                                    <div class="recent-post-bio">
                                        <h6>
                                            <a
                                                href="{{ route('project', $recentProject->slug) }}"
                                                >{{ $recentProject->title }}</a
                                            >
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
                                    <a href=""
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
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog single area end -->
    </main>
    @endsection

    <script>
        function copyToClipboard(text) {
            // Create a temporary input element
            const tempInput = document.createElement("input");
            tempInput.value = text;
            document.body.appendChild(tempInput);

            // Select and copy the text
            tempInput.select();
            tempInput.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand("copy");

            // Remove the temporary input
            document.body.removeChild(tempInput);

            // Show success message
            const button = event.target.closest("button");
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-check"></i> Copied!';
            button.classList.remove("btn-dark");
            button.classList.add("btn-success");

            // Reset button after 2 seconds
            setTimeout(() => {
                button.innerHTML = originalText;
                button.classList.remove("btn-success");
                button.classList.add("btn-dark");
            }, 2000);
        }
    </script>
</div>
