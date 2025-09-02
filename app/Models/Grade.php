<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'semester_id',
        'assignment_id',
        'grade_type',
        'score',
        'notes',
    ];

    protected $casts = [
        'score' => 'decimal:2',
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Helper methods
    public function getLetterGrade()
    {
        return match(true) {
            $this->score >= 90 => 'A',
            $this->score >= 80 => 'B',
            $this->score >= 70 => 'C',
            $this->score >= 60 => 'D',
            default => 'E'
        };
    }

    public function getGradeColor()
    {
        return match($this->getLetterGrade()) {
            'A' => 'text-green-600',
            'B' => 'text-blue-600',
            'C' => 'text-yellow-600',
            'D' => 'text-orange-600',
            'E' => 'text-red-600',
        };
    }

    public function isPassing()
    {
        return $this->score >= 60; // KKM minimal 60
    }
}