<div>
    <div class="p-6 bg-white rounded shadow">

    @if (session()->has('message'))
        <div class="text-green-600 mb-4">{{ session('message') }}</div>
    @endif


    </div>

    <ul class="mt-6">


    </ul>

    <div class="container-fluid">
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Departments</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Categories</a></li>
					</ol>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                           <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="input-group mb-3">
        <input type="text" wire:model="name" class="form-control" placeholder="Category name">
        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

        <button class="btn btn-primary">
            {{ $updateMode ? 'Update' : 'Add' }}
        </button>
        @if ($updateMode)
            <button type="button" wire:click="resetFields" >Cancel</button>
        @endif
    </form>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm mb-0">
                                        <thead>
                                            <tr>

                                                <th class="align-middle" style="min-width: 12.5rem;">Category Name</th>
                                                <th class="align-middle text-end">Action</th>
                                                <th class="no-sort"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="orders">
                                               @foreach ($categories as $cat)
                                            <tr class="btn-reveal-trigger">


                                                <td class="py-2">{{ $cat->name }}
                                                </td>



                                                <td class="text-end">
                                                    <span>
                                                        <a href="javascript:void(0);" class="me-4 btn btn-xs btn-primary me-4" data-bs-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i wire:click="edit({{ $cat->id }})" class="fas fa-pencil-alt color-muted text-end"></i>
                                                        </a>
                                                        <a href="javascript:void(0); " data-bs-toggle="tooltip" data-placement="top" title="btn-close" class="btn btn-xs btn-danger">
                                                            <i  wire:click="delete({{ $cat->id }})" class="fas fa-trash color-danger"></i>
                                                        </a>
                                                    </span>
                                                </td>

                                            </tr>

@endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</div>

