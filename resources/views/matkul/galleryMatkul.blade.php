@extends('layouts.app')

@section('title', 'Catatan')

@section('content')

@php
$currentUser = session('user');
@endphp

<div class="min-h-screen">
  <!-- Page Header with Enhanced Design -->
  <div class="relative overflow-hidden mb-2 rounded-xl">
    <div class="relative px-8 py-12">
      <div class="flex justify-between items-center">
        <div>
          <h1 class="font-title text-4xl font-bold text-gray-800 flex items-center mb-3">
            <span class="text-5xl mr-4">📚</span>
            <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
              Pilih Mata Kuliah
            </span>
          </h1>
          <p class="text-gray-600 text-lg max-w-2xl">
            Jelajahi koleksi mata kuliah dan akses catatan serta materi pembelajaran yang tersedia
          </p>
        </div>
        @if ($currentUser->full_name === 'admin')
        <a href="{{ route('matkul.manage') }}" class="inline-flex items-center px-3 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-md">
          <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          <span class="font-semibold">Kelola Mata Kuliah</span>
        </a>
        @endif
      </div>
    </div>
  </div>

  <div class="px-8 pb-8">
    <!-- Enhanced Filter & Search Section -->
    <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-2xl p-8 mb-12 border border-white/20">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="space-y-3">
          <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center mr-3">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z" />
              </svg>
            </div>
            Filter Program Studi
          </label>
          <div class="relative">
            <select id="filterProdi" class="w-full appearance-none border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 rounded-xl p-4 pr-12 bg-white transition-all duration-300 text-gray-700 font-medium shadow-sm hover:shadow-md cursor-pointer">
              <option value="all">🎓 Semua Program Studi</option>
              @foreach ($prodis as $prodi)
              <option value="{{ $prodi }}">{{ $prodi }}</option>
              @endforeach
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
              <svg class="w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>
          </div>
        </div>
        
        <div class="space-y-3">
          <label class="flex items-center text-sm font-semibold text-gray-700 mb-3">
            <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center mr-3">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </div>
            Cari Mata Kuliah
          </label>
          <div class="relative">
            <input type="text" id="searchMatkul" 
                   class="w-full border-2 border-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 rounded-xl p-4 pl-12 bg-white transition-all duration-300 text-gray-700 font-medium" 
                   placeholder="🔍 Masukkan nama mata kuliah...">
            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Enhanced Mata Kuliah Gallery -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="mataKuliahGallery">
      @foreach ($mataKuliah as $mk)
      <div class="mata-kuliah group" data-prodi="{{ strtolower($mk->prodi) }}">
        <a href="{{ url('matkul/' . $mk->id) }}" 
           class="block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform group-hover:-translate-y-2 group-hover:scale-105 border border-gray-100">
          
          <!-- Image Container with Overlay -->
          <div class="relative overflow-hidden">
            <img src="{{ $mk->gambar ? asset('images/' . $mk->gambar) : asset('images/default-photo.jpg') }}"
                 class="w-full h-56 object-cover transition-transform duration-700 group-hover:scale-110"
                 alt="{{ $mk->nama }}">
            
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            <!-- Floating Action Icon -->
            <div class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 transition-all duration-300">
              <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </div>
          </div>
          
          <!-- Content Section -->
          <div class="p-6 space-y-4">
            <div class="space-y-2">
              <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300 line-clamp-2">
                {{ $mk->nama }}
              </h3>
              <div class="flex items-center text-sm text-gray-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                </svg>
                Kode: <span class="font-semibold ml-1">{{ $mk->kode }}</span>
              </div>
            </div>
            
            <!-- Program Studi Badge -->
            <div class="flex items-center justify-between">
              <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-md">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.228 11.228 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                </svg>
                {{ $mk->prodi }}
              </span>
              
              <!-- View Arrow -->
              <div class="w-8 h-8 rounded-full bg-gray-100 group-hover:bg-blue-100 flex items-center justify-center transition-all duration-300">
                <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 transform group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    
    <!-- Empty State -->
    <div id="emptyState" class="hidden text-center py-16">
      <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.29-1.007-5.824-2.632M15 6.306a7.986 7.986 0 00-5.674-2.338A7.987 7.987 0 003.677 6.306M12 18V9" />
        </svg>
      </div>
      <h3 class="text-2xl font-bold text-gray-800 mb-4">Tidak ada mata kuliah ditemukan</h3>
      <p class="text-gray-600 text-lg">Coba ubah filter atau kata kunci pencarian Anda</p>
    </div>
  </div>
</div>

<style>
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.mata-kuliah {
  animation: fadeInUp 0.6s ease-out;
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Custom Select Dropdown Styling */
select {
  background-image: none;
}

select:focus + div svg {
  transform: rotate(180deg);
}

select option {
  padding: 12px 16px;
  background: white;
  color: #374151;
  font-weight: 500;
}

select option:hover {
  background: #f3f4f6;
}

/* Custom scrollbar for better UX */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f5f9;
  border-radius: 10px;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(to bottom, #3b82f6, #6366f1);
  border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(to bottom, #2563eb, #4f46e5);
}
</style>

<script>
  const filterProdi = document.getElementById('filterProdi');
  const searchInput = document.getElementById('searchMatkul');
  const mataKuliahCards = document.querySelectorAll('.mata-kuliah');
  const emptyState = document.getElementById('emptyState');

  function filterGallery() {
    const selectedProdi = filterProdi.value.toLowerCase();
    const searchTerm = searchInput.value.toLowerCase();
    let visibleCount = 0;

    mataKuliahCards.forEach((card, index) => {
      const prodi = card.dataset.prodi.toLowerCase();
      const title = card.querySelector('h3').textContent.toLowerCase();

      const matchesProdi = selectedProdi === 'all' || prodi === selectedProdi;
      const matchesSearch = title.includes(searchTerm);
      const shouldShow = matchesProdi && matchesSearch;

      if (shouldShow) {
        card.style.display = 'block';
        // Add staggered animation delay
        card.style.animationDelay = `${index * 0.1}s`;
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    // Show/hide empty state
    if (visibleCount === 0) {
      emptyState.classList.remove('hidden');
    } else {
      emptyState.classList.add('hidden');
    }
  }

  // Add smooth transitions for filter changes
  function addFilterTransition() {
    mataKuliahCards.forEach(card => {
      card.style.transition = 'all 0.3s ease-in-out';
    });
  }

  filterProdi.addEventListener('change', () => {
    addFilterTransition();
    setTimeout(filterGallery, 50);
  });
  
  searchInput.addEventListener('input', () => {
    addFilterTransition();
    setTimeout(filterGallery, 50);
  });

  // Add loading animation on page load
  document.addEventListener('DOMContentLoaded', () => {
    mataKuliahCards.forEach((card, index) => {
      card.style.animationDelay = `${index * 0.1}s`;
    });
  });
</script>
@endsection