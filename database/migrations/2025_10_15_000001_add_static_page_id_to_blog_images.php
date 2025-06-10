<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_images', function (Blueprint $table) {
            if (!Schema::hasColumn('blog_images', 'static_page_id')) {
                $table->foreignId('static_page_id')->nullable()->after('event_model_id')->constrained()->onDelete('cascade');
            }
            
            if (!Schema::hasColumn('blog_images', 'sort_order')) {
                $table->integer('sort_order')->nullable()->after('is_featured');
            }
        });
    }

    public function down(): void
    {
        Schema::table('blog_images', function (Blueprint $table) {
            if (Schema::hasColumn('blog_images', 'static_page_id')) {
                $table->dropForeign(['static_page_id']);
                $table->dropColumn('static_page_id');
            }
            
            if (Schema::hasColumn('blog_images', 'sort_order')) {
                $table->dropColumn('sort_order');
            }
        });
    }
};