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

        <!-- team-area1-->
        <div class="team-area py-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <h2 class="site-title">Meet Our <span>Team</span></h2>
                            <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Academic
                                Department</span>

                            <p>The academic department is responsible for managing teaching, curriculum development,
                                research, and ensuring academic quality and contributing to the institution’s educational
                                goals.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @forelse ($academicMembers as $member)
                        <div class="col-md-6 col-lg-3">
                            <div class="team-item wow fadeInUp" data-wow-delay=".25s">
                                <div class="team-img">
                                    @if ($member->image)
                                        <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}">
                                    @else
                                        <img src="{{ asset('assets/img/team/default.jpg') }}" alt="{{ $member->name }}">
                                    @endif
                                </div>
                                <div class="team-social">
                                    @if (isset($member->socials['facebook']))
                                        <a href="{{ $member->socials['facebook'] }}" target="_blank"><i
                                                class="fab fa-facebook-f"></i></a>
                                    @endif
                                    @if (isset($member->socials['linkedin']))
                                        <a href="{{ $member->socials['linkedin'] }}" target="_blank"><i
                                                class="fab fa-linkedin-in"></i></a>
                                    @endif
                                    @if (isset($member->socials['youtube']))
                                        <a href="{{ $member->socials['youtube'] }}" target="_blank"><i
                                                class="fab fa-youtube"></i></a>
                                    @endif
                                    @if (isset($member->socials['website']))
                                        <a href="{{ $member->socials['website'] }}" target="_blank"><i
                                                class="fas fa-globe"></i></a>
                                    @endif
                                </div>
                                <div class="team-content">
                                    <div class="team-bio">
                                        <h5><a href="#">{{ $member->name }}</a></h5>
                                        <span>{{ $member->position }}</span>
                                    </div>
                                </div>
                                @if (isset($member->socials) && !empty($member->socials))
                                    <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No non-academic members found.</p>
                        </div>
                    @endforelse
                </div>

                <!-- non-academic members -->
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Non-Academic
                                Department</span>
                            <p>The non-academic department supports the overall functioning of the institution by handling administrative, operational, and student support services contributing to a conducive learning environment.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @forelse ($nonAcademicMembers as $member)
                        <div class="col-md-6 col-lg-3">
                            <div class="team-item wow fadeInUp" data-wow-delay=".25s">
                                <div class="team-img">
                                    @if ($member->image)
                                        <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}">
                                    @else
                                        <img src="{{ asset('assets/img/team/default.jpg') }}" alt="{{ $member->name }}">
                                    @endif
                                </div>
                                <div class="team-social">
                                    @if (isset($member->socials['facebook']))
                                        <a href="{{ $member->socials['facebook'] }}" target="_blank"><i
                                                class="fab fa-facebook-f"></i></a>
                                    @endif
                                    @if (isset($member->socials['linkedin']))
                                        <a href="{{ $member->socials['linkedin'] }}" target="_blank"><i
                                                class="fab fa-linkedin-in"></i></a>
                                    @endif
                                    @if (isset($member->socials['youtube']))
                                        <a href="{{ $member->socials['youtube'] }}" target="_blank"><i
                                                class="fab fa-youtube"></i></a>
                                    @endif
                                    @if (isset($member->socials['website']))
                                        <a href="{{ $member->socials['website'] }}" target="_blank"><i
                                                class="fas fa-globe"></i></a>
                                    @endif
                                </div>
                                <div class="team-content">
                                    <div class="team-bio">
                                        <h5><a href="#">{{ $member->name }}</a></h5>
                                        <span>{{ $member->position }}</span>
                                    </div>
                                </div>
                                @if (isset($member->socials) && !empty($member->socials))
                                    <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                                <p>No non-academic members found.</p>
                        </div>
                    @endforelse
                </div>
   {{-- Show this only if there are other members --}}
                @if (count($otherMembers) > 0)
                <!-- Support Staff Section -->
                <div class="row mt-5">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline"><i class="far fa-book-open-reader"></i> Support Staff</span>
                            <p>It is a long established fact that a reader will be distracted by the readable content of
                                a page when looking at its layout.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @forelse ($otherMembers as $member)
                        <div class="col-md-6 col-lg-3">
                            <div class="team-item wow fadeInUp" data-wow-delay=".25s">
                                <div class="team-img">
                                    @if ($member->image)
                                        <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}">
                                    @else
                                        <img src="{{ asset('assets/img/team/default.jpg') }}" alt="{{ $member->name }}">
                                    @endif
                                </div>
                                <div class="team-social">
                                    @if (isset($member->socials['facebook']))
                                        <a href="{{ $member->socials['facebook'] }}" target="_blank"><i
                                                class="fab fa-facebook-f"></i></a>
                                    @endif
                                    @if (isset($member->socials['linkedin']))
                                        <a href="{{ $member->socials['linkedin'] }}" target="_blank"><i
                                                class="fab fa-linkedin-in"></i></a>
                                    @endif
                                    @if (isset($member->socials['youtube']))
                                        <a href="{{ $member->socials['youtube'] }}" target="_blank"><i
                                                class="fab fa-youtube"></i></a>
                                    @endif
                                    @if (isset($member->socials['website']))
                                        <a href="{{ $member->socials['website'] }}" target="_blank"><i
                                                class="fas fa-globe"></i></a>
                                    @endif
                                </div>
                                <div class="team-content">
                                    <div class="team-bio">
                                        <h5><a href="#">{{ $member->name }}</a></h5>
                                        <span>{{ $member->position }}</span>
                                    </div>
                                </div>
                                @if (isset($member->socials) && !empty($member->socials))
                                    <span class="team-social-btn"><i class="far fa-share-nodes"></i></span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No support staff members found.</p>
                        </div>
                    @endforelse
                </div>
                @endif
            </div>
        </div>
        <!-- team-area1end -->
        <!-- team-area2 -->




        <!-- team-area end2 -->
        <!-- team-area2 -->




        <!-- team-area end2 -->
    @endsection

</div>
