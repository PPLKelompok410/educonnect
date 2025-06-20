<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduConnect Dashboard</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://unpkg.com/pdf-lib/dist/pdf-lib.min.js"></script>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8fafc;
    }

    .font-title {
      font-family: 'Montserrat', sans-serif;
      font-weight: 700;
    }

    .main-blue {
      background-color: #2563eb;
    }

    .text-main-blue {
      color: #2563eb;
    }

    .border-main-blue {
      border-color: #2563eb;
    }

    .sidebar-item {
      border-radius: 8px;
      padding: 0.75rem 1rem;
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      transition: all 0.3s;
    }

    .sidebar-item:hover,
    .sidebar-item.active {
      background-color: rgba(37, 99, 235, 0.1);
      color: #2563eb;
    }

    .sidebar-item.active {
      background-color: rgba(37, 99, 235, 0.15);
      font-weight: 600;
    }

    .sidebar-icon {
      margin-right: 12px;
    }

    .card {
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      background-color: white;
      border: 1px solid #e5e7eb;
      transition: all 0.3s;
    }

    .card:hover {
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.07);
      transform: translateY(-2px);
    }

    .progress-bar {
      height: 6px;
      border-radius: 3px;
    }

    .card-header {
      font-weight: 600;
      font-size: 1.1rem;
      color: #1e293b;
    }

    .top-contributor-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
    }

    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
    }

    .transition-all {
        transition: all 0.2s ease-in-out;
    }

    .hover\:bg-opacity-10:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .sidebar-item {
      border-radius: 8px;
      padding: 0.75rem 1rem;
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      transition: all 0.3s;
      cursor: pointer;
    }

    .sidebar-item:hover,
    .sidebar-item.active {
      background-color: rgba(37, 99, 235, 0.1);
      color: #2563eb;
      transform: translateX(4px);
    }

    .sidebar-item.active {
      background-color: rgba(37, 99, 235, 0.15);
      font-weight: 600;
    }

    .sidebar-icon {
      margin-right: 12px;
      transition: color 0.3s;
    }
    
    .payment {
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .payment:hover {
      background-color: rgba(37, 99, 235, 0.1);
      transform: translateY(-1px);
    }
    
    [x-cloak] { display: none !important; }
  </style>
</head>

<body class="bg-gray-50 flex-col">
  {{-- Navbar --}}
  @include('partials.navbar')

  <div class="flex min-h-screen">
    {{-- Sidebar --}}
    @include('partials.sidebar')

    {{-- Main Content --}}
    <div class="flex-1 p-8">
      @yield('content')
    </div>
  </div>

    @stack('scripts')
</body>

</html>
