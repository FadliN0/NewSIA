<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-charcoal leading-tight">{{ __('Edit Mata Pelajaran') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.subjects.update', $subject) }}">
                    @method('PUT')
                    {{-- Pastikan variabel yang digunakan di sini benar --}}
                    @include('admin.subjects._form', ['subject' => $subject])
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>