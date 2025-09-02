<x-teacher-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <h2 class="font-bold text-2xl text-charcoal leading-tight">
                    {{ __('Dashboard Guru') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Kelola aktivitas pembelajaran Anda dengan mudah</p>
            </div>
            <div class="bg-teacher-primary/10 px-4 py-2 rounded-lg border border-teacher-primary/20">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-teacher-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-sm font-medium text-teacher-primary">
                        Tahun Ajaran: {{ \App\Models\Semester::where('is_active', true)->first()->school_year ?? 'Belum Ditetapkan' }}
                    </span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Banner -->
            <div class="relative bg-gradient-to-br from-teacher-primary via-teacher-primary/95 to-teacher-primary/90 text-white overflow-hidden shadow-xl sm:rounded-2xl">
                <div class="absolute inset-0 bg-gradient-to-r from-black/5 to-transparent"></div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-32 translate-x-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-24 -translate-x-24"></div>
                <div class="relative p-8">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-3xl font-bold mb-2">Selamat Datang Kembali!</h3>
                            <p class="text-xl text-white/90 mb-1">{{ $teacher->full_name }}</p>
                            <p class="text-white/70">Semoga hari Anda produktif dan menyenangkan</p>
                        </div>
                        <div class="hidden sm:flex bg-white/10 backdrop-blur-sm rounded-2xl p-4">
                            <svg class="w-12 h-12 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="group bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="bg-gradient-to-br from-teacher-primary to-teacher-primary/80 p-3 rounded-xl shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16l4-2 4 2 4-2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Kelas Diampu</p>
                                    <p class="text-3xl font-bold text-charcoal group-hover:text-teacher-primary transition-colors">{{ $totalClasses }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-2xl text-teacher-primary/20 group-hover:text-teacher-primary/40 transition-colors">📚</div>
                    </div>
                    <div class="bg-teacher-primary/5 rounded-lg p-3 mt-4">
                        <p class="text-xs text-teacher-primary font-medium">Kelas aktif semester ini</p>
                    </div>
                </div>

                <div class="group bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="bg-gradient-to-br from-teacher-accent to-teacher-accent/80 p-3 rounded-xl shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Mata Pelajaran</p>
                                    <p class="text-3xl font-bold text-charcoal group-hover:text-teacher-accent transition-colors">{{ $totalSubjects }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-2xl text-teacher-accent/20 group-hover:text-teacher-accent/40 transition-colors">📖</div>
                    </div>
                    <div class="bg-teacher-accent/5 rounded-lg p-3 mt-4">
                        <p class="text-xs text-teacher-accent font-medium">Mata pelajaran yang diampu</p>
                    </div>
                </div>

                <div class="group bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 p-3 rounded-xl shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 004.5 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Total Siswa</p>
                                    <p class="text-3xl font-bold text-charcoal group-hover:text-indigo-600 transition-colors">{{ $totalStudents }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-2xl text-indigo-400/20 group-hover:text-indigo-400/40 transition-colors">👥</div>
                    </div>
                    <div class="bg-indigo-50 rounded-lg p-3 mt-4">
                        <p class="text-xs text-indigo-600 font-medium">Siswa yang Anda ajar</p>
                    </div>
                </div>
            </div>

            <!-- Quick Access Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="bg-gradient-to-r from-gray-50 to-white p-6 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="bg-teacher-primary p-2 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-charcoal">Akses Cepat</h3>
                    </div>
                    <p class="text-gray-600 mt-1">Fitur yang sering Anda gunakan</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <a href="{{ route('teacher.attendances.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-teacher-primary to-teacher-primary/90 hover:from-teacher-primary/90 hover:to-teacher-primary rounded-xl p-6 text-center transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl">
                            <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="relative">
                                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl mx-auto w-fit mb-4 group-hover:bg-white/30 transition-colors">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-white text-lg mb-2">Kelola Absensi</h4>
                                <p class="text-white/80 text-sm">Pantau kehadiran siswa harian</p>
                            </div>
                        </a>

                        <a href="{{ route('teacher.grades.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-teacher-accent to-teacher-accent/90 hover:from-teacher-accent/90 hover:to-teacher-accent rounded-xl p-6 text-center transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl">
                            <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="relative">
                                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl mx-auto w-fit mb-4 group-hover:bg-white/30 transition-colors">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-white text-lg mb-2">Input Nilai</h4>
                                <p class="text-white/80 text-sm">Catat dan kelola nilai siswa</p>
                            </div>
                        </a>

                        <a href="{{ route('teacher.assignments.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 rounded-xl p-6 text-center transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl">
                            <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="relative">
                                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl mx-auto w-fit mb-4 group-hover:bg-white/30 transition-colors">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-white text-lg mb-2">Kelola Tugas</h4>
                                <p class="text-white/80 text-sm">Buat dan pantau tugas siswa</p>
                            </div>
                        </a>

                        <a href="{{ route('teacher.materials.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-emerald-600 to-emerald-700 hover:from-emerald-500 hover:to-emerald-600 rounded-xl p-6 text-center transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl">
                            <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="relative">
                                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl mx-auto w-fit mb-4 group-hover:bg-white/30 transition-colors">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-white text-lg mb-2">Kelola Materi</h4>
                                <p class="text-white/80 text-sm">Unggah dan kelola materi pembelajaran</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Class Assignments Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="bg-gradient-to-r from-gray-50 to-white p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-teacher-primary p-2 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16l4-2 4 2 4-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-charcoal">Penugasan Mengajar</h3>
                                <p class="text-gray-600 text-sm">Kelas dan mata pelajaran yang Anda ampu</p>
                            </div>
                        </div>
                        @if(!empty($classAssignments))
                            <div class="hidden sm:flex bg-teacher-primary/10 px-3 py-1 rounded-full">
                                <span class="text-teacher-primary font-semibold text-sm">{{ count($classAssignments) }} Kelas</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="p-6">
                    @forelse($classAssignments as $className => $assignments)
                        <div class="mb-8 last:mb-0">
                            <!-- Class Header -->
                            <div class="bg-gradient-to-r from-teacher-bg to-white rounded-xl p-6 mb-4 border-l-4 border-teacher-primary">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="bg-teacher-primary p-3 rounded-xl">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16l4-2 4 2 4-2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-xl text-charcoal">Kelas {{ $className }}</h4>
                                            <p class="text-gray-600">{{ count($assignments) }} mata pelajaran</p>
                                        </div>
                                    </div>
                                    <div class="hidden sm:block">
                                        <div class="bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-200">
                                            <span class="text-teacher-primary font-semibold text-sm">{{ count($assignments) }} Mapel</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Subjects Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 pl-4">
                                @foreach($assignments as $assignment)
                                    <div class="group bg-white border border-gray-200 hover:border-teacher-accent rounded-xl p-5 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                        <div class="flex items-center space-x-3">
                                            <div class="bg-teacher-accent/10 p-2 rounded-lg group-hover:bg-teacher-accent/20 transition-colors">
                                                <svg class="w-5 h-5 text-teacher-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <p class="font-semibold text-charcoal group-hover:text-teacher-accent transition-colors">{{ $assignment->subject->name }}</p>
                                                <p class="text-xs text-gray-500 mt-1">Mata Pelajaran</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Action buttons -->
                                        <div class="mt-4 pt-3 border-t border-gray-100 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <div class="grid grid-cols-3 gap-2">
                                                <button class="bg-teacher-accent/10 hover:bg-teacher-accent/20 text-teacher-accent text-xs font-medium py-2 px-3 rounded-lg transition-colors">
                                                    Absensi
                                                </button>
                                                <button class="bg-teacher-primary/10 hover:bg-teacher-primary/20 text-teacher-primary text-xs font-medium py-2 px-3 rounded-lg transition-colors">
                                                    Nilai
                                                </button>
                                                <button class="bg-emerald-100 hover:bg-emerald-200 text-emerald-700 text-xs font-medium py-2 px-3 rounded-lg transition-colors">
                                                    Materi
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16">
                            <div class="bg-gray-100 p-6 rounded-2xl mx-auto w-fit mb-6">
                                <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16l4-2 4 2 4-2z"></path>
                                </svg>
                            </div>
                            <h4 class="text-xl font-semibold text-charcoal mb-2">Belum Ada Penugasan</h4>
                            <p class="text-gray-600 mb-6 max-w-md mx-auto">Anda belum ditugaskan untuk mengajar di kelas manapun. Silakan hubungi administrator untuk penugasan kelas.</p>
                            <button class="bg-teacher-primary hover:bg-teacher-primary/90 text-white font-semibold py-3 px-6 rounded-xl transition-colors">
                                Hubungi Admin
                            </button>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Additional Info Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Tips Section -->
                <div class="bg-gradient-to-br from-teacher-bg to-white p-6 rounded-xl border border-teacher-primary/20">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-teacher-primary p-2 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-charcoal">Tips Hari Ini</h4>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">Unggah materi pembelajaran secara digital untuk memudahkan akses siswa dan membuat pembelajaran lebih interaktif.</p>
                </div>

                <!-- Quick Stats -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-teacher-accent p-2 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-charcoal">Ringkasan Cepat</h4>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Kelas Aktif</span>
                            <span class="font-semibold text-teacher-primary">{{ $totalClasses }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Mata Pelajaran</span>
                            <span class="font-semibold text-teacher-accent">{{ $totalSubjects }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-sm text-gray-600">Siswa Diajar</span>
                            <span class="font-semibold text-indigo-600">{{ $totalStudents }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>