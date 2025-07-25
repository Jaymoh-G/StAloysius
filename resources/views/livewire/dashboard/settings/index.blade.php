<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">System Settings</h4>
                </div>
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session("success") }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form wire:submit.prevent="saveSettings">
                        <!-- Tab Navigation -->
                        <ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist">
                            @foreach($groups as $groupKey => $groupName)
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link {{ $activeTab === $groupKey ? 'active' : '' }}"
                                        type="button"
                                        wire:click="setActiveTab('{{ $groupKey }}')"
                                    >
                                        {{ $groupName }}
                                    </button>
                                </li>
                            @endforeach
                            @if(count($groups) > 1)
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link {{ $activeTab === 'newsletter' ? 'active' : '' }}"
                                        type="button"
                                        wire:click="setActiveTab('newsletter')"
                                    >
                                        Newsletter
                                    </button>
                                </li>
                            @endif
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            @foreach($groups as $groupKey => $groupName)
                                <div class="tab-pane fade {{ $activeTab === $groupKey ? 'show active' : '' }}" id="{{ $groupKey }}" role="tabpanel">

                                    @if($groupKey === 'applications')
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="student_application_deadline" class="form-label">Application Deadline</label>
                                                    <input
                                                        wire:model="formData.student_application_deadline"
                                                        type="date"
                                                        id="student_application_deadline"
                                                        class="form-control @error('formData.student_application_deadline') is-invalid @enderror"
                                                        placeholder="Select application deadline"
                                                    />
                                                    @error('formData.student_application_deadline')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="student_application_open" class="form-label">Is Student Application Open?</label>
                                                    <div class="form-check form-switch">
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            id="student_application_open"
                                                            wire:model="formData.student_application_open"
                                                            value="1"
                                                        />
                                                        <label class="form-check-label" for="student_application_open">
                                                            {{ $formData['student_application_open'] == '1' ? 'Open' : 'Closed' }}
                                                        </label>
                                                    </div>
                                                    @error('formData.student_application_open')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <div class="form-group">
                                                    <label for="student_application_note" class="form-label">Application Note</label>
                                                    <textarea
                                                        wire:model="formData.student_application_note"
                                                        id="student_application_note"
                                                        class="form-control @error('formData.student_application_note') is-invalid @enderror"
                                                        rows="3"
                                                        placeholder="Enter application note"
                                                    ></textarea>
                                                    @error('formData.student_application_note')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            @foreach($settingsByGroup[$groupKey] as $setting)
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="{{ $setting->key }}" class="form-label">
                                                            {{ $setting->label }}
                                                            @if($setting->description)
                                                                <small class="text-muted d-block">{{ $setting->description }}</small>
                                                            @endif
                                                        </label>

                                                        @if($setting->key === 'student_application_open')
                                                            <div class="form-check form-switch">
                                                                <input
                                                                    class="form-check-input"
                                                                    type="checkbox"
                                                                    id="{{ $setting->key }}"
                                                                    wire:model="formData.{{ $setting->key }}"
                                                                    value="1"
                                                                />
                                                                <label class="form-check-label" for="{{ $setting->key }}">
                                                                    {{ $formData[$setting->key] == '1' ? 'Open' : 'Closed' }}
                                                                </label>
                                                            </div>
                                                        @elseif($setting->key === 'student_application_deadline')
                                                            <input
                                                                wire:model="formData.{{ $setting->key }}"
                                                                type="date"
                                                                id="{{ $setting->key }}"
                                                                class="form-control @error('formData.' . $setting->key) is-invalid @enderror"
                                                                placeholder="Select application deadline"
                                                            />
                                                        @elseif($setting->type === 'textarea')
                                                            <textarea
                                                                wire:model="formData.{{ $setting->key }}"
                                                                id="{{ $setting->key }}"
                                                                class="form-control @error('formData.' . $setting->key) is-invalid @enderror"
                                                                rows="3"
                                                                placeholder="Enter {{ strtolower($setting->label) }}"
                                                            ></textarea>
                                                        @elseif($setting->type === 'file')
                                                            <input
                                                                wire:model="uploadedFiles.{{ $setting->key }}"
                                                                type="file"
                                                                id="{{ $setting->key }}"
                                                                class="form-control @error('uploadedFiles.' . $setting->key) is-invalid @enderror"
                                                                accept="image/*"
                                                            />
                                                            @if($setting->value)
                                                                <div class="mt-2">
                                                                    <small class="text-muted d-block mb-2">Current Image:</small>
                                                                    <img
                                                                        src="{{ asset('storage/' . $setting->value) }}"
                                                                        alt="{{ $setting->label }}"
                                                                        class="img-thumbnail"
                                                                        style="max-width: 200px; max-height: 150px;"
                                                                    />
                                                                </div>
                                                            @endif
                                                            @if(isset($tempImages[$setting->key]))
                                                                <div class="mt-2">
                                                                    <small class="text-muted d-block mb-2">Preview:</small>
                                                                    <img
                                                                        src="{{ $tempImages[$setting->key] }}"
                                                                        alt="Preview"
                                                                        class="img-thumbnail"
                                                                        style="max-width: 200px; max-height: 150px;"
                                                                    />
                                                                </div>
                                                            @endif
                                                        @elseif($setting->type === 'email')
                                                            <input
                                                                wire:model="formData.{{ $setting->key }}"
                                                                type="email"
                                                                id="{{ $setting->key }}"
                                                                class="form-control @error('formData.' . $setting->key) is-invalid @enderror"
                                                                placeholder="Enter {{ strtolower($setting->label) }}"
                                                            />
                                                        @elseif($setting->type === 'url')
                                                            <input
                                                                wire:model="formData.{{ $setting->key }}"
                                                                type="url"
                                                                id="{{ $setting->key }}"
                                                                class="form-control @error('formData.' . $setting->key) is-invalid @enderror"
                                                                placeholder="Enter {{ strtolower($setting->label) }}"
                                                            />
                                                        @elseif($setting->type === 'number')
                                                            <input
                                                                wire:model="formData.{{ $setting->key }}"
                                                                type="number"
                                                                id="{{ $setting->key }}"
                                                                class="form-control @error('formData.' . $setting->key) is-invalid @enderror"
                                                                placeholder="Enter {{ strtolower($setting->label) }}"
                                                                min="0"
                                                            />
                                                        @else
                                                            <input
                                                                wire:model="formData.{{ $setting->key }}"
                                                                type="text"
                                                                id="{{ $setting->key }}"
                                                                class="form-control @error('formData.' . $setting->key) is-invalid @enderror"
                                                                placeholder="Enter {{ strtolower($setting->label) }}"
                                                            />
                                                        @endif

                                                        @error('formData.' . $setting->key)
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                        @error('uploadedFiles.' . $setting->key)
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach

                            @if(count($groups) > 1)
                                <div class="tab-pane fade {{ $activeTab === 'newsletter' ? 'show active' : '' }}" id="newsletter" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-8">
                                            @livewire('settings.newsletter-settings')
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
