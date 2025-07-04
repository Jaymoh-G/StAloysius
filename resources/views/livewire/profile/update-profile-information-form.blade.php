<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{state, mount, validate, wire, dispatch, redirect, flash};


use Livewire\WithFileUploads;

state([
    'name' =>
'', 'email' => '', 'photo' => null, ]); mount(function () { $this->name =
Auth::user()->name; $this->email = Auth::user()->email; }); function
updateProfileInformation() { $user = Auth::user(); $validated = validate([
'name' => ['required', 'string', 'max:255'], 'email' => [ 'required', 'string',
'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id),
], 'photo' => ['nullable', 'image', 'max:1024'], ]); $user->fill($validated); if
($this->photo) { if ($user->profile_photo_path &&
Storage::disk('public')->exists($user->profile_photo_path)) {
Storage::disk('public')->delete($user->profile_photo_path); } $photoPath =
$this->photo->store('profile-photos', 'public'); $user->profile_photo_path =
$photoPath; } if ($user->isDirty('email')) { $user->email_verified_at = null; }
$user->save(); $this->reset('photo'); dispatch('profile-updated', name:
$user->name); } function sendVerification() { $user = Auth::user(); if
($user->hasVerifiedEmail()) { redirect(route('dashboard.index')); return; }
$user->sendEmailVerificationNotification(); flash('status',
'verification-link-sent'); } ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 mb-3">
            {{ __("Profile Information") }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 mb-3">
            {{
                __(
                    "Update your account's profile information, email address, and profile photo."
                )
            }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-3">
        <div class="mb-3 text-center">
            <div class="mb-2">
                @if (auth()->user()->profile_photo_path ?? false)
                <img
                    src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}"
                    alt="Profile Photo"
                    class="rounded-circle"
                    width="100"
                    height="100"
                />
                @else
                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&size=100"
                    alt="Profile Photo"
                    class="rounded-circle"
                    width="100"
                    height="100"
                />
                @endif
            </div>

            @if ($photo ?? false)
            <div class="mb-2">
                <img
                    src="{{ $photo->temporaryUrl() }}"
                    class="rounded-circle"
                    width="100"
                    height="100"
                />
            </div>
            @endif

            <div class="mb-2">
                <input
                    type="file"
                    class="form-control"
                    wire:model="photo"
                    accept="image/*"
                />
                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
            </div>
        </div>

        <div class="mb-3">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input
                wire:model="name"
                id="name"
                name="name"
                type="text"
                class="form-control"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                wire:model="email"
                id="email"
                name="email"
                type="email"
                class="form-control"
                required
                autocomplete="username"
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ( auth()->user() instanceof
            \Illuminate\Contracts\Auth\MustVerifyEmail &&
            !auth()->user()->hasVerifiedEmail() )
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __("Your email address is unverified.") }}
                    <button
                        wire:click.prevent="sendVerification"
                        class="btn btn-link p-0 align-baseline"
                    >
                        {{
                            __("Click here to re-send the verification email.")
                        }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-success">
                    {{
                        __(
                            "A new verification link has been sent to your email address."
                        )
                    }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-outline-primary">
                {{ __("Save") }}
            </button>
            <x-action-message class="ms-2" on="profile-updated">
                {{ __("Saved.") }}
            </x-action-message>
        </div>
    </form>
</section>
