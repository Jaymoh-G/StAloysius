<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $testimonialId ? 'Edit Testimonial' : 'Create Testimonial' }}</h4>
        </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form wire:submit.prevent="submit" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input wire:model="name" placeholder="Name" type="text" class="form-control" />
                        @error('name')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <select wire:model="type" class="form-control">
                            <option value="">Select Type</option>
                            <option value="Student">Student</option>
                            <option value="Parent">Parent</option>
                        </select>
                        @error('type')
                            <span class="alert-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <textarea wire:model="testimony" placeholder="Testimony" class="form-control" rows="4"></textarea>
                    @error('testimony')
                        <span class="alert-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <input wire:model="rating" placeholder="Rating (1 to 5)" type="number" min="1"
                            max="5" class="form-control" />
                        @error('rating')
                            <span class="alert-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        @if ($existingImage)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $existingImage) }}"
                                    style="
                            height: 100px;
                            width: auto;
                            object-fit: cover;
                        " />
                                <button wire:click.prevent="deleteImage"
                                    class="ml-2 text-sm text-red-600">Delete</button>
                            </div>
                        @endif
                        <input wire:model="image" type="file" class="form-control" />
                        @error('image')
                            <span class="alert-danger">{{ $message }}</span>
                        @enderror

                        @if ($image)
                            <div class="mb-2">
                                <img src="{{ $image->temporaryUrl() }}"
                                    style="
                            height: 100px;
                            width: auto;
                            object-fit: cover;" />
                            </div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    {{ $testimonialId ? 'Update' : 'Create' }}
                </button>
            </form>
        </div>
    </div>
</div>

@if (isset($testimonial))
    {{-- Single Testimonial View --}}
    <div class="container py-5">
        <a href="{{ route('testimonials') }}" class="btn btn-link mb-3">&larr; Back to all testimonials</a>
        <div class="card mx-auto" style="max-width:600px;">
            @if ($testimonial->image)
                <img src="{{ asset('storage/' . $testimonial->image) }}" class="card-img-top"
                    alt="{{ $testimonial->name }}">
            @endif
            <div class="card-body">
                <h3>{{ $testimonial->name }}</h3>
                <span class="badge bg-primary mb-2">{{ $testimonial->type }}</span>
                <div class="mb-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="fa fa-star{{ $i <= $testimonial->rating ? '' : '-o' }}"
                            style="color: #f7c948;"></span>
                    @endfor
                </div>
                <blockquote class="blockquote">
                    <p>{{ $testimonial->testimony }}</p>
                </blockquote>
                <small class="text-muted">
                    <i class="fa fa-calendar"></i> {{ $testimonial->created_at->format('F j, Y') }}
                </small>
            </div>
        </div>
    </div>
@else
    {{-- Testimonials List View --}}
    {{-- ... your existing testimonials list code ... --}}
@endif
