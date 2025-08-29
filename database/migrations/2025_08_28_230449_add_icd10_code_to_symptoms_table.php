<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('symptoms', function (Blueprint $table) {
            $table->string('icd10_code')->nullable()->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('symptoms', function (Blueprint $table) {
            $table->dropColumn('icd10_code');
        });
    }
};
