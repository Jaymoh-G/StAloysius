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
            if (!Schema::hasColumn('blog_images', 'facility_model_id')) {
                $table->foreignId('facility_model_id')->nullable()->after('event_model_id')->constrained('facility_models')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_images', function (Blueprint $table) {
            if (Schema::hasColumn('blog_images', 'facility_model_id')) {
                $table->dropForeign(['facility_model_id']);
                $table->dropColumn('facility_model_id');
            }
        });
    }
};
