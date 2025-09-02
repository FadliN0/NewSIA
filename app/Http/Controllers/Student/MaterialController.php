<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;

        $materials = Material::where('class_room_id', $student->class_room_id)
            ->with(['teacher', 'subject'])
            ->latest()
            ->paginate(10);
        
        return view('student.materials.index', compact('materials'));
    }
}
