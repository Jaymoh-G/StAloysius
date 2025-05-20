<div>

  @section('content')

        <!-- breadcrumb -->
        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Our Team</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="/">Home</a></li>
                    <li class="active">Team</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->


        <!-- team-area -->
        <div class="team-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Our Team</span>
                            <h2 class="site-title">Meet Our <span>Team</span></h2>
                            <p>It is a long established fact that a reader will be distracted by the readable content of
                                a page when looking at its layout.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                     @foreach ($members as $member)
                    <div class="col-md-6 col-lg-3">
                        <div class="team-item wow fadeInUp" data-wow-delay=".25s">
                               @if ($member->image)
                            <div class="team-img">
                               <a href="{{route('frontend.team.show',$member->slug)}}"> <img src="{{ Storage::url($member->image) }}" alt="{{ $member->name }}"></a>
                            </div>
                            @endif
                            <div class="team-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-whatsapp"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                            <div class="team-content">
                                <div class="team-bio">
                                    <h5><a href="{{route('frontend.team.show',$member->slug)}}">{{ $member->name }}</a></h5>
                                    <span>{{ $member->position }}</span>
                                </div>
                            </div>
                            <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- team-area end -->

@endsection

</div>
