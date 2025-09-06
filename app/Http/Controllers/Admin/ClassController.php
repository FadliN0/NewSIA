<?php
// app/Http/Controllers/Admin/ClassController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom; // Assuming your model is named ClassRoom
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{
    /**
     * Display a listing of classes
     */
    public function index()
    {
        // 1. Ambil SEMUA data kelas dengan jumlah siswa untuk kalkulasi statistik
        $allClasses = ClassRoom::withCount('students')->get();

        // 2. Hitung semua statistik yang dibutuhkan untuk Quick Stat Cards
        $stats = [
            'available' => $allClasses->filter(function($class) {
                return $class->students_count < $class->max_students;
            })->count(),
            'nearly_full' => $allClasses->filter(function($class) {
                $percentage = $class->max_students > 0 ? ($class->students_count / $class->max_students) * 100 : 0;
                return $percentage >= 80 && $percentage < 100;
            })->count(),
            'full' => $allClasses->filter(function($class) {
                return $class->students_count >= $class->max_students;
            })->count(),
            'total_capacity' => $allClasses->sum('max_students'),
        ];

        // 3. Ambil data kelas lagi, tapi kali ini dengan paginasi untuk ditampilkan di tabel
        $classes = ClassRoom::withCount('students')
            ->orderBy('name')
            ->paginate(10); // Anda bisa sesuaikan jumlah per halaman

        // 4. Kirim kedua set data ke view
        return view('admin.classes.index', compact('classes', 'stats'));
    }

    /**
     * Show the form for creating a new class
     */
    public function create()
    {
        return view('admin.classes.create');
    }

    /**
     * Store a newly created class
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:10|unique:class_rooms,name',
            'grade_level' => 'required|integer|min:10|max:12',
            'max_students' => 'required|integer|min:1|max:50',
            'description' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        ClassRoom::create($request->all());

        return redirect()->route('admin.classes.index')
            ->with('success', 'Kelas berhasil ditambahkan!');
    }

    /**
     * Display the specified class
     */
    public function show(ClassRoom $class)
    {
        $class->load(['students' => function($query) {
            $query->orderBy('full_name');
        }]);

        // Get class statistics
        $stats = [
            'total_students' => $class->students->count(),
            'capacity_used' => round(($class->students->count() / $class->max_students) * 100, 1),
            'available_seats' => $class->max_students - $class->students->count()
        ];

        return view('admin.classes.show', compact('class', 'stats'));
    }

    /**
     * Show the form for editing the specified class
     */
    public function edit(ClassRoom $class)
    {
        return view('admin.classes.edit', compact('class'));
    }

    /**
     * Update the specified class
     */
    public function update(Request $request, ClassRoom $class)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:10|unique:class_rooms,name,' . $class->id,
            'grade_level' => 'required|integer|min:10|max:12',
            'max_students' => 'required|integer|min:1|max:50',
            'description' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if reducing max_students below current student count
        if ($request->max_students < $class->students->count()) {
            return redirect()->back()
                ->withErrors(['capacity' => 'Kapasitas tidak boleh kurang dari jumlah siswa saat ini (' . $class->students->count() . ')'])
                ->withInput();
        }

        $class->update([
            'name' => $request->name,
            'grade_level' => $request->grade_level,
            'capacity' => $request->capacity,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Kelas berhasil diperbarui!');
    }

    /**
     * Remove the specified class
     */
    public function destroy(ClassRoom $class)
    {
        // Check if class has students
        if ($class->students()->count() > 0) {
            return redirect()->route('admin.classes.index')
                ->with('error', 'Tidak dapat menghapus kelas yang masih memiliki siswa!');
        }

        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'Kelas berhasil dihapus!');
    }

    /**
     * Get classes for AJAX requests
     */
    public function getClassesForSelect()
    {
        $classes = ClassRoom::select('id', 'name', 'grade_level')
            ->withCount('students')
            ->orderBy('name')
            ->get()
            ->map(function ($class) {
                return [
                    'id' => $class->id,
                    'name' => $class->name,
                    'grade_level' => $class->grade_level,
                    'available_seats' => $class->capacity - $class->students_count,
                    'full' => $class->students_count >= $class->capacity
                ];
            });

        return response()->json($classes);
    }
}