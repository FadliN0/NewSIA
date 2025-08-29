<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-charcoal leading-tight">{{ __('Penugasan Mengajar') }}</h2>
            <a href="{{ route('admin.assignments.create') }}" class="px-4 py-2 bg-lime-accent text-black rounded-lg">
                + Tugaskan Guru ke Kelas
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('partials.session-messages')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-pale-green">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase">Guru</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase">Mata Pelajaran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase">Kelas</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-teal-dark uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($assignments as $assignment)
                            <tr>
                                <td class="px-6 py-4">{{ $assignment->teacher->full_name ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $assignment->subject->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $assignment->classRoom->name ?? 'Belum Ditentukan' }}</td>
                                <td class="px-6 py-4 text-right">
                                     <form action="{{ route('admin.assignments.destroy', $assignment->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus penugasan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-brick-red hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center py-4">Belum ada data penugasan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">{{ $assignments->links() }}</div>
            </div>
        </div>
    </div>
</x-admin-layout>