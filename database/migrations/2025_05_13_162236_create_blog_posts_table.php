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
        Schema::create('blog_posts', function (Blueprint $table) {
         $table->id();
        $table->string('title');
         $table->string('slug')->unique();
         $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
        $table->text('content'); // for CKEditor
     $table->text('paragraph1')->nullable();
        $table->text('paragraph2')->nullable();
        $table->text('paragraph3')->nullable();
        $table->text('paragraph4')->nullable();
        $table->text('paragraph5')->nullable();
        $table->text('paragraph6')->nullable();
        $table->text('paragraph7')->nullable();
         $table->string('banner')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
