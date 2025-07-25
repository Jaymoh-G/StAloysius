<div
    x-data
    @turnstile-success.window="window.Livewire.find($root.getAttribute('wire:id')).set('turnstile_token', $event.detail)"
>
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
                <div class="col-lg-12">
                    <div class="site-heading text-center mb-5">
                        <span class="site-title-tagline">
                            <i class="far fa-heart"></i>
                        </span>
                        <h2 class="site-title">
                            Support <span>Our Mission</span>
                        </h2>
                        <p>
                            Your generous donation helps us provide quality
                            education and support to our students. Choose your
                            preferred donation method below.
                        </p>
                    </div>

                    <!-- Donation Options -->
                    <div class="row g-4 align-items-stretch">
                        <!-- Left: Donation Options -->
                        <div class="col-md-5 col-lg-2">
                            <div
                                class="donation-options h-100 d-flex flex-column gap-4"
                            >
                                <!-- M-Pesa Payment Option -->
                                <div
                                    class="donation-option-card {{
                                        $selectedOption === 'direct'
                                            ? 'selected'
                                            : ''
                                    }}"
                                    wire:click="selectOption('direct')"
                                    style="cursor: pointer"
                                >
                                    <div class="option-icon">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                    <div class="option-content">
                                        <h4>M-Pesa Donation</h4>
                                        <p>
                                            Donate directly via M-Pesa Paybill
                                        </p>
                                    </div>
                                    <div class="option-arrow">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </div>
                                <!-- Online Donation Option -->
                                <div
                                    class="donation-option-card {{
                                        $selectedOption === 'external'
                                            ? 'selected'
                                            : ''
                                    }}"
                                    wire:click="selectOption('external')"
                                    style="cursor: pointer"
                                >
                                    <div class="option-icon">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                    <div class="option-content">
                                        <h4>Online Donation</h4>
                                        <p>
                                            Donate securely through our online
                                            platform
                                        </p>
                                    </div>
                                    <div class="option-arrow">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Right: Banner for Selected Option -->
                        <div class="col-md-7 col-lg-10">
                            @if ($selectedOption === 'direct')
                            <!-- M-Pesa Payment Banner -->
                            <div class="mpesa-payment-banner mb-4">
                                <div class="banner-overlay">
                                    <div class="container">
                                        <div class="row align-items-center">
                                            <div class="col-lg-8">
                                                <div class="banner-content">
                                                    <div class="banner-header">
                                                        <div class="mpesa-logo">
                                                            <i
                                                                class="fas fa-mobile-alt"
                                                            ></i>
                                                        </div>
                                                        <div
                                                            class="header-text"
                                                        >
                                                            <h2>
                                                                M-Pesa Payment
                                                            </h2>
                                                            <p>
                                                                Quick and secure
                                                                mobile money
                                                                transfer
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="payment-instructions"
                                                    >
                                                        <h4>
                                                            How to Pay:
                                                            <span
                                                                class="text-muted"
                                                                >Go to M-Pesa
                                                                Menu</span
                                                            >
                                                        </h4>

                                                        <ol>
                                                            <li>
                                                                Select "Pay
                                                                Bill"
                                                            </li>
                                                            <li>
                                                                Paybill Number:
                                                                <strong>{{
                                                                    setting(
                                                                        "mpesa_paybill",
                                                                        "880100"
                                                                    )
                                                                }}</strong>
                                                            </li>
                                                            <li>
                                                                Account Number:
                                                                <strong>{{
                                                                    setting(
                                                                        "bank_account_number",
                                                                        "6494410018"
                                                                    )
                                                                }}</strong>
                                                            </li>
                                                            <li>
                                                                Enter Amount:
                                                            </li>
                                                            <li>
                                                                Enter your
                                                                M-Pesa PIN and
                                                                confirm payment
                                                            </li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div
                                                    class="payment-details-card"
                                                >
                                                    <div class="card-header">
                                                        <h5>
                                                            <i
                                                                class="fas fa-info-circle"
                                                            ></i>
                                                            Payment Details
                                                        </h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="detail-row">
                                                            <span class="label"
                                                                >Paybill
                                                                Number:</span
                                                            >
                                                            <span
                                                                class="value"
                                                                >{{
                                                                    setting(
                                                                        "mpesa_paybill",
                                                                        "880100"
                                                                    )
                                                                }}</span
                                                            >
                                                        </div>
                                                        <div class="detail-row">
                                                            <span class="label"
                                                                >Account
                                                                Number:</span
                                                            >
                                                            <span
                                                                class="value"
                                                                >{{
                                                                    setting(
                                                                        "bank_account_number",
                                                                        "6494410018"
                                                                    )
                                                                }}</span
                                                            >
                                                        </div>
                                                        <div class="detail-row">
                                                            <span class="label"
                                                                >Account
                                                                Name:</span
                                                            >
                                                            <span
                                                                class="value"
                                                                >{{
                                                                    setting(
                                                                        "bank_account_name",
                                                                        "St Aloysius Gonzaga"
                                                                    )
                                                                }}</span
                                                            >
                                                        </div>
                                                        <div class="detail-row">
                                                            <span class="label"
                                                                >Bank
                                                                Name:</span
                                                            >
                                                            <span
                                                                class="value"
                                                                >{{
                                                                    setting(
                                                                        "bank_name",
                                                                        "Bank"
                                                                    )
                                                                }}</span
                                                            >
                                                        </div>
                                                        <div
                                                            class="detail-row highlight"
                                                        >
                                                            <span class="label"
                                                                >Amount:</span
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Donor Information Form inside the banner -->
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div class="card shadow">
                                                    <div class="card-body p-5">
                                                        <div
                                                            class="text-center mb-4"
                                                        >
                                                            <h4>
                                                                <i
                                                                    class="fas fa-user-edit"
                                                                ></i>
                                                                Donor
                                                                Information
                                                            </h4>
                                                            <p
                                                                class="text-muted"
                                                            >
                                                                Please provide
                                                                your details for
                                                                our records
                                                            </p>
                                                        </div>
                                                        <form
                                                            wire:submit.prevent="submitDonation"
                                                            x-data
                                                            @turnstile-success.window="window.Livewire.find($root.getAttribute('wire:id')).set('turnstile_token', $event.detail)"
                                                        >
                                                            <div class="row">
                                                                <div
                                                                    class="col-md-6"
                                                                >
                                                                    <div
                                                                        class="form-group mb-3"
                                                                    >
                                                                        <label
                                                                            for="donorName"
                                                                            class="form-label"
                                                                            >Full
                                                                            Name
                                                                            *</label
                                                                        >
                                                                        <input
                                                                            type="text"
                                                                            id="donorName"
                                                                            wire:model="donorName"
                                                                            class="form-control @error('donorName') is-invalid @enderror"
                                                                            placeholder="Enter your full name"
                                                                            required
                                                                        />
                                                                        @error('donorName')
                                                                        <div
                                                                            class="invalid-feedback"
                                                                        >
                                                                            {{
                                                                                $message
                                                                            }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-md-6"
                                                                >
                                                                    <div
                                                                        class="form-group mb-3"
                                                                    >
                                                                        <label
                                                                            for="email"
                                                                            class="form-label"
                                                                            >Email
                                                                            Address
                                                                            *</label
                                                                        >
                                                                        <input
                                                                            type="email"
                                                                            id="email"
                                                                            wire:model="email"
                                                                            class="form-control @error('email') is-invalid @enderror"
                                                                            placeholder="Enter your email address"
                                                                            required
                                                                        />
                                                                        @error('email')
                                                                        <div
                                                                            class="invalid-feedback"
                                                                        >
                                                                            {{
                                                                                $message
                                                                            }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div
                                                                    class="col-md-6"
                                                                >
                                                                    <div
                                                                        class="form-group mb-3"
                                                                    >
                                                                        <label
                                                                            for="phone"
                                                                            class="form-label"
                                                                            >Phone
                                                                            Number</label
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
                                                                            {{
                                                                                $message
                                                                            }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-md-6"
                                                                >
                                                                    <div
                                                                        class="form-group mb-3"
                                                                    >
                                                                        <label
                                                                            for="amount"
                                                                            class="form-label"
                                                                            >Donation
                                                                            Amount
                                                                            (KES)
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
                                                                            required
                                                                        />
                                                                        @error('amount')
                                                                        <div
                                                                            class="invalid-feedback"
                                                                        >
                                                                            {{
                                                                                $message
                                                                            }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="form-group mb-3"
                                                            >
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
                                                                    placeholder="Any additional message or dedication..."
                                                                ></textarea>
                                                                @error('message')
                                                                <div
                                                                    class="invalid-feedback"
                                                                >
                                                                    {{
                                                                        $message
                                                                    }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div
                                                                class="form-group mt-3"
                                                            >
                                                                <div
                                                                    id="cf-turnstile-donation"
                                                                    class="cf-turnstile"
                                                                    data-sitekey="{{
                                                                        config(
                                                                            'services.turnstile.sitekey'
                                                                        )
                                                                    }}"
                                                                    data-callback="onTurnstileSuccess"
                                                                ></div>
                                                                @error('turnstile_token')
                                                                <div
                                                                    class="invalid-feedback d-block"
                                                                >
                                                                    {{
                                                                        $message
                                                                    }}
                                                                </div>
                                                                @enderror
                                                            </div>

                                                            <div
                                                                class="text-center"
                                                            >
                                                                <button
                                                                    type="submit"
                                                                    class="theme-btn btn-lg"
                                                                    wire:loading.attr="disabled"
                                                                    wire:target="submitDonation"
                                                                >
                                                                    <span
                                                                        wire:loading.remove
                                                                        wire:target="submitDonation"
                                                                    >
                                                                        <i
                                                                            class="fas fa-mobile-alt"
                                                                        ></i>
                                                                        Submit
                                                                        M-Pesa
                                                                        Donation
                                                                        Information
                                                                    </span>
                                                                    <span
                                                                        wire:loading
                                                                        wire:target="submitDonation"
                                                                    >
                                                                        <i
                                                                            class="fas fa-spinner fa-spin"
                                                                        ></i>
                                                                        Processing...
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif ($selectedOption === 'external')
                                <!-- Online Donation Banner -->
                                <div class="external-donation-banner mb-4">
                                    <div class="banner-overlay">
                                        <div class="container">
                                            <div class="row align-items-center">
                                                <div class="col-lg-8">
                                                    <div class="banner-content">
                                                        <div
                                                            class="banner-header"
                                                        >
                                                            <div
                                                                class="external-logo"
                                                            >
                                                                <i
                                                                    class="fas fa-globe"
                                                                ></i>
                                                            </div>
                                                            <div
                                                                class="header-text"
                                                            >
                                                                <h2>
                                                                    Online
                                                                    Donation
                                                                </h2>
                                                                <p>
                                                                    Donate via School of Hope Website
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div
                                                        class="external-link-card"
                                                    >
                                                        <div
                                                            class="card-header"
                                                        >
                                                            <h5>
                                                                <i
                                                                    class="fas fa-external-link-alt"
                                                                ></i>
                                                                Proceed to
                                                                Donation
                                                            </h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <p>
                                                                Click the button
                                                                below to be
                                                                redirected to
                                                                our secure
                                                                donation
                                                                platform.
                                                            </p>
                                                            <a
                                                                href="{{
                                                                    setting(
                                                                        'donation_external_link',
                                                                        '#'
                                                                    )
                                                                }}"
                                                                target="_blank"
                                                                class="btn btn-primary btn-lg w-100"
                                                            >
                                                                <i
                                                                    class="fas fa-external-link-alt"
                                                                ></i>
                                                                Click here to donate
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Donor Information Form inside the banner -->
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div class="card shadow">
                                                    <div class="card-body p-5">
                                                        <div
                                                            class="text-center mb-4"
                                                        >
                                                            <h4>
                                                                <i
                                                                    class="fas fa-user-edit"
                                                                ></i>
                                                                Donor
                                                                Information
                                                            </h4>
                                                            <p
                                                                class="text-muted"
                                                            >
                                                                Please provide
                                                                your details for
                                                                our records
                                                            </p>
                                                        </div>
                                                        <form
                                                            wire:submit.prevent="submitDonation"
                                                            x-data
                                                            @turnstile-success.window="window.Livewire.find($root.getAttribute('wire:id')).set('turnstile_token', $event.detail)"
                                                        >
                                                            <div class="row">
                                                                <div
                                                                    class="col-md-6"
                                                                >
                                                                    <div
                                                                        class="form-group mb-3"
                                                                    >
                                                                        <label
                                                                            for="donorName"
                                                                            class="form-label"
                                                                            >Full
                                                                            Name
                                                                            *</label
                                                                        >
                                                                        <input
                                                                            type="text"
                                                                            id="donorName"
                                                                            wire:model="donorName"
                                                                            class="form-control @error('donorName') is-invalid @enderror"
                                                                            placeholder="Enter your full name"
                                                                            required
                                                                        />
                                                                        @error('donorName')
                                                                        <div
                                                                            class="invalid-feedback"
                                                                        >
                                                                            {{
                                                                                $message
                                                                            }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-md-6"
                                                                >
                                                                    <div
                                                                        class="form-group mb-3"
                                                                    >
                                                                        <label
                                                                            for="email"
                                                                            class="form-label"
                                                                            >Email
                                                                            Address
                                                                            *</label
                                                                        >
                                                                        <input
                                                                            type="email"
                                                                            id="email"
                                                                            wire:model="email"
                                                                            class="form-control @error('email') is-invalid @enderror"
                                                                            placeholder="Enter your email address"
                                                                            required
                                                                        />
                                                                        @error('email')
                                                                        <div
                                                                            class="invalid-feedback"
                                                                        >
                                                                            {{
                                                                                $message
                                                                            }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div
                                                                    class="col-md-6"
                                                                >
                                                                    <div
                                                                        class="form-group mb-3"
                                                                    >
                                                                        <label
                                                                            for="phone"
                                                                            class="form-label"
                                                                            >Phone
                                                                            Number</label
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
                                                                            {{
                                                                                $message
                                                                            }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-md-6"
                                                                >
                                                                    <div
                                                                        class="form-group mb-3"
                                                                    >
                                                                        <label
                                                                            for="amount"
                                                                            class="form-label"
                                                                            >Donation
                                                                            Amount
                                                                            (KES)
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
                                                                            required
                                                                        />
                                                                        @error('amount')
                                                                        <div
                                                                            class="invalid-feedback"
                                                                        >
                                                                            {{
                                                                                $message
                                                                            }}
                                                                        </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="form-group mb-3"
                                                            >
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
                                                                    placeholder="Any additional message or dedication..."
                                                                ></textarea>
                                                                @error('message')
                                                                <div
                                                                    class="invalid-feedback"
                                                                >
                                                                    {{
                                                                        $message
                                                                    }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div
                                                                class="form-group mt-3"
                                                            >
                                                                <div
                                                                    id="cf-turnstile-donation-external"
                                                                    class="cf-turnstile"
                                                                    data-sitekey="{{
                                                                        config(
                                                                            'services.turnstile.sitekey'
                                                                        )
                                                                    }}"
                                                                    data-callback="onTurnstileSuccess"
                                                                ></div>
                                                                @error('turnstile_token')
                                                                <div
                                                                    class="invalid-feedback d-block"
                                                                >
                                                                    {{
                                                                        $message
                                                                    }}
                                                                </div>
                                                                @enderror
                                                            </div>

                                                            <div
                                                                class="text-center"
                                                            >
                                                                <button
                                                                    type="submit"
                                                                    class="theme-btn btn-lg"
                                                                    wire:loading.attr="disabled"
                                                                    wire:target="submitDonation"
                                                                >
                                                                    <span
                                                                        wire:loading.remove
                                                                        wire:target="submitDonation"
                                                                    >
                                                                        <i
                                                                            class="fas fa-globe"
                                                                        ></i>
                                                                        Submit
                                                                        Information
                                                                    </span>
                                                                    <span
                                                                        wire:loading
                                                                        wire:target="submitDonation"
                                                                    >
                                                                        <i
                                                                            class="fas fa-spinner fa-spin"
                                                                        ></i>
                                                                        Processing...
                                                                    </span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="text-center text-muted py-5">
                                    <i
                                        class="fas fa-hand-point-left fa-2x mb-3"
                                    ></i>

                                    <p>
                                        Please select a donation option to see
                                        more details.
                                    </p>
                                </div>
                                @endif
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
                        </div>
                    </div>
                </div>
            </div>
            <!-- donation area end -->

            <style>
                /* Donation Options Styles */
                .donation-option-card {
                    background: white;
                    border-radius: 15px;
                    padding: 30px;
                    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
                    border: 2px solid transparent;
                    transition: all 0.3s ease;
                    position: relative;
                    overflow: hidden;
                }

                .donation-option-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
                    border-color: #007bff;
                }

                .donation-option-card.selected {
                    border-color: #28a745;
                    background: linear-gradient(
                        135deg,
                        #f8fff9 0%,
                        #e8f5e8 100%
                    );
                }

                .option-icon {
                    width: 60px;
                    height: 60px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 20px;
                    font-size: 1.5rem;
                    color: white;
                }

                .donation-option-card:first-child .option-icon {
                    background: linear-gradient(
                        135deg,
                        #28a745 0%,
                        #20c997 100%
                    );
                }

                .donation-option-card:last-child .option-icon {
                    background: linear-gradient(
                        135deg,
                        #667eea 0%,
                        #764ba2 100%
                    );
                }

                .option-content h4 {
                    color: #333;
                    margin-bottom: 10px;
                    font-weight: 600;
                }

                .option-content p {
                    color: #666;
                    margin-bottom: 15px;
                }

                .option-features {
                    display: flex;
                    flex-direction: column;
                    gap: 8px;
                }

                .option-features span {
                    color: #555;
                    font-size: 0.9rem;
                }

                .option-features i {
                    color: #28a745;
                    margin-right: 8px;
                }

                .option-arrow {
                    position: absolute;
                    top: 20px;
                    right: 20px;
                    color: #ccc;
                    transition: all 0.3s ease;
                }

                .donation-option-card:hover .option-arrow {
                    color: #007bff;
                    transform: translateX(5px);
                }

                /* M-Pesa Payment Banner */
                .mpesa-payment-banner {
                    background: linear-gradient(
                        135deg,
                        #28a745 0%,
                        #20c997 100%
                    );
                    border-radius: 15px;
                    overflow: hidden;
                    position: relative;
                    min-height: 400px;
                }

                .mpesa-payment-banner::before {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: url('{{ asset("assets/img/mpesa-pattern.png") }}')
                        repeat;
                    opacity: 0.1;
                }

                .banner-overlay {
                    position: relative;
                    z-index: 2;
                    padding: 40px 0;
                }

                .banner-header {
                    display: flex;
                    align-items: center;
                    margin-bottom: 30px;
                }

                .mpesa-logo {
                    width: 80px;
                    height: 80px;
                    background: rgba(255, 255, 255, 0.2);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-right: 20px;
                    font-size: 2rem;
                    color: white;
                }

                .header-text h2 {
                    color: white;
                    margin: 0;
                    font-size: 2.5rem;
                    font-weight: 700;
                }

                .header-text p {
                    color: rgba(255, 255, 255, 0.9);
                    margin: 5px 0 0 0;
                    font-size: 1.1rem;
                }

                .payment-instructions {
                    background: rgba(255, 255, 255, 0.95);
                    border-radius: 12px;
                    padding: 25px;
                    color: #333;
                }

                .payment-instructions h4 {
                    color: #28a745;
                    margin-bottom: 15px;
                    font-weight: 600;
                }

                .payment-instructions ol {
                    margin: 0;
                    padding-left: 20px;
                }

                .payment-instructions li {
                    margin-bottom: 8px;
                    line-height: 1.6;
                }

                .payment-instructions strong {
                    color: #28a745;
                    font-weight: 600;
                }

                .payment-details-card {
                    background: rgba(255, 255, 255, 0.95);
                    border-radius: 12px;
                    overflow: hidden;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                }

                .payment-details-card .card-header {
                    background: #28a745;
                    color: white;
                    padding: 20px;
                    text-align: center;
                }

                .payment-details-card .card-header h5 {
                    margin: 0;
                    font-weight: 600;
                }

                .payment-details-card .card-body {
                    padding: 25px;
                }

                .detail-row {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 12px 0;
                    border-bottom: 1px solid #e9ecef;
                }

                .detail-row:last-child {
                    border-bottom: none;
                }

                .detail-row.highlight {
                    background: #f8f9fa;
                    margin: 0 -25px;
                    padding: 15px 25px;
                    border-radius: 8px;
                }

                .detail-row .label {
                    font-weight: 600;
                    color: #6c757d;
                }

                .detail-row .value {
                    font-weight: 600;
                    color: #333;
                    text-align: right;
                }

                .detail-row.highlight .value {
                    color: #28a745;
                    font-size: 1.1rem;
                }

                /* External Donation Banner */
                .external-donation-banner {
                    background: linear-gradient(
                        135deg,
                        #667eea 0%,
                        #764ba2 100%
                    );
                    border-radius: 15px;
                    overflow: hidden;
                    position: relative;
                    min-height: 400px;
                }

                .external-logo {
                    width: 80px;
                    height: 80px;
                    background: rgba(255, 255, 255, 0.2);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-right: 20px;
                    font-size: 2rem;
                    color: white;
                }

                .donation-benefits {
                    background: rgba(255, 255, 255, 0.95);
                    border-radius: 12px;
                    padding: 25px;
                    color: #333;
                }

                .donation-benefits h4 {
                    color: #667eea;
                    margin-bottom: 15px;
                    font-weight: 600;
                }

                .donation-benefits ul {
                    margin: 0;
                    padding-left: 20px;
                }

                .donation-benefits li {
                    margin-bottom: 8px;
                    line-height: 1.6;
                }

                .donation-benefits i {
                    color: #667eea;
                    margin-right: 8px;
                }

                .external-link-card {
                    background: rgba(255, 255, 255, 0.95);
                    border-radius: 12px;
                    overflow: hidden;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                }

                .external-link-card .card-header {
                    background: #667eea;
                    color: white;
                    padding: 20px;
                    text-align: center;
                }

                .external-link-card .card-header h5 {
                    margin: 0;
                    font-weight: 600;
                }

                .external-link-card .card-body {
                    padding: 25px;
                    text-align: center;
                }

                .external-link-card .card-body p {
                    margin-bottom: 20px;
                    color: #666;
                }

                /* Responsive Design */
                @media (max-width: 768px) {
                    .donation-option-card {
                        padding: 20px;
                    }

                    .banner-header {
                        flex-direction: column;
                        text-align: center;
                    }

                    .mpesa-logo,
                    .external-logo {
                        margin: 0 0 15px 0;
                    }

                    .header-text h2 {
                        font-size: 2rem;
                    }

                    .payment-instructions,
                    .donation-benefits {
                        margin-top: 20px;
                    }
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
            </style>
        </div>
    </div>
</div>
<script
    src="https://challenges.cloudflare.com/turnstile/v0/api.js"
    async
    defer
></script>
<script>
    function onTurnstileSuccess(token) {
        window.dispatchEvent(
            new CustomEvent("turnstile-success", { detail: token })
        );
    }

    function renderTurnstile() {
        if (window.turnstile) {
            let rendered = false;
            if (document.getElementById("cf-turnstile-donation")) {
                window.turnstile.render("#cf-turnstile-donation", {
                    sitekey: "{{ config('services.turnstile.sitekey') }}",
                    callback: onTurnstileSuccess,
                });
                rendered = true;
            }
            if (document.getElementById("cf-turnstile-donation-external")) {
                window.turnstile.render("#cf-turnstile-donation-external", {
                    sitekey: "{{ config('services.turnstile.sitekey') }}",
                    callback: onTurnstileSuccess,
                });
                rendered = true;
            }
            if (!rendered) {
                setTimeout(renderTurnstile, 100);
            }
        }
    }
    document.addEventListener("livewire:navigated", renderTurnstile);
    document.addEventListener("livewire:load", renderTurnstile);
    document.addEventListener("livewire:update", renderTurnstile);
</script>
