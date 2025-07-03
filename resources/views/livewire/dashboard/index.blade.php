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
        <div class="col-md-3">
            <a
                href="{{ route('dashboard.blog.index') }}"
                class="text-decoration-none"
            >
                <div class="card card-compact shadow h-100">
                    <div class="card-body text-center">
                        <i class="fa fa-blog fa-2x text-primary mb-2"></i>
                        <h6 class="card-title">
                            Blog Posts <span>({{ $blogCount }})</span>
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
        <div class="col-md-3">
            <a
                href="{{ route('dashboard.careers.index') }}"
                class="text-decoration-none"
            >
                <div class="card card-compact shadow h-100">
                    <div class="card-body text-center">
                        <i
                            class="fa fa-briefcase fa-2x text-secondary mb-2"
                        ></i>
                        <h6 class="card-title">
                            Careers <span>({{ $careerCount }})</span>
                        </h6>
                    </div>
                </div>
            </a>
        </div>
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
    </div>

    <!-- Recent Items Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card card-compact h-100">
                                <div class="card-header bg-primary text-white">
                                    Recent News
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach($recentBlogs as $item)
                                    <li class="list-group-item">
                                        <a target="_blank"
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
                        <div class="col-md-6">
                            <div class="card card-compact h-100">
                                <div class="card-header bg-success text-white">
                                    Recent Events
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach($recentEvents as $item)
                                    <li class="list-group-item">
                                        <a target="_blank"
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
                        <div class="col-md-6">
                            <div class="card card-compact h-100">
                                <div class="card-header bg-info text-white">
                                    Recent Testimonials
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach($recentTestimonials as $item)
                                    <li class="list-group-item">
                                        <a target="_blank"
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
                        <div class="col-md-6">
                            <div class="card card-compact h-100">
                                <div class="card-header bg-danger text-white">
                                    Recent Albums
                                </div>
                                <ul class="list-group list-group-flush">
                                    @foreach($recentAlbums as $item)
                                    <li class="list-group-item">
                                        <a target="_blank"
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
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-compact h-100">
                        <div class="card-header bg-light">
                            Trends (Last 6 Months)
                        </div>
                        <div class="card-body">
                            <canvas id="dashboardTrendsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            datasets: [
                {
                    label: 'News',
                    data: {!! json_encode($trends['blogs']) !!},
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13,110,253,0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Events',
                    data: {!! json_encode($trends['events']) !!},
                    borderColor: '#198754',
                    backgroundColor: 'rgba(25,135,84,0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Videos',
                    data: {!! json_encode($trends['videos']) !!},
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220,53,69,0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Albums',
                    data: {!! json_encode($trends['albums']) !!},
                    borderColor: '#0dcaf0',
                    backgroundColor: 'rgba(13,202,240,0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Testimonials',
                    data: {!! json_encode($trends['testimonials']) !!},
                    borderColor: '#adb5bd',
                    backgroundColor: 'rgba(173,181,189,0.1)',
                    fill: true,
                    tension: 0.4
                }
            ]
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
