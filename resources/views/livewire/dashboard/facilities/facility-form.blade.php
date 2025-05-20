<div>
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div>
            <label>Title</label>
            <input type="text" wire:model="title">
        </div>

        <div>
            <label>Slug</label>
            <input type="text" wire:model="slug">
        </div>

        <div>
            <label>Description</label>
            <textarea wire:model="description"></textarea>
        </div>

        <div>
            <label>Images</label>
            <input type="file" wire:model="images" multiple>
        </div>

        @for ($i = 1; $i <= 3; $i++)
            <div>
                <label>Title {{ $i }}</label>
                <input type="text" wire:model="title_{{ $i }}">
            </div>

            <div wire:ignore>
                <label>Paragraph {{ $i }}</label>
                <textarea id="paragraph{{ $i }}" class="ckeditor-textarea"></textarea>
            </div>
        @endfor

        <button type="submit">Save</button>
    </form>

    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif
</div>

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            [1, 2, 3].forEach(i => {
                CKEDITOR.replace(`paragraph${i}`);
                CKEDITOR.instances[`paragraph${i}`].on('change', function () {
                    @this.set(`paragraph_${i}`, this.getData());
                });
            });
        });
    </script>
@endpush
