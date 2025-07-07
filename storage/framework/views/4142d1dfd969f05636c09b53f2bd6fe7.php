<?php $__env->startSection('title', 'Lịch sử giao dịch'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">Lịch sử giao dịch</h5>
            </div>
            <div class="card-body">
                <form action="" method="GET">
                    <div class="row row-cols-lg-auto g-3 mb-3">
                        <div class="col-md-1 col-6">
                            <select name="per_page" id="per_page" class="form-control " onchange="this.form.submit()">
                                <?php $__currentLoopData = [10, 25, 50, 100, 1000, 5000, 10000]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($option); ?>" <?php echo e(request('per_page') == $option ? 'selected' : ''); ?>>
                                        - <?php echo e($option); ?> -
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-lg col-md-4 col-6">
                            <input type="text" name="search" class="form-control" value="<?php echo e(request('search')); ?>" placeholder="Tìm kiếm...">
                        </div>
                        <div class="col-lg col-md-4 col-6">
                            <select name="type" class="form-control">
                                <option value="">-- Giao Dịch --</option>
                                <option value="recharge">Nạp Tiền</option>
                                <option value="order">Mua Đơn</option>
                                <option value="balance">Số dư</option>
                                <option value="refund">Hoàn tiền</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <button type="submit" class="btn btn-primary w-100"><i class="ti ti-search"></i> Tìm
                            Kiếm</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive table-wrapper mb-3">
                    <table class="table text-nowrap table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ngày giao dịch</th>
                                <th>Người dùng</th>
                                <th>Loại giao dịch</th>
                                <th>Mã giao dịch</th>
                                <th>Số dư</th>
                                <th>Số dư đầu</th>
                                <th>Số dư cuối</th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>#<?php echo e($transaction->id); ?></td>
                                <td><?php echo e($transaction->created_at); ?></td>
                                <td><?php echo e($transaction->user->username); ?></td>
                                <td>
                                    <?php if($transaction->type == 'recharge'): ?>
                                    <span class="badge bg-success-gradient">Nạp tiền</span>
                                    <?php elseif($transaction->type == 'order'): ?>
                                    <span class="badge bg-primary-gradient">Đơn hàng</span>
                                    <?php elseif($transaction->type == 'balance'): ?>
                                    <span class="badge bg-info-gradient">Thay đổi</span>
                                    <?php elseif($transaction->type == 'refund'): ?>
                                    <span class="badge bg-danger-gradient">Hoàn tiền</span>
                                    <?php elseif($transaction->type == 'withdraw'): ?>
                                    <span class="badge bg-warning-gradient">Tạo lệnh rút tiền</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-gradient"><?php echo e($transaction->tran_code); ?></span>
                                </td>
                                <td class="fw-bold text-muted"><?php echo e(number_format($transaction->before_balance)); ?> VNĐ
                                </td>
                                <td class="fw-bold text-muted">
                                    <?php if($transaction->action == 'add'): ?>
                                    <p class="mb-0 text-successt">
                                        +<?php echo e(number_format($transaction->first_balance)); ?> VNĐ
                                    </p>
                                    <?php elseif($transaction->action == 'sub'): ?>
                                    <p class="mb-0 text-danger">
                                        -<?php echo e(number_format($transaction->first_balance)); ?> VNĐ
                                    </p>
                                    <?php endif; ?>
                                </td>
                                <td class="fw-bold text-muted"><?php echo e(number_format($transaction->after_balance)); ?> VNĐ
                                </td>
                                <td><?php echo e($transaction->note); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center align-items-center mt-3 pagination-style-1">
                        <?php echo e($transactions->appends(request()->all())->links('pagination::bootstrap-4')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khosubv1/public_html/resources/views/admin/history/user.blade.php ENDPATH**/ ?>