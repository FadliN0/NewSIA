<x-teacher-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Materi Pelajaran') }}
            </h2>
            <a href="{{ route('teacher.materials.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">
                + Unggah Materi Baru
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mapel</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama File</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($materials as $material)
                            <tr>
                                <td class="px-6 py-4">{{ $material->title }}</td>
                                <td class="px-6 py-4">{{ $material->classRoom->name }}</td>
                                <td class="px-6 py-4">{{ $material->subject->name }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ Storage::url($material->file_path) }}" class="text-blue-600 hover:underline" target="_blank">{{ $material->file_name }}</a>
                                </td>
                                <td class="px-6 py-4 text-right text-sm space-x-2">
                                    <form action="{{ route('teacher.materials.destroy', $material) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus materi ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-4">Belum ada materi pelajaran yang diunggah.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">{{ $materials->links() }}</div>
            </div>
        </div>
    </div>
</x-teacher-layout>