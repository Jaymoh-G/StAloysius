<div>
    <div>
    <form wire:submit.prevent="save" class="space-y-4">

        <x-input label="Name" wire:model="name" />
        <x-input label="Position" wire:model="position" />
        <x-textarea label="Description" wire:model="description" />
        <x-input label="Experience" wire:model="experience" />

        {{-- Image Upload --}}
        <div>
            <label class="block mb-1">Photo</label>
            <input type="file" wire:model="imageTemp">
            @if ($imageTemp)
                <img src="{{ $imageTemp->temporaryUrl() }}" class="h-24 mt-2">
            @endif
        </div>

        {{-- Professional Skills --}}
        <h4 class="font-semibold mt-4">Professional Skills</h4>
        @foreach ($skills as $skill => $percent)
            <div class="flex gap-2 items-center">
                <input type="text" class="input" wire:model="skills.{{ $skill }}" placeholder="{{ $skill }}">
                <button type="button" wire:click="removeSkill('{{ $skill }}')" class="text-red-500">✖</button>
            </div>
        @endforeach
        <div class="flex gap-2">
            <input type="text" wire:model.lazy="newSkill" placeholder="Skill name">
            <input type="number" wire:model.lazy="newPercent" placeholder="%" min="0" max="100">
            <button type="button" wire:click="addSkill" class="btn btn-sm btn-secondary">Add</button>
        </div>

        {{-- Socials --}}
        <h4 class="font-semibold mt-4">Social Links</h4>
        @foreach ($socials as $platform => $url)
            <div class="flex gap-2">
                <input type="text" class="input" wire:model="socials.{{ $platform }}" placeholder="{{ ucfirst($platform) }}">
                <button type="button" wire:click="removeSocial('{{ $platform }}')" class="text-red-500">✖</button>
            </div>
        @endforeach
        <div class="flex gap-2">
            <input type="text" wire:model.lazy="newSocial" placeholder="Platform">
            <input type="text" wire:model.lazy="newSocialLink" placeholder="URL">
            <button type="button" wire:click="addSocial" class="btn btn-sm btn-secondary">Add</button>
        </div>

        <button type="submit" class="btn btn-success mt-4">Save</button>
    </form>
</div>

</div>
