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
         Schema::create('department_models', function (Blueprint $table) {
        $table->id();
       $table->string('name')->unique();
        $table->string('slug')->unique();
     $table->foreignId('dep_category_id')->nullable()->constrained()->onDelete('cascade');
        $table->longText('content')->nullable();
    $table->longText('paragraph1')->nullable();
    $table->longText('paragraph2')->nullable();
    $table->longText('paragraph3')->nullable();
    $table->longText('paragraph4')->nullable();
    $table->longText('paragraph5')->nullable();
    $table->longText('paragraph6')->nullable();
    $table->longText('paragraph7')->nullable();
     $table->string('banner')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
