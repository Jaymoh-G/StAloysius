<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\VolunteerApplication;
use Illuminate\Support\Facades\Mail;

class VolunteerService extends Component
{
    public $name = '';
    public $tel = '';
    public $email = '';
    public $skills = '';
    public $additional_information = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'tel' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'skills' => 'required|string|max:1000',
        'additional_information' => 'nullable|string|max:2000',
    ];

    protected $messages = [
        'name.required' => 'Please enter your full name.',
        'tel.required' => 'Please enter your telephone number.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'skills.required' => 'Please describe your skills and expertise.',
    ];

    public function submitApplication()
    {
        $this->validate();

        try {
            VolunteerApplication::create([
                'name' => $this->name,
                'tel' => $this->tel,
                'email' => $this->email,
                'skills' => $this->skills,
                'additional_information' => $this->additional_information,
                'status' => 'pending',
            ]);

            // Reset form
            $this->reset(['name', 'tel', 'email', 'skills', 'additional_information']);

            session()->flash('message', '🎉 Thank you for your volunteer application! We have received your submission and will contact you within 2-3 business days.');
        } catch (\Exception $e) {
            session()->flash('error', '❌ Sorry, there was an error submitting your application. Please check your information and try again. If the problem persists, please contact us directly.');
        }
    }

    public function render()
    {
        return view('livewire.frontend.volunteer-service');
    }
}
