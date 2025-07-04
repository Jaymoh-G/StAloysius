<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([ 'password' => ['required', 'string',
'current_password'], ]); tap(Auth::user(), $logout(...))->delete();
$this->redirect('/', navigate: true); } }; ?>

<section class="space-y-6">
    <header class="mb-4">
        <h2 class="h5 text-danger mb-1">
            {{ __("Delete Account") }}
        </h2>
        <p class="text-muted small mb-0">
            {{
                __(
                    "Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain."
                )
            }}
        </p>
    </header>

    <button
        class="btn btn-danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        {{ __("Delete Account") }}
    </button>

    <x-modal
        name="confirm-user-deletion"
        :show="$errors->isNotEmpty()"
        focusable
    >
        <form wire:submit="deleteUser" class="p-4">
            <h2 class="h5 text-danger mb-3">
                {{ __("Are you sure you want to delete your account?") }}
            </h2>

            <p class="text-muted small mb-4">
                {{
                    __(
                        "Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account."
                    )
                }}
            </p>

            <div class="mb-4">
                <x-input-label
                    for="password"
                    value="{{ __('Password') }}"
                    class="form-label"
                />

                <x-text-input
                    wire:model="password"
                    id="password"
                    name="password"
                    type="password"
                    class="form-control"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error
                    :messages="$errors->get('password')"
                    class="text-danger small mt-1"
                />
            </div>

            <div class="d-flex justify-content-end gap-2">
                <button
                    type="button"
                    class="btn btn-secondary"
                    x-on:click="$dispatch('close')"
                >
                    {{ __("Cancel") }}
                </button>

                <button type="submit" class="btn btn-outline">
                    {{ __("Delete Account") }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
