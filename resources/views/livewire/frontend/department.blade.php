<div>
@section('content')
<main class="main">

    <!-- breadcrumb -->
    <div class="site-breadcrumb"
         style="background: url('{{ $dep->banner ? asset('storage/' . $dep->banner) : '' }}')">
        <div class="container">
            <h2 class="breadcrumb-title">{{ $dep->name }}</h2>
            <ul class="breadcrumb-menu">
                <li><a href="/">Home</a></li>
                <li class="active">{{ $dep->name }}</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- department-single -->
    <div class="department-single-area py-120">
        <div class="container">
            <div class="department-single-wrapper">
                <div class="row">
                    <div class="col-xl-4 col-lg-4">
                        <div class="department-sidebar">
                            <div class="widget category">
                                <h4 class="widget-title">Our Departments</h4>
                                <div class="category-list">
                                    @forelse($depCats as $depCat)
                                        <a href="#"><i class="far fa-long-arrow-right"></i>{{ $depCat->name }}</a>
                                    @empty
                                        <p>No categories</p>
                                    @endforelse
                                </div>
                            </div>
                            <div class="widget department-download">
                                <h4 class="widget-title">Download</h4>
                                <a href="#"><i class="far fa-file-pdf"></i> Download Brochure</a>
                                <a href="#"><i class="far fa-file-pdf"></i> Department Details</a>
                                <a href="#"><i class="far fa-file-pdf"></i> Journals Departments</a>
                                <a href="#"><i class="far fa-file-alt"></i> Download Application</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8">
                        <div class="department-details">
                            <div class="department-details-img mb-30">
                                <img
                                  src="{{ isset($dep->featuredImage) ? asset('storage/' . $dep->featuredImage->path) : '' }}"
                                  alt="{{ optional($dep->featuredImage)->alt ?? 'Featured image for ' . $dep->name }}">
                            </div>
                            <div class="department-details">
                                <h3 class="mb-20">{{ $dep->name }}</h3>
                                <p class="mb-20">{!! $dep->paragraph1 !!}</p>
                                <p class="mb-20">{!! $dep->paragraph2 !!}</p>
                                <div class="row">
                                    <div class="col-md-6 mb-20">
                                        <img
                                          src="{{ isset($dep->images[1]) ? asset('storage/' . $dep->images[1]->path) : '' }}"
                                          alt="{{ optional($dep->images[1])->alt ?? 'Image 1 for ' . $dep->name }}">
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <img
                                          src="{{ isset($dep->images[2]) ? asset('storage/' . $dep->images[2]->path) : '' }}"
                                          alt="{{ optional($dep->images[2])->alt ?? 'Image 2 for ' . $dep->name }}">
                                    </div>
                                </div>
                                <p class="mb-20">{!! $dep->paragraph3 !!}</p>
                                <div class="my-4">
                                    <div class="mb-3">

                                        <p>{!! $dep->paragraph4 !!}</p>
                                    </div>
                                </div>
                                <div class="my-4">
                                 {!! $dep->paragraph5 !!}
                                  {!! $dep->paragraph6 !!}
                                 {!! $dep->paragraph7 !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- department-single end-->

</main>
@endsection

</div>
