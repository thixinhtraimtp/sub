<?php $__env->startSection('title', 'Lịch sử nạp tiền'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h4 class="card-title">Lịch sử nạp tiền</h4>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="search" name="search"
                                        value="<?php echo e(request('search')); ?>" placeholder="Nhập tài khoản hoặc mã giao dịch">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search"></i> Tìm kiếm
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                        <table class="table text-nowrap table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tài khoản</th>
                                    <th>Mã giao dịch</th>
                                    <th>Loại</th>
                                    <th>Người chuyển</th>
                                    <th>Số tiền</th>
                                    <th>Thực nhận</th>
                                    <th>Nội dung</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($payment->id); ?></td>
                                        <td><?php echo e($payment->user->username); ?></td>
                                        <td><?php echo e($payment->bank_code); ?></td>
                                        <td><?php echo e($payment->payment_method); ?></td>
                                        <td><?php echo e($payment->bank_name); ?></td>
                                        <td><?php echo e(number_format($payment->amount)); ?>đ</td>
                                        <td><?php echo e(number_format($payment->real_amount)); ?>đ</td>
                                        <td><?php echo e($payment->note); ?></td>
                                        <td><?php echo e($payment->created_at); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php echo $__env->make('admin.components.table-search-not-found', ['colspan' => 9], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center align-items-center mt-3 pagination-style-1">
                            <?php echo e($payments->appends(request()->all())->links('pagination::bootstrap-4')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
     <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h4 class="card-title">Lịch sử card</h4>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="search" name="search"
                                        value="<?php echo e(request('search')); ?>" placeholder="Nhập tài khoản hoặc mã giao dịch">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search"></i> Tìm kiếm
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                        <table class="table text-nowrap table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tài khoản</th>
                                    <th>Mã giao dịch</th>
                                    <th>Loại</th>
                                    <th>Mã thẻ</th>
                                    <th>Seri</th>
                                    <th>Số tiền</th>
                                    <th>Thực nhận</th>
                                      <th>Trạng thái</th>
                                    <th>Nội dung</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($payment->id); ?></td>
                                        <td><?php echo e($payment->username); ?></td>
                                        <td><?php echo e($payment->tranid); ?></td>
                                        <td><?php echo e($payment->card_type); ?></td>
                                        <td><?php echo e($payment->card_code); ?></td>
                                        <td><?php echo e($payment->card_serial); ?></td>
                                        <td><?php echo e(number_format($payment->card_amount)); ?>đ</td>
                                        <td><?php echo e(number_format($payment->card_real_amount)); ?>đ</td>
                                        <td><?php echo statusCard($payment->status); ?></td>
                                        <td><?php echo e($payment->note); ?></td>
                                        <td><?php echo e($payment->created_at); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php echo $__env->make('admin.components.table-search-not-found', ['colspan' => 9], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center align-items-center mt-3 pagination-style-1">
                            <?php echo e($cards->appends(request()->all())->links('pagination::bootstrap-4')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dailysie/hacksub.website/resources/views/admin/history/payment.blade.php ENDPATH**/ ?>