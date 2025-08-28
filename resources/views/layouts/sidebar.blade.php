<div x-data="{ open: true }" class="flex">
    <!-- Sidebar -->
    <aside 
        class="bg-white shadow-md h-screen transition-all duration-300 flex flex-col justify-between sticky top-0"
        :class="open ? 'w-64' : 'w-16'">

        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b">
            <span x-show="open" class="font-bold text-lg">Admin</span>
            <button 
                @click="open = !open" 
                class="p-1 rounded hover:bg-gray-200 transition">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Nav -->
        <nav class="p-2 space-y-1">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center px-3 py-2 rounded hover:bg-gray-100">
               <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
               <span x-show="open" class="ml-2">Dashboard</span>
            </a>
            <a href="{{ route('admin.classes.index') }}" 
               class="flex items-center px-3 py-2 rounded hover:bg-gray-100">
               <i data-lucide="school" class="w-5 h-5"></i>
               <span x-show="open" class="ml-2">Kelola Kelas</span>
            </a>
            <a href="{{ route('admin.students.index') }}" 
               class="flex items-center px-3 py-2 rounded hover:bg-gray-100">
               <i data-lucide="users" class="w-5 h-5"></i>
               <span x-show="open" class="ml-2">Kelola Siswa</span>
            </a>
            <a href="{{ route('admin.teachers.index') }}" 
               class="flex items-center px-3 py-2 rounded hover:bg-gray-100">
               <i data-lucide="user-check" class="w-5 h-5"></i>
               <span x-show="open" class="ml-2">Kelola Guru</span>
            </a>
            <a href="{{ route('admin.subjects.index') }}" 
               class="flex items-center px-3 py-2 rounded hover:bg-gray-100">
               <i data-lucide="book-open" class="w-5 h-5"></i>
               <span x-show="open" class="ml-2">Mata Pelajaran</span>
            </a>
            <a href="{{ route('admin.semesters.index') }}" 
               class="flex items-center px-3 py-2 rounded hover:bg-gray-100">
               <i data-lucide="book" class="w-5 h-5"></i>
               <span x-show="open" class="ml-2">Semester</span>
            </a>
            <a href="{{ route('admin.reports.academic') }}" 
               class="flex items-center px-3 py-2 rounded hover:bg-gray-100">
               <i data-lucide="file-text" class="w-5 h-5"></i>
               <span x-show="open" class="ml-2">Laporan Akademik</span>
            </a>
            <a href="{{ route('admin.reports.attendance') }}" 
               class="flex items-center px-3 py-2 rounded hover:bg-gray-100">
               <i data-lucide="calendar-check" class="w-5 h-5"></i>
               <span x-show="open" class="ml-2">Laporan Kehadiran</span>
            </a>
        </nav>

        <!-- Profile & Logout -->
        <div class="border-t p-2 space-y-1">
            <a href="{{ route('profile.edit') }}" 
               class="flex items-center px-3 py-2 rounded hover:bg-gray-100">
               <i data-lucide="user" class="w-5 h-5"></i>
               <span x-show="open" class="ml-2">Profile</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="flex w-full items-center px-3 py-2 rounded hover:bg-gray-100">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    <span x-show="open" class="ml-2">Logout</span>
                </button>
            </form>
        </div>
    </aside>
</div>
