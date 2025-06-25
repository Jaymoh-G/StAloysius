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
         Schema::create('testimonials', function (Blueprint $table) {
        $table->id();
        $table->string('slug')->unique();
        $table->string('name')->unique();
        $table->string('type'); // could be "Student", "Parent", etc.
        $table->text('testimony');
        $table->string('image')->nullable();
        $table->unsignedTinyInteger('rating')->default(5); // 1 to 5
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
