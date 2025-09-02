<x-teacher-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Nilai Siswa') }}
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
                <h3 class="text-xl font-semibold mb-4">Pilih Jenis Nilai</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('teacher.assignments.index') }}" class="block p-4 bg-blue-50 hover:bg-blue-100 rounded-lg border border-blue-200 transition">
                        <p class="font-semibold text-blue-800">Input Nilai Tugas</p>
                        <span class="text-sm text-gray-600">Pilih tugas yang sudah dibuat &raquo;</span>
                    </a>
                    @foreach($teacherSubjects as $className => $assignments)
                        <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                            <h4 class="font-bold text-lg text-gray-700 border-b pb-2 mb-3">Kelas: {{ $className }}</h4>
                            @foreach($assignments as $assignment)
                                <a href="{{ route('teacher.grades.create', ['type' => 'UTS', 'id' => $assignment->id]) }}" class="block mt-2 p-2 bg-green-100 hover:bg-green-200 rounded transition">
                                    <p class="font-semibold text-green-800">Input Nilai UTS</p>
                                    <span class="text-sm text-gray-600">Untuk {{ $assignment->subject->name }} &raquo;</span>
                                </a>
                                <a href="{{ route('teacher.grades.create', ['type' => 'UAS', 'id' => $assignment->id]) }}" class="block mt-2 p-2 bg-green-100 hover:bg-green-200 rounded transition">
                                    <p class="font-semibold text-green-800">Input Nilai UAS</p>
                                    <span class="text-sm text-gray-600">Untuk {{ $assignment->subject->name }} &raquo;</span>
                                </a>

                                <a href="{{ route('teacher.grades.create', ['type' => 'tugas', 'id' => $assignment->id]) }}" class="text-indigo-600 hover:underline">Input Nilai</a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>