<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id', 
        'class_room_id',
        'subject_id',
        'title',
        'description',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    /**
     * Get the teacher that owns the assignment.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the class room for the assignment.
     */
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    /**
     * Get the subject for the assignment.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get all submissions for this assignment.
     */
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    

    // Helper methods
    public function isOverdue()
    {
        return $this->due_date && Carbon::now()->gt($this->due_date);
    }

    public function getDaysUntilDue()
    {
        if (!$this->due_date) return null;
        
        $now = Carbon::now();
        $dueDate = Carbon::parse($this->due_date);
        
        if ($now->gt($dueDate)) {
            return 'Terlambat ' . $now->diffInDays($dueDate) . ' hari';
        }
        
        $diff = $now->diffInDays($dueDate);
        if ($diff == 0) {
            return 'Hari ini';
        } elseif ($diff == 1) {
            return 'Besok';
        } else {
            return $diff . ' hari lagi';
        }
    }

    public function getSubmissionPercentage()
    {
        $totalStudents = $this->classRoom->students()->count();
        $submissionCount = $this->submissions()->count();
        
        return $totalStudents > 0 ? ($submissionCount / $totalStudents) * 100 : 0;
    }

    public function getStatusColor()
    {
        if ($this->isOverdue()) {
            return 'text-red-600 bg-red-100';
        } elseif ($this->getDaysUntilDue() === 'Hari ini' || $this->getDaysUntilDue() === 'Besok') {
            return 'text-yellow-600 bg-yellow-100';
        } else {
            return 'text-green-600 bg-green-100';
        }
    }
}