<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-charcoal leading-tight">{{ __('Kelola Mata Pelajaran') }}</h2>
            <a href="{{ route('admin.subjects.create') }}" class="px-4 py-2 bg-lime-accent text-white rounded-lg">
                Tambah Mata Pelajaran
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('partials.session-messages')

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-pale-green">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase tracking-wider">Nama Mapel</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase tracking-wider">Kode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase tracking-wider">Guru Pengampu</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-teal-dark uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($subjects as $subject)
                                    <tr class="hover:bg-pale-green/30">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-charcoal">{{ $subject->name }}</div>
                                            <div class="text-sm text-charcoal/60">{{ Str::limit($subject->description, 50) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-charcoal">{{ $subject->code }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-charcoal">
                                            @if($subject->teachers->isNotEmpty())
                                                {{ $subject->teachers->pluck('full_name')->join(', ') }}
                                            @else
                                                <span class="text-charcoal/60">Belum ditugaskan</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.subjects.edit', $subject) }}" class="text-lime-accent hover:text-lime-accent/80">Edit</a>
                                                <form method="POST" action="{{ route('admin.subjects.destroy', $subject) }}" onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-brick-red hover:text-brick-red/80">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-sm text-charcoal/60">
                                            Belum ada data mata pelajaran.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">{{ $subjects->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>