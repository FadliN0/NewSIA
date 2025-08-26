@csrf
<div class="space-y-4">
    <div>
        <x-input-label for="name" :value="__('Nama Semester')" />
        <select name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            <option value="Ganjil" {{ old('name', $semester->name ?? '') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
            <option value="Genap" {{ old('name', $semester->name ?? '') == 'Genap' ? 'selected' : '' }}>Genap</option>
        </select>
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="school_year" :value="__('Tahun Ajaran')" />
        <x-text-input type="text" name="school_year" id="school_year" class="mt-1 block w-full" placeholder="Contoh: 2024/2025" :value="old('school_year', $semester->school_year ?? '')" required />
        <x-input-error :messages="$errors->get('school_year')" class="mt-2" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <x-input-label for="start_date" :value="__('Tanggal Mulai')" />
            <x-text-input type="date" name="start_date" id="start_date" class="mt-1 block w-full" :value="old('start_date', isset($semester) ? $semester->start_date->format('Y-m-d') : '')" required />
            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="end_date" :value="__('Tanggal Selesai')" />
            <x-text-input type="date" name="end_date" id="end_date" class="mt-1 block w-full" :value="old('end_date', isset($semester) ? $semester->end_date->format('Y-m-d') : '')" required />
            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
        </div>
    </div>
    
    <div class="flex items-center">
        <input type="checkbox" name="is_active" id="is_active" value="1" @if(old('is_active', $semester->is_active ?? false)) checked @endif class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
        <label for="is_active" class="ml-2 block text-sm text-gray-900">Jadikan Semester Aktif</label>
    </div>
</div>

<div class="mt-6 flex items-center justify-end">
    <a href="{{ route('admin.semesters.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
        {{ __('Batal') }}
    </a>

    <x-primary-button>
        @if(isset($semester))
            {{ __('Perbarui') }}
        @else
            {{ __('Simpan') }}
        @endif
    </x-primary-button>
</div>