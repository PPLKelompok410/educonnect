@extends('layouts.app')

@section('title', 'Catatan')

@section('content')
<div class="container py-5">
  <h2 class="mb-4 text-center">📚 Pilih Mata Kuliah</h2>
  
  <!-- Filter dan Search -->
   <div class="row mb-4 justify-content-center">
        <div class="input-group w-auto">
            <span class="input-group-text bg-white">
            <i class="bi bi-funnel-fill"></i>
            </span>
            <select id="filterProdi" class="form-select">
            <option value="all">Semua Program Studi</option>
            @foreach ($prodis as $prodi)
                <option value="{{ $prodi }}">{{ $prodi }}</option>
            @endforeach
            </select>
        </div>
        <div class="col-md-4 mt-2 mt-md-0">
            <div class="input-group">
                <span class="input-group-text bg-white">
                     <i class="bi bi-search"></i>
                </span>
                <input type="text" id="searchMatkul" class="form-control" placeholder="Cari mata kuliah..." />
            </div>
        </div>
    </div>

  <!-- Gallery -->
  <div class="row" id="mataKuliahGallery">
  @foreach ($mataKuliah as $mk)
    <div class="col-md-4 mb-4 mata-kuliah" data-prodi="{{ $mk->prodi }}">
        <div class="card shadow-sm">
        <img src="{{ $mk->gambar ?? 'https://images.pexels.com/photos/28216688/pexels-photo-28216688/free-photo-of-autumn-camping.png?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2' . urlencode($mk->nama) }}" class="card-img-top" alt="{{ $mk->nama }}" />
            <div class="card-body">
                <h5 class="card-title">{{ $mk->nama }}</h5>
                <p class="card-text">Kode: {{ $mk->kode }}</p>
                <span class="badge bg-primary">{{ $mk->prodi }}</span>
            </div>
        </div>
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
      const title = card.querySelector('.card-title').textContent.toLowerCase();

      const matchesProdi = selectedProdi === 'all' || prodi === selectedProdi;
      const matchesSearch = title.includes(searchTerm);

      card.style.display = (matchesProdi && matchesSearch) ? 'block' : 'none';
    });
  }

  filterProdi.addEventListener('change', filterGallery);
  searchInput.addEventListener('input', filterGallery);
</script>
@endsection