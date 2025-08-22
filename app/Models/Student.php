<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'class_room_id',
        'nisn',
        'nis',
        'full_name',
        'phone',
        'address',
        'birth_date',
        'birth_place',
        'gender',
        'parent_name',
        'parent_phone',
        'entry_year',
        'avatar',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'entry_year' => 'integer',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Helper methods
    public function getAge()
    {
        return $this->birth_date ? $this->birth_date->age : null;
    }

    public function getGenderText()
    {
        return $this->gender === 'male' ? 'Laki-laki' : 'Perempuan';
    }

    public function getCurrentSemester()
    {
        $currentYear = now()->year;
        $yearsInSchool = $currentYear - $this->entry_year;
        
        // Asumsi: semester ganjil dimulai Juli, genap dimulai Januari
        $currentMonth = now()->month;
        $semesterInYear = $currentMonth >= 7 ? 1 : 2;
        
        return ($yearsInSchool * 2) + $semesterInYear;
    }

    public function getAverageGrade()
    {
        return $this->grades()->avg('score');
    }

    public function getGradesBySubject($subjectId)
    {
        return $this->grades()
                   ->whereHas('assignment.teacherSubject', function($query) use ($subjectId) {
                       $query->where('subject_id', $subjectId);
                   })
                   ->get();
    }

    public function getAttendancePercentage()
    {
        $totalAttendances = $this->attendances()->count();
        if ($totalAttendances === 0) return 0;
        
        $presentAttendances = $this->attendances()
                                  ->where('status', 'present')
                                  ->count();
        
        return ($presentAttendances / $totalAttendances) * 100;
    }
}