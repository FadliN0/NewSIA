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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">Pilih Kelas dan Mata Pelajaran</h3>
                    
                    @forelse($classAssignments as $className => $assignments)
                        <div class="mb-6">
                            <h4 class="font-bold text-lg text-gray-700 border-b pb-2 mb-3">Kelas: {{ $className }}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($assignments as $assignment)
                                    <a href="{{ route('teacher.grades.create', ['assignment_id' => $assignment->id]) }}" class="block p-4 bg-lime-50 hover:bg-lime-100 rounded-lg border border-lime-200 transition">
                                        <p class="font-semibold text-lime-800">{{ $assignment->subject->name }}</p>
                                        <span class="text-sm text-gray-600">Pilih untuk input nilai &raquo;</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Anda belum ditugaskan untuk mengajar di kelas manapun.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>