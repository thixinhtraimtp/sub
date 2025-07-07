<?php $__env->startSection('title', 'Nhật Ký'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5>Nhật ký</h5>
        </div>
        <div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="dom-table" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Giao dịch</th>
                            <th>Thời gian</th>
                            <th>Mã giao dịch</th>
                            <th>Số tiền</th>
                            <th>Số dư trước</th>
                            <th>Số dư sau</th>
                            <th>Nội dung</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold">
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td>
                                <?php if($transaction->type == 'recharge'): ?>
                                <span class="badge bg-success">Nạp tiền</span>
                                <?php elseif($transaction->type == 'order'): ?>
                                <span class="badge bg-primary">Tạo đơn</span>
                                <?php elseif($transaction->type == 'refund'): ?>
                                <span class="badge bg-danger">Hoàn tiền</span>
                                <?php elseif($transaction->type == 'balance'): ?>
                                <span class="badge bg-warning">Điều chỉnh số dư</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($transaction->created_at->diffForHumans()); ?></td>
                            <td><?php echo e($transaction->tran_code); ?></td>
                            <td>
                                <?php if($transaction->action == 'add'): ?>
                                <span class="text-success">+<?php echo e(number_format($transaction->first_balance)); ?></span>
                                <?php elseif($transaction->action == 'sub'): ?>
                                <span class="text-danger">-<?php echo e(number_format($transaction->first_balance)); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-primary"><?php echo e(number_format($transaction->before_balance)); ?></td>
                            <td class="text-danger"><?php echo e(number_format($transaction->after_balance)); ?></td>
                            <td>
                                <textarea class="form-control" rows="1" readonly><?php echo e($transaction->note); ?></textarea>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('guard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/trumsubr/public_html/resources/views/guard/profile/transactions.blade.php ENDPATH**/ ?>