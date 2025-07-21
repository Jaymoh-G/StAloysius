<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill all required fields correctly.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Prepare email data and ensure all values are strings
            $emailData = [
                'name' => (string) $request->name,
                'email' => (string) $request->email,
                'subject' => (string) $request->subject,
                'message' => (string) $request->message,
            ];

            // Debug: Log the email data types and values
            Log::info('Email data types', [
                'name_type' => gettype($emailData['name']),
                'email_type' => gettype($emailData['email']),
                'subject_type' => gettype($emailData['subject']),
                'message_type' => gettype($emailData['message']),
                'name_value' => $emailData['name'],
                'email_value' => $emailData['email'],
                'subject_value' => $emailData['subject'],
                'message_value' => $emailData['message'],
            ]);

            // Additional debugging: Check if any variable contains an object
            foreach ($emailData as $key => $value) {
                if (is_object($value)) {
                    Log::error("Variable {$key} is an object: " . get_class($value));
                }
            }

            // Log the attempt
            Log::info('Contact form submission attempt', $emailData);

            // Create beautiful HTML email content manually to avoid Livewire template issues
            $emailContent = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .content {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .field {
            margin-bottom: 15px;
        }
        .field-label {
            font-weight: bold;
            color: #555;
        }
        .field-value {
            margin-top: 5px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 3px;
        }
        .message-content {
            white-space: pre-wrap;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 3px;
            border-left: 4px solid #007bff;
        }
        .contact-info {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .contact-info h4 {
            margin-top: 0;
            color: #007bff;
        }
        .contact-info p {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>📧 New Contact Form Submission</h2>
        <p>A new message has been submitted through your website\'s contact form.</p>
    </div>

    <div class="content">
        <div class="field">
            <div class="field-label">Full Name:</div>
            <div class="field-value">' . htmlspecialchars($emailData['name']) . '</div>
        </div>

        <div class="field">
            <div class="field-label">Email Address:</div>
            <div class="field-value">' . htmlspecialchars($emailData['email']) . '</div>
        </div>

        <div class="field">
            <div class="field-label">Subject:</div>
            <div class="field-value">' . htmlspecialchars($emailData['subject']) . '</div>
        </div>

        <div class="field">
            <div class="field-label">Message:</div>
            <div class="message-content">' . htmlspecialchars($emailData['message']) . '</div>
        </div>

        <div class="contact-info">
            <h4>📋 Contact Information</h4>
            <p><strong>From:</strong> ' . htmlspecialchars($emailData['name']) . '</p>
            <p><strong>Email:</strong> ' . htmlspecialchars($emailData['email']) . '</p>
            <p><strong>Subject:</strong> ' . htmlspecialchars($emailData['subject']) . '</p>
            <p><strong>Submitted:</strong> ' . now()->format('F j, Y \a\t g:i A') . '</p>
        </div>

        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 12px; color: #666;">
            <p><strong>Next Steps:</strong></p>
            <ul>
                <li>Review the message details above</li>
                <li>Reply directly to this email to respond to ' . htmlspecialchars($emailData['name']) . '</li>
                <li>Consider adding ' . htmlspecialchars($emailData['name']) . ' to your contact database</li>
                <li>Follow up within 24-48 hours for best customer service</li>
            </ul>
            <p style="margin-top: 15px">
                This email was sent from your website contact form. You can reply directly to this email to respond to ' . htmlspecialchars($emailData['name']) . '.
            </p>
        </div>
    </div>
</body>
</html>';

            // Send email using raw HTML content to avoid Livewire template issues
            Mail::html($emailContent, function ($message) use ($emailData) {
                $message->to('info@staloysiusgonzaga.org')
                    ->subject('New Contact Form Submission: ' . $emailData['subject'])
                    ->replyTo($emailData['email'], $emailData['name']);
            });

            Log::info('Contact form email sent successfully');

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully!'
            ]);
        } catch (\Exception $e) {
            // Log the error details
            Log::error('Contact form submission failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'form_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error sending your message. Please try again later.',
                'debug' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
