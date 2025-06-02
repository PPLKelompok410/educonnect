<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event - {{ $event->title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #fffff;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: #2563eb;
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .header p {
            opacity: 0.9;
            font-size: 1rem;
        }

        .content {
            padding: 40px;
        }

        .event-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .event-details {
            display: grid;
            gap: 25px;
            margin-bottom: 40px;
        }

        .detail-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 20px;
            background: #f8fafc;
            border-radius: 12px;
            border-left: 4px solid #667eea;
        }

        .detail-item i {
            color: #667eea;
            font-size: 1.2rem;
            margin-top: 2px;
        }

        .detail-content h3 {
            color: #2d3748;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .detail-content p {
            color: #64748b;
            font-size: 1rem;
            line-height: 1.6;
        }

        .description {
            background: #f8fafc;
            padding: 25px;
            border-radius: 12px;
            border-left: 4px solid #667eea;
            margin-bottom: 30px;
        }

        .description h3 {
            color: #2d3748;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .description p {
            color: #4a5568;
            line-height: 1.7;
            font-size: 1rem;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
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
        }

        .btn-warning {
            background: #ed8936;
            color: white;
            box-shadow: 0 4px 15px rgba(237, 137, 54, 0.4);
        }

        .btn-warning:hover {
            background: #dd6b20;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #e53e3e;
            color: white;
            box-shadow: 0 4px 15px rgba(229, 62, 62, 0.4);
        }

        .btn-danger:hover {
            background: #c53030;
            transform: translateY(-2px);
        }

        .no-image {
            height: 300px;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            color: #94a3b8;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .container { margin: 10px; }
            .header h1 { font-size: 2rem; }
            .content { padding: 20px; }
            .action-buttons { flex-direction: column; }
            .btn { justify-content: center; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $event->title }}</h1>
            <p>Detail Event</p>
        </div>

        <div class="content">
            <!-- Event Image -->
            @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="event-image">
            @else
                <div class="no-image">
                    <i class="fas fa-image"></i>
                    <span style="margin-left: 10px;">Tidak ada gambar</span>
                </div>
            @endif

            <!-- Event Description -->
            <div class="description">
                <h3>
                    <i class="fas fa-align-left"></i>
                    Deskripsi Event
                </h3>
                <p>{{ $event->description }}</p>
            </div>

            <!-- Event Details -->
            <div class="event-details">
                <div class="detail-item">
                    <i class="fas fa-calendar"></i>
                    <div class="detail-content">
                        <h3>Tanggal & Waktu</h3>
                        <p>{{ \Carbon\Carbon::parse($event->event_date)->locale('id')->isoFormat('dddd, D MMMM YYYY - HH:mm') }} WIB</p>
                    </div>
                </div>

                <div class="detail-item">
                    <i class="fas fa-clock"></i>
                    <div class="detail-content">
                        <h3>Status Event</h3>
                        <p>
                            @php
                                $now = now();
                                $eventDate = \Carbon\Carbon::parse($event->event_date);
                            @endphp
                            
                            @if($eventDate->isFuture())
                                <span style="color: #ed8936; font-weight: 600;">Akan Datang</span>
                            @elseif($eventDate->isToday())
                                <span style="color: #48bb78; font-weight: 600;">Hari Ini</span>
                            @else
                                <span style="color: #64748b; font-weight: 600;">Selesai</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="detail-item">
                    <i class="fas fa-info-circle"></i>
                    <div class="detail-content">
                        <h3>Dibuat Pada</h3>
                        <p>{{ $event->created_at->locale('id')->isoFormat('dddd, D MMMM YYYY - HH:mm') }} WIB</p>
                    </div>
                </div>

                <div class="detail-item">
                    <i class="fas fa-edit"></i>
                    <div class="detail-content">
                        <h3>Terakhir Diupdate</h3>
                        <p>{{ $event->updated_at->locale('id')->isoFormat('dddd, D MMMM YYYY - HH:mm') }} WIB</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <a href="{{ route('admin.edit', $event) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                    Edit Event
                </a>
                <form action="{{ route('admin.destroy', $event) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                        <i class="fas fa-trash"></i>
                        Hapus Event
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>