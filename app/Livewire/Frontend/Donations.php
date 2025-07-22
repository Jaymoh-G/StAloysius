<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Donation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class Donations extends Component
{
    public $selectedOption = '';
    public $amount = '';
    public $donorName = '';
    public $email = '';
    public $phone = '';
    public $message = '';
    public $turnstile_token;

    protected $rules = [
        'selectedOption' => 'required|in:external,direct',
        'amount' => 'required|numeric|min:1',
        'donorName' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'message' => 'nullable|string|max:1000',
        'turnstile_token' => 'required|string',
    ];

    protected $messages = [
        'selectedOption.required' => 'Please select a donation option.',
        'amount.required' => 'Please enter the donation amount.',
        'amount.numeric' => 'Please enter a valid amount.',
        'amount.min' => 'Minimum donation amount is 1.',
        'donorName.required' => 'Please enter your name.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'turnstile_token.required' => 'Please complete the CAPTCHA.',
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
        // TODO: Add server-side Turnstile verification here

        try {
            // Generate reference number
            $reference = 'DON-' . time() . '-' . substr(md5(uniqid()), 0, 4);

            // Save donation record
            $donation = Donation::create([
                'name' => $this->donorName,
                'email' => $this->email,
                'phone' => $this->phone,
                'amount' => $this->amount,
                'message' => $this->message,
                'donation_type' => $this->selectedOption,
                'status' => 'pending',
                'reference' => $reference,
            ]);

            // Send email notification
            $this->sendDonationEmail($donation, $reference);

            if ($this->selectedOption === 'external') {
                // Redirect to external donation link
                $externalLink = setting('donation_external_link', 'https://your-external-donation-link.com');
                return redirect()->away($externalLink);
            } else {
                // For direct donation, show success message
                session()->flash('donation_success', 'Thank you for your donation! Please use the M-Pesa payment details above to complete your donation.');
            }

            // Reset form
            $this->reset(['amount', 'donorName', 'email', 'phone', 'message']);
        } catch (\Exception $e) {
            Log::error('Donation submission failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'form_data' => [
                    'selectedOption' => $this->selectedOption,
                    'amount' => $this->amount,
                    'donorName' => $this->donorName,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'message' => $this->message,
                ]
            ]);

            session()->flash('donation_error', 'Sorry, there was an error processing your donation. Please try again.');
        }
    }

    private function sendDonationEmail($donation, $reference)
    {
        try {
            // Create beautiful HTML email content manually to avoid Livewire template issues
            $emailContent = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>New Donation Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
        }
        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 1.1rem;
        }
        .content {
            padding: 30px;
        }
        .donation-type-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
        }
        .badge-mpesa {
            background-color: #28a745;
            color: white;
        }
        .badge-online {
            background-color: #667eea;
            color: white;
        }
        .donor-info {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #28a745;
        }
        .donor-info h3 {
            margin: 0 0 15px 0;
            color: #28a745;
            font-size: 1.2rem;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .info-item {
            display: flex;
            flex-direction: column;
        }
        .info-label {
            font-weight: 600;
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        .info-value {
            color: #333;
            font-weight: 500;
        }
        .amount-highlight {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
        }
        .amount-highlight .amount {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .amount-highlight .currency {
            font-size: 1rem;
            opacity: 0.9;
        }
        .message-section {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .message-section h4 {
            margin: 0 0 10px 0;
            color: #856404;
        }
        .message-content {
            color: #856404;
            font-style: italic;
            white-space: pre-wrap;
        }
        .payment-details {
            background-color: #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .payment-details h4 {
            margin: 0 0 15px 0;
            color: #495057;
        }
        .payment-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .payment-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #dee2e6;
        }
        .payment-item:last-child {
            border-bottom: none;
        }
        .payment-label {
            font-weight: 600;
            color: #6c757d;
        }
        .payment-value {
            font-weight: 600;
            color: #28a745;
        }
        .next-steps {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .next-steps h4 {
            margin: 0 0 15px 0;
            color: #0c5460;
        }
        .next-steps ul {
            margin: 0;
            padding-left: 20px;
        }
        .next-steps li {
            margin-bottom: 8px;
            color: #0c5460;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #dee2e6;
        }
        .footer p {
            margin: 0;
            color: #6c757d;
            font-size: 0.9rem;
        }
        .reference {
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
            font-size: 0.9rem;
            color: #495057;
            text-align: center;
            margin: 15px 0;
        }
        @media (max-width: 600px) {
            .info-grid, .payment-grid {
                grid-template-columns: 1fr;
            }
            .header h1 {
                font-size: 1.5rem;
            }
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🎁 New Donation Received</h1>
            <p>A generous donation has been submitted through your website</p>
        </div>

        <div class="content">
            <div class="donation-type-badge ' . ($this->selectedOption === 'direct' ? 'badge-mpesa' : 'badge-online') . '">
                ' . ($this->selectedOption === 'direct' ? 'M-Pesa Donation' : 'Online Donation') . '
            </div>

            <div class="donor-info">
                <h3>👤 Donor Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Full Name:</span>
                        <span class="info-value">' . htmlspecialchars($this->donorName) . '</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email Address:</span>
                        <span class="info-value">' . htmlspecialchars($this->email) . '</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Phone Number:</span>
                        <span class="info-value">' . htmlspecialchars($this->phone ?: 'Not provided') . '</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Donation Type:</span>
                        <span class="info-value">' . ($this->selectedOption === 'direct' ? 'M-Pesa' : 'Online') . '</span>
                    </div>
                </div>
            </div>

            <div class="amount-highlight">
                <div class="amount">KES ' . number_format($this->amount, 2) . '</div>
                <div class="currency">Donation Amount</div>
            </div>';

            // Add message section if message exists
            if ($this->message) {
                $emailContent .= '
            <div class="message-section">
                <h4>💬 Donor\'s Message:</h4>
                <div class="message-content">' . htmlspecialchars($this->message) . '</div>
            </div>';
            }

            // Add payment details for M-Pesa donations
            if ($this->selectedOption === 'direct') {
                $emailContent .= '
            <div class="payment-details">
                <h4>📱 M-Pesa Payment Instructions</h4>
                <div class="payment-grid">
                    <div class="payment-item">
                        <span class="payment-label">Paybill Number:</span>
                        <span class="payment-value">' . setting('mpesa_paybill', '880100') . '</span>
                    </div>
                    <div class="payment-item">
                        <span class="payment-label">Account Number:</span>
                        <span class="payment-value">' . setting('bank_account_number', '6494410018') . '</span>
                    </div>
                    <div class="payment-item">
                        <span class="payment-label">Account Name:</span>
                        <span class="payment-value">' . setting('bank_account_name', 'St Aloysius Gonzaga') . '</span>
                    </div>
                    <div class="payment-item">
                        <span class="payment-label">Amount:</span>
                        <span class="payment-value">KES ' . number_format($this->amount, 2) . '</span>
                    </div>
                </div>
            </div>';
            }

            $emailContent .= '
            <div class="reference">
                Reference: ' . $reference . '
            </div>

            <div class="next-steps">
                <h4>📋 Next Steps</h4>
                <ul>
                    ' . ($this->selectedOption === 'direct' ? '
                    <li>Wait for M-Pesa payment confirmation</li>
                    <li>Verify payment in your M-Pesa account</li>
                    <li>Send thank you email to donor</li>' : '
                    <li>Monitor external donation platform</li>
                    <li>Verify payment when received</li>
                    <li>Send thank you email to donor</li>') . '
                    <li>Update donation status in your records</li>
                    <li>Consider sending a receipt</li>
                </ul>
            </div>
        </div>

        <div class="footer">
            <p><strong>Donation Details:</strong></p>
            <p>Submitted: ' . now()->format('F j, Y \a\t g:i A') . '</p>
            <p>Reference: ' . $reference . '</p>
            <p style="margin-top: 15px; font-size: 0.8rem; color: #adb5bd;">
                This email was sent from your website donation form.
                You can reply directly to this email to contact ' . htmlspecialchars($this->donorName) . '.
            </p>
        </div>
    </div>
</body>
</html>';

            // Send email using raw HTML content to avoid Livewire template issues
            Mail::html($emailContent, function ($message) use ($donation) {
                $toEmail = setting('donation_email', 'info@staloysiusgonzaga.org');
                $message->to($toEmail)
                    ->subject('New Donation Submission: KES ' . number_format($this->amount, 2) . ' from ' . $this->donorName)
                    ->replyTo($this->email, $this->donorName);
            });

            Log::info('Donation email sent successfully', [
                'donation_id' => $donation->id,
                'donor_name' => $this->donorName,
                'amount' => $this->amount,
                'type' => $this->selectedOption
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send donation email', [
                'error' => $e->getMessage(),
                'donation_id' => $donation->id ?? null,
                'donor_name' => $this->donorName,
                'amount' => $this->amount
            ]);
        }
    }

    public function render()
    {
        return view('livewire.frontend.donations');
    }
}
