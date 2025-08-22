{{-- resources/views/roles/admin.blade.php --}}
<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-charcoal leading-tight">{{ __('Admin_Dashboard') }}</h2>
                <span class="ml-3 px-3 py-1 text-xs bg-pale-green text-teal-custom rounded-full font-medium">SMA Academic System</span>
            </div>
            <div class="text-sm text-gray-600">
                Selamat datang, <span class="font-medium text-teal-custom">{{ Auth::user()->name ?? 'Admin' }}</span>
            </div>
        </div>
    </x-slot>

    <!-- Main Dashboard Content -->
    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Quick Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Total Students -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-lime-custom/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-lime-custom" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 004.5 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Siswa</p>
                                <p class="text-2xl font-bold text-charcoal">{{ $totalStudents ?? '90' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Teachers -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-teal-custom/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-teal-custom" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Guru</p>
                                <p class="text-2xl font-bold text-charcoal">{{ $totalTeachers ?? '10' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Classes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-fresh-green/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-fresh-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16l4-2 4 2 4-2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Kelas</p>
                                <p class="text-2xl font-bold text-charcoal">{{ $totalClasses ?? '9' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Subjects -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-warning-orange/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-warning-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Mata Pelajaran</p>
                                <p class="text-2xl font-bold text-charcoal">{{ $totalSubjects ?? '10' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts and Management Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Academic Performance Chart -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-charcoal mb-4">Performa Akademik per Kelas</h3>
                            <div class="h-80">
                                <canvas id="academicPerformanceChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="space-y-4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-charcoal mb-4">Aksi Cepat</h3>
                            <div class="space-y-3">
                                <a href="{{ route('admin.classes.create') ?? '#' }}" 
                                   class="w-full flex items-center justify-between p-3 bg-pale-green hover:bg-lime-custom/10 rounded-lg transition-colors duration-200 group">
                                    <span class="text-sm font-medium text-teal-custom">Tambah Kelas Baru</span>
                                    <svg class="w-4 h-4 text-teal-custom group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>

                                <a href="{{ route('admin.students.create') ?? '#' }}" 
                                   class="w-full flex items-center justify-between p-3 bg-pale-green hover:bg-lime-custom/10 rounded-lg transition-colors duration-200 group">
                                    <span class="text-sm font-medium text-teal-custom">Tambah Siswa Baru</span>
                                    <svg class="w-4 h-4 text-teal-custom group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>

                                <a href="{{ route('admin.teachers.create') ?? '#' }}" 
                                   class="w-full flex items-center justify-between p-3 bg-pale-green hover:bg-lime-custom/10 rounded-lg transition-colors duration-200 group">
                                    <span class="text-sm font-medium text-teal-custom">Tambah Guru Baru</span>
                                    <svg class="w-4 h-4 text-teal-custom group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>

                                <a href="{{ route('admin.subjects.create') ?? '#' }}" 
                                   class="w-full flex items-center justify-between p-3 bg-pale-green hover:bg-lime-custom/10 rounded-lg transition-colors duration-200 group">
                                    <span class="text-sm font-medium text-teal-custom">Tambah Mata Pelajaran</span>
                                    <svg class="w-4 h-4 text-teal-custom group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-charcoal mb-4">Aktivitas Terbaru</h3>
                            <div class="space-y-3">
                                <div class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-fresh-green rounded-full mt-2"></div>
                                    <div>
                                        <p class="text-sm text-charcoal">10 siswa baru ditambahkan ke kelas 10A</p>
                                        <p class="text-xs text-gray-500">2 jam yang lalu</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-lime-custom rounded-full mt-2"></div>
                                    <div>
                                        <p class="text-sm text-charcoal">Guru Matematika menambah tugas baru</p>
                                        <p class="text-xs text-gray-500">4 jam yang lalu</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-teal-custom rounded-full mt-2"></div>
                                    <div>
                                        <p class="text-sm text-charcoal">Rapot semester 1 telah digenerate</p>
                                        <p class="text-xs text-gray-500">1 hari yang lalu</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Academic Performance Chart
            const ctx = document.getElementById('academicPerformanceChart').getContext('2d');
            
            const academicChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['10A', '10B', '10C', '11A', '11B', '11C', '12A', '12B', '12C'],
                    datasets: [{
                        label: 'Rata-rata Nilai',
                        data: [85, 78, 82, 88, 75, 80, 90, 85, 87],
                        backgroundColor: '#97BE5A', // lime-custom
                        borderColor: '#0B666A',     // teal-custom
                        borderWidth: 1,
                        borderRadius: 4,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#0B666A',
                            titleColor: '#FCFCFC',
                            bodyColor: '#FCFCFC',
                            borderColor: '#97BE5A',
                            borderWidth: 1
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                color: '#3D3D3D',
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                color: '#EDF5F5'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#3D3D3D',
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-admin-layout>