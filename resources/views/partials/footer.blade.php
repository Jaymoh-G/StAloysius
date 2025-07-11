<footer class="footer-area">
    <div class="footer-shape">
        <img src="{{ asset('assets/img/shape/03.png') }}" alt="" />
    </div>
    <div class="footer-widget">
        <div class="container">
            <div class="row footer-widget-wrapper pt-100 pb-70">
                <div class="col-md-6 col-lg-4">
                    <div class="footer-widget-box about-us">
                        <a href="#" class="footer-logo">
                            @if(setting('footer_logo'))
                            <img
                                src="{{
                                    asset('storage/'.setting('footer_logo'))
                                }}"
                                alt="Footer Logo"
                            />
                            @else
                            <img
                                src="{{ asset('assets/img/logo/als1.png') }}"
                                alt=""
                            />
                            @endif
                        </a>
                        <p class="mb-3">
                            {!! setting('footer_about', 'We are many variations
                            of passages available but the majority') !!}
                        </p>
                        <ul class="footer-contact">
                            @if(setting('phone'))
                            <li>
                                <a href="tel:{{ setting('phone') }}"
                                    ><i class="far fa-phone"></i
                                    >{{ setting("phone") }}</a
                                >
                            </li>
                            @endif @if(setting('address'))
                            <li>
                                @if (setting('google_map'))
                                <a href="{{ setting('google_map') }}" target="_blank">
                                    <i class="far fa-map-marker-alt"></i>
                                    {{ setting("address") }}
                                </a>
                                @else
                                <i class="far fa-map-marker-alt"></i>
                                {{ setting("address") }}
                                @endif
                            </li>
                            @endif @if(setting('email'))
                            <li>
                                <a href="mailto:{{ setting('email') }}"
                                    ><i class="far fa-envelope"></i>
                                    {{ setting("email") }}</a
                                >
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Quick Links</h4>
                        <ul class="footer-list">
                            @php $hasQuickLinks = false; for ($i = 1; $i <= 7;
                            $i++) { if (setting("link_{$i}") &&
                            setting("link_{$i}_url")) { $hasQuickLinks = true;
                            break; } } @endphp @if($hasQuickLinks) @for ($i = 1;
                            $i <= 7; $i++) @php $linkName =
                            setting("link_{$i}"); $linkUrl =
                            setting("link_{$i}_url"); @endphp @if ($linkName &&
                            $linkUrl)
                            <li>
                                <a href="{{ $linkUrl }}"
                                    ><i class="fas fa-caret-right"></i>
                                    {{ $linkName }}</a
                                >
                            </li>
                            @endif @endfor @else
                            <li>
                                <a href="{{ route('home') }}"
                                    ><i class="fas fa-caret-right"></i> Home</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('about-us') }}"
                                    ><i class="fas fa-caret-right"></i> About
                                    Us</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('our-team') }}"
                                    ><i class="fas fa-caret-right"></i> Our
                                    Team</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('departments') }}"
                                    ><i class="fas fa-caret-right"></i>
                                    Departments</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('media-centre') }}"
                                    ><i class="fas fa-caret-right"></i> Media
                                    Centre</a
                                >
                            </li>
                            <li>
                                <a href="{{ setting('student_portal', '#') }}"
                                    ><i class="fas fa-caret-right"></i> Student
                                    Portal</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('contact') }}"
                                    ><i class="fas fa-caret-right"></i> Contact
                                    Us</a
                                >
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Resource Links</h4>
                        <ul class="footer-list">
                            @php $hasResourceLinks = false; for ($i = 1; $i <=
                            7; $i++) { if (setting("resource_link_{$i}") &&
                            setting("resource_link_{$i}_url")) {
                            $hasResourceLinks = true; break; } } @endphp
                            @if($hasResourceLinks) @for ($i = 1; $i <= 7; $i++)
                            @php $linkName = setting("resource_link_{$i}");
                            $linkUrl = setting("resource_link_{$i}_url");
                            @endphp @if ($linkName && $linkUrl)
                            <li>
                                <a href="{{ $linkUrl }}"
                                    ><i class="fas fa-caret-right"></i>
                                    {{ $linkName }}</a
                                >
                            </li>
                            @endif @endfor @else
                            <li>
                                <a href="{{ route('testimonials') }}"
                                    ><i class="fas fa-caret-right"></i>
                                    Testimonials</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('gallery') }}"
                                    ><i class="fas fa-caret-right"></i>
                                    Gallery</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('news') }}"
                                    ><i class="fas fa-caret-right"></i> School
                                    of Hope</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('clc') }}"
                                    ><i class="fas fa-caret-right"></i>
                                    Christian Life Community</a
                                >
                            </li>

                            <li>
                                <a href="{{ route('careers') }}"
                                    ><i class="fas fa-caret-right"></i>
                                    Careers</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('events') }}"
                                    ><i class="fas fa-caret-right"></i>
                                    Events</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('support-us') }}"
                                    ><i class="fas fa-caret-right"></i> Support
                                    Us</a
                                >
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Newsletter</h4>
                        <div class="footer-newsletter">
                            <p>
                                Subscribe Our Newsletter To Get Latest Update
                                And News
                            </p>
                            <div class="subscribe-form">
                                <form action="#">
                                    <input
                                        type="email"
                                        class="form-control"
                                        placeholder="Your Email"
                                    />
                                    <button class="theme-btn" type="submit">
                                        Subscribe Now
                                        <i class="far fa-paper-plane"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="copyright-wrapper">
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <p class="copyright-text">
                            &copy; Copyright <span id="date"></span>
                            <a href="#">
                                St. Aloysius Gonzaga Secondary School
                            </a>
                            All Rights Reserved.
                        </p>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <ul class="footer-social">
                            @if(setting('facebook'))
                            <li>
                                <a
                                    target="_blank"
                                    href="{{ setting('facebook') }}"
                                    ><i class="fab fa-facebook-f"></i
                                ></a>
                            </li>
                            @endif @if(setting('linkedin'))
                            <li>
                                <a
                                    target="_blank"
                                    href="{{ setting('linkedin') }}"
                                    ><i class="fab fa-linkedin-in"></i
                                ></a>
                            </li>
                            @endif @if(setting('instagram'))
                            <li>
                                <a
                                    target="_blank"
                                    href="{{ setting('instagram') }}"
                                    ><i class="fab fa-instagram"></i
                                ></a>
                            </li>
                            @endif @if(setting('whatsapp'))
                            <li>
                                <a
                                    target="_blank"
                                    href="{{ setting('whatsapp') }}"
                                    ><i class="fab fa-whatsapp"></i
                                ></a>
                            </li>
                            @endif @if(setting('youtube'))
                            <li>
                                <a
                                    target="_blank"
                                    href="{{ setting('youtube') }}"
                                    ><i class="fab fa-youtube"></i
                                ></a>
                            </li>
                            @endif
                            @if(setting('twitter'))
                            <li>
                                <a
                                    target="_blank"
                                    href="{{ setting('twitter') }}"
                                    ><i class="fab fa-twitter"></i
                                ></a>
                            </li>
                            @endif
                            @if(setting('tiktok'))
                            <li>
                                <a
                                    target="_blank"
                                    href="{{ setting('tiktok') }}"
                                    ><i class="fab fa-tiktok"></i
                                ></a>
                            </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
