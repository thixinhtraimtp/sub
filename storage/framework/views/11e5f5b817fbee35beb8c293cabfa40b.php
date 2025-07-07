<?php $__env->startSection('title', 'Chỉnh sửa nền tảng'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title">Chỉnh sửa nền tảng</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.service.platform.update', ['id' => $platform->id])); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="order" placeholder="Thứ tự hiển thị"
                                value="<?php echo e($platform->order); ?>">
                            <label for="order">Thứ tự hiển thị</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Tên nền tảng của dịch vụ"
                                value="<?php echo e($platform->name); ?>">
                            <label for="name">Tên nền tảng</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="slug" placeholder="Đường dẫn của nền tảng"
                                value="<?php echo e($platform->slug); ?>">
                            <label for="slug">Đường dẫn</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="image" placeholder="Nhập hình ảnh"
                                value="<?php echo e($platform->image); ?>">
                            <label for="image">Hình ảnh</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="status" class="form-select">
                                <option value="active" <?php if($platform->status == 'active'): ?> selected <?php endif; ?>>Hoạt động
                                </option>
                                <option value="inactive" <?php if($platform->status == 'inactive'): ?> selected <?php endif; ?>>Không hoạt
                                    động</option>
                            </select>
                            <label for="status">Trạng thái</label>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seeding1/public_html/resources/views/admin/service/platform-edit.blade.php ENDPATH**/ ?>