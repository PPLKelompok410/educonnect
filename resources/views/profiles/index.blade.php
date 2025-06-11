<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - EduConnect</title>
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
            background: #ffffff;
            color: #334155;
            min-height: 100vh;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            color: #1e293b;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            border-radius: 20px;
            margin: 0 2rem 2rem 2rem;
        }

        .logo {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #2563eb;
        }

        .logo i {
            font-size: 1.8rem;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
        }

        .header-btn {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 50px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .header-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
        }

        .header-btn.secondary {
            background: rgba(148, 163, 184, 0.1);
            color: #64748b;
            backdrop-filter: blur(10px);
        }

        .header-btn.secondary:hover {
            background: rgba(148, 163, 184, 0.2);
        }

        /* Main Container */
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Profile Card */
        .profile-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Profile Header */
        .profile-header {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            padding: 3rem 2rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="20" cy="60" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="30" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 3rem;
            color: white;
            position: relative;
            z-index: 1;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            border: 4px solid rgba(255, 255, 255, 0.2);
        }

        .profile-name {
            font-family: 'Open Sans', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .profile-email {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        /* Profile Content */
        .profile-content {
            padding: 2.5rem 2rem;
        }

        .info-section {
            margin-bottom: 2.5rem;
        }

        .section-title {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.4rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 3px solid #f1f5f9;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border-radius: 3px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .info-item {
            background: #f8fafc;
            border-radius: 16px;
            padding: 1.5rem;
            border-left: 4px solid #2563eb;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .info-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            background: #f1f5f9;
        }

        .info-item::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            opacity: 0.1;
            border-radius: 50%;
            transform: translate(20px, -20px);
        }

        .info-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-value {
            font-size: 1.1rem;
            color: #1e293b;
            font-weight: 500;
            line-height: 1.4;
            position: relative;
            z-index: 1;
        }

        .info-value.empty {
            color: #94a3b8;
            font-style: italic;
        }

        .bio-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid #e2e8f0;
        }

        .bio-content {
            font-size: 1.05rem;
            line-height: 1.6;
            color: #475569;
            text-align: justify;
        }

        .bio-content.empty {
            color: #94a3b8;
            font-style: italic;
            text-align: center;
            padding: 2rem;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 2px solid #f1f5f9;
        }

        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
        }

        .btn-secondary {
            background: rgba(148, 163, 184, 0.1);
            color: #64748b;
            border: 2px solid #e2e8f0;
            backdrop-filter: blur(10px);
        }

        .btn-secondary:hover {
            background: rgba(148, 163, 184, 0.2);
            border-color: #cbd5e1;
            transform: translateY(-2px);
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        .status-complete {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
            border: 1px solid #86efac;
        }

        .status-incomplete {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
            border: 1px solid #fbbf24;
        }

        /* Alert Messages */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            display: none;
            align-items: center;
            gap: 0.75rem;
            animation: slideDown 0.5s ease;
            backdrop-filter: blur(10px);
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

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 1rem 0;
            }

            .container {
                padding: 0 1rem;
            }

            .header {
                margin: 0 1rem 1rem 1rem;
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }

            .header-actions {
                width: 100%;
                justify-content: center;
            }

            .profile-header {
                padding: 2rem 1rem 1.5rem;
            }

            .profile-name {
                font-size: 2rem;
            }

            .profile-content {
                padding: 2rem 1rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
        }

        /* Animations */
        .profile-card {
            animation: fadeInUp 0.8s ease;
        }

        .info-item {
            animation: fadeInUp 0.8s ease;
        }

        .info-item:nth-child(1) { animation-delay: 0.1s; }
        .info-item:nth-child(2) { animation-delay: 0.2s; }
        .info-item:nth-child(3) { animation-delay: 0.3s; }
        .info-item:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Notes Section Styles */
        .notes-count {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: auto;
        }

        .notes-container {
            margin-top: 1.5rem;
        }

        .notes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .note-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .note-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            background: rgba(255, 255, 255, 0.95);
        }

        .note-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        }

        .note-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 0.85rem;
        }

        .note-subject {
            background: rgba(37, 99, 235, 0.1);
            color: #2563eb;
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .note-date {
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .note-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.75rem;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .note-preview {
            color: #64748b;
            line-height: 1.5;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .note-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid rgba(226, 232, 240, 0.5);
        }

        .note-stats {
            display: flex;
            gap: 1rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.8rem;
            color: #64748b;
        }

        .stat-item i {
            font-size: 0.75rem;
        }

        .note-actions {
            display: flex;
            gap: 0.5rem;
        }

        .note-btn {
            padding: 0.4rem 0.8rem;
            border: none;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .view-btn {
            background: rgba(37, 99, 235, 0.1);
            color: #2563eb;
        }

        .view-btn:hover {
            background: rgba(37, 99, 235, 0.2);
            transform: translateY(-1px);
        }

        .edit-btn {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .edit-btn:hover {
            background: rgba(245, 158, 11, 0.2);
            transform: translateY(-1px);
        }

        .featured-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
            color: white;
            padding: 0.3rem 0.6rem;
            border-radius: 15px;
            font-size: 0.7rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            box-shadow: 0 2px 10px rgba(245, 158, 11, 0.3);
        }

        .empty-notes {
            text-align: center;
            padding: 4rem 2rem;
            background: rgba(248, 250, 252, 0.8);
            border-radius: 20px;
            border: 2px dashed #e2e8f0;
        }

        .empty-icon {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
        }

        .empty-notes h4 {
            font-size: 1.5rem;
            color: #64748b;
            margin-bottom: 0.75rem;
        }

        .empty-notes p {
            color: #94a3b8;
            margin-bottom: 2rem;
            line-height: 1.6;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .load-more-container {
            text-align: center;
            margin-top: 2rem;
        }

        .load-more-btn {
            background: rgba(248, 250, 252, 0.8);
            border: 2px dashed #e2e8f0;
            color: #64748b;
        }

        .load-more-btn:hover {
            background: rgba(241, 245, 249, 0.9);
            border-color: #cbd5e1;
            transform: translateY(-2px);
        }

        /* Note Card Animations */
        .note-card {
            animation: noteSlideIn 0.6s ease;
        }

        .note-card:nth-child(1) { animation-delay: 0.1s; }
        .note-card:nth-child(2) { animation-delay: 0.2s; }
        .note-card:nth-child(3) { animation-delay: 0.3s; }
        .note-card:nth-child(4) { animation-delay: 0.4s; }
        .note-card:nth-child(5) { animation-delay: 0.5s; }
        .note-card:nth-child(6) { animation-delay: 0.6s; }

        @keyframes noteSlideIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Responsive Notes */
        @media (max-width: 768px) {
            .notes-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .note-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .note-footer {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .note-actions {
                width: 100%;
                justify-content: center;
            }

            .empty-notes {
                padding: 2.5rem 1rem;
            }

            .action-buttons {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }
        }

        /* Glassmorphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
    </style>
</head>
<body>
@extends('layouts.app')

@section('content')
    <!-- Main Container -->
    <div class="container">
        <!-- Success/Error Messages -->
        <div class="alert alert-success" id="successAlert">
            <i class="fas fa-check-circle"></i>
            <span>Profile berhasil diperbarui!</span>
        </div>

        <div class="alert alert-error" id="errorAlert">
            <i class="fas fa-exclamation-circle"></i>
            <span id="errorMessage">Terjadi kesalahan. Silakan coba lagi.</span>
        </div>

        <!-- Profile Card -->
        <div class="profile-card">
            <!-- Profile Header -->
            <div class="profile-header">
                <h1 class="profile-name">{{ $user->full_name ?? 'Nama Belum Diatur' }}</h1>
                <p class="profile-email">{{ $user->email }}</p>
            </div>

            <!-- Profile Content -->
            <div class="profile-content">
                <!-- Contact Information -->
                <div class="info-section">
                    <h3 class="section-title">
                        <i class="fas fa-address-book"></i>
                        Informasi Kontak
                    </h3>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-phone"></i>
                                Nomor Telepon
                            </div>
                            <div class="info-value {{ !$profile->phone_number ? 'empty' : '' }}">
                                {{ $profile->phone_number ?: 'Belum diatur' }}
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-map-marker-alt"></i>
                                Alamat
                            </div>
                            <div class="info-value {{ !$profile->address ? 'empty' : '' }}">
                                {{ $profile->address ?: 'Belum diatur' }}
                            </div>
                        </div>
                    </div>

                    <!-- Profile Completion Status -->
                    <div class="status-badge {{ ($profile->phone_number && $profile->address) ? 'status-complete' : 'status-incomplete' }}">
                        <i class="fas fa-{{ ($profile->phone_number && $profile->address) ? 'check-circle' : 'exclamation-triangle' }}"></i>
                        {{ ($profile->phone_number && $profile->address) ? 'Profile Lengkap' : 'Profile Belum Lengkap' }}
                    </div>
                </div>

                <!-- Bio Section -->
                <div class="info-section">
                    <h3 class="section-title">
                        <i class="fas fa-user-circle"></i>
                        Tentang Saya
                    </h3>
                    
                    <div class="bio-section">
                        <div class="bio-content {{ !$profile->bio ? 'empty' : '' }}">
                            @if($profile->bio)
                                {{ $profile->bio }}
                            @else
                                <i class="fas fa-edit" style="font-size: 2rem; margin-bottom: 1rem; opacity: 0.5;"></i><br>
                                Ceritakan tentang diri Anda! Bio ini akan membantu orang lain mengenal Anda lebih baik.
                            @endif
                        </div>
                    </div>
                </div>

                <!-- User Notes Section -->
                <div class="info-section">
                    <h3 class="section-title">
                        <i class="fas fa-sticky-note"></i>
                        Catatan yang Dibagikan
                        <span class="notes-count">{{ $notes ? count($notes) : 0 }}</span>
                    </h3>
                    
                    <div class="notes-container">
                        @if($notes && count($notes) > 0)
                            <div class="notes-grid">
                                @foreach($notes as $note)
                                <div class="note-card" data-note-id="{{ $note->id }}">
                                    <div class="note-header">
                                        <div class="note-subject">
                                            <i class="fas fa-book"></i>
                                            {{ $note->subject ?? 'Umum' }}
                                        </div>
                                        <div class="note-date">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ $note->created_at ? date('d M Y', strtotime($note->created_at)) : 'Hari ini' }}
                                        </div>
                                    </div>
                                    
                                    <h4 class="note-title">{{ $note->judul ?? 'Catatan Tanpa Judul' }}</h4>
                                    
                                    <div class="note-preview">
                                        {{ $note->deskripsi ? Str::limit($note->deskripsi, 120) : 'Tidak ada preview tersedia...' }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-notes">
                                <div class="empty-icon">
                                    <i class="fas fa-sticky-note"></i>
                                </div>
                                <h4>Belum Ada Catatan</h4>
                                <p>Anda belum membagikan catatan apapun. Mulai berbagi pengetahuan Anda dengan komunitas!</p>
                                <a href="{{ route('matkul.index') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Pilih Mata Kuliah untuk Membuat Catatan
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Load any existing alerts
            @if(session('success'))
                showAlert('success', '{{ session('success') }}');
            @endif
            
            @if(session('error'))
                showAlert('error', '{{ session('error') }}');
            @endif

            // Add some interactive animations
            const infoItems = document.querySelectorAll('.info-item');
            infoItems.forEach((item, index) => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) scale(1.02)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Profile completion animation
            const statusBadge = document.querySelector('.status-badge');
            if (statusBadge) {
                setTimeout(() => {
                    statusBadge.style.animation = 'pulse 2s infinite';
                }, 1000);
            }
        });

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

        // Add pulse animation to incomplete status
        const style = document.createElement('style');
        style.textContent = `
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }
            
            .status-incomplete {
                animation: pulse 2s infinite;
            }
        `;
        document.head.appendChild(style);

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Notes functionality
        function viewNote(noteId) {
            // Redirect to note view page
            window.location.href = `/notes/${noteId}`;
        }

        function editNote(noteId) {
            // Redirect to note edit page
            window.location.href = `/notes/${noteId}/edit`;
        }

        function loadMoreNotes() {
            const btn = document.querySelector('.load-more-btn');
            const originalContent = btn.innerHTML;
            
            // Show loading state
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memuat...';
            btn.disabled = true;
            
            // Simulate API call (replace with actual implementation)
            setTimeout(() => {
                // Here you would normally make an AJAX call to load more notes
                // For now, we'll just hide the button
                btn.innerHTML = originalContent;
                btn.disabled = false;
                
                // You could add new note cards here
                // appendNewNotes(newNotesData);
            }, 1500);
        }

        // Note card interactions
        function setupNoteCardInteractions() {
            const noteCards = document.querySelectorAll('.note-card');
            
            noteCards.forEach(card => {
                // Add click to view functionality
                card.addEventListener('click', function(e) {
                    // Don't trigger if clicking on buttons
                    if (e.target.closest('.note-btn')) return;
                    
                    const noteId = this.dataset.noteId;
                    if (noteId) {
                        viewNote(noteId);
                    }
                });

                // Add hover effect for cursor
                card.addEventListener('mouseenter', function() {
                    this.style.cursor = 'pointer';
                });

                // Add ripple effect on click
                card.addEventListener('click', function(e) {
                    if (e.target.closest('.note-btn')) return;
                    
                    const ripple = document.createElement('div');
                    ripple.style.position = 'absolute';
                    ripple.style.borderRadius = '50%';
                    ripple.style.background = 'rgba(37, 99, 235, 0.3)';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s linear';
                    ripple.style.left = (e.clientX - this.offsetLeft) + 'px';
                    ripple.style.top = (e.clientY - this.offsetTop) + 'px';
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        }

        // Initialize notes interactions
        document.addEventListener('DOMContentLoaded', function() {
            setupNoteCardInteractions();
            
            // Add ripple animation style
            const rippleStyle = document.createElement('style');
            rippleStyle.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(rippleStyle);
        });

        // Add loading effect to buttons
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!this.href || this.href.includes('#')) return;
                
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
    </script>
@endsection
</body>
</html>