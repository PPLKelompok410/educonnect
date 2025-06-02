@extends('layouts.app')

@section('title', 'Catatan')

@section('content')

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: white;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            color: #2d3748;
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .header p {
            color: #64748b;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
            font-family: 'Poppins', sans-serif;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .upload-area {
            border: 2px dashed #cbd5e0;
            border-radius: 12px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            background: #fafafa;
        }

        .upload-area:hover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.02);
        }

        .upload-area.dragover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
            transform: scale(1.02);
        }

        .upload-area i {
            font-size: 3rem;
            color: #cbd5e0;
            margin-bottom: 15px;
            transition: color 0.3s ease;
        }

        .upload-area:hover i {
            color: #667eea;
        }

        .upload-area p {
            color: #64748b;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .upload-area small {
            color: #9ca3af;
            font-size: 12px;
        }

        .upload-area input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .image-preview {
            display: none;
            position: relative;
            margin-top: 15px;
        }

        .image-preview img {
            width: 100%;
            max-height: 250px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .remove-image {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .remove-image:hover {
            background: rgba(239, 68, 68, 1);
            transform: scale(1.1);
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 40px;
        }

        .btn {
            flex: 1;
            padding: 14px 24px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: 'Poppins', sans-serif;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        }

        .btn-secondary {
            background: #f8fafc;
            color: #64748b;
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #f1f5f9;
            border-color: #cbd5e0;
            transform: translateY(-1px);
        }

        .error-text {
            color: #ef4444;
            font-size: 12px;
            margin-top: 5px;
            display: block;
            font-weight: 500;
        }

        .success-message,
        .error-message {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .success-message {
            background: #dcfce7;
            color: #166534;
            border-left: 4px solid #22c55e;
        }

        .error-message {
            background: #fef2f2;
            color: #dc2626;
            border-left: 4px solid #ef4444;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 10px;
            }

            .header h1 {
                font-size: 2rem;
            }

            .btn-group {
                flex-direction: column;
            }

            .upload-area {
                padding: 30px 15px;
            }
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, .3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-calendar-plus"></i> Tambah Event</h1>
            <p>Buat event baru dan bagikan dengan peserta</p>
        </div>

        <!-- Success/Error Messages (for Laravel Blade) -->
        @if(session('success'))
        <div class="success-message">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="error-message">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" id="eventForm">
            @csrf

            <div class="form-group">
                <label for="title">
                    <i class="fas fa-tag"></i> Judul Event
                </label>
                <input type="text" id="title" name="title" placeholder="Masukkan judul event yang menarik..." required value="{{ old('title') }}">
                @error('title')
                <span class="error-text"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">
                    <i class="fas fa-align-left"></i> Deskripsi Event
                </label>
                <textarea id="description" name="description" placeholder="Jelaskan detail event, agenda, dan informasi penting lainnya..." required>{{ old('description') }}</textarea>
                @error('description')
                <span class="error-text"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="event_date">
                    <i class="fas fa-calendar"></i> Tanggal Event
                </label>
                <input type="datetime-local" id="event_date" name="event_date" required value="{{ old('event_date') }}">
                @error('event_date')
                <span class="error-text"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>
                    <i class="fas fa-image"></i> Foto Event
                </label>
                <div class="upload-area" id="uploadArea">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p><strong>Klik untuk upload</strong> atau drag & drop foto di sini</p>
                    <small>Maksimal 5MB - Format: JPG, PNG, GIF</small>
                    <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/gif">
                </div>
                <div class="image-preview" id="imagePreview">
                    <img id="previewImg" src="" alt="Preview">
                    <button type="button" class="remove-image" onclick="removeImage()" title="Hapus gambar">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @error('image')
                <span class="error-text"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                @enderror
            </div>

            <div class="btn-group">
                <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Batal
                </a>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save"></i>
                    <span id="submitText">Simpan Event</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const eventForm = document.getElementById('eventForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');

        //Drag and drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFile(files[0]);
            }
        });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFile(e.target.files[0]);
            }
        });

        function handleFile(file) {
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                alert('Format file tidak didukung. Gunakan JPG, PNG, atau GIF.');
                return;
            }

            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 5MB.');
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
                uploadArea.style.display = 'none';
            };
            reader.readAsDataURL(file);

            const dt = new DataTransfer();
            dt.items.add(file);
            fileInput.files = dt.files;
        }

        function removeImage() {
            fileInput.value = '';
            imagePreview.style.display = 'none';
            uploadArea.style.display = 'block';
            previewImg.src = '';
        }

        const now = new Date();
        const offset = now.getTimezoneOffset() * 60000;
        const localISOTime = (new Date(now - offset)).toISOString().slice(0, 16);
        document.getElementById('event_date').min = localISOTime;

        eventForm.addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            const description = document.getElementById('description').value.trim();
            const eventDate = document.getElementById('event_date').value;

            if (!title || !description || !eventDate) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang diperlukan');
                return;
            }

            if (new Date(eventDate) < new Date()) {
                e.preventDefault();
                alert('Tanggal event tidak boleh di masa lalu');
                return;
            }

            submitBtn.disabled = true;
            submitText.innerHTML = '<span class="loading"></span> Menyimpan...';
        });

        const textarea = document.getElementById('description');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>

@endsection