<x-student-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <x-dashboard-card title="Mata Pelajaran Diambil" value="{{ $subjectCount }}" />
                        <x-dashboard-card title="Rata-rata Nilai" value="{{ number_format($averageGrade, 2) }}" />
                        <x-dashboard-card title="Tingkat Kehadiran" value="{{ number_format($attendancePercentage, 0) }}%" />
                    </div>

                    <!-- Tugas Mendatang -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-8">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Tugas yang Akan Datang</h3>
                        @forelse($upcomingAssignments as $assignment)
                            <div class="flex items-center justify-between border-b last:border-b-0 py-2">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $assignment->title }}</p>
                                    <p class="text-sm text-gray-500">{{ $assignment->subject->name }}</p>
                                </div>
                                <p class="text-sm text-gray-500">
                                    Tenggat: {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y') }}
                                </p>
                            </div>
                        @empty
                            <p class="text-gray-500">Tidak ada tugas yang akan datang.</p>
                        @endforelse
                    </div>

                    <!-- Grafik Performa (Chart.js) -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">Rata-rata Nilai Semester Ini</h3>
                        <canvas id="gradeChart"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const subjectGrades = @json($subjectGrades);
                const labels = subjectGrades.map(item => item.subject.name);
                const data = subjectGrades.map(item => item.average_score);

                const ctx = document.getElementById('gradeChart');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Rata-rata Nilai',
                            data: data,
                            backgroundColor: 'rgba(59, 130, 246, 0.5)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
</x-student-layout>
