<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">{{ $pageId ? 'Edit' : 'Create' }} Static Page</h4>
                    <div class="page-title-right">
                        <a href="{{ route('dashboard.static-pages.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Back to Pages
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ $activeTab == 'general' ? 'active' : '' }}" 
                                   wire:click.prevent="$set('activeTab', 'general')" href="#">
                                    General
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $activeTab == 'section1' ? 'active' : '' }}" 
                                   wire:click.prevent="$set('activeTab', 'section1')" href="#">
                                    Section 1
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $activeTab == 'section2' ? 'active' : '' }}" 
                                   wire:click.prevent="$set('activeTab', 'section2')" href="#">
                                    Section 2
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $activeTab == 'section3' ? 'active' : '' }}" 
                                   wire:click.prevent="$set('activeTab', 'section3')" href="#">
                                    Section 3
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $activeTab == 'section4' ? 'active' : '' }}" 
                                   wire:click.prevent="$set('activeTab', 'section4')" href="#">
                                    Section 4
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $activeTab == 'section5' ? 'active' : '' }}" 
                                   wire:click.prevent="$set('activeTab', 'section5')" href="#">
                                    Section 5
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $activeTab == 'section6' ? 'active' : '' }}" 
                                   wire:click.prevent="$set('activeTab', 'section6')" href="#">
                                    Section 6
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $activeTab == 'seo' ? 'active' : '' }}" 
                                   wire:click.prevent="$set('activeTab', 'seo')" href="#">
                                    SEO
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content p-3">
                            <!-- General Tab -->
                            <div class="tab-pane {{ $activeTab == 'general' ? 'active' : '' }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" class="form-control" wire:model="title">
                                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Slug</label>
                                            <input type="text" class="form-control" wire:model="slug">
                                            @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Banner Image</label>
                                    <input type="file" class="form-control" wire:model="banner_image">
                                    @error('banner_image') <span class="text-danger">{{ $message }}</span> @enderror
                                    
                                    @if($existingBanner)
                                        <div class="mt-2">
                                            <img src="{{ Storage::url($existingBanner) }}" alt="Banner" class="img-thumbnail" style="max-height: 200px">
                                        </div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Content</label>
                                    <div wire:ignore>
                                        <textarea id="content" wire:model="content"></textarea>
                                    </div>
                                    @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Images</label>
                                    <input type="file" class="form-control" wire:model="images" multiple>
                                    @error('images.*') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                @if(count($existingImages) > 0)
                                    <div class="row">
                                        @foreach($existingImages as $image)
                                            <div class="col-md-3 mb-3">
                                                <div class="card">
                                                    <img src="{{ Storage::url($image->path) }}" class="card-img-top" alt="Image">
                                                    <div class="card-body">
                                                        <button type="button" class="btn btn-sm btn-danger" wire:click="deleteImage({{ $image->id }})">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- Section 1 Tab -->
                            <div class="tab-pane {{ $activeTab == 'section1' ? 'active' : '' }}">
                                <div class="mb-3">
                                    <label class="form-label">Section 1 Title</label>
                                    <input type="text" class="form-control" wire:model="section_1_title">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Section 1 Content</label>
                                    <div wire:ignore>
                                        <textarea id="section_1_content" wire:model="section_1_content"></textarea>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Section 1 Images</label>
                                    <input type="file" class="form-control" wire:model="section_1_images" multiple>
                                    @error('section_1_images.*') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                @if(count($existingSection1Images) > 0)
                                    <div class="row">
                                        @foreach($existingSection1Images as $image)
                                            <div class="col-md-3 mb-3">
                                                <div class="card">
                                                    <img src="{{ Storage::url($image->path) }}" class="card-img-top" alt="Image">
                                                    <div class="card-body">
                                                        <button type="button" class="btn btn-sm btn-danger" wire:click="deleteImage({{ $image->id }})">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- Section 2 Tab -->
                            <div class="tab-pane {{ $activeTab == 'section2' ? 'active' : '' }}">
                                <div class="mb-3">
                                    <label class="form-label">Section 2 Title</label>
                                    <input type="text" class="form-control" wire:model="section_2_title">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Section 2 Content</label>
                                    <div wire:ignore>
                                        <textarea id="section_2_content" wire:model="section_2_content"></textarea>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Section 2 Images</label>
                                    <input type="file" class="form-control" wire:model="section_2_images" multiple>
                                    @error('section_2_images.*') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                @if(count($existingSection2Images) > 0)
                                    <div class="row">
                                        @foreach($existingSection2Images as $image)
                                            <div class="col-md-3 mb-3">
                                                <div class="card">
                                                    <img src="{{ Storage::url($image->path) }}" class="card-img-top" alt="Image">
                                                    <div class="card-body">
                                                        <button type="button" class="btn btn-sm btn-danger" wire:click="deleteImage({{ $image->id }})">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- Section 3 Tab -->
                            <div class="tab-pane {{ $activeTab == 'section3' ? 'active' : '' }}">
                                <!-- Similar structure as Section 1 and 2 -->
                                <div class="mb-3">
                                    <label class="form-label">Section 3 Title</label>
                                    <input type="text" class="form-control" wire:model="section_3_title">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Section 3 Content</label>
                                    <div wire:ignore>
                                        <textarea id="section_3_content" wire:model="section_3_content"></textarea>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Section 3 Images</label>
                                    <input type="file" class="form-control" wire:model="section_3_images" multiple>
                                </div>

                                @if(count($existingSection3Images) > 0)
                                    <div class="row">
                                        @foreach($existingSection3Images as $image)
                                            <div class="col-md-3 mb-3">
                                                <div class="card">
                                                    <img src="{{ Storage::url($image->path) }}" class="card-img-top" alt="Image">
                                                    <div class="card-body">
                                                        <button type="button" class="btn btn-sm btn-danger" wire:click="deleteImage({{ $image->id }})">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- Section 4 Tab -->
                            <div class="tab-pane {{ $activeTab == 'section4' ? 'active' : '' }}">
                                <!-- Similar structure as previous sections -->
                                <div class="mb-3">
                                    <label class="form-label">Section 4 Title</label>
                                    <input type="text" class="form-control" wire:model="section_4_title">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Section 4 Content</label>
                                    <div wire:ignore>
                                        <textarea id="section_4_content" wire:model="section_4_content"></textarea>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Section 4 Images</label>
                                    <input type="file" class="form-control" wire:model="section_4_images" multiple>
                                </div>

                                @if(count($existingSection4Images) > 0)
                                    <div class="row">
                                        @foreach($existingSection4Images as $image)
                                            <div class="col-md-3 mb-3">
                                                <div class="card">
                                                    <img src="{{ Storage::url($image->path) }}" class="card-img-top" alt="Image">
                                                    <div class="card-body">
                                                        <button type="button" class="btn btn-sm btn-danger