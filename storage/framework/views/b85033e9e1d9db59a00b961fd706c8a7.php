
<?php $__env->startSection('title', 'Lịch sử đơn hàng'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top">
                    <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-warning-gradient">
                            <svg class="fs-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                                <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4">
                                    <path d="M44 14L24 4L4 14v20l20 10l20-10z"/>
                                    <path stroke-linecap="round" d="m4 14l20 10m0 20V24m20-10L24 24M34 9L14 19"/>
                                </g>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                <?php echo e($totalProductSelling); ?>         
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">SẢN PHẦM TỒN KHO</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top">
                    <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-primary-gradient">
                            <svg class="fs-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                                <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4">
                                    <path d="M44 14L24 4L4 14v20l20 10l20-10z"/>
                                    <path stroke-linecap="round" d="m4 14l20 10m0 20V24m20-10L24 24M34 9L14 19"/>
                                </g>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                <?php echo e($totalProductOrder); ?>                                   
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">SẢN PHẨM ĐÃ BÁN</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top">
                    <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-success-gradient">
                            <svg class="fs-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M3 10V8a2 2 0 0 1 2-2h2m-4 4c1.333 0 4-.8 4-4m-4 4v4m18-4V8a2 2 0 0 0-2-2h-2m4 4c-1.333 0-4-.8-4-4m4 4v4M7 6h10m4 8v2a2 2 0 0 1-2 2h-2m4-4c-1.333 0-4 .8-4 4m0 0H7m-4-4v2a2 2 0 0 0 2 2h2m-4-4c1.333 0 4 .8 4 4"></path>
                                    <circle cx="12" cy="12" r="2"></circle>
                                </g>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                <?php echo e(number_format($totalProductProfit)); ?>đ           
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">LỢI NHUẬN SẢN PHẨM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header">
                <h4 class="card-title">Lịch sử đơn hàng</h4>
            </div>
            <div class="card-body">
                <form action="" class="mb-3">
                    <div class="col-md-2">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm..." value="<?php echo e(request()->get('search')); ?>">
                            <button class="btn btn-primary" type="submit"><i class="ti ti-search"></i></button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                    <table class="table table-hover table-bordered table-striped fw-bold mb-0">
                        <thead>
                            <th>ID</th>
                            <th>Tài khoản</th>
                            <th>Số tiền</th>
                            <th>Dữ liệu</th>
                            <th>Sản phẩm</th>
                            <th>Trạng thái</th>
                            <th>Thời gian</th>
                        </thead>
                        <tbody>
                            <?php if($products->isEmpty()): ?>
                            <?php echo $__env->make('admin.components.table-search-not-found', ['colspan' => 7], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php else: ?>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($product->id); ?></td>
                                <td><?php echo e($product->user->username ?? $product->user_id); ?></td>
                                <td><?php echo e(number_format($product->total)); ?>đ</td>
                                <td>
                                    <textarea class="form-control" readonly><?php echo e($product->data); ?></textarea>
                                </td>
                                <td><?php echo e($product->product->name ?? "Không xác định"); ?></td>
                                <td>
                                    <?php if($product->status == 'success'): ?>
                                    <span class="badge bg-success-gradient">Thành công</span>
                                    <?php elseif($product->status =='fail'): ?>
                                    <span class="badge bg-danger-gradient">Thất bại</span>
                                    <?php else: ?>
                                    <span class="badge bg-warning-gradient">Đang xử lý</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($product->created_at); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center align-items-center mt-3 pagination-style-1">
                        <?php echo e($products->appends(request()->all())->links('pagination::bootstrap-4')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/trumsubr/public_html/resources/views/admin/history/products.blade.php ENDPATH**/ ?>