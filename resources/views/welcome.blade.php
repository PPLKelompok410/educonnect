<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduConnect - Jembatan Mahasiswa Menuju Masa Depan</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    
    /* Animations */
    .fade-in {
      opacity: 0;
      transform: translateY(20px);
      animation: fadeIn 0.6s ease-out forwards;
    }
    
    @keyframes fadeIn {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .hover-float {
      transition: transform 0.3s ease;
    }

    .hover-float:hover {
      transform: translateY(-8px);
    }

    .pulse {
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }

    .infinite-scroll {
      overflow: hidden;
      background: #2563eb;
      padding: 1.25rem 0;
      margin: 0;
    }

    .scroll-text {
      display: inline-block;
      white-space: nowrap;
      animation: scrollText 20s infinite linear;
      font-size: 2.5rem;
      font-weight: bold;
      color: white;
      opacity: 0.9;
      padding: 0 2rem;
    }

    @keyframes scrollText {
      from {
        transform: translateX(100%);
      }
      to {
        transform: translateX(-100%);
      }
    }

    .button-group {
      display: flex;
      gap: 1rem;
      margin-top: 1.5rem;
    }

    .btn-secondary {
      display: inline-block;
      padding: 0.75rem 1.5rem;
      border: 2px solid #2563eb;
      color: #2563eb;
      border-radius: 9999px;
      transition: all 0.3s ease;
    }

    .btn-secondary:hover {
      background: #2563eb;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }
  </style>
</head>
<body class="bg-white text-gray-800">
  <!-- Navbar with animation -->
  <nav class="flex justify-between items-center p-4 bg-[#2563eb] text-white sticky top-0 z-50 fade-in">
    <div class="text-xl font-bold pulse">EduConnect</div>
    <div>
      <a href="#fitur" class="mx-3 text-sm hover:underline transition-all duration-300">Fitur</a>
      <a href="/register" class="mx-3 text-sm hover:underline transition-all duration-300">Daftar</a>
    </div>
  </nav>

  <!-- Hero Section with animation -->
  <section class="flex flex-col md:flex-row items-center justify-between px-6 md:px-20 py-6 bg-white">
    <div class="max-w-xl fade-in" style="animation-delay: 0.2s">
      <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] leading-tight">Koneksikan Ilmu, Bangun Masa Depan</h1>
      <p class="mt-4 text-base text-gray-600">EduConnect adalah platform kolaboratif antara mahasiswa, mentor, dan dunia industri. Temukan catatan, bimbingan, forum diskusi, dan lowongan magang terbaik!</p>
      <div class="button-group mt-4">
        <a href="/register" class="inline-block px-5 py-2 bg-[#2563eb] text-white rounded-full hover:bg-blue-700 transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
          Gabung Sekarang
        </a>
        <a href="/login" class="btn-secondary text-sm">
          Sudah Punya Akun?
        </a>
      </div>
    </div>
    <img src="{{ asset('images/logolanding.png') }}" alt="EduConnect" class="w-full md:w-1/2 mt-8 md:mt-0 fade-in hover-float" style="animation-delay: 0.4s">
  </section>

  <div class="infinite-scroll">
    <div class="scroll-text">
        EduConnect &nbsp;&nbsp;&nbsp; EduConnect &nbsp;&nbsp;&nbsp; EduConnect &nbsp;&nbsp;&nbsp; EduConnect &nbsp;&nbsp;&nbsp; EduConnect
    </div>
  </div>

  <!-- Updated Fitur Unggulan -->
  <section id="fitur" class="bg-gray-100 py-20 px-6 md:px-20">
    <h2 class="text-3xl font-bold text-center text-[#2563eb] mb-10 fade-in">Fitur Unggulan</h2>
    <div class="grid md:grid-cols-4 gap-8">
      <div class="bg-white shadow-md p-6 rounded-xl hover:scale-105 transition-all duration-300 hover:shadow-xl fade-in hover-float" style="animation-delay: 0.2s">
        <h3 class="text-xl font-semibold text-[#2563eb]">Forum & Catatan</h3>
        <p class="mt-3 text-sm text-gray-600">Diskusi akademik & catatan berkualitas dengan sistem upvote, badge, dan komentar.</p>
      </div>
      <div class="bg-white shadow-md p-6 rounded-xl hover:scale-105 transition-all duration-300 hover:shadow-xl fade-in hover-float" style="animation-delay: 0.3s">
        <h3 class="text-xl font-semibold text-[#2563eb]">Event Webinar</h3>
        <p class="mt-3 text-sm text-gray-600">Ikuti webinar edukatif dari para ahli dan dapatkan sertifikat kehadiran.</p>
      </div>
      <div class="bg-white shadow-md p-6 rounded-xl hover:scale-105 transition-all duration-300 hover:shadow-xl fade-in hover-float" style="animation-delay: 0.4s">
        <h3 class="text-xl font-semibold text-[#2563eb]">Bookmark Catatan</h3>
        <p class="mt-3 text-sm text-gray-600">Simpan dan kelola catatan favoritmu untuk akses yang lebih mudah.</p>
      </div>
      <div class="bg-white shadow-md p-6 rounded-xl hover:scale-105 transition-all duration-300 hover:shadow-xl fade-in hover-float" style="animation-delay: 0.5s">
        <h3 class="text-xl font-semibold text-[#2563eb]">Paket Premium</h3>
        <p class="mt-3 text-sm text-gray-600">Akses fitur eksklusif dan materi premium untuk pengalaman belajar maksimal.</p>
      </div>
    </div>
  </section>

  <!-- Enhanced Footer -->
  <footer class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-6">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="fade-in" style="animation-delay: 0.2s">
          <h3 class="text-xl font-bold mb-4">EduConnect</h3>
          <p class="text-gray-400 text-sm">Platform pembelajaran kolaboratif untuk mahasiswa Indonesia.</p>
        </div>
        <div class="fade-in" style="animation-delay: 0.3s">
          <h4 class="text-lg font-semibold mb-4">Fitur</h4>
          <ul class="text-gray-400 text-sm space-y-2">
            <li><a href="#" class="hover:text-white transition-colors">Forum Diskusi</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Catatan Kuliah</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Event Webinar</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Paket Premium</a></li>
          </ul>
        </div>
        <div class="fade-in" style="animation-delay: 0.4s">
          <h4 class="text-lg font-semibold mb-4">Bantuan</h4>
          <ul class="text-gray-400 text-sm space-y-2">
            <li><a href="#" class="hover:text-white transition-colors">Pusat Bantuan</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a></li>
            <li><a href="#" class="hover:text-white transition-colors">Hubungi Kami</a></li>
          </ul>
        </div>
        <div class="fade-in" style="animation-delay: 0.5s">
          <h4 class="text-lg font-semibold mb-4">Ikuti Kami</h4>
          <div class="flex space-x-4">
            <a href="#" class="text-gray-400 hover:text-white transition-colors">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
            </a>
          </div>
        </div>
      </div>
      <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
        <p>&copy; 2025 EduConnect. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Animation Script -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Intersection Observer for fade-in animations
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.style.animation = `fadeIn 0.6s ease-out forwards ${entry.target.dataset.delay || '0s'}`;
          }
        });
      }, { threshold: 0.1 });

      document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
    });
  </script>
</body>
</html>