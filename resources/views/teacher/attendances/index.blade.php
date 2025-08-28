<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Absensi Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">Pilih Kelas dan Mata Pelajaran</h3>
                    
                    @forelse($classAssignments as $className => $assignments)
                        <div class="mb-6">
                            <h4 class="font-bold text-lg text-gray-700 border-b pb-2 mb-3">Kelas: {{ $className }}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($assignments as $assignment)
                                    <a href="#" class="block p-4 bg-teal-50 hover:bg-teal-100 rounded-lg border border-teal-200 transition">
                                        <p class="font-semibold text-teal-800">{{ $assignment->subject->name }}</p>
                                        <span class="text-sm text-gray-600">Pilih untuk input absensi &raquo;</span>
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
</x-app-layout>