<x-student-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="font-bold text-3xl text-charcoal leading-tight">
                    📋 Riwayat Absensi
                </h1>
                <p class="text-gray-600 mt-1">Pantau kehadiran dan presensi Anda di setiap mata pelajaran</p>
            </div>
            
            <!-- Export Button -->
            <div class="flex items-center space-x-3">
                <button class="bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-xl font-medium text-sm transition-colors flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Export PDF</span>
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8 space-y-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if($recap->isNotEmpty())
                <!-- Summary Cards -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    @php
                        $totalHadir = $recap->sum('Hadir');
                        $totalSakit = $recap->sum('Sakit');
                        $totalIzin = $recap->sum('Izin');
                        $totalAlpha = $recap->sum('Alpha');
                        $totalKeseluruhan = $totalHadir + $totalSakit + $totalIzin + $totalAlpha;
                        $persentaseHadir = $totalKeseluruhan > 0 ? ($totalHadir / $totalKeseluruhan) * 100 : 0;
                    @endphp

                    <!-- Total Hadir -->
                    <div class="bg-gradient-to-br from-success to-success/80 p-6 rounded-2xl text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-success/80 text-sm font-medium opacity-90">Hadir</p>
                                <p class="text-3xl font-bold mt-1">{{ $totalHadir }}</p>
                                <p class="text-xs opacity-75 mt-1">{{ number_format($persentaseHadir, 1) }}%</p>
                            </div>
                            <div class="bg-white/20 p-3 rounded-xl">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Sakit -->
                    <div class="bg-gradient-to-br from-blue-500 to-blue-400 p-6 rounded-2xl text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-300 text-sm font-medium opacity-90">Sakit</p>
                                <p class="text-3xl font-bold mt-1">{{ $totalSakit }}</p>
                                <p class="text-xs opacity-75 mt-1">{{ $totalKeseluruhan > 0 ? number_format(($totalSakit / $totalKeseluruhan) * 100, 1) : 0 }}%</p>
                            </div>
                            <div class="bg-white/20 p-3 rounded-xl">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Izin -->
                    <div class="bg-gradient-to-br from-warning to-warning/80 p-6 rounded-2xl text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-warning/80 text-sm font-medium opacity-90">Izin</p>
                                <p class="text-3xl font-bold mt-1">{{ $totalIzin }}</p>
                                <p class="text-xs opacity-75 mt-1">{{ $totalKeseluruhan > 0 ? number_format(($totalIzin / $totalKeseluruhan) * 100, 1) : 0 }}%</p>
                            </div>
                            <div class="bg-white/20 p-3 rounded-xl">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Alpha -->
                    <div class="bg-gradient-to-br from-error to-error/80 p-6 rounded-2xl text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-error/80 text-sm font-medium opacity-90">Alpha</p>
                                <p class="text-3xl font-bold mt-1">{{ $totalAlpha }}</p>
                                <p class="text-xs opacity-75 mt-1">{{ $totalKeseluruhan > 0 ? number_format(($totalAlpha / $totalKeseluruhan) * 100, 1) : 0 }}%</p>
                            </div>
                            <div class="bg-white/20 p-3 rounded-xl">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Left Column: Attendance Table -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                            <div class="bg-gradient-to-r from-student-primary/5 to-student-accent/5 p-6 border-b border-gray-100">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-2xl font-bold text-charcoal">Rekapitulasi Per Mata Pelajaran</h3>
                                        <p class="text-gray-600 text-sm mt-1">Detail kehadiran Anda di setiap mata pelajaran</p>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 shadow-sm">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-3 h-3 bg-success rounded-full"></div>
                                            <span class="text-xs font-medium text-gray-600">Semester Aktif</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="bg-light-gray">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                    </svg>
                                                    <span>Mata Pelajaran</span>
                                                </div>
                                            </th>
                                            <th class="px-6 py-4 text-center text-xs font-bold text-success uppercase tracking-wider">
                                                <div class="flex flex-col items-center">
                                                    <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span>Hadir</span>
                                                </div>
                                            </th>
                                            <th class="px-6 py-4 text-center text-xs font-bold text-blue-500 uppercase tracking-wider">
                                                <div class="flex flex-col items-center">
                                                    <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                    </svg>
                                                    <span>Sakit</span>
                                                </div>
                                            </th>
                                            <th class="px-6 py-4 text-center text-xs font-bold text-warning uppercase tracking-wider">
                                                <div class="flex flex-col items-center">
                                                    <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span>Izin</span>
                                                </div>
                                            </th>
                                            <th class="px-6 py-4 text-center text-xs font-bold text-error uppercase tracking-wider">
                                                <div class="flex flex-col items-center">
                                                    <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    <span>Alpha</span>
                                                </div>
                                            </th>
                                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                                <div class="flex flex-col items-center">
                                                    <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                    </svg>
                                                    <span>Total</span>
                                                </div>
                                            </th>
                                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Persentase</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-100">
                                        @foreach($recap as $subjectName => $data)
                                            @php
                                                $percentage = $data['total'] > 0 ? ($data['Hadir'] / $data['total']) * 100 : 0;
                                                $isGood = $percentage >= 85;
                                                $isOk = $percentage >= 75;
                                            @endphp
                                            <tr class="hover:bg-light-gray/50 transition-colors duration-200 {{ !$isOk ? 'bg-error/5' : ($isGood ? 'hover:bg-success/5' : 'hover:bg-warning/5') }}">
                                                <!-- Subject Name -->
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center space-x-3">
                                                        <div class="flex-shrink-0">
                                                            <div class="w-10 h-10 rounded-full flex items-center justify-center 
                                                                        {{ $isGood ? 'bg-success/20 text-success' : 
                                                                           ($isOk ? 'bg-warning/20 text-warning' : 'bg-error/20 text-error') }}">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="text-sm font-semibold text-charcoal">{{ $subjectName }}</div>
                                                            <div class="text-xs text-gray-500">Mata Pelajaran</div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Hadir -->
                                                <td class="px-6 py-4 text-center">
                                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-success/20 text-success">
                                                        {{ $data['Hadir'] }}
                                                    </div>
                                                </td>

                                                <!-- Sakit -->
                                                <td class="px-6 py-4 text-center">
                                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-blue-100 text-blue-600">
                                                        {{ $data['Sakit'] }}
                                                    </div>
                                                </td>

                                                <!-- Izin -->
                                                <td class="px-6 py-4 text-center">
                                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-warning/20 text-warning">
                                                        {{ $data['Izin'] }}
                                                    </div>
                                                </td>

                                                <!-- Alpha -->
                                                <td class="px-6 py-4 text-center">
                                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-error/20 text-error">
                                                        {{ $data['Alpha'] }}
                                                    </div>
                                                </td>

                                                <!-- Total -->
                                                <td class="px-6 py-4 text-center">
                                                    <div class="text-lg font-bold text-charcoal">
                                                        {{ $data['total'] }}
                                                    </div>
                                                </td>

                                                <!-- Percentage -->
                                                <td class="px-6 py-4 text-center">
                                                    <div class="flex flex-col items-center space-y-2">
                                                        <div class="text-lg font-bold {{ $isGood ? 'text-success' : ($isOk ? 'text-warning' : 'text-error') }}">
                                                            {{ number_format($percentage, 1) }}%
                                                        </div>
                                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                                            <div class="{{ $isGood ? 'bg-success' : ($isOk ? 'bg-warning' : 'bg-error') }} h-2 rounded-full transition-all duration-700" 
                                                                 style="width: {{ min($percentage, 100) }}%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Statistics & Performance -->
                    <div class="space-y-8">
                        
                        <!-- Overall Performance -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="bg-student-primary/10 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-student-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-charcoal">Performa Keseluruhan</h3>
                            </div>

                            <!-- Attendance Circle Progress -->
                            <div class="flex items-center justify-center mb-6">
                                <div class="relative">
                                    <svg class="w-32 h-32 transform -rotate-90">
                                        <circle cx="64" cy="64" r="56" stroke="currentColor" stroke-width="8" fill="transparent" class="text-gray-200"></circle>
                                        <circle cx="64" cy="64" r="56" stroke="currentColor" stroke-width="8" fill="transparent" 
                                                class="{{ $persentaseHadir >= 85 ? 'text-success' : ($persentaseHadir >= 75 ? 'text-warning' : 'text-error') }} progress-ring" 
                                                stroke-dasharray="{{ ($persentaseHadir / 100) * 351.86 }} 351.86"></circle>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="text-center">
                                            <span class="text-3xl font-bold text-charcoal">{{ number_format($persentaseHadir, 1) }}%</span>
                                            <p class="text-xs text-gray-500">Kehadiran</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Performance Status -->
                            <div class="space-y-3">
                                @if($persentaseHadir >= 95)
                                    <div class="bg-success/10 p-4 rounded-xl border border-success/20">
                                        <div class="flex items-center space-x-3">
                                            <div class="bg-success/20 p-2 rounded-lg">
                                                <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-success">Perfect Attendance!</p>
                                                <p class="text-xs text-gray-600">Kehadiran Anda sangat baik ⭐</p>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($persentaseHadir >= 85)
                                    <div class="bg-success/10 p-4 rounded-xl border border-success/20">
                                        <div class="flex items-center space-x-3">
                                            <div class="bg-success/20 p-2 rounded-lg">
                                                <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-success">Kehadiran Baik</p>
                                                <p class="text-xs text-gray-600">Pertahankan konsistensi ini! 👏</p>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($persentaseHadir >= 75)
                                    <div class="bg-warning/10 p-4 rounded-xl border border-warning/20">
                                        <div class="flex items-center space-x-3">
                                            <div class="bg-warning/20 p-2 rounded-lg">
                                                <svg class="w-5 h-5 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-warning">Cukup Baik</p>
                                                <p class="text-xs text-gray-600">Masih bisa ditingkatkan 📈</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="bg-error/10 p-4 rounded-xl border border-error/20">
                                        <div class="flex items-center space-x-3">
                                            <div class="bg-error/20 p-2 rounded-lg">
                                                <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-error">Perlu Perbaikan</p>
                                                <p class="text-xs text-gray-600">Tingkatkan kehadiran Anda 💪</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Monthly Trend (Mock Data) -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="bg-student-accent/10 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-student-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-charcoal">Statistik Detail</h3>
                            </div>

                            <div class="space-y-4">
                                <!-- Best Subject -->
                                @php
                                    $bestSubject = $recap->sortByDesc(function($data) {
                                        return $data['total'] > 0 ? ($data['Hadir'] / $data['total']) * 100 : 0;
                                    })->first();
                                    $bestSubjectName = $recap->sortByDesc(function($data) {
                                        return $data['total'] > 0 ? ($data['Hadir'] / $data['total']) * 100 : 0;
                                    })->keys()->first();
                                @endphp
                                
                                @if($bestSubject)
                                    <div class="bg-success/10 p-4 rounded-xl">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-sm font-semibold text-success">Mata Pelajaran Terbaik</p>
                                                <p class="text-lg font-bold text-charcoal">{{ $bestSubjectName }}</p>
                                                <p class="text-sm text-gray-600">{{ $bestSubject['total'] > 0 ? number_format(($bestSubject['Hadir'] / $bestSubject['total']) * 100, 1) : 0 }}% kehadiran</p>
                                            </div>
                                            <div class="text-2xl">🏆</div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Attendance Breakdown -->
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center p-3 bg-success/10 rounded-lg">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-3 h-3 bg-success rounded-full"></div>
                                            <span class="font-medium text-charcoal">Hadir</span>
                                        </div>
                                        <span class="font-bold text-success">{{ $totalHadir }} hari</span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                            <span class="font-medium text-charcoal">Sakit</span>
                                        </div>
                                        <span class="font-bold text-blue-500">{{ $totalSakit }} hari</span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center p-3 bg-warning/10 rounded-lg">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-3 h-3 bg-warning rounded-full"></div>
                                            <span class="font-medium text-charcoal">Izin</span>
                                        </div>
                                        <span class="font-bold text-warning">{{ $totalIzin }} hari</span>
                                    </div>
                                    
                                    @if($totalAlpha > 0)
                                        <div class="flex justify-between items-center p-3 bg-error/10 rounded-lg">
                                            <div class="flex items-center space-x-2">
                                                <div class="w-3 h-3 bg-error rounded-full"></div>
                                                <span class="font-medium text-charcoal">Alpha</span>
                                            </div>
                                            <span class="font-bold text-error">{{ $totalAlpha }} hari</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Total Summary -->
                                <div class="border-t pt-4">
                                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                                        <span class="font-bold text-charcoal">Total Pertemuan</span>
                                        <span class="text-2xl font-bold text-student-primary">{{ $totalKeseluruhan }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                            <h3 class="text-xl font-bold text-charcoal mb-6">Tindakan Cepat</h3>
                            
                            <div class="space-y-3">
                                <button class="w-full bg-student-primary hover:bg-student-primary/90 text-white font-semibold py-3 px-4 rounded-xl transition-colors flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span>Unduh Rekap Absensi</span>
                                </button>
                                
                                <a href="{{ route('student.dashboard') }}" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-4 rounded-xl transition-colors flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v1H8V5z"></path>
                                    </svg>
                                    <span>Kembali ke Dashboard</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="bg-gray-100 p-8 rounded-2xl mx-auto w-fit mb-6">
                        <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-charcoal mb-2">Belum Ada Data Absensi</h3>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">Data absensi untuk semester ini belum tersedia. Hubungi guru atau admin untuk informasi lebih lanjut.</p>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('student.dashboard') }}" class="bg-student-primary hover:bg-student-primary/90 text-white font-semibold py-3 px-6 rounded-xl transition-colors">
                            Kembali ke Dashboard
                        </a>
                        <button onclick="location.reload()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-colors">
                            Refresh Halaman
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        .progress-ring {
            transition: stroke-dasharray 0.5s ease-in-out;
        }
        
        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.875rem;
            }
            
            .table-responsive th,
            .table-responsive td {
                padding: 0.5rem 0.25rem;
            }
        }
    </style>
</x-student-layout>