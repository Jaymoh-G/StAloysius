<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Helpers\SeoHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register SEO helper functions
        if (!function_exists('seo_slug')) {
            function seo_slug($string, $separator = '-')
            {
                return SeoHelper::generateSlug($string, $separator);
            }
        }

        if (!function_exists('seo_description')) {
            function seo_description($text, $length = 160)
            {
                return SeoHelper::truncateDescription($text, $length);
            }
        }

        if (!function_exists('seo_title')) {
            function seo_title($title, $suffix = null, $maxLength = 60)
            {
                return SeoHelper::generateMetaTitle($title, $suffix, $maxLength);
            }
        }

        if (!function_exists('seo_clean_text')) {
            function seo_clean_text($text)
            {
                return SeoHelper::cleanText($text);
            }
        }

        if (!function_exists('seo_keywords')) {
            function seo_keywords($text, $maxKeywords = 10)
            {
                return SeoHelper::generateKeywords($text, $maxKeywords);
            }
        }

        // Register Blade directives for SEO
        Blade::directive('seoMeta', function ($expression) {
            return "<?php echo app('App\\Services\\SeoService')->getMetaTags($expression); ?>";
        });

        Blade::directive('structuredData', function ($expression) {
            return "<?php echo app('App\\Services\\SeoService')->generateStructuredData($expression); ?>";
        });
    }
}
