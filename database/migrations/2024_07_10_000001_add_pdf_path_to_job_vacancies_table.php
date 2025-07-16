<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('job_vacancies', function (Blueprint $table) {
            $table->string('pdf_path')->nullable()->after('description');
        });
    }

    public function down()
    {
        Schema::table('job_vacancies', function (Blueprint $table) {
            $table->dropColumn('pdf_path');
        });
    }
};
