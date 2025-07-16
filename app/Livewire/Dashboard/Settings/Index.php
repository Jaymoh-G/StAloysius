<?php

namespace App\Livewire\Dashboard\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    public $activeTab = 'socials';
    public $settings = [];
    public $uploadedFiles = [];
    public $tempImages = [];
    public $formData = [];

    protected $rules = [
        'settings.*' => 'nullable',
        'uploadedFiles.*' => 'nullable|image|max:2048',
    ];

    public function mount()
    {
        $this->loadSettings();
        logger("Component mounted with " . count($this->settings) . " settings loaded");
    }

    public function hydrate()
    {
        // Restore temporary images when component is hydrated
        $this->preserveTempImages();
    }

    public function loadSettings()
    {
        $groups = ['socials', 'portals', 'donation', 'contact', 'email_notifications', 'menu_images', 'anniversary', 'footer', 'quick_links', 'resource_links'];

        foreach ($groups as $group) { $groupSettings = Setting::getGroup($group);
            foreach ($groupSettings as $setting) {
                $this->settings[$setting->key] = $setting->value;
                // Also store in formData for persistence
                $this->formData[$setting->key] = $setting->value;
            }
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        // Ensure settings are loaded for the current tab
        $this->ensureSettingsLoaded();

        // Preserve temporary images when switching tabs
        $this->preserveTempImages();

        // Debug: Log the current settings state
        logger("Tab switched to: {$tab}");
        logger("Current settings count: " . count($this->settings));
    }

    public function preserveTempImages()
    {
        // Recreate temporary URLs for uploaded files that haven't been saved yet
        foreach ($this->uploadedFiles as $key => $file) {
            if ($file && !isset($this->tempImages[$key])) {
                $this->tempImages[$key] = $file->temporaryUrl();
            }
        }

        // Remove temporary images for keys that no longer have uploaded files
        foreach ($this->tempImages as $key => $tempUrl) {
            if (!isset($this->uploadedFiles[$key]) || !$this->uploadedFiles[$key]) {
                unset($this->tempImages[$key]);
            }
        }
    }

    public function ensureSettingsLoaded()
    {
        // Only load settings if they haven't been loaded yet
        if (empty($this->settings)) {
            $this->loadSettings();
        }
    }

    public function saveSettings()
    {
        $this->validate();

        // Use formData for saving to ensure we have the latest values
        foreach ($this->formData as $key => $value) {
            if ($key !== 'uploadedFiles') {
                Setting::set($key, $value);
            }
        }

        // Handle file uploads
        foreach ($this->uploadedFiles as $key => $file) {
            if ($file) {
                $path = $file->store('settings', 'public');
                Setting::set($key, $path);
            }
        }

        // Clear temporary images
        $this->tempImages = [];
        $this->uploadedFiles = [];

        session()->flash('success', 'Settings updated successfully!');
    }

    public function updatedUploadedFiles($value, $key)
    {
        if (isset($this->uploadedFiles[$key]) && $this->uploadedFiles[$key]) {
            $file = $this->uploadedFiles[$key];
            $this->tempImages[$key] = $file->temporaryUrl();
            logger("Temporary image created for: {$key}");
        } else {
            unset($this->tempImages[$key]);
            logger("Temporary image removed for: {$key}");
        }
    }

    public function updatedFormData($value, $key)
    {
        // Ensure the setting is properly stored in both arrays
        $this->settings[$key] = $value;
        $this->formData[$key] = $value;
        logger("Form data updated: {$key} = {$value}");
    }

    public function render()
    {
        $groups = [
            'socials' => 'Social Media',
            'portals' => 'Portals',
            'donation' => 'Donation',
            'contact' => 'Contact Info',
            'email_notifications' => 'Email Notifications',
            'menu_images' => 'Menu Images',
            'anniversary' => 'Anniversary',
            'footer' => 'Footer',
            'quick_links' => 'Quick Links',
            'resource_links' => 'Resource Links'
        ];

        $settingsByGroup = [];
        foreach ($groups as $groupKey => $groupName) {
            $settingsByGroup[$groupKey] = Setting::getGroup($groupKey);
        }

        return view('livewire.dashboard.settings.index', [
            'groups' => $groups,
            'settingsByGroup' => $settingsByGroup,
        ])->layout('components.layouts.dashboard');
    }
}
