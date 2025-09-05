<x-teacher-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('teacher.assignments.index') }}" class="mr-4 text-gray-500 hover:text-gray-700">&larr; Kembali</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Penilaian Tugas:') }} {{ $assignment->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('teacher.assignments.storeGrades', $assignment) }}" method="POST">
                    @csrf
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Siswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unggahan</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($submissions as $submission)
                                @php
                                    $existingGrade = $existingGrades->get($submission->student->id);
                                @endphp
                                <tr>
                                    <td class="px-6 py-4">{{ $submission->student->full_name }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="text-blue-600 hover:underline">
                                            {{ $submission->file_name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="number" name="grades[{{ $submission->student->id }}]" value="{{ optional($existingGrade)->score ?? '' }}" class="w-24 text-center form-input rounded-md border-gray-300 shadow-sm" step="0.01" min="0" max="100">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">Belum ada tugas yang diunggah.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Simpan Nilai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-teacher-layout>