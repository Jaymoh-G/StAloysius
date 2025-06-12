<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_images', function (Blueprint $table) {
            $table->foreignId('facility_id')->nullable()->after('id')->constrained('facilities')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('blog_images', function (Blueprint $table) {
            $table->dropForeign(['facility_id']);
            $table->dropColumn('facility_id');
        });
    }
};
