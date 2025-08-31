<x-teacher-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Buat Tugas Baru') }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('teacher.assignments.store') }}" method="POST">
                    @include('teacher.assignments._form')
                </form>
            </div>
        </div>
    </div>
</x-teacher-layout>