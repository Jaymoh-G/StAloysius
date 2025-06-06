<div>
    @section('content')

    <!-- breadcrumb -->

        <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
            <div class="container">
                <h2 class="breadcrumb-title">{{ $job->title }}</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('careers') }}">Careers</a></li>
                    <li class="active">{{ $job->title }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

    <!-- Job Details -->
    <div class="career-details-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="career-details-content">
                        <div class="details-meta mb-4">
                            <span class="badge bg-primary me-2">{{ $job->category->name }}</span>
                            <span class="text-danger"><i class="far fa-calendar me-1"></i>Deadline: {{ $job->deadline->format('M d, Y') }}</span>
                        </div>

                        <div class="details-text">
                            {!! $job->description !!}
                        </div>

                        <div class="application-info mt-5">
                            <h4>How to Apply</h4>
                            <p>Please send your resume and cover letter to: <a href="mailto:{{ $job->application_email }}">{{ $job->application_email }}</a></p>
                            <p>Include the job title "{{ $job->title }}" in the subject line.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="widget career-info-widget">
                            <h4 class="widget-title">Job Information</h4>
                            <div class="info-list">
                                <ul>
                                    <li><i class="far fa-tag"></i> <span>Category:</span> {{ $job->category->name }}</li>
                                    <li><i class="far fa-calendar"></i> <span>Deadline:</span> {{ $job->deadline->format('M d, Y') }}</li>
                                    <li><i class="far fa-envelope"></i> <span>Email:</span> {{ $job->application_email }}</li>
                                    <li><i class="far fa-clock"></i> <span>Posted:</span> {{ $job->created_at->diffForHumans() }}</li>
                                </ul>
                            </div>

                            <div class="mt-4">
                                <a href="mailto:{{ $job->application_email }}?subject=Application for {{ $job->title }}" class="btn btn-primary w-100">Apply Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
</div>
