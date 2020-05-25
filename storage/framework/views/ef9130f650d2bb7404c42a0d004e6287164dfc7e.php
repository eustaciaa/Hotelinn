

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-3">Daftar Hotel</h1>
            <?php if(session('status')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            <ul class="list-group">
                <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <h5 class="mb-1"><?php echo e($hotel->hotel->name); ?></h5>
                        <p><?php echo e($hotel->detailLengkap); ?></p>
                        <a href="/admin/hotels/<?php echo e($hotel->hotel->id); ?>" class="badge badge-info">Detail</a>
                        <a href="#" class="badge badge-info mx-1">Ubah Alamat</a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <a href="/admin" class="btn btn-primary my-3">Kembali</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\hotelinn\resources\views/admin/hotel-index.blade.php ENDPATH**/ ?>