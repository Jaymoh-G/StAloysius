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
    public $showPaymentDetails = false;

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

        // Show payment details when direct payment is selected
        if ($propertyName === 'donationType') {
            $this->showPaymentDetails = ($this->donationType === 'direct');
        }
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
                $externalLink = setting('donation_external_link', 'https://your-external-donation-link.com');
                return redirect()->away($externalLink);
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

                // Keep the payment details visible
                $this->showPaymentDetails = true;
            }

            // Reset form but keep donation type
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
