<div>
    @section('content')
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
                        @if ($admissionPolicy)
                            <!-- Debug Information (remove this in production) -->
                            @if (config('app.debug'))
                                <div class="alert alert-info mb-4">
                                    <h5>Debug Information:</h5>
                                    <ul>
                                        <li><strong>Page Found:</strong> {{ $debugInfo['page_found'] ? 'Yes' : 'No' }}</li>
                                        <li><strong>Page Name:</strong> {{ $debugInfo['page_name'] }}</li>
                                        <li><strong>Page ID:</strong> {{ $debugInfo['page_id'] }}</li>
                                        <li><strong>Total Images:</strong> {{ $debugInfo['total_images'] }}</li>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <li><strong>Section {{ $i }} Images:</strong>
                                                {{ $debugInfo["section_{$i}_images"] ?? 0 }}</li>
                                        @endfor
                                    </ul>

                                    @if (isset($debugInfo['all_image_data']))
                                        <h6>All Images Data:</h6>
                                        <div style="max-height: 200px; overflow-y: auto;">
                                            @foreach ($debugInfo['all_image_data'] as $img)
                                                <div class="mb-2 border p-2">
                                                    <strong>ID:</strong> {{ $img['id'] }} |
                                                    <strong>Category:</strong> {{ $img['category'] }} |
                                                    <strong>Path:</strong> {{ $img['path'] }} |
                                                    <strong>Caption:</strong> {{ $img['caption'] }}
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <h6>Available Pages:</h6>
                                    <ul>
                                        @foreach ($debugInfo['all_pages'] as $page)
                                            <li>{{ $page['page_name'] }} (ID: {{ $page['id'] }})</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @for ($i = 1; $i <= 10; $i++)
                                @php
                                    $sectionTitle = "section_{$i}_title";
                                    $sectionContent = "section_{$i}_content";
                                    $hasTitle = $admissionPolicy->$sectionTitle;
                                    $hasContent = $admissionPolicy->$sectionContent;
                                    $images = $admissionPolicy->sectionImages($i);
                                    $totalImages = $admissionPolicy->images()->count();
                                    $sectionImages = $images->count();
                                @endphp

                                @if (config('app.debug'))
                                    <div class="alert alert-secondary">
                                        <strong>Section {{ $i }} Debug:</strong><br>
                                        Has Title: {{ $hasTitle ? 'Yes' : 'No' }}<br>
                                        Has Content: {{ $hasContent ? 'Yes' : 'No' }}<br>
                                        Section Images: {{ $sectionImages }}<br>
                                        Will Display: {{ $hasTitle || $hasContent || $sectionImages > 0 ? 'Yes' : 'No' }}
                                    </div>
                                @endif

                                @if ($hasTitle || $hasContent || $sectionImages > 0)
                                    <div class="my-4">
                                        @if ($hasTitle)
                                            <h3 class="mb-2">
                                                {{ $admissionPolicy->$sectionTitle }}
                                            </h3>
                                        @endif
                                        @if ($hasContent)
                                            <div class="section-content">
                                                {!! $admissionPolicy->$sectionContent !!}
                                            </div>
                                        @endif

                                        @if ($sectionImages > 0)
                                            @if (config('app.debug'))
                                                <div class="alert alert-success">
                                                    <strong>Section {{ $i }} - Found {{ $sectionImages }}
                                                        images</strong>
                                                    <br>About to loop through {{ $sectionImages }} images...
                                                </div>
                                            @endif
                                            <div class="row mt-4">
                                                @if (config('app.debug'))
                                                    <div class="col-12">
                                                        <div class="alert alert-warning">
                                                            <strong>DEBUG: Starting image loop for section
                                                                {{ $i }}</strong>
                                                        </div>
                                                    </div>
                                                @endif
                                                @foreach ($images as $image)
                                                    @if (config('app.debug'))
                                                        <div class="col-12 mb-2">
                                                            <div class="alert alert-info">
                                                                <strong>DEBUG: Processing image {{ $loop->iteration }} of
                                                                    {{ $loop->count }}</strong><br>
                                                                Image ID: {{ $image->id }}<br>
                                                                Image Path: {{ $image->path }}<br>
                                                                Image Category: {{ $image->category }}<br>
                                                                Full URL: {{ asset('storage/' . $image->path) }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-md-4 mb-4">
                                                        @if (config('app.debug'))
                                                            <!-- Debug: Image HTML Start -->
                                                            <div style="border: 2px solid red; padding: 10px; margin: 5px;">
                                                                <strong>DEBUG IMAGE:</strong><br>
                                                                ID: {{ $image->id }}<br>
                                                                Path: {{ $image->path }}<br>
                                                                URL: {{ asset('storage/' . $image->path) }}<br>
                                                                <img src="{{ asset('storage/' . $image->path) }}"
                                                                    alt="{{ $image->caption }}"
                                                                    style="max-width: 100%; height: auto; border: 1px solid blue;" />
                                                            </div>
                                                            <!-- Debug: Image HTML End -->
                                                        @else
                                                            <img src="{{ asset('storage/' . $image->path) }}"
                                                                alt="{{ $image->caption }}" class="img-fluid rounded" />
                                                        @endif
                                                        @if ($image->caption)
                                                            <p class="text-muted mt-2">
                                                                {{ $image->caption }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                @endforeach
                                                @if (config('app.debug'))
                                                    <div class="col-12">
                                                        <div class="alert alert-success">
                                                            <strong>DEBUG: Finished image loop for section
                                                                {{ $i }}</strong>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @elseif($totalImages > 0 && ($hasTitle || $hasContent))
                                            <div class="alert alert-warning mt-3">
                                                <strong>No images found for section {{ $i }}</strong><br>
                                                Looking for images with category:
                                                <code>section_{{ $i }}</code><br>
                                                Total images on this page: {{ $totalImages }}
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endfor
                        @else
                            <div class="my-4">
                                <div class="alert alert-warning">
                                    <h4>Admission Policy Page Not Found</h4>
                                    <p>The admission policy page has not been created yet. Please create it in the admin
                                        dashboard.</p>

                                    @if (config('app.debug'))
                                        <hr>
                                        <h6>Available Pages:</h6>
                                        <ul>
                                            @foreach ($debugInfo['all_pages'] as $page)
                                                <li>{{ $page['page_name'] }} (ID: {{ $page['id'] }})</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <a href="{{ route('dashboard.static-pages.create') }}" class="btn btn-primary">
                                        Create Admissions Policy
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- health-care end -->
        </main>
    @endsection
</div>
