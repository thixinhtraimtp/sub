
<?php $__env->startSection('title', 'Chỉnh sửa đối tác smm'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title">Chỉnh sửa đối tác smm</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.service.smm.update', ['id' => $smm->id])); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="order" placeholder="Thứ tự hiển thị"
                                value="<?php echo e($smm->order); ?>">
                            <label for="order">Thứ tự hiển thị</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Link SMM"
                                value="<?php echo e($smm->name); ?>">
                            <label for="name">Đường link smm</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="token" placeholder="Token"
                                value="<?php echo e($smm->token); ?>">
                            <label for="token">Token</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="tigia" placeholder="Tỉ giá"
                                value="<?php echo e($smm->tigia); ?>">
                            <label for="tigia">Tỉ giá SMM</label>
                        </div>
                        
                        <div class="form-group">
                            <button class="btn btn-primary col-12">
                                <i class="fas fa-save"></i> Thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tkhosubviptop/public_html/resources/views/admin/service/smm-edit.blade.php ENDPATH**/ ?>