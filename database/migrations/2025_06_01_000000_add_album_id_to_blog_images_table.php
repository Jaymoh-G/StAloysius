<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blog_images', function (Blueprint $table) {
            // Add album_id column if it doesn't exist
            if (!Schema::hasColumn('blog_images', 'album_id')) {
                $table->foreignId('album_id')->nullable()->after('blog_post_id')->constrained()->onDelete('set null');
            }
            
            // Add caption column if it doesn't exist
            if (!Schema::hasColumn('blog_images', 'caption')) {
                $table->string('caption')->nullable()->after('path');
            }
            
            // Add sort_order column if it doesn't exist
            if (!Schema::hasColumn('blog_images', 'sort_order')) {
                $table->integer('sort_order')->nullable()->after('is_featured');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_images', function (Blueprint $table) {
            // Only drop these if they exist
            if (Schema::hasColumn('blog_images', 'album_id')) {
                $table->dropForeign(['album_id']);
                $table->dropColumn('album_id');
            }
            
            if (Schema::hasColumn('blog_images', 'caption')) {
                $table->dropColumn('caption');
            }
            
            if (Schema::hasColumn('blog_images', 'sort_order')) {
                $table->dropColumn('sort_order');
            }
        });
    }
};