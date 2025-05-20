<div class="container-fluid">
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session("message") }}</div>
    @endif
    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="javascript:void(0)">Departments</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">New Department</a>
            </li>
        </ol>
    </div>
    <form wire:submit.prevent="save">
        <div class="row my-3">
            <div class="col-md-6">
                <div class="form-group">
                    <input
                        type="text"
                        wire:model.defer="title"
                        placeholder="Title"
                        class="form-control"
                    />
                    @error('title')
                    <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <select wire:model.defer="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-body custom-ekeditor" wire:ignore>
                        <label for="ckeditor">Content</label>
                        <!-- Bind this to your Livewire variable e.g. paragraph1 -->
                   <textarea id="ckeditor" class="form-control" wire:model.defer="content"></textarea>

                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener("livewire:load", function () {
    let editorInstance;

    ClassicEditor.create(document.querySelector("#ckeditor"))
        .then((editor) => {
            editorInstance = editor;

            editor.model.document.on("change:data", () => {
                const content = editor.getData();

                Livewire.find(
                    document
                        .querySelector('[wire\\:submit\\.prevent="save"]')
                        .getAttribute("wire:id")
                ).set("content", content);
            });

            window.addEventListener("resetEditor", () => {
                editor.setData("");
            });
        })
        .catch((error) => {
            console.error("CKEditor Init Error:", error);
        });
});

</script>
@endpush
