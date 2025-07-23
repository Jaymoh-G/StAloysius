<div>
    <main class="main">
        <!-- breadcrumb -->
        <div
            class="site-breadcrumb"
            style="background: url({{ $selfsponsoredStudents && $selfsponsoredStudents->banner_image ? asset('storage/' . $selfsponsoredStudents->banner_image) : asset('assets/img/breadcrumb/01.jpg') }})"
        >
            <div class="container">
                <h2 class="breadcrumb-title">
                    {{ $selfsponsoredStudents ? $selfsponsoredStudents->title : 'Self-Sponsored Students' }}
                </h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">Self-Sponsored Students</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- health-care -->
        <div class="health-care py-120">
            <div class="container">
                <div class="health-care-content">
                    {{-- if general section exists show it  --}}
                    <div class="health-care-img">
                        @php $generalImage = $images->where('category',
                        'general')->first(); @endphp @if ($generalImage)
                        <img
                            class="img-1"
                            src="{{ asset('storage/' . $generalImage->path) }}"
                            alt=""
                        />
                        @endif
                    </div>
                    <div class="my-4">
                        <h3 class="mb-2">
                            {{ $selfsponsoredStudents ? $selfsponsoredStudents->title : '' }}
                        </h3>
                        <p>
                            {!! $selfsponsoredStudents ?
                            $selfsponsoredStudents->content : '' !!}
                        </p>
                    </div>
                    <div class="row">
                        @php $section1Images = $images->where('category',
                        'section_1')->values(); @endphp
                        <div class="col-md-6 mb-20">
                            @if ($section1Images->get(0))
                            <img
                                class="img-1"
                                src="{{ asset('storage/' . $section1Images->get(0)->path) }}"
                                alt=""
                            />
                            @endif
                        </div>
                        <div class="col-md-6 mb-20">
                            @if ($section1Images->get(1))
                            <img
                                class="img-1"
                                src="{{ asset('storage/' . $section1Images->get(1)->path) }}"
                                alt=""
                            />
                            @endif
                        </div>
                    </div>
                    <div class="my-4">
                        <h3 class="mb-2">
                            {{ $selfsponsoredStudents ? $selfsponsoredStudents->section_2_title : '' }}
                        </h3>
                        <p>
                            {!! $selfsponsoredStudents ?
                            $selfsponsoredStudents->section_2_content : '' !!}
                        </p>
                    </div>
                    <div class="row">
                        @php $section2Images = $images->where('category',
                        'section_2')->values(); @endphp
                        <div class="col-md-6 mb-20">
                            @if ($section2Images->get(0))
                            <img
                                class="img-1"
                                src="{{ asset('storage/' . $section2Images->get(0)->path) }}"
                                alt=""
                            />
                            @endif
                        </div>
                        <div class="col-md-6 mb-20">
                            @if ($section2Images->get(1))
                            <img
                                class="img-1"
                                src="{{ asset('storage/' . $section2Images->get(1)->path) }}"
                                alt=""
                            />
                            @endif
                        </div>
                    </div>
                    <div class="my-4">
                        <h3 class="mb-2">
                            {{ $selfsponsoredStudents ? $selfsponsoredStudents->section_3_title : '' }}
                        </h3>
                        <p>
                            {!! $selfsponsoredStudents ?
                            $selfsponsoredStudents->section_3_content : '' !!}
                        </p>
                    </div>
                    <div class="row">
                        @php $section3Images = $images->where('category',
                        'section_3')->values(); @endphp
                        <div class="col-md-6 mb-20">
                            @if ($section3Images->get(0))
                            <img
                                class="img-1"
                                src="{{ asset('storage/' . $section3Images->get(0)->path) }}"
                                alt=""
                            />
                            @endif
                        </div>
                        <div class="col-md-6 mb-20">
                            @if ($section3Images->get(1))
                            <img
                                class="img-1"
                                src="{{ asset('storage/' . $section3Images->get(1)->path) }}"
                                alt=""
                            />
                            @endif
                        </div>
                    </div>
                    <div class="my-4">
                        <h3 class="mb-2">
                            {{ $selfsponsoredStudents ? $selfsponsoredStudents->section_4_title : '' }}
                        </h3>
                        <p>
                            {!! $selfsponsoredStudents ?
                            $selfsponsoredStudents->section_4_content : '' !!}
                        </p>
                    </div>
                    <div class="row">
                        @php $section4Images = $images->where('category',
                        'section_4')->values(); @endphp
                        <div class="col-md-6 mb-20">
                            @if ($section4Images->get(0))
                            <img
                                class="img-1"
                                src="{{ asset('storage/' . $section4Images->get(0)->path) }}"
                                alt=""
                            />
                            @endif
                        </div>
                        <div class="col-md-6 mb-20">
                            @if ($section4Images->get(1))
                            <img
                                class="img-1"
                                src="{{ asset('storage/' . $section4Images->get(1)->path) }}"
                                alt=""
                            />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- health-care end -->
    </main>
</div>
