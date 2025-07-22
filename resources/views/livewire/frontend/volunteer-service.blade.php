<main class="main">
    <!-- breadcrumb -->
    <div
        class="site-breadcrumb"
        style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})"
    >
        <div class="container">
            <h2 class="breadcrumb-title">Volunteer Your Service</h2>
            <ul class="breadcrumb-menu">
                <li><a href="/">Home</a></li>
                <li class="active">Volunteer</li>
            </ul>
        </div>
    </div>
    <!-- volunteer area -->
    <div class="volunteer-area py-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="site-heading text-center mb-5">
                        <span class="site-title-tagline"
                            ><i class="far fa-heart"></i
                        ></span>
                        <h2 class="site-title">
                            Impact <span>our students' lives</span>
                        </h2>
                        <p>
                            Join our community of volunteers and make a
                            difference in the lives of our students. Share your
                            skills, knowledge, and time to help us create a
                            better learning environment.
                        </p>
                    </div>

                    @if (session()->has('message'))
                    <div
                        class="alert alert-success alert-dismissible fade show"
                        role="alert"
                    >
                        <div class="d-flex align-items-center">
                            <i class="far fa-check-circle me-2"></i>
                            <div>
                                <strong>Success!</strong>
                                {{ session("message") }}
                            </div>
                        </div>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>
                    </div>
                    @endif @if (session()->has('error'))
                    <div
                        class="alert alert-danger alert-dismissible fade show"
                        role="alert"
                    >
                        <div class="d-flex align-items-center">
                            <i class="far fa-exclamation-triangle me-2"></i>
                            <div>
                                <strong>Error!</strong> {{ session("error") }}
                            </div>
                        </div>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>
                    </div>
                    @endif

                    <div class="card shadow">
                        <div class="card-body p-5">
                            <form
                                method="post"
                                action="{{ route('volunteer.submit') }}"
                                id="volunteer-form"
                            >
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="name" class="form-label"
                                            >Full Name *</label
                                        >
                                        <input
                                            type="text"
                                            id="name"
                                            name="name"
                                            class="form-control"
                                            placeholder="Enter your full name"
                                            required
                                        />
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="tel" class="form-label"
                                            >Telephone Number *</label
                                        >
                                        <input
                                            type="tel"
                                            id="tel"
                                            name="tel"
                                            class="form-control"
                                            placeholder="Enter your phone number"
                                            required
                                        />
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label for="email" class="form-label"
                                            >Email Address *</label
                                        >
                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            class="form-control"
                                            placeholder="Enter your email address"
                                            required
                                        />
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label for="skills" class="form-label"
                                            >Skills & Expertise *</label
                                        >
                                        <textarea
                                            id="skills"
                                            name="skills"
                                            class="form-control"
                                            rows="4"
                                            placeholder="Please describe your skills..."
                                            required
                                        ></textarea>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label
                                            for="additional_information"
                                            class="form-label"
                                            >Additional Information</label
                                        >
                                        <textarea
                                            id="additional_information"
                                            name="additional_information"
                                            class="form-control"
                                            rows="4"
                                            placeholder="Any availability, experience, or interests"
                                        ></textarea>
                                    </div>
                                    <div class="form-group mt-3">
                                        <div
                                            id="cf-turnstile-volunteer"
                                            class="cf-turnstile"
                                            data-sitekey="{{
                                                config(
                                                    'services.turnstile.sitekey'
                                                )
                                            }}"
                                            data-callback="onTurnstileSuccessVolunteer"
                                        ></div>
                                        <input
                                            type="hidden"
                                            name="turnstile_token"
                                            id="turnstile_token_volunteer"
                                        />
                                        <div
                                            class="invalid-feedback d-block"
                                            id="turnstile-error-volunteer"
                                            style="display: none"
                                        >
                                            Please complete the CAPTCHA.
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="theme-btn">
                                            <i
                                                class="far fa-paper-plane me-2"
                                            ></i
                                            >Submit Application
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="mt-3">
                                <div id="volunteer-form-message"></div>
                            </div>

                            <script>
                                function onTurnstileSuccessVolunteer(token) {
                                    document.getElementById(
                                        "turnstile_token_volunteer"
                                    ).value = token;
                                    document.getElementById(
                                        "turnstile-error-volunteer"
                                    ).style.display = "none";
                                }

                                document
                                    .getElementById("volunteer-form")
                                    .addEventListener("submit", function (e) {
                                        const token = document.getElementById(
                                            "turnstile_token_volunteer"
                                        ).value;

                                        if (!token) {
                                            e.preventDefault();
                                            document.getElementById(
                                                "turnstile-error-volunteer"
                                            ).style.display = "";
                                            return;
                                        }

                                        e.preventDefault();

                                        const form = this;
                                        const submitBtn = form.querySelector(
                                            'button[type="submit"]'
                                        );
                                        const messageDiv =
                                            document.getElementById(
                                                "volunteer-form-message"
                                            );

                                        submitBtn.disabled = true;
                                        submitBtn.innerHTML =
                                            '<i class="far fa-spinner fa-spin me-2"></i>Submitting...';

                                        const formData = new FormData(form);

                                        fetch(form.action, {
                                            method: "POST",
                                            body: formData,
                                            headers: {
                                                "X-Requested-With":
                                                    "XMLHttpRequest",
                                            },
                                        })
                                            .then((response) => response.json())
                                            .then((data) => {
                                                if (data.success) {
                                                    messageDiv.innerHTML =
                                                        '<div class="alert alert-success alert-dismissible fade show" role="alert"><div class="d-flex align-items-center"><i class="far fa-check-circle me-2"></i><div><strong>Success!</strong> ' +
                                                        data.message +
                                                        '</div></div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                                    form.reset();
                                                } else {
                                                    messageDiv.innerHTML =
                                                        '<div class="alert alert-danger alert-dismissible fade show" role="alert"><div class="d-flex align-items-center"><i class="far fa-exclamation-triangle me-2"></i><div><strong>Error!</strong> ' +
                                                        data.message +
                                                        '</div></div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                                }
                                            })
                                            .catch(() => {
                                                messageDiv.innerHTML =
                                                    '<div class="alert alert-danger alert-dismissible fade show" role="alert"><div class="d-flex align-items-center"><i class="far fa-exclamation-triangle me-2"></i><div><strong>Error!</strong> An error occurred. Please try again.</div></div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                            })
                                            .finally(() => {
                                                submitBtn.disabled = false;
                                                submitBtn.innerHTML =
                                                    '<i class="far fa-paper-plane me-2"></i>Submit Application';
                                            });
                                    });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script
    src="https://challenges.cloudflare.com/turnstile/v0/api.js"
    async
    defer
></script>
