<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'class_room_id',
        'semester_id',
    ];

    // Relationships
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Helper methods
    public function getStudents()
    {
        return $this->classRoom->students();
    }

    public function getStudentsWithGrades()
    {
        return $this->classRoom->students()
                   ->with(['grades' => function($query) {
                       $query->whereHas('assignment', function($q) {
                           $q->where('teacher_subject_id', $this->id);
                       });
                   }]);
    }

    public function getDailyAssignments()
    {
        return $this->assignments()->where('type', 'daily');
    }

    public function getUTSAssignments()
    {
        return $this->assignments()->where('type', 'uts');
    }

    public function getUASAssignments()
    {
        return $this->assignments()->where('type', 'uas');
    }
}