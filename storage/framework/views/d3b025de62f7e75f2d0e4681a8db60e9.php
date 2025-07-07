<?php $__env->startSection('title', 'Tài khoản đã mua'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="form-group mb-3">
                            <label for="search">Tìm kiếm</label>

                            <div class="input-group">
                                <input type="text" class="form-control" id="search" name="search"
                                    placeholder="Nhập tên sản phẩm">
                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Dữ liệu</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($products->isEmpty()): ?>
                                    <?php echo $__env->make('admin.components.table-search-not-found', ['colspan' => 7], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($product->product->name ?? "Không tồn tại"); ?></td>
                                        <td><?php echo e(number_format($product->price)); ?> VNĐ</td>
                                        <td><?php echo e(number_format($product->total)); ?> VNĐ</td>
                                        <td>
                                            <?php if($product->status == 'success'): ?>
                                                <span class="badge bg-success">Thành công</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Thất bại</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <textarea class="form-control" rows="1" readonly><?php echo e($product->data); ?></textarea>
                                        </td>
                                        <td><?php echo e($product->created_at); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end align-items-center">
                            <?php echo e($products->appends(request()->input())->links('pagination::bootstrap-4')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('guard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dailysie/hacksub.website/resources/views/guard/product/view-purchased.blade.php ENDPATH**/ ?>