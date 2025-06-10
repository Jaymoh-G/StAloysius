<div>
    @section('content')
    <main class="main">
        <!-- breadcrumb -->
        <div
            class="site-breadcrumb"
            style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})"
        >
            <div class="container">
                <h2 class="breadcrumb-title">{{ $member->name }}</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">{{ $member->name }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- team single -->
        <div class="team-single pt-120 pb-80">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="team-single-img">
                            <img
                                src="{{ asset('storage/'.$member->image) }}"
                                alt=""
                            />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="team-details">
                            <h3>{{ $member->name }}</h3>
                            <strong>{{ $member->position }}</strong>
                            <p class="mt-3">
                                {{ $member->description }}
                            </p>
                            <div class="team-details-info">
                                <ul>
                                  
                                </ul>
                            </div>
                            <div class="team-details-social">
                                @if($member->socials) @php $socials =
                                is_array($member->socials) ? $member->socials :
                                json_decode($member->socials, true); @endphp
                                @if($socials) @foreach($socials as $platform =>
                                $url)
                                <a href="{{ $url }}" target="_blank">
                                    <i
                                        class="fab fa-{{
                                            strtolower($platform)
                                        }}"
                                    ></i>
                                </a>
                                @endforeach @endif @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- team single end -->

        <!-- biography & skill -->
        <div class="biography-skil pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="biography">
                            <h4 class="mb-3">Biography</h4>
                            <p class="mb-10">
                              {{ $member->experience }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="team-skill">
                            <h4 class="mb-3">Professional Skills</h4>
                            <div class="skills-section">
                                @if($member->professional_skills)
                                @php $skills = is_array($member->professional_skills) ? $member->professional_skills : json_decode($member->professional_skills, true); @endphp
                                @if(count($skills) > 0)
                                @foreach($skills as $skill => $percent)
                                <div class="progress-box">
                                    <h5>
                                        {{ $skill }}
                                        <span class="pull-right">{{ $percent }}%</span>
                                    </h5>
                                    <div class="progress" data-value="{{ $percent }}">
                                        <div
                                            class="progress-bar"
                                            role="progressbar"
                                        ></div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- biography & skill end -->
    </main>

    @endsection
</div>
