<div>
    @section('content')

    <main class="main">
        <!-- breadcrumb -->
        <div
            class="site-breadcrumb"
            style="background: url(assets/img/breadcrumb/01.jpg)"
        >
            <div class="container">
                <h2 class="breadcrumb-title">Upcoming Events</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('events') }}">Events</a></li>
                    <li class="active">Upcoming Events</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- event area -->
        <div class="event-area py-120">
            <div class="container">
               

                @if($upcomingEvents->isEmpty())
                <div class="text-center">
                    <p>No upcoming events scheduled at this time.</p>
                </div>
                @else
                <div class="row">
                    @foreach($upcomingEvents as $event)
                    <div class="col-lg-4 mb-4">
                        <div class="event-item">
                            <div class="event-location">
                                <span><i class="far fa-map-marker-alt"></i> {{ $event->location }}</span>
                            </div>
                            <div class="event-img">
                                @if($event->featuredImage)
                                    <img src="{{ asset('storage/' . $event->featuredImage->path) }}" alt="{{ $event->name }}">
                                @elseif($event->banner)
                                    <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->name }}">
                                @else
                                    <img src="{{ asset('assets/img/event/default.jpg') }}" alt="{{ $event->name }}">
                                @endif
                            </div>
                            <div class="event-info">
                                <div class="event-meta">
                                    <span class="event-date"><i class="far fa-calendar-alt"></i> {{ formattedDate($event->start_date) }}</span>
                                    <span class="event-time"><i class="far fa-clock"></i> {{ formattedTime($event->start_time) }} - {{ formattedTime($event->end_time) }}</span>
                                </div>
                                <h4 class="event-title">
                                    <a href="{{ route('event', $event->slug) }}">{{ $event->name }}</a>
                                </h4>
                                {{ str(strip_tags($event->content))->limit(80) }}

                                <div class="event-btn">
                                    <a href="{{ route('event', $event->slug) }}" class="theme-btn">Read More<i class="fas fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination-area">
                    <div class="row">
                        <div class="col-12">
                            <!-- Results count -->


                            {{ $upcomingEvents->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <!-- event area end -->
    </main>
    @endsection
</div>






