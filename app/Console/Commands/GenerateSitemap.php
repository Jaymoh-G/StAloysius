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

            $content = view('sitemap.index', compact('urls'))->render();

            // Save to public directory
            file_put_contents(public_path('sitemap.xml'), $content);

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
