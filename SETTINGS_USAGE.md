# Settings System Usage Guide

## Overview

The settings system allows you to manage various configuration values for your application through the admin dashboard. All settings are stored in the database and can be easily accessed throughout your application.

## Available Settings Groups

### 1. Social Media (`socials`)

-   `facebook` - Facebook page URL
-   `twitter` - Twitter/X profile URL
-   `instagram` - Instagram profile URL
-   `linkedin` - LinkedIn profile/page URL
-   `youtube` - YouTube channel URL
-   `tiktok` - TikTok profile URL
-   `whatsapp` - WhatsApp link (e.g., https://wa.me/2547XXXXXXX)

### 2. Portals (`portals`)

-   `student_portal` - Student portal link
-   `staff_portal` - Staff portal link
-   `webmail_portal` - Webmail portal link

### 3. Donation (`donation`)

-   `donation_link` - External donation/payment URL
-   `donation_banner` - Donation banner image

### 4. Contact Info (`contact`)

-   `email` - General contact email
-   `phone` - Main phone number
-   `address` - Physical location address
-   `postal_address` - PO Box
-   `google_map` - Google Maps location URL
-   `office_hours` - Office hours

### 5. Email Notifications (`email_notifications`)

-   `contact_form_email` - Where contact form messages go
-   `newsletter_email` - Newsletter or email marketing sender
-   `volunteer_email` - Volunteer Email
-   `donation_email` - Donation Email
-   `enroll_email` - Enroll Email

### 6. Menu Images (`menu_images`)

-   `main_menu_logo` - Main menu logo
-   `footer_logo` - Footer logo

### 7. Footer (`footer`)

-   `footer_about` - Short about-us snippet for the footer
-   `footer_quick_links` - Quick links
-   `footer_resource_links` - Resource links

## How to Access Settings in Your Code

### Using Helper Functions

```php
// Get a single setting value
$email = setting('email', 'default@example.com');

// Get all settings from a group
$socialSettings = setting_group('socials');
```

### Using the Model Directly

```php
use App\Models\Setting;

// Get a single setting
$email = Setting::get('email', 'default@example.com');

// Set a setting
Setting::set('email', 'new@example.com', 'contact', 'email', 'Contact Email');

// Get all settings from a group
$contactSettings = Setting::getGroup('contact');
```

### In Blade Templates

```php
{{ setting('email', 'default@example.com') }}

@if(setting('facebook'))
    <a href="{{ setting('facebook') }}">Facebook</a>
@endif

@foreach(setting_group('socials') as $social)
    @if($social->value)
        <a href="{{ $social->value }}">{{ $social->label }}</a>
    @endif
@endforeach
```

## Admin Dashboard Access

1. Navigate to the dashboard
2. Look for the "Settings" menu item in the sidebar
3. Click on "Settings" to access the settings management page
4. Use the tabs to navigate between different setting groups
5. Update values and click "Save Settings"

## Permissions

The settings module requires the `view settings` permission. Make sure users who need to access settings have this permission assigned to their role.

## File Uploads

For file-type settings (like logos and banners):

1. Select the file in the settings form
2. The file will be stored in the `storage/app/public/settings/` directory
3. The file path will be stored in the database
4. Use `asset('storage/' . setting('main_menu_logo'))` to display the image

## Best Practices

1. Always provide default values when accessing settings
2. Check if a setting exists before using it
3. Use appropriate input types (email, url, textarea, file) for different settings
4. Group related settings together
5. Use descriptive labels and descriptions for better user experience

## Example Usage in Components

```php
// In a Livewire component
public function mount()
{
    $this->contactEmail = setting('email');
    $this->phoneNumber = setting('phone');
    $this->address = setting('address');
}

// In a controller
public function index()
{
    $socialLinks = setting_group('socials');
    return view('welcome', compact('socialLinks'));
}
```
