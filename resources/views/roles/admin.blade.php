{{-- resources/views/roles/admin.blade.php --}}
<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gradient-to-r from-admin-primary to-admin-accent p-6 rounded-lg shadow-sm">
            <div class="flex items-center">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-2xl text-white leading-tight">{{ __('Admin Dashboard') }}</h2>
                        <span class="text-sm text-white/80 font-medium">SMA Academic Management System</span>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <div class="text-white/90 text-sm font-medium">Selamat datang,</div>
                <div class="text-white font-bold text-lg">{{ Auth::user()->name ?? 'Administrator' }}</div>
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-admin-bg min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Students Card -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-0 p-6 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-admin-primary to-admin-accent rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 004.5 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Siswa</p>
                                <p class="text-3xl font-bold text-admin-primary">{{ $totalStudents }}</p>
                            </div>
                        </div>
                        <div class="text-admin-accent">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Teachers Card -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-0 p-6 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-admin-accent to-admin-primary rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Guru</p>
                                <p class="text-3xl font-bold text-admin-primary">{{ $totalTeachers }}</p>
                            </div>
                        </div>
                        <div class="text-admin-accent">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Classes Card -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-0 p-6 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-success to-admin-accent rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l4-2 4 2 4-2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Kelas</p>
                                <p class="text-3xl font-bold text-admin-primary">{{ $totalclass_room }}</p>
                            </div>
                        </div>
                        <div class="text-admin-accent">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Subjects Card -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-0 p-6 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-warning to-admin-primary rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Mata Pelajaran</p>
                                <p class="text-3xl font-bold text-admin-primary">{{ $totalSubjects }}</p>
                            </div>
                        </div>
                        <div class="text-admin-accent">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Quick Actions -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-0 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-admin-primary">Aksi Cepat</h3>
                            <div class="w-8 h-8 bg-admin-accent/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-admin-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <a href="{{ route('admin.students.create') }}" 
                               class="group w-full flex items-center justify-between p-4 bg-gradient-to-r from-admin-bg to-white hover:from-admin-accent/10 hover:to-admin-primary/5 rounded-xl transition-all duration-300 border border-gray-100 hover:border-admin-accent/30 hover:shadow-md">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-admin-accent/10 rounded-lg flex items-center justify-center group-hover:bg-admin-accent/20 transition-colors">
                                        <svg class="w-4 h-4 text-admin-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-semibold text-admin-primary">Tambah Siswa Baru</span>
                                </div>
                                <svg class="w-5 h-5 text-admin-accent group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>

                            <a href="{{ route('admin.teachers.create') }}" 
                               class="group w-full flex items-center justify-between p-4 bg-gradient-to-r from-admin-bg to-white hover:from-admin-accent/10 hover:to-admin-primary/5 rounded-xl transition-all duration-300 border border-gray-100 hover:border-admin-accent/30 hover:shadow-md">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-admin-accent/10 rounded-lg flex items-center justify-center group-hover:bg-admin-accent/20 transition-colors">
                                        <svg class="w-4 h-4 text-admin-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-semibold text-admin-primary">Tambah Guru Baru</span>
                                </div>
                                <svg class="w-5 h-5 text-admin-accent group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>

                            <a href="{{ route('admin.classes.create') }}" 
                               class="group w-full flex items-center justify-between p-4 bg-gradient-to-r from-admin-bg to-white hover:from-admin-accent/10 hover:to-admin-primary/5 rounded-xl transition-all duration-300 border border-gray-100 hover:border-admin-accent/30 hover:shadow-md">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-admin-accent/10 rounded-lg flex items-center justify-center group-hover:bg-admin-accent/20 transition-colors">
                                        <svg class="w-4 h-4 text-admin-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-semibold text-admin-primary">Tambah Kelas Baru</span>
                                </div>
                                <svg class="w-5 h-5 text-admin-accent group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>

                            <a href="{{ route('admin.subjects.create') }}" 
                               class="group w-full flex items-center justify-between p-4 bg-gradient-to-r from-admin-bg to-white hover:from-admin-accent/10 hover:to-admin-primary/5 rounded-xl transition-all duration-300 border border-gray-100 hover:border-admin-accent/30 hover:shadow-md">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-admin-accent/10 rounded-lg flex items-center justify-center group-hover:bg-admin-accent/20 transition-colors">
                                        <svg class="w-4 h-4 text-admin-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-semibold text-admin-primary">Tambah Mata Pelajaran</span>
                                </div>
                                <svg class="w-5 h-5 text-admin-accent group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Students -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-0 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-admin-primary">Siswa Baru Ditambahkan</h3>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-success rounded-full animate-pulse"></div>
                                <span class="text-sm text-gray-500">Live Updates</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            @forelse($recentStudents as $student)
                                <div class="flex items-center space-x-4 p-3 rounded-lg hover:bg-admin-bg/50 transition-colors">
                                    <div class="w-10 h-10 bg-gradient-to-br from-admin-accent to-admin-primary rounded-full flex items-center justify-center text-white font-bold text-sm">
                                        {{ substr($student->full_name, 0, 1) }}
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-admin-primary">{{ $student->full_name }}</p>
                                        <p class="text-xs text-gray-500">Masuk ke kelas {{ $student->classRoom->name ?? 'N/A' }}</p>
                                    </div>
                                    <div class="text-xs text-admin-accent font-medium bg-admin-accent/10 px-2 py-1 rounded-full">
                                        Baru
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 004.5 0z"/>
                                    </svg>
                                    <p class="text-sm text-gray-500">Belum ada siswa baru ditambahkan.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Academic Performance Chart -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-0 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-admin-primary">Rata-rata Nilai per Mapel</h3>
                        <div class="w-8 h-8 bg-admin-accent/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-admin-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="h-80">
                        <canvas id="academicPerformanceChart"></canvas>
                    </div>
                </div>

                <!-- Attendance Rate Chart -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-0 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-admin-primary">Tingkat Kehadiran</h3>
                        <div class="w-8 h-8 bg-admin-accent/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-admin-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="h-80">
                        <canvas id="attendanceRateChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Students Distribution Chart -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-0 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-admin-primary">Distribusi Siswa per Kelas</h3>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-admin-accent/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-admin-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm text-gray-500 font-medium">Overview</span>
                    </div>
                </div>
                <div class="h-80">
                    <canvas id="studentsPerClassChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Chart.js default configuration for admin theme
            Chart.defaults.color = '#2c3e50'; // admin-primary
            Chart.defaults.borderColor = '#ecf0f1'; // admin-bg
            Chart.defaults.backgroundColor = '#3498db'; // admin-accent

            // === CHART 1: DISTRIBUSI SISWA PER KELAS ===
            const ctxStudents = document.getElementById('studentsPerClassChart').getContext('2d');
            const classLabels = @json($classLabels);
            const studentCounts = @json($studentCounts);

            // Create gradient for bar chart
            const gradientBars = ctxStudents.createLinearGradient(0, 0, 0, 300);
            gradientBars.addColorStop(0, '#3498db'); // admin-accent
            gradientBars.addColorStop(1, 'rgba(52, 152, 219, 0.3)');

            new Chart(ctxStudents, {
                type: 'bar',
                data: {
                    labels: classLabels,
                    datasets: [{
                        label: 'Jumlah Siswa',
                        data: studentCounts,
                        backgroundColor: gradientBars,
                        borderColor: '#2c3e50',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                        hoverBackgroundColor: '#2c3e50',
                        hoverBorderColor: '#3498db',
                    }]
                },
                options: {
                    responsive: true, 
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#2c3e50',
                            titleColor: '#FFFFFF',
                            bodyColor: '#FFFFFF',
                            borderColor: '#3498db',
                            borderWidth: 2,
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                title: (context) => `Kelas ${context[0].label}`,
                                label: (context) => `${context.raw} siswa terdaftar`
                            }
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            ticks: { 
                                color: '#2c3e50',
                                font: { weight: '600' }
                            }, 
                            grid: { 
                                color: 'rgba(236, 240, 241, 0.8)',
                                drawBorder: false
                            },
                            border: { display: false }
                        },
                        x: { 
                            ticks: { 
                                color: '#2c3e50',
                                font: { weight: '600' }
                            }, 
                            grid: { display: false },
                            border: { display: false }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });

            // === CHART 2: RATA-RATA NILAI PER MAPEL ===
            const ctxGrades = document.getElementById('academicPerformanceChart').getContext('2d');
            const subjectLabels = @json($subjectLabels);
            const averageScores = @json($averageScores);
            
            const gradientLine = ctxGrades.createLinearGradient(0, 0, 0, 300);
            gradientLine.addColorStop(0, 'rgba(44, 62, 80, 0.8)'); // admin-primary
            gradientLine.addColorStop(1, 'rgba(44, 62, 80, 0.1)');

            new Chart(ctxGrades, {
                type: 'line',
                data: {
                    labels: subjectLabels,
                    datasets: [{
                        label: 'Rata-rata Nilai',
                        data: averageScores,
                        backgroundColor: gradientLine,
                        borderColor: '#2c3e50',
                        borderWidth: 3,
                        fill: true,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: '#2c3e50',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: '#3498db',
                        pointHoverBorderColor: '#2c3e50',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true, 
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#2c3e50',
                            titleColor: '#FFFFFF',
                            bodyColor: '#FFFFFF',
                            borderColor: '#3498db',
                            borderWidth: 2,
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                title: (context) => `${context[0].label}`,
                                label: (context) => `Rata-rata: ${context.raw}/100`
                            }
                        }
                    },
                    scales: {
                        y: { 
                            max: 100,
                            min: 0,
                            ticks: {
                                color: '#2c3e50',
                                font: { weight: '600' },
                                callback: function(value) {
                                    return value + '/100';
                                }
                            },
                            grid: { 
                                color: 'rgba(236, 240, 241, 0.8)',
                                drawBorder: false
                            },
                            border: { display: false }
                        },
                        x: { 
                            ticks: {
                                color: '#2c3e50',
                                font: { weight: '600' }
                            },
                            grid: { display: false },
                            border: { display: false }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });

            // === CHART 3: TINGKAT KEHADIRAN ===
            const ctxAttendance = document.getElementById('attendanceRateChart').getContext('2d');
            new Chart(ctxAttendance, {
                type: 'doughnut',
                data: {
                    labels: @json($attendanceLabels),
                    datasets: [{
                        label: 'Persentase Kehadiran',
                        data: @json($attendancePercentages),
                        backgroundColor: [
                            '#2c3e50',  // admin-primary
                            '#3498db',  // admin-accent
                            '#2ecc71',  // success
                            '#f39c12',  // warning
                            '#e74c3c',  // error
                            'rgba(44, 62, 80, 0.6)',
                            'rgba(52, 152, 219, 0.6)'
                        ],
                        borderColor: '#FFFFFF',
                        borderWidth: 3,
                        hoverOffset: 8,
                        cutout: '60%'
                    }]
                },
                options: {
                    responsive: true, 
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                font: { 
                                    family: "'Figtree', sans-serif",
                                    weight: '600'
                                },
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#2c3e50',
                            titleColor: '#FFFFFF',
                            bodyColor: '#FFFFFF',
                            borderColor: '#3498db',
                            borderWidth: 2,
                            padding: 12,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += `${context.parsed}% Tingkat Kehadiran`;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-admin-layout>