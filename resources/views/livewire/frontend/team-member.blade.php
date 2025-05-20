<div>
    @section('content')
    <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">{{ $member->name }}</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="index.html">Home</a></li>
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
                            @if ($member->image)
                        <div class="team-single-img">
                            <img src="{{ Storage::url($member->image) }}" alt="{{ $member->name }}">
                        </div>
                         @endif
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
                                    <li><a href="#"><i class="far fa-phone"></i>  +254 715 409 166</a></li>
                                </ul>
                            </div>
                             @if ($member->socials)
                            <div class="team-details-social">
                                  @foreach ($member->socials as $platform => $link)
                                <a href="{{ $link }}"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-whatsapp"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                                <a href="#"><i class="fab fa-pinterest"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                @endforeach
                            </div>
@endif
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
                            <h4 class="mb-3">Experience</h4>
                            <p class="mb-10">
                               {{ $member->experience }}
                            </p>
                        </div>
                    </div>
                         @if ($member->professional_skills)
                    <div class="col-md-6">
                        <div class="team-skill">
                            <h4 class="mb-3">Professional Skills</h4>
  @foreach ($member->professional_skills as $skill => $percent)

                            <div class="skills-section">
                                <div class="progress-box">
                                    <h5>{{ $skill }} <span class="pull-right">{{ $percent }}%</span></h5>
                                    <div class="progress" data-value="{{ $percent }}">
                                       <div class="progress-bar" role="progressbar" style="width: {{ $percent }}%;"></div>
                                    </div>
                                </div>

                            </div>
                        @endforeach

                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- biography & skill end -->


    </main>
    @endsection

