<div
    x-data
    @turnstile-success.window="window.Livewire.find($root.getAttribute('wire:id')).set('turnstile_token', $event.detail)"
>
    @if (session()->has('contact_success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div class="d-flex align-items-center">
            <i class="far fa-check-circle me-2"></i>
            <div>
                <strong>Success!</strong> {{ session("contact_success") }}
            </div>
        </div>
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        ></button>
    </div>
    @endif @if (session()->has('contact_error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="d-flex align-items-center">
            <i class="far fa-exclamation-triangle me-2"></i>
            <div><strong>Error!</strong> {{ session("contact_error") }}</div>
        </div>
        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
        ></button>
    </div>
    @endif

    <form wire:submit.prevent="submitForm">
        <div class="form-group">
            <input
                type="text"
                wire:model="name"
                class="form-control @error('name') is-invalid @enderror"
                placeholder="Your Name"
            />
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <input
                type="email"
                wire:model="email"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="Email Address"
            />
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <input
                type="tel"
                wire:model="tel"
                class="form-control @error('tel') is-invalid @enderror"
                placeholder="Telephone Number"
            />
            @error('tel')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <textarea
                wire:model="message"
                class="form-control @error('message') is-invalid @enderror"
                placeholder="Type Message"
                rows="4"
            ></textarea>
            @error('message')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-3">
            <div
                id="cf-turnstile"
                class="cf-turnstile"
                data-sitekey="{{ config('services.turnstile.sitekey') }}"
                data-callback="onTurnstileSuccess"
            ></div>
            @error('turnstile_token')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        {{-- Removed hidden input for turnstile_token --}}

        <button
            type="submit"
            class="theme-btn"
            wire:loading.attr="disabled"
            wire:target="submitForm"
        >
            <span wire:loading.remove wire:target="submitForm">
                Enquire Now<i class="fas fa-arrow-right-long"></i>
            </span>
            <span wire:loading wire:target="submitForm">
                <i class="far fa-spinner fa-spin me-2"></i>Sending...
            </span>
        </button>
    </form>
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
</script>
