<x-teacher-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('teacher.attendances.index') }}" class="mr-4 text-gray-500 hover:text-gray-700">
                &larr; Kembali
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Input Absensi: {{ $assignment->subject->name }} - Kelas {{ $assignment->classRoom->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('teacher.attendances.store') }}" method="POST">
                    @csrf
                    <div class="p-6 border-b">
                        <h3 class="text-lg font-semibold">Absensi Tanggal: {{ \Carbon\Carbon::parse($today)->translatedFormat('l, d F Y') }}</h3>
                        <input type="hidden" name="attendance_date" value="{{ $today }}">
                        <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
                    </div>

                    <div class="p-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Siswa</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($students as $student)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $student->full_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex justify-center space-x-2 md:space-x-4">
                                            @foreach(['Hadir', 'Izin', 'Sakit', 'Alfa'] as $status)
                                            <div class="flex items-center">
                                                <input type="radio" name="attendances[{{ $student->id }}]" id="status_{{ $student->id }}_{{ $status }}" value="{{ $status }}" class="form-radio h-4 w-4 text-indigo-600" {{ $loop->first ? 'checked' : '' }}>
                                                <label for="status_{{ $student->id }}_{{ $status }}" class="ml-2">{{ $status }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="p-6 bg-gray-50 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Simpan Absensi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-teacher-layout>