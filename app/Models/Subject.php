<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'credit_hours',
        'grade_levels',
    ];

    protected $casts = [
        'grade_levels' => 'array',
    ];

    // Relationships
    public function teacherSubjects()
    {
        return $this->hasMany(TeacherSubject::class);
    }

    public function teachers()
    {
        return $this->hasManyThrough(Teacher::class, TeacherSubject::class);
    }

    // Helper methods
    public function isForGradeLevel($gradeLevel)
    {
        return in_array($gradeLevel, $this->grade_levels);
    }

    public function getGradeLevelsText()
    {
        return 'Kelas ' . implode(', ', $this->grade_levels);
    }
}