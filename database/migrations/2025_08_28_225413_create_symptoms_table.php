<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('symptoms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Örn: "Baş ağrısı", "Göğüs ağrısı"
            $table->string('category')->nullable(); // Kardiyoloji, Dahiliye vs.
            $table->timestamps();
        });

        // Pivot tablo: user_symptoms
        Schema::create('user_symptoms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('symptom_id')->constrained()->cascadeOnDelete();
            $table->text('notes')->nullable(); // Kullanıcının ek açıklaması
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_symptoms');
        Schema::dropIfExists('symptoms');
    }
};
