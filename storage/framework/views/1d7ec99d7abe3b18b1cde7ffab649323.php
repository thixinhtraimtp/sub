<?php $__env->startSection('title', 'Thêm sản phẩm'); ?>
<?php $__env->startSection('content'); ?>
<div class="card-body pc-component">
    <div id="new" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="new" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new">THÊM MỚI DANH MỤC</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="<?php echo e(route('admin.product.create')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="category_id" value="<?php echo e($category->id); ?>">
                        <div class="form-group mb-3">
                            <label for="data" class="form-label">Dữ liệu sản phẩm</label>
                            <textarea name="data" id="data" class="form-control" rows="10" placeholder="Mỗi dữ liệu 1 dòng
VD: tài khoản | mật khẩu |..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary-gradient col-12">Thêm sản phẩm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-12 text-right mb-3">
            <a href="<?php echo e(route('admin.product.category')); ?>" class="btn btn-primary-gradient">
            <i class="ti ti-arrow-back"></i> Quay lại
            </a>
        </div>
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h4 class="card-title">Danh sách sản phẩm</h4>
                    <div class="ms-auto">
                        <button class="btn btn-sm btn-danger-gradient" data-bs-toggle="modal" data-bs-target="#new">
                            <i class="ti ti-plus fw-bold"></i> Thêm mới
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                        <table id="data-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Thao tác</th>
                                    <th>Dữ liệu</th>
                                    <th>Trạng thái</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $category->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($product->id); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('admin.product.delete', ['id' => $product->id])); ?>" class="btn btn-danger-gradient btn-sm"  data-bs-toggle="tooltip" title="Xoá">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <textarea class="form-control" readonly><?php echo e($product->data); ?></textarea>
                                        </td>
                                        <td>
                                            <?php if($product->status == 'selling'): ?>
                                                <span class="badge bg-success-gradient">Đang bán</span>
                                            <?php elseif($product->status == 'stop'): ?>
                                                <span class="badge bg-danger-gradient">Ngừng bán</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning-gradient">Đã bán</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($product->created_at); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seeding1/public_html/resources/views/admin/production/product.blade.php ENDPATH**/ ?>