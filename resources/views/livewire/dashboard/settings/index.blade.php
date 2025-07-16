<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">System Settings</h4>
                </div>
                <div class="card-body">
                    @if(session()->has('success'))
                    <div
                        class="alert alert-success alert-dismissible fade show"
                        role="alert"
                    >
                        {{ session("success") }}
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                        ></button>
                    </div>
                    @endif

                    <form wire:submit.prevent="saveSettings">
                        <!-- Tab Navigation -->
                        <ul
                            class="nav nav-tabs mb-4"
                            id="settingsTabs"
                            role="tablist"
                        >
                            @foreach($groups as $groupKey => $groupName)
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link {{
                                        $activeTab === $groupKey ? 'active' : ''
                                    }}"
                                    type="button"
                                    wire:click="setActiveTab('{{ $groupKey }}')"
                                >
                                    {{ $groupName }}
                                </button>
                            </li>
                            @endforeach
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link {{
                                        $activeTab === 'newsletter'
                                            ? 'active'
                                            : ''
                                    }}"
                                    type="button"
                                    wire:click="setActiveTab('newsletter')"
                                >
                                    Newsletter
                                </button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            @foreach($groups as $groupKey => $groupName)
                            <div
                                class="tab-pane fade {{
                                    $activeTab === $groupKey
                                        ? 'show active'
                                        : ''
                                }}"
                                id="{{ $groupKey }}"
                                role="tabpanel"
                            >
                                <div class="row">
                                    @foreach($settingsByGroup[$groupKey] as $setting)
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label
                                                for="{{ $setting->key }}"
                                                class="form-label"
                                            >
                                                {{ $setting->label }}
                                                @if($setting->description)
                                                <small
                                                    class="text-muted d-block"
                                                    >{{ $setting->description }}</small
                                                >
                                                @endif
                                            </label>

                                            @if($setting->type === 'textarea')
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
                                                <small
                                                    class="text-muted d-block mb-2"
                                                    >Current Image:</small
                                                >
                                                <img
                                                    src="{{ asset('storage/' . $setting->value) }}"
                                                    alt="{{ $setting->label }}"
                                                    class="img-thumbnail"
                                                    style="
                                                        max-width: 200px;
                                                        max-height: 150px;
                                                    "
                                                />
                                            </div>
                                            @endif
                                            @if(isset($tempImages[$setting->key]))
                                            <div class="mt-2">
                                                <small
                                                    class="text-muted d-block mb-2"
                                                    >Preview:</small
                                                >
                                                <img
                                                    src="{{ $tempImages[$setting->key] }}"
                                                    alt="Preview"
                                                    class="img-thumbnail"
                                                    style="
                                                        max-width: 200px;
                                                        max-height: 150px;
                                                    "
                                                />
                                            </div>
                                            @endif @elseif($setting->type ===
                                            'email')
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
                                            @endif @error('formData.' .
                                            $setting->key)
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror @error('uploadedFiles.' .
                                            $setting->key)
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                            <div
                                class="tab-pane fade {{
                                    $activeTab === 'newsletter'
                                        ? 'show active'
                                        : ''
                                }}"
                                id="newsletter"
                                role="tabpanel"
                            >
                                <div class="row">
                                    <div class="col-md-8">
                                        @livewire('settings.newsletter-settings')
                                    </div>
                                </div>
                            </div>
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
