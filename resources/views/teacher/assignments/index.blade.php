<x-teacher-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Kelola Tugas') }}</h2>
            <a href="{{ route('teacher.assignments.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                + Buat Tugas Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul Tugas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mapel</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tenggat Waktu</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($assignments as $assignment)
                            <tr>
                                <td class="px-6 py-4">{{ $assignment->title }}</td>
                                <td class="px-6 py-4">{{ $assignment->classRoom->name }}</td>
                                <td class="px-6 py-4">{{ $assignment->subject->name }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4 text-right text-sm space-x-2">
                                    <a href="{{ route('teacher.assignments.edit', $assignment) }}" class="text-indigo-600 hover:underline">Edit</a>
                                    <form action="{{ route('teacher.assignments.destroy', $assignment) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus tugas ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                    <a href="{{ route('teacher.assignments.submission', $assignment) }}" class="text-blue-600 hover:underline">Cek Tugas</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-4">Belum ada tugas yang dibuat.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">{{ $assignments->links() }}</div>
            </div>
        </div>
    </div>
</x-teacher-layout>