<x-student-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Materi Pelajaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mapel</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Guru</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diunggah pada</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($materials as $material)
                            <tr>
                                <td class="px-6 py-4">{{ $material->title }}</td>
                                <td class="px-6 py-4">{{ $material->subject->name }}</td>
                                <td class="px-6 py-4">{{ $material->teacher->full_name }}</td>
                                <td class="px-6 py-4">{{ $material->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-right text-sm space-x-2">
                                    <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="text-blue-600 hover:underline">Unduh</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-4">Tidak ada materi pelajaran yang tersedia.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">{{ $materials->links() }}</div>
            </div>
        </div>
    </div>
</x-student-layout>