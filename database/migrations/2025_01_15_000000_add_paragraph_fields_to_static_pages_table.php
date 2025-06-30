<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('static_pages', function (Blueprint $table) {
            // Add paragraph fields
            for ($i = 1; $i <= 21; $i++) {
                $table->longText("paragraph{$i}")->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('static_pages', function (Blueprint $table) {
            // Remove paragraph fields
            for ($i = 1; $i <= 21; $i++) {
                $table->dropColumn("paragraph{$i}");
            }
        });
    }
};
