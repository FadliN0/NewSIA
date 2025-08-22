<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-charcoal leading-tight">
            {{ __('Edit Data Siswa') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.students.update', $student) }}">
                    @csrf
                    @method('PUT')
                    
                    <h3 class="text-lg font-semibold mb-4 text-teal-dark">Informasi Akun</h3>
                     <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-charcoal">Email</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('email', $student->user->email) }}" required>
                            @error('email') <span class="text-sm text-brick-red">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-charcoal">Password Baru (Opsional)</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('password') <span class="text-sm text-brick-red">{{ $message }}</span> @enderror
                        </div>
                         <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-charcoal">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold mb-4 mt-6 text-teal-dark">Biodata Siswa</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-charcoal">Nama Lengkap</label>
                            <input type="text" name="full_name" id="full_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('full_name', $student->full_name) }}" required>
                             @error('full_name') <span class="text-sm text-brick-red">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="nis" class="block text-sm font-medium text-charcoal">NIS</label>
                            <input type="text" name="nis" id="nis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('nis', $student->nis) }}" required>
                            @error('nis') <span class="text-sm text-brick-red">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="nisn" class="block text-sm font-medium text-charcoal">NISN</label>
                            <input type="text" name="nisn" id="nisn" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('nisn', $student->nisn) }}" required>
                            @error('nisn') <span class="text-sm text-brick-red">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="class_room_id" class="block text-sm font-medium text-charcoal">Kelas</label>
                            <select name="class_room_id" id="class_room_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('class_room_id', $student->class_room_id) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                            @error('class_room_id') <span class="text-sm text-brick-red">{{ $message }}</span> @enderror
                        </div>
                         <div>
                            <label for="gender" class="block text-sm font-medium text-charcoal">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender') <span class="text-sm text-brick-red">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="entry_year" class="block text-sm font-medium text-charcoal">Tahun Masuk</label>
                            <input type="number" name="entry_year" id="entry_year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('entry_year', $student->entry_year) }}" required>
                            @error('entry_year') <span class="text-sm text-brick-red">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.students.index') }}" class="text-sm text-charcoal/80 mr-4">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-lime-accent text-white rounded-lg">Perbarui Siswa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>