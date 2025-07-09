<style>
    .card.card-compact {
        padding: 0.5rem 0.5rem;
    }
    .card.card-compact .card-body {
        padding: 0.5rem 0.5rem;
    }
    .card.card-compact .card-title {
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }
    .card.card-compact h2 {
        font-size: 1.25rem;
        margin-bottom: 0;
    }
    .card.card-compact i {
        font-size: 1.2rem;
        margin-bottom: 0.25rem;
    }
    .truncate-title {
        max-width: 220px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
        vertical-align: middle;
    }
</style>

<div class="container-fluid">
    <div class="row g-4">
        @canView('blog')
        <div class="col-md-3">
            <a
                href="{{ route('dashboard.blog.index') }}"
                class="text-decoration-none"
            >
                <div class="card card-compact shadow h-100">
                    <div class="card-body text-center">
                        <i class="fa fa-blog fa-2x text-primary mb-2"></i>
                        <h6 class="card-title">
                            News Posts <span>({{ $blogCount }})</span>
                        </h6>
                    </div>
                </div>
            </a>
        </div>
        @endcanView @canView('events')
        <div class="col-md-3">
            <a
                href="{{ route('dashboard.events.index') }}"
                class="text-decoration-none"
            >
                <div class="card card-compact shadow h-100">
                    <div class="card-body text-center">
                        <i
                            class="fa fa-calendar-check fa-2x text-success mb-2"
                        ></i>
                        <h6 class="card-title">
                            Upcoming Events
                            <span>({{ $upcomingEventCount ?? 0 }})</span>
                        </h6>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a
                href="{{ route('dashboard.events.index') }}"
                class="text-decoration-none"
            >
                <div class="card card-compact shadow h-100">
                    <div class="card-body text-center">
                        <i
                            class="fa fa-calendar-times fa-2x text-secondary mb-2"
                        ></i>
                        <h6 class="card-title">
                            Past Events
                            <span>({{ $pastEventCount ?? 0 }})</span>
                        </h6>
                    </div>
                </div>
            </a>
        </div>
        @endcanView @canView('youtube')
        <div class="col-md-3">
            <a
                href="{{ route('dashboard.youtube.index') }}"
                class="text-decoration-none"
            >
                <div class="card card-compact shadow h-100">
                    <div class="card-body text-center">
                        <i class="fab fa-youtube fa-2x text-danger mb-2"></i>
                        <h6 class="card-title">
                            YouTube Videos <span>({{ $videoCount }})</span>
                        </h6>
                    </div>
                </div>
            </a>
        </div>
        @endcanView @canView('gallery')
        <div class="col-md-3">
            <a
                href="{{ route('dashboard.gallery.albums') }}"
                class="text-decoration-none"
            >
                <div class="card card-compact shadow h-100">
                    <div class="card-body text-center">
                        <i class="fa fa-images fa-2x text-info mb-2"></i>
                        <h6 class="card-title">
                            Albums <span>({{ $albumCount }})</span>
                        </h6>
                    </div>
                </div>
            </a>
        </div>
        @endcanView @canView('projects')
        <div class="col-md-3">
            <a
                href="{{ route('dashboard.projects.index') }}"
                class="text-decoration-none"
            >
                <div class="card card-compact shadow h-100">
                    <div class="card-body text-center">
                        <i
                            class="fa fa-project-diagram fa-2x text-warning mb-2"
                        ></i>
                        <h6 class="card-title">
                            Projects <span>({{ $projectCount ?? 0 }})</span>
                        </h6>
                    </div>
                </div>
            </a>
        </div>
        @endcanView @canView('static_pages')
        <div class="col-md-3">
            <a
                href="{{ route('dashboard.static-pages.index') }}"
                class="text-decoration-none"
            >
                <div class="card card-compact shadow h-100">
                    <div class="card-body text-center">
                        <i class="fa fa-book fa-2x text-primary mb-2"></i>
                        <h6 class="card-title">
                            Pages <span>({{ $pageCount ?? 0 }})</span>
                        </h6>
                    </div>
                </div>
            </a>
        </div>
        @endcanView @canView('team')
        <div class="col-md-3">
            <a
                href="{{ route('dashboard.team.index') }}"
                class="text-decoration-none"
            >
                <div class="card card-compact shadow h-100">
                    <div class="card-body text-center">
                        <i class="fa fa-users fa-2x text-info mb-2"></i>
                        <h6 class="card-title">
                            Team Members <span>({{ $teamCount }})</span>
                        </h6>
                    </div>
                </div>
            </a>
        </div>
        @endcanView @canView('departments')
        <div class="col-md-3">
            <a
                href="{{ route('dashboard.departments.index') }}"
                class="text-decoration-none"
            >
                <div class="card card-compact shadow h-100">
                    <div class="card-body text-center">
                        <i class="fa fa-building fa-2x text-warning mb-2"></i>
                        <h6 class="card-title">
                            Departments <span>({{ $departmentCount }})</span>
                        </h6>
                    </div>
                </div>
            </a>
        </div>
        @endcanView @canView('facilities')
        <div class="col-md-3">
            <a
                href="{{ route('dashboard.facilities.index') }}"
                class="text-decoration-none"
            >
                <div class="card card-compact shadow h-100">
                    <div class="card-body text-center">
                        <i class="fa fa-cogs fa-2x text-dark mb-2"></i>
                        <h6 class="card-title">
                            Facilities <span>({{ $facilityCount }})</span>
                        </h6>
                    </div>
                </div>
            </a>
        </div>
        @endcanView @canView('users')
        <div class="col-md-3">
            <a
                href="{{ route('dashboard.users.index') }}"
                class="text-decoration-none"
            >
                <div class="card card-compact shadow h-100">
                    <div class="card-body text-center">
                        <i class="fa fa-user-cog fa-2x text-primary mb-2"></i>
                        <h6 class="card-title">
                            Users <span>({{ $userCount }})</span>
                        </h6>
                    </div>
                </div>
            </a>
        </div>
        @endcanView @canView('testimonials')
        <div class="col-md-3">
            <a
                href="{{ route('dashboard.testimonials.index') }}"
                class="text-decoration-none"
            >
                <div class="card card-compact shadow h-100">
                    <div class="card-body text-center">
                        <i
                            class="fa fa-quote-left fa-2x text-secondary mb-2"
                        ></i>
                        <h6 class="card-title">
                            Testimonials <span>({{ $testimonialCount }})</span>
                        </h6>
                    </div>
                </div>
            </a>
        </div>
        @endcanView
    </div>

    <!-- Recent Items + Trends Section -->
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="row g-3">
                @canView('blog')
                <div class="col-md-6">
                    <div class="card card-compact h-100">
                        <div class="card-header bg-primary text-white">
                            Recent News
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($recentBlogs as $item)
                            <li class="list-group-item">
                                <a
                                    target="_blank"
                                    href="{{ route('news.single', $item->slug) }}"
                                    class="fw-bold"
                                    >{{ $item->title }}</a
                                ><br />
                                <small
                                    class="text-muted"
                                    >{{ $item->created_at->format('M d, Y') }}</small
                                >
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endcanView @canView('events')
                <div class="col-md-6">
                    <div class="card card-compact h-100">
                        <div class="card-header bg-success text-white">
                            Recent Events
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($recentEvents as $item)
                            <li class="list-group-item">
                                <a
                                    target="_blank"
                                    href="{{ route('event', $item->slug) }}"
                                    class="fw-bold"
                                    >{{ $item->name ?? $item->title }}</a
                                ><br />
                                <small
                                    class="text-muted"
                                    >{{ $item->start_date ? \Carbon\Carbon::parse($item->start_date)->format('M d, Y') : '' }}</small
                                >
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endcanView @canView('testimonials')
                <div class="col-md-6">
                    <div class="card card-compact h-100">
                        <div class="card-header bg-info text-white">
                            Recent Testimonials
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($recentTestimonials as $item)
                            <li class="list-group-item">
                                <a
                                    target="_blank"
                                    href="{{ route('testimonials.show', $item->slug) }}"
                                    class="fw-bold"
                                    >{{ $item->name }}</a
                                ><br />
                                <small
                                    class="text-muted"
                                    >{{ $item->created_at->format('M d, Y') }}</small
                                >
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endcanView @canView('gallery')
                <div class="col-md-6">
                    <div class="card card-compact h-100">
                        <div class="card-header bg-danger text-white">
                            Recent Albums
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($recentAlbums as $item)
                            <li class="list-group-item">
                                <a
                                    target="_blank"
                                    href="{{ route('gallery.album', $item->slug) }}"
                                    class="fw-bold truncate-title"
                                    >{{ $item->title }}</a
                                ><br />
                                <small
                                    class="text-muted"
                                    >{{ $item->created_at->format('M d, Y') }}</small
                                >
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endcanView @canView('youtube')
                <div class="col-md-6">
                    <div class="card card-compact h-100">
                        <div class="card-header bg-danger text-white">
                            Recent Videos
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($recentVideos as $item)
                            <li class="list-group-item">
                                <a
                                    target="_blank"
                                    href="{{ route('videos') }}"
                                    class="fw-bold truncate-title"
                                    >{{ $item->title }}</a
                                ><br />
                                <small
                                    class="text-muted"
                                    >{{ $item->created_at->format('M d, Y') }}</small
                                >
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endcanView @canView('projects')
                <div class="col-md-6">
                    <div class="card card-compact h-100">
                        <div class="card-header bg-warning text-white">
                            Recent Projects
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($recentProjects as $item)
                            <li class="list-group-item">
                                <a
                                    target="_blank"
                                    href="{{ route('project', $item->slug) }}"
                                    class="fw-bold truncate-title"
                                    >{{ $item->title }}</a
                                ><br />
                                <small
                                    class="text-muted"
                                    >{{ $item->created_at->format('M d, Y') }}</small
                                >
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endcanView

                <!-- 👇 Trends Section placed last here -->
                @canView('blog')
                <div class="col-md-12">
                    <div class="card card-compact h-100 mt-3">
                        <div class="card-header bg-light">
                            Trends (Last 6 Months)
                        </div>
                        <div class="card-body">
                            <canvas id="dashboardTrendsChart"></canvas>
                        </div>
                    </div>
                </div>
                @endcanView
            </div>
        </div>
        @canView('blog')
        <div class="col-md-6">@livewire('dashboard.recent-activity')</div>
        @endcanView
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxTrends = document.getElementById('dashboardTrendsChart').getContext('2d');

    new Chart(ctxTrends, {
        type: 'line',
        data: {
            labels: {!! json_encode($trends['labels']) !!},
            datasets: {!! json_encode($chartDatasets) !!}
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false
                }
            }
        }
    });
</script>
@endpush
