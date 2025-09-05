<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\TeacherSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;
        $materials = Material::where('teacher_id', $teacher->id)
            ->with(['classRoom', 'subject'])
            ->latest()
            ->paginate(10); 
        
        return view('teacher.materials.index', compact('materials'));
    }

    public function create()
    {
        $teacher = Auth::user()->teacher;
        $classSubjects = $teacher->teacherSubjects()
            ->with(['classRoom', 'subject'])
            ->get();

        // Urutkan koleksi berdasarkan nama kelas (classRoom->name)
        $classSubjects = $classSubjects->sortBy(function ($teacherSubject) {
            return $teacherSubject->classRoom->name;
        });
                                                                                                    
        return view('teacher.materials.create', compact('classSubjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher_subject_id' => 'required|exists:teacher_subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|max:10240', // Max 10MB
        ]);

        $teacherSubject = TeacherSubject::find($request->teacher_subject_id);
        $file = $request->file('file');
        
        // Simpan file ke direktori storage/app/public/materials
        $path = $file->store('materials', 'public');

        Material::create([
            'teacher_id' => Auth::user()->teacher->id,
            'class_room_id' => $teacherSubject->class_room_id,
            'subject_id' => $teacherSubject->subject_id,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
        ]);

        return redirect()->route('teacher.materials.index')->with('success', 'Materi berhasil diunggah.');
    }
    
    public function destroy(Material $material)
    {
        if ($material->teacher_id !== Auth::user()->teacher->id) {
            abort(403);
        }

        // Hapus file dari storage
        Storage::disk('public')->delete($material->file_path);

        $material->delete();
        return redirect()->route('teacher.materials.index')->with('success', 'Materi berhasil dihapus.');
    }
}