<x-responsive-nav-link :href="route('student.dashboard')" :active="request()->routeIs('student.dashboard')">
    {{ __('Dasbor') }}
</x-responsive-nav-link>

<x-responsive-nav-link :href="route('student.assignments.index')" :active="request()->routeIs('student.assignments.index')">
    {{ __('Tugas') }}
</x-responsive-nav-link>

<x-responsive-nav-link :href="route('student.grades.index')" :active="request()->routeIs('student.grades.index')">
    {{ __('Rapor Online') }}
</x-responsive-nav-link>

<x-responsive-nav-link :href="route('student.attendances.index')" :active="request()->routeIs('student.attendances.index')">
    {{ __('Riwayat Absensi') }}
</x-responsive-nav-link>

<x-responsive-nav-link :href="route('student.materials.index')" :active="request()->routeIs('student.materials.index')">
    {{ __('Materi Pelajaran') }}
</x-responsive-nav-link>

<div class="pt-4 pb-1 border-t border-gray-200">
    <div class="px-4">
        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
    </div>
    <div class="mt-3 space-y-1">
        <x-responsive-nav-link :href="route('profile.edit')">
            {{ __('Profil') }}
        </x-responsive-link>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-responsive-nav-link :href="route('logout')"
                                   onclick="event.preventDefault();
                                               this.closest('form').submit();">
                {{ __('Keluar') }}
            </x-responsive-nav-link>
        </form>
    </div>
</div>
