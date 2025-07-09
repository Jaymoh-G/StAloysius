<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class HomeContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $tel = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'tel' => 'required|string|max:20',
        'message' => 'required|string|max:1000',
    ];

    protected $messages = [
        'name.required' => 'Please enter your name.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'tel.required' => 'Please enter your telephone number.',
        'message.required' => 'Please enter your message.',
    ];

    // Real-time validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {
        $this->validate();

        try {
            // Send email
            Mail::send('emails.contact-form', [
                'name' => $this->name,
                'email' => $this->email,
                'tel' => $this->tel,
                'message' => $this->message,
            ], function ($message) {
                $message->to(config('mail.admin_email', 'admin@staloysius.com'))
                    ->subject('New Enrollment Inquiry - St Aloysius Gonzaga')
                    ->replyTo($this->email, $this->name);
            });

            // Reset form
            $this->reset(['name', 'email', 'tel', 'message']);

            // Flash success message
            session()->flash('contact_success', 'Thank you for your message! We will get back to you soon.');
        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage());
            session()->flash('contact_error', 'Sorry, there was an error sending your message. Please try again later.');
        }
    }

    public function render()
    {
        return view('livewire.frontend.home-contact-form');
    }
}
