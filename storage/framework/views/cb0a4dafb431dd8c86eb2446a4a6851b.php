<?php $__env->startSection('title', 'Lịch sử giao dịch'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title">Lịch sử giao dịch</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ngày giao dịch</th>
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
                                        <td>#<?php echo e($key + 1); ?></td>
                                        <td><?php echo e($transaction->created_at); ?></td>
                                        <td>
                                            <?php if($transaction->type == 'recharge'): ?>
                                                <span class="badge bg-success">Nạp tiền</span>
                                            <?php elseif($transaction->type == 'order'): ?>
                                                <span class="badge bg-primary">Đơn hàng</span>
                                            <?php elseif($transaction->type == 'balance'): ?>
                                                <span class="badge bg-info">Thay đổi</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary"><?php echo e($transaction->tran_code); ?></span>
                                        </td>
                                        <td class="fw-bold text-muted"><?php echo e(number_format($transaction->before_balance)); ?> VNĐ
                                        </td>
                                        <td class="fw-bold text-muted">
                                            <?php if($transaction->action == 'add'): ?>
                                                <p class="mb-0 text-success">
                                                    +<?php echo e(number_format($transaction->first_balance)); ?> VNĐ</p>
                                            <?php elseif($transaction->action == 'sub'): ?>
                                                <p class="mb-0 text-danger">
                                                    -<?php echo e(number_format($transaction->first_balance)); ?> VNĐ</p>
                                            <?php endif; ?>
                                        </td>
                                        <td class="fw-bold text-muted"><?php echo e(number_format($transaction->after_balance)); ?> VNĐ
                                        </td>
                                        <td><?php echo e($transaction->note); ?></td>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\socialmedia\app\resources\views/admin/user/transactions.blade.php ENDPATH**/ ?>