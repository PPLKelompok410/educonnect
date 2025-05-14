<?php $__env->startSection('title', 'Catatan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
  <h2 class="mb-4 text-center">📚 Pilih Mata Kuliah</h2>
  
  <div class="d-flex justify-content-end mb-3">
    <a href="<?php echo e(route('matkul.manage')); ?>" class="btn btn-success">
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
            <?php $__currentLoopData = $prodis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prodi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($prodi); ?>"><?php echo e($prodi); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
  <?php $__currentLoopData = $mataKuliah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="col-md-4 mb-4 mata-kuliah" data-prodi="<?php echo e($mk->prodi); ?>">
    <a href="<?php echo e(url('matkul/' . $mk->id)); ?>" class="text-decoration-none text-dark">
        <div class="card shadow-sm h-100">
        <img 
          src="<?php echo e($mk->gambar ? asset('storage/sampul/' . $mk->gambar) : asset('images/default-photo.jpg')); ?>" 
          class="card-img-top object-fit-cover" 
          style="height: 200px;" 
          alt="<?php echo e($mk->nama); ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo e($mk->nama); ?></h5>
                <p class="card-text">Kode: <?php echo e($mk->kode); ?></p>
                <span class="badge bg-primary"><?php echo e($mk->prodi); ?></span>
            </div>
        </div>
    </a>
</div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\SMT6\educonnect\project-educonnect\resources\views/matkul/galleryMatkul.blade.php ENDPATH**/ ?>