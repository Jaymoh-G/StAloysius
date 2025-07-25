<div>
    <main class="main">
        <!-- breadcrumb -->
        <div
            class="site-breadcrumb"
            style="background: url({{ $clcPage && $clcPage->banner_image ? asset('storage/' . $clcPage->banner_image) : asset('assets/img/breadcrumb/01.jpg') }})"
        >
            <div class="container">
                <h2 class="breadcrumb-title">
                    {{ $clcPage ? $clcPage->title : 'Christian Life Community' }}
                </h2>
                <ul class="breadcrumb-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">
                   {{ $clcPage ? $clcPage->title : 'Christian Life Community' }}
                    </li>
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
                    <div class="my-0">
                        <h3 class="mb-2">
                            {{ $clcPage ? $clcPage->title : '' }}
                        </h3>
                        <p>{!! $clcPage ? $clcPage->content : '' !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- content section end -->

        <!-- CLC Team Section -->
        <div class="team-area py-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="site-heading text-center">
                            <h2 class="site-title">
                                Meet Our <span>CLC Team</span>
                            </h2>
                            <span class="site-title-tagline"
                                ><i class="far fa-book-open-reader"></i>
                                Christian Life Community Team</span
                            >
                            <p>
                                Our CLC team is dedicated to fostering spiritual
                                growth, community service, and leadership within
                                the Christian Life Community.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @forelse ($clcTeamMembers as $member)
                    <div class="col-md-6 col-lg-3">
                        <div
                            class="team-item wow fadeInUp"
                            data-wow-delay=".25s"
                        >
                            <div class="team-img">
                                @if ($member->image)
                                <img
                                    src="{{ asset('storage/' . $member->image) }}"
                                    alt="{{ $member->name }}"
                                />
                                @else
                                <img
                                    src="{{
                                        asset('assets/img/team/default.jpg')
                                    }}"
                                    alt="{{ $member->name }}"
                                />
                                @endif
                            </div>
                            <div class="team-social">
                                @if (isset($member->socials['facebook']))
                                <a
                                    href="{{ $member->socials['facebook'] }}"
                                    target="_blank"
                                    ><i class="fab fa-facebook-f"></i
                                ></a>
                                @endif @if (isset($member->socials['linkedin']))
                                <a
                                    href="{{ $member->socials['linkedin'] }}"
                                    target="_blank"
                                    ><i class="fab fa-linkedin-in"></i
                                ></a>
                                @endif @if (isset($member->socials['youtube']))
                                <a
                                    href="{{ $member->socials['youtube'] }}"
                                    target="_blank"
                                    ><i class="fab fa-youtube"></i
                                ></a>
                                @endif @if (isset($member->socials['website']))
                                <a
                                    href="{{ $member->socials['website'] }}"
                                    target="_blank"
                                    ><i class="fas fa-globe"></i
                                ></a>
                                @endif
                            </div>
                            <div class="team-content">
                                <div class="team-bio">
                                    <h5>
                                        <a
                                            href="{{ route('frontend.team.show', $member->slug) }}"
                                            >{{ $member->name }}</a
                                        >
                                    </h5>
                                    <span>{{ $member->position }}</span>
                                </div>
                            </div>
                            @if (isset($member->socials) &&
                            !empty($member->socials))
                            <span class="team-social-btn"
                                ><i class="far fa-share-nodes"></i
                            ></span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p>No CLC team members found.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- End CLC Team Section -->

        <div class="container pb-5">
            <div class="row">
                <div class="col-12 text-center">
                    <a
                        href="https://www.clckenya.org/"
                        target="_blank"
                        class="theme-btn"
                    >
                        Visit Christian Life Community Website
                        <i class="fas fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
