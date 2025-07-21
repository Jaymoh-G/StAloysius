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
        </style>
    </head>
    <body>
        <div class="header">
            <h2>New Contact Form Submission</h2>
            <p>
                A new message has been submitted through your website's contact
                form.
            </p>
        </div>

        <div class="content">
            <div class="field">
                <div class="field-label">Name:</div>
                <div class="field-value">{{ $name }}</div>
            </div>

            <div class="field">
                <div class="field-label">Email:</div>
                <div class="field-value">{{ $email }}</div>
            </div>

            <div class="field">
                <div class="field-label">Subject:</div>
                <div class="field-value">{{ $subject }}</div>
            </div>

            <div class="field">
                <div class="field-label">Message:</div>
                <div class="message-content">{{ $message }}</div>
            </div>

            <div
                style="
                    margin-top: 30px;
                    padding-top: 20px;
                    border-top: 1px solid #ddd;
                    font-size: 12px;
                    color: #666;
                "
            >
                <p>
                    This email was sent from your website contact form. You can
                    reply directly to this email to respond to {{ $name }}.
                </p>
            </div>
        </div>
    </body>
</html>
