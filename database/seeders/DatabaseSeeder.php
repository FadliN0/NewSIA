<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Semester;
use App\Models\ClassRoom;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\TeacherSubject;
use App\Models\Assignment;
use App\Models\Grade;
use App\Models\Attendance;
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

        // 2. Create Semesters (6 semester untuk 3 tahun)
        $semesters = [];
        $academicYears = ['2022/2023', '2023/2024', '2024/2025'];
        
        foreach ($academicYears as $year) {
            foreach ([1, 2] as $semNum) {
                $gradeLevel = array_search($year, $academicYears) + 10;
                $semesters[] = Semester::create([
                    'name' => "Semester $semNum",
                    'grade_level' => $gradeLevel,
                    'school_year' => $year,
                    'start_date' => $semNum == 1 ? "$gradeLevel-07-01" : "$gradeLevel-01-01",
                    'end_date' => $semNum == 1 ? "$gradeLevel-12-31" : ($gradeLevel + 1) . "-06-30",
                    'is_active' => $year === '2024/2025' && $semNum === 2,
                ]);
            }
        }

        // 3. Create Classes
        $classes = [];
        foreach ([10, 11, 12] as $grade) {
            foreach (['A', 'B', 'C'] as $section) {
                $classes[] = ClassRoom::create([
                    'name' => $grade . $section,
                    'grade_level' => $grade,
                    'max_students' => 32,
                ]);
            }
        }

        // 4. Create Subjects
        $subjects = [
            ['name' => 'Matematika', 'code' => 'MTK', 'grade_levels' => [10, 11, 12]],
            ['name' => 'Fisika', 'code' => 'FIS', 'grade_levels' => [10, 11, 12]],
            ['name' => 'Kimia', 'code' => 'KIM', 'grade_levels' => [10, 11, 12]],
            ['name' => 'Biologi', 'code' => 'BIO', 'grade_levels' => [10, 11, 12]],
            ['name' => 'Bahasa Indonesia', 'code' => 'BID', 'grade_levels' => [10, 11, 12]],
            ['name' => 'Bahasa Inggris', 'code' => 'BIG', 'grade_levels' => [10, 11, 12]],
            ['name' => 'Sejarah', 'code' => 'SEJ', 'grade_levels' => [10, 11, 12]],
            ['name' => 'Geografi', 'code' => 'GEO', 'grade_levels' => [10, 11, 12]],
            ['name' => 'Ekonomi', 'code' => 'EKO', 'grade_levels' => [11, 12]],
            ['name' => 'Sosiologi', 'code' => 'SOS', 'grade_levels' => [11, 12]],
        ];

        foreach ($subjects as $subjectData) {
            Subject::create([
                'name' => $subjectData['name'],
                'code' => $subjectData['code'],
                'description' => 'Mata pelajaran ' . $subjectData['name'],
                'credit_hours' => 4,
                'grade_levels' => $subjectData['grade_levels'],
            ]);
        }

        // 5. Create Teachers
        $teacherNames = [
            'Drs. Ahmad Wijaya', 'Sri Mulyani, S.Pd', 'Dr. Bambang Susilo', 
            'Siti Nurhaliza, M.Pd', 'Prof. Joko Widodo', 'Ani Yudhoyono, S.Si',
            'Budi Santoso, M.Pd', 'Ratna Sari, S.Pd', 'Hendra Gunawan, M.Si',
            'Maya Angelou, S.Pd'
        ];

        $teachers = [];
        foreach ($teacherNames as $index => $name) {
            $user = User::create([
                'name' => $name,
                'email' => 'teacher' . ($index + 1) . '@sma.edu',
                'password' => Hash::make('password'),
                'role' => 'teacher',
            ]);

            $teachers[] = Teacher::create([
                'user_id' => $user->id,
                'nip' => '198' . ($index + 1) . '0101200' . ($index + 1) . '01001',
                'full_name' => $name,
                'phone' => '08123456789' . $index,
                'address' => 'Jl. Pendidikan No. ' . ($index + 1),
                'birth_date' => '1980-01-' . sprintf('%02d', $index + 1),
                'gender' => $index % 2 == 0 ? 'male' : 'female',
                'education_level' => $index < 3 ? 'S3' : ($index < 6 ? 'S2' : 'S1'),
            ]);
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
                    'email' => strtolower(str_replace(' ', '.', $name)) . '.' . $classRoom->name . '@student.sma.edu',
                    'password' => Hash::make('password'),
                    'role' => 'student',
                ]);

                Student::create([
                    'user_id' => $user->id,
                    'class_room_id' => $classRoom->id,
                    'nisn' => '001012' . sprintf('%06d', $studentCounter++),
                    'nis' => $classRoom->grade_level . $classRoom->name . sprintf('%03d', $index + 1),
                    'full_name' => $name,
                    'phone' => '08567890123' . $index,
                    'address' => 'Jl. Siswa No. ' . ($index + 1) . ', Kelas ' . $classRoom->name,
                    'birth_date' => (2007 - ($classRoom->grade_level - 10)) . '-' . sprintf('%02d', ($index % 12) + 1) . '-' . sprintf('%02d', ($index % 28) + 1),
                    'birth_place' => ['Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Makassar'][$index % 5],
                    'gender' => $index % 2 == 0 ? 'male' : 'female',
                    'parent_name' => 'Orang Tua ' . $name,
                    'parent_phone' => '08111222333' . $index,
                    'entry_year' => 2022 + ($classRoom->grade_level - 10),
                ]);
            }
        }

        echo "✅ Phase 2 Database Setup Complete!\n";
        echo "📊 Summary:\n";
        echo "- Users: " . User::count() . " (1 Admin, " . Teacher::count() . " Teachers, " . Student::count() . " Students)\n";
        echo "- Classes: " . ClassRoom::count() . "\n";
        echo "- Subjects: " . Subject::count() . "\n";
        echo "- Semesters: " . Semester::count() . "\n";
        echo "\n🔑 Login Credentials:\n";
        echo "Admin: admin@sma.edu / password\n";
        echo "Teacher: teacher1@sma.edu / password\n";
        echo "Student: andi.pratama.10A@student.sma.edu / password\n";
    }
}