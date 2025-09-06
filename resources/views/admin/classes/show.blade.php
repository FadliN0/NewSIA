<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Kelas: ') . $class->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-6">
                        <a href="{{ route('admin.classes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali ke Daftar Kelas
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg shadow">
                            <div class="font-bold text-lg">{{ $stats['total_students'] }} Siswa</div>
                            <div class="text-sm">Total Siswa Terdaftar</div>
                        </div>
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow">
                            <div class="font-bold text-lg">{{ $stats['capacity_used'] }}%</div>
                            <div class="text-sm">Kapasitas Terpakai</div>
                        </div>
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow">
                            <div class="font-bold text-lg">{{ $stats['available_seats'] }} Kursi</div>
                            <div class="text-sm">Sisa Kursi Tersedia</div>
                        </div>
                    </div>

                    <div class="mb-6 border-t pt-4">
                        <h3 class="text-lg font-semibold mb-4">Informasi Kelas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <p><strong>Nama Kelas:</strong> {{ $class->name }}</p>
                            <p><strong>Tingkat:</strong> {{ $class->grade_level }}</p>
                            <p><strong>Kapasitas Maksimal:</strong> {{ $class->max_students ?? $class->capacity }} Siswa</p>
                            <p><strong>Deskripsi:</strong> {{ $class->description ?? 'Tidak ada deskripsi' }}</p>
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <h3 class="text-lg font-semibold mb-4">Daftar Siswa</h3>
                        @if($class->students->isEmpty())
                            <p class="text-gray-500">Belum ada siswa di kelas ini.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($class->students as $student)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $student->full_name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $student->nis }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($student->gender) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>