<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Semester;
use App\Models\ClassRoom;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\TeacherSubject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin User
        $admin = User::create([
            'name' => 'Admin SMA',
            'email' => 'admin@sma.edu',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Create Semesters
        $activeSemester = null;
        $academicYears = ['2023/2024', '2024/2025', '2025/2026'];
        foreach ($academicYears as $key => $year) {
            Semester::create([
                'name' => 'Ganjil', 'school_year' => $year,
                'start_date' => (2023 + $key).'-07-01', 'end_date' => (2023 + $key).'-12-31',
                'is_active' => false,
            ]);
            $semesterGenap = Semester::create([
                'name' => 'Genap', 'school_year' => $year,
                'start_date' => (2024 + $key).'-01-01', 'end_date' => (2024 + $key).'-06-30',
                'is_active' => $year === '2025/2026', // Set semester terakhir sebagai aktif
            ]);
            if($semesterGenap->is_active) {
                $activeSemester = $semesterGenap;
            }
        }

        // 3. Create Classes
        $classes = collect();
        foreach ([10, 11, 12] as $grade) {
            foreach (['A', 'B', 'C'] as $section) {
                $classes->push(ClassRoom::create([
                    'name' => $grade . $section,
                    'grade_level' => $grade,
                    'max_students' => 32,
                ]));
            }
        }

        // 4. Create Subjects
        $subjectsData = [
            ['name' => 'Matematika', 'code' => 'MTK'], ['name' => 'Fisika', 'code' => 'FIS'],
            ['name' => 'Kimia', 'code' => 'KIM'], ['name' => 'Biologi', 'code' => 'BIO'],
            ['name' => 'Bahasa Indonesia', 'code' => 'BID'], ['name' => 'Bahasa Inggris', 'code' => 'BIG'],
            ['name' => 'Sejarah', 'code' => 'SEJ'], ['name' => 'Geografi', 'code' => 'GEO'],
            ['name' => 'Ekonomi', 'code' => 'EKO'], ['name' => 'Sosiologi', 'code' => 'SOS'],
        ];
        $subjects = collect($subjectsData)->map(fn($s) => Subject::create($s));

        // 5. Create Teachers
        $teacherNames = [
            'Drs. Ahmad Wijaya', 'Sri Mulyani, S.Pd', 'Dr. Bambang Susilo', 'Siti Nurhaliza, M.Pd',
            'Prof. Joko Widodo', 'Ani Yudhoyono, S.Si', 'Budi Santoso, M.Pd', 'Ratna Sari, S.Pd',
            'Hendra Gunawan, M.Si', 'Maya Angelou, S.Pd'
        ];
        $teachers = collect();
        foreach ($teacherNames as $index => $name) {
            $user = User::create([
                'name' => $name, 'email' => 'teacher' . ($index + 1) . '@sma.edu',
                'password' => Hash::make('password'), 'role' => 'teacher',
            ]);
            $teachers->push(Teacher::create([
                'user_id' => $user->id, 'nip' => '198' . ($index + 1) . '0101200' . ($index + 1),
                'full_name' => $name, 'gender' => $index % 2 == 0 ? 'male' : 'female',
            ]));
        }

        // 6. Create Students (10 per kelas)
        $studentNames = [
            'Andi Pratama', 'Budi Setiawan', 'Citra Dewi', 'Dian Sari', 'Eka Putra',
            'Farid Ramadan', 'Gina Maharani', 'Hadi Kusuma', 'Indira Putri', 'Joko Santoso'
        ];
        $studentCounter = 1;
        foreach ($classes as $classRoom) {
            foreach ($studentNames as $index => $name) {
                $user = User::create([
                    'name' => $name,
                    'email' => strtolower(str_replace(' ', '.', $name)) . '.' . $classRoom->name . '@sma.edu',
                    'password' => Hash::make('password'),
                    'role' => 'student',
                ]);
                Student::create([
                    'user_id' => $user->id, 'class_room_id' => $classRoom->id,
                    'nisn' => '001012' . sprintf('%06d', $studentCounter++),
                    'nis' => '100' . $studentCounter, 'full_name' => $name,
                    'phone' => '08567890123' . $index,
                    'address' => 'Jl. Siswa No. ' . ($index + 1) . ', Kelas ' . $classRoom->name,
                    'birth_date' => (2007 - ($classRoom->grade_level - 10)) . '-' . sprintf('%02d', ($index % 12) + 1) . '-' . sprintf('%02d', ($index % 28) + 1),
                    'birth_place' => ['Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Makassar'][$index % 5],
                    'gender' => $index % 2 == 0 ? 'male' : 'female',
                    'parent_name' => 'Orang Tua ' . $name,
                    'parent_phone' => '08111222333' . $index,
                    'entry_year' => 2023 + ($classRoom->grade_level - 10),
                ]);
            }
        }

        // --- BAGIAN INI DIPERBAIKI ---
        // 7. Create Teacher Assignments with Realistic Logic
        $teacherSubjectMap = [
            'Drs. Ahmad Wijaya' => ['Matematika', 'Fisika'],
            'Sri Mulyani, S.Pd' => ['Bahasa Indonesia', 'Sejarah'],
            'Dr. Bambang Susilo' => ['Kimia', 'Biologi'],
            'Siti Nurhaliza, M.Pd' => ['Bahasa Inggris'],
            'Prof. Joko Widodo' => ['Geografi', 'Sosiologi'],
            'Ani Yudhoyono, S.Si' => ['Ekonomi'],
        ];

        $gradeLevelTeacher = [10, 11, 12, 10, 11, 12]; // Untuk memetakan guru ke tingkat kelas
        $i = 0;

        foreach ($teacherSubjectMap as $teacherName => $subjectNames) {
            $teacherModel = $teachers->firstWhere('full_name', $teacherName);
            $targetGrade = $gradeLevelTeacher[$i];
            
            foreach ($subjectNames as $subjectName) {
                $subjectModel = $subjects->firstWhere('name', $subjectName);
                
                // Ambil semua kelas di tingkat target
                $classesForGrade = $classes->where('grade_level', $targetGrade);

                // Tugaskan guru ini untuk mengajar mapel ini di semua kelas pada tingkat tersebut
                foreach ($classesForGrade as $classRoom) {
                    TeacherSubject::create([
                        'teacher_id' => $teacherModel->id,
                        'subject_id' => $subjectModel->id,
                        'class_room_id' => $classRoom->id,
                        'semester_id' => $activeSemester->id,
                    ]);
                }
            }
            $i++;
        }
        
        // Output Summary
        echo "✅ Database Seeding Complete!\n";
        echo "📊 Summary:\n";
        echo "- Users: " . User::count() . " (1 Admin, " . Teacher::count() . " Teachers, " . Student::count() . " Students)\n";
        echo "- Classes: " . ClassRoom::count() . "\n";
        echo "- Subjects: " . Subject::count() . "\n";
        echo "- Semesters: " . Semester::count() . "\n";
        echo "- Assignments: " . TeacherSubject::count() . "\n";
        echo "\n🔑 Login Credentials:\n";
        echo "Admin: admin@sma.edu / password\n";
        echo "Teacher: teacher1@sma.edu / password (Mengajar Matematika & Fisika di kelas 10)\n";
        echo "Student: andi.pratama.10a@sma.edu / password\n";
    }
}