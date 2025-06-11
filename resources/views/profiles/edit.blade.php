<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - EduConnect</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: #334155;
            min-height: 100vh;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 20px rgba(37, 99, 235, 0.3);
        }

        .logo {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo i {
            font-size: 1.8rem;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
        }

        .header-btn {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 25px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .header-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        .header-btn.cancel {
            background: rgba(239, 68, 68, 0.2);
        }

        .header-btn.cancel:hover {
            background: rgba(239, 68, 68, 0.3);
        }

        /* Main Container */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Page Header */
        .page-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-family: 'Open Sans', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            font-size: 1.1rem;
            color: #64748b;
        }

        /* Form Section */
        .profile-form {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f1f5f9;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label .required {
            color: #ef4444;
        }

        .form-input {
            padding: 0.875rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-input:focus {
            outline: none;
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-input:disabled {
            background: #f1f5f9;
            color: #64748b;
            cursor: not-allowed;
        }

        .form-textarea {
            padding: 0.875rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            background: #f8fafc;
            resize: vertical;
            min-height: 120px;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .char-count {
            font-size: 0.8rem;
            color: #64748b;
            text-align: right;
            margin-top: 0.25rem;
        }

        .form-help {
            font-size: 0.8rem;
            color: #64748b;
            margin-top: 0.25rem;
        }

        /* Buttons */
        .btn-container {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #f1f5f9;
        }

        .btn {
            padding: 0.875rem 2rem;
            border: none;
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
        }

        .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
        }

        .btn-secondary {
            background: #f8fafc;
            color: #64748b;
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }

        .btn-danger {
            background: #f8fafc;
            color: #ef4444;
            border: 2px solid #fecaca;
        }

        .btn-danger:hover {
            background: #fef2f2;
            border-color: #fca5a5;
        }

        /* Success/Error Messages */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: none;
            align-items: center;
            gap: 0.75rem;
            animation: slideDown 0.5s ease;
        }

        .alert.show {
            display: flex;
        }

        .alert-success {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
            border: 2px solid #86efac;
        }

        .alert-error {
            background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
            color: #dc2626;
            border: 2px solid #fca5a5;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Loading State */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .btn.loading {
            background: #94a3b8;
            cursor: not-allowed;
        }

        .btn.loading::after {
            content: '';
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-left: 0.5rem;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .header-actions {
                flex-direction: column;
                gap: 0.5rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .btn-container {
                flex-direction: column;
            }
        }

        /* Tooltip */
        .tooltip {
            position: relative;
            cursor: help;
        }

        .tooltip::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: #1e293b;
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            font-size: 0.8rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .tooltip:hover::after {
            opacity: 1;
            visibility: visible;
            bottom: calc(100% + 5px);
        }
    </style>
</head>
<body>
@extends('layouts.app')

@section('content')

    <!-- Main Container -->
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Edit Profile</h1>
            <p class="page-subtitle">Perbarui informasi pribadi Anda</p>
        </div>

        <!-- Profile Form -->
        <div class="profile-form">
            <!-- Success/Error Messages -->
            <div class="alert alert-success" id="successAlert">
                <i class="fas fa-check-circle"></i>
                <span>Profile berhasil diperbarui!</span>
            </div>

            <div class="alert alert-error" id="errorAlert">
                <i class="fas fa-exclamation-circle"></i>
                <span id="errorMessage">Terjadi kesalahan. Silakan coba lagi.</span>
            </div>

            <form id="profileForm" action="{{ route('profiles.update', $profile->id) }}" method="POST">

                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-user"></i>
                        Informasi Dasar
                    </h3>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-user"></i>
                                Nama Lengkap
                                <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-input" 
                                name="full_name"
                                id="full_name"
                                value="{{ old('full_name', $user->full_name ?? '') }}"
                                required
                            >
                            @error('full_name')
                                <div class="form-help" style="color: #ef4444;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label tooltip" data-tooltip="Email tidak dapat diubah">
                                <i class="fas fa-envelope"></i>
                                Email
                                <i class="fas fa-info-circle" style="color: #64748b; font-size: 0.8rem;"></i>
                            </label>
                            <input 
                                type="email" 
                                class="form-input" 
                                value="{{ $user->email ?? '' }}"
                                disabled
                            >
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-address-book"></i>
                        Informasi Kontak
                    </h3>
                    
                    <div class="form-group full width">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-phone"></i>
                                Nomor Telepon
                            </label>
                            <input 
                                type="tel" 
                                class="form-input" 
                                name="phone_number"
                                id="phone_number"
                                placeholder="Contoh: +62 812-3456-7890"
                                value="{{ old('phone_number', $user->phone_number ?? '') }}"
                            >
                            @error('phone_number')
                                <div class="form-help" style="color: #ef4444;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label">
                                <i class="fas fa-home"></i>
                                Alamat Lengkap
                            </label>
                            <input 
                                type="text" 
                                class="form-input" 
                                name="address"
                                id="address"
                                placeholder="Masukkan alamat lengkap Anda"
                                value="{{ old('address', $user->address ?? '') }}"
                            >
                            @error('address')
                                <div class="form-help" style="color: #ef4444;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-user-circle"></i>
                        Informasi Personal
                    </h3>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-quote-left"></i>
                            Bio
                        </label>
                        <textarea 
                            class="form-textarea" 
                            name="bio"
                            id="bio"
                            placeholder="Ceritakan sedikit tentang diri Anda, minat, dan tujuan belajar..."
                            oninput="updateCharCount(this)"
                            maxlength="500"
                        >{{ old('bio', $user->bio ?? '') }}</textarea>
                        <div class="char-count">
                            <span id="charCount">0</span>/500 karakter
                        </div>
                        @error('bio')
                            <div class="form-help" style="color: #ef4444;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="btn-container">
                    <button type="button" class="btn btn-danger" onclick="resetForm()">
                        <i class="fas fa-undo"></i>
                        Reset
                    </button>
                    <a href="{{ route('profiles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary" id="saveBtn">
                        <i class="fas fa-save"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Initialize character count
        document.addEventListener('DOMContentLoaded', function() {
            const bioTextarea = document.getElementById('bio');
            updateCharCount(bioTextarea);
            
            // Load any existing alerts
            @if(session('success'))
                showAlert('success', '{{ session('success') }}');
            @endif
            
            @if(session('error'))
                showAlert('error', '{{ session('error') }}');
            @endif
        });

        // Update character count
        function updateCharCount(textarea) {
            const charCount = document.getElementById('charCount');
            const currentLength = textarea.value.length;
            charCount.textContent = currentLength;
            
            if (currentLength > 400) {
                charCount.style.color = '#ef4444';
            } else if (currentLength > 300) {
                charCount.style.color = '#f59e0b';
            } else {
                charCount.style.color = '#64748b';
            }
        }

        // Show alert messages
        function showAlert(type, message) {
            const alertId = type === 'success' ? 'successAlert' : 'errorAlert';
            const alert = document.getElementById(alertId);
            
            if (type === 'error') {
                document.getElementById('errorMessage').textContent = message;
            }
            
            alert.classList.add('show');
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                alert.classList.remove('show');
            }, 5000);
            
            // Scroll to top to show the alert
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Form submission
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            const saveBtn = document.getElementById('saveBtn');
            const form = document.getElementById('profileForm');
            
            // Add loading state
            saveBtn.classList.add('loading');
            saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            saveBtn.disabled = true;
            form.classList.add('loading');
        });

        // Reset form
        function resetForm() {
            if (confirm('Apakah Anda yakin ingin mereset semua perubahan?')) {
                document.getElementById('profileForm').reset();
                
                // Reset to original values
                document.getElementById('full_name').value = '{{ session("user")->full_name ?? "" }}';
                document.getElementById('phone_number').value = '{{ session("user")->phone_number ?? "" }}';
                document.getElementById('address').value = '{{ session("user")->address ?? "" }}';
                document.getElementById('bio').value = '{{ session("user")->bio ?? "" }}';
                
                const bioTextarea = document.getElementById('bio');
                updateCharCount(bioTextarea);
                
                showAlert('success', 'Form berhasil direset!');
            }
        }

        // Auto-save draft functionality
        let autoSaveTimeout;
        function autoSaveDraft() {
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(() => {
                const formData = {};
                document.querySelectorAll('[name]').forEach(input => {
                    formData[input.name] = input.value;
                });
                localStorage.setItem('profileEditDraft', JSON.stringify(formData));

                localStorage.setItem('profileEditDraft', JSON.stringify(formData));
                console.log('Draft saved automatically');
            }, 2000);
        }

        // Add auto-save to all inputs
        document.querySelectorAll('.form-input:not([disabled]), .form-textarea').forEach(input => {
            input.addEventListener('input', autoSaveDraft);
        });

        // Load draft on page load
        window.addEventListener('load', function() {
            const draft = localStorage.getItem('profileEditDraft');
            if (draft) {
                const data = JSON.parse(draft);
                let hasChanges = false;
                
                Object.keys(data).forEach(key => {
                    const element = document.getElementById(key);
                    if (element && data[key] && data[key] !== element.value) {
                        hasChanges = true;
                    }
                });
                
                if (hasChanges && confirm('Ditemukan draft yang belum disimpan. Apakah Anda ingin memulihkannya?')) {
                    Object.keys(data).forEach(key => {
                        const element = document.getElementById(key);
                        if (element && data[key]) {
                            element.value = data[key];
                            if (key === 'bio') {
                                updateCharCount(element);
                            }
                        }
                    });
                }
            }
        });

        // Clear draft when form is successfully submitted
        window.addEventListener('beforeunload', function() {
            // Only clear if we're navigating away after a successful save
            if (document.querySelector('.alert-success.show')) {
                localStorage.removeItem('profileEditDraft');
            }
        });

        // Form validation
        function validateForm() {
            const fullName = document.getElementById('fullName').value.trim();
            const phone = document.getElementById('phone_number').value.trim();
            
            if (!fullName) {
                showAlert('error', 'Nama lengkap harus diisi!');
                document.getElementById('fullName').focus();
                return false;
            }
            
            return true;
        }

        // Add validation to form submit
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
                return false;
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl+S to save
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                if (validateForm()) {
                    document.getElementById('profileForm').submit();
                }
            }
            
            // Escape to cancel
            if (e.key === 'Escape') {
                if (confirm('Apakah Anda yakin ingin membatalkan perubahan?')) {
                    window.location.href = '{{ route("profiles.index") }}';
                }
            }
        });
    </script>
@endsection
</body>
</html>