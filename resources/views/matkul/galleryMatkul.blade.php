@extends('layouts.app')

@section('title', 'Catatan')

@section('content')
<div class="container py-5">
  <h2 class="mb-4 text-center">📚 Pilih Mata Kuliah</h2>
  
  <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('matkul.manage') }}" class="btn btn-success">
        <i class="bi bi-gear-fill"></i> Kelola Matkul
    </a>
  </div>

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
    <a href="{{ url('matkul/' . $mk->id) }}" class="text-decoration-none text-dark">
        <div class="card shadow-sm h-100">
        <img 
          src="{{ $mk->gambar ? asset('storage/sampul/' . $mk->gambar) : asset('images/default-photo.jpg') }}" 
          class="card-img-top object-fit-cover" 
          style="height: 200px;" 
          alt="{{ $mk->nama }}">
            <div class="card-body">
                <h5 class="card-title">{{ $mk->nama }}</h5>
                <p class="card-text">Kode: {{ $mk->kode }}</p>
                <span class="badge bg-primary">{{ $mk->prodi }}</span>
            </div>
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