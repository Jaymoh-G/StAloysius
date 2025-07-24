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
                        @if ($selfsponsoredStudents &&
                        $selfsponsoredStudents->images()->where('category',
                        'general')->first())
                        <img
                            class="img-1"
                            src="{{ asset('storage/' . $selfsponsoredStudents->images()->where('category', 'general')->first()->path) }}"
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
                        <div class="col-md-6 mb-20">
                            @if ($selfsponsoredStudents &&
                            $selfsponsoredStudents->images()->where('category',
                            'section_1')->first())
                            <img
                                class="img-1"
                                src="{{ asset('storage/' . $selfsponsoredStudents->images()->where('category', 'section_1')->first()->path) }}"
                                alt=""
                            />
                            @endif
                        </div>
                        <div class="col-md-6 mb-20">
                            @if ($selfsponsoredStudents &&
                            $selfsponsoredStudents->images()->where('category',
                            'section_1')->skip(1)->first())
                            <img
                                class="img-1"
                                src="{{ asset('storage/' . $selfsponsoredStudents->images()->where('category', 'section_1')->skip(1)->first()->path) }}"
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
                    <div class="col-md-6 mb-20">
                        @if ($selfsponsoredStudents &&
                        $selfsponsoredStudents->images()->where('category',
                        'section_2')->first())
                        <img
                            class="img-1"
                            src="{{ asset('storage/' . $selfsponsoredStudents->images()->where('category', 'section_2')->first()->path) }}"
                            alt=""
                        />
                        @endif
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
                    <div class="col-md-6 mb-20">
                        @if ($selfsponsoredStudents &&
                        $selfsponsoredStudents->images()->where('category',
                        'section_3')->first())
                        <img
                            class="img-1"
                            src="{{ asset('storage/' . $selfsponsoredStudents->images()->where('category', 'section_3')->first()->path) }}"
                            alt=""
                        />
                        @endif
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
                    <div class="col-md-6 mb-20">
                        @if ($selfsponsoredStudents &&
                        $selfsponsoredStudents->images()->where('category',
                        'section_4')->first())
                        <img
                            class="img-1"
                            src="{{ asset('storage/' . $selfsponsoredStudents->images()->where('category', 'section_4')->first()->path) }}"
                            alt=""
                        />
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- health-care end -->
    </main>
</div>
