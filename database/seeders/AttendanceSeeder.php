<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
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
            $this->command->info('Tidak ada semester aktif, siswa, atau mata pelajaran. Melewatkan AttendanceSeeder.');
            return;
        }

        // Simulasikan absensi selama 30 hari dari tanggal mulai semester
        $startDate = Carbon::parse($activeSemester->start_date);
        
        for ($i = 0; $i < 30; $i++) {
            $currentDate = $startDate->copy()->addDays($i);

            // Lewati hari Minggu
            if ($currentDate->isSunday()) {
                continue;
            }

            foreach ($students as $student) {
                foreach ($subjects as $subject) {
                    $statuses = ['Hadir', 'Izin', 'Sakit', 'Alfa'];
                    // Peluang 90% hadir, 10% sisanya
                    $status = (rand(1, 100) <= 90) ? 'Hadir' : $statuses[rand(1, 3)];

                    Attendance::create([
                        'student_id' => $student->id,
                        'subject_id' => $subject->id,
                        'semester_id' => $activeSemester->id,
                        'attendance_date' => $currentDate,
                        'status' => $status,
                    ]);
                }
            }
        }
    }
}