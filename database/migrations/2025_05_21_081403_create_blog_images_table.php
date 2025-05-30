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
        Schema::create('blog_images', function (Blueprint $table) {
            $table->id();
                $table->foreignId('blog_post_id')->nullable()->constrained()->onDelete('set null');
                $table->foreignId('department_model_id')->nullable()->constrained()->onDelete('set null');
                $table->foreignId('event_model_id')->nullable()->constrained()->onDelete('set null');

                 $table->string('path');
                 $table->string('category')->nullable();
                 $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_images');
    }
};
