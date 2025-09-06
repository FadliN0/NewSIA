<x-student-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="font-bold text-3xl text-charcoal leading-tight">
                    Selamat Datang, {{ $student->full_name }}! 👋
                </h1>
                <p class="text-gray-600 mt-1">Semangat belajar hari ini! Lihat progress akademik Anda.</p>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Quick Stats Badge -->
                <div class="bg-student-primary/10 px-4 py-2 rounded-xl border border-student-primary/20">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-success rounded-full pulse-dot"></div>
                        <span class="text-sm font-semibold text-student-primary">
                            Semester Aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 space-y-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Hero Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Mata Pelajaran -->
                <div class="group bg-gradient-to-br from-student-primary to-student-primary/80 p-6 rounded-2xl text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-student-primary/ text-sm font-medium opacity-90">Total Mata Pelajaran</p>
                            <p class="text-3xl font-bold mt-1">{{ $subjectCount }}</p>
                            <p class="text-xs opacity-75 mt-1">Semester ini</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-xl group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Rata-rata Nilai -->
                <div class="group bg-gradient-to-br from-success to-success/80 p-6 rounded-2xl text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-success/ text-sm font-medium opacity-90">Rata-rata Nilai</p>
                            <p class="text-3xl font-bold mt-1">{{ number_format($averageGrade, 1) }}</p>
                            <p class="text-xs opacity-75 mt-1">
                                @if($averageGrade >= 85)
                                    Sangat Baik! 🎉
                                @elseif($averageGrade >= 75)
                                    Baik 👍
                                @elseif($averageGrade >= 65)
                                    Cukup 📚
                                @else
                                    Perlu Ditingkatkan 💪
                                @endif
                            </p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-xl group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Kehadiran -->
                <div class="group bg-gradient-to-br from-warning to-warning/80 p-6 rounded-2xl text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-warning/ text-sm font-medium opacity-90">Kehadiran</p>
                            <p class="text-3xl font-bold mt-1">{{ $attendancePercentage }}%</p>
                            <p class="text-xs opacity-75 mt-1">
                                @if($attendancePercentage >= 95)
                                    Perfect! ⭐
                                @elseif($attendancePercentage >= 85)
                                    Baik Sekali 👏
                                @elseif($attendancePercentage >= 75)
                                    Cukup Baik ✅
                                @else
                                    Tingkatkan Lagi ⚡
                                @endif
                            </p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-xl group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Tugas Mendatang -->
                <div class="group bg-gradient-to-br from-student-accent to-student-accent/80 p-6 rounded-2xl text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-student-accent/ text-sm font-medium opacity-90">Tugas Mendatang</p>
                            <p class="text-3xl font-bold mt-1">{{ $upcomingAssignments->count() }}</p>
                            <p class="text-xs opacity-75 mt-1">
                                @if($upcomingAssignments->count() == 0)
                                    Santai dulu 😎
                                @elseif($upcomingAssignments->count() <= 2)
                                    Siap-siap! 📝
                                @else
                                    Waktunya fokus! 🔥
                                @endif
                            </p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-xl group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column: Charts & Progress -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Grafik Nilai Per Mata Pelajaran -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-xl font-bold text-charcoal">Grafik Nilai Per Mata Pelajaran</h3>
                                <p class="text-gray-600 text-sm">Visualisasi performa akademik Anda</p>
                            </div>
                            <div class="bg-student-primary/10 p-2 rounded-lg">
                                <svg class="w-6 h-6 text-student-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Chart Area -->
                        <div class="space-y-4">
                            @forelse($subjectGrades as $subjectGrade)
                                @php
                                    $percentage = ($subjectGrade->average_score / 100) * 100;
                                    $colorClass = $subjectGrade->average_score >= 85 ? 'bg-success' : 
                                                 ($subjectGrade->average_score >= 75 ? 'bg-warning' : 'bg-error');
                                @endphp
                                <div class="bg-light-gray rounded-xl p-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-medium text-charcoal">{{ $subjectGrade->subject->name }}</span>
                                        <span class="text-sm font-bold {{ $subjectGrade->average_score >= 75 ? 'text-success' : 'text-error' }}">
                                            {{ number_format($subjectGrade->average_score, 1) }}
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="{{ $colorClass }} h-3 rounded-full transition-all duration-700 ease-out" 
                                             style="width: {{ min($percentage, 100) }}%"></div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div class="bg-gray-100 p-6 rounded-2xl mx-auto w-fit mb-4">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500">Belum ada data nilai tersedia</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Kehadiran Progress Circle -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-xl font-bold text-charcoal">Progress Kehadiran</h3>
                                <p class="text-gray-600 text-sm">Tingkat kehadiran semester ini</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-center">
                            <div class="relative">
                                <svg class="w-32 h-32 transform -rotate-90">
                                    <circle cx="64" cy="64" r="56" stroke="currentColor" stroke-width="8" fill="transparent" class="text-gray-200"></circle>
                                    <circle cx="64" cy="64" r="56" stroke="currentColor" stroke-width="8" fill="transparent" 
                                            class="text-student-primary progress-ring" 
                                            stroke-dasharray="{{ ($attendancePercentage / 100) * 351.86 }} 351.86"></circle>
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="text-center">
                                        <span class="text-3xl font-bold text-charcoal">{{ $attendancePercentage }}%</span>
                                        <p class="text-xs text-gray-500">Kehadiran</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Upcoming Tasks & Quick Links -->
                <div class="space-y-8">
                    
                    <!-- Tugas Mendatang -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-xl font-bold text-charcoal">Tugas Mendatang</h3>
                                <p class="text-gray-600 text-sm">Jangan sampai terlewat!</p>
                            </div>
                            <a href="{{ route('student.assignments.index') }}" class="text-student-primary hover:text-student-primary/80 text-sm font-medium">
                                Lihat Semua →
                            </a>
                        </div>

                        <div class="space-y-4">
                            @forelse($upcomingAssignments->take(3) as $assignment)
                                @php
                                    $daysLeft = \Carbon\Carbon::parse($assignment->due_date)->diffInDays(now(), false);
                                    $isUrgent = $daysLeft <= 1;
                                @endphp
                                <div class="bg-light-gray rounded-xl p-4 border-l-4 {{ $isUrgent ? 'border-error' : 'border-student-primary' }}">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-semibold text-charcoal text-sm truncate pr-2">{{ $assignment->title }}</h4>
                                        <span class="text-xs px-2 py-1 rounded-full {{ $isUrgent ? 'bg-error/20 text-error' : 'bg-student-primary/20 text-student-primary' }}">
                                            {{ $daysLeft == 0 ? 'Hari ini' : ($daysLeft == 1 ? 'Besok' : $daysLeft . ' hari') }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-600 mb-2">{{ $assignment->subject->name }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-500">{{ $assignment->teacher->full_name }}</span>
                                        <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($assignment->due_date)->format('d M, H:i') }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div class="bg-success/10 p-6 rounded-2xl mx-auto w-fit mb-4">
                                        <svg class="w-12 h-12 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 text-sm">Tidak ada tugas mendatang</p>
                                    <p class="text-success text-xs mt-1">Waktunya santai! 🎉</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Quick Navigation -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300">
                        <h3 class="text-xl font-bold text-charcoal mb-6">Quick Navigation</h3>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <a href="{{ route('student.assignments.index') }}" class="group bg-student-primary/10 hover:bg-student-primary/20 p-4 rounded-xl transition-all duration-200">
                                <div class="text-center">
                                    <div class="bg-student-primary/20 p-3 rounded-lg mx-auto w-fit mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6 text-student-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-student-primary">Tugas</p>
                                </div>
                            </a>

                            <a href="{{ route('student.grades.index') }}" class="group bg-success/10 hover:bg-success/20 p-4 rounded-xl transition-all duration-200">
                                <div class="text-center">
                                    <div class="bg-success/20 p-3 rounded-lg mx-auto w-fit mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-success">Rapor</p>
                                </div>
                            </a>

                            <a href="{{ route('student.attendances.index') }}" class="group bg-warning/10 hover:bg-warning/20 p-4 rounded-xl transition-all duration-200">
                                <div class="text-center">
                                    <div class="bg-warning/20 p-3 rounded-lg mx-auto w-fit mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-warning">Absensi</p>
                                </div>
                            </a>

                            <a href="{{ route('student.materials.index') }}" class="group bg-student-accent/10 hover:bg-student-accent/20 p-4 rounded-xl transition-all duration-200">
                                <div class="text-center">
                                    <div class="bg-student-accent/20 p-3 rounded-lg mx-auto w-fit mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6 text-student-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-student-accent">Materi</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .pulse-dot {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
    </style>
</x-student-layout>