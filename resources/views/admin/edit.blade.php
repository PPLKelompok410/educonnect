<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background: #f8fafc;
            min-height: 100vh;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 600px;
        }

        .form-card { 
            background: white; 
            padding: 40px;
            border-radius: 20px; 
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            position: relative;
            overflow: hidden;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #2563eb;
        }

        h1 { 
            margin-bottom: 30px; 
            color: #2d3748;
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            position: relative;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background:#2563eb;
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: 600;
            color: #4a5568;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: color 0.3s ease;
        }

        .input-wrapper {
            position: relative;
        }

        input { 
            width: 100%; 
            padding: 15px 20px;
            border-radius: 12px; 
            border: 2px solid #e2e8f0;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8fafc;
            font-family: 'Poppins', sans-serif;
        }

        input:focus { 
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        textarea { 
            width: 100%; 
            padding: 15px 20px;
            border-radius: 12px; 
            border: 2px solid #e2e8f0;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8fafc;
            font-family: 'Poppins', sans-serif;
            resize: vertical;
            min-height: 100px;
        }

        textarea:focus { 
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .file-upload-wrapper {
            position: relative;
        }

        .file-upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .file-upload-area:hover {
            border-color: #667eea;
            background: #f0f4ff;
        }

        .file-upload-area.dragover {
            border-color: #667eea;
            background: #e0e7ff;
            transform: scale(1.02);
        }

        .upload-icon {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.6;
        }

        .upload-text {
            font-size: 16px;
            margin-bottom: 8px;
            color: #4a5568;
        }

        .upload-info {
            font-size: 14px;
            color: #718096;
        }

        .current-image {
            margin-top: 15px;
            padding: 15px;
            background: #f7fafc;
            border-radius: 8px;
            text-align: center;
        }

        .input-highlight {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background:#2563eb;
            transform: scaleX(0);
            transition: transform 0.3s ease;
            border-radius: 1px;
        }

        input:focus + .input-highlight,
        textarea:focus + .input-highlight {
            transform: scaleX(1);
        }

        .form-group:focus-within label {
            color: #667eea;
        }

        .btn-container {
            display: flex;
            gap: 15px;
            margin-top: 35px;
        }

        button { 
            flex: 1;
            background: #2563eb;
            color: white; 
            padding: 15px 30px;
            border: none; 
            border-radius: 12px; 
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        button:hover::before {
            left: 100%;
        }

        button:hover { 
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
        }

        button:active {
            transform: translateY(-1px);
        }

        .cancel-btn {
            background: #64748b;
        }

        .cancel-btn:hover {
            background: #475569;
            box-shadow: 0 10px 25px rgba(100, 116, 139, 0.3);
        }

        .form-animation {
            animation: slideInUp 0.6s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #cbd5e1;
            transition: color 0.3s ease;
        }

        .form-group:focus-within .input-icon {
            color: #667eea;
        }

        .error-message {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .success-message {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-card {
                padding: 30px 20px;
                margin: 10px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .btn-container {
                flex-direction: column;
            }
        }

        /* Loading state */
        .loading {
            position: relative;
            pointer-events: none;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-card form-animation">
            <h1>Edit Event</h1>
            
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="error-message">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Success Message -->
            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('admin.update', $event) }}" method="POST" id="editForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title">Judul Event</label>
                    <div class="input-wrapper">
                        <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}" placeholder="Masukkan judul event yang menarik..." required>
                        <div class="input-highlight"></div>
                        <div class="input-icon">📝</div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi Event</label>
                    <div class="input-wrapper">
                        <textarea id="description" name="description" rows="4" placeholder="Jelaskan detail event, agenda, dan informasi penting lainnya..." required>{{ old('description', $event->description) }}</textarea>
                        <div class="input-highlight"></div>
                        <div class="input-icon">📄</div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="event_date">Tanggal Event</label>
                    <div class="input-wrapper">
                        <input type="datetime-local" id="event_date" name="event_date" value="{{ old('event_date', \Carbon\Carbon::parse($event->event_date)->format('Y-m-d\TH:i')) }}" required>
                        <div class="input-highlight"></div>
                        <div class="input-icon">📅</div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="image">Foto Event</label>
                    <div class="file-upload-wrapper">
                        <div class="file-upload-area" id="fileUploadArea">
                            <div class="upload-icon">☁️</div>
                            <div class="upload-text">
                                <strong>Klik untuk upload</strong> atau drag & drop foto di sini
                            </div>
                            <div class="upload-info">Maksimal 5MB - Format: JPG, PNG, GIF</div>
                            <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.gif" style="display: none;">
                        </div>
                        @if($event->image)
                        <div class="current-image">
                            <img src="{{ asset($event->image) }}" alt="Current Event Image" style="max-width: 200px; margin-top: 10px; border-radius: 8px;">
                            <p><small>Foto saat ini</small></p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="btn-container">
                    <button type="button" class="cancel-btn" onclick="goBack()">Batal</button>
                    <button type="submit" id="submitBtn">Update Event</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('editForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.classList.add('loading');
            submitBtn.textContent = 'Mengupdate...';
        });

        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '{{ route("admin.index") }}';
            }
        }

        document.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.length > 0) {
                    this.style.borderColor = '#48bb78';
                } else {
                    this.style.borderColor = '#e2e8f0';
                }
            });

            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        const fileUploadArea = document.getElementById('fileUploadArea');
        const fileInput = document.getElementById('image');

        fileUploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        fileUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadArea.classList.add('dragover');
        });

        fileUploadArea.addEventListener('dragleave', () => {
            fileUploadArea.classList.remove('dragover');
        });

        fileUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                updateFileUploadDisplay(files[0]);
            }
        });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                updateFileUploadDisplay(e.target.files[0]);
            }
        });

        function updateFileUploadDisplay(file) {
            const uploadText = document.querySelector('.upload-text');
            const uploadInfo = document.querySelector('.upload-info');
            
            if (file) {
                uploadText.innerHTML = `<strong>File dipilih:</strong> ${file.name}`;
                uploadInfo.textContent = `Ukuran: ${(file.size / 1024 / 1024).toFixed(2)} MB`;
                
                if (file.size > 5 * 1024 * 1024) {
                    uploadInfo.textContent = 'File terlalu besar! Maksimal 5MB';
                    uploadInfo.style.color = '#e53e3e';
                } else {
                    uploadInfo.style.color = '#718096';
                }
            }
        }

        window.addEventListener('load', function() {
            document.querySelector('.form-card').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'center' 
            });
        });

        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'Enter') {
                document.getElementById('editForm').submit();
            }
            if (e.key === 'Escape') {
                goBack();
            }
        });
    </script>
</body>
</html>