<button wire:click.prevent="delete({{ $album->id }})" class="text-red-600 hover:text-red-900">
    <i class="fas fa-trash"></i>
</button>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('confirmDelete', (data) => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.deleteConfirmed(data.id)
                        Swal.fire(
                            'Deleted!',
                            'Gallery album has been deleted.',
                            'success'
                        )
                    }
                })
            });
        });
    </script>
@endpush
