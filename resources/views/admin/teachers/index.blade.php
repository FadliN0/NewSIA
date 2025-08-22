<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-charcoal leading-tight">{{ __('Kelola Guru') }}</h2>
                <span class="ml-3 px-3 py-1 text-xs bg-pale-green text-teal-dark rounded-full font-medium">{{ $teachers->total() }} Guru</span>
            </div>
            <a href="{{ route('admin.teachers.create') }}"
               class="inline-flex items-center px-4 py-2 bg-lime-accent border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-lime-accent/80 focus:bg-lime-accent/80 active:bg-lime-accent/90 focus:outline-none focus:ring-2 focus:ring-lime-accent/50 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Guru
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-fresh-green/10 border border-fresh-green/20 text-fresh-green px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-brick-red/10 border border-brick-red/20 text-brick-red px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6">
                    <form method="GET" action="{{ route('admin.teachers.index') }}" class="mb-6">
                        <div class="flex items-center">
                            <input type="text" name="search" placeholder="Cari nama atau NIP..." value="{{ request('search') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-dark focus:border-teal-dark">
                            <button type="submit" class="ml-2 px-4 py-2 bg-teal-dark text-white rounded-lg">Cari</button>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-pale-green">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase tracking-wider">Nama / NIP</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase tracking-wider">Telepon</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase tracking-wider">Pendidikan Terakhir</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-teal-dark uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($teachers as $teacher)
                                    <tr class="hover:bg-pale-green/30">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-charcoal">{{ $teacher->full_name }}</div>
                                            <div class="text-sm text-charcoal/60">NIP: {{ $teacher->nip }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-charcoal">{{ $teacher->user->email ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-charcoal">{{ $teacher->phone ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-charcoal">{{ $teacher->education_level ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.teachers.edit', $teacher) }}" class="text-lime-accent hover:text-lime-accent/80">Edit</a>
                                                <form method="POST" action="{{ route('admin.teachers.destroy', $teacher) }}" onsubmit="return confirm('Yakin ingin menghapus guru ini? Tindakan ini tidak dapat diurungkan.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-brick-red hover:text-brick-red/80">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-sm text-charcoal/60">
                                            Belum ada data guru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6">
                        {{ $teachers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>