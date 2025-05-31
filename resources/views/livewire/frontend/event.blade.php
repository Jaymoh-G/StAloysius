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
                            <h3 class="mb-2">{{$event->name}}</h3>
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

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget event-single-info">
                        <h4 class="widget-title">Event Information</h4>

                        <div class="event-content">
                            <div class="event-content-single">
                                <h5>Event Start</h5>
                                <p>
                                    <i class="far fa-clock"></i> {{formattedTime($event->start_time)}}&nbsp;&nbsp;&nbsp;
                                   <i class="far fa-calendar-alt"></i> {{formattedDate($event->start_date)}}
                                </p>
                            </div>
                            <div class="event-content-single">
                                <h5>Event End</h5>
                               <p>
                                    <i class="far fa-clock"></i> {{formattedTime($event->end_time)}} &nbsp;&nbsp;&nbsp;
                                   <i class="far fa-calendar-alt"></i> {{formattedDate($event->end_date)}}
                                </p>
                            </div>
                            <div class="event-content-single">
                                <h5>Event Location</h5>
                                <p>
                                    <i class="far fa-map-marker-alt"></i> {{$event->location}}
                                </p>
                            </div>


                            <a href="#" class="theme-btn mt-4"
                                >Support Us <i class="fas fa-arrow-right-long"></i
                            ></a>
                        </div>
                    </div>
                    <div class="widget event-author">
                        <h4 class="widget-title">Event Organizer</h4>
                        <div class="event-author-info">
                            <img src="{{ asset('storage/' . $event->organizer_photo) }}" alt="" />
                            <h5>{{$event->organizer_name}}</h5>
                            <p>
                               {{$event->organizer_description}}
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
