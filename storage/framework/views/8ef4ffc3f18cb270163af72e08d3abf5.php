
<?php $__env->startSection('title', 'Cấu hình Voucher giảm giá'); ?>
<?php $__env->startSection('content'); ?>
<div class="card-body pc-component">
    <div id="config" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="config" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="config">THÊM MÃ GIẢM GIÁ MỚI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('admin.voucher.create')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-floating mb-3">
                                    <div>
                                        <div class="form-floating input-group mb-3">
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Nhập dữ liệu" value="<?php echo e(old('name')); ?>">
                                            <button type="button" id="generateButton" class="btn btn-success" style="border-top-right-radius: 5px; border-bottom-right-radius: 5px;"> <i class="ti ti-refresh fs-4 fw-bold"></i></button>
                                            <label for="name">Mã giảm giá</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="number" name="percent" id="percent" class="form-control" placeholder="Nhập dữ liệu" value="<?php echo e(old('percent')); ?>">
                                    <label for="percent">Phần trăm giảm giá</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="number" name="limitUser" id="limitUser" class="form-control"
                                        placeholder="Nhập dữ liệu" value="<?php echo e(old('limitUser')); ?>">
                                    <label for="limitUser">Giới hạn lượt sử dụng (nhập 0 sẽ là không giới hạn)</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" name="user_voucher" id="user_voucher" class="form-control"
                                        placeholder="Nhập dữ liệu" value="<?php echo e(old('user_voucher')); ?>">
                                    <label for="user_voucher">Người dùng cụ thể (mỗi người dùng cách bởi dấu |) (nhập 0 sẽ là tất cả
                                    thành viên)</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="date" name="timeStart" id="timeStart" class="form-control"
                                        placeholder="Nhập dữ liệu" value="<?php echo e(old('timeStart')); ?>">
                                    <label for="timeStart">Ngày bắt đầu sử dụng voucher</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="date" name="timeEnd" id="timeEnd" class="form-control" placeholder="Nhập dữ liệu" value="<?php echo e(old('timeEnd')); ?>">
                                    <label for="timeEnd">Ngày kết thúc sử dụng voucher</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select name="status" id="status" class="form-select">
                                        <option value="active">
                                            Hoat động
                                        </option>
                                        <option value="inactive">
                                            Không hoạt động
                                        </option>
                                    </select>
                                    <label for="status">Trạng thái</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary-gradient w-100">
                                    <i class="fas fa-save"></i>
                                    Lưu cấu hình
                                    </button>
                                </div>
                            </div>
                    </form>
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
                <h5 class="card-title">Danh sách Voucher</h5>
                <div class="ms-auto">
                    <button class="btn btn-danger-gradient" data-bs-toggle="modal" data-bs-target="#config">
                    <i class="ti ti-plus fw-bold"></i> Thêm mới
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                    <table id="data-table" class="table text-nowrap table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Hành động</th>
                                <th>Mã</th>
                                <th>% giảm giá</th>
                                <th>Thời gian tạo</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold">
                            <?php $__currentLoopData = $vouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voucher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($voucher->id); ?></td>
                                <td>
                                    <form action="<?php echo e(route('admin.voucher.delete', $voucher->id)); ?>" method="POST" style="display: inline;">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-danger-gradient btn-sm" data-bs-toggle="tooltip" title="Xóa"><i class="ti ti-trash"></i></button>
                                    </form>
                                </td>
                                <td><?php echo e($voucher->name); ?></td>
                                <td><?php echo e($voucher->percent); ?>%</td>
                                <td>
                                    <ul>
                                        <li>Ngày tạo: <?php echo e($voucher->timeStart); ?></li>
                                        <li>Ngày hết: <?php echo e($voucher->timeEnd); ?></li>
                                    </ul>
                                </td>
                                <td>
                                    <?php if($voucher->status == 'active'): ?>
                                    <span class="badge bg-success-gradient">Hoạt động</span>
                                    <?php else: ?>
                                    <span class="badge bg-danger-gradient">Không hoạt động</span>
                                    <?php endif; ?>
                                </td>
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
    function generateRandomString() {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
        let result = '';
        for (let i = 0; i < 8; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result;
    }
    
    document.getElementById('generateButton').addEventListener('click', function () {
        const randomString = generateRandomString(); 
        document.getElementById('name').value = randomString;
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dailysie/khosubvip.top/resources/views/admin/voucher/voucher.blade.php ENDPATH**/ ?>