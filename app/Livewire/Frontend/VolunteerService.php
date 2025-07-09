<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\VolunteerApplication;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class VolunteerService extends Component
{
    protected $layout = 'components.layouts.app';

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

    // Real-time validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected $messages = [
        'name.required' => 'Please enter your full name.',
        'tel.required' => 'Please enter your telephone number.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'skills.required' => 'Please describe your skills and expertise.',
    ];

    public function submitApplication()
    {
        // Debug: Check if method is called
        Log::info('Volunteer form submitted', [
            'name' => $this->name,
            'email' => $this->email,
            'tel' => $this->tel
        ]);

        // Validate the form
        $this->validate();

        try {
            // Create the volunteer application
            $application = VolunteerApplication::create([
                'name' => trim($this->name),
                'tel' => trim($this->tel),
                'email' => trim($this->email),
                'skills' => trim($this->skills),
                'additional_information' => trim($this->additional_information),
                'status' => 'pending',
            ]);

            // Reset form
            $this->reset(['name', 'tel', 'email', 'skills', 'additional_information']);

            // Flash success message
            session()->flash('message', '🎉 Thank you for your volunteer application! We have received your submission and will contact you within 2-3 business days.');

            // Dispatch Livewire event for debugging
            $this->dispatch('volunteer-submitted');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Volunteer application error: ' . $e->getMessage());

            session()->flash('error', '❌ Sorry, there was an error submitting your application. Please check your information and try again. If the problem persists, please contact us directly.');
        }
    }

    public function testMethod()
    {
        $this->dispatch('test-message', ['message' => 'Test method called successfully!']);
        session()->flash('message', 'Test method called successfully!');
    }

    public function render()
    {
        return view('livewire.frontend.volunteer-service');
    }
}
