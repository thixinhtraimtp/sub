<!DOCTYPE html>
<html lang="<?php echo e(str_replace('-', '_', app()->getLocale())); ?>">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <head>
        <title>Cài đặt Website</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="logo" content="<?php echo e(site('logo')); ?>">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <link rel="icon" href="<?php echo e(siteValue('favicon')); ?>" type="image/x-icon">
        <meta name="description" content="<?php echo e(siteValue('description')); ?>">
        <meta name="keywords" content="<?php echo e(siteValue('keywords')); ?>">
        <meta name="author" content="<?php echo e(siteValue('author')); ?>">
        <meta property="og:title" content="<?php echo e(siteValue('title')); ?>">
        <meta property="og:description" content="<?php echo e(siteValue('description')); ?>">
        <meta property="og:image" content="<?php echo e(siteValue('thumbnail')); ?>">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:url" content="<?php echo e(url()->current()); ?>">
        <meta property="og:site_name" content="<?php echo e(siteValue('title')); ?>">
        <link rel="stylesheet" href="/app/css/style.css" id="main-style-link" />
        <link rel="stylesheet" href="/app/css/style-preset.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="/app/css/auth/animate.css" rel="stylesheet" type="text/css">
        <?php echo site('script_head'); ?>

        <?php echo site('script_head'); ?>

    </head>
    <body data-pc-preset="preset-<?php echo e(siteValue('theme_admin')); ?>" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
        <?php echo site('script_body'); ?>

        <section class="fullscreen-banner banner banner-2 p-0 overflow-hidden bg-contain bg-pos-r animatedBackground" data-bg-img="/app/images/authentication/05.png" style="height: 771px; background-image: url(&quot;/app/images/authentication/05.png&quot;);">
            <div class="mouse-parallax" data-bg-img="/app/images/authentication/01.png" style="background-image: url(&quot;/app/images/authentication/01.png&quot;)">
                <div class="auth-main v1">
                    <div class="auth-wrapper">
                        <div class="auth-form">
                            <div class="card my-5">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h4 class="f-w-500 mb-1">Cài đặt Website</h4>
                                    </div>
                                    <form method="POST" action="<?php echo e(route('install.post')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php if(session('error')): ?>
                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                                                <use xlink:href="#exclamation-triangle-fill"></use>
                                            </svg>
                                            <div> <?php echo e(session('error')); ?></div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if(env('APP_MAIN_SITE') !== request()->getHost()): ?>
                                        <div class="mb-2">
                                            <label class="form-label" for="name">API Token</label>
                                            <input class="form-control" type="text" id="api_token" name="api_token" placeholder="Nhập API token ở web mẹ" value="<?php echo e(old('api_token')); ?>" autofocus autocomplete="off">
                                        </div>
                                        <?php endif; ?>
                                        <div class="mb-2">
                                            <label class="form-label" for="name">Họ và tên</label>
                                            <input class="form-control" type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" required>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label" for="username">Tên người dùng</label>
                                            <input class="form-control" type="text" id="username" name="username" value="<?php echo e(old('username')); ?>" required>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label" for="email">Email</label>
                                            <input class="form-control" type="text" id="email" name="email" value="<?php echo e(old('email')); ?>" required>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label" for="password">Mật khẩu</label>
                                            <input class="form-control" type="password" id="password" name="password" value="<?php echo e(old('password')); ?>" required>
                                        </div>
                                        <div class="d-grid mt-4">
                                            <button type="submit" class="btn btn-primary">Cài đặt Website</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.12/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.js"></script>
        <script src="/app/js/script.js"></script>
        <script src="/app/js/theme.js"></script>
        <script src="/app/js/plugins/feather.min.js"></script>
        <?php echo site('script_footer'); ?>

        <?php if(session('success')): ?>
        <script>
            Swal.fire({
                title: 'Thành công',
                text: '<?php echo e(session('success')); ?>',
                icon: 'success',
                confirmButtonText: 'Đóng',
                customClass: {
                confirmButton: 'swal2-confirm btn btn-success '
                }
            })
        </script>
        <?php endif; ?>
        <?php if(session('error')): ?>
        <script>
            Swal.fire({
                title: 'Thất bại',
                text: '<?php echo e(session('error')); ?>',
                icon: 'error',
                confirmButtonText: 'Đóng',
                customClass: {
                confirmButton: 'swal2-confirm btn btn-danger '
                }
            })
        </script>
        <?php endif; ?>
    </body>
</html><?php /**PATH /home/dailysie/hacksub.website/resources/views/auth/install.blade.php ENDPATH**/ ?>