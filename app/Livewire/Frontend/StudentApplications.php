<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\StudentApplication;
use Illuminate\Support\Facades\Mail;
use App\Models\Setting;

class StudentApplications extends Component
{
    use WithFileUploads;

    public $student_name;
    public $kpsea_index_number;
    public $current_residence;
    public $guardian_name;
    public $guardian_phone;
    public $application_letter;
    public $academic_certificates = [];
    public $death_certificates = [];

    public $successMessage;
    public $turnstile_token;
    public $applicationOpen;
    public $applicationNote;
    public $applicationDeadline;

    protected function rules()
    {
        return [
            'student_name' => 'required|string|max:255',
            'kpsea_index_number' => 'required|string|max:255',
            'current_residence' => 'required|string|max:255',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:30',
            'application_letter' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'academic_certificates' => 'required|array|min:1|max:3',
            'academic_certificates.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:4096',
            'death_certificates' => 'nullable|array|max:2',
            'death_certificates.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:4096',
            'turnstile_token' => 'required|string',
        ];
    }

    public function mount()
    {
        $this->applicationOpen = Setting::isApplicationOpen();
        $this->applicationNote = Setting::getApplicationNote();
        $this->applicationDeadline = Setting::getApplicationDeadline();
    }

    public function submit()
    {
        if (!Setting::isApplicationOpen()) {
            $this->addError('general', 'The application period is currently closed.');
            return;
        }
        $this->validate();
        // TODO: Add server-side Turnstile verification here

        // Store files
        $applicationLetterPath = $this->application_letter->store('student_applications/letters', 'public');
        $academicCertificatesPaths = [];
        foreach ($this->academic_certificates as $file) {
            $academicCertificatesPaths[] = $file->store('student_applications/certificates', 'public');
        }
        $deathCertificatesPaths = [];
        if ($this->death_certificates) {
            foreach ($this->death_certificates as $file) {
                $deathCertificatesPaths[] = $file->store('student_applications/death_certificates', 'public');
            }
        }

        // Save to DB
        $application = StudentApplication::create([
            'student_name' => $this->student_name,
            'kpsea_index_number' => $this->kpsea_index_number,
            'current_residence' => $this->current_residence,
            'guardian_name' => $this->guardian_name,
            'guardian_phone' => $this->guardian_phone,
            'application_letter' => $applicationLetterPath,
            'academic_certificates' => $academicCertificatesPaths,
            'death_certificate' => $deathCertificatesPaths ? $deathCertificatesPaths : null,
        ]);

        // Send email notification
        $this->sendApplicationEmail($application, $applicationLetterPath, $academicCertificatesPaths, $deathCertificatesPaths);

        $this->reset(['student_name', 'kpsea_index_number', 'current_residence', 'guardian_name', 'guardian_phone', 'application_letter', 'academic_certificates', 'death_certificates']);
        $this->successMessage = 'Your application has been submitted successfully!';
    }

    private function sendApplicationEmail($application, $applicationLetterPath, $academicCertificatesPaths, $deathCertificatesPaths)
    {
        $applicantData = [
            'student_name' => $this->student_name,
            'kpsea_index_number' => $this->kpsea_index_number,
            'current_residence' => $this->current_residence,
            'guardian_name' => $this->guardian_name,
            'guardian_phone' => $this->guardian_phone,
            'application_letter' => $applicationLetterPath,
            'academic_certificates' => $academicCertificatesPaths,
            'death_certificates' => $deathCertificatesPaths,
            'submitted_at' => now()->format('F j, Y \a\t g:i A'),
        ];

        $appUrl = config('app.url');
        $storageUrl = $appUrl . '/storage/';

        $emailContent = view('emails.student-application', [
            'data' => $applicantData,
            'storageUrl' => $storageUrl,
        ])->render();

        Mail::html($emailContent, function ($message) use ($applicantData) {
            $fromEmail = setting('email', 'info@staloysiusgonzaga.org');
            $toEmail = setting('enroll_email', 'info@staloysiusgonzaga.org');
            $message->from($fromEmail, 'St Aloysius Gonzaga');
            $message->to($toEmail)
                ->subject('New Student Application: ' . $applicantData['student_name']);
        });
    }

    public function render()
    {
        return view('livewire.frontend.student-applications', [
            'applicationOpen' => $this->applicationOpen,
            'applicationNote' => $this->applicationNote,
            'applicationDeadline' => $this->applicationDeadline,
        ]);
    }
}
