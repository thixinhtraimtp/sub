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
        <link rel="stylesheet" href="/app/css/plugins/jsvectormap.min.css" />
        <link rel="stylesheet" href="https://html.phoenixcoded.net/light-able/bootstrap/assets/css/plugins/dataTables.bootstrap5.min.css" />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="/app/fonts/phosphor/duotone/style.css" />
        <link rel="stylesheet" href="/app/fonts/tabler-icons.min.css" />
        <link rel="stylesheet" href="/app/fonts/feather.css" />
        <link rel="stylesheet" href="/app/fonts/fontawesome.css" />
        <link rel="stylesheet" href="/app/fonts/material.css" />
        <link rel="stylesheet" href="/app/css/style.css" id="main-style-link" />
        <link rel="stylesheet" href="/app/css/style-preset.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <?php echo site('script_head'); ?>

    </head>
    <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
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
                        <li class="pc-item pc-caption">
                            <label>Main</label>
                        </li>
                        <li class="pc-item">
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="pc-link">
                                <span class="pc-micon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 256 256"><g fill="currentColor"><path d="M232 152v24a8 8 0 0 1-8 8H32a8 8 0 0 1-8-8v-22.87C24 95.65 70.15 48.2 127.63 48A104 104 0 0 1 232 152" opacity="0.2"/><path d="M207.06 72.67A111.24 111.24 0 0 0 128 40h-.4C66.07 40.21 16 91 16 153.13V176a16 16 0 0 0 16 16h192a16 16 0 0 0 16-16v-24a111.25 111.25 0 0 0-32.94-79.33M224 176H119.71l54.76-75.3a8 8 0 0 0-12.94-9.42L99.92 176H32v-22.87c0-3.08.15-6.12.43-9.13H56a8 8 0 0 0 0-16H35.27c10.32-38.86 44-68.24 84.73-71.66V80a8 8 0 0 0 16 0V56.33A96.14 96.14 0 0 1 221 128h-21a8 8 0 0 0 0 16h23.67c.21 2.65.33 5.31.33 8Z"/></g></svg>
                                </span>
                                <span class="pc-mtext">Trang thống kê</span>
                            </a>
                        </li>
                        <li class="pc-item">
                            <a href="<?php echo e(route('admin.website.config')); ?>" class="pc-link">
                                <span class="pc-micon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 48 48"><defs><mask id="ipTSetting0"><g fill="#555555" stroke="#fff" stroke-linejoin="round" stroke-width="4"><path d="M36.686 15.171a15.4 15.4 0 0 1 2.529 6.102H44v5.454h-4.785a15.4 15.4 0 0 1-2.529 6.102l3.385 3.385l-3.857 3.857l-3.385-3.385a15.4 15.4 0 0 1-6.102 2.529V44h-5.454v-4.785a15.4 15.4 0 0 1-6.102-2.529l-3.385 3.385l-3.857-3.857l3.385-3.385a15.4 15.4 0 0 1-2.529-6.102H4v-5.454h4.785a15.4 15.4 0 0 1 2.529-6.102l-3.385-3.385l3.857-3.857l3.385 3.385a15.4 15.4 0 0 1 6.102-2.529V4h5.454v4.785a15.4 15.4 0 0 1 6.102 2.529l3.385-3.385l3.857 3.857z"/><path d="M24 29a5 5 0 1 0 0-10a5 5 0 0 0 0 10Z"/></g></mask></defs><path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipTSetting0)"/></svg>
                                </span>
                                <span class="pc-mtext">Cài đặt</span>
                            </a>
                        </li>
                        <li class="pc-item">
                            <a href="<?php echo e(route('admin.payment.config')); ?>" class="pc-link">
                                <span class="pc-micon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"><path fill="currentColor" d="M3 20q-.825 0-1.412-.587T1 18V8q0-.425.288-.712T2 7t.713.288T3 8v10h16q.425 0 .713.288T20 19t-.288.713T19 20zm4-4q-.825 0-1.412-.587T5 14V6q0-.825.588-1.412T7 4h14q.825 0 1.413.588T23 6v8q0 .825-.587 1.413T21 16zm2-2q0-.825-.587-1.412T7 12v2zm10 0h2v-2q-.825 0-1.412.588T19 14m-5-1q1.25 0 2.125-.875T17 10t-.875-2.125T14 7t-2.125.875T11 10t.875 2.125T14 13M7 8q.825 0 1.413-.587T9 6H7zm14 0V6h-2q0 .825.588 1.413T21 8"/></svg>
                                </span>
                                <span class="pc-mtext">Thanh toán</span>
                            </a>
                        </li>
                        <li class="pc-item">
                            <a href="<?php echo e(route('admin.website.partner')); ?>" class="pc-link">
                                <span class="pc-micon">
                                    <i class="ph-duotone ph-globe fs-3"></i>
                                </span>
                            <span class="pc-mtext">Website con</span>
                            </a>
                        </li>
                        <li class="pc-item">
                            <a href="<?php echo e(route('admin.notify')); ?>" class="pc-link">
                                <span class="pc-micon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"><path fill="currentColor" d="M22 12c0 4.714 0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12s0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12" opacity="0.5"/><path fill="currentColor" d="M22 5a3 3 0 1 1-6 0a3 3 0 0 1 6 0"/></svg>
                                </span>
                            <span class="pc-mtext">Thông báo</span>
                            </a>
                        </li>
                        <li class="pc-item">
                            <a href="<?php echo e(route('admin.ticket.ticket')); ?>" class="pc-link">
                                <span class="pc-micon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 48 48"><defs><mask id="ipTTicket0"><g fill="none" stroke="#fff" stroke-linecap="round" stroke-width="4"><path stroke-linejoin="round" d="M9 16L34 6l4 10"/><path fill="#555555" stroke-linejoin="round" d="M4 16h40v6c-3 0-6 2-6 5.5s3 6.5 6 6.5v6H4v-6c3 0 6-2 6-6s-3-6-6-6z"/><path d="M17 25.385h6m-6 6h14"/></g></mask></defs><path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipTTicket0)"/></svg>                                
                                </span>
                                <span class="pc-mtext">Ticket</span>
                            </a>
                        </li>
                        <li class="pc-item">
                            <a href="<?php echo e(route('admin.user.history')); ?>" class="pc-link">
                                <span class="pc-micon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"><g fill="none"><circle cx="12" cy="12" r="9" fill="currentColor" opacity="0.16"/><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 18.364A9 9 0 1 0 3 12.004V14"/><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 12l2 2l2-2m6-4v5h5"/></g></svg>
                                </span>
                            <span class="pc-mtext">Biến động số dư</span>
                            </a>
                        </li>
                        <li class="pc-item pc-hasmenu">
                            <a href="javascript:;" class="pc-link">
                                <span class="pc-micon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"><path fill="currentColor" d="M15.5 7.5a3.5 3.5 0 1 1-7 0a3.5 3.5 0 0 1 7 0"/><path fill="currentColor" d="M19.5 7.5a2.5 2.5 0 1 1-5 0a2.5 2.5 0 0 1 5 0m-15 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 0 0-5 0" opacity="0.4"/><path fill="currentColor" d="M18 16.5c0 1.933-2.686 3.5-6 3.5s-6-1.567-6-3.5S8.686 13 12 13s6 1.567 6 3.5"/><path fill="currentColor" d="M22 16.5c0 1.38-1.79 2.5-4 2.5s-4-1.12-4-2.5s1.79-2.5 4-2.5s4 1.12 4 2.5m-20 0C2 17.88 3.79 19 6 19s4-1.12 4-2.5S8.21 14 6 14s-4 1.12-4 2.5" opacity="0.4"/></svg>                                
                                </span>
                                <span class="pc-mtext">Thành viên</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu">
                                <li class="pc-item"><a class="pc-link" href="<?php echo e(route('admin.user')); ?>">Danh sách thành viên</a></li>
                                <li class="pc-item"><a class="pc-link" href="<?php echo e(route('admin.user.balance')); ?>">Thay đổi số dư</a></li>
                            </ul>
                        </li>
                        <?php if(request()->getHost() === env('APP_MAIN_SITE')): ?>
                        <li class="pc-item">
                            <a href="<?php echo e(route('admin.service.smm')); ?>" class="pc-link">
                                <span class="pc-micon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 48 48"><defs><mask id="ipTConnect0"><g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"><path fill="#555555" fill-rule="evenodd" d="M8 12a4 4 0 1 0 0-8a4 4 0 0 0 0 8m2 30a6 6 0 1 0 0-12a6 6 0 0 0 0 12m28 2a6 6 0 1 0 0-12a6 6 0 0 0 0 12M22 28a8 8 0 1 0 0-16a8 8 0 0 0 0 16m12-16a4 4 0 1 0 0-8a4 4 0 0 0 0 8" clip-rule="evenodd"/><path d="m11 11l4 4m15-3l-2 2m6 19.5L28 26m-14 5l4-4"/></g></mask></defs><path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipTConnect0)"/></svg>
                                </span>
                                <span class="pc-mtext">API Provider</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="pc-item">
                            <a href="<?php echo e(route('admin.voucher')); ?>" class="pc-link">
                                <span class="pc-micon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="m14.014 17l-.006 2.003c-.001.47-.002.705-.149.851s-.382.146-.854.146h-3.01c-3.78 0-5.67 0-6.845-1.172c-.81-.806-1.061-1.951-1.14-3.817c-.015-.37-.023-.556.046-.679c.07-.123.345-.277.897-.586a1.999 1.999 0 0 0 0-3.492c-.552-.308-.828-.463-.897-.586s-.061-.308-.045-.679c.078-1.866.33-3.01 1.139-3.817C4.324 4 6.214 4 9.995 4h3.51a.5.5 0 0 1 .501.499L14.014 7c0 .552.449 1 1.002 1v2c-.553 0-1.002.448-1.002 1v2c0 .552.449 1 1.002 1v2c-.553 0-1.002.448-1.002 1" clip-rule="evenodd"/><path fill="currentColor" d="M15.017 16c.553 0 1.002.448 1.002 1v1.976c0 .482 0 .723.155.87c.154.148.39.138.863.118c1.863-.079 3.007-.331 3.814-1.136c.809-.806 1.06-1.952 1.139-3.818c.015-.37.023-.555-.046-.678c-.069-.124-.345-.278-.897-.586a1.999 1.999 0 0 1 0-3.492c.552-.309.828-.463.897-.586c.07-.124.061-.309.046-.679c-.079-1.866-.33-3.011-1.14-3.818c-.877-.875-2.154-1.096-4.322-1.152a.497.497 0 0 0-.509.497V7c0 .552-.449 1-1.002 1v2a1 1 0 0 1 1.002 1v2c0 .552-.449 1-1.002 1z" opacity="0.5"/></svg>
                                </span>
                                <span class="pc-mtext">Mã giảm giá</span>
                            </a> 
                        </li>
                        <li class="pc-item pc-hasmenu">
                            <a href="javascript:;" class="pc-link">
                                <span class="pc-micon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"><path fill="currentColor" d="M12 14.195c-.176 0-.348-.046-.5-.133l-9-5.198a1 1 0 0 1 0-1.732l9-5.194c.31-.177.69-.177 1 0l9 5.194a1 1 0 0 1 0 1.732l-9 5.198a1 1 0 0 1-.5.133" opacity="0.25"/><path fill="currentColor" d="m21.5 11.132l-1.964-1.134l-7.036 4.064c-.31.178-.69.178-1 0L4.464 9.998L2.5 11.132a1 1 0 0 0 0 1.732l9 5.198c.31.178.69.178 1 0l9-5.198a1 1 0 0 0 0-1.732" opacity="0.5"/><path fill="currentColor" d="m21.5 15.132l-1.964-1.134l-7.036 4.064c-.31.178-.69.178-1 0l-7.036-4.064L2.5 15.132a1 1 0 0 0 0 1.732l9 5.198c.31.178.69.178 1 0l9-5.198a1 1 0 0 0 0-1.732"/></svg>                                
                                </span>
                                <span class="pc-mtext">Dịch vụ</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu">
                                <?php if(request()->getHost() === env('APP_MAIN_SITE')): ?>
                                <li class="pc-item"><a class="pc-link" href="<?php echo e(route('admin.service.platform')); ?>">Danh sách nền
                                    tảng</a>
                                </li>
                                <li class="pc-item"><a class="pc-link" href="<?php echo e(route('admin.service')); ?>">Danh sách dịch vụ</a></li>
                                <li class="pc-item"><a class="pc-link" href="<?php echo e(route('admin.server')); ?>">Danh sách máy chủ</a></li>
                                <?php else: ?>
                                <li class="pc-item"><a class="pc-link" href="<?php echo e(route('admin.server')); ?>">Danh sách máy chủ</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li class="pc-item pc-hasmenu">
                            <a href="javascript:;" class="pc-link">
                                <span class="pc-micon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 48 48"><defs><mask id="ipTShopping0"><g fill="none"><path fill="#555555" d="M39 32H13L8 12h36z"/><path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M3 6h3.5L8 12m0 0l5 20h26l5-20z"/><circle cx="13" cy="39" r="3" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"/><circle cx="39" cy="39" r="3" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"/></g></mask></defs><path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipTShopping0)"/></svg>
                                </span>
                                <span class="pc-mtext">Đơn hàng</span>
                                <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="pc-submenu">
                                <li class="pc-item"><a class="pc-link" href="<?php echo e(route('admin.history.orders')); ?>">Lịch sử tạo đơn</a>
                                </li>
                                <li class="pc-item"><a class="pc-link" href="<?php echo e(route('admin.history.payment')); ?>">Lịch sử nạp tiền</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="card pc-user-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0"> <img src="https://ui-avatars.com/api/?background=random&name=<?php echo e((Auth::user()->name)); ?>" alt="user-image" class="user-avtar wid-45 rounded-circle" /> </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="dropdown">
                                    <a href="#" class="arrow-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,20">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 me-2">
                                                <h6 class="mb-2"><?php echo e((Auth::user()->name)); ?></h6>
                                                <span class="badge bg-primary p-2 font-semibold text-sm">Quản trị viên</span>  
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
                        <li class="pc-h-item"> <a class="pc-head-link pct-c-btn" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_pc_layout"> <i class="ph-duotone ph-gear-six"></i> </a> </li>
                        <li class="dropdown pc-h-item header-user-profile">
                            <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false" > <img src="https://ui-avatars.com/api/?background=random&name=<?php echo e((Auth::user()->name)); ?>" alt="user-image" class="user-avtar" /> </a> 
                            <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                                <div class="dropdown-header d-flex align-items-center justify-content-between">
                                    <h5 class="m-0">Profile</h5>
                                </div>
                                <div class="dropdown-body">
                                    <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
                                        <ul class="list-group list-group-flush w-100">
                                            <li class="list-group-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0"> <img src="https://ui-avatars.com/api/?background=random&name=<?php echo e((Auth::user()->name)); ?>" alt="user-image" class="wid-50 rounded-circle" /> </div>
                                                    <div class="flex-grow-1 mx-3">
                                                        <h5 class="mb-0"><?php echo e((Auth::user()->name)); ?></h5>
                                                        <h6 class="text-primary"><strong>Quản trị viên</strong></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item"> 
                                                <a href="<?php echo e(route('home')); ?>" class="dropdown-item"> 
                                                <span class="d-flex align-items-center"> 
                                                <i class="ph-duotone ph-power"></i> 
                                                <span>Về trang chủ</span> 
                                                </span> 
                                                </a> 
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.js"></script>

        <script src="/app/js/plugins/popper.min.js"></script> 
        <script src="/app/js/plugins/simplebar.min.js"></script> 
        <script src="/app/js/plugins/bootstrap.min.js"></script> 
        <script src="/app/js/script.js"></script> 
        <script src="/app/js/theme.js"></script>
        <script src="/app/js/plugins/feather.min.js"></script> 
        <script src="/app/js/plugins/dataTables.min.js"></script>
        <script src="/app/js/plugins/dataTables.bootstrap5.min.js"></script>
        <script src="/main/js/sweetalert2.min.js"></script>
        <script src="/app/js/app.js?duy-time=<?php echo e(time()); ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
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
</html><?php /**PATH /home/seeding1/public_html/resources/views/admin/layouts/master.blade.php ENDPATH**/ ?>