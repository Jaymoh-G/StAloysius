<?php

use Carbon\Carbon;
use App\Helpers\SeoHelper;

function formattedDate($date) {
    $carbonDate = Carbon::parse($date);
    $day = (int) $carbonDate->format('j');
    $suffix = match (true) {
        $day >= 11 && $day <= 13 => 'th',
        $day % 10 === 1 => 'st',
        $day % 10 === 2 => 'nd',
        $day % 10 === 3 => 'rd',
        default => 'th',
    };
    return $day . $suffix . ' ' . $carbonDate->format('M, Y');
}

function formattedTime($datetime) {
    return \Carbon\Carbon::parse($datetime)->format('g:i A');
}

function setting($key, $default = null) {
    return \App\Models\Setting::get($key, $default);
}

function setting_group($group) {
    return \App\Models\Setting::getGroup($group);
}

// SEO Helper Functions
function seo_slug($string, $separator = '-') {
    return SeoHelper::generateSlug($string, $separator);
}

function seo_description($text, $length = 160) {
    return SeoHelper::truncateDescription($text, $length);
}

function seo_title($title, $suffix = null, $maxLength = 60) {
    return SeoHelper::generateMetaTitle($title, $suffix, $maxLength);
}

function seo_clean_text($text) {
    return SeoHelper::cleanText($text);
}

function seo_keywords($text, $maxKeywords = 10) {
    return SeoHelper::generateKeywords($text, $maxKeywords);
}
