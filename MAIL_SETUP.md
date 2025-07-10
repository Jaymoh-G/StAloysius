# Mail Configuration Guide

## Option 1: Using Laravel's Mail System (Recommended)

### 1. Configure your `.env` file

Add these lines to your `.env` file:

```env
# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 2. For Gmail Setup:

-   Enable 2-factor authentication on your Gmail account
-   Generate an App Password (not your regular password)
-   Use the App Password in `MAIL_PASSWORD`

### 3. For Other SMTP Providers:

-   **Outlook/Hotmail**: Use `smtp-mail.outlook.com` with port 587
-   **Yahoo**: Use `smtp.mail.yahoo.com` with port 587
-   **Custom SMTP**: Use your provider's SMTP settings

## Option 2: Using Mailgun (Free tier available)

```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.mailgun.org
MAILGUN_SECRET=your-mailgun-secret
```

## Option 3: Using SendGrid (Free tier available)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
```

## Testing the Configuration

After setting up your mail configuration, you can test it by running:

```bash
php artisan tinker
```

Then in tinker:

```php
Mail::raw('Test email', function($message) {
    $message->to('info@breezetech.co.ke')->subject('Test');
});
```

## Current Implementation

### Contact Form

The contact form now uses Laravel's mail system with:

-   **Controller**: `app/Http/Controllers/ContactController.php`
-   **Email Template**: `resources/views/emails/contact-form.blade.php`
-   **Route**: `POST /contact-submit`
-   **Recipient**: `info@breezetech.co.ke`

### Volunteer Application Form

The volunteer form now uses Laravel's mail system with:

-   **Controller**: `app/Http/Controllers/VolunteerController.php`
-   **Email Template**: `resources/views/emails/volunteer-application.blade.php`
-   **Route**: `POST /volunteer-submit`
-   **Recipient**: `info@breezetech.co.ke`
-   **Database**: Stores applications in `volunteer_applications` table

Both forms will send emails to `info@breezetech.co.ke` once you configure your mail settings in the `.env` file.
