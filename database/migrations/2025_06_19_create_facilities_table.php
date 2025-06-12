<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->foreignId('department_id')->nullable()->constrained('department_models')->onDelete('cascade');
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

    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
