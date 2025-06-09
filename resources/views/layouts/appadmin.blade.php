<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .main-blue { background-color: #2563eb; }
        .text-primary { color: #2563eb; }
        
        .sidebar-item {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            cursor: pointer;
        }

        .sidebar-item:hover {
            background-color: rgba(37, 99, 235, 0.1);
            color: #2563eb;
            transform: translateX(4px);
        }

        .sidebar-item.active {
            background-color: rgba(37, 99, 235, 0.15);
            color: #2563eb;
            font-weight: 600;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    @include('partials.navbaradmin')

    <!-- Content Container -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('partials.sidebaradmin')
        
        <!-- Main Content -->
        <div class="flex-1 p-8">
            @yield('content')
        </div>
    </div>
</body>
</html>