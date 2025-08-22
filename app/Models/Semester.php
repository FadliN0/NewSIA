<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'grade_level',
        'academic_year',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function teacherSubjects()
    {
        return $this->hasMany(TeacherSubject::class);
    }

    // Helper methods
    public function isCurrentSemester()
    {
        $now = Carbon::now();
        return $now->between($this->start_date, $this->end_date);
    }

    public static function getActiveSemester()
    {
        return self::where('is_active', true)->first();
    }

    public static function getCurrentSemester()
    {
        $now = Carbon::now();
        return self::where('start_date', '<=', $now)
                  ->where('end_date', '>=', $now)
                  ->first();
    }
}