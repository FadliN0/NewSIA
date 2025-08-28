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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete(); // WAJIB: Untuk tahu ini nilai mapel apa
            $table->foreignId('semester_id')->constrained()->cascadeOnDelete(); // WAJIB: Untuk tahu ini nilai semester mana
            $table->foreignId('assignment_id')->nullable()->constrained()->cascadeOnDelete(); // OPSIONAL: Jika nilai ini berasal dari tugas tertentu

            $table->string('grade_type'); // Contoh: 'Tugas', 'UTS', 'UAS'
            $table->decimal('score', 5, 2); // nilai dengan 2 desimal
            $table->text('notes')->nullable(); // catatan guru
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};