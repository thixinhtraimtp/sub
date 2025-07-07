<?php $__env->startSection('title', 'Danh sách thành viên'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top">
                    <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-primary">
                            <svg class="svg-white" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                <rect fill="none" height="24" width="24"></rect>
                                <g>
                                    <path d="M4,13c1.1,0,2-0.9,2-2c0-1.1-0.9-2-2-2s-2,0.9-2,2C2,12.1,2.9,13,4,13z M5.13,14.1C4.76,14.04,4.39,14,4,14 c-0.99,0-1.93,0.21-2.78,0.58C0.48,14.9,0,15.62,0,16.43V18l4.5,0v-1.61C4.5,15.56,4.73,14.78,5.13,14.1z M20,13c1.1,0,2-0.9,2-2 c0-1.1-0.9-2-2-2s-2,0.9-2,2C18,12.1,18.9,13,20,13z M24,16.43c0-0.81-0.48-1.53-1.22-1.85C21.93,14.21,20.99,14,20,14 c-0.39,0-0.76,0.04-1.13,0.1c0.4,0.68,0.63,1.46,0.63,2.29V18l4.5,0V16.43z M16.24,13.65c-1.17-0.52-2.61-0.9-4.24-0.9 c-1.63,0-3.07,0.39-4.24,0.9C6.68,14.13,6,15.21,6,16.39V18h12v-1.61C18,15.21,17.32,14.13,16.24,13.65z M8.07,16 c0.09-0.23,0.13-0.39,0.91-0.69c0.97-0.38,1.99-0.56,3.02-0.56s2.05,0.18,3.02,0.56c0.77,0.3,0.81,0.46,0.91,0.69H8.07z M12,8 c0.55,0,1,0.45,1,1s-0.45,1-1,1s-1-0.45-1-1S11.45,8,12,8 M12,6c-1.66,0-3,1.34-3,3c0,1.66,1.34,3,3,3s3-1.34,3-3 C15,7.34,13.66,6,12,6L12,6z">
                                    </path>
                                </g>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                <?php echo e(\App\Models\User::where('domain', request()->getHost())->count()); ?>                                   
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">TỔNG THÀNH VIÊN</p>
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
                        <span class="avatar avatar-md p-2 bg-secondary">
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
                                <?php echo e(number_format(\App\Models\User::where('domain', request()->getHost())->sum('balance'))); ?>

                                VNĐ                   
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">TỔNG SỐ DƯ</p>
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
                        <span class="avatar avatar-md p-2 bg-success">
                        <i class="ti ti-access-point fs-2"></i>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                <?php echo e(\App\Models\User::where('domain', request()->getHost())->whereDate('updated_at', today())->count()); ?>

                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">HOẠT ĐỘNG HÔM NAY</p>
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
                        <span class="avatar avatar-md p-2 bg-info">
                        <i class="ti ti-lock fs-2"></i>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                <?php echo e(\App\Models\User::where('domain', request()->getHost())->where('two_factor_auth', 'yes')->count()); ?>

                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">TÀI KHOẢN XÁC THỰC</p>
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
                <h5 class="card-title">Danh sách thành viên</h5>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="row row-cols-lg-auto">
                        <div class="col-lg col-md-4 col-6">
                            <div class="form-group mb-3">
                                <select class="form-control" name="level">
                                    <option value="">-- Loại Tài Khoản --</option>
                                    <option value="member" <?php if(request()->level == 'member'): ?> selected <?php endif; ?>>Thành
                                    viên</option>
                                    <option value="collaborator" <?php if(request()->level == 'collaborator'): ?> selected <?php endif; ?>>
                                    Cộng tác viên</option>
                                    <option value="agency" <?php if(request()->level == 'agency'): ?> selected <?php endif; ?>>Đại lý
                                    </option>
                                    <option value="distributor" <?php if(request()->level == 'distributor'): ?> selected <?php endif; ?>>
                                    Nhà phân phối</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg col-md-4 col-6">
                            <div class="form-group mb-3">
                                <select class="form-control" name="role">
                                    <option value="">-- Chức vụ --</option>
                                    <option value="member" <?php if(request()->role == 'member'): ?> selected <?php endif; ?>>Thành
                                    viên</option>
                                    <option value="admin" <?php if(request()->role == 'admin'): ?> selected <?php endif; ?>>Quản
                                    trị viên</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg col-md-4 col-6">
                            <div class="form-group mb-3">
                                <select class="form-control" name="status">
                                    <option value="">-- Trạng thái --</option>
                                    <option value="active" <?php if(request()->status == 'active'): ?> selected <?php endif; ?>>Hoạt
                                    động</option>
                                    <option value="inactive" <?php if(request()->status == 'inactive'): ?> selected <?php endif; ?>>Không
                                    hoạt động</option>
                                    <option value="banned" <?php if(request()->status == 'banned'): ?> selected <?php endif; ?>>Bị cấm
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mr-1 mb-3">
                                <i class="ti ti-search"></i> Search
                            </button>
                            <a href="<?php echo e(route('admin.user')); ?>" class="btn btn-secondary mr-1 mb-3">
                                <i class="ti ti-rotate-clockwise"></i> Làm mới
                            </a>
                        </div>
                    </div>
                </form>
                <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                    <table id="data-table"class="table text-nowrap table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>Thao tác</th>
                                <th>Người dùng</th>
                                <th>tài khoản</th>
                                <th>Số dư</th>
                                <th>Tổng nạp</th>
                                <th>Cấp bậc</th>
                                <th>Chức vụ</th>
                                <th>Trạng thái</th>
                                <th>Bảo mật</th>
                                <th>Địa chỉ</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold">
                            <?php if($users->isEmpty()): ?>
                            <?php echo $__env->make('admin.components.table-search-not-found', [
                            'colspan' => 8,
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php else: ?>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="fs-6">
                                <td>#<?php echo e($user->id); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.user.detail', ['id' => $user->id])); ?>"
                                        class="btn btn-sm btn-success-gradient mt-1" data-bs-toggle="tooltip"
                                        title="Xem chi tiết">
                                    <i class="ti ti-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.user.balance', ['username' => $user->username])); ?>"
                                        class="btn btn-sm btn-info-gradient mt-1" data-bs-toggle="tooltip"
                                        title="Sửa số dư">
                                    <i class="ti ti-pencil"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.user.transactions', ['username' => $user->username])); ?>"
                                        class="btn btn-sm btn-primary-gradient mt-1" data-bs-toggle="tooltip"
                                        title="Lịch sử giao dịch">
                                    <i class="ti ti-shopping-cart"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.user.delete', ['id' => $user->id])); ?>"
                                        class="btn btn-sm btn-danger-gradient mt-1" data-bs-toggle="tooltip"
                                        title="Xóa">
                                    <i class="ti ti-trash"></i>
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avtar me-3">
                                            <img src="<?php echo e($user->avatar); ?>" alt="avatar"
                                                class="img-fluid rounded-circle" width="50">
                                        </div>
                                        <div>
                                            <h6 class="mb-0"><?php echo e($user->name); ?></h6>
                                            <span class="text-opacity"><?php echo e($user->email); ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo e($user->username); ?></td>
                                <td class="text-sm fw-bold"><?php echo e(number_format($user->balance)); ?> VNĐ</td>
                                <td class="text-sm fw-bold"><?php echo e(number_format($user->total_recharge)); ?> VNĐ
                                </td>
                                <td><?php echo levelUser($user->level, true); ?></td>
                                <td>
                                    <?php if($user->role == 'admin'): ?>
                                    <span class="badge bg-danger-gradient">Quản trị viên</span>
                                    <?php else: ?>
                                    <span class="badge bg-success-gradient">Thành viên</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($user->status == 'active'): ?>
                                    <span class="badge bg-success-gradient">Hoạt động</span>
                                    <?php elseif($user->status == 'inactive'): ?>
                                    <span class="badge bg-warning-gradient">Không hoạt động</span>
                                    <?php else: ?>
                                    <span class="badge bg-danger-gradient">Bị cấm</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($user->two_factor_auth === 'yes'): ?>
                                    <span class="badge bg-success-gradient">Bật</span>
                                    <?php else: ?>
                                    <span class="badge bg-danger-gradient">Tắt</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($user->last_ip); ?></td>
                                <td><?php echo e($user->created_at); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dailysie/khosubvip.top/resources/views/admin/user/index.blade.php ENDPATH**/ ?>