<?php $__env->startSection('title', 'Mua tài khoản'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <div class="card border shadow">
                    <div class="card-body p-3">
                        <a href="<?php echo e(route('product.category', ['slug' => $category->slug])); ?>">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avtar avtar-l">
                                    <img src="<?php echo e(asset(json_decode($category->image, true)[0] ?? 'images/default-image.jpg')); ?>" class="img-fluid" alt="<?php echo e($category->name); ?>">

                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-0 fw-bold fs-8 text-dark"><?php echo e($category->name); ?></p>
                                    <p class="text-muted fs-9 mb-1"><?php echo substr($category->note, 0, 50); ?></p>
                                    <div>
                                        <span class="badge bg-light-secondary"><?php echo e(number_format($category->price)); ?> VNĐ</span>
                                        <span class="badge bg-light-secondary">Còn lại <span
                                                class="text-success"><?php echo e(number_format($category->products->where('status', 'selling')->count())); ?></span></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('guard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dailysie/khosubvip.top/resources/views/guard/product/view-categories.blade.php ENDPATH**/ ?>