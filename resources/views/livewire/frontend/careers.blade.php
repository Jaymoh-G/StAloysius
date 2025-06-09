<div>
    @section('content')

    <!-- Page Title/Header -->
    <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Careers</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="/">Home</a></li>
                    <li class="active">Careers</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

    <!-- Careers Content -->
    <div class="career-area py-120">
        <div class="container">
            <!-- Filter by Category -->
            <div class="row mb-4">
                <div class="col-md-12 mx-auto">
                    <div class="gallery-filter livewire-filter d-flex justify-content-center flex-wrap">
                        <a href="{{ route('careers') }}" wire:navigate
                           class="theme-btn btn-sm m-2 text-normal {{ empty($categoryFilter) ? 'active' : '' }}">
                            <i class="fas fa-briefcase me-1"></i> All Jobs
                        </a>
                        @foreach($categories as $category)
                        <a href="{{ route('careers.category', ['category' => $category->slug]) }}" wire:navigate
                           class="theme-btn btn-sm m-2 text-normal {{ $categoryFilter == $category->slug ? 'active' : '' }}">
                            <i class="fas fa-folder me-1"></i> {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Job Listings -->
            <div class="row">
                <div class="col-12">
                    @if($jobs->count() > 0)
                        @foreach($jobs as $job)
                        <div class="career-item mb-4">
                            <div class="career-content">
                                <h4><a href="{{ route('careers.show', $job->slug) }}">{{ $job->title }}</a></h4>
                                <p>{{ Str::limit(strip_tags($job->description), 150) }}</p>
                                <div class="career-meta">
                                    <span><i class="far fa-tag"></i> {{ $job->category->name }}</span>
                                    <span class="text-danger"><i class="far fa-calendar"></i> Deadline: {{ $job->deadline->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <div class="career-link">
                                <a href="{{ route('careers.show', $job->slug) }}"><i class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                        @endforeach

                        <div class="pagination-area">
                            {{ $jobs->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="far fa-briefcase fa-3x mb-3 text-muted"></i>
                            <h4>No job vacancies available</h4>
                            <p>Please check back later for new opportunities.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


  <style>
        /* Gallery item styling */
        .gallery-item {
            position: relative;
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .gallery-img {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
        }

        .gallery-img img {
            transition: transform 0.5s ease;
        }

        .gallery-item:hover .gallery-img img {
            transform: scale(1.05);
        }

        /* Gallery content with plus icon */
        .gallery-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0,0,0,0.2);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 5;
            pointer-events: auto;
        }

        .gallery-img:hover .gallery-content {
            opacity: 1;
            background-color: rgba(0,0,0,0.4);
        }

        .gallery-link {
            width: 45px;
            height: 45px;
            background: var(--theme-color);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transform: scale(0);
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 10;
        }

        .gallery-item:hover .gallery-link {
            transform: scale(1);
        }

        .gallery-link:hover {
            background: var(--theme-color2);
            color: #fff;
        }

        /* Gallery info overlay */
        .gallery-info {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            color: #fff;
            padding: 15px;
            opacity: 1;
            transition: all 0.3s ease;
        }

        .gallery-item:hover .gallery-info {
            padding-bottom: 20px;
        }

        .album-title {
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            transition: all 0.3s ease;
            margin: 0;
        }

        .gallery-item:hover .album-title {
            color: var(--theme-color2);
        }

        .album-count {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            gap: 5px;
            margin: 0;
            white-space: nowrap;
        }

        .album-count i {
            font-size: 12px;
            opacity: 0.8;
        }

        .btn-view-album {
            background-color: var(--theme-color);
            color: white;
            border: none;
            border-radius: 30px;
            padding: 5px 15px;
            font-size: 12px;
            font-weight: 500;
            text-transform:lowercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-view-album:hover {
            background-color: var(--theme-color2);
            color: white;
            transform: translateY(-2px);
        }

        /* Gallery filter buttons */
        .gallery-filter {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .gallery-filter .theme-btn {
            transition: all 0.3s ease;
            border-radius: 30px;
            font-size: 14px;
            padding: 8px 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            margin: 5px;
        }

        .gallery-filter .theme-btn:not(.active) {
            background-color: #fff;
            color: var(--body-text-color);
            border: 1px solid #eee;
        }

        .gallery-filter .theme-btn.active {
            background-color: var(--theme-color);
            color: #fff;
        }

        .gallery-filter .theme-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }

        .gallery-filter .theme-btn:hover {
            color: white !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .gallery-info {
                padding: 10px;
            }

            .album-title {
                font-size: 14px;
            }

            .album-count {
                font-size: 12px;
            }

            .btn-view-album {
                padding: 3px 10px;
                font-size: 10px;
            }

            .gallery-filter .theme-btn {
                font-size: 12px;
                padding: 6px 15px;
            }
        }
    </style>
    @endsection
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        const select = document.getElementById('categorySelect');
        select.addEventListener('change', function() {
            const value = this.value;
            if (value === '') {
                window.location.href = "{{ route('careers') }}";
            } else {
                window.location.href = "{{ route('careers') }}/" + value;
            }
        });
    });
</script>












