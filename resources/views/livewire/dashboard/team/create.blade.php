<div>
   <div class="space-y-4">

    <h2 class="card-title">{{ $teamMemberId ? 'Edit' : 'Add' }} Team Member</h2>
<div class="row">
      <div class="col-md-6">
    <x-input label="Name" wire:model="name" />

      </div>
       <div class="col-md-6">
    <x-input label="Position" wire:model="position" />
</div>
</div>
    <x-textarea label="Description" wire:model="description" />
    <x-textarea label="Experience" wire:model="experience" />



    <div class="row">
     <div class="col-md-6">
           {{-- Professional Skills --}}
    <div class="mt-4">
        <h4 class="font-semibold">Professional Skills</h4>
        @foreach ($skills as $skill => $percent)
            <div class="flex items-center gap-2">
                <input type="text" class="input" value="{{ $skill }}" disabled>
                <input type="number" class="input w-24" value="{{ $percent }}" disabled>
                <button type="button" wire:click="removeSkill('{{ $skill }}')" class="text-red-500">✖</button>
            </div>
        @endforeach

        <div class="flex gap-2 mt-2">
            <input type="text" class="input" wire:model.defer="newSkill" placeholder="Skill">
            <input type="number" class="input w-24" wire:model.defer="newPercent" placeholder="%" min="0" max="100">
            <button wire:click="addSkill" type="button" class="btn btn-sm btn-secondary">+ Add</button>
        </div>
    </div>
     </div>

 <div class="col-md-6">
    {{-- Social Links --}}
    <div class="mt-4">
        <h4 class="font-semibold">Social Links</h4>
        @foreach ($socials as $platform => $url)
            <div class="flex gap-2 items-center">
                <input type="text" class="input" value="{{ $platform }}" disabled>
                <input type="text" class="input" value="{{ $url }}" disabled>
                <button wire:click="removeSocial('{{ $platform }}')" type="button" class="text-red-500">✖</button>
            </div>
        @endforeach

        <div class="flex gap-2 mt-2">
            <input type="text" class="input" wire:model.defer="newSocial" placeholder="Platform (e.g. LinkedIn)">
            <input type="text" class="input" wire:model.defer="newSocialLink" placeholder="URL">
            <button wire:click="addSocial" type="button" class="btn btn-sm btn-secondary">+ Add</button>
        </div>
    </div>
</div>
    </div>
    {{-- Image Upload --}}

    @if ($image && !$imageTemp)
    <div class="mt-2">
        <label>Current Photo:</label><br>
        <img src="{{ asset('storage/' . $image) }}" class="h-24">
    </div>
@endif
    <div>
        <label>Photo</label>
        <input type="file" wire:model="imageTemp">
        @if ($imageTemp)
            <img src="{{ $imageTemp->temporaryUrl() }}" class="h-24 mt-2">
        @endif
    </div>
    <button type="submit" wire:click="save" class="btn btn-success mt-4"> {{ $teamMemberId ? 'Update' : 'Save' }}</button>

</div>

</div>
