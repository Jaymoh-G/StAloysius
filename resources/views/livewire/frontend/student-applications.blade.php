<main
    class="main"
    x-data
    @turnstile-success.window="window.Livewire.find($root.getAttribute('wire:id')).set('turnstile_token', $event.detail)"
>
    <!-- breadcrumb -->
    <div
        class="site-breadcrumb"
        style="background: url({{ asset('assets/img/breadcrumb/01.jpg') }})"
    >
        <div class="container">
            <h2 class="breadcrumb-title">Student Application</h2>
            <ul class="breadcrumb-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">Student Application</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow border-0">
                    <div class="card-header bg-success text-white text-center">
                        <p class="mb-0">Apply for admission</p>
                    </div>
                    <div class="card-body p-4">
                        @if (!$applicationOpen)
                        <div class="alert alert-warning text-center mb-4">
                            <strong>Applications are currently closed.</strong>
                            @if ($applicationNote)
                            <div class="mt-2">{!! $applicationNote !!}</div>
                            @endif @if ($applicationDeadline)
                            <div class="mt-2">
                                <strong>Next Application Deadline:</strong>
                             <strong> {{ \Carbon\Carbon::parse($applicationDeadline)->format('jS F Y') }}</strong>
                            </div>
                            @endif
                        </div>
                        @else @if ($applicationNote)
                        <div class="alert alert-info text-center mb-4">
                            {!! $applicationNote !!}
                        </div>
                        @endif @if ($applicationDeadline)
                        <div class="alert alert-secondary text-center mb-4">
                            <strong>Application Deadline:</strong>
                            {{ \Carbon\Carbon::parse($applicationDeadline)->format('jS F Y') }}
                        </div>
                        @endif @endif @if ($applicationOpen)
                        <form
                            wire:submit.prevent="submit"
                            enctype="multipart/form-data"
                            novalidate
                        >
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label
                                            for="student_name"
                                            class="form-label"
                                            >Student Name
                                            <span class="text-danger"
                                                >*</span
                                            ></label
                                        >
                                        <input
                                            type="text"
                                            id="student_name"
                                            wire:model.defer="student_name"
                                            class="form-control @error('student_name') is-invalid @enderror"
                                            placeholder="Enter student's full name"
                                        />
                                        @error('student_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label
                                            for="kpsea_index_number"
                                            class="form-label"
                                            >KPSEA Index Number
                                            <span class="text-danger"
                                                >*</span
                                            ></label
                                        >
                                        <input
                                            type="text"
                                            id="kpsea_index_number"
                                            wire:model.defer="kpsea_index_number"
                                            class="form-control @error('kpsea_index_number') is-invalid @enderror"
                                            placeholder="e.g. 1234567890"
                                        />
                                        @error('kpsea_index_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label
                                            for="current_residence"
                                            class="form-label"
                                            >Current Residence
                                            <span class="text-danger"
                                                >*</span
                                            ></label
                                        >
                                        <input
                                            type="text"
                                            id="current_residence"
                                            wire:model.defer="current_residence"
                                            class="form-control @error('current_residence') is-invalid @enderror"
                                            placeholder="Enter current residence"
                                        />
                                        @error('current_residence')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 mt-2"></div>
                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="guardian_name"
                                            class="form-label"
                                            >Guardian/Parent Name
                                            <span class="text-danger"
                                                >*</span
                                            ></label
                                        >
                                        <input
                                            type="text"
                                            id="guardian_name"
                                            wire:model.defer="guardian_name"
                                            class="form-control @error('guardian_name') is-invalid @enderror"
                                            placeholder="Enter guardian or parent name"
                                        />
                                        @error('guardian_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label
                                            for="guardian_phone"
                                            class="form-label"
                                            >Guardian/Parent Phone Number
                                            <span class="text-danger"
                                                >*</span
                                            ></label
                                        >
                                        <input
                                            type="text"
                                            id="guardian_phone"
                                            wire:model.defer="guardian_phone"
                                            class="form-control @error('guardian_phone') is-invalid @enderror"
                                            placeholder="e.g. 0712345678"
                                        />
                                        @error('guardian_phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <h5 class="mb-3">Required Documents</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label
                                            for="application_letter"
                                            class="form-label"
                                            >Application Letter
                                            <span class="text-danger"
                                                >*</span
                                            ></label
                                        >
                                        <input
                                            type="file"
                                            id="application_letter"
                                            wire:model="application_letter"
                                            class="form-control @error('application_letter') is-invalid @enderror"
                                            accept=".pdf,.doc,.docx"
                                        />
                                        @error('application_letter')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror @if ($application_letter)
                                        <div class="text-success small mt-1">
                                            <i class="fas fa-check"></i> File
                                            ready for upload
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label
                                            for="academic_certificates"
                                            class="form-label"
                                            >Academic Certificates
                                            <span class="text-danger"
                                                >*</span
                                            ></label
                                        >
                                        <input
                                            type="file"
                                            id="academic_certificates"
                                            wire:model="academic_certificates"
                                            class="form-control @error('academic_certificates') is-invalid @enderror @error('academic_certificates.*') is-invalid @enderror"
                                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                            multiple
                                        />
                                        <small class="text-muted"
                                            >You can upload up to 3
                                            files.</small
                                        >
                                        @error('academic_certificates')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        @error('academic_certificates.*')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror @if ($academic_certificates)
                                        <div class="text-success small mt-1">
                                            <i class="fas fa-check"></i>
                                            {{
                                                is_array($academic_certificates)
                                                    ? count(
                                                          $academic_certificates
                                                      )
                                                    : 1
                                            }}
                                            file(s) ready for upload
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label
                                            for="death_certificates"
                                            class="form-label"
                                            >Parent's Death Certificate (if
                                            applicable)</label
                                        >
                                        <input
                                            type="file"
                                            id="death_certificates"
                                            wire:model="death_certificates"
                                            class="form-control @error('death_certificates') is-invalid @enderror @error('death_certificates.*') is-invalid @enderror"
                                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                            multiple
                                        />
                                        <small class="text-muted"
                                            >You can upload up to 2
                                            files.</small
                                        >
                                        @error('death_certificates')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror @error('death_certificates.*')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror @if ($death_certificates)
                                        <div class="text-success small mt-1">
                                            <i class="fas fa-check"></i>
                                            {{
                                                is_array($death_certificates)
                                                    ? count($death_certificates)
                                                    : 1
                                            }}
                                            file(s) ready for upload
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <div class="form-group mt-3">
                                    <div
                                        id="cf-turnstile-student-app"
                                        class="cf-turnstile"
                                        data-sitekey="{{
                                            config('services.turnstile.sitekey')
                                        }}"
                                        data-callback="onTurnstileSuccess"
                                    ></div>
                                    @error('turnstile_token')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <button
                                    type="submit"
                                    class="theme-btn btn-lg px-5"
                                    wire:loading.attr="disabled"
                                >
                                    <span
                                        wire:loading.remove
                                        wire:target="submit"
                                        >Submit Application</span
                                    >
                                    <span wire:loading wire:target="submit"
                                        ><i class="fas fa-spinner fa-spin"></i>
                                        Submitting...</span
                                    >
                                </button>
                            </div>
                        </form>
                        @endif @if ($successMessage)
                        <div class="alert alert-success text-center">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ $successMessage }}
                        </div>
                        @endif
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
<script>
    function onTurnstileSuccess(token) {
        window.dispatchEvent(
            new CustomEvent("turnstile-success", { detail: token })
        );
    }
</script>
