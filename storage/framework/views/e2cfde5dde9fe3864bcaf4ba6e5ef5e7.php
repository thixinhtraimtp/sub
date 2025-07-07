<!DOCTYPE html>
<html lang="<?php echo e(str_replace('-', '_', app()->getLocale())); ?>">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <head>
        <title><?php echo e(site('name_site')); ?> - <?php echo $__env->yieldContent('title'); ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="logo" content="<?php echo e(site('logo')); ?>">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <link rel="icon" href="<?php echo e(siteValue('favicon')); ?>" type="image/x-icon">
        <?php if(Auth::check()): ?>
        <meta name="access-token" content="<?php echo e(Auth::user()->api_token); ?>">
        <?php endif; ?>
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
        <link rel="stylesheet" href="https://html.phoenixcoded.net/light-able/bootstrap/assets/css/plugins/dataTables.bootstrap5.min.css" />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="/app/fonts/phosphor/duotone/style.css" />
        <link rel="stylesheet" href="/app/fonts/tabler-icons.min.css" />
        <link rel="stylesheet" href="/app/fonts/feather.css" />
        <link rel="stylesheet" href="/app/fonts/fontawesome.css" />
        <link rel="stylesheet" href="/app/fonts/material.css" />
        <link rel="stylesheet" href="/app/css/style.css" id="main-style-link" />
        <link rel="stylesheet" href="/app/css/style-preset.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.12/sweetalert2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        
        <?php echo site('script_head'); ?>

    </head>
    <body data-pc-preset="preset-<?php echo e(siteValue('theme_admin')); ?>" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
        <?php echo site('script_body'); ?>

        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>
        <nav class="pc-sidebar">
            <div class="navbar-wrapper">
                <div class="m-header">
                    <a href="<?php echo e(route('home')); ?>" class="b-brand text-primary">
                    <img src="<?php echo e(siteValue('logo')); ?>" class="img-fluid logo-lg" alt="logo">                    
                    </a>
                </div>
                <div class="navbar-content">
                    <ul class="pc-navbar">
                        <li class="pc-item pc-caption"> <label data-i18n="Navigation">Home</label> <i class="ph-duotone ph-gauge"></i> </li>
                        <?php if(Auth::check() && Auth::user()->role === 'admin'): ?>
                        <li class="pc-item">
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="pc-link">
                            <span class="pc-micon"><i class="ph-duotone ph-gear"></i></span> 
                            <span class="pc-mtext">Trang quản trị</span> 
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="pc-item">
                            <a href="<?php echo e(route('home')); ?>" class="pc-link">
                                <span class="pc-micon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house">
                                        <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/>
                                        <path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                    </svg>
                                </span>
                                <span class="pc-mtext">Trang chủ</span> 
                            </a>
                        </li>
                        <li class="pc-item pc-caption">
                            <label>Apps</label>
                        </li>
                        <?php if(Auth::check()): ?>
                        <li class="pc-item"> 
                            <a href="<?php echo e(route('account.profile')); ?>" class="pc-link"> 
                            <span class="pc-micon"><i class="ph-duotone ph-user-circle fs-3"></i></span> 
                            <span class="pc-mtext">Tài khoản</span> 
                            </a> 
                        </li>
                        <li class="pc-item"> 
                            <a href="<?php echo e(route('account.progress')); ?>" class="pc-link"> 
                            <span class="pc-micon"><i class="ph-duotone ph-chart-pie fs-3"></i></span> 
                            <span class="pc-mtext">Tiến trình</span> 
                            </a> 
                        </li>
                        <?php if(getDomain() == env('APP_MAIN_SITE')): ?>
                        <li class="pc-item"> 
                            <a href="<?php echo e(route('product.purchased')); ?>" class="pc-link"> 
                            <span class="pc-micon"><i class="ph-duotone ph-shopping-cart fs-3"></i></span> 
                            <span class="pc-mtext">Tài nguyên đã mua</span> 
                            </a> 
                        </li>
                        <?php endif; ?>
                        <li class="pc-item"> 
                            <a href="<?php echo e(route('account.transactions')); ?>" class="pc-link"> 
                            <span class="pc-micon"><i class="ph-duotone ph-shopping-cart fs-3"></i></span> 
                            <span class="pc-mtext">Dòng tiền</span> 
                            </a> 
                        </li>
                        <li class="pc-item"> 
                            <a href="<?php echo e(route('create.website')); ?>" class="pc-link"> 
                            <span class="pc-micon"><i class="ph-duotone ph-desktop fs-3"></i></span> 
                            <span class="pc-mtext">Tạo Website con</span> 
                            </a> 
                        </li>
                        <li class="pc-item"> 
                            <a href="<?php echo e(route('ticket')); ?>" class="pc-link"> 
                            <span class="pc-micon"><i class="ph-duotone ph-chats-circle fs-3"></i></span> 
                            <span class="pc-mtext">Hộp thư hỗ trợ</span> 
                            </a> 
                        </li>
                        <li class="pc-item">
                            <a href="<?php echo e(route('account.recharge')); ?>" class="pc-link">
                                <span class="pc-micon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-banknote">
                                        <rect width="20" height="12" x="2" y="6" rx="2"/>
                                        <circle cx="12" cy="12" r="2"/>
                                        <path d="M6 12h.01M18 12h.01"/>
                                    </svg>
                                </span>
                                <span class="pc-mtext">Nạp tiền</span> 
                            </a>
                        </li>
                        
                        <li class="pc-item">
                            <a href="<?php echo e(route('affiliate')); ?>" class="pc-link">
                                <span class="pc-micon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5.931 6.936l1.275 4.249m5.607 5.609l4.251 1.275m-5.381-5.752l5.759-5.759M4 5.5a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0-3 0m13 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0-3 0m0 13a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0-3 0m-13-3a4.5 4.5 0 1 0 9 0a4.5 4.5 0 1 0-9 0"/></svg>
                                </span>
                                <span class="pc-mtext">Tiếp thị liên kết</span> 
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="pc-item"> 
                            <a href="<?php echo e(route('account.services')); ?>" class="pc-link"> 
                            <span class="pc-micon"><i class="ph-duotone ph-currency-circle-dollar fs-3"></i></span> 
                            <span class="pc-mtext">Cấp bậc & Bảng giá</span> 
                            </a> 
                        </li>
                        <li class="pc-item">
                            <a href="<?php echo e(route('api')); ?>" class="pc-link">
                                <span class="pc-micon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-marked">
                                        <path d="M10 2v8l3-3 3 3V2"/>
                                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"/>
                                    </svg>
                                </span>
                                <span class="pc-mtext">Tài liệu API</span> 
                            </a>
                        </li>
                        <li class="pc-item pc-caption">
                            <label>Services</label>
                        </li>
                        <?php if(getDomain() == env('APP_MAIN_SITE')): ?>
                        <li class="pc-item">
                            <a href="<?php echo e(route('product.categories')); ?>" class="pc-link">
                            <span class="pc-micon"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4"><path d="M44 14L24 4L4 14v20l20 10l20-10z"/><path stroke-linecap="round" d="m4 14l20 10m0 20V24m20-10L24 24M34 9L14 19"/></g></svg>
                            </span>
                            <span class="pc-mtext">Mua tài nguyên</span> 
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(site('status_massorder') == 'on'): ?>
                        <li class="pc-item">
                            <a href="<?php echo e(route('mass')); ?>" class="pc-link">
                            <span class="pc-micon"> <i class="ph-duotone ph-flower-lotus fs-3"></i></span>
                            <span class="pc-mtext">Đặt đơn số lượng lớn</span> 
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php $__currentLoopData = \App\Models\ServicePlatform::where('domain', env('APP_MAIN_SITE'))->where('status', 'active')->orderBy('order', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="pc-item pc-hasmenu">
                            <a href="javascript:;" class="pc-link">
                            <span class="pc-micon">
                            <img src="<?php echo e($platform->image); ?>" width="24px" height="24px">
                            </span>
                            <span class="pc-mtext"><?php echo e($platform->name); ?></span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu">
                                <?php $__currentLoopData = $platform->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="pc-item">
                                    <a href="<?php echo e(route('service', ['service' => $service->slug, 'platform' => $platform->slug])); ?>"
                                        class="pc-link">
                                    <span class="pc-mtext"><?php echo e($service->name); ?></span>
                                    </a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <div class="card nav-action-card bg-brand-color-4">
                        <div class="card-body" style="background-image: url('https://html.phoenixcoded.net/light-able/bootstrap/assets/images/layout/nav-card-bg.svg')">
                            <h5 class="text-dark">Bạn cần hỗ trợ?</h5>
                            <p class="text-dark text-opacity-75">Liên hệ với chúng tôi.</p>
                            <a href="<?php echo e(route('ticket')); ?>" class="btn btn-primary" target="_blank">Trung tâm hỗ trợ</a> 
                        </div>
                    </div>
                </div>
                <div class="card pc-user-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0"> <img src="https://ui-avatars.com/api/?background=random&name=<?php echo e((Auth::user()->name) ?? 'Bạn chưa đăng nhập'); ?>" alt="user-image" class="user-avtar wid-45 rounded-circle" /> </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="dropdown">
                                    <a href="#" class="arrow-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,20">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 me-2">
                                                <h6 class="mb-2"><?php echo e((Auth::user()->name) ?? 'Bạn chưa đăng nhập'); ?></h6>
                                                <span class="badge bg-primary p-2 font-semibold text-sm">Số dư: <?php echo e(number_format(Auth::user()->balance ?? 0) ?: '0đ'); ?></span>  
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="btn btn-icon btn-link-secondary avtar"> <i class="ph-duotone ph-windows-logo"></i> </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li> <a href="<?php echo e(route('account.profile')); ?>" class="pc-user-links"><i class="ph-duotone ph-user"></i><span>Tài khoản</span></a></li>
                                            <li> <a href="<?php echo e(route('logout')); ?>" class="pc-user-links"><i class="ph-duotone ph-power"></i> <span>Đăng xuất</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <header class="pc-header">
            <div class="header-wrapper">
                <div class="me-auto pc-mob-drp">
                    <ul class="list-unstyled">
                        <li class="pc-h-item pc-sidebar-collapse"> <a href="#" class="pc-head-link ms-0" id="sidebar-hide"> <i class="ti ti-menu-2"></i> </a> </li>
                        <li class="pc-h-item pc-sidebar-popup"> <a href="#" class="pc-head-link ms-0" id="mobile-collapse"> <i class="ti ti-menu-2"></i> </a> </li>
                        <li class="dropdown pc-h-item d-inline-flex d-md-none">
                            <a class="pc-head-link dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" > <i class="ph-duotone ph-magnifying-glass"></i> </a> 
                            <div class="dropdown-menu pc-h-dropdown drp-search">
                                <form class="px-3">
                                    <div class="mb-0 d-flex align-items-center"> <input type="search" class="form-control border-0 shadow-none" placeholder="Search..." /> <button class="btn btn-light-secondary btn-search">Search</button> </div>
                                </form>
                            </div>
                        </li>
                        <li class="pc-h-item d-none d-md-inline-flex">
                            <form class="form-search"> <i class="ph-duotone ph-magnifying-glass icon-search"></i> <input type="search" class="form-control" placeholder="Search..." /> <button class="btn btn-search" style="padding: 0"><kbd>ctrl+k</kbd></button> </form>
                        </li>
                    </ul>
                </div>
                <div class="ms-auto">
                    <ul class="list-unstyled">
                        <li class="dropdown pc-h-item d-none d-md-inline-flex">
                            <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" > <i class="ph-duotone ph-sun-dim"></i> </a> 
                            <div class="dropdown-menu dropdown-menu-end pc-h-dropdown"> <a href="#!" class="dropdown-item" onclick="layout_change('dark')"> <i class="ph-duotone ph-moon"></i> <span>Dark</span> </a> <a href="#!" class="dropdown-item" onclick="layout_change('light')"> <i class="ph-duotone ph-sun-dim"></i> <span>Light</span> </a> <a href="#!" class="dropdown-item" onclick="layout_change_default()"> <i class="ph-duotone ph-cpu"></i> <span>Default</span> </a> </div>
                        </li>
                        <li class="dropdown pc-h-item">
                            <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"  >
                            <i class="ph-duotone ph-bell"></i>
                            <span class="badge bg-success pc-h-badge">!</span>
                            </a>
                            <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                                <div class="dropdown-header d-flex align-items-center justify-content-between">
                                    <h5 class="m-0">Thông báo</h5>
                                    <ul class="list-inline ms-auto mb-0">
                                        <li class="list-inline-item">
                                            <a href="../application/mail.html" class="avtar avtar-s btn-link-hover-primary">
                                            <i class="ti ti-link f-18"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="dropdown-body text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 235px)">
                                    <ul class="list-group list-group-flush">
                                        <?php $__currentLoopData = \App\Models\NoticeService::where('domain', request()->getHost())->orderBy('id', 'desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noticeService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="list-group-item">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-s bg-light-primary">
                                                        <i class="ti ti-bell-ringing fs-4"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 me-3 position-relative">
                                                            <h6 class="mb-0"><?php echo $noticeService->content; ?></h6>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <span class="text-sm"><?php echo e(timeago($noticeService->created_at)); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <div class="dropdown-footer">
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="d-grid"><button class="btn btn-primary">Archive all</button></div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-grid"><button class="btn btn-outline-secondary">Mark all as read</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="pc-h-item"> <a class="pc-head-link pct-c-btn" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_pc_layout"> <i class="ph-duotone ph-gear-six"></i> </a> </li>
                        <li class="dropdown pc-h-item header-user-profile">
                            <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false" > <img src="https://ui-avatars.com/api/?background=random&name=<?php echo e((Auth::user()->name) ?? 'Bạn chưa đăng nhập'); ?>" alt="user-image" class="user-avtar" /> </a> 
                            <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                                <div class="dropdown-header d-flex align-items-center justify-content-between">
                                    <h5 class="m-0">Profile</h5>
                                </div>
                                <div class="dropdown-body">
                                    <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
                                        <ul class="list-group list-group-flush w-100">
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0"> <img src="https://ui-avatars.com/api/?background=random&name=<?php echo e((Auth::user()->name) ?? 'Bạn chưa đăng nhập'); ?>" alt="user-image" class="wid-50 rounded-circle" /> </div>
                                                    <div class="flex-grow-1 mx-3">
                                                        <h5 class="mb-0"><?php echo e((Auth::user()->name) ?? 'Bạn chưa đăng nhập'); ?></h5>
                                                        <h6 class="text-primary"><strong>Số dư: </strong><?php echo e(number_format(Auth::user()->balance ?? 0) ?: '0đ'); ?></h6>
                                                    </div>
                                                    <span class="badge bg-primary"><?php echo e(levelUser(Auth::user()->level ?? 'Thành viên')); ?></span> 
                                                </div>
                                            </li>
                                            <li class="list-group-item"> 
                                                <?php if(Auth::check()): ?>
                                                <a href="<?php echo e(route('account.profile')); ?>" class="dropdown-item"> 
                                                    <span class="d-flex align-items-center"> 
                                                        <i class="ph-duotone ph-user-circle"></i>
                                                        <span>Tài khoản</span> 
                                                    </span> 
                                                </a> 
                                                <a href="<?php echo e(route('logout')); ?>" class="dropdown-item"> 
                                                    <span class="d-flex align-items-center"> 
                                                        <i class="ph-duotone ph-power"></i> 
                                                        <span>Đăng xuất</span> 
                                                    </span> 
                                                </a> 
                                                <?php else: ?>
                                                <a href="<?php echo e(route('login')); ?>" class="dropdown-item"> 
                                                    <span class="d-flex align-items-center"> 
                                                        <i class="ph-duotone ph-power"></i> 
                                                        <span>Đăng nhập</span> 
                                                    </span> 
                                                </a>
                                                <?php endif; ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="pc-container">
            <div class="pc-content">
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo e(route('home')); ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house">
                                                <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/>
                                                <path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page"><?php echo $__env->yieldContent('title'); ?></li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h2 class="mb-0"><?php echo $__env->yieldContent('title'); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
        <footer class="pc-footer">
            <div class="footer-wrapper container-fluid">
                <div class="row">
                    <div class="col-sm-6 my-1">
                        <strong>
                            <p class="m-0 text-muted">Copyright © 20<?php echo e(date('y')); ?>. <a href="<?php echo e(siteValue('facebook')); ?>" target="_blank"><?php echo e(siteValue('name_site')); ?></a> - Social Media Marketing.</p>
                        </strong>
                    </div>
                    <div class="col-sm-6 ms-auto my-1">
                        <ul class="list-inline footer-link mb-0 justify-content-sm-end d-flex">
                            <p class="m-0">Designed &#9829; by <a href="https://zalo.me/0382771060" target="_blank"> Nguyen Hoang Duy</a></p>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <div class="offcanvas border-0 pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
            <div class="offcanvas-header justify-content-between">
                <h5 class="offcanvas-title">Settings</h5>
                <button type="button" class="btn btn-icon btn-link-danger" data-bs-dismiss="offcanvas" aria-label="Close" ><i class="ti ti-x"></i ></button> 
            </div>
            <div class="pct-body customizer-body">
                <div class="offcanvas-body py-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="pc-dark">
                                <h6 class="mb-1">Theme Mode</h6>
                                <p class="text-muted text-sm">Choose light or dark mode or Auto</p>
                                <div class="row theme-color theme-layout">
                                    <div class="col-4">
                                        <div class="d-grid"> <button class="preset-btn btn active" data-value="true" onclick="layout_change('light');"> <span class="btn-label">Light</span> <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span> </button> </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-grid"> <button class="preset-btn btn" data-value="false" onclick="layout_change('dark');"> <span class="btn-label">Dark</span> <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span> </button> </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-grid"> <button class="preset-btn btn" data-value="default" onclick="layout_change_default();" data-bs-toggle="tooltip" title="Automatically sets the theme based on user's operating system's color scheme." > <span class="btn-label">Default</span> <span class="pc-lay-icon d-flex align-items-center justify-content-center"> <i class="ph-duotone ph-cpu"></i> </span> </button> </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item pc-sidebar-color">
                            <h6 class="mb-1">Sidebar Theme</h6>
                            <p class="text-muted text-sm">Choose Sidebar Theme</p>
                            <div class="row theme-color theme-sidebar-color">
                                <div class="col-6">
                                    <div class="d-grid"> <button class="preset-btn btn" data-value="true" onclick="layout_sidebar_change('dark');"> <span class="btn-label">Dark</span> <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span> </button> </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-grid"> <button class="preset-btn btn active" data-value="false" onclick="layout_sidebar_change('light');"> <span class="btn-label">Light</span> <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span> </button> </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <h6 class="mb-1">Accent color</h6>
                            <p class="text-muted text-sm">Choose your primary theme color</p>
                            <div class="theme-color preset-color"> <a href="#!" class="active" data-value="preset-1"><i class="ti ti-check"></i></a> <a href="#!" data-value="preset-2"><i class="ti ti-check"></i></a> <a href="#!" data-value="preset-3"><i class="ti ti-check"></i></a> <a href="#!" data-value="preset-4"><i class="ti ti-check"></i></a> <a href="#!" data-value="preset-5"><i class="ti ti-check"></i></a> <a href="#!" data-value="preset-6"><i class="ti ti-check"></i></a> <a href="#!" data-value="preset-7"><i class="ti ti-check"></i></a> <a href="#!" data-value="preset-8"><i class="ti ti-check"></i></a> <a href="#!" data-value="preset-9"><i class="ti ti-check"></i></a> <a href="#!" data-value="preset-10"><i class="ti ti-check"></i></a> </div>
                        </li>
                        <li class="list-group-item">
                            <h6 class="mb-1">Sidebar Caption</h6>
                            <p class="text-muted text-sm">Sidebar Caption Hide/Show</p>
                            <div class="row theme-color theme-nav-caption">
                                <div class="col-6">
                                    <div class="d-grid"> <button class="preset-btn btn active" data-value="true" onclick="layout_caption_change('true');"> <span class="btn-label">Caption Show</span> <span class="pc-lay-icon" ><span></span><span></span><span><span></span><span></span></span><span></span ></span> </button> </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-grid"> <button class="preset-btn btn" data-value="false" onclick="layout_caption_change('false');"> <span class="btn-label">Caption Hide</span> <span class="pc-lay-icon" ><span></span><span></span><span><span></span><span></span></span><span></span ></span> </button> </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="pc-rtl">
                                <h6 class="mb-1">Theme Layout</h6>
                                <p class="text-muted text-sm">LTR/RTL</p>
                                <div class="row theme-color theme-direction">
                                    <div class="col-6">
                                        <div class="d-grid"> <button class="preset-btn btn active" data-value="false" onclick="layout_rtl_change('false');"> <span class="btn-label">LTR</span> <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span> </button> </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-grid"> <button class="preset-btn btn" data-value="true" onclick="layout_rtl_change('true');"> <span class="btn-label">RTL</span> <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span> </button> </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item pc-box-width">
                            <div class="pc-container-width">
                                <h6 class="mb-1">Layout Width</h6>
                                <p class="text-muted text-sm">Choose Full or Container Layout</p>
                                <div class="row theme-color theme-container">
                                    <div class="col-6">
                                        <div class="d-grid"> <button class="preset-btn btn active" data-value="false" onclick="change_box_container('false')"> <span class="btn-label">Full Width</span> <span class="pc-lay-icon" ><span></span><span></span><span></span><span><span></span></span ></span> </button> </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-grid"> <button class="preset-btn btn" data-value="true" onclick="change_box_container('true')"> <span class="btn-label">Fixed Width</span> <span class="pc-lay-icon" ><span></span><span></span><span></span><span><span></span></span ></span> </button> </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-grid"> <button class="btn btn-light-danger" id="layoutreset">Reset Layout</button> </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php if(Auth::check()): ?>
        <?php else: ?>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                toast: true, 
                position: 'top', 
                icon: 'warning', 
                title: 'Bạn chưa đăng nhập!', 
                text: 'Vui lòng đăng nhập để sử dụng dịch vụ',
                showConfirmButton: false, 
                timer: 3000, 
                timerProgressBar: true 
                });
            });
        </script>
        <?php endif; ?>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.js"></script>
        <script src="/app/js/app.js?duy-time=<?php echo e(time()); ?>"></script>
        <script src="/app/js/plugins/popper.min.js"></script> 
        <script src="/app/js/plugins/simplebar.min.js"></script> 
        <script src="/app/js/plugins/bootstrap.min.js"></script> 
        <script src="/app/js/script.js"></script> 
        <script src="/app/js/theme.js"></script>
        <script src="/app/js/plugins/feather.min.js"></script> 
        <script src="/app/js/plugins/dataTables.min.js"></script>
        <script src="/app/js/plugins/dataTables.bootstrap5.min.js"></script>
        <?php echo site('script_footer'); ?>

        <?php if(session('success')): ?>
        <script>
            Swal.fire({
                title: 'Thành công',
                text: '<?php echo e(session('success')); ?>',
                icon: 'success',
                confirmButtonText: 'Đóng',
                customClass: {
                    confirmButton: 'swal2-confirm btn btn-success' 
                }
            })
        </script>
        <?php endif; ?>
        <?php if(session('error')): ?>
        <script>
            Swal.fire({
                title: 'Lỗi',
                text: '<?php echo e(session('error')); ?>',
                icon: 'error',
                confirmButtonText: 'Đóng',
                customClass: {
                    confirmButton: 'swal2-confirm btn btn-danger' 
                }
            })
        </script>
        <?php endif; ?>
        <?php echo $__env->yieldContent('script'); ?>
        <script>
            $('#data-table').DataTable();
            $('#jsource-table').DataTable({
              data: dataSet,
            });
        </script>
    </body>
</html><?php /**PATH C:\xampp\htdocs\socialmedia\app\resources\views/guard/layouts/app.blade.php ENDPATH**/ ?>