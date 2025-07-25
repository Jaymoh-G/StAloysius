<div>
    <main class="main">
        <!-- breadcrumb -->
        <div
            class="site-breadcrumb"
            style="background: url({{ $schoolOfHopePage && $schoolOfHopePage->banner_image ? asset('storage/' . $schoolOfHopePage->banner_image) : asset('assets/img/breadcrumb/01.jpg') }})"
        >
            <div class="container">
                <h2 class="breadcrumb-title">
                    {{ $schoolOfHopePage ? $schoolOfHopePage->title : 'School of Hope Page' }}
                </h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">School of Hope Page</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- content section -->
        <div class="health-care pt-120">
            <div class="container">
                <div class="health-care-content">
                    {{-- General image --}}
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
                            {{ $schoolOfHopePage ? $schoolOfHopePage->title : '' }}
                        </h3>
                        <p>
                            {!! $schoolOfHopePage ? $schoolOfHopePage->content :
                            '' !!}
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <!-- content section end -->

            <div class="container pb-5">
            <div class="row">
                <div class="col-12 text-center">
                    <a
                        href="https://www.schoolofhopekenya.org/"
                        target="_blank"
                        class="theme-btn"
                    >
                        Visit School of Hope Website
                        <i class="fas fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
