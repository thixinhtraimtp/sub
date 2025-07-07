<?php $__env->startSection('title', 'Thông tin người dùng'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title">Thông tin người dùng</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.user.update', ['username' => $user->username])); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" value="<?php echo e($user->name); ?>"
                                        name="name">
                                    <label for="name">Họ và tên</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="email" value="<?php echo e($user->email); ?>"
                                        disabled>
                                    <label for="email">Địa chỉ Email</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="username" value="<?php echo e($user->username); ?>"
                                        disabled>
                                    <label for="username">Tài khoản</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="balance"
                                        value="<?php echo e(number_format($user->balance)); ?> VNĐ" disabled>
                                    <label for="balance">Số dư</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" id="level" name="level">
                                        <option value="member" <?php echo e($user->level == 'member' ? 'selected' : ''); ?>>Thành viên
                                        </option>
                                        <option value="collaborator" <?php echo e($user->level == 'collaborator' ? 'selected' : ''); ?>>
                                            Cộng tác viên</option>
                                        <option value="agency" <?php echo e($user->level == 'agency' ? 'selected' : ''); ?>>Đại lý
                                        </option>
                                        <option value="distributor" <?php echo e($user->level == 'distributor' ? 'selected' : ''); ?>>
                                            Nhà phân phối</option>
                                    </select>
                                    <label for="level">Cấp bậc</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" id="role" name="role">
                                        <option value="member" <?php echo e($user->role == 'member' ? 'selected' : ''); ?>>Khách hàng
                                        </option>
                                        <option value="admin" <?php echo e($user->role == 'admin' ? 'selected' : ''); ?>>Quản trị viên
                                        </option>
                                    </select>
                                    <label for="role">Chức vụ</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-floating">
                                    <select class="form-select" id="status" name="status">
                                        <option value="active" <?php echo e($user->status == 'active' ? 'selected' : ''); ?>>Hoạt động
                                        </option>
                                        <option value="inactive" <?php echo e($user->status == 'inactive' ? 'selected' : ''); ?>>Không
                                            hoạt động</option>
                                        <option value="banned" <?php echo e($user->status == 'banned' ? 'selected' : ''); ?>>Bị khoá
                                        </option>
                                    </select>
                                    <label for="status">Trạng thái</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" disabled=""
                                        value="<?php echo e($user->last_login); ?>">
                                    <label for="last_login">Lần đăng nhập cuối</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" dirname="" value="<?php echo e($user->last_ip); ?>" disabled>
                                    <label for="last_ip">Ip Location</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <a href="<?php echo e(route('admin.user')); ?>" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title">Đổi mật khẩu</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.user.update-password', ['username' => $user->username])); ?>"
                        method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password">
                            <label for="password">Mật khẩu mới</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation">
                            <label for="password_confirmation">Nhập lại mật khẩu</label>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seeding1/public_html/resources/views/admin/user/detail.blade.php ENDPATH**/ ?>