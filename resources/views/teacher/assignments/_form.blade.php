@csrf
<div class="space-y-4">
    <div>
        <label for="teacher_subject_id" class="block text-sm font-medium text-gray-700">Untuk Kelas & Mapel</label>
        <select name="teacher_subject_id" id="teacher_subject_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            <option value="">-- Pilih --</option>
            @foreach($classAssignments as $item)
                <option value="{{ $item->id }}" {{ (isset($assignment) && $assignment->class_room_id == $item->class_room_id && $assignment->subject_id == $item->subject_id) ? 'selected' : '' }}>
                    Kelas {{ $item->classRoom->name }} - {{ $item->subject->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Judul Tugas</label>
        <input type="text" name="title" id="title" value="{{ old('title', $assignment->title ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
        <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $assignment->description ?? '') }}</textarea>
    </div>
    <div>
        <label for="due_date" class="block text-sm font-medium text-gray-700">Tenggat Waktu</label>
        <input type="date" name="due_date" id="due_date" value="{{ old('due_date', isset($assignment) ? \Carbon\Carbon::parse($assignment->due_date)->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>
</div>
<div class="mt-6 flex justify-end">
    <a href="{{ route('teacher.assignments.index') }}" class="text-gray-600 mr-4">Batal</a>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">{{ isset($assignment) ? 'Perbarui' : 'Simpan' }}</button>
</div>