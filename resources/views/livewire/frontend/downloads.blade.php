<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="mb-3">Downloads</h2>
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                <button
                    class="theme-btn btn-sm {{
                        $category == '' ? 'active' : ''
                    }}"
                    wire:click="$set('category', '')"
                >
                    All
                </button>
                @foreach($categories as $key => $label)
                <button
                    class="theme-btn btn-sm {{
                        $category == $key ? 'active' : ''
                    }}"
                    wire:click="$set('category', '$key')"
                >
                    {{ $label }}
                </button>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row g-4">
        @forelse($downloads as $download)
        <div class="col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i
                        class="fas fa-file-{{ $download->file_type === 'pdf' ? 'pdf text-danger' : ($download->file_type === 'doc' || $download->file_type === 'docx' ? 'word text-primary' : 'alt text-secondary') }} fa-3x mb-3"
                    ></i>
                    <h5 class="card-title mb-2">{{ $download->title }}</h5>
                    <p class="card-text small text-muted">
                        {{ Str::limit($download->description, 60) }}
                    </p>
                    <a
                        href="{{ asset('storage/' . $download->file_path) }}"
                        target="_blank"
                        class="btn btn-outline-success w-100 mt-2"
                    >
                        <i class="fas fa-download me-1"></i> Download
                    </a>
                </div>
                <div class="card-footer text-muted small">
                    <i class="far fa-calendar me-1"></i>
                    {{ $download->created_at->format('M d, Y') }}
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-file fa-3x text-muted mb-3"></i>
            <h5>No downloads found for this category.</h5>
        </div>
        @endforelse
    </div>
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-center">
            {{ $downloads->links() }}
        </div>
    </div>
</div>
