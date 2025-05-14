<?php $__env->startSection('title', 'Forum Diskusi (' . $matkul->nama . ')'); ?>

<?php $__env->startSection('content'); ?>
<div class="container px-3 px-md-5 mt-5">
    <div class="border rounded p-4 mb-4 bg-light shadow-sm">
        <h2 class="mb-2">
            <i class="bi bi-chat-dots"></i> Forum Diskusi: 
            <span class="text-primary"><?php echo e($matkul->nama); ?></span>
        </h2>
        <p class="mb-0 text-muted">
            <i class="bi bi-journal-code"></i> Kode: <?php echo e($matkul->kode); ?> | 
            <i class="bi bi-building"></i> Prodi: <?php echo e($matkul->prodi); ?>

        </p>
    </div>

    <h4 class="mb-3"><i class="bi bi-chat-left-text"></i> Komentar</h4>

    <?php $__empty_1 = true; $__currentLoopData = $matkul->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <p class="card-text"><?php echo e($comment->comment); ?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        oleh <strong><?php echo e($comment->user->name); ?></strong> pada <?php echo e($comment->created_at->format('d M Y, H:i')); ?>

                    </small>

                    
                        <div>
                            <a href="<?php echo e(route('comments.edit', $comment->id)); ?>" class="btn btn-sm btn-outline-primary me-2">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <form action="<?php echo e(route('comments.destroy', $comment->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus komentar ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-muted">💬 Belum ada komentar. Jadilah yang pertama!</p>
    <?php endif; ?>

    <hr>

    <div class="mt-4">
        <h4><i class="bi bi-plus-circle"></i> Tambah Komentar</h4>
        <form action="<?php echo e(route('comments.store', $matkul->id)); ?>" method="POST" class="mt-3">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="comment" class="form-label">Komentar</label>
                <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Tulis komentarmu..." required></textarea>
            </div>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-send"></i> Kirim Komentar
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\educonnect\project-educonnect\resources\views/matkul/discussion.blade.php ENDPATH**/ ?>