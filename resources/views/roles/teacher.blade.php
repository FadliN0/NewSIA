<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor Guru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 border-b">
                    <h3 class="text-2xl font-semibold">Selamat Datang, {{ $teacher->full_name }}!</h3>
                    <p class="text-gray-600">Ini adalah pusat kendali Anda untuk mengelola aktivitas akademik.</p>
                </div>
                
                <div class="p-6">
                    <h4 class="text-lg font-semibold mb-4">Mata Pelajaran yang Diampu</h4>
                    
                    @if($subjectsTaught->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($subjectsTaught as $subject)
                                <div class="bg-gray-50 p-4 rounded-lg border">
                                    <h5 class="font-bold text-teal-700">{{ $subject->name }}</h5>
                                    <p class="text-sm text-gray-500">Kode: {{ $subject->code }}</p>
                                    
                                    {{-- Tombol aksi akan kita tambahkan di langkah berikutnya --}}
                                    <div class="mt-4">
                                        <a href="{{ route('teacher.attendances.index') }}" class="text-sm font-semibold text-indigo-600 hover:underline">Kelola Absensi &raquo;</a>
                                    </div>
                                    <div class="mt-2">
                                        <a href="#" class="text-sm font-semibold text-indigo-600 hover:underline">Input Nilai &raquo;</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Anda belum ditugaskan untuk mengajar mata pelajaran apapun.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>