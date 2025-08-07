<?php

namespace App\Http\Controllers;

use App\Services\SeoService;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    protected $seoService;

    public function __construct(SeoService $seoService)
    {
        $this->seoService = $seoService;
    }

    public function index()
    {
        $urls = $this->seoService->generateSitemap();

        $content = view('sitemap.index', compact('urls'))->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml')
            ->header('Cache-Control', 'public, max-age=3600'); // Cache for 1 hour
    }

    public function generate()
    {
        // This method can be called via command line or cron job
        // to regenerate the sitemap periodically
        $urls = $this->seoService->generateSitemap();

        $content = view('sitemap.index', compact('urls'))->render();

        // Save to public directory
        file_put_contents(public_path('sitemap.xml'), $content);

        return response()->json(['message' => 'Sitemap generated successfully']);
    }
}
