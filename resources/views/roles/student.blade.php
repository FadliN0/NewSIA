<x-student-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <h2 class="font-bold text-2xl text-charcoal leading-tight">
                    {{ __('Dashboard Siswa') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Pantau perkembangan belajar Anda dengan mudah</p>
            </div>
            <div class="bg-student-primary/10 px-4 py-2 rounded-lg border border-student-primary/20">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-student-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-sm font-medium text-student-primary">
                        {{ $student->classRoom->name ?? 'Belum Ditetapkan' }}
                    </span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Banner -->
            <div class="relative bg-gradient-to-br from-student-primary to-student-accent text-white overflow-hidden shadow-xl sm:rounded-2xl">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-32 translate-x-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-24 -translate-x-24"></div>
                <div class="relative p-8">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-3xl font-bold mb-2">Halo, {{ $student->full_name }}! 👋</h3>
                            <p class="text-xl text-white/90 mb-1">{{ $student->classRoom->name ?? 'Kelas belum ditetapkan' }}</p>
                            <p class="text-white/70">Semoga hari ini produktif dan penuh semangat</p>
                        </div>
                        <div class="hidden sm:flex bg-white/10 backdrop-blur-sm rounded-2xl p-4">
                            <svg class="w-12 h-12 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Mata Pelajaran Card -->
                <div class="group bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="bg-gradient-to-br from-student-primary to-student-primary/80 p-3 rounded-xl shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Mata Pelajaran</p>
                                    <p class="text-3xl font-bold text-charcoal group-hover:text-student-primary transition-colors">{{ $subjectCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-2xl text-student-primary/20 group-hover:text-student-primary/40 transition-colors">📚</div>
                    </div>
                    <div class="bg-student-primary/5 rounded-lg p-3 mt-4">
                        <p class="text-xs text-student-primary font-medium">Mapel semester ini</p>
                    </div>
                </div>

                <!-- Rata-rata Nilai Card -->
                <div class="group bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="bg-gradient-to-br from-student-accent to-student-accent/80 p-3 rounded-xl shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Rata-rata Nilai</p>
                                    <p class="text-3xl font-bold text-charcoal group-hover:text-student-accent transition-colors">
                                        {{ $averageGrade ? number_format($averageGrade, 1) : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="text-2xl text-student-accent/20 group-hover:text-student-accent/40 transition-colors">📊</div>
                    </div>
                    <div class="bg-student-accent/5 rounded-lg p-3 mt-4">
                        <div class="flex items-center justify-between">
                            <p class="text-xs text-student-accent font-medium">Semester ini</p>
                            @if($averageGrade)
                                <span class="text-xs px-2 py-1 rounded-full {{ $averageGrade >= 75 ? 'bg-success/20 text-success' : 'bg-warning/20 text-warning' }}">
                                    {{ $averageGrade >= 75 ? 'Baik' : 'Perlu Ditingkatkan' }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Kehadiran Card -->
                <div class="group bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="bg-gradient-to-br from-success to-success/80 p-3 rounded-xl shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Kehadiran</p>
                                    <p class="text-3xl font-bold text-charcoal group-hover:text-success transition-colors">
                                        {{ number_format($attendancePercentage, 1) }}%
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="text-2xl text-success/20 group-hover:text-success/40 transition-colors">✅</div>
                    </div>
                    <div class="bg-success/5 rounded-lg p-3 mt-4">
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                            <div class="bg-success h-2 rounded-full transition-all duration-700" style="width: {{ $attendancePercentage }}%"></div>
                        </div>
                        <p class="text-xs text-success font-medium">{{ $attendancePercentage >= 80 ? 'Sangat baik' : 'Perlu ditingkatkan' }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Access Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="bg-gradient-to-r from-student-bg to-white p-6 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="bg-student-primary p-2 rounded-lg">
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
                        <a href="{{ route('student.assignments.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-student-primary to-student-primary/90 hover:from-student-primary/90 hover:to-student-primary rounded-xl p-6 text-center transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl">
                            <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="relative">
                                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl mx-auto w-fit mb-4 group-hover:bg-white/30 transition-colors">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-white text-lg mb-2">Tugas</h4>
                                <p class="text-white/80 text-sm">Lihat dan kumpulkan tugas</p>
                            </div>
                        </a>

                        <a href="{{ route('student.grades.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-student-accent to-student-accent/90 hover:from-student-accent/90 hover:to-student-accent rounded-xl p-6 text-center transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl">
                            <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="relative">
                                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl mx-auto w-fit mb-4 group-hover:bg-white/30 transition-colors">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-white text-lg mb-2">Rapor Online</h4>
                                <p class="text-white/80 text-sm">Cek nilai dan laporan</p>
                            </div>
                        </a>

                        <a href="{{ route('student.attendances.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-success to-success/90 hover:from-success/90 hover:to-success rounded-xl p-6 text-center transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl">
                            <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="relative">
                                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl mx-auto w-fit mb-4 group-hover:bg-white/30 transition-colors">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-white text-lg mb-2">Riwayat Absensi</h4>
                                <p class="text-white/80 text-sm">Lihat kehadiran Anda</p>
                            </div>
                        </a>

                        <a href="{{ route('student.materials.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-warning to-warning/90 hover:from-warning/90 hover:to-warning rounded-xl p-6 text-center transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl">
                            <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="relative">
                                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-xl mx-auto w-fit mb-4 group-hover:bg-white/30 transition-colors">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16l4-2 4 2 4-2z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-white text-lg mb-2">Materi Pelajaran</h4>
                                <p class="text-white/80 text-sm">Akses materi pembelajaran</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Upcoming Assignments -->
            @if($upcomingAssignments->isNotEmpty())
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="bg-gradient-to-r from-light-gray to-white p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-warning p-2 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-charcoal">Tugas Mendatang</h3>
                                <p class="text-gray-600 text-sm">Jangan sampai terlewat!</p>
                            </div>
                        </div>
                        <div class="hidden sm:flex bg-warning/10 px-3 py-1 rounded-full">
                            <span class="text-warning font-semibold text-sm">{{ $upcomingAssignments->count() }} Tugas</span>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($upcomingAssignments as $assignment)
                        <div class="flex items-center justify-between p-4 bg-light-gray rounded-xl border border-gray-100 hover:shadow-md transition-all duration-300">
                            <div class="flex items-center space-x-4">
                                <div class="bg-student-primary/10 p-3 rounded-lg">
                                    <svg class="w-5 h-5 text-student-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-charcoal">{{ $assignment->title }}</h4>
                                    <p class="text-sm text-gray-600">{{ $assignment->subject->name }}</p>
                                    <p class="text-xs text-warning font-medium">
                                        Deadline: {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('student.assignments.show', $assignment) }}" 
                               class="bg-student-primary hover:bg-student-primary/90 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                Lihat Detail
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Subject Grades Chart (if data available) -->
            @if($subjectGrades->isNotEmpty())
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="bg-gradient-to-r from-light-gray to-white p-6 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="bg-student-accent p-2 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-charcoal">Rata-rata Nilai per Mata Pelajaran</h3>
                            <p class="text-gray-600 text-sm">Grafik performa akademik Anda</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($subjectGrades as $grade)
                        <div class="bg-light-gray p-4 rounded-xl border">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-semibold text-charcoal text-sm">{{ $grade->subject->name }}</h4>
                                <span class="text-lg font-bold {{ $grade->average_score >= 75 ? 'text-success' : 'text-warning' }}">
                                    {{ number_format($grade->average_score, 1) }}
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="h-2 rounded-full transition-all duration-700 {{ $grade->average_score >= 75 ? 'bg-success' : 'bg-warning' }}" 
                                     style="width: {{ ($grade->average_score / 100) * 100 }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-student-layout>