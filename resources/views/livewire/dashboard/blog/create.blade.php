<div class="container-fluid">
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session("message") }}</div>
    @endif

    <form wire:submit.prevent="save">
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
                id="ckeditor"
                wire:model.defer="content"
                class="form-control"
            ></textarea>
            @error('content')
            <span class="text-danger d-block">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Post</button>
    </form>
    <button type="button" class="btn btn-info" wire:click="debug">Debug</button>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    console.log('here')
    document.addEventListener("livewire:load", () => {
          console.log('ClassicEditor')
        ClassicEditor.create(document.querySelector("#ckeditor"))
            .then((editor) => {
                console.log(editor)
                editor.model.document.on("change:data", () => {
                     console.log('change')
                    Livewire.emit("updateContent", editor.getData());
                });

                window.addEventListener("resetEditor", () => {
                    editor.setData("");
                });
            })
            .catch((error) => console.error("CKEditor error:", error));
    });
</script>
@endpush
