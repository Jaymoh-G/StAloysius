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
        Schema::table('blog_posts', function (Blueprint $table) {
        $table->text('paragraph8')->nullable();
        $table->text('paragraph9')->nullable();
        $table->text('paragraph10')->nullable();
        $table->text('paragraph11')->nullable();
        $table->text('paragraph12')->nullable();
        $table->text('paragraph13')->nullable();
        $table->text('paragraph14')->nullable();
        $table->text('paragraph15')->nullable();
        $table->text('paragraph16')->nullable();
        $table->text('paragraph17')->nullable();
        $table->text('paragraph18')->nullable();
        $table->text('paragraph19')->nullable();
        $table->text('paragraph20')->nullable();
        $table->text('paragraph21')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn([
                'paragraph8', 'paragraph9', 'paragraph10', 'paragraph11', 'paragraph12',
                'paragraph13', 'paragraph14', 'paragraph15', 'paragraph16', 'paragraph17',
                'paragraph18', 'paragraph19', 'paragraph20', 'paragraph21'
            ]);
        });
    }
};
