<div>
    @section('content')
    <main class="main">
        <!-- breadcrumb -->
        <div
            class="site-breadcrumb"
            style="background: url('{{ asset('storage/' . $blog->banner) }}')"
        >
            <div class="container">
                <h2 class="breadcrumb-title">{{ $blog->title }}</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="/">Home</a></li>
                    <li class="active">{{ $blog->title }}</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- blog single area -->
        <div class="blog-single-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-single-wrapper">
                            <div class="blog-single-content">
                                @if ($blog->featuredImage)
                                <div class="blog-thumb-img">
                                    <img
                                        src="{{ asset('storage/' . $blog->featuredImage->path) }}"
                                        alt="thumb"
                                    />
                                </div>
                                @else
                                <p>No featured image available.</p>
                                @endif
                                <div class="blog-info">
                                    <div class="blog-meta">
                                        <div class="blog-meta-left">
                                            <ul>
                                                <li>
                                                    <i class="far fa-user"></i
                                                    ><a href="#"
                                                        >Jean R Gunter</a
                                                    >
                                                </li>
                                                <li>
                                                    Category:
                                                    {{ $blog->category->name ?? 'Uncategorized' }}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="blog-meta-right">
                                            <a href="#" class="share-link"
                                                ><i class="far fa-share-alt"></i
                                                >Share</a
                                            >
                                        </div>
                                    </div>
                                    <div class="blog-details">
                                        <h3 class="blog-details-title mb-20">
                                            {{ $blog->title }}
                                        </h3>
                                        <p class="mb-10">
                                            {!! $blog->paragraph1 !!}
                                        </p>
                                        <p class="mb-10">
                                            {!! $blog->paragraph2 !!}
                                        </p>
                                        <p class="mb-20">
                                            {!! $blog->paragraph3 !!}
                                        </p>
                                        <p class="mb-20">
                                            {!! $blog->paragraph4 !!}
                                        </p>
                                        <div class="row">
                                            @if ($blog->images->count() > 1)
                                            <div class="col-md-6 mb-20">
                                                <img
                                                    src="{{ asset('storage/' . $blog->images[1]->path) }}"
                                                    alt="{{$blog->images[1]->name}}"
                                                />
                                            </div>
                                            @endif @if ($blog->images->count() >
                                            2)
                                            <div class="col-md-6 mb-20">
                                                <img
                                                    src="{{ asset('storage/' . $blog->images[2]->path) }}"
                                                    alt=""
                                                />
                                            </div>
                                            @endif
                                        </div>

                                        <p class="mb-20">
                                            {!! $blog->paragraph5 !!}
                                        </p>
                                        <p class="mb-20">
                                            {!! $blog->paragraph6 !!}
                                        </p>
                                        <p class="mb-20">
                                            {!! $blog->paragraph7 !!}
                                        </p>
                                        <p class="mb-20">
                                            {!! $blog->paragraph8 !!}
                                        </p>
                                        <div class="row">
                                            @if ($blog->images->count() > 3)
                                            <div class="col-md-6 mb-20">
                                                <img
                                                    src="{{ asset('storage/' . $blog->images[3]->path) }}"
                                                    alt="{{$blog->images[1]->name}}"
                                                />
                                            </div>
                                            @endif @if ($blog->images->count() >
                                            4)
                                            <div class="col-md-6 mb-20">
                                                <img
                                                    src="{{ asset('storage/' . $blog->images[4]->path) }}"
                                                    alt=""
                                                />
                                            </div>
                                            @endif
                                        </div>

                                        @for ($i = 9; $i <= 21; $i++) @php
                                        $paragraph = $blog->{'paragraph' . $i};
                                        @endphp @if (!empty($paragraph))
                                        <div class="mb-4">
                                            {!! $paragraph !!}
                                        </div>
                                        @endif @endfor
                                        <hr />
                                        
                                    </div>

                                </div>
                                @livewire('frontend.blog-comments', ['blogPost'
                                => $blog])
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <aside class="sidebar">
                            <!-- search-->
                            <div class="widget search">
                                <h5 class="widget-title">Search</h5>
                                <form class="search-form">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Search Here..."
                                    />
                                    <button type="submit">
                                        <i class="far fa-search"></i>
                                    </button>
                                </form>
                            </div>
                            <!-- category -->
                            <div class="widget category">
                                <h5 class="widget-title">Category</h5>
                                @foreach ($categories as $category)
                                <div class="category-list">
                                    <a href="#"
                                        ><i class="far fa-arrow-right"></i>
                                        {{ $category->name



                                        }}<span
                                            >({{ $category->blog_posts_count



                                            }})</span
                                        ></a
                                    >
                                </div>
                                @endforeach
                            </div>
                            <!-- recent post -->
                            <div class="widget recent-post">
                                <h5 class="widget-title">Recent Post</h5>
                                @foreach ($recentPosts as $post)
                                <div class="recent-post-single">
                                    <div class="recent-post-img">
                                        <img
                                            src="{{ asset('storage/' .  $post->images[0]->path) }}"
                                            alt="thumb"
                                        />
                                    </div>
                                    <div class="recent-post-bio">
                                        <h6>
                                            <a href="#">{{ $post->title }}</a>
                                        </h6>
                                        <span
                                            ><i class="far fa-clock"></i
                                            >{{ $post->created_at->format('M d, Y') }}</span
                                        >
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- social share -->
                            <div class="widget social-share">
                                <h5 class="widget-title">Follow Us</h5>
                                <div class="social-share-link">
                                    @if(setting('facebook'))
                                    <a
                                        href="{{ setting('facebook') }}"
                                        target="_blank"
                                        ><i class="fab fa-facebook-f"></i
                                    ></a>
                                    @endif @if(setting('linkedin'))
                                    <a
                                        href="{{ setting('linkedin') }}"
                                        target="_blank"
                                        ><i class="fab fa-linkedin-in"></i
                                    ></a>
                                    @endif @if(setting('instagram'))
                                    <a
                                        href="{{ setting('instagram') }}"
                                        target="_blank"
                                        ><i class="fab fa-instagram"></i
                                    ></a>
                                    @endif @if(setting('whatsapp'))
                                    <a
                                        href="{{ setting('whatsapp') }}"
                                        target="_blank"
                                        ><i class="fab fa-whatsapp"></i
                                    ></a>
                                    @endif @if(setting('youtube'))
                                    <a
                                        href="{{ setting('youtube') }}"
                                        target="_blank"
                                        ><i class="fab fa-youtube"></i
                                    ></a>
                                    @endif @if(setting('twitter'))
                                    <a
                                        href="{{ setting('twitter') }}"
                                        target="_blank"
                                        ><i class="fab fa-twitter"></i
                                    ></a>
                                    @endif @if(setting('tiktok'))
                                    <a
                                        href="{{ setting('tiktok') }}"
                                        target="_blank"
                                        ><i class="fab fa-tiktok"></i
                                    ></a>
                                    @endif
                                </div>
                            </div>
                            <!-- Recent Post -->
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog single area end -->
    </main>
    @endsection
</div>
