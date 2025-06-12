<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">
                        {{ $teamMemberId ? 'Edit' : 'Add' }} Team Member
                    </h4>
                    <div class="page-title-right">
                        <a href="{{ route('dashboard.team.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Team
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <form wire:submit.prevent="save">
                            @if ($errors->has('general'))
                                <div class="alert alert-danger mb-3">
                                    {{ $errors->first('general') }}
                                </div>
                            @endif

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Name
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" wire:model="name" placeholder="Enter name" />
                                        @error('name')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="department" class="form-label">Department</label>
                                        <select class="form-select @error('department_id') is-invalid @enderror"
                                            id="department" wire:model="department_id">
                                            <option value="">
                                                Select Department
                                            </option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position" class="form-label">Position
                                            <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('position') is-invalid @enderror" id="position"
                                            wire:model="position" placeholder="Enter position" />
                                        @error('position')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" wire:model="description"
                                            rows="3" placeholder="Enter description"></textarea>
                                        @error('description')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="experience" class="form-label">Experience</label>
                                        <textarea class="form-control @error('experience') is-invalid @enderror" id="experience" wire:model="experience"
                                            rows="3" placeholder="Enter experience"></textarea>
                                        @error('experience')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">
                                                Professional Skills
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            @foreach ($professional_skills as $skill => $percent)
                                                <div class="row align-items-center mb-2">
                                                    <div class="col-5">
                                                        <input type="text" class="form-control"
                                                            value="{{ $skill }}" disabled />
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="number" class="form-control"
                                                            value="{{ $percent }}" disabled />
                                                    </div>
                                                    <div class="col-3">
                                                        <button type="button"
                                                            wire:click.prevent="removeSkill('{{ $skill }}')"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="row mt-3">
                                                <div class="col-5">
                                                    <input type="text"
                                                        class="form-control @error('newSkill') is-invalid @enderror"
                                                        wire:model.defer="newSkill" placeholder="Skill" />
                                                    @error('newSkill')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-4">
                                                    <input type="number"
                                                        class="form-control @error('newPercent') is-invalid @enderror"
                                                        wire:model.defer="newPercent" placeholder="%" min="0"
                                                        max="100" />
                                                    @error('newPercent')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-3">
                                                    <button type="button" wire:click.prevent="addSkill"
                                                        class="btn btn-primary btn-sm w-100">
                                                        <i class="fas fa-plus"></i>
                                                        Add
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">
                                                Social Links
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            @foreach ($socials as $platform => $url)
                                                <div class="row align-items-center mb-2">
                                                    <div class="col-5">
                                                        <select class="form-select" disabled>
                                                            <option value="{{ $platform }}">
                                                                {{ ucfirst($platform) }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-5">
                                                        <input type="text" class="form-control"
                                                            value="{{ $url }}" disabled />
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button"
                                                            wire:click.prevent="removeSocial('{{ $platform }}')"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="row mt-3">
                                                <div class="col-5">
                                                    <select
                                                        class="form-select @error('newSocial') is-invalid @enderror"
                                                        wire:model.defer="newSocial">
                                                        <option value="">
                                                            Select Platform
                                                        </option>
                                                        <option value="facebook">
                                                            Facebook
                                                        </option>
                                                        <option value="twitter">
                                                            Twitter
                                                        </option>
                                                        <option value="linkedin">
                                                            LinkedIn
                                                        </option>
                                                        <option value="instagram">
                                                            Instagram
                                                        </option>
                                                        <option value="youtube">
                                                            YouTube
                                                        </option>
                                                        <option value="website">
                                                            Website
                                                        </option>
                                                    </select>
                                                    @error('newSocial')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-5">
                                                    <input type="url"
                                                        class="form-control @error('newSocialLink') is-invalid @enderror"
                                                        wire:model.defer="newSocialLink" placeholder="Enter Link" />
                                                    @error('newSocialLink')
                                                        <div class="text-danger mt-1">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-2">
                                                    <button type="button" wire:click.prevent="addSocial"
                                                        class="btn btn-primary btn-sm w-100">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">
                                                Photo
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            @if ($image && !$imageTemp)
                                                <div class="mb-3">
                                                    <label class="form-label">Current Photo:</label>
                                                    <div>
                                                        <img src="{{ asset('storage/' . $image) }}"
                                                            class="img-thumbnail"
                                                            style="
                                                            max-height: 150px;
                                                        " />
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <label for="imageTemp" class="form-label">Upload New Photo</label>
                                                <input type="file"
                                                    class="form-control @error('imageTemp') is-invalid @enderror"
                                                    id="imageTemp" wire:model="imageTemp" />
                                                @error('imageTemp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                @if ($imageTemp)
                                                    <div class="mt-2">
                                                        <img src="{{ $imageTemp->temporaryUrl() }}"
                                                            class="img-thumbnail"
                                                            style="
                                                            max-height: 150px;
                                                        " />
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>
                                        {{ $teamMemberId ? 'Update' : 'Save' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
