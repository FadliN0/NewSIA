{{-- resources/views/admin/classes/create.blade.php --}}
<x-admin-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-admin-primary to-admin-accent p-6 rounded-lg shadow-sm">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.classes.index') }}" 
                       class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center hover:bg-white/30 transition-all duration-200 backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h2 class="font-bold text-2xl text-white leading-tight">{{ __('Tambah Kelas Baru') }}</h2>
                        <p class="text-white/80 text-sm">Buat kelas baru untuk sistem akademik</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <span class="text-white/90 text-sm font-medium">Form Input</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-admin-bg min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border-0">
                        <div class="bg-gradient-to-r from-admin-primary/5 to-admin-accent/5 px-6 py-4 border-b border-admin-primary/10">
                            <h3 class="text-lg font-bold text-admin-primary flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Informasi Kelas
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">Lengkapi form di bawah untuk membuat kelas baru</p>
                        </div>

                        <form method="POST" action="{{ route('admin.classes.store') }}" class="p-6 space-y-6">
                            @csrf

                            <!-- Class Name -->
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-bold text-admin-primary">
                                    Nama Kelas <span class="text-error">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           class="w-full px-4 py-3 pl-11 border border-gray-200 rounded-xl focus:ring-2 focus:ring-admin-accent/20 focus:border-admin-accent transition-all duration-200 @error('name') border-error ring-2 ring-error/20 @enderror"
                                           placeholder="Contoh: 10A, 11B, 12C"
                                           maxlength="10"
                                           required>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l4-2 4 2 4-2z"/>
                                        </svg>
                                    </div>
                                </div>
                                @error('name')
                                    <div class="flex items-center space-x-2 text-error">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-sm">{{ $message }}</span>
                                    </div>
                                @enderror
                                <p class="text-xs text-gray-500 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Format: [Tingkat][Kelas] seperti 10A, 11B, 12C
                                </p>
                            </div>

                            <!-- Grade Level -->
                            <div class="space-y-2">
                                <label for="grade_level" class="block text-sm font-bold text-admin-primary">
                                    Tingkat Kelas <span class="text-error">*</span>
                                </label>
                                <div class="relative">
                                    <select id="grade_level" 
                                            name="grade_level" 
                                            class="w-full px-4 py-3 pl-11 border border-gray-200 rounded-xl focus:ring-2 focus:ring-admin-accent/20 focus:border-admin-accent transition-all duration-200 @error('grade_level') border-error ring-2 ring-error/20 @enderror appearance-none bg-white"
                                            required>
                                        <option value="">Pilih Tingkat Kelas</option>
                                        <option value="10" {{ old('grade_level') == '10' ? 'selected' : '' }}>Kelas 10 (X)</option>
                                        <option value="11" {{ old('grade_level') == '11' ? 'selected' : '' }}>Kelas 11 (XI)</option>
                                        <option value="12" {{ old('grade_level') == '12' ? 'selected' : '' }}>Kelas 12 (XII)</option>
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                                @error('grade_level')
                                    <div class="flex items-center space-x-2 text-error">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-sm">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <!-- Capacity -->
                            <div class="space-y-2">
                                <label for="capacity" class="block text-sm font-bold text-admin-primary">
                                    Kapasitas Siswa <span class="text-error">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number" 
                                           id="capacity" 
                                           name="capacity" 
                                           value="{{ old('capacity', 30) }}" 
                                           min="1" 
                                           max="50"
                                           class="w-full px-4 py-3 pl-11 pr-16 border border-gray-200 rounded-xl focus:ring-2 focus:ring-admin-accent/20 focus:border-admin-accent transition-all duration-200 @error('capacity') border-error ring-2 ring-error/20 @enderror"
                                           required>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20a3 3 0 01-3-3v-2a3 3 0 013-3h1m0 0a3 3 0 106 0m-3 0a3 3 0 106 0m0 0a3 3 0 013 3v2a3 3 0 01-3 3H7"/>
                                        </svg>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 text-sm font-medium">siswa</span>
                                    </div>
                                </div>
                                @error('capacity')
                                    <div class="flex items-center space-x-2 text-error">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-sm">{{ $message }}</span>
                                    </div>
                                @enderror
                                <p class="text-xs text-gray-500 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Jumlah maksimal siswa yang dapat diterima di kelas ini (1-50)
                                </p>
                            </div>

                            <!-- Description -->
                            <div class="space-y-2">
                                <label for="description" class="block text-sm font-bold text-admin-primary">
                                    Deskripsi <span class="text-gray-500 font-normal">(Opsional)</span>
                                </label>
                                <textarea id="description" 
                                          name="description" 
                                          rows="4"
                                          class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-admin-accent/20 focus:border-admin-accent transition-all duration-200 @error('description') border-error ring-2 ring-error/20 @enderror resize-none"
                                          placeholder="Deskripsi singkat tentang kelas ini...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="flex items-center space-x-2 text-error">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-sm">{{ $message }}</span>
                                    </div>
                                @enderror
                                <p class="text-xs text-gray-500">Deskripsi tambahan tentang kelas (maksimal 255 karakter)</p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                                <a href="{{ route('admin.classes.index') }}" 
                                   class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-200 rounded-xl font-bold text-sm text-gray-700 uppercase tracking-wide hover:bg-gray-50 hover:border-gray-300 focus:bg-gray-50 active:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Batal
                                </a>

                                <button type="submit" 
                                        class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-admin-primary to-admin-accent border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-wide hover:from-admin-primary/90 hover:to-admin-accent/90 focus:from-admin-primary/90 focus:to-admin-accent/90 active:from-admin-primary/80 active:to-admin-accent/80 focus:outline-none focus:ring-2 focus:ring-admin-accent/50 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Simpan Kelas
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Preview Card -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border-0">
                        <div class="bg-gradient-to-r from-admin-accent/10 to-admin-primary/10 px-6 py-4 border-b border-admin-accent/20">
                            <h4 class="text-lg font-bold text-admin-primary flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Live Preview
                            </h4>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-admin-bg to-white rounded-xl border border-admin-primary/10">
                                <div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-admin-primary to-admin-accent rounded-xl flex items-center justify-center shadow-lg">
                                    <span id="preview-icon" class="text-lg font-bold text-white">--</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <h5 id="preview-name" class="text-lg font-bold text-admin-primary">Nama Kelas</h5>
                                        <span id="preview-badge" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600">
                                            Tingkat
                                        </span>
                                    </div>
                                    <p id="preview-info" class="text-sm text-gray-600">Informasi kelas akan muncul di sini</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Help Guide -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border-0">
                        <div class="bg-gradient-to-r from-admin-primary/5 to-admin-accent/5 px-6 py-4 border-b border-admin-primary/10">
                            <h3 class="text-lg font-bold text-admin-primary flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Panduan Penamaan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="p-4 bg-gradient-to-r from-admin-primary/5 to-admin-accent/5 rounded-xl border border-admin-primary/10">
                                    <h4 class="font-bold text-admin-primary mb-2 flex items-center">
                                        <span class="w-6 h-6 bg-admin-primary text-white rounded-full flex items-center justify-center text-xs font-bold mr-2">10</span>
                                        Kelas 10 (X)
                                    </h4>
                                    <p class="text-sm text-gray-600">10A, 10B, 10C, dst.</p>
                                </div>
                                <div class="p-4 bg-gradient-to-r from-admin-primary/5 to-admin-accent/5 rounded-xl border border-admin-primary/10">
                                    <h4 class="font-bold text-admin-primary mb-2 flex items-center">
                                        <span class="w-6 h-6 bg-admin-accent text-white rounded-full flex items-center justify-center text-xs font-bold mr-2">11</span>
                                        Kelas 11 (XI)
                                    </h4>
                                    <p class="text-sm text-gray-600">11A, 11B, 11C, dst.</p>
                                </div>
                                <div class="p-4 bg-gradient-to-r from-admin-primary/5 to-admin-accent/5 rounded-xl border border-admin-primary/10">
                                    <h4 class="font-bold text-admin-primary mb-2 flex items-center">
                                        <span class="w-6 h-6 bg-success text-white rounded-full flex items-center justify-center text-xs font-bold mr-2">12</span>
                                        Kelas 12 (XII)
                                    </h4>
                                    <p class="text-sm text-gray-600">12A, 12B, 12C, dst.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tips Card -->
                    <div class="bg-gradient-to-r from-admin-accent/10 to-admin-primary/10 rounded-xl border border-admin-accent/20 p-6">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-8 h-8 bg-admin-accent rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-admin-primary mb-1">Tips Sukses</h4>
                                <p class="text-xs text-gray-600">Gunakan nama kelas yang konsisten dan mudah dipahami. Kapasitas standar per kelas adalah 30-35 siswa.</p>
                            </div>
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

                // Update icon with gradient effect
                previewIcon.textContent = name.length >= 2 ? name.substring(0, 2).toUpperCase() : '--';

                // Update name
                previewName.textContent = name;

                // Update info
                let info = `Kapasitas: ${capacity} siswa`;
                if (description) {
                    info += ` • ${description.substring(0, 30)}${description.length > 30 ? '...' : ''}`;
                }
                previewInfo.textContent = info;

                // Update badge with admin colors
                if (grade) {
                    previewBadge.textContent = `Kelas ${grade}`;
                    previewBadge.className = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-admin-primary to-admin-accent text-white shadow-md';
                } else {
                    previewBadge.textContent = 'Tingkat';
                    previewBadge.className = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600';
                }
            }

            // Add event listeners with debouncing for better performance
            let updateTimeout;
            function debouncedUpdate() {
                clearTimeout(updateTimeout);
                updateTimeout = setTimeout(updatePreview, 100);
            }

            nameInput.addEventListener('input', debouncedUpdate);
            gradeSelect.addEventListener('change', updatePreview);
            capacityInput.addEventListener('input', debouncedUpdate);
            descriptionInput.addEventListener('input', debouncedUpdate);

            // Initial preview update
            updatePreview();

            // Form validation enhancements
            const form = nameInput.closest('form');
            form.addEventListener('submit', function(e) {
                let isValid = true;
                
                // Add custom validation feedback
                const requiredInputs = form.querySelectorAll('[required]');
                requiredInputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.classList.add('border-error', 'ring-2', 'ring-error/20');
                    } else {
                        input.classList.remove('border-error', 'ring-2', 'ring-error/20');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    // Scroll to first error
                    const firstError = form.querySelector('.border-error');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstError.focus();
                    }
                }
            });
        });
    </script>

    <!-- Enhanced Styles -->
    <style>
        /* Custom scrollbar for textarea */
        textarea::-webkit-scrollbar {
            width: 6px;
        }
        
        textarea::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }
        
        textarea::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        
        textarea::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Smooth transitions for form elements */
        input, select, textarea {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Enhanced focus styles */
        input:focus, select:focus, textarea:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Button hover effects */
        button:hover, a:hover {
            transform: translateY(-1px);
        }

        /* Preview animation */
        #preview-icon {
            transition: all 0.3s ease;
        }
        
        /* Loading animation for form submission */
        .form-loading {
            pointer-events: none;
            opacity: 0.7;
        }
        
        .form-loading button {
            cursor: not-allowed;
        }
    </style>
</x-admin-layout>