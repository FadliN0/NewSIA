<x-student-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="font-bold text-3xl text-charcoal leading-tight">
                    📊 Rapor Online
                </h1>
                <p class="text-gray-600 mt-1">Pantau progress akademik dan pencapaian nilai Anda</p>
            </div>
            
            <!-- Semester Selector -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-1">
                <form method="GET" action="{{ route('student.grades.index') }}" class="flex items-center">
                    <label class="text-sm font-medium text-gray-600 px-3">Semester:</label>
                    <select name="semester" onchange="this.form.submit()" 
                            class="border-0 bg-transparent text-sm font-semibold text-student-primary focus:ring-0 focus:outline-none cursor-pointer">
                        @foreach($semesters as $semester)
                            <option value="{{ $semester->id }}" {{ $selectedSemesterId == $semester->id ? 'selected' : '' }}>
                                {{ $semester->name }} {{ $semester->school_year }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-8 space-y-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if($gradesBySubject->isNotEmpty())
                <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <!-- Rata-rata Nilai -->
                    <div class="bg-gradient-to-br from-student-primary to-student-primary/80 p-6 rounded-2xl text-white shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-student-primary/80 text-sm font-medium opacity-90">Rata-rata Nilai</p>
                                <p class="text-3xl font-bold mt-1">{{ number_format($averageFinalGrade, 1) }}</p>
                                <p class="text-xs opacity-75 mt-1">
                                    @if($averageFinalGrade >= 85)
                                        Sangat Baik! 🎉
                                    @elseif($averageFinalGrade >= 75)
                                        Baik 👍
                                    @elseif($averageFinalGrade >= 65)
                                        Cukup 📚
                                    @else
                                        Perlu Ditingkatkan 💪
                                    @endif
                                </p>
                            </div>
                            <div class="bg-white/20 p-3 rounded-xl">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Mata Pelajaran -->
                    <div class="bg-gradient-to-br from-success to-success/80 p-6 rounded-2xl text-white shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-success/80 text-sm font-medium opacity-90">Total Mapel</p>
                                <p class="text-3xl font-bold mt-1">{{ $gradesBySubject->count() }}</p>
                                <p class="text-xs opacity-75 mt-1">Mata Pelajaran</p>
                            </div>
                            <div class="bg-white/20 p-3 rounded-xl">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Lulus -->
                    <div class="bg-gradient-to-br from-warning to-warning/80 p-6 rounded-2xl text-white shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-warning/80 text-sm font-medium opacity-90">Lulus</p>
                                <p class="text-3xl font-bold mt-1">{{ $gradesBySubject->where('final_grade', '>=', 75)->count() }}</p>
                                <p class="text-xs opacity-75 mt-1">dari {{ $gradesBySubject->count() }} mapel</p>
                            </div>
                            <div class="bg-white/20 p-3 rounded-xl">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Perlu Perbaikan -->
                    <div class="bg-gradient-to-br from-error to-error/80 p-6 rounded-2xl text-white shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-error/80 text-sm font-medium opacity-90">Perbaikan</p>
                                <p class="text-3xl font-bold mt-1">{{ $gradesBySubject->where('final_grade', '<', 75)->count() }}</p>
                                <p class="text-xs opacity-75 mt-1">Mapel perlu fokus</p>
                            </div>
                            <div class="bg-white/20 p-3 rounded-xl">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grades Table -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-student-primary/5 to-student-accent/5 p-6 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-bold text-charcoal">Detail Nilai Per Mata Pelajaran</h3>
                                <p class="text-gray-600 text-sm mt-1">Breakdown nilai berdasarkan komponen penilaian</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 shadow-sm">
                                <div class="flex items-center space-x-2">
                                    <div class="w-3 h-3 bg-student-primary rounded-full"></div>
                                    <span class="text-xs font-medium text-gray-600">KKM: 75</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Table -->
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
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <div class="flex flex-col items-center">
                                            <span>Tugas</span>
                                            <span class="text-[10px] font-normal text-gray-400">(40%)</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <div class="flex flex-col items-center">
                                            <span>UTS</span>
                                            <span class="text-[10px] font-normal text-gray-400">(30%)</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <div class="flex flex-col items-center">
                                            <span>UAS</span>
                                            <span class="text-[10px] font-normal text-gray-400">(30%)</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <div class="flex flex-col items-center">
                                            <span>Kehadiran</span>
                                            <span class="text-[10px] font-normal text-gray-400">(10%)</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <div class="flex items-center justify-center space-x-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                            </svg>
                                            <span>Nilai Akhir</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach($gradesBySubject as $subjectName => $data)
                                    @php
                                        $finalGrade = floatval($data['final_grade']);
                                        $isPassing = $finalGrade >= 75;
                                        $gradeLevel = $finalGrade >= 85 ? 'excellent' : ($finalGrade >= 75 ? 'good' : 'needs_improvement');
                                    @endphp
                                    <tr class="hover:bg-light-gray/50 transition-colors duration-200 {{ !$isPassing ? 'bg-error/5' : 'hover:bg-success/5' }}">
                                        <!-- Subject Name -->
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-shrink-0">
                                                    <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $isPassing ? 'bg-success/20 text-success' : 'bg-error/20 text-error' }}">
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

                                        <!-- Tugas -->
                                        <td class="px-6 py-4 text-center">
                                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                                        {{ $data['tugas'] >= 85 ? 'bg-success/20 text-success' : 
                                                           ($data['tugas'] >= 75 ? 'bg-warning/20 text-warning' : 'bg-error/20 text-error') }}">
                                                {{ number_format($data['tugas'], 1) }}
                                            </div>
                                        </td>

                                        <!-- UTS -->
                                        <td class="px-6 py-4 text-center">
                                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                                        {{ $data['uts'] >= 85 ? 'bg-success/20 text-success' : 
                                                           ($data['uts'] >= 75 ? 'bg-warning/20 text-warning' : 'bg-error/20 text-error') }}">
                                                {{ number_format($data['uts'], 1) }}
                                            </div>
                                        </td>

                                        <!-- UAS -->
                                        <td class="px-6 py-4 text-center">
                                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                                        {{ $data['uas'] >= 85 ? 'bg-success/20 text-success' : 
                                                           ($data['uas'] >= 75 ? 'bg-warning/20 text-warning' : 'bg-error/20 text-error') }}">
                                                {{ number_format($data['uas'], 1) }}
                                            </div>
                                        </td>

                                        <!-- Kehadiran -->
                                        <td class="px-6 py-4 text-center">
                                            <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                                        {{ $data['attendance'] >= 95 ? 'bg-success/20 text-success' : 
                                                           ($data['attendance'] >= 85 ? 'bg-warning/20 text-warning' : 'bg-error/20 text-error') }}">
                                                {{ number_format($data['attendance'], 0) }}%
                                            </div>
                                        </td>

                                        <!-- Final Grade -->
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex flex-col items-center space-y-1">
                                                <div class="text-2xl font-bold {{ $isPassing ? 'text-success' : 'text-error' }}">
                                                    {{ $data['final_grade'] }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    @if($finalGrade >= 90)
                                                        A
                                                    @elseif($finalGrade >= 80)
                                                        B
                                                    @elseif($finalGrade >= 75)
                                                        C
                                                    @elseif($finalGrade >= 60)
                                                        D
                                                    @else
                                                        E
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Status -->
                                        <td class="px-6 py-4 text-center">
                                            @if($isPassing)
                                                <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-success/20 text-success border border-success/30">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Lulus
                                                </div>
                                            @else
                                                <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-error/20 text-error border border-error/30">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Perbaikan
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <!-- Summary Footer -->
                            <tfoot class="bg-gradient-to-r from-student-primary/10 to-student-accent/10">
                                <tr class="border-t-2 border-gray-200">
                                    <td class="px-6 py-4 text-left font-bold text-charcoal">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-student-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                            <span>RATA-RATA KESELURUHAN</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center font-bold text-gray-600">-</td>
                                    <td class="px-6 py-4 text-center font-bold text-gray-600">-</td>
                                    <td class="px-6 py-4 text-center font-bold text-gray-600">-</td>
                                    <td class="px-6 py-4 text-center font-bold text-gray-600">-</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="text-3xl font-bold {{ $averageFinalGrade >= 75 ? 'text-success' : 'text-error' }}">
                                            {{ number_format($averageFinalGrade, 1) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($averageFinalGrade >= 75)
                                            <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-success/20 text-success border-2 border-success/30">
                                                ✅ LULUS
                                            </div>
                                        @else
                                            <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-error/20 text-error border-2 border-error/30">
                                                ⚠️ PERBAIKAN
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Achievement Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
                    <!-- Performance Analysis -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="bg-student-primary/10 p-2 rounded-lg">
                                <svg class="w-6 h-6 text-student-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-charcoal">Analisis Performa</h3>
                        </div>

                        <div class="space-y-4">
                            @php
                                $topSubject = $gradesBySubject->sortByDesc('final_grade')->first();
                                $lowestSubject = $gradesBySubject->sortBy('final_grade')->first();
                            @endphp
                            
                            @if($topSubject)
                                <div class="bg-success/10 p-4 rounded-xl border border-success/20">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-success/20 p-2 rounded-lg">
                                            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-success">Mata Pelajaran Terbaik</p>
                                            <p class="text-lg font-bold text-charcoal">{{ $gradesBySubject->keys()->get($gradesBySubject->search($topSubject)) }}</p>
                                            <p class="text-sm text-gray-600">Nilai: {{ $topSubject['final_grade'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($lowestSubject && $lowestSubject['final_grade'] < 75)
                                <div class="bg-warning/10 p-4 rounded-xl border border-warning/20">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-warning/20 p-2 rounded-lg">
                                            <svg class="w-5 h-5 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-warning">Perlu Fokus Lebih</p>
                                            <p class="text-lg font-bold text-charcoal">{{ $gradesBySubject->keys()->get($gradesBySubject->search($lowestSubject)) }}</p>
                                            <p class="text-sm text-gray-600">Nilai: {{ $lowestSubject['final_grade'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Grade Distribution -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="bg-student-accent/10 p-2 rounded-lg">
                                <svg class="w-6 h-6 text-student-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-charcoal">Distribusi Nilai</h3>
                        </div>

                        <div class="space-y-3">
                            @php
                                $gradeA = $gradesBySubject->filter(fn($grade) => floatval($grade['final_grade']) >= 90)->count();
                                $gradeB = $gradesBySubject->filter(fn($grade) => floatval($grade['final_grade']) >= 80 && floatval($grade['final_grade']) < 90)->count();
                                $gradeC = $gradesBySubject->filter(fn($grade) => floatval($grade['final_grade']) >= 75 && floatval($grade['final_grade']) < 80)->count();
                                $gradeD = $gradesBySubject->filter(fn($grade) => floatval($grade['final_grade']) >= 60 && floatval($grade['final_grade']) < 75)->count();
                                $gradeE = $gradesBySubject->filter(fn($grade) => floatval($grade['final_grade']) < 60)->count();
                                $total = $gradesBySubject->count();
                            @endphp

                            <div class="flex items-center justify-between p-3 bg-success/10 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-success rounded-lg flex items-center justify-center text-white font-bold text-sm">A</div>
                                    <span class="font-medium text-charcoal">90-100</span>
                                </div>
                                <span class="font-bold text-success">{{ $gradeA }} mapel</span>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">B</div>
                                    <span class="font-medium text-charcoal">80-89</span>
                                </div>
                                <span class="font-bold text-blue-500">{{ $gradeB }} mapel</span>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-warning/10 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-warning rounded-lg flex items-center justify-center text-white font-bold text-sm">C</div>
                                    <span class="font-medium text-charcoal">75-79</span>
                                </div>
                                <span class="font-bold text-warning">{{ $gradeC }} mapel</span>
                            </div>

                            @if($gradeD > 0)
                                <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">D</div>
                                        <span class="font-medium text-charcoal">60-74</span>
                                    </div>
                                    <span class="font-bold text-orange-500">{{ $gradeD }} mapel</span>
                                </div>
                            @endif

                            @if($gradeE > 0)
                                <div class="flex items-center justify-between p-3 bg-error/10 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-error rounded-lg flex items-center justify-center text-white font-bold text-sm">E</div>
                                        <span class="font-medium text-charcoal">< 60</span>
                                    </div>
                                    <span class="font-bold text-error">{{ $gradeE }} mapel</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="bg-gray-100 p-8 rounded-2xl mx-auto w-fit mb-6">
                        <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-charcoal mb-2">Belum Ada Data Nilai</h3>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">Nilai untuk semester yang dipilih belum tersedia. Hubungi guru atau admin untuk informasi lebih lanjut.</p>
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
        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        /* Responsive table enhancements */
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