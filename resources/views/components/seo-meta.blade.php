@php
$page = $page ?? null;
$model = $model ?? null;

// Default meta tags
$meta = [
    'title' => 'St Aloysius Gonzaga Secondary School - Excellence in Education',
    'description' => 'St Aloysius Gonzaga Secondary School provides quality education with a focus on academic excellence, character formation, and holistic development. Join our community of learners.',
    'keywords' => 'St Aloysius, secondary school, education, Kenya, academic excellence, character formation',
    'author' => 'St Aloysius Gonzaga Secondary School',
    'robots' => 'index, follow',
    'og_type' => 'website',
    'twitter_card' => 'summary_large_image',
];

// If page is provided, get specific meta tags
if ($page) {
    $seoService = app(\App\Services\SeoService::class);
    $meta = $seoService->getMetaTags($page, $model);
}
@endphp

{{-- Basic Meta Tags --}}
<title>{{ $meta['title'] }}</title>
<meta name="description" content="{{ $meta['description'] }}" />
<meta name="keywords" content="{{ $meta['keywords'] }}" />
<meta name="author" content="{{ $meta['author'] }}" />
<meta name="robots" content="{{ $meta['robots'] }}" />

{{-- Canonical URL --}}
<link rel="canonical" href="{{ request()->url() }}" />

{{-- Open Graph Meta Tags --}}
<meta property="og:title" content="{{ $meta['title'] }}" />
<meta property="og:description" content="{{ $meta['description'] }}" />
<meta property="og:type" content="{{ $meta['og_type'] }}" />
<meta property="og:url" content="{{ request()->url() }}" />
<meta property="og:site_name" content="St Aloysius Gonzaga Secondary School" />
@if(isset($meta['og_image']))
<meta property="og:image" content="{{ $meta['og_image'] }}" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
@endif
<meta property="og:locale" content="en_US" />

{{-- Twitter Card Meta Tags --}}
<meta name="twitter:card" content="{{ $meta['twitter_card'] }}" />
<meta name="twitter:title" content="{{ $meta['title'] }}" />
<meta name="twitter:description" content="{{ $meta['description'] }}" />
@if(isset($meta['og_image']))
<meta name="twitter:image" content="{{ $meta['og_image'] }}" />
@endif
<meta name="twitter:site" content="@staloysius" />

{{-- Additional Meta Tags for Articles --}}
@if(isset($meta['article_published_time']))
<meta property="article:published_time" content="{{ $meta['article_published_time'] }}" />
@endif
@if(isset($meta['article_modified_time']))
<meta property="article:modified_time" content="{{ $meta['article_modified_time'] }}" />
@endif

{{-- Mobile Meta Tags --}}
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="format-detection" content="telephone=no" />

{{-- Favicon and App Icons --}}
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/logo/favicon-32x32.png') }}" />
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/logo/favicon-16x16.png') }}" />
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/logo/apple-touch-icon.png') }}" />
<link rel="manifest" href="{{ asset('site.webmanifest') }}" />

{{-- Preconnect for Performance --}}
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link rel="preconnect" href="https://www.google-analytics.com" />
