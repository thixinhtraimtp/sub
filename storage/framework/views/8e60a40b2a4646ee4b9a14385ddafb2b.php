<?php $__env->startSection('title', 'Thay đổi số dư'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title">Chỉnh sửa số dư</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.user.update-balance')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username" value="<?php echo e(request()->get('username')); ?>" name="username">
                            <label for="" class="form-label">
                                Tài khoản
                            </label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="balance" value="<?php echo e(request()->get('balance')); ?>" name="balance">
                            <label for="" class="form-label">
                                Số dư
                            </label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="note" name="note" style="height: 150px;"><?php echo e(request()->get('note')); ?></textarea>
                            <label for="" class="form-label">
                                Ghi chú
                            </label>
                        </div>
                        <div class="form-floating mb-3">'
                            <select class="form-control" id="type" name="type">
                                <option value="add" <?php echo e(request()->get('type') == 'add' ? 'selected' : ''); ?>>Cộng tiền</option>
                                <option value="sub" <?php echo e(request()->get('type') == 'sub' ? 'selected' : ''); ?>>Trừ tiền</option>
                            </select>
                            <label for="" class="form-label">
                                Thao tác
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/trumsubr/public_html/resources/views/admin/user/balance.blade.php ENDPATH**/ ?>