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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete(); // WAJIB: Absen untuk mapel apa
            $table->foreignId('semester_id')->constrained()->cascadeOnDelete(); // WAJIB: Absen di semester mana
            $table->date('attendance_date'); // Tanggal absensi
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alfa']); // Status kehadiran
            $table->text('notes')->nullable(); // Catatan dari guru
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};