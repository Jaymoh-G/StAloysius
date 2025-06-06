<div>
    @section('content')

    <!-- Page Title/Header -->

    <!-- breadcrumb -->

        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">Careers</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="/">Home</a></li>
                    <li class="active">Careers</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

    <!-- Careers Content -->
    <div class="career-area py-120">
        <div class="container">
            <!-- Filter by Category -->
            <div class="row mb-4">
                <div class="col-md-6 mx-auto">
                    <select wire:model="selectedCategory" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Job Listings -->
            <div class="row">
                <div class="col-12">
                    @if($jobs->count() > 0)
                        @foreach($jobs as $job)
                        <div class="career-item mb-4">
                            <div class="career-content">
                                <h4><a href="{{ route('careers.show', $job->slug) }}">{{ $job->title }}</a></h4>
                                <p>{{ Str::limit(strip_tags($job->description), 150) }}</p>
                                <div class="career-meta">
                                    <span><i class="far fa-tag"></i> {{ $job->category->name }}</span>
                                    <span class="text-danger"><i class="far fa-calendar"></i> Deadline: {{ $job->deadline->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <div class="career-link">
                                <a href="{{ route('careers.show', $job->slug) }}"><i class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                        @endforeach

                        <div class="pagination-area">
                            {{ $jobs->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="far fa-briefcase fa-3x mb-3 text-muted"></i>
                            <h4>No job vacancies available</h4>
                            <p>Please check back later for new opportunities.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @endsection
</div>

