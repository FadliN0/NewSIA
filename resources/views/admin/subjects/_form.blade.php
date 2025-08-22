@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="name" class="block text-sm font-medium text-charcoal">Nama Mata Pelajaran</label>
        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('name') border-brick-red @enderror" value="{{ old('name', $subject->name ?? '') }}" required>
        @error('name')
            <p class="mt-1 text-sm text-brick-red">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label for="code" class="block text-sm font-medium text-charcoal">Kode Mapel</label>
        <input type="text" name="code" id="code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('code') border-brick-red @enderror" value="{{ old('code', $subject->code ?? '') }}" required>
        @error('code')
            <p class="mt-1 text-sm text-brick-red">{{ $message }}</p>
        @enderror
    </div>
    <div class="md:col-span-2">
        <label for="teacher_id" class="block text-sm font-medium text-charcoal">Guru Pengampu</label>
        <select name="teacher_id" id="teacher_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('teacher_id') border-brick-red @enderror" required>
            <option value="">Pilih Guru</option>
            @foreach($teachers as $teacher)
            <option value="{{ $teacher->id }}" 
                {{ (old('teacher_id', $assigned_teacher_id ?? '') == $teacher->id) ? 'selected' : '' }}>
                {{ $teacher->full_name }} (NIP: {{ $teacher->nip }})
            </option>
            @endforeach
        </select>
        @error('teacher_id')
            <p class="mt-1 text-sm text-brick-red">{{ $message }}</p>
        @enderror
    </div>
    <div class="md:col-span-2">
        <label for="description" class="block text-sm font-medium text-charcoal">Deskripsi (Opsional)</label>
        <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $subject->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-brick-red">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="flex items-center justify-end mt-6">
    <a href="{{ route('admin.subjects.index') }}" class="text-sm text-charcoal/80 mr-4">Batal</a>
    <button type="submit" class="px-4 py-2 bg-lime-accent text-white rounded-lg font-semibold uppercase text-xs tracking-widest">
        @if(isset($subject))
            Perbarui
        @else
            Simpan
        @endif
    </button>
</div>