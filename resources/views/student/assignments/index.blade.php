<x-student-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
            <div>
                <h2 class="font-bold text-2xl text-charcoal leading-tight">
                    {{ __('Daftar Tugas') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Kelola dan pantau tugas-tugas Anda</p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="bg-student-primary/10 px-4 py-2 rounded-lg border border-student-primary/20">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-student-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="text-sm font-medium text-student-primary">
                            {{ $assignments->count() }} Tugas
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Total Tugas -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="bg-student-primary/10 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-student-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total</p>
                            <p class="text-2xl font-bold text-charcoal">{{ $assignments->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Sudah Dikumpulkan -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="bg-success/10 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Dikumpulkan</p>
                            <p class="text-2xl font-bold text-charcoal">{{ $assignments->filter(fn($a) => $a->submissions->isNotEmpty())->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Belum Dikumpulkan -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="bg-warning/10 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pending</p>
                            <p class="text-2xl font-bold text-charcoal">{{ $assignments->filter(fn($a) => $a->submissions->isEmpty())->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Terlambat -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="bg-error/10 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Terlambat</p>
                            <p class="text-2xl font-bold text-charcoal">
                                {{ $assignments->filter(fn($a) => $a->submissions->isEmpty() && \Carbon\Carbon::parse($a->due_date)->isPast())->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="flex border-b border-gray-100">
                    <button class="tab-button active px-6 py-4 text-sm font-medium border-b-2 border-student-primary text-student-primary bg-student-primary/5" data-tab="all">
                        Semua Tugas
                    </button>
                    <button class="tab-button px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700" data-tab="pending">
                        Belum Dikumpulkan
                    </button>
                    <button class="tab-button px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700" data-tab="submitted">
                        Sudah Dikumpulkan
                    </button>
                    <button class="tab-button px-6 py-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-gray-700" data-tab="overdue">
                        Terlambat
                    </button>
                </div>

                <!-- Assignments List -->
                <div class="p-6">
                    @forelse($assignments as $assignment)
                        @php
                            $isSubmitted = $assignment->submissions->isNotEmpty();
                            $isOverdue = !$isSubmitted && \Carbon\Carbon::parse($assignment->due_date)->isPast();
                            $daysLeft = \Carbon\Carbon::parse($assignment->due_date)->diffInDays(now(), false);
                        @endphp

                        <div class="assignment-card bg-light-gray rounded-xl border border-gray-200 p-6 mb-4 hover:shadow-lg transition-all duration-300 hover:-translate-y-1
                                    {{ $isSubmitted ? 'submitted' : 'pending' }}
                                    {{ $isOverdue ? 'overdue' : '' }}"
                             data-status="{{ $isSubmitted ? 'submitted' : ($isOverdue ? 'overdue' : 'pending') }}">
                            
                            <div class="flex items-start justify-between">
                                <!-- Assignment Info -->
                                <div class="flex-1">
                                    <div class="flex items-start space-x-4">
                                        <!-- Subject Icon -->
                                        <div class="bg-student-primary/10 p-3 rounded-xl flex-shrink-0">
                                            <svg class="w-6 h-6 text-student-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>

                                        <!-- Assignment Details -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center space-x-3 mb-2">
                                                <h3 class="font-bold text-lg text-charcoal truncate">{{ $assignment->title }}</h3>
                                                <!-- Status Badge -->
                                                @if($isSubmitted)
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-success/20 text-success border border-success/30">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        Dikumpulkan
                                                    </span>
                                                @elseif($isOverdue)
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-error/20 text-error border border-error/30">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        Terlambat
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-warning/20 text-warning border border-warning/30">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        Pending
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="flex items-center space-x-6 text-sm text-gray-600 mb-3">
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                    </svg>
                                                    <span class="font-medium">{{ $assignment->subject->name }}</span>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                    <span>{{ $assignment->teacher->full_name }}</span>
                                                </div>
                                            </div>

                                            <!-- Deadline Info -->
                                            <div class="flex items-center space-x-4">
                                                <div class="flex items-center space-x-2 {{ $isOverdue ? 'text-error' : ($daysLeft <= 1 ? 'text-warning' : 'text-gray-600') }}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span class="text-sm font-medium">
                                                        Deadline: {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y, H:i') }}
                                                    </span>
                                                </div>
                                                
                                                @if(!$isSubmitted)
                                                    <div class="text-sm">
                                                        @if($isOverdue)
                                                            <span class="text-error font-medium">Terlambat {{ abs($daysLeft) }} hari</span>
                                                        @elseif($daysLeft == 0)
                                                            <span class="text-warning font-medium">Deadline hari ini!</span>
                                                        @elseif($daysLeft == 1)
                                                            <span class="text-warning font-medium">Besok deadline</span>
                                                        @else
                                                            <span class="text-gray-600">{{ $daysLeft }} hari lagi</span>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Progress Bar for Deadline -->
                                            @if(!$isSubmitted && !$isOverdue)
                                                @php
                                                    $totalDays = \Carbon\Carbon::parse($assignment->created_at)->diffInDays(\Carbon\Carbon::parse($assignment->due_date));
                                                    $passedDays = \Carbon\Carbon::parse($assignment->created_at)->diffInDays(now());
                                                    $progress = $totalDays > 0 ? min(($passedDays / $totalDays) * 100, 100) : 0;
                                                @endphp
                                                <div class="mt-3">
                                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                                        <div class="h-2 rounded-full transition-all duration-700 {{ $progress > 80 ? 'bg-error' : ($progress > 60 ? 'bg-warning' : 'bg-success') }}" 
                                                             style="width: {{ $progress }}%"></div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <div class="flex-shrink-0 ml-6">
                                    <a href="{{ route('student.assignments.show', $assignment) }}" 
                                       class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white 
                                              {{ $isSubmitted ? 'bg-success hover:bg-success/90' : 'bg-student-primary hover:bg-student-primary/90' }} 
                                              transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-student-primary">
                                        @if($isSubmitted)
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Lihat Detail
                                        @else
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                            </svg>
                                            Kumpulkan
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <div class="bg-gray-100 p-8 rounded-2xl mx-auto w-fit mb-6">
                                <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-charcoal mb-2">Belum Ada Tugas</h3>
                            <p class="text-gray-600 mb-6 max-w-md mx-auto">Saat ini belum ada tugas yang diberikan oleh guru. Tugas baru akan muncul di sini.</p>
                            <a href="{{ route('student.dashboard') }}" class="bg-student-primary hover:bg-student-primary/90 text-white font-semibold py-3 px-6 rounded-xl transition-colors">
                                Kembali ke Dashboard
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Tab Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab-button');
            const assignmentCards = document.querySelectorAll('.assignment-card');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetTab = this.getAttribute('data-tab');
                    
                    // Update active tab
                    tabs.forEach(t => {
                        t.classList.remove('active', 'border-student-primary', 'text-student-primary', 'bg-student-primary/5');
                        t.classList.add('border-transparent', 'text-gray-500');
                    });
                    
                    this.classList.add('active', 'border-student-primary', 'text-student-primary', 'bg-student-primary/5');
                    this.classList.remove('border-transparent', 'text-gray-500');

                    // Filter assignments
                    assignmentCards.forEach(card => {
                        const cardStatus = card.getAttribute('data-status');
                        
                        if (targetTab === 'all') {
                            card.style.display = 'block';
                        } else if (targetTab === 'pending' && cardStatus === 'pending') {
                            card.style.display = 'block';
                        } else if (targetTab === 'submitted' && cardStatus === 'submitted') {
                            card.style.display = 'block';
                        } else if (targetTab === 'overdue' && cardStatus === 'overdue') {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
</x-student-layout>