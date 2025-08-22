<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-charcoal leading-tight">
            {{ __('Tambah Guru Baru') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.teachers.store') }}">
                    @csrf
                    
                    <h3 class="text-lg font-semibold mb-4 text-teal-dark">Informasi Akun</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-charcoal">Email</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('email') }}" required>
                            @error('email') <span class="text-sm text-brick-red">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-charcoal">Password</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('password') <span class="text-sm text-brick-red">{{ $message }}</span> @enderror
                        </div>
                         <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-charcoal">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                    </div>
                    
                    <h3 class="text-lg font-semibold mb-4 mt-6 text-teal-dark">Biodata Guru</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-charcoal">Nama Lengkap</label>
                            <input type="text" name="full_name" id="full_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('full_name') }}" required>
                            @error('full_name') <span class="text-sm text-brick-red">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="nip" class="block text-sm font-medium text-charcoal">NIP</label>
                            <input type="text" name="nip" id="nip" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('nip') }}" required>
                            @error('nip') <span class="text-sm text-brick-red">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="gender" class="block text-sm font-medium text-charcoal">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender') <span class="text-sm text-brick-red">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-charcoal">Telepon (Opsional)</label>
                            <input type="text" name="phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('phone') }}">
                            @error('phone') <span class="text-sm text-brick-red">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="education_level" class="block text-sm font-medium text-charcoal">Pendidikan Terakhir (Opsional)</label>
                            <input type="text" name="education_level" id="education_level" placeholder="Contoh: S1 Pendidikan Matematika" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('education_level') }}">
                            @error('education_level') <span class="text-sm text-brick-red">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.teachers.index') }}" class="text-sm text-charcoal/80 mr-4">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-lime-accent text-white rounded-lg">Simpan Guru</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>