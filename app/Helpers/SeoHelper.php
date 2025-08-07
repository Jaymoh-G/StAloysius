<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class SeoHelper
{
    /**
     * Generate a clean, SEO-friendly slug from a string
     */
    public static function generateSlug($string, $separator = '-')
    {
        return Str::slug($string, $separator);
    }

    /**
     * Truncate text to a specific length for meta descriptions
     */
    public static function truncateDescription($text, $length = 160)
    {
        $text = strip_tags($text);
        $text = preg_replace('/\s+/', ' ', $text);

        if (strlen($text) <= $length) {
            return $text;
        }

        return substr($text, 0, $length - 3) . '...';
    }

    /**
     * Generate meta title with proper length
     */
    public static function generateMetaTitle($title, $suffix = null, $maxLength = 60)
    {
        $suffix = $suffix ?: ' - St Aloysius Gonzaga Secondary School';
        $fullTitle = $title . $suffix;

        if (strlen($fullTitle) <= $maxLength) {
            return $fullTitle;
        }

        // Try without suffix
        if (strlen($title) <= $maxLength) {
            return $title;
        }

        // Truncate title
        return substr($title, 0, $maxLength - 3) . '...';
    }

    /**
     * Clean and format text for SEO
     */
    public static function cleanText($text)
    {
        // Remove HTML tags
        $text = strip_tags($text);

        // Remove extra whitespace
        $text = preg_replace('/\s+/', ' ', $text);

        // Remove special characters that might cause issues
        $text = preg_replace('/[^\p{L}\p{N}\s\-_.,!?]/u', '', $text);

        return trim($text);
    }

    /**
     * Generate keywords from text content
     */
    public static function generateKeywords($text, $maxKeywords = 10)
    {
        $text = strtolower($text);
        $text = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $text);

        // Remove common stop words
        $stopWords = ['the', 'a', 'an', 'and', 'or', 'but', 'in', 'on', 'at', 'to', 'for', 'of', 'with', 'by', 'is', 'are', 'was', 'were', 'be', 'been', 'being', 'have', 'has', 'had', 'do', 'does', 'did', 'will', 'would', 'could', 'should', 'may', 'might', 'must', 'can', 'this', 'that', 'these', 'those'];

        $words = explode(' ', $text);
        $words = array_filter($words, function ($word) use ($stopWords) {
            return strlen($word) > 2 && !in_array($word, $stopWords);
        });

        $wordCount = array_count_values($words);
        arsort($wordCount);

        return array_slice(array_keys($wordCount), 0, $maxKeywords);
    }

    /**
     * Format date for structured data
     */
    public static function formatDateForSchema($date)
    {
        if ($date instanceof \Carbon\Carbon) {
            return $date->toISOString();
        }

        if (is_string($date)) {
            return \Carbon\Carbon::parse($date)->toISOString();
        }

        return null;
    }

    /**
     * Generate breadcrumb data for structured data
     */
    public static function generateBreadcrumbs($items)
    {
        $breadcrumbs = [];
        $position = 1;

        foreach ($items as $item) {
            $breadcrumbs[] = [
                'name' => $item['name'],
                'url' => $item['url'],
                'position' => $position
            ];
            $position++;
        }

        return $breadcrumbs;
    }

    /**
     * Check if URL is canonical
     */
    public static function isCanonical($url)
    {
        $currentUrl = request()->url();
        return $currentUrl === $url;
    }

    /**
     * Generate Open Graph image URL
     */
    public static function generateOgImage($imagePath = null, $width = 1200, $height = 630)
    {
        if ($imagePath) {
            return asset('storage/' . $imagePath);
        }

        // Default OG image
        return asset('assets/img/og-default.jpg');
    }

    /**
     * Sanitize URL for SEO
     */
    public static function sanitizeUrl($url)
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    /**
     * Generate schema markup for FAQ
     */
    public static function generateFaqSchema($faqs)
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => []
        ];

        foreach ($faqs as $faq) {
            $schema['mainEntity'][] = [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer']
                ]
            ];
        }

        return $schema;
    }
}
