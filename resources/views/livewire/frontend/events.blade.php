<div>
    @section('content')

    <main class="main">
        <!-- breadcrumb -->
        <div
            class="site-breadcrumb"
            style="background: url(assets/img/breadcrumb/01.jpg)"
        >
            <div class="container">
                <h2 class="breadcrumb-title">Events</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="/">Home</a></li>
                    <li class="active">Events</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- event area -->
        <div class="event-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div class="site-heading mb-0">
                                <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Events</span>
                                <h2 class="site-title">Upcoming <span>Events</span></h2>
                                <p class="mb-0">Join us for these exciting upcoming events and activities.</p>
                            </div>
                            @if($hasMoreUpcomingEvents)
                            <div>
                                <a href="{{ route('upcoming-events') }}" class="theme-btn">View All Upcoming Events<i class="fas fa-arrow-right-long"></i></a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                @if($upcomingEvents->isEmpty())
                <p>No upcoming events.</p>
                @else
                <div class="row">
                    @foreach($upcomingEvents as $event)
                    <div class="col-lg-4">
                        <div class="event-item">
                            <div class="event-location">
                                <span><i class="far fa-map-marker-alt"></i> {{$event->location}}</span>
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
                                    <span class="event-date"><i class="far fa-clock"></i> {{ formattedTime($event->start_time) }} - {{ formattedTime($event->end_time) }}</span>
                                </div>
                                <h4 class="event-title">
                                    <a href="{{ route('event', $event->slug) }}">{{$event->name}}</a>
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
                @endif
            </div>

            <!-- Past events area -->
            <div class="container mt-5 pt-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div class="site-heading mb-0">
                                <h2 class="site-title">Past <span>Events</span></h2>
                                <p class="mb-0">Browse through our previous events and activities.</p>
                            </div>
                            @if($hasMorePastEvents)
                            <div>
                                <a href="{{ route('past-events') }}" class="theme-btn">View All Past Events<i class="fas fa-arrow-right-long"></i></a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                @if($pastEvents->isEmpty())
                <p>No past events yet.</p>
                @else
                <div class="row">
                    @foreach($pastEvents as $event)
                    <div class="col-lg-4 mb-4">
                        <div class="event-item">
                            <div class="event-location">
                                <span><i class="far fa-map-marker-alt"></i> {{ $event->location}}</span>
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
                                    <a href="{{ route('event', $event->slug) }}">{{$event->name}}</a>
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
                @endif
            </div>
        </div>
        <!-- event area end -->
    </main>
    @endsection
</div>



