<div>
    <div>
        @section('content')
        <main class="main">
            <!-- breadcrumb -->
            <div
                class="site-breadcrumb"
                style="background: url({{
                    asset('assets/img/breadcrumb/01.jpg')
                }})"
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
                                    Your generous donation helps us provide
                                    quality education and support to our
                                    students. Choose your preferred donation
                                    method below.
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
                                    <i
                                        class="far fa-exclamation-triangle me-2"
                                    ></i>
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

                            <!-- Payment Details (shown when direct payment is selected) -->
                            @if ($showPaymentDetails ||
                            session()->has('donation_details'))
                            <div class="payment-banner mb-4">
                                <div class="payment-banner-overlay">
                                    <div class="container">
                                        <div class="row align-items-center">
                                            <div class="col-lg-8">
                                                <div
                                                    class="payment-banner-content"
                                                >
                                                    <h2 class="text-white mb-3">
                                                        <i class="fas fa-credit-card me-2"></i>
                                                        Payment Details
                                                    </h2>
                                                    <div
                                                        class="payment-details-grid"
                                                    >
                                                        <!-- M-Pesa Details -->
                                                        <div
                                                            class="payment-detail-item"
                                                        >
                                                            <div
                                                                class="detail-icon"
                                                            >
                                                                <i
                                                                    class="fas fa-mobile-alt"
                                                                ></i>
                                                            </div>
                                                            <div
                                                                class="detail-content"
                                                            >
                                                                <strong
                                                                    >M-Pesa
                                                                    Paybill:</strong
                                                                >
                                                                <span>{{
                                                                    setting(
                                                                        "mpesa_paybill",
                                                                        "880100"
                                                                    )
                                                                }}</span>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="payment-detail-item"
                                                        >
                                                            <div
                                                                class="detail-icon"
                                                            >
                                                                <i
                                                                    class="fas fa-hashtag"
                                                                ></i>
                                                            </div>
                                                            <div
                                                                class="detail-content"
                                                            >
                                                                <strong
                                                                    >M-Pesa
                                                                    Account:</strong
                                                                >
                                                                <span>{{
                                                                    setting(
                                                                        "mpesa_account_number",
                                                                        "6494410018"
                                                                    )
                                                                }}</span>
                                                            </div>
                                                        </div>
                                                        <!-- Bank Details -->
                                                        @if(setting('bank_name'))
                                                        <div
                                                            class="payment-detail-item"
                                                        >
                                                            <div
                                                                class="detail-icon"
                                                            >
                                                                <i
                                                                    class="fas fa-university"
                                                                ></i>
                                                            </div>
                                                            <div
                                                                class="detail-content"
                                                            >
                                                                <strong
                                                                    >Bank
                                                                    Name:</strong
                                                                >
                                                                <span>{{
                                                                    setting(
                                                                        "bank_name"
                                                                    )
                                                                }}</span>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(setting('bank_account_name'))
                                                        <div
                                                            class="payment-detail-item"
                                                        >
                                                            <div
                                                                class="detail-icon"
                                                            >
                                                                <i
                                                                    class="fas fa-user"
                                                                ></i>
                                                            </div>
                                                            <div
                                                                class="detail-content"
                                                            >
                                                                <strong
                                                                    >Account
                                                                    Name:</strong
                                                                >
                                                                <span>{{
                                                                    setting(
                                                                        "bank_account_name"
                                                                    )
                                                                }}</span>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(setting('bank_account_number'))
                                                        <div
                                                            class="payment-detail-item"
                                                        >
                                                            <div
                                                                class="detail-icon"
                                                            >
                                                                <i
                                                                    class="fas fa-credit-card"
                                                                ></i>
                                                            </div>
                                                            <div
                                                                class="detail-content"
                                                            >
                                                                <strong
                                                                    >Account
                                                                    Number:</strong
                                                                >
                                                                <span>{{
                                                                    setting(
                                                                        "bank_account_number"
                                                                    )
                                                                }}</span>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if(setting('bank_branch'))
                                                        <div
                                                            class="payment-detail-item"
                                                        >
                                                            <div
                                                                class="detail-icon"
                                                            >
                                                                <i
                                                                    class="fas fa-map-marker-alt"
                                                                ></i>
                                                            </div>
                                                            <div
                                                                class="detail-content"
                                                            >
                                                                <strong
                                                                    >Bank
                                                                    Branch:</strong
                                                                >
                                                                <span>{{
                                                                    setting(
                                                                        "bank_branch"
                                                                    )
                                                                }}</span>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div
                                                        class="payment-instructions mt-4"
                                                    >
                                                        <div
                                                            class="alert alert-light"
                                                        >
                                                            <i
                                                                class="fas fa-info-circle me-2"
                                                            ></i>
                                                            <strong
                                                                >Instructions:</strong
                                                            >
                                                            Please use your name
                                                            as the reference
                                                            when making the
                                                            payment.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(session()->has('donation_details'))
                                            <div class="col-lg-4">
                                                <div
                                                    class="donation-summary-card"
                                                >
                                                    <div class="summary-header">
                                                        <h5>
                                                            <i
                                                                class="fas fa-receipt me-2"
                                                            ></i
                                                            >Donation Summary
                                                        </h5>
                                                    </div>
                                                    <div class="summary-body">
                                                        <div
                                                            class="summary-item"
                                                        >
                                                            <span class="label"
                                                                >Amount:</span
                                                            >
                                                            <span class="value"
                                                                >KES
                                                                {{
                                                                    number_format(
                                                                        session(
                                                                            "donation_details"
                                                                        )[
                                                                            "amount"
                                                                        ],
                                                                        2
                                                                    )
                                                                }}</span
                                                            >
                                                        </div>
                                                        <div
                                                            class="summary-item"
                                                        >
                                                            <span class="label"
                                                                >Name:</span
                                                            >
                                                            <span
                                                                class="value"
                                                                >{{
                                                                    session(
                                                                        "donation_details"
                                                                    )["name"]
                                                                }}</span
                                                            >
                                                        </div>
                                                        <div
                                                            class="summary-item"
                                                        >
                                                            <span class="label"
                                                                >Email:</span
                                                            >
                                                            <span
                                                                class="value"
                                                                >{{
                                                                    session(
                                                                        "donation_details"
                                                                    )["email"]
                                                                }}</span
                                                            >
                                                        </div>
                                                        @if(session('donation_details')['message'])
                                                        <div
                                                            class="summary-item"
                                                        >
                                                            <span class="label"
                                                                >Message:</span
                                                            >
                                                            <span
                                                                class="value"
                                                                >{{
                                                                    session(
                                                                        "donation_details"
                                                                    )["message"]
                                                                }}</span
                                                            >
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
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
                                                                External
                                                                Donation Link
                                                            </h6>
                                                            <p class="mb-0">
                                                                Donate through
                                                                our secure
                                                                external payment
                                                                platform
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
                                                                Pay directly to
                                                                our M-Pesa
                                                                account
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
                                                    <div
                                                        class="invalid-feedback"
                                                    >
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
                                                    <div
                                                        class="invalid-feedback"
                                                    >
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
                                                    <div
                                                        class="invalid-feedback"
                                                    >
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
                                                    <div
                                                        class="invalid-feedback"
                                                    >
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
                                                        >Message
                                                        (Optional)</label
                                                    >
                                                    <textarea
                                                        id="message"
                                                        wire:model="message"
                                                        class="form-control @error('message') is-invalid @enderror"
                                                        rows="4"
                                                        placeholder="Any additional message or purpose for your donation"
                                                    ></textarea>
                                                    @error('message')
                                                    <div
                                                        class="invalid-feedback"
                                                    >
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

        /* Payment Banner Styles */
        .payment-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-image: url('{{ asset("assets/img/payment-banner-bg.jpg") }}');
            background-size: cover;
            background-position: center;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            min-height: 300px;
        }

        .payment-banner::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                135deg,
                rgba(102, 126, 234, 0.9) 0%,
                rgba(118, 75, 162, 0.9) 100%
            );
            z-index: 1;
        }

        .payment-banner-overlay {
            position: relative;
            z-index: 2;
            padding: 40px 0;
        }

        .payment-banner-content h2 {
            font-size: 2.5rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .payment-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .payment-detail-item {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .payment-detail-item:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }

        .detail-icon {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .detail-icon i {
            font-size: 1.5rem;
            color: white;
        }

        .detail-content {
            color: white;
        }

        .detail-content strong {
            display: block;
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 5px;
        }

        .detail-content span {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .payment-instructions .alert {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 10px;
            color: #333;
        }

        /* Donation Summary Card */
        .donation-summary-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .summary-header {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .summary-header h5 {
            margin: 0;
            font-weight: 600;
        }

        .summary-body {
            padding: 25px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-item .label {
            font-weight: 600;
            color: #6c757d;
        }

        .summary-item .value {
            font-weight: 600;
            color: #333;
            text-align: right;
            max-width: 60%;
            word-wrap: break-word;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .payment-banner {
                min-height: auto;
            }

            .payment-banner-content h2 {
                font-size: 2rem;
            }

            .payment-details-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .payment-detail-item {
                padding: 15px;
            }

            .donation-summary-card {
                margin-top: 30px;
            }
        }

        /* Fallback styles for older browsers */
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
