<div>
    @section('content')
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
        <!-- breadcrumb end -->

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
                                difference in the lives of our students. Share
                                your skills, knowledge, and time to help us
                                create a better learning environment.
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
                                    <strong>Error!</strong>
                                    {{ session("error") }}
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

                        <!-- Debug Info (remove in production) -->
                        @if(app()->environment('local'))
                        <div class="alert alert-info mb-3">
                            <strong>Debug Info:</strong><br />
                            Name: {{ $name }}<br />
                            Email: {{ $email }}<br />
                            Tel: {{ $tel }}<br />
                            Skills: {{ Str::limit($skills, 50) }}
                        </div>
                        @endif

                        <div class="card shadow">
                            <div class="card-body p-5">
                                <form
                                    wire:submit.prevent="submitApplication"
                                    id="volunteer-form"
                                >
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label
                                                    for="name"
                                                    class="form-label"
                                                    >Full Name *</label
                                                >
                                                <input
                                                    type="text"
                                                    id="name"
                                                    wire:model="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="Enter your full name"
                                                />
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label
                                                    for="tel"
                                                    class="form-label"
                                                    >Telephone Number *</label
                                                >
                                                <input
                                                    type="tel"
                                                    id="tel"
                                                    wire:model="tel"
                                                    class="form-control @error('tel') is-invalid @enderror"
                                                    placeholder="Enter your phone number"
                                                />
                                                @error('tel')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <div class="form-group">
                                                <label
                                                    for="email"
                                                    class="form-label"
                                                    >Email Address *</label
                                                >
                                                <input
                                                    type="email"
                                                    id="email"
                                                    wire:model="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Enter your email address"
                                                />
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <div class="form-group">
                                                <label
                                                    for="skills"
                                                    class="form-label"
                                                    >Skills & Expertise *</label
                                                >
                                                <textarea
                                                    id="skills"
                                                    wire:model="skills"
                                                    class="form-control @error('skills') is-invalid @enderror"
                                                    rows="4"
                                                    placeholder="Please describe your skills, expertise, and areas where you can contribute (e.g., teaching, mentoring, technical skills, administrative support, etc.)"
                                                ></textarea>
                                                @error('skills')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <div class="form-group">
                                                <label
                                                    for="additional_information"
                                                    class="form-label"
                                                    >Additional
                                                    Information</label
                                                >
                                                <textarea
                                                    id="additional_information"
                                                    wire:model="additional_information"
                                                    class="form-control @error('additional_information') is-invalid @enderror"
                                                    rows="4"
                                                    placeholder="Any additional information about your availability, experience, or specific areas of interest"
                                                ></textarea>
                                                @error('additional_information')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <!-- Test button (remove in production) -->
                                            @if(app()->environment('local'))
                                            <button
                                                type="button"
                                                class="btn btn-secondary mb-3"
                                                wire:click="testMethod"
                                            >
                                                Test Livewire Connection
                                            </button>
                                            @endif

                                            <button
                                                type="submit"
                                                class="theme-btn"
                                                wire:loading.attr="disabled"
                                                wire:target="submitApplication"
                                            >
                                                <span
                                                    wire:loading.remove
                                                    wire:target="submitApplication"
                                                >
                                                    <i
                                                        class="far fa-paper-plane me-2"
                                                    ></i
                                                    >Submit Application
                                                </span>
                                                <span
                                                    wire:loading
                                                    wire:target="submitApplication"
                                                >
                                                    <i
                                                        class="far fa-spinner fa-spin me-2"
                                                    ></i
                                                    >Submitting...
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- volunteer area end -->
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("volunteer-form");
            if (form) {
                form.addEventListener("submit", function (e) {
                    console.log("Form submitted via JavaScript");
                    console.log("Event target:", e.target);
                    console.log("Form action:", e.target.action);
                    console.log("Form method:", e.target.method);

                    // Check if Livewire is handling this
                    if (e.target.hasAttribute("wire:submit.prevent")) {
                        console.log("Livewire submit.prevent found");
                    } else {
                        console.log("No wire:submit.prevent found");
                    }
                });
            }

            // Check if Livewire is loaded
            if (typeof Livewire !== "undefined") {
                console.log("Livewire is loaded");

                // Listen for Livewire events
                Livewire.on("volunteer-submitted", () => {
                    console.log("Volunteer form submitted via Livewire");
                });

                Livewire.on("test-message", (data) => {
                    console.log("Test message received:", data.message);
                    alert("Test method called successfully!");
                });
            } else {
                console.log("Livewire is NOT loaded");
            }
        });
    </script>
    @endsection
</div>
