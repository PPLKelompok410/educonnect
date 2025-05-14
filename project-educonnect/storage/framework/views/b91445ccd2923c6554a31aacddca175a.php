<?php $__env->startSection('content'); ?>
<div class="container px-3 px-md-5 my-5">

    
    <h2 class="mb-4 text-success">
        <i class="fas fa-folder-open"></i> Daftar Catatan – <span class="text-dark"><?php echo e($matkul->nama); ?></span>
    </h2>

    <?php if($notes->count() > 0): ?>
        <div class="row">
            <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title"><?php echo e($note->judul); ?></h5>
                                <p class="card-text mb-2">
                                    Dibagikan oleh: <strong><?php echo e($note->user->full_name); ?></strong><br>
                                    <small class="text-muted"><?php echo e($note->created_at->format('d M Y')); ?></small>
                                </p>
                            </div>
                            <a href="<?php echo e(route('notes.show', $note->id)); ?>" class="btn btn-outline-primary btn-sm mt-auto">
                                <i class="fas fa-eye"></i> Lihat Catatan
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <p class="text-muted">Belum ada catatan yang dibagikan.</p>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\SMT6\educonnect\project-educonnect\resources\views/notes/index.blade.php ENDPATH**/ ?>