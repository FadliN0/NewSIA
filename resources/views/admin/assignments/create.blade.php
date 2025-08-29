<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-charcoal leading-tight">{{ __('Tugaskan Guru ke Kelas') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.assignments.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="teacher_subject_id" class="block text-sm font-medium text-gray-700">Pilih Guru & Mapel</label>
                            <select name="teacher_subject_id" id="teacher_subject_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">-- Pilih Penugasan --</option>
                                @foreach($unassignedTeachers as $assignment)
                                    <option value="{{ $assignment->id }}">
                                        {{ $assignment->teacher->full_name }} - Mengajar {{ $assignment->subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Hanya menampilkan guru yang sudah punya mapel tapi belum punya kelas.</p>
                        </div>

                        <div>
                            <label for="class_room_id" class="block text-sm font-medium text-gray-700">Pilih Kelas</label>
                            <select name="class_room_id" id="class_room_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                 <option value="">-- Pilih Kelas --</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('admin.assignments.index') }}" class="mr-4 text-sm py-2 px-4">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-lime-accent text-black rounded-lg">Simpan Penugasan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>