<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div
                    class="card-header d-flex justify-content-between align-items-center"
                >
                    <h4 class="card-title mb-0">Downloads</h4>
                    <a
                        href="{{ route('dashboard.downloads.create') }}"
                        class="btn btn-primary"
                    >
                        <i class="fas fa-plus me-1"></i> Add Download
                    </a>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session("message") }}
                    </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-md-4 mb-2">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Search downloads..."
                                wire:model.debounce.500ms="search"
                            />
                        </div>
                        <div class="col-md-4 mb-2">
                            <select class="form-select" wire:model="category">
                                <option value="">All Categories</option>
                                @foreach($categories as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table table-hover table-bordered align-middle"
                        >
                            <thead class="table-light">
                                <tr>
                                    <th>File</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Uploaded</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($downloads as $download)
                                <tr>
                                    <td class="text-center">
                                        <i
                                            class="fas fa-file-{{ $download->file_type === 'pdf' ? 'pdf text-danger' : ($download->file_type === 'doc' || $download->file_type === 'docx' ? 'word text-primary' : 'alt text-secondary') }} fa-lg"
                                        ></i>
                                    </td>
                                    <td>
                                        <strong>{{ $download->title }}</strong>
                                        <br />
                                        <small
                                            class="text-muted"
                                            >{{ Str::limit($download->description, 40) }}</small
                                        >
                                    </td>
                                    <td>
                                        {{ $categories[$download->category] ?? $download->category }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $download->is_active ? 'bg-success' : 'bg-danger' }}"
                                        >
                                            {{ $download->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $download->created_at->format('M d, Y') }}
                                    </td>
                                    <td>
                                        <a
                                            href="{{ asset('storage/' . $download->file_path) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-outline-success me-1"
                                            title="Download"
                                        >
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <a
                                            href="{{ route('dashboard.downloads.edit', $download->id) }}"
                                            class="btn btn-sm btn-info me-1"
                                            title="Edit"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button
                                            class="btn btn-sm btn-danger me-1"
                                            wire:click="delete({{ $download->id }})"
                                            title="Delete"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button
                                            class="btn btn-sm btn-secondary"
                                            wire:click="toggleActive({{ $download->id }})"
                                            title="Toggle Status"
                                        >
                                            <i
                                                class="fas fa-toggle-{{ $download->is_active ? 'on' : 'off' }}"
                                            ></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        No downloads found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $downloads->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
