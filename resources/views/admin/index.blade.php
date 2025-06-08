@extends('layouts.appadmin')



@section('content')

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Event</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            min-height: 100vh;
            padding: 0;
            margin: 0;
        }

        .container {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 24px;
            padding: 35px 40px;
            margin-bottom: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #2563eb, #667eea, #3182ce);
        }

        .header h1 {
            color: #1e293b;
            font-size: 2.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 18px;
            position: relative;
        }

        .header h1 i {
            color: #2563eb;
            font-size: 2.5rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .header-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .btn {
            padding: 14px 28px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #3182ce);
            color: white;
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(37, 99, 235, 0.4);
        }

        .main-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .content-header {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            padding: 25px 35px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .content-title {
            color: #1e293b;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .filter-section {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .event-grid {
            padding: 35px;
        }

        .event-item {
            background: white;
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.04);
            border: 1px solid #f1f5f9;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .event-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            background: linear-gradient(135deg, #2563eb, #3182ce);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .event-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .event-item:hover::before {
            transform: scaleY(1);
        }

        .event-row {
            display: grid;
            grid-template-columns: auto 1fr auto auto;
            gap: 25px;
            align-items: center;
        }

        .event-image-container {
            position: relative;
        }

        .event-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 16px;
            border: 3px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        .event-image:hover {
            transform: scale(1.05);
            border-color: #2563eb;
        }

        .no-image-placeholder {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #f1f5f9;
        }

        .no-image-placeholder i {
            color: #cbd5e0;
            font-size: 28px;
        }

        .event-details {
            min-width: 0;
        }

        .event-title {
            color: #1e293b;
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .event-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 12px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 13px;
            font-weight: 500;
        }

        .meta-item i {
            color: #2563eb;
            font-size: 12px;
        }

        .event-description {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .event-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .tag {
            background: rgba(37, 99, 235, 0.1);
            color: #2563eb;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .event-date-section {
            text-align: center;
            min-width: 120px;
        }

        .date-display {
            background: linear-gradient(135deg, #2563eb, #3182ce);
            color: white;
            padding: 15px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.2);
        }

        .date-day {
            font-size: 1.8rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 2px;
        }

        .date-month {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.9;
        }

        .date-year {
            font-size: 13px;
            font-weight: 500;
            opacity: 0.8;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 100px;
        }

        .btn-sm {
            padding: 10px 18px;
            font-size: 12px;
            border-radius: 10px;
            font-weight: 600;
            justify-content: center;
        }

        .btn-info {
            background: linear-gradient(135deg, #3182ce, #2c5282);
            color: white;
            box-shadow: 0 4px 15px rgba(49, 130, 206, 0.3);
        }

        .btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(49, 130, 206, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ed8936, #dd6b20);
            color: white;
            box-shadow: 0 4px 15px rgba(237, 137, 54, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(237, 137, 54, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #e53e3e, #c53030);
            color: white;
            box-shadow: 0 4px 15px rgba(229, 62, 62, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(229, 62, 62, 0.4);
        }

        .alert {
            padding: 20px 25px;
            margin-bottom: 25px;
            border-radius: 16px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 15px;
            border-left: 5px solid;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .alert-success {
            background: linear-gradient(135deg, #c6f6d5, #9ae6b4);
            color: #2f855a;
            border-color: #38a169;
        }

        .empty-state {
            text-align: center;
            padding: 100px 40px;
            color: #64748b;
        }

        .empty-state i {
            font-size: 5rem;
            margin-bottom: 30px;
            color: #cbd5e0;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .empty-state h3 {
            font-size: 2rem;
            margin-bottom: 15px;
            color: #475569;
            font-weight: 700;
        }

        .empty-state p {
            font-size: 1.1rem;
            margin-bottom: 40px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .pagination {
            display: flex;
            justify-content: center;
            padding: 30px;
            gap: 10px;
        }

        .page-btn {
            padding: 10px 15px;
            border: 2px solid #e2e8f0;
            background: white;
            border-radius: 10px;
            color: #64748b;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .page-btn:hover,
        .page-btn.active {
            background: #2563eb;
            border-color: #2563eb;
            color: white;
            transform: translateY(-2px);
        }

        @media (max-width: 1024px) {
            .event-row {
                grid-template-columns: auto 1fr;
                gap: 20px;
            }

            .event-date-section,
            .action-buttons {
                grid-column: 1 / -1;
                margin-top: 20px;
            }

            .action-buttons {
                flex-direction: row;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .header {
                flex-direction: column;
                text-align: center;
                padding: 25px;
            }

            .header h1 {
                font-size: 2.2rem;
            }

            .stats-bar {
                flex-direction: column;
                gap: 15px;
            }

            .stat-item {
                min-width: 100%;
            }

            .content-header {
                flex-direction: column;
                gap: 20px;
            }

            .event-grid {
                padding: 20px;
            }

            .event-row {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 15px;
            }

            .event-meta {
                justify-content: center;
            }
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
        <!-- Header -->
        <div class="header">
            <h1>
                <i class="fas fa-calendar-alt"></i>
                Events
            </h1>
            <div class="header-actions">
                <a href="{{ route('admin.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah Event Baru
                </a>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
        @endif

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-header">
                <div class="content-title">
                    <i class="fas fa-list"></i>
                    Daftar Event ({{ $events->count() }} Events)
                </div>
            </div>

            <div class="event-grid">
                @if($events->count() > 0)
                @foreach($events as $event)
                <div class="event-item" data-event-title="{{ strtolower($event->title) }}" data-event-description="{{ strtolower($event->description) }}">
                    <div class="event-row">
                        <div class="event-image-container">
                            @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}"
                                alt="{{ $event->title }}"
                                class="event-image">
                            @else
                            <div class="no-image-placeholder">
                                <i class="fas fa-image"></i>
                            </div>
                            @endif
                        </div>

                        <div class="event-details">
                            <div class="event-title">{{ $event->title }}</div>
                            <div class="event-meta">
                                <div class="meta-item">
                                    <i class="fas fa-user"></i>
                                    Dibuat oleh Admin
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-clock"></i>
                                    {{ $event->created_at->format('d M Y, H:i') }}
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-eye"></i>
                                    {{ rand(10, 500) }} views
                                </div>
                            </div>
                            <div class="event-description">
                                {{ Str::limit($event->description, 150) }}
                            </div>
                            <div class="event-tags">
                                <span class="tag">Event</span>
                                @if($event->event_date >= now())
                                <span class="tag" style="background: rgba(34, 197, 94, 0.1); color: #16a34a;">Upcoming</span>
                                @else
                                <span class="tag" style="background: rgba(239, 68, 68, 0.1); color: #dc2626;">Past</span>
                                @endif
                            </div>
                        </div>

                        <div class="event-date-section">
                            <div class="date-display">
                                <div class="date-day">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</div>
                                <div class="date-month">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</div>
                                <div class="date-year">{{ \Carbon\Carbon::parse($event->event_date)->format('Y') }}</div>
                            </div>
                        </div>

                        <div class="action-buttons">
                            <a href="{{ route('admin.show', $event) }}"
                                class="btn btn-sm btn-info"
                                title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                                Detail
                            </a>
                            <a href="{{ route('admin.edit', $event) }}"
                                class="btn btn-sm btn-warning"
                                title="Edit Event">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <form action="{{ route('admin.destroy', $event) }}"
                                method="POST"
                                style="display: inline; width: 100%;"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus event {{ $event->title }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-sm btn-danger"
                                    title="Hapus Event"
                                    style="width: 100%;">
                                    <i class="fas fa-trash"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

                @else
                <!-- Empty State -->
                <div class="empty-state">
                    <i class="fas fa-calendar-times"></i>
                    <h3>Belum Ada Event Terdaftar</h3>
                    <p>Dashboard event masih kosong. Mulai kelola acara Anda dengan membuat event pertama yang menarik dan informatif untuk audience.</p>
                    <a href="{{ route('admin.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Buat Event Pertama
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateX(-20px)';
                    setTimeout(() => {
                        if (alert.parentNode) {
                            alert.parentNode.removeChild(alert);
                        }
                    }, 300);
                }, 5000);
            });
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });

                button.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('btn-primary')) {
                        this.style.transform = 'translateY(0)';
                    }
                });
            });

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
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

            const deleteForms = document.querySelectorAll('form[method="POST"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function() {
                    const button = this.querySelector('button[type="submit"]');
                    const originalHTML = button.innerHTML;
                    button.innerHTML = '<div class="loading"></div> Menghapus...';
                    button.disabled = true;
                });
            });
        });
    </script>
</body>

</html>

@endsection