<div class="container-fluid">
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session("message") }}</div>
    @endif

    <form wire:submit.prevent="save(document.querySelector('#content').value)">
        <div class="mb-3">
            <input
                type="text"
                wire:model.defer="title"
                placeholder="Title"
                class="form-control"
            />
            @error('title')
            <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div wire:ignore class="mb-3">
            <textarea
                    wire:key="editor-{{ now() }}"
                    id="content"
                    placeholder="Enter content"
                    class="form-control"
                    required
                >
                {!! $content !!}
            </textarea>
            @error('content')
            <span class="text-danger d-block">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save Post</button>
    </form>
    <button type="button" class="btn btn-info" wire:click="debug">Debug</button>
</div>
@push('scripts')

<script src="{{ asset('adminassets/vendor/ckeditor/ckeditor.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log("Livewire loaded");
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(editor => {
                editor.model.document.on("change:data", (event) => {
                    @this.set('content', editor.getData());
                });
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endpush