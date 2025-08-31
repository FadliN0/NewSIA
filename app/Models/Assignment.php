<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}