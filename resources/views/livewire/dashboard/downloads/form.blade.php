<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        {{ $downloadId ? "Edit Download" : "Add Download" }}
                    </h4>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session("message") }}
                    </div>
                    @endif @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form wire:submit.prevent="save">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input
                                type="text"
                                class="form-control @error('title') is-invalid @enderror"
                                wire:model.defer="title"
                            />
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea
                                class="form-control @error('description') is-invalid @enderror"
                                wire:model.defer="description"
                                rows="3"
                            ></textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select
                                class="form-select @error('category') is-invalid @enderror"
                                wire:model.defer="category"
                            >
                                <option value="">Select Category</option>
                                @foreach($categories as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">File (max 5MB)</label>
                            <input
                                type="file"
                                class="form-control @error('file') is-invalid @enderror"
                                wire:model="file"
                            />
                            @error('file')
                            <div class="invalid-feedback">
                                {{
                                    $message == "The file failed to upload."
                                        ? "The file type is not allowed or the file is too large. Please select a PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, or PNG file under 2MB."
                                        : $message
                                }}
                            </div>
                            @enderror
                            <div
                                wire:loading
                                wire:target="file"
                                class="text-info mt-2"
                            >
                                Uploading...
                            </div>
                            @if($existingFilePath)
                            <div class="mt-2">
                                <a
                                    href="{{
                                        asset('storage/'.$existingFilePath)
                                    }}"
                                    target="_blank"
                                    class="btn btn-outline-secondary btn-sm"
                                >
                                    <i class="fas fa-file-alt me-1"></i> View
                                    Current File
                                </a>
                            </div>
                            @endif
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                wire:model.defer="is_active"
                                id="isActiveSwitch"
                            />
                            <label class="form-check-label" for="isActiveSwitch"
                                >Active</label
                            >
                        </div>
                        <div class="d-flex justify-content-between">
                            <a
                                href="{{ route('dashboard.downloads.index') }}"
                                class="btn btn-danger"
                                >Cancel</a
                            >
                            <button type="submit" class="btn btn-primary">
                                {{ $downloadId ? "Update" : "Save" }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
