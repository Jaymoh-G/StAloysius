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
        Schema::create('student_applications', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('kpsea_index_number');
            $table->string('current_residence');
            $table->string('guardian_name');
            $table->string('guardian_phone');
            $table->string('application_letter');
            $table->json('academic_certificates'); // Changed to JSON
            $table->json('death_certificate')->nullable(); // Changed to JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_applications');
    }
};
