<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        $subjects = Subject::all();
        $activeSemester = Semester::where('is_active', true)->first();

        if (!$activeSemester || $students->isEmpty() || $subjects->isEmpty()) {
            $this->command->info('Tidak ada semester aktif, siswa, atau mata pelajaran. Melewatkan GradeSeeder.');
            return;
        }

        foreach ($students as $student) {
            foreach ($subjects as $subject) {
                // Buat 3 jenis nilai untuk setiap siswa & mapel di semester aktif
                Grade::create([
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                    'semester_id' => $activeSemester->id,
                    'grade_type' => 'Tugas',
                    'score' => rand(70, 95), // Nilai tugas acak antara 70-95
                ]);
                Grade::create([
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                    'semester_id' => $activeSemester->id,
                    'grade_type' => 'UTS',
                    'score' => rand(65, 90), // Nilai UTS acak antara 65-90
                ]);
                Grade::create([
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                    'semester_id' => $activeSemester->id,
                    'grade_type' => 'UAS',
                    'score' => rand(60, 100), // Nilai UAS acak antara 60-100
                ]);
            }
        }
    }
}