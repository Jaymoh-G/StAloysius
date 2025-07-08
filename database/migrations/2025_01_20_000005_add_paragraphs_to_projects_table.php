<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            for ($i = 1; $i <= 21; $i++) {
                $col = 'paragraph' . $i;
                if (!Schema::hasColumn('projects', $col)) {
                    $table->text($col)->nullable();
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            for ($i = 1; $i <= 21; $i++) {
                $col = 'paragraph' . $i;
                if (Schema::hasColumn('projects', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
