

<?php $__env->startSection('title', 'Edit Komentar'); ?>

<?php $__env->startSection('content'); ?>

<div class="container d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <h3 class="text-center mb-4">Edit Comment</h3>
        <form action="<?php echo e(route('comments.update', $comment->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea name="comment" id="comment" class="form-control" rows="4" required><?php echo e($comment->comment); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Comment</button>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\SMT6\educonnect\project-educonnect\resources\views/comments/edit.blade.php ENDPATH**/ ?>