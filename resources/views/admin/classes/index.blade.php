{{-- resources/views/admin/classes/index.blade.php --}}
<x-admin-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-admin-primary to-admin-accent p-6 rounded-lg shadow-sm">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l4-2 4 2 4-2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-2xl text-white leading-tight">{{ __('Kelola Kelas') }}</h2>
                        <div class="flex items-center space-x-2 mt-1">
                            <span class="text-white/80 text-sm">Total:</span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-white/20 text-white backdrop-blur-sm">
                                {{ $classes->total() }} Kelas
                            </span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.classes.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl font-bold text-sm text-white uppercase tracking-wide hover:bg-white/30 focus:bg-white/30 active:bg-white/40 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-200 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Kelas
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-admin-bg min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-6 bg-gradient-to-r from-success/10 to-success/5 border border-success/20 rounded-xl p-4 shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-8 h-8 bg-success rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-semibold text-success">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-gradient-to-r from-error/10 to-error/5 border border-error/20 rounded-xl p-4 shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-8 h-8 bg-error rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-semibold text-error">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Quick Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Available Classes -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-0 p-6 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-success to-success/80 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Tersedia</p>
                                <p class="text-2xl font-bold text-admin-primary">
                                    {{ $stats['available'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nearly Full -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-0 p-6 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-warning to-warning/80 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.728-.833-2.498 0L4.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Hampir Penuh</p>
                                <p class="text-2xl font-bold text-admin-primary">
                                    {{ $stats['nearly_full'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Full Classes -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-0 p-6 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-error to-error/80 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Kelas Penuh</p>
                                <p class="text-2xl font-bold text-admin-primary">
                                    {{ $stats['full'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Capacity -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border-0 p-6 hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-admin-primary to-admin-accent rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20a3 3 0 01-3-3v-2a3 3 0 013-3h1m0 0a3 3 0 106 0m-3 0a3 3 0 106 0m0 0a3 3 0 013 3v2a3 3 0 01-3 3H7"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Total Kapasitas</p>
                                <p class="text-2xl font-bold text-admin-primary">{{ $stats['total_capacity'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border-0">
                <div class="bg-gradient-to-r from-admin-primary/5 to-admin-accent/5 px-6 py-4 border-b border-admin-primary/10">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                        <!-- Search -->
                        <div class="flex-1 lg:max-w-md">
                            <div class="relative">
                                <input type="text" 
                                       id="searchClasses" 
                                       placeholder="Cari berdasarkan nama kelas..." 
                                       class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-admin-accent/20 focus:border-admin-accent transition-all duration-200">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Filter -->
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <select id="filterGrade" class="pl-10 pr-8 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-admin-accent/20 focus:border-admin-accent transition-all duration-200 appearance-none bg-white">
                                    <option value="">Semua Tingkat</option>
                                    <option value="10">Kelas 10</option>
                                    <option value="11">Kelas 11</option>
                                    <option value="12">Kelas 12</option>
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                    </svg>
                                </div>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Status Filter -->
                            <div class="relative">
                                <select id="filterStatus" class="pl-10 pr-8 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-admin-accent/20 focus:border-admin-accent transition-all duration-200 appearance-none bg-white">
                                    <option value="">Semua Status</option>
                                    <option value="available">Tersedia</option>
                                    <option value="nearly-full">Hampir Penuh</option>
                                    <option value="full">Penuh</option>
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gradient-to-r from-admin-bg to-white">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-admin-primary uppercase tracking-wider">
                                    Kelas
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-admin-primary uppercase tracking-wider">
                                    Tingkat
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-admin-primary uppercase tracking-wider">
                                    Kapasitas
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-admin-primary uppercase tracking-wider">
                                    Terisi
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-admin-primary uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-admin-primary uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-50">
                            @forelse($classes as $class)
                                @php
                                    $percentage = $class->capacity > 0 ? ($class->students_count / $class->capacity) * 100 : 0;
                                    $status = $percentage >= 100 ? 'full' : ($percentage >= 80 ? 'nearly-full' : 'available');
                                @endphp
                                <tr class="hover:bg-gradient-to-r hover:from-admin-bg/30 hover:to-white transition-all duration-200 group" 
                                    data-grade="{{ $class->grade_level }}" 
                                    data-name="{{ strtolower($class->name) }}"
                                    data-status="{{ $status }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-admin-primary to-admin-accent rounded-xl flex items-center justify-center shadow-sm group-hover:shadow-md transition-shadow duration-200">
                                                <span class="text-sm font-bold text-white">{{ substr($class->name, 0, 2) }}</span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-admin-primary">{{ $class->name }}</div>
                                                @if($class->description)
                                                    <div class="text-xs text-gray-500 mt-1">{{ Str::limit($class->description, 40) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-admin-primary to-admin-accent text-white shadow-sm">
                                            Kelas {{ $class->grade_level }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-admin-primary">{{ $class->capacity }}</div>
                                        <div class="text-xs text-gray-500">siswa</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <div class="text-sm font-semibold text-admin-primary">{{ $class->students_count }}</div>
                                            <div class="flex-1">
                                                <div class="w-16 bg-gray-200 rounded-full h-2">
                                                    <div class="h-2 rounded-full transition-all duration-300 
                                                        {{ $percentage >= 100 ? 'bg-error' : ($percentage >= 80 ? 'bg-warning' : 'bg-success') }}"
                                                         style="width: {{ min($percentage, 100) }}%"></div>
                                                </div>
                                            </div>
                                            <div class="text-xs text-gray-500">{{ number_format($percentage, 0) }}%</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($percentage >= 100)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-error/10 text-error border border-error/20">
                                                <div class="w-2 h-2 bg-error rounded-full mr-2"></div>
                                                Penuh
                                            </span>
                                        @elseif($percentage >= 80)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-warning/10 text-warning border border-warning/20">
                                                <div class="w-2 h-2 bg-warning rounded-full mr-2"></div>
                                                Hampir Penuh
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-success/10 text-success border border-success/20">
                                                <div class="w-2 h-2 bg-success rounded-full mr-2"></div>
                                                Tersedia
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end space-x-2">
                                            <!-- View -->
                                            <a href="{{ route('admin.classes.show', $class) }}" 
                                               class="w-8 h-8 bg-admin-primary/10 hover:bg-admin-primary/20 rounded-lg flex items-center justify-center text-admin-primary hover:text-admin-primary/80 transition-all duration-200 group-hover:scale-105"
                                               title="Lihat Detail">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            <!-- Edit -->
                                            <a href="{{ route('admin.classes.edit', $class) }}" 
                                               class="w-8 h-8 bg-admin-accent/10 hover:bg-admin-accent/20 rounded-lg flex items-center justify-center text-admin-accent hover:text-admin-accent/80 transition-all duration-200 group-hover:scale-105"
                                               title="Edit Kelas">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <!-- Delete -->
                                            <form method="POST" 
                                                  action="{{ route('admin.classes.destroy', $class) }}" 
                                                  class="inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas {{ $class->name }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="w-8 h-8 bg-error/10 hover:bg-error/20 rounded-lg flex items-center justify-center text-error hover:text-error/80 transition-all duration-200 group-hover:scale-105 @if($class->students_count > 0) opacity-50 cursor-not-allowed @endif"
                                                        @if($class->students_count > 0) disabled title="Tidak dapat menghapus kelas yang masih memiliki siswa" @else title="Hapus Kelas" @endif>
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr id="empty-state">
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center space-y-4">
                                            <div class="w-20 h-20 bg-gradient-to-br from-admin-primary/10 to-admin-accent/10 rounded-full flex items-center justify-center">
                                                <svg class="w-10 h-10 text-admin-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l4-2 4 2 4-2z"/>
                                                </svg>
                                            </div>
                                            <div class="space-y-2">
                                                <h3 class="text-lg font-bold text-admin-primary">Belum Ada Kelas</h3>
                                                <p class="text-sm text-gray-500 max-w-sm">Mulai dengan menambahkan kelas pertama untuk mengelola siswa di sistem akademik.</p>
                                            </div>
                                            <a href="{{ route('admin.classes.create') }}" 
                                               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-admin-primary to-admin-accent border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-wide hover:from-admin-primary/90 hover:to-admin-accent/90 focus:from-admin-primary/90 focus:to-admin-accent/90 transition-all duration-200 shadow-lg hover:shadow-xl">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Tambah Kelas Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- No Results Found -->
                <div id="no-results" class="hidden px-6 py-16 text-center">
                    <div class="flex flex-col items-center space-y-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-admin-primary/10 to-admin-accent/10 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-admin-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-lg font-bold text-admin-primary">Tidak Ada Hasil</h3>
                            <p class="text-sm text-gray-500">Coba ubah kriteria pencarian atau filter Anda.</p>
                        </div>
                        <button onclick="clearFilters()" 
                                class="text-admin-accent hover:text-admin-accent/80 font-semibold text-sm underline">
                            Bersihkan Filter
                        </button>
                    </div>
                </div>

                <!-- Pagination -->
                @if($classes->hasPages())
                    <div class="bg-gradient-to-r from-admin-bg/30 to-white px-6 py-4 border-t border-gray-100 flex justify-between items-center">
                        <div class="text-sm text-gray-600">
                            Menampilkan <span class="font-semibold text-admin-primary">{{ $classes->firstItem() }}</span> - 
                            <span class="font-semibold text-admin-primary">{{ $classes->lastItem() }}</span> dari 
                            <span class="font-semibold text-admin-primary">{{ $classes->total() }}</span> kelas
                        </div>
                        <div class="custom-pagination">
                            {{ $classes->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchClasses');
            const gradeFilter = document.getElementById('filterGrade');
            const statusFilter = document.getElementById('filterStatus');
            const tableRows = document.querySelectorAll('tbody tr[data-name]');
            const emptyState = document.getElementById('empty-state');
            const noResults = document.getElementById('no-results');

            // Debounce function for search
            function debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedGrade = gradeFilter.value;
                const selectedStatus = statusFilter.value;
                let visibleCount = 0;

                tableRows.forEach(row => {
                    const name = row.getAttribute('data-name');
                    const grade = row.getAttribute('data-grade');
                    const status = row.getAttribute('data-status');
                    
                    const matchesSearch = !searchTerm || name.includes(searchTerm);
                    const matchesGrade = !selectedGrade || grade === selectedGrade;
                    const matchesStatus = !selectedStatus || status === selectedStatus;
                    
                    if (matchesSearch && matchesGrade && matchesStatus) {
                        row.style.display = '';
                        row.style.animation = 'fadeIn 0.3s ease-in';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Handle empty states
                if (emptyState) emptyState.style.display = 'none';
                if (noResults) {
                    noResults.style.display = visibleCount === 0 && tableRows.length > 0 ? 'block' : 'none';
                }

                // Update stats cards based on visible rows
                updateStatsCards(visibleCount);
            }

            function updateStatsCards(visibleCount) {
                // You can implement dynamic stats update here if needed
                console.log(`Showing ${visibleCount} classes`);
            }

            // Clear all filters
            window.clearFilters = function() {
                searchInput.value = '';
                gradeFilter.value = '';
                statusFilter.value = '';
                filterTable();
                searchInput.focus();
            };

            // Event listeners with debouncing for search
            const debouncedFilter = debounce(filterTable, 300);
            searchInput.addEventListener('input', debouncedFilter);
            gradeFilter.addEventListener('change', filterTable);
            statusFilter.addEventListener('change', filterTable);

            // Enhanced form interactions
            const deleteButtons = document.querySelectorAll('button[type="submit"]');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (this.disabled) return;
                    
                    const form = this.closest('form');
                    const className = form.action.split('/').pop();
                    
                    if (!confirm(`Apakah Anda yakin ingin menghapus kelas ini? Tindakan ini tidak dapat dibatalkan.`)) {
                        e.preventDefault();
                    }
                });
            });

            // Add loading state for actions
            const actionLinks = document.querySelectorAll('a[href*="classes"]');
            actionLinks.forEach(link => {
                link.addEventListener('click', function() {
                    this.classList.add('opacity-75', 'pointer-events-none');
                });
            });

            // Auto-refresh functionality (optional)
            let autoRefreshInterval;
            function startAutoRefresh() {
                autoRefreshInterval = setInterval(() => {
                    // Check if user is still active on the page
                    if (document.visibilityState === 'visible') {
                        // You can implement auto-refresh logic here
                        console.log('Auto-refresh check...');
                    }
                }, 30000); // Check every 30 seconds
            }

            // Cleanup
            window.addEventListener('beforeunload', () => {
                if (autoRefreshInterval) {
                    clearInterval(autoRefreshInterval);
                }
            });

            // Initialize
            filterTable();
            // startAutoRefresh(); // Uncomment if you want auto-refresh
        });
    </script>

    <!-- Enhanced Custom Styles -->
    <style>
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { transform: translateX(-10px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        /* Custom Pagination Styles */
        .custom-pagination .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }
        
        .custom-pagination .page-link {
            padding: 0.75rem 1rem;
            color: #2c3e50;
            background: linear-gradient(135deg, #ffffff, #f8fafc);
            border: 2px solid #e2e8f0;
            border-radius: 0.75rem;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .custom-pagination .page-link:hover {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border-color: #3498db;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(52, 152, 219, 0.2);
        }
        
        .custom-pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            border-color: #2c3e50;
            color: white;
            transform: scale(1.05);
        }
        
        .custom-pagination .page-item.disabled .page-link {
            color: #94a3b8;
            background: #f1f5f9;
            border-color: #e2e8f0;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .custom-pagination .page-item.disabled .page-link:hover {
            transform: none;
            background: #f1f5f9;
            color: #94a3b8;
        }

        /* Table enhancements */
        tbody tr {
            transition: all 0.2s ease;
        }

        tbody tr:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* Progress bar animation */
        .progress-bar {
            animation: progressFill 1s ease-out;
        }

        @keyframes progressFill {
            from { width: 0; }
            to { width: var(--progress-width); }
        }

        /* Status badge animations */
        .status-badge {
            animation: slideIn 0.3s ease-out;
        }

        /* Loading states */
        .loading {
            position: relative;
            pointer-events: none;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 16px;
            height: 16px;
            border: 2px solid #f3f4f6;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* Enhanced focus styles */
        input:focus, select:focus {
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
            transform: translateY(-1px);
        }

        /* Responsive design improvements */
        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.875rem;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 0.25rem;
            }
        }

        /* Dark mode support (if needed) */
        @media (prefers-color-scheme: dark) {
            .dark-mode-support {
                /* Add dark mode styles here */
            }
        }
    </style>
</x-admin-layout>