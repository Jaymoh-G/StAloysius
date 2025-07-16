

    <main class="main">
        <div
            class="site-breadcrumb"
            style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})"
        >
            <div class="container">
                <h2 class="breadcrumb-title">Support Us</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="/">Home</a></li>
                    <li class="active">Support Us</li>
                </ul>
            </div>
        </div>

        <div class="container py-5">
            <div class="row g-5">
                <!-- Projects Section -->
                <div class="col-md-4">
                    <div class="card h-100 shadow">
                        @foreach($projects->images as $img) @if($img &&
                        !empty($img->path))
                        <img
                            src="{{ asset('storage/' . $img->path) }}"
                            class="card-img-top"
                            alt="Projects"
                        />
                        @endif @endforeach
                        <div class="card-body text-center">
                            <h3 class="card-title mb-3">
                                {{ $projects->title ?? 'Support Our Projects' }}
                            </h3>
                            <p class="card-text">
                                pp
                                {!! $projects->content ?? '' !!}
                            </p>
                            <a
                                href="{{ route('projects') }}"
                                class="btn btn-success mt-3"
                                >Support Projects</a
                            >
                        </div>
                    </div>
                </div>
                <!-- Volunteering Section -->
                <div class="col-md-4">
                    <div class="card h-100 shadow">
                        @foreach($volunteering->images as $img) @if($img &&
                        !empty($img->path))
                        <img
                            src="{{ asset('storage/' . $img->path) }}"
                            class="card-img-top"
                            alt="Volunteer"
                        />
                        @endif @endforeach
                        <div class="card-body text-center">
                            <h3 class="card-title mb-3">
                                {{ $volunteering->title ?? 'Volunteer Your Service' }}
                            </h3>
                            <p class="card-text">
                                {!! $volunteering->content ?? '' !!}
                            </p>
                            <a
                                href="{{ route('volunteer') }}"
                                class="btn btn-warning mt-3"
                                >Become a Volunteer</a
                            >
                        </div>
                    </div>
                </div>
                <!-- Donations Section -->
                <div class="col-md-4">
                    <div class="card h-100 shadow">
                        @foreach($donations->images as $img) @if($img &&
                        !empty($img->path))
                        <img
                            src="{{ asset('storage/' . $img->path) }}"
                            class="card-img-top"
                            alt="Donations"
                        />
                        @endif @endforeach
                        <div class="card-body text-center">
                            <h3 class="card-title mb-3">
                                {{ $donations->title ?? 'Support Us by Donations' }}
                            </h3>
                            <p class="card-text">
                                {!! $donations->content ?? '' !!}
                            </p>
                            <a
                                href="{{ route('donations') }}"
                                class="btn btn-primary mt-3"
                                >Donate Now</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

