<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\VolunteerApplication;

class VolunteerController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'tel' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'skills' => 'required|string|max:1000',
            'additional_information' => 'nullable|string|max:2000',
            'turnstile_token' => 'required|string',
        ], [
            'name.required' => 'Please enter your full name.',
            'tel.required' => 'Please enter your telephone number.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'skills.required' => 'Please describe your skills and expertise.',
            'turnstile_token.required' => 'Please complete the CAPTCHA.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill all required fields correctly.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Verify Turnstile token with Cloudflare
        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => config('services.turnstile.secret'),
            'response' => $request->input('turnstile_token'),
            'remoteip' => $request->ip(),
        ]);
        if (!($response->json('success') ?? false)) {
            return response()->json([
                'success' => false,
                'message' => 'CAPTCHA verification failed. Please try again.'
            ], 422);
        }

        try {
            // Create the volunteer application in database
            $application = VolunteerApplication::create([
                'name' => trim($request->name),
                'tel' => trim($request->tel),
                'email' => trim($request->email),
                'skills' => trim($request->skills),
                'additional_information' => trim($request->additional_information),
                'status' => 'pending',
            ]);

            // Prepare email data
            $emailData = [
                'name' => $request->name,
                'tel' => $request->tel,
                'email' => $request->email,
                'skills' => $request->skills,
                'additional_information' => $request->additional_information,
                'application_id' => $application->id,
            ];

            // Send email using Laravel's mail system
            Mail::send('emails.volunteer-application', $emailData, function ($message) use ($emailData) {
                $fromEmail = setting('email', 'info@staloysiusgonzaga.org');
                $message->from($fromEmail, 'St Aloysius Gonzaga');
                $toEmail = setting('volunteer_email', 'info@staloysiusgonzaga.org');
                $message->to($toEmail)
                    ->subject('New Volunteer Application: ' . $emailData['name'])
                    ->replyTo($emailData['email'], $emailData['name']);
            });

            return response()->json([
                'success' => true,
                'message' => '🎉 Thank you for your volunteer application! We have received your submission and will contact you within 2-3 business days.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '❌ Sorry, there was an error submitting your application. Please check your information and try again. If the problem persists, please contact us directly.'
            ], 500);
        }
    }
}
