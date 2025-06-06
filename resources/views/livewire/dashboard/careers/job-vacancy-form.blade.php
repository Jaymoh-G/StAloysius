<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $jobId ? 'Edit Job Vacancy' : 'Create Job Vacancy' }}</h4>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Job Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    wire:model="title" placeholder="Enter job title">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                    wire:model="slug" placeholder="Enter slug">
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select @error('job_category_id') is-invalid @enderror"
                                    wire:model="job_category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('job_category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Application Deadline</label>
                                <input type="date" class="form-control @error('deadline') is-invalid @enderror"
                                    wire:model="deadline">
                                @error('deadline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Application Email</label>
                                <input type="email" class="form-control @error('application_email') is-invalid @enderror"
                                    wire:model="application_email" placeholder="Enter email for applications">
                                @error('application_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" wire:model="is_active">
                                    <label class="form-check-label">Active</label>
                                </div>
                                @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Job Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                    wire:model="description" rows="10" id="description"></textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('dashboard.careers.index') }}" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-primary">{{ $jobId ? 'Update Job' : 'Create Job' }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize CKEditor when the component is loaded
        document.addEventListener('livewire:initialized', function () {
            if (document.querySelector('#description')) {
                ClassicEditor
                    .create(document.querySelector('#description'))
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            @this.set('description', editor.getData());
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        });
    </script>
</div>