<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ $projectId ? "Edit Project" : "Create New Project" }}
                    </h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label
                                                for="title"
                                                class="form-label"
                                                >Project Title *</label
                                            >
                                            <input
                                                wire:model="title"
                                                type="text"
                                                class="form-control @error('title') is-invalid @enderror"
                                                id="title"
                                            />
                                            @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="slug" class="form-label"
                                                >Slug *</label
                                            >
                                            <input
                                                wire:model="slug"
                                                type="text"
                                                class="form-control @error('slug') is-invalid @enderror"
                                                id="slug"
                                            />
                                            @error('slug')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Client Name and Location fields removed -->
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label
                                                for="start_date"
                                                class="form-label"
                                                >Start Date</label
                                            >
                                            <input
                                                wire:model="start_date"
                                                type="date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                id="start_date"
                                            />
                                            @error('start_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label
                                                for="end_date"
                                                class="form-label"
                                                >End Date</label
                                            >
                                            <input
                                                wire:model="end_date"
                                                type="date"
                                                class="form-control @error('end_date') is-invalid @enderror"
                                                id="end_date"
                                            />
                                            @error('end_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label
                                                for="department_id"
                                                class="form-label"
                                                >Department</label
                                            >
                                            <select
                                                wire:model="department_id"
                                                class="form-select @error('department_id') is-invalid @enderror"
                                                id="department_id"
                                            >
                                                <option value="">
                                                    -- Select Department --
                                                </option>
                                                @foreach($departments as
                                                $department)
                                                <option
                                                    value="{{ $department->id }}"
                                                >
                                                    {{ $department->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Technologies Used field removed -->
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label
                                                for="status"
                                                class="form-label"
                                                >Status *</label
                                            >
                                            <select
                                                wire:model="status"
                                                class="form-select @error('status') is-invalid @enderror"
                                                id="status"
                                            >
                                                <option value="planning">
                                                    Planning
                                                </option>
                                                <option value="in_progress">
                                                    In Progress
                                                </option>
                                                <option value="completed">
                                                    Completed
                                                </option>
                                                <option value="on_hold">
                                                    On Hold
                                                </option>
                                                <option value="cancelled">
                                                    Cancelled
                                                </option>
                                            </select>
                                            @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label
                                                for="sort_order"
                                                class="form-label"
                                                >Sort Order</label
                                            >
                                            <input
                                                wire:model="sort_order"
                                                type="number"
                                                class="form-control @error('sort_order') is-invalid @enderror"
                                                id="sort_order"
                                                min="0"
                                            />
                                            @error('sort_order')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label
                                        for="short_description"
                                        class="form-label"
                                        >Short Description</label
                                    >
                                    <textarea
                                        wire:model="short_description"
                                        class="form-control @error('short_description') is-invalid @enderror"
                                        id="short_description"
                                        rows="3"
                                        maxlength="500"
                                    ></textarea>
                                    @error('short_description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label"
                                        >Full Description *</label
                                    >
                                    <textarea
                                        wire:model="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        id="description"
                                        rows="6"
                                    ></textarea>
                                    <small class="form-text text-muted"
                                        >Use a blank line (double line break) to
                                        separate paragraphs. Each paragraph will
                                        be saved in a separate field. You can
                                        use HTML headings like
                                        &lt;h2&gt;Heading&lt;/h2&gt; or
                                        &lt;h3&gt;Subheading&lt;/h3&gt; within
                                        paragraphs.</small
                                    >
                                    @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            Project Settings
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input
                                                    wire:model="is_featured"
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    id="is_featured"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="is_featured"
                                                >
                                                    Featured Project
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input
                                                    wire:model="is_published"
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    id="is_published"
                                                />
                                                <label
                                                    class="form-check-label"
                                                    for="is_published"
                                                >
                                                    Published
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label
                                                for="images"
                                                class="form-label"
                                                >Project Images</label
                                            >
                                            <input
                                                wire:model="images"
                                                type="file"
                                                class="form-control @error('images.*') is-invalid @enderror"
                                                id="images"
                                                multiple
                                                accept="image/*"
                                            />
                                            @error('images.*')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <small class="form-text text-muted"
                                                >You can select multiple images.
                                                First image will be set as
                                                featured.</small
                                            >
                                        </div>

                                        @if($images)
                                        <div class="mb-3">
                                            <label class="form-label"
                                                >Preview</label
                                            >
                                            <div class="row">
                                                @foreach($images as $index =>
                                                $image)
                                                <div class="col-6 mb-2">
                                                    <img
                                                        src="{{ $image->temporaryUrl() }}"
                                                        class="img-thumbnail"
                                                        style="
                                                            width: 100%;
                                                            height: 100px;
                                                            object-fit: cover;
                                                        "
                                                    />
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a
                                        href="{{
                                            route('dashboard.projects.index')
                                        }}"
                                        class="btn btn-secondary"
                                    >
                                        <i class="fas fa-arrow-left"></i> Back
                                        to Projects
                                    </a>
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        <i class="fas fa-save"></i>
                                        {{
                                            $projectId
                                                ? "Update Project"
                                                : "Create Project"
                                        }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
