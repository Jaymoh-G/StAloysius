<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Donation;

class Donations extends Component
{
    public $donationType = '';
    public $amount = '';
    public $name = '';
    public $email = '';
    public $phone = '';
    public $message = '';

    protected $rules = [
        'donationType' => 'required|in:external,direct',
        'amount' => 'required|numeric|min:1',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'message' => 'nullable|string|max:1000',
    ];

    protected $messages = [
        'donationType.required' => 'Please select a donation option.',
        'amount.required' => 'Please enter the donation amount.',
        'amount.numeric' => 'Please enter a valid amount.',
        'amount.min' => 'Minimum donation amount is 1.',
        'name.required' => 'Please enter your name.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'phone.required' => 'Please enter your phone number.',
    ];

    // Real-time validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitDonation()
    {
        $this->validate();

        try {
            // Save donation record
            $donation = Donation::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'amount' => $this->amount,
                'message' => $this->message,
                'donation_type' => $this->donationType,
                'status' => 'pending',
                'reference' => 'DON-' . time() . '-' . substr(md5(uniqid()), 0, 4),
            ]);

            if ($this->donationType === 'external') {
                // Redirect to external donation link
                return redirect()->away('https://your-external-donation-link.com');
            } else {
                // For direct donation, show payment details
                session()->flash('donation_success', 'Thank you for your donation! Please use the payment details below to complete your donation.');
                session()->flash('donation_details', [
                    'amount' => $this->amount,
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'message' => $this->message,
                ]);
            }

            // Reset form
            $this->reset(['amount', 'name', 'email', 'phone', 'message']);
        } catch (\Exception $e) {
            session()->flash('donation_error', 'Sorry, there was an error processing your donation. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.frontend.donations');
    }
}
