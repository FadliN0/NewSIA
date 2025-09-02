<x-student-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('student.assignments.index') }}" class="mr-4 text-gray-500 hover:text-gray-700">&larr; Kembali</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tugas:') }} {{ $assignment->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                <div>
                    <h3 class="font-bold text-lg text-gray-800">Mata Pelajaran: {{ $assignment->subject->name }}</h3>
                    <p class="text-sm text-gray-600">Diberikan oleh: {{ $assignment->teacher->full_name }}</p>
                    <p class="text-sm text-gray-600">Tenggat Waktu: {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y H:i') }}</p>
                </div>
                
                <div>
                    <h4 class="font-bold text-md text-gray-700">Deskripsi:</h4>
                    <p class="text-gray-600">{{ $assignment->description }}</p>
                </div>

                @if($submission)
                    <div class="p-4 bg-gray-100 rounded-md">
                        <p class="font-semibold text-gray-800">Tugas Anda telah diunggah.</p>
                        <p class="text-sm text-gray-600">File: <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="text-blue-600 hover:underline">{{ $submission->file_name }}</a></p>
                        <p class="text-sm text-gray-600">Diunggah pada: {{ $submission->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <form method="POST" action="{{ route('student.assignments.submit', $assignment) }}" enctype="multipart/form-data">
                        @csrf
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Unggah Ulang File</label>
                        <input type="file" name="file" id="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100"/>
                        @error('file') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">Unggah Ulang</button>
                        </div>
                    </form>
                @else
                    <form method="POST" action="{{ route('student.assignments.submit', $assignment) }}" enctype="multipart/form-data">
                        @csrf
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Unggah File Tugas</label>
                        <input type="file" name="file" id="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100" required/>
                        @error('file') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm">Unggah</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-student-layout>
