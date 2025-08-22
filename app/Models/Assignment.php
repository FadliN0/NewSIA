<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_subject_id',
        'title',
        'description',
        'type',
        'due_date',
        'file_path',
        'max_score',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    // Relationships
    public function teacherSubject()
    {
        return $this->belongsTo(TeacherSubject::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    // Helper methods
    public function getTypeText()
    {
        return match($this->type) {
            'daily' => 'Tugas Harian',
            'uts' => 'UTS',
            'uas' => 'UAS',
            default => 'Unknown'
        };
    }

    public function isOverdue()
    {
        return $this->due_date && $this->due_date->isPast();
    }

    public function getSubmittedCount()
    {
        return $this->grades()->count();
    }

    public function getTotalStudents()
    {
        return $this->teacherSubject->classRoom->students()->count();
    }

    public function getSubmissionPercentage()
    {
        $total = $this->getTotalStudents();
        if ($total === 0) return 0;
        
        return ($this->getSubmittedCount() / $total) * 100;
    }

    public function getAverageScore()
    {
        return $this->grades()->avg('score');
    }
}