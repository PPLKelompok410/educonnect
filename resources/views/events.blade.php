<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
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

        .main-content {
            padding: 60px 0;
        }

        .page-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .page-title h1 {
            font-size: 48px;
            font-weight: 700;
            color:rgb(8, 19, 69) ;
            margin-bottom: 15px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .page-title p {
            font-size: 18px;
            color:rgb(8, 19, 69);
            font-weight: 300;
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .event-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .event-image {
            height: 220px;
            background: #2563eb;
            position: relative;
            overflow: hidden;
        }

        .event-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .event-card:hover .event-image img {
            transform: scale(1.05);
        }

        .event-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #2563eb;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .event-card:hover .event-image::before {
            opacity: 1;
        }

        .event-content {
            padding: 25px;
        }

        .event-title {
            font-size: 22px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .event-description {
            color: #718096;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .event-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .event-date {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #667eea;
            font-weight: 500;
            font-size: 14px;
        }

        .event-quota {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #48bb78;
            font-weight: 500;
            font-size: 14px;
        }

        .event-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
            flex: 1;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-outline {
            border: 2px solid #e2e8f0;
            color: #4a5568;
            background: transparent;
        }

        .btn-outline:hover {
            border-color: #667eea;
            color: #667eea;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: white;
        }

        .empty-state-icon {
            font-size: 72px;
            margin-bottom: 20px;
            opacity: 0.7;
        }

        .empty-state h3 {
            font-size: 24px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .empty-state p {
            font-size: 16px;
            opacity: 0.8;
        }

        .status-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background: rgba(72, 187, 120, 0.9);
            color: white;
        }

        .status-full {
            background: rgba(245, 101, 101, 0.9);
            color: white;
        }

        @media (max-width: 768px) {
            .nav-links {
                gap: 20px;
            }

            .page-title h1 {
                font-size: 36px;
            }

            .events-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .event-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }

        .loading-animation {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <main class="main-content">
        <div class="container">
            <div class="page-title">
                <h1>Events</h1>
                <p>Temukan dan ikuti event menarik yang sedang berlangsung</p>
            </div>

            @if($events->count() > 0)
                <div class="events-grid">
                    @foreach($events as $index => $event)
                    <div class="event-card loading-animation" style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="event-image">
                            @if($event->image && file_exists(public_path('storage/' . $event->image)))
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                            @else
                                <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: white; font-size: 48px;">
                                    🎉
                                </div>
                            @endif
                            
                            @php
                                $isEventPassed = \Carbon\Carbon::parse($event->event_date)->isPast();
                            @endphp
                            
                            <div class="status-badge {{ $isEventPassed ? 'status-full' : 'status-active' }}">
                                {{ $isEventPassed ? 'Selesai' : 'Aktif' }}
                            </div>
                        </div>
                        
                        <div class="event-content">
                            <h3 class="event-title">{{ $event->title }}</h3>
                            
                            @if($event->description)
                                <p class="event-description">{{ $event->description }}</p>
                            @endif
                            
                            <div class="event-meta">
                                <div class="event-date">
                                    <span>📅</span>
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, H:i') }}
                                </div>
                            </div>
                            
                            <div class="event-actions">
                                <a href="/events/{{ $event->id }}" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">📅</div>
                    <h3>Belum Ada Event</h3>
                    <p>Saat ini belum ada event yang tersedia. Silakan cek kembali nanti!</p>
                </div>
            @endif
        </div>
    </main>

    <script>
        window.addEventListener('scroll', () => {
            const cards = document.querySelectorAll('.event-card');
            cards.forEach(card => {
                const cardTop = card.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                if (cardTop < windowHeight - 100) {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }
            });
        });

        document.querySelectorAll('.event-card').forEach(card => {
            card.addEventListener('click', (e) => {
                if (!e.target.closest('.event-actions')) {
                    const detailLink = card.querySelector('.btn-outline');
                    if (detailLink) {
                        window.location.href = detailLink.href;
                    }
                }
            });
        });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>