<div>
    @if (session()->has('success'))
    <div class="alert alert-success">{{ session("success") }}</div>
    @endif
    <div class="mb-3">
        <label for="mailchimp_api_key" class="form-label"
            >Mailchimp API Key</label
        >
        <input
            type="text"
            wire:model.defer="mailchimp_api_key"
            class="form-control @error('mailchimp_api_key') is-invalid @enderror"
            id="mailchimp_api_key"
        />
        @error('mailchimp_api_key')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="mailchimp_list_id" class="form-label"
            >Mailchimp Audience/List ID</label
        >
        <input
            type="text"
            wire:model.defer="mailchimp_list_id"
            class="form-control @error('mailchimp_list_id') is-invalid @enderror"
            id="mailchimp_list_id"
        />
        @error('mailchimp_list_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="mailchimp_dc" class="form-label"
            >Mailchimp Data Center</label
        >
        <input
            type="text"
            wire:model.defer="mailchimp_dc"
            class="form-control @error('mailchimp_dc') is-invalid @enderror"
            id="mailchimp_dc"
            placeholder="e.g. us21"
        />
        @error('mailchimp_dc')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button wire:click="save" class="btn btn-primary">
        Save Newsletter Settings
    </button>
</div>
