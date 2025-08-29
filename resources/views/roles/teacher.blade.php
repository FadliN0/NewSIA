<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Guru') }}
            </h2>
            <div class="text-sm text-gray-500">
                Tahun Ajaran Aktif: {{ \App\Models\Semester::where('is_active', true)->first()->school_year ?? 'Belum Ditetapkan' }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold">Selamat Datang, {{ $teacher->full_name }}!</h3>
                    <p class="text-gray-600 mt-1">Ini adalah pusat kendali Anda untuk mengelola aktivitas akademik.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center space-x-4">
                    <div class="bg-indigo-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16l4-2 4 2 4-2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jumlah Kelas Diampu</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalClasses }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center space-x-4">
                    <div class="bg-teal-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Mata Pelajaran</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalSubjects }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center space-x-4">
                    <div class="bg-lime-100 p-3 rounded-full">
                         <svg class="w-6 h-6 text-lime-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 004.5 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Siswa Diajar</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalStudents }}</p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Penugasan Mengajar Anda</h3>
                @forelse($classAssignments as $className => $assignments)
                    <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                        <div class="p-6">
                            <h4 class="font-bold text-lg text-gray-700 border-b pb-2 mb-4">Kelas: {{ $className }}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($assignments as $assignment)
                                    <div class="p-4 bg-gray-50 rounded-lg border hover:shadow-md transition-shadow">
                                        <p class="font-semibold text-gray-800">{{ $assignment->subject->name }}</p>
                                        <div class="mt-4 space-y-2">
                                            <a href="{{ route('teacher.attendances.index') }}" class="flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                Kelola Absensi
                                            </a>
                                            <a href="#" class="flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                                Input Nilai
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <p class="text-center text-gray-500">Anda belum ditugaskan untuk mengajar di kelas manapun.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>