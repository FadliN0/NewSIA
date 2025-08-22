<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-charcoal leading-tight">{{ __('Kelola Siswa') }}</h2>
                <span class="ml-3 px-3 py-1 text-xs bg-pale-green text-teal-dark rounded-full font-medium">{{ $students->total() }} Siswa</span>
            </div>
            <a href="{{ route('admin.students.create') }}"
               class="inline-flex items-center px-4 py-2 bg-lime-accent border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-lime-accent/80 focus:bg-lime-accent/80 active:bg-lime-accent/90 focus:outline-none focus:ring-2 focus:ring-lime-accent/50 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Siswa
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('partials.session-messages')

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6">
                    <form method="GET" action="{{ route('admin.students.index') }}" class="mb-6">
                        <div class="flex items-center">
                            <input type="text" name="search" placeholder="Cari nama, NIS, atau NISN..." value="{{ request('search') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-dark focus:border-teal-dark">
                            <button type="submit" class="ml-2 px-4 py-2 bg-teal-dark text-white rounded-lg">Cari</button>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-pale-green">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase tracking-wider">Nama / NIS</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase tracking-wider">Kelas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase tracking-wider">Tahun Masuk</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-teal-dark uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($students as $student)
                                    <tr class="hover:bg-pale-green/30">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-charcoal">{{ $student->full_name }}</div>
                                            <div class="text-sm text-charcoal/60">NIS: {{ $student->nis }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-charcoal">{{ $student->user->email ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                           <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-dark/10 text-teal-dark">
                                                {{ $student->classRoom->name ?? 'Belum ada kelas' }}
                                           </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-charcoal">{{ $student->entry_year }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.students.edit', $student) }}" class="text-lime-accent hover:text-lime-accent/80">Edit</a>
                                                <form method="POST" action="{{ route('admin.students.destroy', $student) }}" onsubmit="return confirm('Yakin ingin menghapus siswa ini? Tindakan ini tidak dapat diurungkan.');">
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
                                            Belum ada data siswa.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6">
                        {{ $students->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>