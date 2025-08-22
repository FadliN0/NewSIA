{{-- resources/views/admin/classes/create.blade.php --}}
<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ route('admin.classes.index') }}" 
                   class="mr-4 text-charcoal/60 hover:text-charcoal transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-charcoal leading-tight">{{ __('Tambah Kelas Baru') }}</h2>
            </div>
            <span class="px-3 py-1 text-xs bg-pale-green text-teal-dark rounded-full font-medium">Form Input</span>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <form method="POST" action="{{ route('admin.classes.store') }}" class="p-6">
                    @csrf

                    <!-- Class Name -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-charcoal mb-2">
                            Nama Kelas <span class="text-brick-red">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-teal-dark focus:border-teal-dark @error('name') border-brick-red @enderror"
                               placeholder="Contoh: 10A, 11B, 12C"
                               maxlength="10"
                               required>
                        @error('name')
                            <p class="mt-2 text-sm text-brick-red">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-charcoal/60">Format: [Tingkat][Kelas] seperti 10A, 11B, 12C</p>
                    </div>

                    <!-- Grade Level -->
                    <div class="mb-6">
                        <label for="grade_level" class="block text-sm font-medium text-charcoal mb-2">
                            Tingkat Kelas <span class="text-brick-red">*</span>
                        </label>
                        <select id="grade_level" 
                                name="grade_level" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-teal-dark focus:border-teal-dark @error('grade_level') border-brick-red @enderror"
                                required>
                            <option value="">Pilih Tingkat Kelas</option>
                            <option value="10" {{ old('grade_level') == '10' ? 'selected' : '' }}>Kelas 10 (X)</option>
                            <option value="11" {{ old('grade_level') == '11' ? 'selected' : '' }}>Kelas 11 (XI)</option>
                            <option value="12" {{ old('grade_level') == '12' ? 'selected' : '' }}>Kelas 12 (XII)</option>
                        </select>
                        @error('grade_level')
                            <p class="mt-2 text-sm text-brick-red">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Capacity -->
                    <div class="mb-6">
                        <label for="capacity" class="block text-sm font-medium text-charcoal mb-2">
                            Kapasitas Siswa <span class="text-brick-red">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" 
                                   id="capacity" 
                                   name="capacity" 
                                   value="{{ old('capacity', 30) }}" 
                                   min="1" 
                                   max="50"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-teal-dark focus:border-teal-dark @error('capacity') border-brick-red @enderror"
                                   required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-charcoal/50 text-sm">siswa</span>
                            </div>
                        </div>
                        @error('capacity')
                            <p class="mt-2 text-sm text-brick-red">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-charcoal/60">Jumlah maksimal siswa yang dapat diterima di kelas ini (1-50)</p>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-charcoal mb-2">
                            Deskripsi <span class="text-charcoal/50">(Opsional)</span>
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-teal-dark focus:border-teal-dark @error('description') border-brick-red @enderror"
                                  placeholder="Deskripsi singkat tentang kelas ini...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-brick-red">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-charcoal/60">Deskripsi tambahan tentang kelas (maksimal 255 karakter)</p>
                    </div>

                    <!-- Preview Card -->
                    <div class="mb-6 p-4 bg-pale-green rounded-lg border border-teal-dark/20">
                        <h4 class="text-sm font-medium text-teal-dark mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Preview Kelas
                        </h4>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-12 h-12 bg-teal-dark/10 rounded-lg flex items-center justify-center">
                                <span id="preview-icon" class="text-sm font-bold text-teal-dark">--</span>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h5 id="preview-name" class="text-sm font-medium text-charcoal">Nama Kelas</h5>
                                        <p id="preview-info" class="text-xs text-charcoal/60">Informasi kelas</p>
                                    </div>
                                    <span id="preview-badge" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-dark/10 text-teal-dark">
                                        Tingkat
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.classes.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-charcoal uppercase tracking-widest hover:bg-gray-50 focus:bg-gray-50 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batal
                        </a>

                        <button type="submit" 
                                class="inline-flex items-center px-6 py-2 bg-lime-accent border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-lime-accent/80 focus:bg-lime-accent/80 active:bg-lime-accent/90 focus:outline-none focus:ring-2 focus:ring-lime-accent/50 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Kelas
                        </button>
                    </div>
                </form>
            </div>

            <!-- Help Card -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-charcoal mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-teal-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Panduan Penamaan Kelas
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center p-4 bg-pale-green rounded-lg">
                            <h4 class="font-medium text-teal-dark mb-2">Kelas 10 (X)</h4>
                            <p class="text-sm text-charcoal/60">10A, 10B, 10C, dst.</p>
                        </div>
                        <div class="text-center p-4 bg-pale-green rounded-lg">
                            <h4 class="font-medium text-teal-dark mb-2">Kelas 11 (XI)</h4>
                            <p class="text-sm text-charcoal/60">11A, 11B, 11C, dst.</p>
                        </div>
                        <div class="text-center p-4 bg-pale-green rounded-lg">
                            <h4 class="font-medium text-teal-dark mb-2">Kelas 12 (XII)</h4>
                            <p class="text-sm text-charcoal/60">12A, 12B, 12C, dst.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Update Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('name');
            const gradeSelect = document.getElementById('grade_level');
            const capacityInput = document.getElementById('capacity');
            const descriptionInput = document.getElementById('description');
            
            const previewIcon = document.getElementById('preview-icon');
            const previewName = document.getElementById('preview-name');
            const previewInfo = document.getElementById('preview-info');
            const previewBadge = document.getElementById('preview-badge');

            function updatePreview() {
                const name = nameInput.value || 'Nama Kelas';
                const grade = gradeSelect.value;
                const capacity = capacityInput.value || '0';
                const description = descriptionInput.value;

                // Update icon
                previewIcon.textContent = name.length >= 2 ? name.substring(0, 2) : '--';

                // Update name
                previewName.textContent = name;

                // Update info
                let info = `Kapasitas: ${capacity} siswa`;
                if (description) {
                    info += ` • ${description.substring(0, 30)}${description.length > 30 ? '...' : ''}`;
                }
                previewInfo.textContent = info;

                // Update badge
                if (grade) {
                    previewBadge.textContent = `Kelas ${grade}`;
                    previewBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-dark/10 text-teal-dark';
                } else {
                    previewBadge.textContent = 'Tingkat';
                    previewBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-charcoal/60';
                }
            }

            // Add event listeners
            nameInput.addEventListener('input', updatePreview);
            gradeSelect.addEventListener('change', updatePreview);
            capacityInput.addEventListener('input', updatePreview);
            descriptionInput.addEventListener('input', updatePreview);

            // Initial preview update
            updatePreview();
        });
    </script>
</x-admin-layout>