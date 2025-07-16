<div>

        <main class="main">
            <!-- breadcrumb -->
            <div class="site-breadcrumb"
                style="background: url({{ $feePayingStudents && $feePayingStudents->banner_image ? asset('storage/' . $feePayingStudents->banner_image) : asset('assets/img/breadcrumb/01.jpg') }})">
                <div class="container">
                    <h2 class="breadcrumb-title">
                        {{ $feePayingStudents ? $feePayingStudents->title : 'Fee Paying Students' }}
                    </h2>
                    <ul class="breadcrumb-menu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">Fee Paying Students</li>
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
                            @if ($feePayingStudents && $feePayingStudents->images()->where('category', 'general')->first())
                                <img class="img-1"
                                    src="{{ asset('storage/' . $feePayingStudents->images()->where('category', 'general')->first()->path) }}"
                                    alt="">

                            @endif

                        </div>
                        <div class="my-4">
                            <h3 class="mb-2">{{ $feePayingStudents ? $feePayingStudents->title : '' }}
                            </h3>
                            <p>{!! $feePayingStudents ? $feePayingStudents->content : '' !!}</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-20">
                                @if ($feePayingStudents && $feePayingStudents->images()->where('category', 'section_1')->first())
                                    <img class="img-1"
                                        src="{{ asset('storage/' . $feePayingStudents->images()->where('category', 'section_1')->first()->path) }}"
                                        alt="">

                                @endif
                            </div>
                            <div class="col-md-6 mb-20">
                                @if ($feePayingStudents && $feePayingStudents->images()->where('category', 'section_1')->skip(1)->first())
                                    <img class="img-1"
                                        src="{{ asset('storage/' . $feePayingStudents->images()->where('category', 'section_1')->skip(1)->first()->path) }}"
                                        alt="">

                             @endif
                            </div>
                        </div>
                        <div class="my-4">
                            <h3 class="mb-2">
                                {{ $feePayingStudents ? $feePayingStudents->section_2_title : '' }}
                            </h3>
                            <p>{!! $feePayingStudents ? $feePayingStudents->section_2_content : '' !!}</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-20">
                                @if ($feePayingStudents && $feePayingStudents->images()->where('category', 'section_2')->first())
                                    <img class="img-1"
                                        src="{{ asset('storage/' . $feePayingStudents->images()->where('category', 'section_2')->first()->path) }}"
                                        alt="">

                                @endif
                            </div>
                            <div class="col-md-6 mb-20">
                                @if ($feePayingStudents && $feePayingStudents->images()->where('category', 'section_2')->skip(1)->first())
                                    <img class="img-1"
                                        src="{{ asset('storage/' . $feePayingStudents->images()->where('category', 'section_2')->skip(1)->first()->path) }}"
                                        alt="">

                                @endif
                            </div>
                        </div>
                        <div class="my-4">
                            <h3 class="mb-2">
                                {{ $feePayingStudents ? $feePayingStudents->section_3_title : '' }}
                            </h3>
                            <p>{!! $feePayingStudents ? $feePayingStudents->section_3_content : '' !!}</p>

                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-20">
                                @if ($feePayingStudents && $feePayingStudents->images()->where('category', 'section_3')->first())
                                    <img class="img-1"
                                        src="{{ asset('storage/' . $feePayingStudents->images()->where('category', 'section_3')->first()->path) }}"
                                        alt="">

                                @endif
                            </div>
                            <div class="col-md-6 mb-20">
                                @if ($feePayingStudents && $feePayingStudents->images()->where('category', 'section_3')->skip(1)->first())
                                    <img class="img-1"
                                        src="{{ asset('storage/' . $feePayingStudents->images()->where('category', 'section_3')->skip(1)->first()->path) }}"

                                @endif
                            </div>
                        </div>
                        <div class="my-4">
                            <h3 class="mb-2">
                                {{ $feePayingStudents ? $feePayingStudents->section_4_title : '' }}
                            </h3>
                            <p>{!! $feePayingStudents ? $feePayingStudents->section_4_content : '' !!}</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-20">
                                @if ($feePayingStudents && $feePayingStudents->images()->where('category', 'section_1')->first())
                                    <img class="img-1"
                                        src="{{ asset('storage/' . $feePayingStudents->images()->where('category', 'section_1')->first()->path) }}"
                                        alt="">
                                @endif
                            </div>
                            <div class="col-md-6 mb-20">
                                @if ($feePayingStudents && $feePayingStudents->images()->where('category', 'section_1')->skip(1)->first())
                                    <img class="img-1"
                                        src="{{ asset('storage/' . $feePayingStudents->images()->where('category', 'section_1')->skip(1)->first()->path) }}"
                                        alt="">

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- health-care end -->
        </main>
    
</div>
