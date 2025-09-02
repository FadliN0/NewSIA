<x-teacher-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('teacher.grades.index') }}" class="mr-4 text-gray-500 hover:text-gray-700">&larr; Kembali</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $viewTitle }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('teacher.grades.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <input type="hidden" name="type" value="{{ $type }}">
                    
                    <div class="p-6 border-b">
                        <h3 class="text-lg font-semibold">Semester Aktif: {{ $activeSemester->name }} {{ $activeSemester->school_year }}</h3>
                    </div>

                    <div class="p-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Siswa</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Nilai</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($students as $student)
                                    @php
                                        // Mencegah error 'Call to a member function first() on null'
                                        $studentGradesCollection = $existingGrades->get($student->id);
                                        $studentGrade = optional($studentGradesCollection)->first() ?? null;
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $student->full_name }}</td>
                                        <td class="px-6 py-4">
                                            <input type="number" name="grades[{{ $student->id }}]" value="{{ $studentGrade->score ?? '' }}" class="w-24 text-center form-input rounded-md border-gray-300 shadow-sm" step="0.01" min="0" max="100">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="p-6 bg-gray-50 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                            Simpan Nilai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-teacher-layout>