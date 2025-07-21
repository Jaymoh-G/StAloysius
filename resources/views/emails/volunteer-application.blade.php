<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>New Volunteer Application</title>
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
                background-color: #28a745;
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
            .skills-content {
                white-space: pre-wrap;
                background-color: #f8f9fa;
                padding: 15px;
                border-radius: 3px;
                border-left: 4px solid #28a745;
            }
            .application-id {
                background-color: #e9ecef;
                padding: 10px;
                border-radius: 3px;
                font-family: monospace;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h2>🎉 New Volunteer Application</h2>
            <p>
                A new volunteer has submitted an application to join your team!
            </p>
        </div>

        <div class="content">
            <div class="field">
                <div class="field-label">Application ID:</div>
                <div class="application-id">#{{ $application_id }}</div>
            </div>

            <div class="field">
                <div class="field-label">Full Name:</div>
                <div class="field-value">{{ $name }}</div>
            </div>

            <div class="field">
                <div class="field-label">Email Address:</div>
                <div class="field-value">{{ $email }}</div>
            </div>

            <div class="field">
                <div class="field-label">Telephone Number:</div>
                <div class="field-value">{{ $tel }}</div>
            </div>

            <div class="field">
                <div class="field-label">Skills & Expertise:</div>
                <div class="skills-content">{{ $skills }}</div>
            </div>

            @if($additional_information)
            <div class="field">
                <div class="field-label">Additional Information:</div>
                <div class="skills-content">{{ $additional_information }}</div>
            </div>
            @endif

            <div
                style="
                    margin-top: 30px;
                    padding-top: 20px;
                    border-top: 1px solid #ddd;
                    font-size: 12px;
                    color: #666;
                "
            >
                <p><strong>Next Steps:</strong></p>
                <ul>
                    <li>Review the application details above</li>
                    <li>Contact the volunteer at {{ $email }} or {{ $tel }}</li>
                    <li>Schedule an interview or orientation session</li>
                    <li>Update the application status in your dashboard</li>
                </ul>
                <p style="margin-top: 15px">
                    This email was sent from your website volunteer form. You
                    can reply directly to this email to respond to {{ $name }}.
                </p>
            </div>
        </div>
    </body>
</html>
