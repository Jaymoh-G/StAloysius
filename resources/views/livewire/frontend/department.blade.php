<div>

    <main class="main">
        <!-- breadcrumb -->
        <div
            class="site-breadcrumb"
            style="background: url('{{ $dep->banner ? asset('storage/' . $dep->banner) : '' }}')"
        >
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

                        <div class="col-xl-8 col-lg-8">
                            <div class="department-details">
                                <div class="department-details-img mb-30">
                                    <img
                                        src="{{ isset($dep->featuredImage) ? asset('storage/' . $dep->featuredImage->path) : '' }}"
                                        alt="{{ optional($dep->featuredImage)->alt ?? 'Featured image for ' . $dep->name }}"
                                    />
                                </div>

                                <div class="department-details">
                                    <h3 class="mb-20">{{ $dep->name }}</h3>
                                    <div class="my-4">
                                        <div class="mb-3">
                                            {!! $dep->paragraph1 !!}
                                        </div>
                                    </div>
                                    <div class="my-4">
                                        <div class="mb-3">
                                            {!! $dep->paragraph2 !!}
                                        </div>
                                    </div>

                                    <p class="mb-20">
                                        {!! $dep->paragraph3 !!}
                                    </p>
                                    <div class="my-4">
                                        <div class="mb-3">
                                            <p>{!! $dep->paragraph4 !!}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-20">
                                            <img
                                                src="{{ isset($dep->images[1]) ? asset('storage/' . $dep->images[1]->path) : '' }}"
                                                alt="{{ optional($dep->images[1])->alt ?? 'Image 1 for ' . $dep->name }}"
                                            />
                                        </div>
                                        <div class="col-md-6 mb-20">
                                            <img
                                                src="{{ isset($dep->images[2]) ? asset('storage/' . $dep->images[2]->path) : '' }}"
                                                alt="{{ optional($dep->images[2])->alt ?? 'Image 2 for ' . $dep->name }}"
                                            />
                                        </div>
                                    </div>
                                    @for ($i = 5; $i <= 21; $i++) @php
                                    $paragraph = $dep->{'paragraph' . $i};
                                    @endphp @if (!empty($paragraph))
                                    <div class="mb-4">{!! $paragraph !!}</div>
                                    @endif @endfor
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                            <div class="department-sidebar">

                                @if($projects->count() > 0)
                                <!-- recent projects -->
                                <div class="widget recent-post">
                                    <h5 class="widget-title">
                                        {{ $dep->name }} Projects
                                    </h5>
                                    @foreach($projects as $project)
                                    <div class="recent-post-single">
                                        <div class="recent-post-img">
                                            @if ($project->featuredImage)
                                            <img
                                                src="{{ asset('storage/' . $project->featuredImage->path) }}"
                                                alt="{{ $project->title }}"
                                            />
                                            @else
                                            <img
                                                src="{{
                                                    asset(
                                                        'assets/img/blog/01.jpg'
                                                    )
                                                }}"
                                                alt="{{ $project->title }}"
                                            />
                                            @endif
                                        </div>
                                        <div class="recent-post-bio">
                                            <h6>
                                                <a
                                                    href="{{ route('project', $project->slug) }}"
                                                    >{{ $project->title }}</a
                                                >
                                            </h6>
                                            <span
                                                ><i class="far fa-clock"></i
                                                >{{ $project->created_at->format('M d, Y') }}</span
                                            >
                                            <!-- project status -->
                                            @if($project->status == 'completed')
                                            <span
                                                class="badge bg-success text-white"
                                            >
                                                <i
                                                    class="fas fa-check-circle text-white"
                                                ></i>
                                                Completed
                                            </span>
                                            @elseif($project->status ==
                                            'in_progress')
                                            <span
                                                class="badge bg-warning text-white"
                                            >
                                                <i
                                                    class="fas fa-spinner fa-spin text-white"
                                                ></i>
                                                In Progress
                                            </span>
                                            @elseif($project->status ==
                                            'pending')
                                            <span
                                                class="badge bg-secondary text-white"
                                            >
                                                <i
                                                    class="fas fa-clock text-white"
                                                ></i>
                                                Pending
                                            </span>
                                            @elseif($project->status ==
                                            'cancelled')
                                            <span
                                                class="badge bg-danger text-white"
                                            >
                                                <i
                                                    class="fas fa-times-circle text-white"
                                                ></i>
                                                Cancelled
                                            </span>
                                            @else
                                            <span
                                                class="badge bg-info text-white"
                                            >
                                                <i
                                                    class="fas fa-info-circle text-white"
                                                ></i>
                                                {{ ucfirst($project->status) }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                @endif
                                <div class="widget category">
                                    <h4 class="widget-title">
                                        Other Departments
                                    </h4>
                                    <div class="category-list">
                                        @forelse($departments as $department)
                                        <a
                                            href="{{ route('department', $department->slug) }}"
                                            class="{{ $dep->id === $department->id ? 'active' : '' }}"
                                        >
                                            <i
                                                class="far fa-long-arrow-right"
                                            ></i
                                            >{{ $department->name }}
                                        </a>
                                        @empty
                                        <p>No departments</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($teamMembers->count() > 0)
                <!-- team-area -->
                <div class="team-area2 py-120">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 mx-auto">
                                <div class="site-heading text-center">
                                    <span class="site-title-tagline"
                                        ><i class="far fa-book-open-reader"></i>
                                        {{ $dep->name }} Team</span
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @forelse($teamMembers as $member)
                            <div class="col-md-6 col-lg-3">
                                <div
                                    class="team-item wow fadeInUp"
                                    data-wow-delay=".25s"
                                >
                                    <div class="team-img">
                                        <img
                                            src="{{ $member->image ? asset('storage/' . $member->image) : asset('assets/img/team/default.jpg') }}"
                                            alt="{{ $member->name }}"
                                        />
                                    </div>
                                    @if (isset($member->socials) &&
                                    !empty($member->socials))
                                    <div class="team-social">
                                        @if(isset($member->socials['facebook']))
                                        <a
                                            href="{{ $member->socials['facebook'] }}"
                                            target="_blank"
                                            ><i class="fab fa-facebook-f"></i
                                        ></a>
                                        @endif
                                        @if(isset($member->socials['whatsapp']))
                                        <a
                                            href="{{ $member->socials['whatsapp'] }}"
                                            target="_blank"
                                            ><i class="fab fa-whatsapp"></i
                                        ></a>
                                        @endif
                                        @if(isset($member->socials['linkedin']))
                                        <a
                                            href="{{ $member->socials['linkedin'] }}"
                                            target="_blank"
                                            ><i class="fab fa-linkedin-in"></i
                                        ></a>
                                        @endif
                                        @if(isset($member->socials['youtube']))
                                        <a
                                            href="{{ $member->socials['youtube'] }}"
                                            target="_blank"
                                            ><i class="fab fa-youtube"></i
                                        ></a>
                                        @endif
                                    </div>
                                    @endif
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
                                <p>
                                    No staff members found for this department.
                                </p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- team-area end -->
                @endif
            </div>
        </div>
        <!-- department-single end-->
    </main>

</div>
