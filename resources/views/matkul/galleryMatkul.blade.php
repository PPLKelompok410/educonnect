@extends('layouts.app')

@section('title', 'Catatan')

@section('content')
<div class="flex-1 p-8 bg-gray-50">
  <!-- Page Header -->
  <div class="mb-8">
    <div class="flex justify-between items-center">
      <div>
        <h1 class="font-title text-3xl text-gray-800 flex items-center">
          📚 Pilih Mata Kuliah
        </h1>
        <p class="text-gray-600 mt-2">Pilih mata kuliah untuk melihat catatan dan materi pembelajaran</p>
      </div>
      <a href="{{ route('matkul.manage') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Kelola Matkul
      </a>
    </div>
  </div>

  <!-- Filter & Search -->
  <div class="bg-white shadow rounded p-6 mb-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
          <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z" />
          </svg>
          Filter Program Studi
        </label>
        <select id="filterProdi" class="w-full border-gray-300 rounded p-2">
          <option value="all">Semua Program Studi</option>
          @foreach ($prodis as $prodi)
          <option value="{{ $prodi }}">{{ $prodi }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
          <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
          Cari Mata Kuliah
        </label>
        <input type="text" id="searchMatkul" class="w-full border-gray-300 rounded p-2" placeholder="Masukkan nama mata kuliah...">
      </div>
    </div>
  </div>

  <!-- Mata Kuliah Gallery -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="mataKuliahGallery">
    @foreach ($mataKuliah as $mk)
    <div class="mata-kuliah" data-prodi="{{ strtolower($mk->prodi) }}">
      <a href="{{ url('matkul/' . $mk->id) }}" class="block bg-white rounded shadow hover:shadow-lg transition overflow-hidden">
        <img
          src="{{ $mk->gambar ? asset('storage/sampul/' . $mk->gambar) : asset('images/default-photo.jpg') }}"
          class="w-full h-48 object-cover"
          alt="{{ $mk->nama }}">
        <div class="p-4">
          <h3 class="text-lg font-semibold text-gray-800">{{ $mk->nama }}</h3>
          <p class="text-sm text-gray-600 mb-2">Kode: {{ $mk->kode }}</p>
          <span class="inline-block bg-blue-600 text-white text-xs font-semibold px-2 py-1 rounded">{{ $mk->prodi }}</span>
        </div>
      </a>
    </div>
    @endforeach
  </div>
</div>

<script>
  const filterProdi = document.getElementById('filterProdi');
  const searchInput = document.getElementById('searchMatkul');
  const mataKuliahCards = document.querySelectorAll('.mata-kuliah');

  function filterGallery() {
    const selectedProdi = filterProdi.value.toLowerCase();
    const searchTerm = searchInput.value.toLowerCase();

    mataKuliahCards.forEach(card => {
      const prodi = card.dataset.prodi.toLowerCase();
      const title = card.querySelector('h3').textContent.toLowerCase();

      const matchesProdi = selectedProdi === 'all' || prodi === selectedProdi;
      const matchesSearch = title.includes(searchTerm);

      card.style.display = (matchesProdi && matchesSearch) ? 'block' : 'none';
    });
  }

  filterProdi.addEventListener('change', filterGallery);
  searchInput.addEventListener('input', filterGallery);
</script>
@endsection