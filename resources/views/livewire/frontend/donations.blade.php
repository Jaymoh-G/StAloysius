
<div>
<div>   @section('content')   <main class="main">
        <!-- breadcrumb -->
        <div
            class="site-breadcrumb"
            style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})"
        >
            <div class="container">
                <h2 class="breadcrumb-title">Make a Donation</h2>
                <ul class="breadcrumb-menu">
                    <li><a href="/">Home</a></li>
                    <li class="active">Donations</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <!-- donation area -->
        <div class="donation-area py-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="site-heading text-center mb-5">
                            <span class="site-title-tagline">
                                <i class="far fa-heart"></i>
                            </span>
                            <h2 class="site-title">
                                Support <span>Our Mission</span>
                            </h2>
                            <p>
                                Your generous donation helps us provide quality
                                education and support to our students. Choose
                                your preferred donation method below.
                            </p>
                        </div>

                        @if (session()->has('donation_success'))
                        <div
                            class="alert alert-success alert-dismissible fade show"
                            role="alert"
                        >
                            <div class="d-flex align-items-center">
                                <i class="far fa-check-circle me-2"></i>
                                <div>
                                    <strong>Success!</strong>
                                    {{ session("donation_success") }}
                                </div>
                            </div>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"
                                aria-label="Close"
                            ></button>
                        </div>
                        @endif @if (session()->has('donation_error'))
                        <div
                            class="alert alert-danger alert-dismissible fade show"
                            role="alert"
                        >
                            <div class="d-flex align-items-center">
                                <i class="far fa-exclamation-triangle me-2"></i>
                                <div>
                                    <strong>Error!</strong>
                                    {{ session("donation_error") }}
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

                        <!-- Payment Details (shown after direct donation selection) -->
                        @if (session()->has('donation_details'))
                        <div class="card shadow mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="far fa-credit-card me-2"></i>
                                    Payment Details
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="payment-info">
                                            <h6 class="text-primary mb-3">
                                                M-Pesa Payment Details:
                                            </h6>
                                            <div class="payment-item mb-2">
                                                <strong>Account Name:</strong>
                                                Christian Life Community
                                            </div>
                                            <div class="payment-item mb-2">
                                                <strong>Paybill Number:</strong>
                                                880100
                                            </div>
                                            <div class="payment-item mb-3">
                                                <strong>Account Number:</strong>
                                                6494410018
                                            </div>
                                            <div class="alert alert-info">
                                                <small>
                                                    <i
                                                        class="far fa-info-circle me-1"
                                                    ></i>
                                                    Please use your name as the
                                                    reference when making the
                                                    payment.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="donation-summary">
                                            <h6 class="text-primary mb-3">
                                                Donation Summary:
                                            </h6>
                                            <div class="summary-item mb-2">
                                                <strong>Amount:</strong> KES
                                                {{
                                                    number_format(
                                                        session(
                                                            "donation_details"
                                                        )["amount"],
                                                        2
                                                    )
                                                }}
                                            </div>
                                            <div class="summary-item mb-2">
                                                <strong>Name:</strong>
                                                {{
                                                    session("donation_details")[
                                                        "name"
                                                    ]
                                                }}
                                            </div>
                                            <div class="summary-item mb-2">
                                                <strong>Email:</strong>
                                                {{
                                                    session("donation_details")[
                                                        "email"
                                                    ]
                                                }}
                                            </div>
                                            @if(session('donation_details')['message'])
                                            <div class="summary-item mb-2">
                                                <strong>Message:</strong>
                                                {{
                                                    session("donation_details")[
                                                        "message"
                                                    ]
                                                }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="card shadow">
                            <div class="card-body p-5">
                                <form wire:submit.prevent="submitDonation">
                                    <!-- Donation Type Selection -->
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <h5 class="mb-3">
                                                Choose Donation Method:
                                            </h5>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div
                                                class="form-check donation-option"
                                            >
                                                <input
                                                    class="form-check-input"
                                                    type="radio"
                                                    wire:model="donationType"
                                                    value="external"
                                                    id="external-donation"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="external-donation"
                                                >
                                                    <div
                                                        class="donation-option-content"
                                                    >
                                                        <i
                                                            class="fas fa-external-link-alt text-primary mb-2"
                                                        ></i>
                                                        <h6>
                                                            External Donation
                                                            Link
                                                        </h6>
                                                        <p class="mb-0">
                                                            Donate through our
                                                            secure external
                                                            payment platform
                                                        </p>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div
                                                class="form-check donation-option"
                                            >
                                                <input
                                                    class="form-check-input"
                                                    type="radio"
                                                    wire:model="donationType"
                                                    value="direct"
                                                    id="direct-donation"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="direct-donation"
                                                >
                                                    <div
                                                        class="donation-option-content"
                                                    >
                                                        <i
                                                            class="fas fa-mobile-alt text-primary mb-2"
                                                        ></i>
                                                        <h6>
                                                            Direct M-Pesa
                                                            Payment
                                                        </h6>
                                                        <p class="mb-0">
                                                            Pay directly to our
                                                            M-Pesa account
                                                        </p>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        @error('donationType')
                                        <div class="col-12">
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                        </div>
                                        @enderror
                                    </div>

                                    <!-- Donation Amount -->
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label
                                                    for="amount"
                                                    class="form-label"
                                                    >Donation Amount (KES)
                                                    *</label
                                                >
                                                <input
                                                    type="number"
                                                    id="amount"
                                                    wire:model="amount"
                                                    class="form-control @error('amount') is-invalid @enderror"
                                                    placeholder="Enter amount"
                                                    min="1"
                                                    step="0.01"
                                                />
                                                @error('amount')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Personal Information -->
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
                                        <div class="col-md-6 mb-4">
                                            <div class="form-group">
                                                <label
                                                    for="phone"
                                                    class="form-label"
                                                    >Phone Number *</label
                                                >
                                                <input
                                                    type="tel"
                                                    id="phone"
                                                    wire:model="phone"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    placeholder="Enter your phone number"
                                                />
                                                @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <div class="form-group">
                                                <label
                                                    for="message"
                                                    class="form-label"
                                                    >Message (Optional)</label
                                                >
                                                <textarea
                                                    id="message"
                                                    wire:model="message"
                                                    class="form-control @error('message') is-invalid @enderror"
                                                    rows="4"
                                                    placeholder="Any additional message or purpose for your donation"
                                                ></textarea>
                                                @error('message')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button
                                                type="submit"
                                                class="theme-btn"
                                                wire:loading.attr="disabled"
                                                wire:target="submitDonation"
                                            >
                                                <span
                                                    wire:loading.remove
                                                    wire:target="submitDonation"
                                                >
                                                    <i
                                                        class="far fa-heart me-2"
                                                    ></i>
                                                    {{
                                                        $donationType ===
                                                        "external"
                                                            ? "Proceed to External Payment"
                                                            : "Submit Donation"
                                                    }}
                                                </span>
                                                <span
                                                    wire:loading
                                                    wire:target="submitDonation"
                                                >
                                                    <i
                                                        class="far fa-spinner fa-spin me-2"
                                                    ></i>
                                                    Processing...
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
        <!-- donation area end -->
    </main>
    @endsection
</div>

<style>
    .donation-option {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 20px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .donation-option:hover {
        border-color: #007bff;
        background-color: #f8f9fa;
    }

    .donation-option
        input[type="radio"]:checked
        + label
        .donation-option-content {
        color: #007bff;
    }

    .donation-option-content {
        text-align: center;
        transition: all 0.3s ease;
    }

    .donation-option-content i {
        font-size: 2rem;
        display: block;
    }

    .payment-info,
    .donation-summary {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #007bff;
    }

    .payment-item,
    .summary-item {
        padding: 8px 0;
        border-bottom: 1px solid #dee2e6;
    }

    .payment-item:last-child,
    .summary-item:last-child {
        border-bottom: none;
    }
</style>
</div>
