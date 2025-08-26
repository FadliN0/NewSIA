<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = Semester::orderBy('start_date', 'desc')->paginate(10);
        return view('admin.semesters.index', compact('semesters'));
    }

    public function create()
    {
        return view('admin.semesters.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|in:Ganjil,Genap',
            'school_year' => 'required|regex:/^\d{4}\/\d{4}$/', // Format YYYY/YYYY
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Jika semester baru diaktifkan, nonaktifkan yang lain
            if ($request->has('is_active')) {
                Semester::where('is_active', true)->update(['is_active' => false]);
            }

            Semester::create([
                'name' => $request->name,
                'school_year' => $request->school_year,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'is_active' => $request->has('is_active'),
            ]);

            return redirect()->route('admin.semesters.index')->with('success', 'Semester berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan semester.')->withInput();
        }
    }

    public function edit(Semester $semester)
    {
        return view('admin.semesters.edit', compact('semester'));
    }

    public function update(Request $request, Semester $semester)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|in:Ganjil,Genap',
            'school_year' => 'required|regex:/^\d{4}\/\d{4}$/',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::transaction(function () use ($request, $semester) {
                // Jika semester ini diaktifkan, nonaktifkan yang lainnya
                if ($request->has('is_active')) {
                    Semester::where('is_active', true)->where('id', '!=', $semester->id)->update(['is_active' => false]);
                }

                $semester->update([
                    'name' => $request->name,
                    'school_year' => $request->school_year,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'is_active' => $request->has('is_active'),
                ]);
            });

            return redirect()->route('admin.semesters.index')->with('success', 'Semester berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui semester.')->withInput();
        }
    }

    public function destroy(Semester $semester)
    {
        // Tambahkan validasi: jangan hapus semester aktif
        if ($semester->is_active) {
            return redirect()->route('admin.semesters.index')->with('error', 'Tidak dapat menghapus semester yang sedang aktif.');
        }

        // Tambahkan validasi lain jika semester sudah punya nilai/absensi

        $semester->delete();
        return redirect()->route('admin.semesters.index')->with('success', 'Semester berhasil dihapus.');
    }
}