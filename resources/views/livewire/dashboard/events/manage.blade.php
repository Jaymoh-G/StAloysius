<div>
    <form wire:submit.prevent="submit" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="name">Event Title</label>
            <input type="text" id="name" wire:model.lazy="name" class="w-full">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="slug">Slug</label>
            <input type="text" id="slug" wire:model.lazy="slug" class="w-full" readonly>
            @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" wire:model="start_date" class="w-full">
                @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" wire:model="end_date" class="w-full">
                @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label for="time">Event Time</label>
            <input type="time" id="time" wire:model="time" class="w-full">
            @error('time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="location">Location</label>
            <input type="text" id="location" wire:model.lazy="location" class="w-full">
            @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="organizer">Organizer Name</label>
            <input type="text" id="organizer" wire:model.lazy="organizer" class="w-full">
            @error('organizer') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="content">Event Description</label>
            <textarea wire:ignore id="ckeditor" wire:model="content" class="w-full"></textarea>
            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="banner">Banner Image</label>
            <input type="file" wire:model="banner">
            @if ($existingBanner)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $existingBanner) }}" class="w-32 h-20 object-cover">
                    <button wire:click.prevent="deleteBanner" class="text-red-500 text-sm">Remove</button>
                </div>
            @endif
            @error('banner') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Gallery Images</label>
            <input type="file" wire:model="images" multiple>
            @error('images.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <div class="grid grid-cols-3 gap-4 mt-2">
                @foreach ($images as $index => $image)
                    <div class="relative">
                        <img src="{{ $image->temporaryUrl() }}" class="w-full h-24 object-cover rounded">
                        <input type="radio" wire:model="featuredImageIndex" value="{{ $index }}"> Featured
                    </div>
                @endforeach

                @foreach ($existingImages as $index => $img)
                    <div class="relative">
                        <img src="{{ asset('storage/' . $img->path) }}" class="w-full h-24 object-cover rounded">
                        <input type="radio" wire:model="featuredImageIndex" value="existing_{{ $index }}"> Featured
                        <button wire:click.prevent="deleteImage({{ $img->id }})" class="text-red-500 text-xs block">Delete</button>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $eventId ? 'Update Event' : 'Create Event' }}
            </button>
        </div>
    </form>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
        <script>
            document.addEventListener('livewire:load', function () {
                ClassicEditor.create(document.querySelector('#ckeditor'))
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            @this.set('content', editor.getData());
                            Livewire.dispatch('updateContent', { value: editor.getData() });
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });

                Livewire.on('resetEditor', () => {
                    if (ClassicEditor.instances['ckeditor']) {
                        ClassicEditor.instances['ckeditor'].setData('');
                    }
                });
            });
        </script>
    @endpush
</div>
