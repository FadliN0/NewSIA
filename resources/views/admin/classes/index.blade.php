{{-- resources/views/admin/classes/index.blade.php --}}
<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-charcoal leading-tight">{{ __('Kelola Kelas') }}</h2>
                <span class="ml-3 px-3 py-1 text-xs bg-pale-green text-teal-dark rounded-full font-medium">{{ $classes->total() }} Kelas</span>
            </div>
            <a href="{{ route('admin.classes.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-lime-accent border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-lime-accent/80 focus:bg-lime-accent/80 active:bg-lime-accent/90 focus:outline-none focus:ring-2 focus:ring-lime-accent/50 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Kelas
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-6 bg-fresh-green/10 border border-fresh-green/20 text-fresh-green px-4 py-3 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-brick-red/10 border border-brick-red/20 text-brick-red px-4 py-3 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Classes Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6">
                    <!-- Search and Filter -->
                    <div class="mb-6 flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" 
                                   id="searchClasses" 
                                   placeholder="Cari kelas..." 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-dark focus:border-teal-dark">
                        </div>
                        <div class="sm:w-48">
                            <select id="filterGrade" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-dark focus:border-teal-dark">
                                <option value="">Semua Tingkat</option>
                                <option value="10">Kelas 10</option>
                                <option value="11">Kelas 11</option>
                                <option value="12">Kelas 12</option>
                            </select>
                        </div>
                    </div>

                    <!-- Responsive Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-pale-green">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase tracking-wider">
                                        Nama Kelas
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase tracking-wider">
                                        Tingkat
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase tracking-wider">
                                        Kapasitas
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase tracking-wider">
                                        Jumlah Siswa
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-teal-dark uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-teal-dark uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($classes as $class)
                                    <tr class="hover:bg-pale-green/30 transition-colors duration-150" data-grade="{{ $class->grade_level }}" data-name="{{ strtolower($class->name) }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10 bg-teal-dark/10 rounded-lg flex items-center justify-center">
                                                    <span class="text-sm font-bold text-teal-dark">{{ substr($class->name, 0, 2) }}</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-charcoal">{{ $class->name }}</div>
                                                    @if($class->description)
                                                        <div class="text-sm text-charcoal/60">{{ Str::limit($class->description, 30) }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-dark/10 text-teal-dark">
                                                Kelas {{ $class->grade_level }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-charcoal">
                                            {{ $class->capacity }} siswa
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-charcoal">
                                            {{ $class->students_count }} siswa
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $percentage = $class->capacity > 0 ? ($class->students_count / $class->capacity) * 100 : 0;
                                            @endphp
                                            @if($percentage >= 100)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brick-red/10 text-brick-red">
                                                    Penuh
                                                </span>
                                            @elseif($percentage >= 80)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-warning-orange/10 text-warning-orange">
                                                    Hampir Penuh
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-fresh-green/10 text-fresh-green">
                                                    Tersedia
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.classes.show', $class) }}" 
                                                   class="text-teal-dark hover:text-teal-dark/80 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </a>
                                                <a href="{{ route('admin.classes.edit', $class) }}" 
                                                   class="text-lime-accent hover:text-lime-accent/80 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </a>
                                                <form method="POST" 
                                                      action="{{ route('admin.classes.destroy', $class) }}" 
                                                      class="inline"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas {{ $class->name }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-brick-red hover:text-brick-red/80 transition-colors"
                                                            @if($class->students_count > 0) disabled title="Tidak dapat menghapus kelas yang masih memiliki siswa" @endif>
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-charcoal/40 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16l4-2 4 2 4-2z"/>
                                                </svg>
                                                <h3 class="text-sm font-medium text-charcoal/60 mb-2">Belum ada kelas</h3>
                                                <p class="text-sm text-charcoal/40 mb-4">Mulai dengan menambahkan kelas pertama Anda.</p>
                                                <a href="{{ route('admin.classes.create') }}" 
                                                   class="inline-flex items-center px-4 py-2 bg-lime-accent border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-lime-accent/80 transition ease-in-out duration-150">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                    </svg>
                                                    Tambah Kelas
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($classes->hasPages())
                        <div class="mt-6 flex justify-between items-center">
                            <div class="text-sm text-charcoal/60">
                                Menampilkan {{ $classes->firstItem() }} - {{ $classes->lastItem() }} dari {{ $classes->total() }} kelas
                            </div>
                            <div class="custom-pagination">
                                {{ $classes->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Stats Cards -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-fresh-green/10 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-fresh-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-charcoal/60">Kelas Tersedia</p>
                            <p class="text-2xl font-bold text-charcoal">
                                {{ $classes->where('students_count', '<', $classes->first()->capacity ?? 30)->count() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-warning-orange/10 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-warning-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.728-.833-2.498 0L4.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-charcoal/60">Hampir Penuh</p>
                            <p class="text-2xl font-bold text-charcoal">
                                {{ $classes->filter(function($class) { 
                                    $percentage = $class->capacity > 0 ? ($class->students_count / $class->capacity) * 100 : 0;
                                    return $percentage >= 80 && $percentage < 100;
                                })->count() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-brick-red/10 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-brick-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-charcoal/60">Kelas Penuh</p>
                            <p class="text-2xl font-bold text-charcoal">
                                {{ $classes->filter(function($class) { 
                                    return $class->students_count >= $class->capacity;
                                })->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchClasses');
            const gradeFilter = document.getElementById('filterGrade');
            const tableRows = document.querySelectorAll('tbody tr[data-name]');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedGrade = gradeFilter.value;

                tableRows.forEach(row => {
                    const name = row.getAttribute('data-name');
                    const grade = row.getAttribute('data-grade');
                    
                    const matchesSearch = name.includes(searchTerm);
                    const matchesGrade = !selectedGrade || grade === selectedGrade;
                    
                    if (matchesSearch && matchesGrade) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Show/hide empty state
                const visibleRows = Array.from(tableRows).filter(row => row.style.display !== 'none');
                if (visibleRows.length === 0 && (searchTerm || selectedGrade)) {
                    // You can add empty state logic here
                    console.log('No results found');
                }
            }

            searchInput.addEventListener('input', filterTable);
            gradeFilter.addEventListener('change', filterTable);
        });
    </script>

    <!-- Custom Pagination Styles -->
    <style>
        .custom-pagination .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.25rem;
        }
        
        .custom-pagination .page-link {
            padding: 0.5rem 0.75rem;
            margin: 0 0.125rem;
            color: #0B666A;
            background-color: #FCFCFC;
            border: 1px solid #EDF5F5;
            border-radius: 0.375rem;
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.15s ease-in-out;
        }
        
        .custom-pagination .page-link:hover {
            background-color: #EDF5F5;
            color: #0B666A;
        }
        
        .custom-pagination .page-item.active .page-link {
            background-color: #97BE5A;
            border-color: #97BE5A;
            color: white;
        }
        
        .custom-pagination .page-item.disabled .page-link {
            color: #3D3D3D;
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
</x-admin-layout>