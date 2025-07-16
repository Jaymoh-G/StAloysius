

    <main class="main">
        <!-- breadcrumb -->
        <div
            class="site-breadcrumb"
            style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})"
        >
            <div class="container">
                <h2 class="breadcrumb-title">News - {{ $category->name }}</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('news') }}">News</a></li>
                    <li class="active">{{ $category->name }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- blog area -->
        <div class="blog-area py-120">
            <div class="container">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline"
                            ><i class="far fa-book-open-reader"></i
                        ></span>
                        <h2 class="site-title">
                            News in <span>{{ $category->name }}</span>
                        </h2>
                        <p>
                            Browse all news posts in the
                            {{ $category->name }} category.
                        </p>
                    </div>
                </div>
                <div class="row">
                    @forelse ($news as $new)
                    <div class="col-md-6 col-lg-4">
                        <div
                            class="blog-item wow fadeInUp"
                            data-wow-delay=".25s"
                        >
                            <div class="blog-date">
                                <i class="fal fa-calendar-alt"></i>
                                {{ formattedDate($new->update_at) }}
                            </div>
                            <div class="blog-item-img">
                                <img
                                    src="{{ asset('storage/' . $new->banner) }}"
                                    alt="Thumb"
                                />
                            </div>
                            <div class="blog-item-info">
                                <div class="blog-item-meta">
                                    <ul>
                                        <li>
                                            <a href="#"
                                                ><i
                                                    class="far fa-user-circle"
                                                ></i>
                                                By Admin</a
                                            >
                                        </li>
                                        <li>
                                            <a
                                                href="{{ route('news.category', ['category' => $new->category->slug]) }}"
                                            >
                                                <i class="far fa-tag"></i>
                                                {{ $new->category->name }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <h4 class="{{ $new->title }}">
                                    <a
                                        href="{{ route('news.single', $new->slug) }}"
                                        >{{ Str::limit(strip_tags($new->content), 60) }}</a
                                    >
                                </h4>
                                <a
                                    class="theme-btn"
                                    href="{{ route('news.single', $new->slug) }}"
                                    >Read More<i
                                        class="fas fa-arrow-right-long"
                                    ></i
                                ></a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <h4>No news posts found in this category.</h4>
                        <p>
                            Check back later for new posts in
                            {{ $category->name }}.
                        </p>
                        <a href="{{ route('news') }}" class="theme-btn"
                            >View All News</a
                        >
                    </div>
                    @endforelse
                </div>

                {{ $news->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
        <!-- blog area end -->
    </main>

