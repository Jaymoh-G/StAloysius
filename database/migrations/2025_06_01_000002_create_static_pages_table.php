<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('static_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('page_name');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('banner_image')->nullable();

            // Section content
            $table->string('section_1_title')->nullable();
            $table->longText('section_1_content')->nullable();
            $table->string('section_2_title')->nullable();
            $table->longText('section_2_content')->nullable();
            $table->string('section_3_title')->nullable();
            $table->longText('section_3_content')->nullable();
            $table->string('section_4_title')->nullable();
            $table->longText('section_4_content')->nullable();
            $table->string('section_5_title')->nullable();
            $table->longText('section_5_content')->nullable();
            $table->string('section_6_title')->nullable();
            $table->longText('section_6_content')->nullable();
            $table->string('section_7_title')->nullable();
            $table->longText('section_7_content')->nullable();
            $table->string('section_8_title')->nullable();
            $table->longText('section_8_content')->nullable();
            $table->string('section_9_title')->nullable();
            $table->longText('section_9_content')->nullable();
            $table->string('section_10_title')->nullable();
            $table->longText('section_10_content')->nullable();

            $table->unsignedBigInteger('last_updated_by')->nullable();
            $table->timestamps();

            $table->foreign('last_updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('static_pages');
    }
};
