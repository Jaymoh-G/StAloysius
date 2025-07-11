# Menu Logos Configuration Guide

## Overview

The menu.blade.php file now displays two menu logos from the settings table:

-   `main_menu_logo_1` - First menu logo (left side of departments mega menu)
-   `main_menu_logo_2` - Second menu logo (right side of departments mega menu)

## How to Configure Menu Logos

### Step 1: Access Settings

1. Log into your admin dashboard
2. Navigate to **Settings** (requires `view settings` permission)
3. Go to the **"Menu Images"** tab

### Step 2: Upload Menu Logos

1. **Menu Image 1** - Upload your first menu logo

    - This will appear on the left side of the departments mega menu
    - Recommended size: 200x150px or similar aspect ratio
    - Supported formats: JPG, PNG, GIF, WebP

2. **Menu Image 2** - Upload your second menu logo
    - This will appear on the right side of the departments mega menu
    - Recommended size: 200x150px or similar aspect ratio
    - Supported formats: JPG, PNG, GIF, WebP

### Step 3: Save Settings

-   Click **"Save Settings"** to apply your changes
-   The logos will appear immediately on the frontend

## Current Implementation

The menu.blade.php file now includes:

### First Menu Logo (main_menu_logo_1)

```php
@if (setting('main_menu_logo_1'))
<a href="#" class="menu-about-logo">
    <img src="{{ asset('storage/' . setting('main_menu_logo_1')) }}"
         alt="Menu Logo 1"
         style="max-width: 100%; height: auto;" />
</a>
@else
<a href="#" class="menu-about-logo">
    <img src="{{ asset('assets/img/logo/Students1.jpg') }}"
         alt="Default Menu Logo"
         style="max-width: 100%; height: auto;" />
</a>
@endif
```

### Second Menu Logo (main_menu_logo_2)

```php
@if (setting('main_menu_logo_2'))
<a href="#" class="menu-about-logo">
    <img src="{{ asset('storage/' . setting('main_menu_logo_2')) }}"
         alt="Menu Logo 2"
         style="max-width: 100%; height: auto;" />
</a>
@else
<a href="#" class="menu-about-logo">
    <img src="{{ asset('assets/img/logo/Students.jpg') }}"
         alt="Default Menu Logo 2"
         style="max-width: 100%; height: auto;" />
</a>
@endif
```

## Features

✅ **Dynamic Loading** - Logos are loaded from the settings table
✅ **Fallback Images** - Default images shown if no custom logos uploaded
✅ **Responsive Design** - Images scale properly on all devices
✅ **Proper Alt Tags** - SEO-friendly alt text for accessibility
✅ **Storage Path** - Correctly uses Laravel's storage system

## File Storage

-   Uploaded logos are stored in: `storage/app/public/`
-   The settings table stores the relative path (e.g., `settings/logo1.jpg`)
-   The frontend automatically prepends `storage/` to create the full URL

## Troubleshooting

### Logo Not Showing

1. Check if the file was uploaded successfully in settings
2. Verify the file exists in `storage/app/public/`
3. Run `php artisan storage:link` if storage symlink is missing
4. Clear cache: `php artisan cache:clear`

### Logo Too Large/Small

1. Upload a properly sized image (recommended: 200x150px)
2. The CSS ensures images scale responsively
3. You can adjust the `max-width` style if needed

### Permission Issues

1. Ensure you have `view settings` permission
2. Check file permissions on the storage directory
3. Verify the web server can read the uploaded files

## Best Practices

1. **Use Consistent Sizing** - Keep both logos similar dimensions
2. **Optimize Images** - Compress images for faster loading
3. **Use Transparent Backgrounds** - PNG format works best for logos
4. **Test Responsiveness** - Check how logos look on mobile devices
5. **Regular Updates** - Refresh logos periodically to keep content fresh
