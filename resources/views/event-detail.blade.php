<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->title }} - Event Detail</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #fffff;
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            background: #2563eb;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #4a5568;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #667eea;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.2);
            color: black;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 20px 0;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .main-content {
            padding: 40px 0 80px;
        }

        .event-detail-card {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            animation: slideInUp 0.6s ease-out;
        }

        .event-hero {
            position: relative;
            height: 400px;
            background: l#2563eb;
            overflow: hidden;
        }

        .event-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .event-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(102, 126, 234, 0.3), rgba(118, 75, 162, 0.3));
        }

        .event-hero-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: white;
            font-size: 120px;
            position: relative;
            z-index: 1;
        }

        .status-badge {
            position: absolute;
            top: 30px;
            right: 30px;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 2;
        }

        .status-active {
            background: rgba(72, 187, 120, 0.9);
            color: white;
        }

        .status-full {
            background: rgba(245, 101, 101, 0.9);
            color: white;
        }

        .event-content {
            padding: 50px 40px;
        }

        .event-title {
            font-size: 36px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .event-meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
            padding: 30px;
            background: #f8fafc;
            border-radius: 15px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .meta-icon {
            width: 50px;
            height: 50px;
            background: #2563eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .meta-content h4 {
            font-size: 14px;
            font-weight: 600;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .meta-content p {
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
        }

        .event-description {
            margin-bottom: 40px;
        }

        .event-description h3 {
            font-size: 24px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 20px;
            position: relative;
        }

        .event-description h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 3px;
            background: #2563eb;
            border-radius: 2px;
        }

        .event-description p {
            font-size: 16px;
            line-height: 1.8;
            color: #4a5568;
            white-space: pre-wrap;
        }

        .action-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 40px;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
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
            transition: left 0.5s ease;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-outline {
            border: 2px solid #e2e8f0;
            color: #4a5568;
            background: transparent;
        }

        .btn-outline:hover {
            border-color: #667eea;
            color: #667eea;
            transform: translateY(-2px);
        }

        .related-events {
            margin-top: 80px;
        }

        .related-events h3 {
            text-align: center;
            color: white;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 40px;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .related-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .related-card:hover {
            transform: translateY(-5px);
        }

        .related-image {
            height: 150px;
            background: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
        }

        .related-content {
            padding: 20px;
        }

        .related-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #2d3748;
        }

        .related-date {
            color: #718096;
            font-size: 14px;
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

        @media (max-width: 768px) {
            .nav-links {
                gap: 20px;
            }

            .event-title {
                font-size: 28px;
            }

            .event-content {
                padding: 30px 20px;
            }

            .event-meta-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 300px;
            }
        }

        .share-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 30px;
        }

        .share-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .share-btn:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
@extends('layouts.app')

@section('content')
    <main class="main-content">
        <div class="container">
            <a href="/events" class="back-btn">
                ← Kembali ke Daftar Event
            </a>

            <div class="event-detail-card">
                <div class="event-hero">
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" 
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="event-hero-placeholder" style="display: none;">🎉</div>
                    @else
                        <div class="event-hero-placeholder">🎉</div>
                    @endif
                    
                    @php
                        $isEventPassed = \Carbon\Carbon::parse($event->event_date)->isPast();
                    @endphp
                    
                    <div class="status-badge {{ $isEventPassed ? 'status-full' : 'status-active' }}">
                        {{ $isEventPassed ? 'Event Selesai' : 'Event Aktif' }}
                    </div>
                </div>

                <div class="event-content">
                    <h1 class="event-title">{{ $event->title }}</h1>

                    <div class="event-meta-grid">
                        <div class="meta-item">
                            <div class="meta-icon">📅</div>
                            <div class="meta-content">
                                <h4>Tanggal & Waktu</h4>
                                <p>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, H:i') }} WIB</p>
                            </div>
                        </div>

                        <div class="meta-item">
                            <div class="meta-icon">⏰</div>
                            <div class="meta-content">
                                <h4>Status</h4>
                                <p>{{ $isEventPassed ? 'Sudah Berlalu' : 'Akan Datang' }}</p>
                            </div>
                        </div>

                    </div>

                    @if($event->description)
                    <div class="event-description">
                        <h3>Deskripsi Event</h3>
                        <p>{{ $event->description }}</p>
                    </div>
                    @endif

                    <div class="action-buttons">
                        <a href="/events" class="btn btn-outline">← Kembali</a>
                        @if(!$isEventPassed)
                            <button class="btn btn-primary" onclick="showContactInfo()">Info Kontak</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function showContactInfo() {
            alert('Untuk informasi lebih lanjut, silakan kunjungi: ' );
        }
        window.addEventListener('load', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
@endsection
</body>
</html>