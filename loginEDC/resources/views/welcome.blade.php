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
  </style>
</head>
<body class="bg-white text-gray-800">
  <!-- Navbar -->
  <nav class="flex justify-between items-center p-6 bg-[#2563eb] text-white">
    <div class="text-2xl font-bold">EduConnect</div>
    <div>
      <a href="#fitur" class="mx-3 hover:underline">Fitur</a>
      <a href="#tentang" class="mx-3 hover:underline">Tentang</a>
      <a href="#daftar" class="mx-3 hover:underline">Daftar</a>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="flex flex-col md:flex-row items-center justify-between px-6 md:px-20 py-20 bg-white">
    <div class="max-w-xl">
      <h1 class="text-4xl md:text-5xl font-bold text-[#2563eb] leading-tight">Koneksikan Ilmu, Bangun Masa Depan</h1>
      <p class="mt-6 text-lg text-gray-600">EduConnect adalah platform kolaboratif antara mahasiswa, mentor, dan dunia industri. Temukan catatan, bimbingan, forum diskusi, dan lowongan magang terbaik!</p>
      <a href="/register" class="inline-block mt-6 px-6 py-3 bg-[#2563eb] text-white rounded-full hover:bg-blue-700 transition">Gabung Sekarang</a>
    </div>
    <img src="{{ asset('assets/images/logolanding.png') }}" alt="EduConnect" class="w-full md:w-1/2 mt-10 md:mt-0">
  </section>

  <!-- Fitur Unggulan -->
  <section id="fitur" class="bg-gray-100 py-20 px-6 md:px-20">
    <h2 class="text-3xl font-bold text-center text-[#2563eb] mb-10">Fitur Unggulan</h2>
    <div class="grid md:grid-cols-3 gap-10">
      <div class="bg-white shadow-md p-6 rounded-xl hover:scale-105 transition">
        <h3 class="text-xl font-semibold text-[#2563eb]">Mentoring 1-on-1</h3>
        <p class="mt-3 text-sm text-gray-600">Terhubung langsung dengan dosen dan alumni sesuai minat dan jurusanmu.</p>
      </div>
      <div class="bg-white shadow-md p-6 rounded-xl hover:scale-105 transition">
        <h3 class="text-xl font-semibold text-[#2563eb]">Forum & Catatan</h3>
        <p class="mt-3 text-sm text-gray-600">Diskusi akademik & catatan berkualitas dengan sistem upvote, badge, dan komentar.</p>
      </div>
      <div class="bg-white shadow-md p-6 rounded-xl hover:scale-105 transition">
        <h3 class="text-xl font-semibold text-[#2563eb]">Lowongan Magang</h3>
        <p class="mt-3 text-sm text-gray-600">Lamar magang & kerja langsung dari perusahaan lewat profil lengkapmu.</p>
      </div>
    </div>
    <div class="text-center mt-10">
      <a href="/login" class="inline-block px-8 py-3 border border-[#2563eb] text-[#2563eb] rounded-full hover:bg-[#2563eb] hover:text-white transition">Masuk ke Platform</a>
    </div>
  </section>

  <!-- Tentang EduConnect -->
  <section id="tentang" class="py-20 px-6 md:px-20">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-3xl font-bold text-[#2563eb] mb-6">Menghubungkan Mahasiswa, Mentor, dan Dunia Industri</h2>
      <p class="text-gray-600">EduConnect dirancang untuk menjadi ekosistem pembelajaran dan pengembangan karier berbasis komunitas. Dengan fitur mentoring, pencarian lowongan, forum akademik, dan sistem reward, kami ingin menjadi sahabat digital mahasiswa Indonesia dalam menghadapi masa depan.</p>
    </div>
  </section>

  <!-- Call to Action -->
  <section id="daftar" class="bg-[#2563eb] text-white py-20 px-6 md:px-20 text-center">
    <h2 class="text-3xl font-bold">Siap Menjadi Bagian dari EduConnect?</h2>
    <p class="mt-4 text-lg">Daftarkan dirimu dan mulai perjalanan akademik dan profesionalmu sekarang.</p>
    <a href="/register" class="mt-6 inline-block px-8 py-3 bg-white text-[#2563eb] font-semibold rounded-full hover:bg-gray-100 transition">Daftar Sekarang</a>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-100 py-6 text-center text-sm text-gray-600">
    &copy; 2025 EduConnect. All rights reserved.
  </footer>
</body>
</html>