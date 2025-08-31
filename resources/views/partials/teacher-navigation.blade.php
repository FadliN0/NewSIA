<nav x-data="{ open: false }" class="bg-white shadow-lg border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Left Side: Logo & Brand -->
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('teacher.dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="bg-gradient-to-br from-teacher-primary to-teacher-primary/80 p-2 rounded-xl group-hover:shadow-lg transition-all duration-300">
                            <x-application-logo class="block h-8 w-auto fill-current text-white" />
                        </div>
                        <div class="hidden sm:block">
                            <h1 class="text-xl font-bold text-charcoal group-hover:text-teacher-primary transition-colors">Portal Guru</h1>
                            <p class="text-xs text-gray-500 -mt-1">Sistem Akademik</p>
                        </div>
                    </a>
                </div>

                <!-- Main Navigation Menu -->
                <div class="hidden lg:flex lg:items-center lg:space-x-2 lg:ml-10">
                    <a href="{{ route('teacher.dashboard') }}" 
                       class="group flex items-center space-x-2 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('teacher.dashboard') ? 'bg-teacher-primary text-white shadow-md' : 'text-gray-600 hover:text-teacher-primary hover:bg-teacher-primary/5' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2v2z"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    
                    <a href="{{ route('teacher.attendances.index') }}" 
                       class="group flex items-center space-x-2 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('teacher.attendances.*') ? 'bg-teacher-primary text-white shadow-md' : 'text-gray-600 hover:text-teacher-primary hover:bg-teacher-primary/5' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Absensi</span>
                    </a>
                    
                    <a href="{{ route('teacher.grades.index') }}" 
                       class="group flex items-center space-x-2 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('teacher.grades.*') ? 'bg-teacher-accent text-white shadow-md' : 'text-gray-600 hover:text-teacher-accent hover:bg-teacher-accent/5' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        <span>Nilai</span>
                    </a>
                    
                    <a href="{{ route('teacher.assignments.index') }}" 
                       class="group flex items-center space-x-2 px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('teacher.assignments.*') ? 'bg-indigo-600 text-white shadow-md' : 'text-gray-600 hover:text-indigo-600 hover:bg-indigo-50' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Tugas</span>
                    </a>
                </div>
            </div>

            <!-- Right Side: User Menu -->
            <div class="flex items-center space-x-4">
                <!-- Notifications (Optional) -->
                <div class="hidden md:flex items-center">
                    <button class="relative p-2 text-gray-400 hover:text-teacher-primary rounded-xl hover:bg-gray-50 transition-all duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM12 17.5a4.5 4.5 0 100-9 4.5 4.5 0 000 9z"></path>
                        </svg>
                        <!-- Notification dot (if there are notifications) -->
                        <span class="absolute top-1 right-1 w-2 h-2 bg-error rounded-full"></span>
                    </button>
                </div>

                <!-- User Dropdown -->
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="64">
                        <x-slot name="trigger">
                            <button class="group inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-xl text-gray-600 bg-gray-50 hover:bg-teacher-primary hover:text-white focus:outline-none focus:ring-2 focus:ring-teacher-primary focus:ring-offset-2 transition-all ease-in-out duration-200">
                                <div class="flex items-center space-x-3">
                                    <!-- User Avatar -->
                                    <div class="w-8 h-8 bg-gradient-to-br from-teacher-primary to-teacher-primary/80 rounded-lg flex items-center justify-center group-hover:from-white/20 group-hover:to-white/10 transition-all">
                                        <span class="text-white font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                    <div class="text-left">
                                        <div class="font-semibold">{{ Auth::user()->name }}</div>
                                        <div class="text-xs text-gray-500 group-hover:text-white/70 transition-colors">Guru</div>
                                    </div>
                                    <svg class="fill-current h-4 w-4 group-hover:text-white transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-semibold text-charcoal">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-2 hover:bg-teacher-primary/5 hover:text-teacher-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>{{ __('Profile') }}</span>
                            </x-dropdown-link>
                            
                            <x-dropdown-link href="#" class="flex items-center space-x-2 hover:bg-gray-50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Pengaturan</span>
                            </x-dropdown-link>
                            
                            <div class="border-t border-gray-100 my-1"></div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" 
                                                class="flex items-center space-x-2 hover:bg-red-50 hover:text-red-600 text-red-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>{{ __('Keluar') }}</span>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-teacher-primary hover:bg-teacher-primary/5 focus:outline-none focus:bg-teacher-primary/5 focus:text-teacher-primary transition-all duration-200">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-200 shadow-lg">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <!-- Mobile Logo & Brand -->
            <div class="flex items-center space-x-3 px-3 py-4 border-b border-gray-100 mb-4">
                <div class="bg-gradient-to-br from-teacher-primary to-teacher-primary/80 p-2 rounded-lg">
                    <x-application-logo class="block h-6 w-auto fill-current text-white" />
                </div>
                <div>
                    <h2 class="font-bold text-charcoal">Portal Guru</h2>
                    <p class="text-xs text-gray-500">Sistem Akademik</p>
                </div>
            </div>

            <!-- Mobile Navigation Links -->
            <a href="{{ route('teacher.dashboard') }}" 
               class="group flex items-center space-x-3 px-3 py-3 rounded-xl text-base font-medium transition-all duration-200 {{ request()->routeIs('teacher.dashboard') ? 'bg-teacher-primary text-white shadow-md' : 'text-gray-600 hover:text-teacher-primary hover:bg-teacher-primary/5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2v2z"></path>
                </svg>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('teacher.attendances.index') }}" 
               class="group flex items-center space-x-3 px-3 py-3 rounded-xl text-base font-medium transition-all duration-200 {{ request()->routeIs('teacher.attendances.*') ? 'bg-teacher-primary text-white shadow-md' : 'text-gray-600 hover:text-teacher-primary hover:bg-teacher-primary/5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>Kelola Absensi</span>
            </a>
            
            <a href="{{ route('teacher.grades.index') }}" 
               class="group flex items-center space-x-3 px-3 py-3 rounded-xl text-base font-medium transition-all duration-200 {{ request()->routeIs('teacher.grades.*') ? 'bg-teacher-accent text-white shadow-md' : 'text-gray-600 hover:text-teacher-accent hover:bg-teacher-accent/5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                <span>Input Nilai</span>
            </a>
            
            <a href="{{ route('teacher.assignments.index') }}" 
               class="group flex items-center space-x-3 px-3 py-3 rounded-xl text-base font-medium transition-all duration-200 {{ request()->routeIs('teacher.assignments.*') ? 'bg-indigo-600 text-white shadow-md' : 'text-gray-600 hover:text-indigo-600 hover:bg-indigo-50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span>Kelola Tugas</span>
            </a>

            <!-- Mobile User Section -->
            <div class="border-t border-gray-200 pt-4 mt-4">
                <div class="flex items-center px-3 py-3 mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-teacher-primary to-teacher-primary/80 rounded-xl flex items-center justify-center mr-3">
                        <span class="text-white font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <div class="font-semibold text-charcoal">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                
                <a href="{{ route('profile.edit') }}" class="group flex items-center space-x-3 px-3 py-3 rounded-xl text-base font-medium text-gray-600 hover:text-teacher-primary hover:bg-teacher-primary/5 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>Profile</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full group flex items-center space-x-3 px-3 py-3 rounded-xl text-base font-medium text-red-500 hover:text-red-600 hover:bg-red-50 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>