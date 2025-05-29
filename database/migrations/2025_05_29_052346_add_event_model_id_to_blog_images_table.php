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
            $table->unsignedBigInteger('event_model_id')->nullable()->after('blog_post_id');
        $table->foreign('event_model_id')->references('id')->on('event_models')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_images', function (Blueprint $table) {
           $table->dropForeign(['event_model_id']);
        $table->dropColumn('event_model_id');
        });
    }
};
