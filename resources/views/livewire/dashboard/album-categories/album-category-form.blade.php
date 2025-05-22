
    <div>
    <form wire:submit.prevent="save">
        <div>
            <label>Name</label>
            <input type="text" wire:model="name" placeholder="Category Name">
        </div>

        <div>
            <label>Slug</label>
            <input type="text" wire:model="slug" placeholder="Slug" readonly>
        </div>

        <button type="submit">Save</button>
    </form>
</div>

