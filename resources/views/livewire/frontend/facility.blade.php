<div>
    @section('content')
        <main class="main">

            <!-- breadcrumb -->
            @if ($facility->banner)
                <div class="site-breadcrumb" style="background: url({{ asset('storage/' . $facility->banner) }})">
                    <div class="container">
                        <h2 class="breadcrumb-title">{{ $facility->name }}</h2>
                        <ul class="breadcrumb-menu">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('our-facilities') }}">Facilities</a></li>
                            <li class="active">{{ $facility->name }}</li>
                        </ul>
                    </div>
                </div>
            @endif
            <!-- breadcrumb end -->


            <!-- facility single -->
            <div class="facility-single-area py-120">
                <div class="container">
                    <div class="facility-single-wrapper">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4">
                                <div class="facility-sidebar">
                                    <!-- other facilities -->
                                    @if ($otherFacilities->count() > 0)
                                        <div class="widget category">
                                            <h4 class="widget-title">Other Facilities</h4>
                                            <div class="category-list">
                                                @foreach ($otherFacilities as $otherFacility)
                                                    <a href="{{ route('facility', $otherFacility->slug) }}">
                                                        <i class="far fa-long-arrow-right"></i>{{ $otherFacility->name }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <div class="widget facility-download">
                                        <h4 class="widget-title">Download</h4>
                                        <a href="#"><i class="far fa-file-pdf"></i> Download Library eBook</a>
                                        <a href="#"><i class="far fa-file-alt"></i> Download Application</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8">
                                <div class="facility-details">
                                    <div class="facility-details-img mb-30">
                                        {{-- /featured image --}}
                                        {{-- if there is a featured image, show it --}}

                                        @if ($facility->images->count() > 0)
                                            <img src="{{ asset('storage/' . $facility->images->first()->path) }}"
                                                alt="thumb">
                                        @endif
                                    </div>
                                    <div class="facility-details">
                                     

                                        <h3 class="mb-20">{{ $facility->name }} <span class="mb-20"><a href="{{ route('department', $facility->department->slug) }}">({{ $facility->department->name}})</a></span></h3>



                                        {{-- show first 3 paragraphs -- --}}
                                        {{-- eclose the paragrphs with a div class="my-4" --}}
                                        @for ($i = 1; $i <= 4; $i++)
                                            @php
                                                $paragraph = $facility->{'paragraph' . $i};
                                            @endphp @if (!empty($paragraph))
                                                <div class="mb-4">{!! $paragraph !!}</div>
                                            @endif
                                        @endfor

                                        {{-- show the images --}}
                                        @if ($facility->images->count() > 0)
                                            <div class="row">
                                                <div class="col-md-6 mb-20">
                                                    @if ($facility->images->get(1))
                                                        <img src="{{ asset('storage/' . $facility->images->get(1)->path) }}"
                                                            alt="{{ $facility->images->get(1)->alt ?? 'Image 1 for ' . $facility->name }}" />
                                                    @endif
                                                </div>
                                                <div class="col-md-6 mb-20">
                                                    @if ($facility->images->get(2))
                                                        <img src="{{ asset('storage/' . $facility->images->get(2)->path) }}"
                                                            alt="{{ $facility->images->get(2)->alt ?? 'Image 2 for ' . $facility->name }}" />
                                                    @endif
                                                </div>
                                            </div>
                                            @for ($i = 5; $i <= 7; $i++)
                                                @php
                                                    $paragraph = $facility->{'paragraph' . $i};
                                                @endphp
                                                @if (!empty($paragraph))
                                                    <div class="mb-4">{!! $paragraph !!}</div>
                                                @endif
                                            @endfor
                                        @endif
                                        {{-- if there are more than 2 images, show the rest --}}
                                        @if ($facility->images->count() > 2)
                                            <div class="row">
                                                <div class="col-md-6 mb-20">
                                                    @if ($facility->images->get(3))
                                                        <img src="{{ asset('storage/' . $facility->images->get(3)->path) }}"
                                                            alt="{{ $facility->images->get(3)->alt ?? 'Image 3 for ' . $facility->name }}" />
                                                    @endif
                                                </div>
                                                <div class="col-md-6 mb-20">
                                                    @if ($facility->images->get(4))
                                                        <img src="{{ asset('storage/' . $facility->images->get(4)->path) }}"
                                                            alt="{{ $facility->images->get(4)->alt ?? 'Image 4 for ' . $facility->name }}" />
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- facility single end-->

        </main>
    @endsection
</div>
