<div>
    @section('content')
    <!-- breadcrumb -->
    <div
        class="site-breadcrumb"
        style="background: url('{{ asset('storage/' . $event->banner) }}')"
    >
        <div class="container">
            <h2 class="breadcrumb-title">{{$event->name}}</h2>
            <ul class="breadcrumb-menu">
                <li><a href="index.html">Home</a></li>
                <li class="active">{{$event->name}}</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- event single area -->
    <div class="event-single-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="event-details">
                        <img src="{{ asset('storage/' . $event->featuredImage->path) }}" alt="" />

                        <div class="my-4">
                            <h3 class="mb-2">About The Event</h3>
                            <div> {!! $event->paragraph1 !!}</div>
                            <div> {!! $event->paragraph2 !!}</div>
                        </div>

                        <div class="mb-4">
 {!! $event->paragraph3 !!}

                        </div>
                        <div class="mb-4">
 {!! $event->paragraph4 !!}

                        </div>
                        <div class="row">
                                        <div class="col-md-6 mb-20">
                                            <img
                                                src="{{ isset($event->images[1]) ? asset('storage/' . $event->images[1]->path) : '' }}"
                                                alt="{{ optional($event->images[1])->alt ?? 'Image 1 for ' . $event->name }}"
                                            />
                                        </div>
                                        <div class="col-md-6 mb-20">
                                            <img
                                                src="{{ isset($event->images[2]) ? asset('storage/' . $event->images[2]->path) : '' }}"
                                                alt="{{ optional($event->images[2])->alt ?? 'Image 2 for ' . $event->name }}"
                                            />
                                        </div>
                                    </div>

                        <div class="mb-4">
                        <p class="mb-20">
                                        {!! $event->paragraph3 !!}
                                    </p>
                                    <div class="my-4">
                                        <div class="mb-3">
                                            <p>{!! $event->paragraph4 !!}</p>
                                        </div>
                                    </div>
                                    @for ($i = 1; $i <= 21; $i++) @php
                                    $paragraph = $event->{'paragraph' . $i};
                                    @endphp @if (!empty($paragraph))
                                    <div class="mb-4">{!! $paragraph !!}</div>
                                    @endif @endfor
                        </div>

                        <div class="event-map mt-5">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96708.34194156103!2d-74.03927096447748!3d40.759040329405195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4a01c8df6fb3cb8!2sSolomon%20R.%20Guggenheim%20Museum!5e0!3m2!1sen!2sbd!4v1619410634508!5m2!1sen!2s"
                                style="border: 0"
                                allowfullscreen=""
                                loading="lazy"
                            ></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget event-single-info">
                        <h4 class="widget-title">Event Information</h4>
                        <p>
                            It is a long established fact that a reader will be
                            distracted the readable content.
                        </p>
                        <div class="event-content">
                            <div class="event-content-single">
                                <h5><a href="#">Event Date</a></h5>
                                <p>
                                    <i class="far fa-calendar-alt"></i> 25 June
                                    2024
                                </p>
                            </div>
                            <div class="event-content-single">
                                <h5><a href="#">Event Time</a></h5>
                                <p>
                                    <i class="far fa-clock"></i> 08: 00 AM -
                                    04:00 PM
                                </p>
                            </div>
                            <div class="event-content-single">
                                <h5><a href="#">Event Location</a></h5>
                                <p>
                                    <i class="far fa-map-marker-alt"></i> New
                                    York, USA
                                </p>
                            </div>
                            <div class="event-content-single">
                                <h5><a href="#">Event Cost</a></h5>
                                <p><i class="far fa-usd-circle"></i> 150</p>
                            </div>

                            <a href="#" class="theme-btn mt-4"
                                >Book Now <i class="fas fa-arrow-right-long"></i
                            ></a>
                        </div>
                    </div>
                    <div class="widget event-author">
                        <h4 class="widget-title">Event Organizer</h4>
                        <div class="event-author-info">
                            <img src="assets/img/event/author.jpg" alt="" />
                            <h5>Richard M Bell</h5>
                            <p>
                                It is a long established fact that a reader will
                                be distracted by the readable content of a page
                                when looking at its layout.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- event single area end -->
    @endsection
</div>
