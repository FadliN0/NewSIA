<x-student-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rapor Online') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold">Tabel Nilai</h3>
                    <form method="GET" action="{{ route('student.grades.index') }}">
                        <select name="semester" onchange="this.form.submit()" class="rounded-md border-gray-300 shadow-sm">
                            @foreach($semesters as $semester)
                                <option value="{{ $semester->id }}" {{ $selectedSemesterId == $semester->id ? 'selected' : '' }}>
                                    {{ $semester->name }} {{ $semester->school_year }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mata Pelajaran</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Tugas</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">UTS</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">UAS</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Kehadiran</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Nilai Akhir</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($gradesBySubject as $subjectName => $data)
                                <tr>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $subjectName }}</td>
                                    <td class="px-6 py-4 text-center">{{ number_format($data['tugas'], 2) }}</td>
                                    <td class="px-6 py-4 text-center">{{ number_format($data['uts'], 2) }}</td>
                                    <td class="px-6 py-4 text-center">{{ number_format($data['uas'], 2) }}</td>
                                    <td class="px-6 py-4 text-center">{{ number_format($data['attendance']) }}</td>
                                    <td class="px-6 py-4 text-center font-bold {{ $data['final_grade'] < 75 ? 'text-red-500' : 'text-green-600' }}">
                                        {{ $data['final_grade'] }}
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center py-4">Tidak ada nilai yang tersedia untuk semester ini.</td></tr>
                            @endforelse
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-right font-bold text-gray-900">Nilai Akhir Rata-rata</td>
                                <td class="px-6 py-4 text-center font-bold text-lg {{ $averageFinalGrade < 75 ? 'text-red-500' : 'text-green-600' }}">
                                    {{ number_format($averageFinalGrade, 2) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
