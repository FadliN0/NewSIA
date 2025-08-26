<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-charcoal leading-tight">{{ __('Edit Semester') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.semesters.update', $semester) }}" method="POST">
                    @method('PUT')
                    @include('admin.semesters._form')
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>