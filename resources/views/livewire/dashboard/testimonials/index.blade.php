{{-- use bootsrap styling for the table --}}
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Testimonials</h4>
            <a href="{{ route('dashboard.testimonials.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Add Testimonial
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (session()->has('message'))
                    <div class="mb-4 text-green-600">{{ session('message') }}</div>
                @endif

                <table class="table-hover table-responsive-sm table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Testimony</th>
                            <th>Image</th>
                            <th>Type</th>
                            <th>Rating</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($testimonials as $index => $testimonial)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>{{ $testimonial->name }}</td>
                                <td>{{ Str::limit(strip_tags($testimonial->testimony), 70) }}</td>
                                <td>
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt=""
                                            class="img-thumbnail" style="height: 60px; width: 60px" />

                                    </div>
                                </td>
                                <td>{{ $testimonial->type }}</td>
                                <td>{{ $testimonial->rating }} / 5</td>


                                <td>

                                    <a href="{{ route('dashboard.testimonials.edit', $testimonial->id) }}"
                                        class="btn btn-primary btn-xs sharp me-1 shadow" title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button class="btn btn-danger btn-xs sharp me-1 shadow"
                                        wire:click.prevent="deleteTestimonial({{ $testimonial->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No testimonials yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
