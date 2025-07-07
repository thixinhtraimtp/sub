
<?php $__env->startSection('title', 'Tiếp thị liên kết'); ?>
<?php $__env->startSection('content'); ?>
<div class="card-body pc-component">
    <div id="config" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="config" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="config">CẤU HÌNH TIẾP THỊ LIÊN KẾT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('admin.website.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-lg col-md-4 col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="percentage_commission_affiliate"
                                        name="percentage_commission_affiliate" placeholder="Nhập dữ liệu"
                                        value="<?php echo e(siteValue('percentage_commission_affiliate')); ?>">
                                    <label for="percentage_commission_affiliate">% Hoa hồng</label>
                                </div>
                            </div>
                            <div class="col-lg col-md-4 col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="min_withdraw_ref"
                                        name="min_withdraw_ref" placeholder="Nhập dữ liệu"
                                        value="<?php echo e(siteValue('min_withdraw_ref')); ?>">
                                    <label for="min_withdraw_ref">Số tiền tối thiểu</label>
                                </div>
                            </div>                            <div class="col-lg col-md-4 col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="max_withdraw_ref" name="max_withdraw_ref"
                                        placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('max_withdraw_ref')); ?>">
                                    <label for="max_withdraw_ref">Số tiền rút tối đa</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="telegram_chat_id_withdraw"
                                        name="telegram_chat_id_withdraw" placeholder="Nhập dữ liệu"
                                        value="<?php echo e(siteValue('telegram_chat_id_withdraw')); ?>">
                                    <label for="telegram_chat_id_withdraw">Telegram chat ID nhận thông báo rút tiền</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary-gradient w-100">Lưu cấu hình</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 text-right mb-3">
        <button class="btn btn-primary-gradient" data-bs-toggle="modal" data-bs-target="#config">
            <i class="bx bx-cog"></i> Cấu hình
        </button>
    </div>
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">NGƯỜI DÙNG ĐĂNG KÝ GẦN ĐÂY</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Người đăng ký</th>
                                <td>Người giới thiệu</td>
                                <th>Ngày tham gia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $affiliates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $affiliate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($affiliate->id); ?></td>
                                <td><?php echo e($affiliate->username); ?></td>
                                <td><?php echo e($affiliate->referrer->username ?? 'Không có'); ?></td>
                                <td><?php echo e($affiliate->created_at->format('d/m/Y')); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">ĐƠN RÚT TIỀN CẦN DUYỆT</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table-2" class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Người yêu cầu</th>
                                <th>Thông tin</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($withdraw->id); ?></td>
                                <td><?php echo e($withdraw->user->username); ?></td>
                                <td>
                                    <ul>
                                        <li><b>Số tiền: </b><?php echo e(number_format($withdraw->amount)); ?> VND</li>
                                        <li><b>STK: </b><?php echo e($withdraw->account_number); ?></li>
                                        <li><b>CTK: </b><?php echo e($withdraw->account_name); ?></li>
                                        <li><b>Ngân hàng: </b><?php echo e($withdraw->bank_name); ?></li>
                                    </ul>
                                </td>
                                <td>
                                    <?php if($withdraw->status == 'pending'): ?>
                                    <p><span class="badge bg-warning-gradient">Chờ xử lý</span></p>
                                    <p>
                                        <form id="submitwithdrawref" action="<?php echo e(route('admin.affiliates.withdraw', $withdraw->id)); ?>" method="POST" style="display:inline-block;">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-group">
                                                <input type="hidden" name="status" value="success">
                                                <button type="submit" class="btn btn-sm btn-success-gradient"  data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Duyệt đơn" data-bs-original-title="Duyệt đơn"><i class="fas fa-check"></i></button>
                                            </div>
                                        </form>
                                    </p>
                                    <?php elseif($withdraw->status == 'success'): ?>
                                        <span class="badge bg-success-gradient">Thành công</span>
                                    <?php endif; ?>
                                    
                                </td>
                                <td><?php echo e($withdraw->created_at->format('d/m/Y H:i')); ?></td>
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
<?php $__env->startSection('script'); ?>
<script>
    $('#data-table-2').DataTable();
    $('#jsource-table').DataTable({
        data: dataSet,
    });
</script>
<script>
    document.getElementById('submitwithdrawref').addEventListener('click', function(event) {
        event.preventDefault(); 
        Swal.fire({
            title: 'Xác nhận duyệt đơn rút?',
            text: "Hành động này không thể hoàn tác!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Duyệt',
            cancelButtonText: 'Hủy',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('submitwithdrawref').submit();
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\socialmedia\app\resources\views/admin/affiliate/index.blade.php ENDPATH**/ ?>