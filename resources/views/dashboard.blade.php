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

    .card-header {
      font-weight: 600;
      font-size: 1.1rem;
      color: #1e293b;
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
      background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
      color: white;
      padding: 2rem;
      border-radius: 0 0 12px 12px;
    }

    .carousel-nav {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(255, 255, 255, 0.9);
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
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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
      background: rgba(255, 255, 255, 0.5);
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

    /* Animated Text Box Styles */
    .animated-text-box {
      background: linear-gradient(135deg, #2563eb, #3b82f6);
      border-radius: 12px;
      padding: 1.5rem;
      text-align: center;
      position: relative;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
      transition: all 0.3s ease;
    }

    .animated-text-box:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(37, 99, 235, 0.4);
    }

    .animated-text-box::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.2),
        transparent
      );
      transition: left 0.8s;
    }

    .animated-text-box:hover::before {
      left: 100%;
    }

    .animated-word {
      color: white;
      font-size: 2rem;
      font-weight: 700;
      font-family: 'Montserrat', sans-serif;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
      position: relative;
      z-index: 2;
      animation: changeWord 6s infinite;
    }

    @keyframes changeWord {
      0%, 30% {
        content: 'Connect';
        opacity: 1;
        transform: translateY(0) scale(1);
      }
      33%, 35% {
        opacity: 0;
        transform: translateY(-20px) scale(0.8);
      }
      38%, 63% {
        content: 'Share';
        opacity: 1;
        transform: translateY(0) scale(1);
      }
      66%, 68% {
        opacity: 0;
        transform: translateY(-20px) scale(0.8);
      }
      71%, 96% {
        content: 'Grow';
        opacity: 1;
        transform: translateY(0) scale(1);
      }
      99%, 100% {
        opacity: 0;
        transform: translateY(-20px) scale(0.8);
      }
    }

    .animated-word::after {
      content: 'Connect';
      animation: changeWordContent 6s infinite;
    }

    @keyframes changeWordContent {
      0%, 30% { content: 'Connect'; }
      38%, 63% { content: 'Share'; }
      71%, 96% { content: 'Grow'; }
    }

    /* Floating particles effect */
    .floating-particle {
      position: absolute;
      width: 4px;
      height: 4px;
      background: rgba(255, 255, 255, 0.6);
      border-radius: 50%;
      animation: float 4s infinite ease-in-out;
    }

    .floating-particle:nth-child(1) {
      top: 20%;
      left: 20%;
      animation-delay: 0s;
    }

    .floating-particle:nth-child(2) {
      top: 60%;
      right: 30%;
      animation-delay: 1s;
    }

    .floating-particle:nth-child(3) {
      bottom: 30%;
      left: 70%;
      animation-delay: 2s;
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0px) rotate(0deg);
        opacity: 0.5;
      }
      50% {
        transform: translateY(-20px) rotate(180deg);
        opacity: 1;
      }
    }
  </style>
</head>

<body>
@extends('layouts.app')

