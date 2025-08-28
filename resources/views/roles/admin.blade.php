{{-- resources/views/roles/admin.blade.php --}}
<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-charcoal leading-tight">{{ __('Admin Dashboard') }}</h2>
                <span class="ml-3 px-3 py-1 text-xs bg-pale-green text-teal-custom rounded-full font-medium">SMA Academic System</span>
            </div>
            <div class="text-sm text-gray-600">
                Selamat datang, <span class="font-medium text-teal-custom">{{ Auth::user()->name ?? 'Admin' }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-lime-custom/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-lime-custom" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 004.5 0z"/></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Siswa</p>
                            <p class="text-2xl font-bold text-charcoal">{{ $totalStudents }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-6">
                     <div class="flex items-center">
                        <div class="w-10 h-10 bg-teal-custom/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-teal-custom" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Guru</p>
                            <p class="text-2xl font-bold text-charcoal">{{ $totalTeachers }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-fresh-green/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-fresh-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16l4-2 4 2 4-2z"/></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Kelas</p>
                            <p class="text-2xl font-bold text-charcoal">{{ $totalclass_room }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-warning-orange/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-warning-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Mata Pelajaran</p>
                            <p class="text-2xl font-bold text-charcoal">{{ $totalSubjects }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="lg:col-span-2 space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
                        <div class="md:col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-charcoal mb-4">Rata-rata Nilai per Mapel</h3>
                            <div class="h-80"><canvas id="academicPerformanceChart"></canvas></div>
                        </div>
                        <div class="md:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-6">
                             <h3 class="text-lg font-semibold text-charcoal mb-4">Tingkat Kehadiran</h3>
                            <div class="h-80"><canvas id="attendanceRateChart"></canvas></div>
                        </div>
                    </div>
                     <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-charcoal mb-4">Distribusi Siswa per Kelas</h3>
                        <div class="h-64"><canvas id="studentsPerClassChart"></canvas></div>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-charcoal mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('admin.students.create') }}" class="w-full flex items-center justify-between p-3 bg-pale-green hover:bg-lime-custom/10 rounded-lg transition-colors duration-200 group"><span class="text-sm font-medium text-teal-custom">Tambah Siswa Baru</span><svg class="w-4 h-4 text-teal-custom group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
                        <a href="{{ route('admin.teachers.create') }}" class="w-full flex items-center justify-between p-3 bg-pale-green hover:bg-lime-custom/10 rounded-lg transition-colors duration-200 group"><span class="text-sm font-medium text-teal-custom">Tambah Guru Baru</span><svg class="w-4 h-4 text-teal-custom group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
                        <a href="{{ route('admin.classes.create') }}" class="w-full flex items-center justify-between p-3 bg-pale-green hover:bg-lime-custom/10 rounded-lg transition-colors duration-200 group"><span class="text-sm font-medium text-teal-custom">Tambah Kelas Baru</span><svg class="w-4 h-4 text-teal-custom group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
                        <a href="{{ route('admin.subjects.create') }}" class="w-full flex items-center justify-between p-3 bg-pale-green hover:bg-lime-custom/10 rounded-lg transition-colors duration-200 group"><span class="text-sm font-medium text-teal-custom">Tambah Mata Pelajaran</span><svg class="w-4 h-4 text-teal-custom group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-charcoal mb-4">Siswa Baru Ditambahkan</h3>
                    <div class="space-y-4">
                        @forelse($recentStudents as $student)
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-lime-custom rounded-full mt-1 flex-shrink-0"></div>
                                <div>
                                    <p class="text-sm text-charcoal font-medium">{{ $student->full_name }}</p>
                                    <p class="text-xs text-gray-500">Masuk ke kelas {{ $student->classRoom->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Belum ada siswa baru.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // === CHART 1: JUMLAH SISWA PER KELAS ===
            const ctxStudents = document.getElementById('studentsPerClassChart').getContext('2d');
            const classLabels = @json($classLabels);
            const studentCounts = @json($studentCounts);

            new Chart(ctxStudents, {
                type: 'bar',
                data: {
                    labels: classLabels,
                    datasets: [{
                        label: 'Jumlah Siswa',
                        data: studentCounts,
                        backgroundColor: '#97BE5A',
                        borderColor: '#0B666A',
                        borderWidth: 1,
                        borderRadius: 4,
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0B666A', titleColor: '#FCFCFC', bodyColor: '#FCFCFC',
                            borderColor: '#97BE5A', borderWidth: 1, padding: 10,
                            callbacks: {
                                title: (context) => `Kelas ${context[0].label}`,
                                label: (context) => `${context.raw} siswa`
                            }
                        }
                    },
                    scales: {
                        y: { beginAtZero: true, ticks: { color: '#3D3D3D' }, grid: { color: '#EDF5F5' } },
                        x: { ticks: { color: '#3D3D3D' }, grid: { display: false } }
                    }
                }
            });

            // === CHART 2: RATA-RATA NILAI PER MAPEL ===
            const ctxGrades = document.getElementById('academicPerformanceChart').getContext('2d');
            const subjectLabels = @json($subjectLabels);
            const averageScores = @json($averageScores);
            
            const gradient = ctxGrades.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(11, 102, 106, 0.7)'); // Teal
            gradient.addColorStop(1, 'rgba(11, 102, 106, 0.1)'); // Teal transparan

            new Chart(ctxGrades, {
                type: 'line',
                data: {
                    labels: subjectLabels,
                    datasets: [{
                        label: 'Rata-rata Nilai',
                        data: averageScores,
                        backgroundColor: gradient,
                        borderColor: '#0B666A',
                        borderWidth: 2,
                        fill: true,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: '#0B666A',
                        pointHoverRadius: 7,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0B666A', titleColor: '#FCFCFC', bodyColor: '#FCFCFC',
                            borderColor: '#97BE5A', borderWidth: 1, padding: 10,
                            callbacks: {
                                title: (context) => `${context[0].label}`,
                                label: (context) => `Rata-rata: ${context.raw}`
                            }
                        }
                    },
                    scales: {
                        y: { max: 100, grid: { color: '#EDF5F5' } },
                        x: { grid: { display: false } }
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
                            'rgba(11, 102, 106, 0.8)',  // Teal
                            'rgba(151, 190, 90, 0.8)', // Lime
                            'rgba(255, 180, 0, 0.8)',  // Orange Warning
                            'rgba(61, 61, 61, 0.8)',    // Charcoal
                            'rgba(11, 102, 106, 0.5)',
                            'rgba(151, 190, 90, 0.5)'
                        ],
                        borderColor: '#FFFFFF',
                        borderWidth: 2,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                font: { family: "'Figtree', sans-serif" }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += `${context.parsed}% Hadir`;
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