<x-student-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Tugas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul Tugas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mapel</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tenggat Waktu</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($assignments as $assignment)
                                <tr>
                                    <td class="px-6 py-4">{{ $assignment->title }}</td>
                                    <td class="px-6 py-4">{{ $assignment->subject->name }}</td>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y') }}</td>
                                    <td class="px-6 py-4 text-right">
                                        @if($assignment->submissions->isNotEmpty())
                                            <span class="inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">Sudah Diunggah</span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-red-800">Belum Diunggah</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('student.assignments.show', $assignment) }}" class="text-indigo-600 hover:underline">Lihat Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">Belum ada tugas yang diberikan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
