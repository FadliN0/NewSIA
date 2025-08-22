<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'grade_level',
        'max_students',
    ];

    // Relationships
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function teacherSubjects()
    {
        return $this->hasMany(TeacherSubject::class);
    }

    // Helper methods
    public function getCurrentStudentsCount()
    {
        return $this->students()->count();
    }

    public function hasAvailableSlots()
    {
        return $this->getCurrentStudentsCount() < $this->max_students;
    }

    public function getAvailableSlots()
    {
        return $this->max_students - $this->getCurrentStudentsCount();
    }
}