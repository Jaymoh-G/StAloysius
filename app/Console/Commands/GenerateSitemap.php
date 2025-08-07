<?php

namespace App\Console\Commands;

use App\Services\SeoService;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate XML sitemap for the website';

    protected $seoService;

    public function __construct(SeoService $seoService)
    {
        parent::__construct();
        $this->seoService = $seoService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating sitemap...');

        try {
            $urls = $this->seoService->generateSitemap();

            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";

            foreach ($urls as $url) {
                $xml .= '    <url>' . "\n";
                $xml .= '        <loc>' . htmlspecialchars($url['url']) . '</loc>' . "\n";
                $xml .= '        <lastmod>' . $url['lastmod'] . '</lastmod>' . "\n";
                $xml .= '        <changefreq>' . $url['changefreq'] . '</changefreq>' . "\n";
                $xml .= '        <priority>' . $url['priority'] . '</priority>' . "\n";
                $xml .= '    </url>' . "\n";
            }

            $xml .= '</urlset>';

            // Save to public directory
            file_put_contents(public_path('sitemap.xml'), $xml);

            $this->info('Sitemap generated successfully!');
            $this->info('Total URLs: ' . count($urls));
            $this->info('Location: ' . public_path('sitemap.xml'));
        } catch (\Exception $e) {
            $this->error('Error generating sitemap: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
