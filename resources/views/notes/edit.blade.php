@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Catatan</h1>
    
    {{-- Tampilkan pesan error jika ada --}}
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Tampilkan pesan sukses jika ada --}}
    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('notes.update', $note->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Catatan</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul', $note->judul) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" placeholder="Tambahkan deskripsi catatan..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">{{ old('deskripsi', $note->deskripsi) }}</textarea>
        </div>

        {{-- Existing Files Section --}}
        @if($note->files->isNotEmpty())
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">File yang Sudah Diupload</label>
            <div id="existingFiles" class="space-y-3 mb-4">
                @foreach($note->files as $file)
                <div class="existing-file-item bg-white border border-gray-200 rounded-lg p-3 flex items-center justify-between shadow-sm" data-file-id="{{ $file->id }}">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            @if(Str::endsWith(strtolower($file->file_path), ['.jpg', '.jpeg', '.png']))
                                <img src="{{ asset($file->file_path) }}" alt="{{ $file->original_name }}" 
                                     class="w-16 h-16 object-cover rounded border cursor-pointer hover:opacity-80 transition-opacity"
                                     onclick="openImageModal('{{ asset($file->file_path) }}', '{{ $file->original_name }}')">
                            @elseif(Str::endsWith(strtolower($file->file_path), '.pdf'))
                                <div class="w-16 h-16 bg-red-100 rounded flex items-center justify-center">
                                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $file->original_name }}</p>
                            <p class="text-xs text-gray-500">{{ $file->file_size }} • {{ strtoupper($file->file_type) }}</p>
                            <p class="text-xs text-gray-400">Diupload: {{ $file->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        @if(in_array($file->file_type, ['jpg', 'jpeg', 'png', 'gif']))
                            <button type="button" onclick="openImageModal('{{ asset($file->file_path) }}', '{{ $file->original_name }}')"
                                class="text-blue-600 hover:text-blue-800 transition-colors duration-200 p-1" title="Lihat gambar">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        @endif
                        <a href="{{ asset($file->file_path) }}" download="{{ $file->original_name }}"
                           class="text-green-600 hover:text-green-800 transition-colors duration-200 p-1" title="Download">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </a>
                        <button type="button" onclick="deleteExistingFile({{ $file->id }}, this)"
                            class="text-red-600 hover:text-red-800 transition-colors duration-200 p-1" title="Hapus file">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- New Files Upload Section --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Upload File Baru (Foto/PDF)</label>
            
            {{-- Drop Zone --}}
            <div id="dropZone" class="relative border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-400 transition-colors duration-200 bg-gray-50">
                <div id="dropZoneContent">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Drag dan drop files di sini</h3>
                    <p class="text-sm text-gray-600 mb-4">atau klik untuk memilih files</p>
                    <p class="text-xs text-gray-500">Mendukung: JPG, PNG, GIF, PDF (Max: 10MB per file)</p>
                </div>
                
                <input type="file" id="fileInput" name="new_files[]" multiple accept=".jpg,.jpeg,.png,.gif,.pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
            </div>

            {{-- New File Preview Area --}}
            <div id="filePreview" class="mt-4 space-y-3"></div>
            
            {{-- Add More Files Button --}}
            <button type="button" id="addMoreFiles" class="mt-3 inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" style="display: none;">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah File Lagi
            </button>
        </div>

        {{-- Hidden input for deleted files --}}
    <input type="hidden" name="deleted_files" id="deletedFiles" value="[]"> <div class="flex gap-3">

        <div class="flex gap-3">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full text-sm font-medium shadow transition-colors duration-200">
                Update Catatan
            </button>
            <a href="{{ route('notes.show', [$note->matkul_id, $note->id]) }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-full text-sm font-medium shadow transition-colors duration-200">
                Batal
            </a>
        </div>
    </form>
</div>

{{-- Image Modal --}}
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="max-w-4xl max-h-screen p-4">
        <div class="relative">
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain">
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <p id="modalTitle" class="text-white text-center mt-4 font-medium"></p>
    </div>
</div>

<style>
.file-item, .existing-file-item {
    transition: all 0.3s ease;
}
.file-item:hover, .existing-file-item:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}
.drag-over {
    border-color: #3b82f6 !important;
    background-color: #eff6ff !important;
}
.file-preview-image {
    max-width: 60px;
    max-height: 60px;
    object-fit: cover;
}
.fade-out {
    opacity: 0;
    transform: translateX(20px);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const filePreview = document.getElementById('filePreview');
    const addMoreBtn = document.getElementById('addMoreFiles');
    const dropZoneContent = document.getElementById('dropZoneContent');
    const deletedFilesInput = document.getElementById('deletedFiles');
    const existingFilesContainer = document.getElementById('existingFiles'); // Dapatkan container file yang sudah ada

    let selectedFiles = []; // Untuk file baru
    let deletedFiles = []; // Untuk ID file yang akan dihapus

    const maxFileSize = 10 * 1024 * 1024; // 10MB
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'application/pdf'];

    // Drag and drop events
    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropZone.classList.add('drag-over');
    });

    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropZone.classList.remove('drag-over');
    });

    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropZone.classList.remove('drag-over');
        const files = Array.from(e.dataTransfer.files);
        handleFiles(files);
    });

    // File input change event
    fileInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        handleFiles(files);
    });

    // Add more files button
    addMoreBtn.addEventListener('click', function() {
        fileInput.click();
    });

    function handleFiles(files) {
        files.forEach(file => {
            if (validateFile(file)) {
                selectedFiles.push(file);
                displayFilePreview(file, selectedFiles.length - 1);
            }
        });
        
        updateFileInput();
        updateDropZone();
    }

    function validateFile(file) {
        if (!allowedTypes.includes(file.type)) {
            alert(`File ${file.name} tidak didukung. Hanya mendukung JPG, PNG, GIF, dan PDF.`);
            return false;
        }
        
        if (file.size > maxFileSize) {
            alert(`File ${file.name} terlalu besar. Maksimal 10MB per file.`);
            return false;
        }
        
        return true;
    }

    function displayFilePreview(file, index) {
        const fileItem = document.createElement('div');
        fileItem.className = 'file-item bg-white border border-gray-200 rounded-lg p-3 flex items-center justify-between shadow-sm';
        
        const fileInfo = document.createElement('div');
        fileInfo.className = 'flex items-center space-x-3';
        
        // File icon or image preview
        const fileIcon = document.createElement('div');
        fileIcon.className = 'flex-shrink-0';
        
        if (file.type.startsWith('image/')) {
            const img = document.createElement('img');
            img.className = 'file-preview-image rounded border cursor-pointer hover:opacity-80 transition-opacity';
            img.src = URL.createObjectURL(file);
            img.onclick = () => openImageModal(img.src, file.name);
            fileIcon.appendChild(img);
        } else if (file.type === 'application/pdf') {
            fileIcon.innerHTML = `
                <div class="w-12 h-12 bg-red-100 rounded flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2012 2.586L15.414 6A2 2016 7.414V16a2 201-2 2H6a2 201-2-2V4zm2 6a1 2011-1h6a1 10 2H7a1 201-1-1zm1 3a1 100 2h6a1 100-2H7z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            `;
        }
        
        const fileDetails = document.createElement('div');
        fileDetails.innerHTML = `
            <p class="text-sm font-medium text-gray-900">${file.name}</p>
            <p class="text-xs text-gray-500">${formatFileSize(file.size)} • ${file.type.split('/')[1].toUpperCase()}</p>
            <p class="text-xs text-blue-600">File baru</p>
        `;
        
        fileInfo.appendChild(fileIcon);
        fileInfo.appendChild(fileDetails);
        
        // Remove button for new files
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'text-red-600 hover:text-red-800 transition-colors duration-200';
        removeBtn.innerHTML = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        `;
        
        removeBtn.addEventListener('click', function() {
            removeNewFile(index); // Fungsi baru untuk menghapus file baru
        });
        
        fileItem.appendChild(fileInfo);
        fileItem.appendChild(removeBtn);
        filePreview.appendChild(fileItem);
    }

    // Fungsi untuk menghapus file baru dari daftar pratinjau
    function removeNewFile(index) {
        if (index >= 0 && index < selectedFiles.length) {
            selectedFiles.splice(index, 1);
            updateFileInput();
            refreshFilePreview(); // Refresh pratinjau file baru
            updateDropZone();
        }
    }

    // Refresh pratinjau file baru
    function refreshFilePreview() {
        filePreview.innerHTML = '';
        selectedFiles.forEach((file, index) => {
            displayFilePreview(file, index);
        });
    }

    function updateFileInput() {
        const dt = new DataTransfer();
        selectedFiles.forEach(file => {
            dt.items.add(file);
        });
        fileInput.files = dt.files;
    }

    function updateDropZone() {
        if (selectedFiles.length > 0) {
            dropZoneContent.style.display = 'none';
            addMoreBtn.style.display = 'inline-flex';
            dropZone.classList.add('border-solid', 'border-gray-200');
            dropZone.classList.remove('border-dashed', 'border-gray-300');
        } else {
            dropZoneContent.style.display = 'block';
            addMoreBtn.style.display = 'none';
            dropZone.classList.remove('border-solid', 'border-gray-200');
            dropZone.classList.add('border-dashed', 'border-gray-300');
        }
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

      window.deleteExistingFile = function(fileId, buttonElement) {
        if (confirm('Apakah Anda yakin ingin menghapus file ini?')) {
            const fileItem = buttonElement.closest('.existing-file-item');
            if (!fileItem) return;

            fileItem.remove(); // Hapus dari tampilan

            // Simpan ID ke array dan update input hidden
            deletedFiles.push(fileId);
            deletedFilesInput.value = JSON.stringify(deletedFiles);
        }
    };

    window.openImageModal = function(src, title) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const modalTitle = document.getElementById('modalTitle');
        
        modalImage.src = src;
        modalTitle.textContent = title;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    };

    window.closeImageModal = function() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    };

    // Close modal when clicking outside
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImageModal();
        }
    });
});
</script>
@endsection