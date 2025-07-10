<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;
use App\Models\BlogImage;

class FixProjectImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-project-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix project images by setting correct category and featured status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fixing project images...');

        // Get all projects
        $projects = Project::all();

        foreach ($projects as $project) {
            $this->info("Processing project: {$project->title}");

            // Get all images for this project
            $images = BlogImage::where('project_id', $project->id)->get();

            if ($images->count() > 0) {
                // Set category to 'project' for all images
                $images->each(function ($image) {
                    $image->update(['category' => 'project']);
                });

                // Check if there's a featured image
                $featuredImage = $images->where('is_featured', true)->first();

                if (!$featuredImage) {
                    // Set the first image as featured
                    $firstImage = $images->first();
                    $firstImage->update(['is_featured' => true]);
                    $this->info("  - Set first image as featured");
                } else {
                    $this->info("  - Featured image already exists");
                }

                $this->info("  - Updated {$images->count()} images");
            } else {
                $this->info("  - No images found");
            }
        }

        $this->info('Project images fixed successfully!');
    }
}
