<?php $__env->startSection('title', 'Kelola Mata Kuliah'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <h2 class="mb-4">🛠️ Kelola Mata Kuliah</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
        <i class="bi bi-plus-circle"></i> Tambah Mata Kuliah
    </button>

    <!-- Tabel Matkul -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kode</th>
                <th>Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $mataKuliah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($mk->nama); ?></td>
                    <td><?php echo e($mk->kode); ?></td>
                    <td><?php echo e($mk->prodi); ?></td>
                    <td>
                        <!-- Tombol Edit -->
                        <button class="btn btn-warning btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editModal<?php echo e($mk->id); ?>">
                            Edit
                        </button>

                        <!-- Form Hapus -->
                        <form action="<?php echo e(route('matkul.destroy', $mk->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus matkul ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal<?php echo e($mk->id); ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo e($mk->id); ?>" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    <form action="<?php echo e(route('matkul.update', $mk->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="modal-header">
                          <h5 class="modal-title" id="editModalLabel<?php echo e($mk->id); ?>">Edit Mata Kuliah</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                              <label>Nama</label>
                              <input type="text" name="nama" class="form-control" value="<?php echo e($mk->nama); ?>" required>
                          </div>
                          <div class="mb-3">
                              <label>Kode</label>
                              <input type="text" name="kode" class="form-control" value="<?php echo e($mk->kode); ?>" required>
                          </div>
                          <div class="mb-3">
                              <label>Prodi</label>
                              <input type="text" name="prodi" class="form-control" value="<?php echo e($mk->prodi); ?>" required>
                          </div>
                          <div class="mb-3">
                            <label>Sampul (Opsional)</label>
                            <input type="file" name="gambar" class="form-control">
                            <?php if($mk->gambar): ?>
                                <img src="<?php echo e(asset('storage/sampul/' . $mk->gambar)); ?>" alt="Sampul" class="img-thumbnail mt-2" width="120">
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo e(route('matkul.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Mata Kuliah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Kode</label>
              <input type="text" name="kode" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Prodi</label>
              <input type="text" name="prodi" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Sampul (Opsional)</label>
              <input type="file" name="gambar" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\SMT6\educonnect\project-educonnect\resources\views/matkul/manage.blade.php ENDPATH**/ ?>