<x-layouts.dashboard>
    <div class="container-fluid py-4">
        <div class="row justify-content-center g-4">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow rounded">
                    <div class="card-header bg-primary text-white fw-bold">
                        Profile Information
                    </div>
                    <div class="card-body p-4">
                        <livewire:profile.update-profile-information-form />
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow rounded">
                    <div class="card-header bg-secondary text-white fw-bold">
                        Update Password
                    </div>
                    <div class="card-body p-4">
                        <livewire:profile.update-password-form />
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="card h-100 shadow rounded">
                    <div class="card-header bg-danger text-white fw-bold">
                        Delete Account
                    </div>
                    <div class="card-body p-4">
                        <livewire:profile.delete-user-form />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
