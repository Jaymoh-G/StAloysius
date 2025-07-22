<div>
    <div>
        <main class="main">
            <!-- breadcrumb -->
            <div
                class="site-breadcrumb"
                style="background: url(assets/img/breadcrumb/01.jpg)"
            >
                <div class="container">
                    <h2 class="breadcrumb-title">
                        {{ $pageData->title ?? 'Contact Us' }}
                    </h2>
                    <ul class="breadcrumb-menu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">
                            {{ $pageData->title ?? 'Contact Us' }}
                        </li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb end -->

            <!-- contact area -->
            <div class="contact-area py-120">
                <div class="container">
                    <div class="contact-content">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="contact-info">
                                    <div class="contact-info-icon">
                                        <i class="fal fa-map-location-dot"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <h5>
                                            {{ $pageData->section_1_title ?? 'Office Address' }}
                                        </h5>
                                        <p>
                                            {!! $pageData->section_1_content ??
                                            setting('address', '25/B Milford,
                                            New York, USA') !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="contact-info">
                                    <div class="contact-info-icon">
                                        <i class="fal fa-phone-volume"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <h5>
                                            {{ $pageData->section_2_title ?? 'Call Us' }}
                                        </h5>
                                        <p>
                                            {!! $pageData->section_2_content ??
                                            setting('phone', '+2 123 4565 789')
                                            !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="contact-info">
                                    <div class="contact-info-icon">
                                        <i class="fal fa-envelopes"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <h5>
                                            {{ $pageData->section_3_title ?? 'Email Us' }}
                                        </h5>
                                        <p>
                                            {!! $pageData->section_3_content ??
                                            setting('email', 'info@example.com')
                                            !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="contact-info">
                                    <div class="contact-info-icon">
                                        <i class="fal fa-alarm-clock"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <h5>
                                            {{ $pageData->section_4_title ?? 'Open Time' }}
                                        </h5>
                                        <p>
                                            {!! $pageData->section_4_content ??
                                            setting('office_hours', 'Mon - Sat
                                            (10.00AM - 05.30PM)') !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="contact-wrapper">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="contact-img">
                                    @if($pageData && $pageData->banner_image)
                                    <img
                                        src="{{ asset('storage/' . $pageData->banner_image) }}"
                                        alt="{{ $pageData->title }}"
                                    />
                                    @else
                                    <img
                                        src="assets/img/contact/entrance.jpg"
                                        alt=""
                                    />
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-7 align-self-center">
                                <div class="contact-form">
                                    <div class="contact-form-header">
                                        <h2>
                                            {{ $pageData->section_5_title ?? 'Get In Touch' }}
                                        </h2>
                                        <p>
                                            {!! $pageData->section_5_content ??
                                            'It is a long established fact that
                                            a reader will be distracted by the
                                            readable content of a page
                                            randomised words which don\'t look
                                            even slightly when looking at its
                                            layout.' !!}
                                        </p>
                                    </div>
                                    <form
                                        method="post"
                                        action="{{ route('contact.submit') }}"
                                        id="contact-form"
                                    >
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="name"
                                                        placeholder="Your Name"
                                                        required
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input
                                                        type="email"
                                                        class="form-control"
                                                        name="email"
                                                        placeholder="Your Email"
                                                        required
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="subject"
                                                placeholder="Your Subject"
                                                required
                                            />
                                        </div>
                                        <div class="form-group">
                                            <textarea
                                                name="message"
                                                cols="30"
                                                rows="5"
                                                class="form-control"
                                                placeholder="Write Your Message"
                                            ></textarea>
                                        </div>
                                        <div class="form-group mt-3">
                                            <div
                                                id="cf-turnstile-contact"
                                                class="cf-turnstile"
                                                data-sitekey="{{ config('services.turnstile.sitekey') }}"
                                                data-callback="onTurnstileSuccessContact"
                                            ></div>
                                            <input type="hidden" name="turnstile_token" id="turnstile_token_contact" />
                                            <div class="invalid-feedback d-block" id="turnstile-error-contact" style="display:none;">Please complete the CAPTCHA.</div>
                                        </div>
                                        <button type="submit" class="theme-btn">
                                            Send Message
                                            <i class="far fa-paper-plane"></i>
                                        </button>
                                        <div class="col-md-12 mt-3">
                                            <div
                                                class="form-messege text-success"
                                            ></div>
                                        </div>
                                    </form>
                                    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
                                    <script>
                                        function onTurnstileSuccessContact(token) {
                                            document.getElementById('turnstile_token_contact').value = token;
                                            document.getElementById('turnstile-error-contact').style.display = 'none';
                                        }
                                        document
                                            .getElementById("contact-form")
                                            .addEventListener(
                                                "submit",
                                                function (e) {
                                                    const token = document.getElementById('turnstile_token_contact').value;
                                                    if (!token) {
                                                        e.preventDefault();
                                                        document.getElementById('turnstile-error-contact').style.display = '';
                                                        return;
                                                    }
                                                    e.preventDefault();

                                                    const form = this;
                                                    const submitBtn =
                                                        form.querySelector(
                                                            'button[type="submit"]'
                                                        );
                                                    const messageDiv =
                                                        form.querySelector(
                                                            ".form-messege"
                                                        );

                                                    // Disable submit button and show loading state
                                                    submitBtn.disabled = true;
                                                    submitBtn.innerHTML =
                                                        'Sending... <i class="far fa-spinner fa-spin"></i>';

                                                    // Get form data
                                                    const formData =
                                                        new FormData(form);

                                                    // Get CSRF token from meta tag or form input
                                                    let csrfToken = '';
                                                    const metaTag = document.querySelector('meta[name="csrf-token"]');
                                                    if (metaTag) {
                                                        csrfToken = metaTag.getAttribute('content');
                                                    } else {
                                                        // Fallback: get from form input if meta tag is not found
                                                        const csrfInput = form.querySelector('input[name="_token"]');
                                                        if (csrfInput) {
                                                            csrfToken = csrfInput.value;
                                                        }
                                                    }

                                                    // Send AJAX request
                                                    fetch(form.action, {
                                                        method: "POST",
                                                        body: formData,
                                                        headers: {
                                                            "X-Requested-With":
                                                                "XMLHttpRequest",
                                                            "X-CSRF-TOKEN": csrfToken,
                                                        },
                                                    })
                                                        .then((response) => {
                                                            // Check if response is JSON
                                                            const contentType = response.headers.get('content-type');
                                                            if (contentType && contentType.includes('application/json')) {
                                                                return response.json();
                                                            } else {
                                                                throw new Error('Invalid response format');
                                                            }
                                                        })
                                                        .then((data) => {
                                                            if (data.success) {
                                                                messageDiv.innerHTML =
                                                                    '<div class="alert alert-success">' +
                                                                    data.message +
                                                                    "</div>";
                                                                form.reset();
                                                            } else {
                                                                messageDiv.innerHTML =
                                                                    '<div class="alert alert-danger">' +
                                                                    data.message +
                                                                    "</div>";
                                                            }
                                                        })
                                                        .catch((error) => {
                                                            console.error('Error:', error);
                                                            messageDiv.innerHTML =
                                                                '<div class="alert alert-danger">An error occurred. Please try again.</div>';
                                                        })
                                                        .finally(() => {
                                                            // Re-enable submit button
                                                            submitBtn.disabled = false;
                                                            submitBtn.innerHTML =
                                                                'Send Message <i class="far fa-paper-plane"></i>';
                                                        });
                                                }
                                            );
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end contact area -->

            <!-- map -->
            <div class="contact-map">
                @if($pageData && $pageData->section_6_content) {!!
                $pageData->section_6_content !!} @else
             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d249.29735271112068!2d36.78364995635742!3d-1.321180820937438!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f1b90e87d30f7%3A0x38921a7a009a91ee!2sSt.%20Aloysius%20Gonzaga%20Secondary%20School!5e0!3m2!1sen!2ske!4v1753067850826!5m2!1sen!2ske" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>="lazy"
                ></iframe>
                @endif
            </div>
        </main>
    </div>
</div>
