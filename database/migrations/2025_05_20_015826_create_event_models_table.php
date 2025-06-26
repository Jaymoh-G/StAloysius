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
       Schema::create('event_models', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->text('content');

    // Event-specific fields
    $table->date('start_date');
    $table->date('end_date');
    $table->string('start_time'); // use string if time is not stored in a strict format
    $table->string('end_time'); // use string if time is not stored in a strict format
    $table->string('location');

    // Organizer
    $table->string('organizer_name');
    $table->string('organizer_photo')->nullable();
    $table->text('organizer_description')->nullable();

    // Relationships
    $table->unsignedBigInteger('event_category_id')->nullable(); // optional category
    $table->boolean('featured')->default(false);
    $table->string('banner')->nullable();

    // Optional: 21 HTML paragraphs like in the department model
    for ($i = 1; $i <= 21; $i++) {
        $table->text("paragraph{$i}")->nullable();
    }

    $table->timestamps();

    // Foreign key (if category table exists)
    $table->foreign('event_category_id')->references('id')->on('event_categories')->onDelete('set null');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_models');
    }
};