@section('content')
  <!-- Main Content -->
  <div class="flex-1 p-8">
    <!-- Welcome Section -->
    <div class="flex justify-between items-center mb-8">
      <div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Good day, {{$user->full_name}}!</h2>
        <p class="text-gray-600">We wish you have a productive day!</p>
      </div>
      <!-- Animated Text Box - Menggantikan kotak "Harusnya disini" -->
      <div class="w-60">
        <div class="animated-text-box">
          <div class="floating-particle"></div>
          <div class="floating-particle"></div>
          <div class="floating-particle"></div>
          <div class="animated-word"></div>
        </div>
      </div>
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
          <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </button>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="upcomingEvents">
        <!-- Events will be loaded here dynamically -->
      </div>
    </div>
    <!-- Top Contributors & Notes Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Top Contributors -->
      <div class="card p-6">
          <h2 class="card-header mb-4">Top Contributors</h2>
          <div class="space-y-4">
              @forelse($topContributors as $index => $contributor)
                  <div class="flex items-center justify-between">
                      <div class="flex items-center">
                          <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                              {{ substr($contributor->full_name, 0, 2) }}
                          </div>
                          <div>
                              <p class="font-medium">{{ $contributor->full_name }}</p>
                              <p class="text-sm text-gray-600">
                                  {{ $contributor->total_contributions }} points • 
                                  @if($contributor->notes_count > 0)
                                      {{ $contributor->notes_count }} notes
                                  @elseif($contributor->comments_count > 0)
                                      {{ $contributor->comments_count }} comments
                                  @else
                                      Active Member
                                  @endif
                              </p>
                          </div>
                      </div>
                      <span class="text-xs bg-blue-100 text-main-blue py-1 px-2 rounded-full">
                          #{{ $index + 1 }}
                      </span>
                  </div>
              @empty
                  <p class="text-gray-500 text-center">Belum ada kontributor</p>
              @endforelse

              <a href="{{ route('topcontributors.index') }}" 
                 class="text-main-blue font-medium text-sm mt-4 inline-flex items-center hover:underline">
                  Lihat Semua Kontributor
                  <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
              </a>
          </div>
      </div>

      <!-- Latest Notes -->
      <div class="card p-6">
          <h2 class="card-header mb-4">Recent Notes</h2>
          <div class="space-y-4">
              @forelse($recentNotes as $note)
                  <div class="border-l-4 border-main-blue pl-3">
                      <p class="font-medium">{{ $note->judul }}</p>
                      <p class="text-sm text-gray-600">
                          {{ $note->created_at->diffForHumans() }} • 
                          {{ $note->matkul->nama }} • 
                          by {{ $note->user->full_name }}
                      </p>
                  </div>
              @empty
                  <p class="text-gray-500 text-center">Belum ada catatan yang diunggah</p>
              @endforelse
          </div>
          
          <a href="{{ route('matkul.index') }}" 
              class="text-main-blue font-medium text-sm mt-4 inline-flex items-center hover:underline">
              Lihat Semua Catatan
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
          </a>
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
      window.location.href = '{{ route("events.index") }}';
    }

    document.addEventListener('DOMContentLoaded', function() {
      fetch('/api/upcoming-events/3')  // Explicitly request 3 events
        .then(response => response.json())
        .then(events => {
          const container = document.getElementById('upcomingEvents');
          if (events && events.length > 0) {
            container.innerHTML = events.map(event => `
              <div class="card event-card p-0 overflow-hidden" onclick="handleEventDetail(${event.id})">
                <div class="relative">
                  ${event.image 
                    ? `<img src="/storage/${event.image}" alt="${event.title}" class="w-full h-40 object-cover">`
                    : `<div class="w-full h-40 bg-blue-100 flex items-center justify-center text-4xl">🎉</div>`
                  }
                  <div class="absolute top-3 left-3 event-date text-white text-xs px-3 py-1 rounded-full">
                    <span class="font-semibold">${new Date(event.event_date).getDate()}</span>
                    ${new Date(event.event_date).toLocaleString('default', { month: 'short' })}
                  </div>
                </div>
                <div class="p-4">
                  <h3 class="font-semibold text-gray-800 mb-2">${event.title}</h3>
                  <p class="text-sm text-gray-600 mb-3">${event.description}</p>
                  <div class="flex items-center text-xs text-gray-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    ${event.location || 'Online Event'}
                  </div>
                </div>
              </div>
            `).join('');
          } else {
            container.innerHTML = `
              <div class="col-span-3 text-center py-8">
                <p class="text-gray-500">Tidak ada event yang akan datang</p>
              </div>
            `;
          }
        })
        .catch(error => {
          console.error('Error fetching events:', error);
          const container = document.getElementById('upcomingEvents');
          container.innerHTML = `
            <div class="col-span-3 text-center py-8">
              <p class="text-gray-500">Gagal memuat events</p>
            </div>
          `;
        });
    });

    function handleEventDetail(eventId) {
      window.location.href = `/events/${eventId}`;
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
@endsection
</body>

</html>
