<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-charcoal leading-tight">{{ __('Kelola Semester') }}</h2>
            <a href="{{ route('admin.semesters.create') }}" class="px-4 py-2 bg-lime-accent text-white rounded-lg">
                Tambah Semester
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('partials.session-messages')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-pale-green">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase">Nama Semester</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase">Tahun Ajaran</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase">Periode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-teal-dark uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($semesters as $semester)
                                <tr>
                                    <td class="px-6 py-4">{{ $semester->name }}</td>
                                    <td class="px-6 py-4">{{ $semester->school_year }}</td>
                                    <td class="px-6 py-4">{{ $semester->start_date->format('d M Y') }} - {{ $semester->end_date->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        @if($semester->is_active)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Non-Aktif</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('admin.semesters.edit', $semester) }}" class="text-lime-accent hover:underline">Edit</a>
                                        <form action="{{ route('admin.semesters.destroy', $semester) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Yakin ingin menghapus semester ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-brick-red hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center py-4">Belum ada data semester.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $semesters->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>