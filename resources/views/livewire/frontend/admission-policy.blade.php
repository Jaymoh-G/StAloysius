<div>

        <main class="main">
            <!-- breadcrumb -->
            <div class="site-breadcrumb"
                style="background: url({{ $admissionPolicy && $admissionPolicy->banner_image ? asset('storage/' . $admissionPolicy->banner_image) : asset('assets/img/breadcrumb/01.jpg') }})">
                <div class="container">
                    <h2 class="breadcrumb-title">
                        {{ $admissionPolicy ? $admissionPolicy->title : 'Admissions' }}
                    </h2>
                    <ul class="breadcrumb-menu">
                        <li><a href="/">Home</a></li>
                        <li class="active">Admissions</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb end -->




            <!-- health-care -->
            <div class="health-care py-120">
                <div class="container">
                    <div class="health-care-content">
                        <div class="health-care-img">
                            @if ($admissionPolicy && $admissionPolicy->images()->where('category', 'general')->first())
                                <img class="img-1"
                                    src="{{ asset('storage/' . $admissionPolicy->images()->where('category', 'general')->first()->path) }}"
                                    alt="">
                            @else
                                <img src="assets/img/health-care/01.jpg" alt="">
                            @endif

                        </div>
                        <div class="my-4">
                            <h3 class="mb-2">{{ $admissionPolicy ? $admissionPolicy->title : 'Admissions' }}</h3>
                            <p>{!! $admissionPolicy ? $admissionPolicy->content : 'Admissions' !!}</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-20">
                                @if ($admissionPolicy && $admissionPolicy->images()->where('category', 'section_1')->first())
                                    <img class="img-1"
                                        src="{{ asset('storage/' . $admissionPolicy->images()->where('category', 'section_1')->first()->path) }}"
                                        alt="">
                                @else
                                    <img src="assets/img/health-care/02.jpg" alt="">
                                @endif
                            </div>
                            <div class="col-md-6 mb-20">
                                @if ($admissionPolicy && $admissionPolicy->images()->where('category', 'section_1')->skip(1)->first())
                                    <img class="img-1"
                                        src="{{ asset('storage/' . $admissionPolicy->images()->where('category', 'section_1')->skip(1)->first()->path) }}"
                                        alt="">
                                @else
                                    <img src="assets/img/health-care/02.jpg" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="my-4">
                            <h3 class="mb-2">{{ $admissionPolicy ? $admissionPolicy->section_2_title : 'Admissions' }}
                            </h3>
                            <p>{!! $admissionPolicy ? $admissionPolicy->section_2_content : 'Admissions' !!}</p>
                        </div>
                        <div class="col-md-6 mb-20">
                            @if ($admissionPolicy && $admissionPolicy->images()->where('category', 'section_2')->first())
                                <img class="img-1"
                                    src="{{ asset('storage/' . $admissionPolicy->images()->where('category', 'section_2')->first()->path) }}"
                                        alt="">
                                @else
                                        <img src="assets/img/health-care/02.jpg" alt="">
                                @endif
                            </div>
                        <div class="my-4">
                            <h3 class="mb-2">{{ $admissionPolicy ? $admissionPolicy->section_3_title : 'Admissions' }}
                            </h3>
                            <p>{!! $admissionPolicy ? $admissionPolicy->section_3_content : 'Admissions' !!}</p>

                        </div>
                           <div class="col-md-6 mb-20">
                                @if ($admissionPolicy && $admissionPolicy->images()->where('category', 'section_3')->first())
                                    <img class="img-1"
                                        src="{{ asset('storage/' . $admissionPolicy->images()->where('category', 'section_3')->first()->path) }}"
                                        alt="">
                                @else
                                    <img src="assets/img/health-care/02.jpg" alt="">
                                @endif
                            </div>
                        <div class="my-4">
                            <h3 class="mb-2">{{ $admissionPolicy ? $admissionPolicy->section_4_title : 'Admissions' }}
                            </h3>
                            <p>{!! $admissionPolicy ? $admissionPolicy->section_4_content : 'Admissions' !!}</p>
                        </div>
                           <div class="col-md-6 mb-20">
                                @if ($admissionPolicy && $admissionPolicy->images()->where('category', 'section_4')->first())
                                    <img class="img-1"
                                        src="{{ asset('storage/' . $admissionPolicy->images()->where('category', 'section_4')->first()->path) }}"
                                        alt="">
                                @else
                                    <img src="assets/img/health-care/02.jpg" alt="">
                                @endif
                            </div>
                    </div>
                </div>
            </div>
            <!-- health-care end -->
        </main>
    
</div>
