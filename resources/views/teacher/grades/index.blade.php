<x-teacher-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rekap Nilai Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @forelse($gradesData as $data)
                    <div class="mb-6 border rounded-lg">
                        <details>
                            <summary class="cursor-pointer p-4 hover:bg-gray-50 flex justify-between items-center">
                                <h4 class="font-bold text-lg text-gray-700">
                                    Kelas: {{ $data['class_room_name'] }} - Mata Pelajaran: {{ $data['subject_name'] }}
                                </h4>
                                <span class="text-gray-500 hover:text-gray-900">
                                    &raquo;
                                </span>
                            </summary>
                            
                            <div class="p-4 border-t bg-gray-50">
                                <h5 class="font-semibold text-gray-800 mb-2">Rekap Nilai Siswa</h5>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Siswa</th>
                                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Rata-rata Tugas</th>
                                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">UTS</th>
                                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">UAS</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($data['students'] as $student)
                                                <tr>
                                                    <td class="px-6 py-4">{{ $student['full_name'] }}</td>
                                                    <td class="px-6 py-4 text-center">{{ $student['average_task_grade'] }}</td>
                                                    <td class="px-6 py-4 text-center">{{ $student['uts_grade'] }}</td>
                                                    <td class="px-6 py-4 text-center">{{ $student['uas_grade'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="p-4 border-t bg-gray-50 flex justify-end space-x-2">
                                <a href="{{ route('teacher.grades.create', ['type' => 'UTS', 'id' => $data['teacher_subject_id']]) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                                    Input Nilai UTS
                                </a>
                                <a href="{{ route('teacher.grades.create', ['type' => 'UAS', 'id' => $data['teacher_subject_id']]) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                                    Input Nilai UAS
                                </a>
                            </div>
                        </details>
                    </div>
                @empty
                    <p class="text-gray-500">Anda belum ditugaskan untuk mengajar di kelas manapun di semester aktif ini.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-teacher-layout>