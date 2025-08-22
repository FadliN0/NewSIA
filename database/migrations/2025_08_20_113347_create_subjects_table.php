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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Matematika, Fisika, Kimia
            $table->string('code')->unique(); // MTK, FIS, KIM
            $table->text('description')->nullable();
            $table->integer('credit_hours')->default(2); // jam pelajaran per minggu
            $table->json('grade_levels'); // [10, 11, 12] untuk kelas mana saja
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};