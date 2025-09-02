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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            // Tambahkan foreign key untuk tugas
            $table->foreignId('assignment_id')->constrained()->cascadeOnDelete();
            // Tambahkan foreign key untuk siswa
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            
            $table->string('file_path');
            $table->string('file_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};