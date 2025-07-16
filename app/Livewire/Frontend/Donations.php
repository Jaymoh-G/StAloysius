<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Donation;

class Donations extends Component
{
    public $selectedOption = '';
    public $amount = '';
    public $donorName = '';
    public $email = '';
    public $phone = '';
    public $message = '';

    protected $rules = [
        'selectedOption' => 'required|in:external,direct',
        'amount' => 'required|numeric|min:1',
        'donorName' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'message' => 'nullable|string|max:1000',
    ];

    protected $messages = [
        'selectedOption.required' => 'Please select a donation option.',
        'amount.required' => 'Please enter the donation amount.',
        'amount.numeric' => 'Please enter a valid amount.',
        'amount.min' => 'Minimum donation amount is 1.',
        'donorName.required' => 'Please enter your name.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
    ];

    // Real-time validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function selectOption($option)
    {
        $this->selectedOption = $option;
    }

    public function submitDonation()
    {
        $this->validate();

        try {
            // Save donation record
            $donation = Donation::create([
                'name' => $this->donorName,
                'email' => $this->email,
                'phone' => $this->phone,
                'amount' => $this->amount,
                'message' => $this->message,
                'donation_type' => $this->selectedOption,
                'status' => 'pending',
                'reference' => 'DON-' . time() . '-' . substr(md5(uniqid()), 0, 4),
            ]);

            if ($this->selectedOption === 'external') {
                // Redirect to external donation link
                $externalLink = setting('external_donation_url', 'https://your-external-donation-link.com');
                return redirect()->away($externalLink);
            } else {
                // For direct donation, show success message
                session()->flash('donation_success', 'Thank you for your donation! Please use the M-Pesa payment details above to complete your donation.');
            }

            // Reset form
            $this->reset(['amount', 'donorName', 'email', 'phone', 'message']);
        } catch (\Exception $e) {
            session()->flash('donation_error', 'Sorry, there was an error processing your donation. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.frontend.donations')
            ->layout('components.layouts.app');
    }
}
