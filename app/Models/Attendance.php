<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'semester_id',
        'attendance_date',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'attendance_date' => 'date',
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // public function teacherSubject()
    // {
    //     return $this->belongsTo(TeacherSubject::class);
    // }
    
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    // Helper methods
    public function getStatusText()
    {
        return match($this->status) {
            'present' => 'Hadir',
            'absent' => 'Tidak Hadir',
            'late' => 'Terlambat',
            'sick' => 'Sakit',
            'permission' => 'Izin',
            default => 'Unknown'
        };
    }

    public function getStatusColor()
    {
        return match($this->status) {
            'present' => 'text-green-600 bg-green-100',
            'absent' => 'text-red-600 bg-red-100',
            'late' => 'text-yellow-600 bg-yellow-100',
            'sick' => 'text-blue-600 bg-blue-100',
            'permission' => 'text-purple-600 bg-purple-100',
            default => 'text-gray-600 bg-gray-100'
        };
    }

    // public function isPresent()
    // {
    //     return in_array($this->status, ['present', 'late']);
    // }

    // public function isAbsent()
    // {
    //     return in_array($this->status, ['absent', 'sick', 'permission']);
    // }
}