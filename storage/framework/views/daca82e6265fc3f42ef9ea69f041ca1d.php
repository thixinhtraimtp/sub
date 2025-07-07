<?php $__env->startSection('title', 'Thông Tin Cá Nhân'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
<?php if(Auth::user()->telegram_id == null && Auth::user()->telegram_id == ''): ?>
    <div class="col-md-12">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 me-3">
                        <h3 class="text-white">Bạn chưa xác thực Telegram</h3>
                        <p class="text-white text-opacity-75 text-opa mb-0">Vui lòng xác thực Telegram để nhận thông báo từ hệ thống!</p>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="/app/images/application/img-accout-alert.png" alt="img" class="img-fluid wid-80">
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php endif; ?>
    <div class="col-lg-5 col-xxl-3">
        <div class="card overflow-hidden">
            <div class="card-body position-relative">
                <div class="text-center mt-3">
                    <div class="chat-avtar d-inline-flex mx-auto">
                        <img class="rounded-circle img-fluid wid-90 img-thumbnail" src="https://ui-avatars.com/api/?background=random&name=<?php echo e(Auth::user()->name); ?>" alt="User image">
                        <i class="chat-badge bg-success me-2 mb-2"></i>
                    </div>
                    <h5 class="mb-0"><?php echo e(Auth::user()->name); ?></h5>
                    <p class="text-muted text-sm">DM on <a href="#" class="link-primary"> <span>@</span><?php echo e(Auth::user()->username); ?> </a> 😍</p>
                    <ul class="list-inline mx-auto my-4">
                        <li class="list-inline-item">
                            <a href="#" class="avtar avtar-s text-white bg-dribbble">
                            <i class="ti ti-brand-dribbble f-24"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="avtar avtar-s text-white bg-amazon">
                            <i class="ti ti-brand-figma f-24"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="avtar avtar-s text-white bg-pinterest">
                            <i class="ti ti-brand-pinterest f-24"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="avtar avtar-s text-white bg-behance">
                            <i class="ti ti-brand-behance f-24"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="row g-3">
                        <div class="col-4">
                            <h5 class="mb-0"><?php echo e(number_format(Auth::user()->balance)); ?>đ</h5>
                            <small class="text-muted">Số dư</small>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0"><?php echo e(number_format(Auth::user()->total_recharge)); ?>đ</h5>
                            <small class="text-muted">Tổng nạp</small>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0"><?php echo e(number_format(Auth::user()->total_recharge - Auth::user()->balance, 0, ',', '.')); ?>đ</h5>
                            <small class="text-muted">Đã tiêu</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav flex-column nav-pills list-group list-group-flush account-pills mb-0" id="user-set-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link list-group-item list-group-item-action active" id="user-set-profile-tab" data-bs-toggle="pill" href="#user-set-profile" role="tab" aria-controls="user-set-profile" aria-selected="true">
                <span class="f-w-500"><i class="ph-duotone ph-user-circle m-r-10"></i>Thông tin tài khoản</span>
                </a>
                <a class="nav-link list-group-item list-group-item-action" id="user-set-account-tab" data-bs-toggle="pill" href="#user-set-account" role="tab" aria-controls="user-set-account" aria-selected="false" tabindex="-1">
                <span class="f-w-500" style="display: flex; align-items: center;">
                    <svg width="20" height="20" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="16" cy="16" r="14" fill="url(#paint0_linear_87_7225)"/>
                        <path d="M22.9866 10.2088C23.1112 9.40332 22.3454 8.76755 21.6292 9.082L7.36482 15.3448C6.85123 15.5703 6.8888 16.3483 7.42147 16.5179L10.3631 17.4547C10.9246 17.6335 11.5325 17.541 12.0228 17.2023L18.655 12.6203C18.855 12.4821 19.073 12.7665 18.9021 12.9426L14.1281 17.8646C13.665 18.3421 13.7569 19.1512 14.314 19.5005L19.659 22.8523C20.2585 23.2282 21.0297 22.8506 21.1418 22.1261L22.9866 10.2088Z" fill="white"/>
                        <defs>
                            <linearGradient id="paint0_linear_87_7225" x1="16" y1="2" x2="16" y2="30" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#37BBFE"/>
                                <stop offset="1" stop-color="#007DBB"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <span style="padding-left: 10px;">Cấu hình Telegram</span>
                </span>
                </a>
                <a class="nav-link list-group-item list-group-item-action" id="user-set-passwort-tab" data-bs-toggle="pill" href="#user-set-passwort" role="tab" aria-controls="user-set-passwort" aria-selected="false" tabindex="-1">
                <span class="f-w-500"><i class="ph-duotone ph-key m-r-10"></i>Mật khẩu & Bảo mật</span>
                </a>
                <a class="nav-link list-group-item list-group-item-action" id="user-set-information-tab" data-bs-toggle="pill" href="#user-set-information" role="tab" aria-controls="user-set-information" aria-selected="true">
                <span class="f-w-500"><i class="ph-duotone ph-clipboard-text m-r-10"></i>lịch sử hoạt động</span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-xxl-9">
        <div class="tab-content" id="user-set-tabContent">
            <div class="tab-pane fade active show" id="user-set-profile" role="tabpanel" aria-labelledby="user-set-profile-tab">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Thông tin cá nhân</h5>
                    </div>
                    <div class="card-body">
                        <form action="">
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="name" class="form-label">Họ và tên:</label>
                                    <input type="text" class="form-control" id="name" disabled
                                        value="<?php echo e(Auth::user()->name); ?>">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="email" class="form-label">Địa chỉ Email:</label>
                                    <input type="text" class="form-control" id="email" disabled
                                        value="<?php echo e(Auth::user()->email); ?>">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="username" class="form-label">Tài khoản:</label>
                                    <input type="text" class="form-control" id="username" disabled
                                        value="<?php echo e(Auth::user()->username); ?>">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="created_at" class="form-label">Thời gian đăng kí:</label>
                                    <input type="text" class="form-control" id="created_at" disabled
                                        value="<?php echo e(Auth::user()->created_at); ?>">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="balance" class="form-label">Số dư:</label>
                                    <input type="text" class="form-control" id="balance" disabled
                                        value="<?php echo e(number_format(Auth::user()->balance)); ?>">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="last_login" class="form-label">Đăng nhập gần đây:</label>
                                    <input type="text" class="form-control" id="last_login" disabled
                                        value="<?php echo e(Auth::user()->last_login); ?>">
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label for="api_token" class="form-label">Api Token</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="api_token" readonly
                                            onclick="coppy('<?php echo e(Auth::user()->api_token ?? 'null'); ?>')"
                                            value="<?php echo e(Auth::user()->api_token ?? 'Bạn chưa tạo Api Token!'); ?>"
                                            placeholder="Bạn cần ấn thay đổi Token">
                                        <button class="btn btn-primary" type="button" id="btn-reload-token">
                                        <i class="ti ti-refresh"></i>
                                        Thay đổi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="user-set-account" role="tabpanel" aria-labelledby="user-set-account-tab">
                <div class="card">
                    <div class="card-header">
                        <h5>Cấu hình Telegram</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 border-bottom py-2">
                            <h4 class="text-primary fw-bold fs-4 mb-3">Liên kết Telegram</h4>
                            <div class="alert alert-primary">
                                <h4 class="alert-heading">Cấu hình Telegram</h4>
                                <ul>
                                    <li>Để bảo mật tài khoản của bạn, bạn có thể liên kết tài khoản của mình với
                                        Telegram. Khi liên kết, bạn sẽ nhận được thông báo qua Telegram khi có hoạt
                                        động đăng nhập từ thiết bị không xác định.
                                    </li>
                                    <li>Nên Cấu Hình Để Sử Dụng Nhằm Bảo Vệ Tài Khoản Và Cập Nhật Lịch Sử Đơn Hàng Nhanh
                                        Chóng Tránh Bị Bug
                                    </li>
                                    <li>Gửi Lịch Sử Mua Hàng & Nạp Tiền Về Telegram Của Bạn </li>
                                </ul>
                            </div>
                            <?php if(Auth::user()->telegram_id !== null && Auth::user()->telegram_id !== ''): ?>
                            <h6 class="text-muted fw-bold fs-6 mb-3">Trạng thái: <span
                                class="badge bg-success badge-sm">Đã liên kết</span></h6>
                            <form action="<?php echo e(route('account.update.status-telegram')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3 form-group">
                                    <label class="form-label">ID Telegram</label>
                                    <input type="text" class="form-control" id="telegram_id"
                                        value="<?php echo e(Auth::user()->telegram_id); ?>" disabled>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Thông báo về telegram</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" value="<?php echo e(Auth::user()->notification_telegram == 'yes' ? 'no' : 'yes'); ?>"
                                        <?php echo e(Auth::user()->notification_telegram == 'yes' ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="status">
                                        Gửi thông báo
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary shadow-2 btn-sm text-sm">Cập nhật</button>
                                </div>
                            </form>
                            <?php else: ?>
                            <h6 class="text-muted fw-bold fs-6 mb-3">Trạng thái: <span
                                class="badge bg-danger badge-sm">Chưa liên kết</span></h6>
                            <button data-pc-animate="slide-in-right" type="button" class="btn btn-primary"
                                data-bs-toggle="modal" data-bs-target="#telegram">
                            Liên kết Telegram
                            </button>
                            <div class="modal fade modal-animate" id="telegram" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Liên Kết Telegram</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"> </button>
                                        </div>
                                        <form action="<?php echo e(route('account.update.status-telegram')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="mb-3 text-center">
                                                    <h4 class="text-gray">Thông tin Bot Telegram</h4>
                                                    <p class="text-muted">Để liên kết tài khoản của bạn với
                                                        Telegram,
                                                        bạn cần thực hiện các bước sau:
                                                    </p>
                                                    <ol>
                                                        <li>Thêm Bot Telegram: <a
                                                            href="https://t.me/<?php echo e(siteValue('telegram_bot_chat_username')); ?>"
                                                            target="_blank">https://t.me/<?php echo e(siteValue('telegram_bot_chat_username')); ?></a>
                                                        </li>
                                                        <li>Nhấn vào nút <strong>Start</strong> để bắt đầu</li>
                                                        <li>Chọn <strong>/active {api_token}</strong> để liên kết
                                                            tài khoản trong đó {api_token} là phần token của bạn
                                                        </li>
                                                    </ol>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary shadow-2">Liên
                                                Kết</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="user-set-passwort" role="tabpanel" aria-labelledby="user-set-passwort-tab">
                <div class="card">
                    <div class="card-header">
                        <h5>Đổi mật khẩu</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('account.change-password')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="current_password" class="form-label">Mật khẩu hiện
                                    tại:</label>
                                    <input type="password" class="form-control" id="current_password"
                                        name="current_password">
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label for="new_password" class="form-label">Mật khẩu mới:</label>
                                    <input type="password" class="form-control" id="new_password"
                                        name="new_password">
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label for="confirm_password" class="form-label">Xác nhận mật
                                    khẩu:</label>
                                    <input type="password" class="form-control" id="confirm_password"
                                        name="confirm_password">
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <button type="submit" class="btn btn-primary col-12">
                                    <i class="ti ti-lock"></i>
                                    Thay đổi mật khẩu
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Xác thực 2 yếu tố</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 border-bottom py-2">
                            <h4 class="text-primary fw-bold fs-4 mb-3">Xác thực 2 yếu tố</h4>
                            <div class="alert alert-primary">
                                <h4 class="alert-heading">Xác thực 2 yếu tố là gì?</h4>
                                <p class="mb-0">Xác thực 2 yếu tố (2FA) là một phương pháp bảo mật mạnh mẽ hơn
                                    so với mật khẩu đơn lẻ. Khi bật xác thực 2 yếu tố, bạn sẽ cần nhập một mã xác
                                    thực được tạo ra từ ứng dụng xác thực trên điện thoại di động của bạn sau
                                    khi nhập mật khẩu của bạn. Điều này giúp bảo vệ tài khoản của bạn khỏi các
                                    cuộc tấn công xâm nhập và truy cập trái phép.
                                </p>
                            </div>
                            
                            <?php if(Auth::user()->two_factor_auth === 'yes'): ?>
                            <h6 class="text-muted fw-bold fs-6 mb-3">Trạng thái: <span
                                class="badge bg-success badge-sm">Đã bật</span></h6>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#two_factor_auth">
                            Tắt xác thực
                            </button>
                            <div class="modal fade modal-animate" id="two_factor_auth" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tắt xác thực 2 yếu tố</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"> </button>
                                        </div>
                                        <form action="<?php echo e(route('account.two-factor-auth-disable')); ?>"
                                            method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="mb-3 text-center">
                                                    <h4 class="text-gray"> Nhập mã xác thực để tắt xác thực 2
                                                        yếu tố
                                                    </h4>
                                                </div>
                                                <div class="mb-3 form-group">
                                                    <label class="form-label">Nhập mã xác thực</label>
                                                    <input type="text" class="form-control" id="code"
                                                        autocomplete="off" name="code">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary shadow-2">Bật
                                                xác
                                                thực</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                            <h6 class="text-muted fw-bold fs-6 mb-3">Trạng thái: <span
                                class="badge bg-danger badge-sm">Chưa bật</span></h6>
                            <button data-pc-animate="slide-in-right" type="button" class="btn btn-primary"
                                data-bs-toggle="modal" data-bs-target="#two_factor_auth">
                            Xác thực
                            </button>
                            <div class="modal fade modal-animate" id="two_factor_auth" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Xác thực 2 yếu tố</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"> </button>
                                        </div>
                                        <form action="<?php echo e(route('account.two-factor-auth')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-body">
                                                <div class="mb-3 text-center">
                                                    <h4 class="text-gray">Quét mã QR bằng ứng dụng xác thực</h4>
                                                    <img src="<?php echo e($qrCodeUrl); ?>" alt="QR Google Authenticate">
                                                </div>
                                                <div class="mb-3 text-center">
                                                    <h4 class="text-gray">Hoặc nhập mã bí mật</h4>
                                                    <p class="text-muted">Nhập mã bí mật vào ứng dụng xác thực nếu
                                                        không thể quét mã QR
                                                    </p>
                                                    <input type="text" class="form-control" id="secret"
                                                        value="<?php echo e($secret); ?>" disabled>
                                                    <button type="button" class="btn btn-primary mt-3"
                                                        id="copy-secret">
                                                    <i class="ti ti-clipboard"></i>
                                                    Sao chép mã bí mật
                                                    </button>
                                                </div>
                                                <div class="mb-3 form-group">
                                                    <label class="form-label">Nhập mã xác thực</label>
                                                    <input type="text" class="form-control" id="code"
                                                        autocomplete="off" name="code">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary shadow-2">Bật xác
                                                thực</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="user-set-information" role="tabpanel" aria-labelledby="user-set-information-tab">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Lịch sử hoạt động</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered nowrap dataTable"
                                style="max-width: 1444px;">
                                <thead>
                                    <tr>
                                        <th>Thời gian</th>
                                        <th>Hoạt động</th>
                                        <th>IP</th>
                                        <th>User Agent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = \App\Models\UserActivity::where('user_id', Auth::user()->id)->where('activity', 'auth')->orderBy('id', 'DESC')->limit(10)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($activity->created_at); ?></td>
                                        <td><?php echo e($activity->note); ?></td>
                                        <td><?php echo e($activity->ip); ?></td>
                                        <td><?php echo e($activity->user_agent); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $(document).ready(function() {
        $('#copy-secret').click(function() {
            var copyText = document.getElementById("secret");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            document.execCommand("copy");
            swal("Đã sao chép mã bí mật!", "success");
        });
    
    
        $('#btn-reload-token').click(function() {
            $.ajax({
                url: "<?php echo e(route('account.reload-user-token')); ?>",
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                $('#btn-reload-token').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý..').prop(
                    'disabled', true);
                    },
                    complete: function() {
                        $('#btn-reload-token').html('<i class="fa fa-sync"></i> Thay đổi').prop('disabled', false);
                    },
                success: function(data) {
                    $('#api_token').val(data.api_token);
                    swal("Đã thay đổi Api Token!", "success");
                },
                error: function() {
                    swal("Có lỗi xảy ra!", "error");
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('guard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dailysie/hacksub.website/resources/views/guard/profile/index.blade.php ENDPATH**/ ?>