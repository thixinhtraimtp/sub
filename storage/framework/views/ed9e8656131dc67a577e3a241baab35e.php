<?php $__env->startSection('title', 'Cấu hình nạp tiền'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-4">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">Khuyến mãi</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.payment.config.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-floating mb-3">
                        <input type="date" name="start_promotion" id="start_promotion"
                            value="<?php echo e(siteValue('start_promotion')); ?>" class="form-control">
                        <label for="start_promotion">Ngày bắt đầu khuyến mãi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" name="end_promotion" id="end_promotion"
                            value="<?php echo e(siteValue('end_promotion')); ?>" class="form-control">
                        <label for="end_promotion">Ngày kết thúc khuyến mãi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="percent_promotion" id="percent_promotion"
                            value="<?php echo e(siteValue('percent_promotion')); ?>" class="form-control">
                        <label for="percent_promotion">Phần trăm khuyến mãi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="transfer_code" id="transfer_code"
                            value="<?php echo e(siteValue('transfer_code')); ?>" class="form-control">
                        <label for="transfer_code">Mã nạp tiền</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary-gradient w-100">
                        <i class="fas fa-save"></i>
                        Lưu cấu hình
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">Cấu hình nạp thẻ cào: <span><a href="https://<?php echo e(configValue('api_recharge_card')); ?>/" target="blank_" style="text-transform: uppercase;"><?php echo e(configValue('api_recharge_card')); ?></a></span></h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.website.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="partner_id" id="partner_id" value="<?php echo e(siteValue('partner_id')); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="partner_id">Partner Id</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="partner_key" id="partner_key" value="<?php echo e(siteValue('partner_key')); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="partner_key">Partner Key</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="percent" id="percent" value="<?php echo e(siteValue('percent')); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="percent">Chiết khấu</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control text-dark" value="https://<?php echo e(getDomain()); ?>/api/v1/card"
                            placeholder="Nhập dữ liệu" readonly>
                        <label for="">Link callback</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary-gradient w-100">
                        <i class="fas fa-save"></i>
                        Lưu cấu hình
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">Cổng thanh toán: <a href="https://<?php echo e(configValue('api_deposit')); ?>/" target="blank_" style="text-transform: uppercase;" class="text-warning"><?php echo e(configValue('api_deposit')); ?></a></h5>
            </div>
            <div class="card-body">
                <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                    <table class="table text-nowrap table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Ngân hàng</th>
                                <th>Thao tác</th>
                                <th>Số tài khoản</th>
                                <th>Chủ tài khoản</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold">
                            <tr>
                                <td class="text-primary">MOMO <a href="https://api.web2m.com/" target="blank_" class="text-warning">( API.WEB2M.COM )</a></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success-gradient"data-bs-toggle="modal" data-bs-target="#momo"><i class="ti ti-eye" data-bs-toggle="tooltip" title="Xem thêm"></i></button>
                                </td>
                                <td><?php echo e($momo->account_number); ?></td>
                                <td><?php echo e($momo->account_name); ?></td>
                                <td>
                                <?php if($momo->status == 'active'): ?>
                                    <span class="badge bg-success-gradient">Hoạt động</span>
                                <?php else: ?>
                                    <span class="badge bg-danger-gradient">Không hoạt động</span>
                                <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-primary">MBBANK</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success-gradient" data-bs-toggle="modal" data-bs-target="#mbbank"><i class="ti ti-eye" data-bs-toggle="tooltip" title="Xem thêm"></i></button>
                                </td>
                                <td><?php echo e($mbbank->account_number); ?></td>
                                <td><?php echo e($mbbank->account_name); ?></td>
                                <td>
                                <?php if($mbbank->status == 'active'): ?>
                                    <span class="badge bg-success-gradient">Hoạt động</span>
                                <?php else: ?>
                                    <span class="badge bg-danger-gradient">Không hoạt động</span>
                                <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-primary">VIETCOMBANK</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success-gradient" data-bs-toggle="modal" data-bs-target="#vietcombank"><i class="ti ti-eye" data-bs-toggle="tooltip" title="Xem thêm"></i></button>
                                </td>
                                <td><?php echo e($vietcombank->account_number); ?></td>
                                <td><?php echo e($vietcombank->account_name); ?></td>
                                <td>
                                <?php if($vietcombank->status == 'active'): ?>
                                    <span class="badge bg-success-gradient">Hoạt động</span>
                                <?php else: ?>
                                    <span class="badge bg-danger-gradient">Không hoạt động</span>
                                <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-primary">ACB</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success-gradient" data-bs-toggle="modal" data-bs-target="#acb"><i class="ti ti-eye" data-bs-toggle="tooltip" title="Xem thêm"></i></button>
                                </td>
                                <td><?php echo e($acb->account_number); ?></td>
                                <td><?php echo e($acb->account_name); ?></td>
                                <td>
                                <?php if($acb->status == 'active'): ?>
                                    <span class="badge bg-success-gradient">Hoạt động</span>
                                <?php else: ?>
                                    <span class="badge bg-danger-gradient">Không hoạt động</span>
                                <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-primary">BIDV</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success-gradient" data-bs-toggle="modal" data-bs-target="#bidv"><i class="ti ti-eye" data-bs-toggle="tooltip" title="Xem thêm"></i></button>
                                </td>
                                <td><?php echo e($bidv->account_number); ?></td>
                                <td><?php echo e($bidv->account_name); ?></td>
                                <td>
                                <?php if($bidv->status == 'active'): ?>
                                    <span class="badge bg-success-gradient">Hoạt động</span>
                                <?php else: ?>
                                    <span class="badge bg-danger-gradient">Không hoạt động</span>
                                <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body pc-component">
    <div id="momo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="momo" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="momo">Cấu hình thanh toán MOMO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="<?php echo e(route('admin.payment.update', ['bank_name' => $momo->bank_name])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-floating mb-3">
                        <select name="status" id="status" class="form-select">
                        <option value="active" <?php echo e($momo->status == 'active' ? 'selected' : ''); ?>>Bật</option>
                        <option value="inactive" <?php echo e($momo->status == 'inactive' ? 'selected' : ''); ?>>Tắt</option>
                        </select>
                        <label for="status">Trạng thái</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_name" id="account_name" value="<?php echo e($momo->account_name); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="account_name">Chủ tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_number" id="account_number" value="<?php echo e($momo->account_number); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="account_number">Số điện thoại</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="min_recharge" id="min_recharge" value="<?php echo e($momo->min_recharge ?? 10000); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="min_recharge">Nạp tối thiểu</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="api_key" id="api_key" value="<?php echo e($momo->token); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="api_key">Mã tự động</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary-gradient w-100">
                        <i class="fas fa-save"></i>
                        Lưu cấu hình
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body pc-component">
    <div id="mbbank" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mbbank" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mbbank">Cấu hình thanh toán MB BANK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="<?php echo e(route('admin.payment.update', ['bank_name' => $mbbank->bank_name])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-floating mb-3">
                        <select name="status" id="status" class="form-select">
                        <option value="active" <?php echo e($mbbank->status == 'active' ? 'selected' : ''); ?>>Bật</option>
                        <option value="inactive" <?php echo e($mbbank->status == 'inactive' ? 'selected' : ''); ?>>Tắt</option>
                        </select>
                        <label for="status">Trạng thái</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_name" id="account_name" value="<?php echo e($mbbank->account_name); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="account_name">Chủ tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_number" value="<?php echo e($mbbank->account_number); ?>"
                            id="account_number" placeholder="Nhập dữ liệu">
                        <label for="account_number">Số tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="min_recharge" id="min_recharge" value="<?php echo e($mbbank->min_recharge); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="min_recharge">Nạp tối thiểu</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="text" class="form-control" name="account_username" id="account_username" value="<?php echo e($mbbank->account_number ?? '#'); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="account_username">Tài khoản</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="password" class="form-control" name="account_password" id="account_password" value="<?php echo e($mbbank->account_password ?? '#'); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="account_password">Mật khẩu</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="api_key" id="api_key" value="<?php echo e($mbbank->token); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="api_key">Mã tự động</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary-gradient w-100">
                        <i class="fas fa-save"></i>
                        Lưu cấu hình
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body pc-component">
    <div id="vietcombank" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vietcombank" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vietcombank">Cấu hình thanh toán VIETCOMBANK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="<?php echo e(route('admin.payment.update', ['bank_name' => $vietcombank->bank_name])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-floating mb-3">
                        <select name="status" id="status" class="form-select">
                        <option value="active" <?php echo e($vietcombank->status == 'active' ? 'selected' : ''); ?>>Bật</option>
                        <option value="inactive" <?php echo e($vietcombank->status == 'inactive' ? 'selected' : ''); ?>>Tắt</option>
                        </select>
                        <label for="status">Trạng thái</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_name" id="account_name" value="<?php echo e($vietcombank->account_name); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="account_name">Chủ tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_number" value="<?php echo e($vietcombank->account_number); ?>"
                            id="account_number" placeholder="Nhập dữ liệu">
                        <label for="account_number">Số tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="min_recharge" id="min_recharge" value="<?php echo e($vietcombank->min_recharge ?? '10000'); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="min_recharge">Nạp tối thiểu</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="text" class="form-control" name="account_username" id="account_username" value="<?php echo e($vietcombank->bank_account ?? '#'); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="account_username">Tài khoản</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="password" class="form-control" name="account_password" id="account_password" value="<?php echo e($vietcombank->bank_password ?? '#'); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="account_password">Mật khẩu</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="api_key" id="api_key" value="<?php echo e($vietcombank->token); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="api_key">Mã tự động</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary-gradient w-100">
                        <i class="fas fa-save"></i>
                        Lưu cấu hình
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body pc-component">
    <div id="acb" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="acb" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="acb">Cấu hình thanh toán ACB</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="<?php echo e(route('admin.payment.update', ['bank_name' => $acb->bank_name])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-floating mb-3">
                        <select name="status" id="status" class="form-select">
                        <option value="active" <?php echo e($acb->status == 'active' ? 'selected' : ''); ?>>Bật</option>
                        <option value="inactive" <?php echo e($acb->status == 'inactive' ? 'selected' : ''); ?>>Tắt</option>
                        </select>
                        <label for="status">Trạng thái</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_name" id="account_name" value="<?php echo e($acb->account_name); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="account_name">Chủ tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_number" value="<?php echo e($acb->account_number); ?>"
                            id="account_number" placeholder="Nhập dữ liệu">
                        <label for="account_number">Số tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="min_recharge" id="min_recharge" value="<?php echo e($acb->min_recharge ?? '10000'); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="min_recharge">Nạp tối thiểu</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="text" class="form-control" name="account_username" id="account_username" value="<?php echo e($acb->bank_account ?? '#'); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="account_username">Tài khoản</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="password" class="form-control" name="account_password" id="account_password" value="<?php echo e($acb->bank_password ?? '#'); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="account_password">Mật khẩu</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="api_key" id="api_key" value="<?php echo e($acb->token); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="api_key">Mã tự động</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary-gradient w-100">
                        <i class="fas fa-save"></i>
                        Lưu cấu hình
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body pc-component">
    <div id="bidv" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="bidv" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bidv">Cấu hình thanh toán BIDV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="<?php echo e(route('admin.payment.update', ['bank_name' => $bidv->bank_name])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-floating mb-3">
                        <select name="status" id="status" class="form-select">
                        <option value="active" <?php echo e($bidv->status == 'active' ? 'selected' : ''); ?>>Bật</option>
                        <option value="inactive" <?php echo e($bidv->status == 'inactive' ? 'selected' : ''); ?>>Tắt</option>
                        </select>
                        <label for="status">Trạng thái</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_name" id="account_name" value="<?php echo e($bidv->account_name); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="account_name">Chủ tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_number" value="<?php echo e($bidv->account_number); ?>"
                            id="account_number" placeholder="Nhập dữ liệu">
                        <label for="account_number">Số tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="min_recharge" id="min_recharge" value="<?php echo e($bidv->min_recharge ?? '10000'); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="min_recharge">Nạp tối thiểu</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="text" class="form-control" name="account_username" id="account_username" value="<?php echo e($bidv->bank_account ?? '#'); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="account_username">Tài khoản</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="password" class="form-control" name="account_password" id="account_password" value="<?php echo e($bidv->bank_password ?? '#'); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="account_password">Mật khẩu</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="api_key" id="api_key" value="<?php echo e($bidv->token); ?>"
                            placeholder="Nhập dữ liệu">
                        <label for="api_key">Mã tự động</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary-gradient w-100">
                        <i class="fas fa-save"></i>
                        Lưu cấu hình
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seeding1/public_html/resources/views/admin/payment/config.blade.php ENDPATH**/ ?>