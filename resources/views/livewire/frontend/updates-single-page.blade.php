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
                                        <div class="blog-details-tags pb-20">
                                            <h5>Tags :</h5>
                                            <ul>
                                                <li><a href="#">Course</a></li>
                                                <li>
                                                    <a href="#">Students</a>
                                                </li>
                                                <li>
                                                    <a href="#">Academics</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="blog-author">
                                        <div class="blog-author-img">
                                            <img
                                                src="assets/img/blog/author.jpg"
                                                alt=""
                                            />
                                        </div>
                                        <div class="author-info">
                                            <h6>Author</h6>
                                            <h3 class="author-name">
                                                Agnes F. Natale
                                            </h3>
                                            <p>
                                                It is a long established fact
                                                that a reader will be distracted
                                                by the abcd readable content of
                                                a page when looking at its
                                                layout that more less.
                                            </p>
                                            <div class="author-social">
                                                <a href="#"
                                                    ><i
                                                        class="fab fa-facebook-f"
                                                    ></i
                                                ></a>
                                                <a href="#"
                                                    ><i
                                                        class="fab fa-linkedin-in"
                                                    ></i
                                                ></a>
                                                <a href="#"
                                                    ><i
                                                        class="fab fa-instagram"
                                                    ></i
                                                ></a>
                                                <a href="#"
                                                    ><i
                                                        class="fab fa-whatsapp"
                                                    ></i
                                                ></a>
                                                <a href="#"
                                                    ><i
                                                        class="fab fa-youtube"
                                                    ></i
                                                ></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-comments">
                                    <h3>Comments (20)</h3>
                                    <div class="blog-comments-wrapper">
                                        <div class="blog-comments-single">
                                            <img
                                                src="assets/img/blog/com-1.jpg"
                                                alt="thumb"
                                            />
                                            <div class="blog-comments-content">
                                                <h5>Kecia A. Parada</h5>
                                                <span
                                                    ><i
                                                        class="far fa-clock"
                                                    ></i>
                                                    June 18, 2024</span
                                                >
                                                <p>
                                                    There are many variations of
                                                    passages the majority have
                                                    suffered in some injected
                                                    humour or randomised words
                                                    which don't look even
                                                    slightly believable.
                                                </p>
                                                <a href="#"
                                                    ><i
                                                        class="far fa-reply"
                                                    ></i>
                                                    Reply</a
                                                >
                                            </div>
                                        </div>
                                        <div
                                            class="blog-comments-single blog-comments-reply"
                                        >
                                            <img
                                                src="assets/img/blog/com-2.jpg"
                                                alt="thumb"
                                            />
                                            <div class="blog-comments-content">
                                                <h5>Thomas A. Lindsey</h5>
                                                <span
                                                    ><i
                                                        class="far fa-clock"
                                                    ></i>
                                                    June 18, 2024</span
                                                >
                                                <p>
                                                    There are many variations of
                                                    passages the majority have
                                                    suffered in some injected
                                                    humour or randomised words
                                                    which don't look even
                                                    slightly believable.
                                                </p>
                                                <a href="#"
                                                    ><i
                                                        class="far fa-reply"
                                                    ></i>
                                                    Reply</a
                                                >
                                            </div>
                                        </div>
                                        <div class="blog-comments-single">
                                            <img
                                                src="assets/img/blog/com-3.jpg"
                                                alt="thumb"
                                            />
                                            <div class="blog-comments-content">
                                                <h5>Mary R. Lujan</h5>
                                                <span
                                                    ><i
                                                        class="far fa-clock"
                                                    ></i>
                                                    June 18, 2024</span
                                                >
                                                <p>
                                                    There are many variations of
                                                    passages the majority have
                                                    suffered in some injected
                                                    humour or randomised words
                                                    which don't look even
                                                    slightly believable.
                                                </p>
                                                <a href="#"
                                                    ><i
                                                        class="far fa-reply"
                                                    ></i>
                                                    Reply</a
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blog-comments-form">
                                        <h3>Leave A Comment</h3>
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="Your Name*"
                                                        />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input
                                                            type="email"
                                                            class="form-control"
                                                            placeholder="Your Email*"
                                                        />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea
                                                            class="form-control"
                                                            rows="5"
                                                            placeholder="Your Comment*"
                                                        ></textarea>
                                                    </div>
                                                    <button
                                                        type="submit"
                                                        class="theme-btn"
                                                    >
                                                        Post Comment
                                                        <i
                                                            class="far fa-paper-plane"
                                                        ></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
                                    <a href="#"
                                        ><i class="fab fa-facebook-f"></i
                                    ></a>
                                    <a href="#"
                                        ><i class="fab fa-linkedin-in"></i
                                    ></a>
                                    <a href="#"
                                        ><i class="fab fa-dribbble"></i
                                    ></a>
                                    <a href="#"
                                        ><i class="fab fa-whatsapp"></i
                                    ></a>
                                    <a href="#"
                                        ><i class="fab fa-youtube"></i
                                    ></a>
                                </div>
                            </div>
                            <!-- Recent Post -->
                            <div class="widget sidebar-tag">
                                <h5 class="widget-title">Popular Tags</h5>
                                <div class="tag-list">
                                    <a href="#">Courses</a>
                                    <a href="#">Students</a>
                                    <a href="#">Tips</a>
                                    <a href="#">Academic</a>
                                    <a href="#">Study</a>
                                    <a href="#">Offer</a>
                                    <a href="#">Online</a>
                                    <a href="#">Knowledge</a>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog single area end -->
    </main>
    @endsection
</div>
