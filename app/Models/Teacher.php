<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nip',
        'full_name',
        'phone',
        'address',
        'birth_date',
        'gender',
        'education_level',
        'avatar',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teacherSubjects()
    {
        return $this->hasMany(TeacherSubject::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subjects', 'teacher_id', 'subject_id');
    }

    public function attendances()
    {
        return $this->hasManyThrough(Attendance::class, TeacherSubject::class);
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

    public function getSubjectsCount()
    {
        return $this->teacherSubjects()->count();
    }

    public function getClassesCount()
    {
        return $this->teacherSubjects()->distinct('class_room_id')->count();
    }
}