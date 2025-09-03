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
        // 1. Fix attendances table
        Schema::table('attendances', function (Blueprint $table) {
            // Cek apakah kolom 'date' ada, jika ya rename ke 'attendance_date'
            if (Schema::hasColumn('attendances', 'date') && !Schema::hasColumn('attendances', 'attendance_date')) {
                $table->renameColumn('date', 'attendance_date');
            }
            
            // Jika belum ada kolom attendance_date, buat baru
            if (!Schema::hasColumn('attendances', 'attendance_date')) {
                $table->date('attendance_date')->after('semester_id');
            }
            
            // Pastikan status menggunakan enum yang benar
            if (Schema::hasColumn('attendances', 'status')) {
                // Drop kolom status lama dan buat baru dengan enum yang benar
                $table->dropColumn('status');
            }
        });
        
        // Tambah kolom status dengan enum yang benar
        Schema::table('attendances', function (Blueprint $table) {
            $table->enum('status', ['Hadir', 'Sakit', 'Izin', 'Alpha'])->after('attendance_date');
        });

        // 2. Fix assignments table
        Schema::table('assignments', function (Blueprint $table) {
            // Pastikan due_date adalah datetime
            if (Schema::hasColumn('assignments', 'due_date')) {
                $table->datetime('due_date')->change();
            }
        });

        // 3. Create submissions table jika belum ada
        if (!Schema::hasTable('submissions')) {
            Schema::create('submissions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('assignment_id')->constrained()->onDelete('cascade');
                $table->foreignId('student_id')->constrained()->onDelete('cascade');
                $table->string('file_path');
                $table->string('file_name');
                $table->timestamps();
                
                // Index untuk performance
                $table->index(['assignment_id', 'student_id']);
            });
        }

        // 4. Tambah kolom yang mungkin kurang
        Schema::table('grades', function (Blueprint $table) {
            // Pastikan ada foreign key ke subject_id
            if (!Schema::hasColumn('grades', 'subject_id')) {
                $table->foreignId('subject_id')->nullable()->after('student_id')->constrained()->onDelete('cascade');
            }
        });

        // 5. Tambah index untuk performance
        if (!Schema::hasTable('teacher_subjects')) {
            // Jika tabel teacher_subjects belum ada, buat
            Schema::create('teacher_subjects', function (Blueprint $table) {
                $table->id();
                $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
                $table->foreignId('subject_id')->constrained()->onDelete('cascade');
                $table->foreignId('class_room_id')->constrained()->onDelete('cascade');
                $table->foreignId('semester_id')->constrained()->onDelete('cascade');
                $table->timestamps();
                
                // Index untuk performance
                $table->index(['class_room_id', 'semester_id']);
                $table->unique(['teacher_id', 'subject_id', 'class_room_id', 'semester_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse operations
        Schema::table('attendances', function (Blueprint $table) {
            if (Schema::hasColumn('attendances', 'attendance_date')) {
                $table->renameColumn('attendance_date', 'date');
            }
        });
        
        Schema::dropIfExists('submissions');
        
        Schema::table('grades', function (Blueprint $table) {
            if (Schema::hasColumn('grades', 'subject_id')) {
                $table->dropForeign(['subject_id']);
                $table->dropColumn('subject_id');
            }
        });
    }
};
