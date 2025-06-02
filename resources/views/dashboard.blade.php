<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduConnect Dashboard</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
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
      cursor: pointer;
    }
    .sidebar-item:hover, .sidebar-item.active {
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
    
    .payment {
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .payment:hover {
      background-color: rgba(37, 99, 235, 0.1);
      transform: translateY(-1px);
    }

    /* Carousel Styles */
    .carousel-container {
      position: relative;
      overflow: hidden;
      border-radius: 12px;
    }
    
    .carousel-slide {
      display: none;
      animation: fadeIn 0.5s ease-in-out;
    }
    
    .carousel-slide.active {
      display: block;
    }
    
    .carousel-slide img {
      width: 100%;
      height: 300px;
      object-fit: cover;
      border-radius: 12px;
    }
    
    .carousel-content {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: linear-gradient(transparent, rgba(0,0,0,0.8));
      color: white;
      padding: 2rem;
      border-radius: 0 0 12px 12px;
    }
    
    .carousel-nav {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(255,255,255,0.9);
      border: none;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s;
      z-index: 10;
    }
    
    .carousel-nav:hover {
      background: white;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .carousel-prev {
      left: 15px;
    }
    
    .carousel-next {
      right: 15px;
    }
    
    .carousel-indicators {
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 8px;
      z-index: 10;
    }
    
    .carousel-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: rgba(255,255,255,0.5);
      cursor: pointer;
      transition: all 0.3s;
    }
    
    .carousel-dot.active {
      background: white;
      transform: scale(1.2);
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    /* Event Card Styles */
    .event-card {
      transition: all 0.3s ease;
      cursor: pointer;
    }
    
    .event-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 20px rgba(0,0,0,0.1);
    }

    .event-date {
      background: linear-gradient(135deg, #2563eb, #3b82f6);
    }
    
  </style>
</head>
<body>
  <!-- Top Navigation -->
  <header class="main-blue text-white py-4 px-6">
    <div class="container mx-auto flex justify-between items-center">
      <div class="flex items-center">
        <span class="font-title text-2xl">EduConnect</span>
      </div>
      <div class="flex-grow mx-10 max-w-2xl">
        <div class="relative">
          <input type="text" placeholder="Search courses, notes, forums..." class="w-full py-2 px-4 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <button class="absolute right-3 top-2.5">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </button>
        </div>
      </div>
      
      <div class="flex items-center">
          <div class="relative">
              <button onclick="window.location.href='{{ route('profiles.index') }}'" 
                      class="flex items-center space-x-3 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-10 focus:outline-none transition-all duration-200">
                  <!-- Profile Picture -->
                  <div class="w-8 h-8 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                      <span class="text-sm font-semibold text-white">
                          {{ strtoupper(substr(session('user')->full_name, 0, 1)) }}
                      </span>
                  </div>

                  <!-- User Info -->
                  <div class="flex items-center">
                      <span class="font-medium text-white">{{ session('user')->full_name }}</span>
                      @php
                          $userTransaction = \App\Models\Transaction::where('user_id', session('user')->id)
                              ->with('payment')
                              ->orderBy('created_at', 'desc')
                              ->first();
                      @endphp

                      @if($userTransaction && $userTransaction->payment)
                          <span class="ml-2 px-3 py-1 bg-white bg-opacity-20 text-white text-xs rounded-full font-poppins border border-white border-opacity-20 backdrop-blur-sm">
                              {{ $userTransaction->payment->package }}
                              <span class="ml-1 text-green-300">•</span>
                          </span>
                      @endif

                      <!-- Dropdown Icon -->
                      <svg class="w-4 h-4 ml-2 text-white opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                  </div>
              </button>

              <!-- Optional: Hover Tooltip -->
              <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 hidden group-hover:block">
                  <a href="{{ route('profiles.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                      View Profile
                  </a>
              </div>
          </div>
      </div>
    </div>
  </header>

  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-white border-r border-gray-200 px-4 py-6 flex flex-col">
      <div class="flex-grow">
        <div class="sidebar-item active">
          <svg class="w-5 h-5 sidebar-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
          </svg>
          <span>Dashboard</span>
        </div>
        <div class="sidebar-item">
          <svg class="w-5 h-5 sidebar-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
          </svg>
          <span>Mata Kuliah</span>
        </div>
        <div class="sidebar-item">
          <svg class="w-5 h-5 sidebar-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
          </svg>
          <span>Catatan</span>
        </div>
        <div class="sidebar-item">
          <svg class="w-5 h-5 sidebar-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6zm4 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
          </svg>
          <span>Forum Diskusi</span>
        </div>
        <div class="sidebar-item" onclick="handleEventsClick()">
            <svg class="w-5 h-5 sidebar-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
            </svg>
            <span>Events</span>
        </div>
        <div class="sidebar-item" onclick="window.location.href='{{ route('topcontributors.index') }}'">
          <svg class="w-5 h-5 sidebar-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
          </svg>
          <span>Top Contributor</span>
        </div>
        <div class="sidebar-item payment" onclick="window.location.href='{{ route('upgrade.plans') }}'">
            <svg class="w-5 h-5 sidebar-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
            </svg>
            <span>Upgrade Plan</span>
        </div>
      </div>
      <div class="mt-auto">
        <form action="{{ route('auth.login') }}" method="GET">
          @csrf
          <button type="submit" class="sidebar-item text-red-600 flex items-center space-x-2">
            <svg class="w-5 h-5 sidebar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
              </path>
            </svg>
            <span>Logout</span>
          </button>
        </form>
      </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8 bg-gray-50">
      <div class="mb-8">
        <h1 class="font-title text-3xl text-gray-800">Good Morning, {{ session('user')->full_name }}</h1>
        <p class="text-gray-600">We wish you have a productive day!</p>
      </div>

      <!-- Image Carousel Section -->
      <div class="mb-8">
        <div class="carousel-container relative">
          <div class="carousel-slide active">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80" alt="Students collaborating">
            <div class="carousel-content">
              <h3 class="font-title text-xl mb-2">Collaborative Learning Experience</h3>
              <p class="text-sm opacity-90">Join thousands of students in interactive learning sessions and build connections that last.</p>
            </div>
          </div>
          
          <div class="carousel-slide">
            <img src="https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Modern workspace">
            <div class="carousel-content">
              <h3 class="font-title text-xl mb-2">Modern Learning Environment</h3>
              <p class="text-sm opacity-90">Access cutting-edge tools and resources designed for the digital age of education.</p>
            </div>
          </div>
          
          <div class="carousel-slide">
            <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Achievement">
            <div class="carousel-content">
              <h3 class="font-title text-xl mb-2">Achieve Your Goals</h3>
              <p class="text-sm opacity-90">Track progress, celebrate milestones, and reach new heights in your academic journey.</p>
            </div>
          </div>
          
          <!-- Navigation -->
          <button class="carousel-nav carousel-prev" onclick="changeSlide(-1)">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>
          
          <button class="carousel-nav carousel-next" onclick="changeSlide(1)">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>
          
          <!-- Indicators -->
          <div class="carousel-indicators">
            <span class="carousel-dot active" onclick="currentSlide(1)"></span>
            <span class="carousel-dot" onclick="currentSlide(2)"></span>
            <span class="carousel-dot" onclick="currentSlide(3)"></span>
          </div>
        </div>
      </div>

      <!-- Upcoming Events Section -->
      <div class="mb-8">
        <div class="flex justify-between items-center mb-4">
          <h2 class="font-title text-xl text-gray-800">Upcoming Events</h2>
          <button onclick="handleEventsClick()" class="text-main-blue font-medium text-sm inline-flex items-center hover:underline">
            Lihat Selengkapnya
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Event Card 1 -->
          <div class="card event-card p-0 overflow-hidden" onclick="handleEventDetail(1)">
            <div class="relative">
              <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Workshop" class="w-full h-40 object-cover">
              <div class="absolute top-3 left-3 event-date text-white text-xs px-3 py-1 rounded-full">
                <span class="font-semibold">15</span> Jun
              </div>
            </div>
            <div class="p-4">
              <h3 class="font-semibold text-gray-800 mb-2">Web Development Workshop</h3>
              <p class="text-sm text-gray-600 mb-3">Learn modern web development techniques with industry experts</p>
              <div class="flex items-center text-xs text-gray-500">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Online Event
              </div>
            </div>
          </div>

          <!-- Event Card 2 -->
          <div class="card event-card p-0 overflow-hidden" onclick="handleEventDetail(2)">
            <div class="relative">
              <img src="https://images.unsplash.com/photo-1517180102446-f3ece451e9d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Study Group" class="w-full h-40 object-cover">
              <div class="absolute top-3 left-3 event-date text-white text-xs px-3 py-1 rounded-full">
                <span class="font-semibold">18</span> Jun
              </div>
            </div>
            <div class="p-4">
              <h3 class="font-semibold text-gray-800 mb-2">Database Design Study Group</h3>
              <p class="text-sm text-gray-600 mb-3">Collaborative session on advanced database normalization</p>
              <div class="flex items-center text-xs text-gray-500">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Library - Room 101
              </div>
            </div>
          </div>

          <!-- Event Card 3 -->
          <div class="card event-card p-0 overflow-hidden" onclick="handleEventDetail(3)">
            <div class="relative">
              <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1412&q=80" alt="Tech Talk" class="w-full h-40 object-cover">
              <div class="absolute top-3 left-3 event-date text-white text-xs px-3 py-1 rounded-full">
                <span class="font-semibold">22</span> Jun
              </div>
            </div>
            <div class="p-4">
              <h3 class="font-semibold text-gray-800 mb-2">AI & Machine Learning Talk</h3>
              <p class="text-sm text-gray-600 mb-3">Explore the future of AI technology with guest speakers</p>
              <div class="flex items-center text-xs text-gray-500">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Auditorium A
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Top Contributors & Notes Section -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Contributors -->
        <div class="card p-6">
          <h2 class="card-header mb-4">Top Contributors</h2>
          <div class="space-y-4">
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <img src="https://images.unsplash.com/photo-1494790108755-2616b9a68bb3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1287&q=80" alt="Contributor" class="top-contributor-avatar mr-3">
                <div>
                  <p class="font-medium">Queen PM Kak Fathya</p>
                  <p class="text-sm text-gray-600">120 points • Web Development</p>
                </div>
              </div>
              <span class="text-xs bg-blue-100 text-main-blue py-1 px-2 rounded-full">#1</span>
            </div>
            
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1287&q=80" alt="Contributor" class="top-contributor-avatar mr-3">
                <div>
                  <p class="font-medium">Aswangga Asprak of the year</p>
                  <p class="text-sm text-gray-600">95 points • Database Design</p>
                </div>
              </div>
              <span class="text-xs bg-blue-100 text-main-blue py-1 px-2 rounded-full">#2</span>
            </div>
            
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1270&q=80" alt="Contributor" class="top-contributor-avatar mr-3">
                <div>
                  <p class="font-medium">Caca Umayah</p>
                  <p class="text-sm text-gray-600">87 points • Laravel Expert</p>
                </div>
              </div>
              <span class="text-xs bg-blue-100 text-main-blue py-1 px-2 rounded-full">#3</span>
            </div>
          </div>
        </div>

        <!-- Latest Notes -->
        <div class="card p-6">
          <h2 class="card-header mb-4">Recent Notes</h2>
          <div class="space-y-4">
            <div class="border-l-4 border-main-blue pl-3">
              <p class="font-medium">Belajar PPL</p>
              <p class="text-sm text-gray-600">Updated 2 hours ago • Web Programming</p>
            </div>
            
            <div class="border-l-4 border-main-blue pl-3">
              <p class="font-medium">DWBI Tugas 2</p>
              <p class="text-sm text-gray-600">Created yesterday • Database Management</p>
            </div>
            
            <div class="border-l-4 border-main-blue pl-3">
              <p class="font-medium">Integrasi Aplikasi Enterprise</p>
              <p class="text-sm text-gray-600">Created 3 days ago • Web Programming</p>
            </div>
          </div>
          <button class="text-main-blue font-medium text-sm mt-4 inline-flex items-center">
            View all notes
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <script>
    let currentSlideIndex = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const dots = document.querySelectorAll('.carousel-dot');

    function showSlide(index) {
      // Hide all slides
      slides.forEach(slide => slide.classList.remove('active'));
      dots.forEach(dot => dot.classList.remove('active'));
      
      // Show current slide
      slides[index].classList.add('active');
      dots[index].classList.add('active');
    }

    function changeSlide(direction) {
      currentSlideIndex += direction;
      
      if (currentSlideIndex >= slides.length) {
        currentSlideIndex = 0;
      } else if (currentSlideIndex < 0) {
        currentSlideIndex = slides.length - 1;
      }
      
      showSlide(currentSlideIndex);
    }

    function currentSlide(index) {
      currentSlideIndex = index - 1;
      showSlide(currentSlideIndex);
    }

    // Auto-play carousel
    function autoPlay() {
      changeSlide(1);
    }

    // Start auto-play
    setInterval(autoPlay, 5000);

    // Event handlers
    function handleEventsClick() {
      // Placeholder function for events page navigation
      // Replace with actual route when events page is created
      alert('Events page will be implemented soon! This will redirect to the events listing page.');
      // window.location.href = '{{ route('dashboard') }}'; // Uncomment when route is ready
    }

    function handleEventDetail(eventId) {
      // Placeholder function for individual event details
      alert(`Event detail page for Event ID: ${eventId} will be implemented soon!`);
      // window.location.href = `{{ route('dashboard', '') }}/${eventId}`; // Uncomment when route is ready
    }

    // Add keyboard navigation for carousel
    document.addEventListener('keydown', function(e) {
      if (e.key === 'ArrowLeft') {
        changeSlide(-1);
      } else if (e.key === 'ArrowRight') {
        changeSlide(1);
      }
    });
  </script>
</body>
</html>