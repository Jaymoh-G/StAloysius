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
                background-color: #f8f9fa;
                padding: 20px;
                border-radius: 5px;
                margin-bottom: 20px;
            }
            .content {
                background-color: #ffffff;
                padding: 20px;
                border: 1px solid #dee2e6;
                border-radius: 5px;
            }
            .field {
                margin-bottom: 15px;
            }
            .label {
                font-weight: bold;
                color: #495057;
            }
            .value {
                padding: 10px;
                background-color: #f8f9fa;
                border-radius: 3px;
                margin-top: 5px;
            }
            .footer {
                margin-top: 20px;
                padding-top: 20px;
                border-top: 1px solid #dee2e6;
                font-size: 12px;
                color: #6c757d;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h2>New Enrollment Inquiry</h2>
            <p>
                You have received a new enrollment inquiry from the St Aloysius
                Gonzaga website.
            </p>
        </div>

        <div class="content">
            <div class="field">
                <div class="label">Name:</div>
                <div class="value">{{ $name }}</div>
            </div>

            <div class="field">
                <div class="label">Email:</div>
                <div class="value">{{ $email }}</div>
            </div>

            <div class="field">
                <div class="label">Telephone:</div>
                <div class="value">{{ $tel }}</div>
            </div>

            <div class="field">
                <div class="label">Message:</div>
                <div class="value">{{ $message }}</div>
            </div>
        </div>

        <div class="footer">
            <p>
                This email was sent from the contact form on the St Aloysius
                Gonzaga Secondary School website.
            </p>
            <p>Submitted on: {{ now()->format('F j, Y \a\t g:i A') }}</p>
        </div>
    </body>
</html>
