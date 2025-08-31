{{-- Enhanced Admin Sidebar Component --}}
<div x-data="{ open: true, activeMenu: '{{ request()->route()->getName() }}' }" class="flex">
    <!-- Sidebar -->
    <aside 
        class="bg-gradient-to-b from-admin-primary to-admin-primary/90 shadow-2xl h-screen transition-all duration-300 flex flex-col justify-between sticky top-0 border-r border-admin-primary/20"
        :class="open ? 'w-72' : 'w-20'">

        <!-- Header with Logo -->
        <div class="flex items-center justify-between p-6 border-b border-white/10">
            <div x-show="open" class="flex items-center space-x-3 transition-all duration-300">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <div>
                    <span class="font-bold text-xl text-white">Admin Panel</span>
                    <div class="text-xs text-white/70">SMA Academic System</div>
                </div>
            </div>
            <button 
                @click="open = !open" 
                class="p-2 rounded-lg hover:bg-white/10 transition-all duration-200 backdrop-blur-sm"
                :class="!open ? 'mx-auto' : ''">
                <svg class="w-6 h-6 text-white transition-transform duration-300" :class="open ? 'rotate-0' : 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                </svg>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 p-4 space-y-2 scrollbar-hide overflow-y-auto">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" 
               class="group relative flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-white/10"
               :class="activeMenu === 'admin.dashboard' ? 'bg-white/20 shadow-lg' : ''">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg"
                         :class="activeMenu === 'admin.dashboard' ? 'bg-white/20' : 'bg-transparent'">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2v2z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"/>
                        </svg>
                    </div>
                    <span x-show="open" class="text-white font-medium">Dashboard</span>
                </div>
                <div x-show="activeMenu === 'admin.dashboard'" class="absolute right-4">
                    <div class="w-2 h-2 bg-admin-accent rounded-full"></div>
                </div>
            </a>

            <!-- Divider -->
            <div x-show="open" class="border-t border-white/10 my-4"></div>
            <div x-show="open" class="px-4 py-2">
                <span class="text-xs font-semibold text-white/60 uppercase tracking-wider">Data Management</span>
            </div>

            <!-- Kelola Kelas -->
            <a href="{{ route('admin.classes.index') }}" 
               class="group relative flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-white/10"
               :class="activeMenu.includes('admin.classes') ? 'bg-white/20 shadow-lg' : ''">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg"
                         :class="activeMenu.includes('admin.classes') ? 'bg-white/20' : 'bg-transparent'">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l4-2 4 2 4-2z"/>
                        </svg>
                    </div>
                    <span x-show="open" class="text-white font-medium">Kelola Kelas</span>
                </div>
                <div x-show="activeMenu.includes('admin.classes')" class="absolute right-4">
                    <div class="w-2 h-2 bg-admin-accent rounded-full"></div>
                </div>
            </a>

            <!-- Kelola Siswa -->
            <a href="{{ route('admin.students.index') }}" 
               class="group relative flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-white/10"
               :class="activeMenu.includes('admin.students') ? 'bg-white/20 shadow-lg' : ''">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg"
                         :class="activeMenu.includes('admin.students') ? 'bg-white/20' : 'bg-transparent'">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 004.5 0z"/>
                        </svg>
                    </div>
                    <span x-show="open" class="text-white font-medium">Kelola Siswa</span>
                </div>
                <div x-show="activeMenu.includes('admin.students')" class="absolute right-4">
                    <div class="w-2 h-2 bg-admin-accent rounded-full"></div>
                </div>
            </a>

            <!-- Kelola Guru -->
            <a href="{{ route('admin.teachers.index') }}" 
               class="group relative flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-white/10"
               :class="activeMenu.includes('admin.teachers') ? 'bg-white/20 shadow-lg' : ''">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg"
                         :class="activeMenu.includes('admin.teachers') ? 'bg-white/20' : 'bg-transparent'">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span x-show="open" class="text-white font-medium">Kelola Guru</span>
                </div>
                <div x-show="activeMenu.includes('admin.teachers')" class="absolute right-4">
                    <div class="w-2 h-2 bg-admin-accent rounded-full"></div>
                </div>
            </a>

            <!-- Penugasan Guru -->
            <a href="{{ route('admin.assignments.index') }}" 
               class="group relative flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-white/10"
               :class="activeMenu.includes('admin.assignments') ? 'bg-white/20 shadow-lg' : ''">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg"
                         :class="activeMenu.includes('admin.assignments') ? 'bg-white/20' : 'bg-transparent'">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <span x-show="open" class="text-white font-medium">Penugasan Guru</span>
                </div>
                <div x-show="activeMenu.includes('admin.assignments')" class="absolute right-4">
                    <div class="w-2 h-2 bg-admin-accent rounded-full"></div>
                </div>
            </a>

            <!-- Mata Pelajaran -->
            <a href="{{ route('admin.subjects.index') }}" 
               class="group relative flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-white/10"
               :class="activeMenu.includes('admin.subjects') ? 'bg-white/20 shadow-lg' : ''">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg"
                         :class="activeMenu.includes('admin.subjects') ? 'bg-white/20' : 'bg-transparent'">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <span x-show="open" class="text-white font-medium">Mata Pelajaran</span>
                </div>
                <div x-show="activeMenu.includes('admin.subjects')" class="absolute right-4">
                    <div class="w-2 h-2 bg-admin-accent rounded-full"></div>
                </div>
            </a>

            <!-- Semester -->
            <a href="{{ route('admin.semesters.index') }}" 
               class="group relative flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-white/10"
               :class="activeMenu.includes('admin.semesters') ? 'bg-white/20 shadow-lg' : ''">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg"
                         :class="activeMenu.includes('admin.semesters') ? 'bg-white/20' : 'bg-transparent'">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span x-show="open" class="text-white font-medium">Semester</span>
                </div>
                <div x-show="activeMenu.includes('admin.semesters')" class="absolute right-4">
                    <div class="w-2 h-2 bg-admin-accent rounded-full"></div>
                </div>
            </a>

            <!-- Divider -->
            <div x-show="open" class="border-t border-white/10 my-4"></div>
            <div x-show="open" class="px-4 py-2">
                <span class="text-xs font-semibold text-white/60 uppercase tracking-wider">Reports & Analytics</span>
            </div>

            <!-- Laporan Akademik -->
            <a href="{{ route('admin.reports.academic') }}" 
               class="group relative flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-white/10"
               :class="activeMenu.includes('admin.reports.academic') ? 'bg-white/20 shadow-lg' : ''">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg"
                         :class="activeMenu.includes('admin.reports.academic') ? 'bg-white/20' : 'bg-transparent'">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <span x-show="open" class="text-white font-medium">Laporan Akademik</span>
                </div>
                <div x-show="activeMenu.includes('admin.reports.academic')" class="absolute right-4">
                    <div class="w-2 h-2 bg-admin-accent rounded-full"></div>
                </div>
            </a>

            <!-- Laporan Kehadiran -->
            <a href="{{ route('admin.reports.attendance') }}" 
               class="group relative flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-white/10"
               :class="activeMenu.includes('admin.reports.attendance') ? 'bg-white/20 shadow-lg' : ''">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg"
                         :class="activeMenu.includes('admin.reports.attendance') ? 'bg-white/20' : 'bg-transparent'">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <span x-show="open" class="text-white font-medium">Laporan Kehadiran</span>
                </div>
                <div x-show="activeMenu.includes('admin.reports.attendance')" class="absolute right-4">
                    <div class="w-2 h-2 bg-admin-accent rounded-full"></div>
                </div>
            </a>
        </nav>

        <!-- Profile & Logout Section -->
        <div class="border-t border-white/10 p-4 space-y-2">
            <!-- User Info (when expanded) -->
            <div x-show="open" class="px-4 py-3 bg-white/10 rounded-xl mb-3 backdrop-blur-sm">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-admin-accent rounded-full flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div>
                        <div class="text-white font-semibold text-sm">{{ Auth::user()->name ?? 'Administrator' }}</div>
                        <div class="text-white/70 text-xs">System Administrator</div>
                    </div>
                </div>
            </div>

            <!-- Profile Link -->
            <a href="{{ route('profile.edit') }}" 
               class="group relative flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-white/10"
               :class="activeMenu.includes('profile') ? 'bg-white/20 shadow-lg' : ''">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span x-show="open" class="text-white font-medium">Profile Saya</span>
                </div>
            </a>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="group w-full flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-error/20 text-left">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 flex items-center justify-center rounded-lg">
                            <svg class="w-5 h-5 text-white group-hover:text-red-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </div>
                        <span x-show="open" class="text-white font-medium group-hover:text-red-200">Logout</span>
                    </div>
                </button>
            </form>
        </div>
    </aside>

    <!-- Overlay for mobile when sidebar is open -->
    <div x-show="open" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false"
         class="fixed inset-0 bg-black bg-opacity-25 lg:hidden z-40">
    </div>
</div>

{{-- Additional Styles for Enhanced Admin Theme --}}
<style>
    /* Custom scrollbar for sidebar */
    aside::-webkit-scrollbar {
        width: 4px;
    }
    
    aside::-webkit-scrollbar-track {
        background: transparent;
    }
    
    aside::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 2px;
    }
    
    aside::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    /* Smooth animations */
    * {
        transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Enhanced hover effects */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }

    /* Backdrop blur support */
    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
    }
</style>