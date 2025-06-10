<div>
    @section('content')
    <main class="main">
        <!-- breadcrumb -->
        <div
            class="site-breadcrumb"
            style="background: url({{ $admissionPolicy && $admissionPolicy->banner_image ? asset('storage/' . $admissionPolicy->banner_image) : asset('assets/img/breadcrumb/01.jpg') }})"
        >
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
                    @if($admissionPolicy)
                    <div class="my-4">{!! $admissionPolicy->content !!}</div>

                    @for($i = 1; $i <= 10; $i++) @php $sectionTitle =
                    "section_{$i}_title"; $sectionContent =
                    "section_{$i}_content"; @endphp
                    @if($admissionPolicy->$sectionTitle ||
                    $admissionPolicy->$sectionContent)
                    <div class="my-4">
                        @if($admissionPolicy->$sectionTitle)
                        <h3 class="mb-2">
                            {{ $admissionPolicy->$sectionTitle }}
                        </h3>
                        @endif @if($admissionPolicy->$sectionContent)
                        <div class="section-content">
                            {!! $admissionPolicy->$sectionContent !!}
                        </div>
                        @endif @php $images =
                        $admissionPolicy->sectionImages($i); @endphp @if($images
                        && $images->count() > 0)
                        <div class="row mt-4">
                            @foreach($images as $image)
                            <div class="col-md-4 mb-4">
                                <img
                                    src="{{ asset('storage/' . $image->path) }}"
                                    alt="{{ $image->caption }}"
                                    class="img-fluid rounded"
                                />
                                @if($image->caption)
                                <p class="mt-2 text-muted">
                                    {{ $image->caption }}
                                </p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endif @endfor @else
                    <div class="my-4">
                        <p>Content not available at the moment.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- health-care end -->
    </main>
    @endsection
</div>
