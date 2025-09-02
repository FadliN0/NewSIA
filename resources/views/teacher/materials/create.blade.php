<x-teacher-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Unggah Materi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('teacher.materials.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="p-6 space-y-4">
                        <div>
                            <label for="teacher_subject_id" class="block text-sm font-medium text-gray-700">Untuk Kelas & Mapel</label>
                            <select name="teacher_subject_id" id="teacher_subject_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">-- Pilih --</option>
                                @foreach($classSubjects as $item)
                                    <option value="{{ $item->id }}">
                                        Kelas {{ $item->classRoom->name }} - {{ $item->subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('teacher_subject_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul Materi</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description') }}</textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="file" class="block text-sm font-medium text-gray-700">Pilih File</label>
                            <input type="file" name="file" id="file" class="mt-1 block w-full rounded-md shadow-sm">
                            @error('file') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="p-6 bg-gray-50 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                            Unggah Materi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-teacher-layout>