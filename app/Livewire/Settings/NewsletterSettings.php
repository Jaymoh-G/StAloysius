<?php

namespace App\Livewire\Settings;

use Livewire\Component;

class NewsletterSettings extends Component
{
    public $mailchimp_api_key;
    public $mailchimp_list_id;
    public $mailchimp_dc;

    public function mount()
    {
        $this->mailchimp_api_key = setting('mailchimp_api_key', '');
        $this->mailchimp_list_id = setting('mailchimp_list_id', '');
        $this->mailchimp_dc = setting('mailchimp_dc', '');
    }

    public function save()
    {
        $this->validate([
            'mailchimp_api_key' => 'required',
            'mailchimp_list_id' => 'required',
            'mailchimp_dc' => 'required',
        ]);

        setting([
            'mailchimp_api_key' => $this->mailchimp_api_key,
            'mailchimp_list_id' => $this->mailchimp_list_id,
            'mailchimp_dc' => $this->mailchimp_dc,
        ]);

        session()->flash('success', 'Newsletter settings updated successfully!');
    }

    public function render()
    {
        return view('livewire.settings.newsletter-settings');
    }
}
