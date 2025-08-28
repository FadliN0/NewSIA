<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\AttendanceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('auth.login');
});

// Routing setelah login
Route::get('/dashboard', function () {  
    return match(auth()->user()->role) {
        'admin' => redirect()->route('admin.dashboard'),    
        'teacher' => redirect()->route('teacher.dashboard'),
        default => redirect()->route('siswa.dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// Grouping route sesuai role
Route::middleware(['auth', 'role:admin'])
->prefix('admin')
->as('admin.')
->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Classes Management
    Route::resource('classes', ClassController::class);
    
    // Students Management  
    Route::resource('students', StudentController::class);
    // Route::get('students/class/{class}', [StudentController::class, 'byClass'])->name('students.by-class');
    
    // Teachers Management
    Route::resource('teachers', TeacherController::class);
    Route::post('teachers/{teacher}/assign-subjects', [TeacherController::class, 'assignSubjects'])->name('teachers.assign-subjects');
    
    // Subjects Management
    Route::resource('subjects', SubjectController::class);

    Route::resource('semesters', SemesterController::class);
    
    // Reports
    Route::get('reports/academic', [AdminController::class, 'academicReports'])->name('reports.academic');
    Route::get('reports/attendance', [AdminController::class, 'attendanceReports'])->name('reports.attendance');
    Route::get('reports/academic/export', [AdminController::class, 'exportAcademicReport'])->name('reports.academic.export');
    
    // Quick Actions API endpoints for AJAX
    Route::post('quick-actions/add-student-to-class', [AdminController::class, 'quickAddStudentToClass'])->name('quick.add-student-class');
    Route::post('quick-actions/create-user-account', [AdminController::class, 'quickCreateUserAccount'])->name('quick.create-user-account');
});

Route::middleware(['auth', 'role:teacher'])
->prefix('teacher') // Tambahkan prefix agar URL menjadi /teacher/...
->as('teacher.')    // Tambahkan name agar menjadi teacher.*
->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('attendances', AttendanceController::class)->only(['index', 'create', 'store']);
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa', fn() => view('roles.siswa'))->name('siswa.dashboard');
});

// Default route profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', function() {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');



require __DIR__.'/auth.php';
