<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-charcoal leading-tight">{{ __('Tambah Mata Pelajaran Baru') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.subjects.store') }}">
                    @include('admin.subjects._form')
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>