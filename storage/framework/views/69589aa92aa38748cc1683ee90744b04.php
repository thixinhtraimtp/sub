<!DOCTYPE html>
<html lang="<?php echo e(str_replace('-', '_', app()->getLocale())); ?>" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">
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
        <meta http-equiv="imagetoolbar" content="no" />
        <script src="/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
        <script src="/assets/js/main.js"></script>
        <link id="style" href="/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="/assets/css/styles.min.css" rel="stylesheet" />
        <link href="/assets/css/icons.css" rel="stylesheet" />
        <link href="/assets/libs/node-waves/waves.min.css" rel="stylesheet" />
        <link href="/assets/libs/simplebar/simplebar.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/assets/libs/flatpickr/flatpickr.min.css" />
        <link rel="stylesheet" href="/assets/libs/@simonwep/pickr/themes/nano.min.css" />
        <link rel="stylesheet" href="/assets/libs/choices.js/public/assets/styles/choices.min.css" />
        <link rel="stylesheet" href="/assets/libs/jsvectormap/css/jsvectormap.min.css" />
        <link rel="stylesheet" href="/assets/libs/swiper/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.12/sweetalert2.min.css">
        <link rel="stylesheet" href="https://html.phoenixcoded.net/light-able/bootstrap/assets/css/plugins/dataTables.bootstrap5.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


        
    </head>
    <body>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="switcher-canvas" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title text-default" id="offcanvasRightLabel">Switcher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <nav class="border-bottom border-block-end-dashed">
                    <div class="nav nav-tabs nav-justified" id="switcher-main-tab" role="tablist">
                        <button class="nav-link active" id="switcher-home-tab" data-bs-toggle="tab" data-bs-target="#switcher-home" type="button" role="tab" aria-controls="switcher-home" aria-selected="true">Theme Styles</button>
                        <button class="nav-link" id="switcher-profile-tab" data-bs-toggle="tab" data-bs-target="#switcher-profile" type="button" role="tab" aria-controls="switcher-profile" aria-selected="false">Theme Colors</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active border-0" id="switcher-home" role="tabpanel" aria-labelledby="switcher-home-tab" tabindex="0">
                        <div class="">
                            <p class="switcher-style-head">Theme Color Mode:</p>
                            <div class="row switcher-style gx-0">
                                <div class="col-4">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-light-theme"> Light </label> <input class="form-check-input" type="radio" name="theme-style" id="switcher-light-theme" checked />
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-dark-theme"> Dark </label> <input class="form-check-input" type="radio" name="theme-style" id="switcher-dark-theme" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <p class="switcher-style-head">Directions:</p>
                            <div class="row switcher-style gx-0">
                                <div class="col-4">
                                    <div class="form-check switch-select"><label class="form-check-label" for="switcher-ltr"> LTR </label> <input class="form-check-input" type="radio" name="direction" id="switcher-ltr" checked /></div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check switch-select"><label class="form-check-label" for="switcher-rtl"> RTL </label> <input class="form-check-input" type="radio" name="direction" id="switcher-rtl" /></div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <p class="switcher-style-head">Navigation Styles:</p>
                            <div class="row switcher-style gx-0">
                                <div class="col-4">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-vertical"> Vertical </label> <input class="form-check-input" type="radio" name="navigation-style" id="switcher-vertical" checked />
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-horizontal"> Horizontal </label> <input class="form-check-input" type="radio" name="navigation-style" id="switcher-horizontal" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="navigation-menu-styles">
                            <p class="switcher-style-head">Vertical & Horizontal Menu Styles:</p>
                            <div class="row switcher-style gx-0 pb-2 gy-2">
                                <div class="col-4">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-menu-click"> Menu Click </label> <input class="form-check-input" type="radio" name="navigation-menu-styles" id="switcher-menu-click" />
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-menu-hover"> Menu Hover </label> <input class="form-check-input" type="radio" name="navigation-menu-styles" id="switcher-menu-hover" />
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-icon-click"> Icon Click </label> <input class="form-check-input" type="radio" name="navigation-menu-styles" id="switcher-icon-click" />
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-icon-hover"> Icon Hover </label> <input class="form-check-input" type="radio" name="navigation-menu-styles" id="switcher-icon-hover" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidemenu-layout-styles">
                            <p class="switcher-style-head">Sidemenu Layout Styles:</p>
                            <div class="row switcher-style gx-0 pb-2 gy-2">
                                <div class="col-sm-6">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-default-menu"> Default Menu </label> <input class="form-check-input" type="radio" name="sidemenu-layout-styles" id="switcher-default-menu" checked />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-closed-menu"> Closed Menu </label> <input class="form-check-input" type="radio" name="sidemenu-layout-styles" id="switcher-closed-menu" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-icontext-menu"> Icon Text </label> <input class="form-check-input" type="radio" name="sidemenu-layout-styles" id="switcher-icontext-menu" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-icon-overlay"> Icon Overlay </label> <input class="form-check-input" type="radio" name="sidemenu-layout-styles" id="switcher-icon-overlay" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-detached"> Detached </label> <input class="form-check-input" type="radio" name="sidemenu-layout-styles" id="switcher-detached" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-double-menu"> Double Menu </label> <input class="form-check-input" type="radio" name="sidemenu-layout-styles" id="switcher-double-menu" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <p class="switcher-style-head">Page Styles:</p>
                            <div class="row switcher-style gx-0">
                                <div class="col-4">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-regular"> Regular </label> <input class="form-check-input" type="radio" name="page-styles" id="switcher-regular" checked />
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-classic"> Classic </label> <input class="form-check-input" type="radio" name="page-styles" id="switcher-classic" />
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check switch-select"><label class="form-check-label" for="switcher-modern"> Modern </label> <input class="form-check-input" type="radio" name="page-styles" id="switcher-modern" /></div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <p class="switcher-style-head">Layout Width Styles:</p>
                            <div class="row switcher-style gx-0">
                                <div class="col-4">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-full-width"> Full Width </label> <input class="form-check-input" type="radio" name="layout-width" id="switcher-full-width" checked />
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check switch-select"><label class="form-check-label" for="switcher-boxed"> Boxed </label> <input class="form-check-input" type="radio" name="layout-width" id="switcher-boxed" /></div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <p class="switcher-style-head">Menu Positions:</p>
                            <div class="row switcher-style gx-0">
                                <div class="col-4">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-menu-fixed"> Fixed </label> <input class="form-check-input" type="radio" name="menu-positions" id="switcher-menu-fixed" checked />
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-menu-scroll"> Scrollable </label> <input class="form-check-input" type="radio" name="menu-positions" id="switcher-menu-scroll" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <p class="switcher-style-head">Header Positions:</p>
                            <div class="row switcher-style gx-0">
                                <div class="col-4">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-header-fixed"> Fixed </label> <input class="form-check-input" type="radio" name="header-positions" id="switcher-header-fixed" checked />
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check switch-select">
                                        <label class="form-check-label" for="switcher-header-scroll"> Scrollable </label> <input class="form-check-input" type="radio" name="header-positions" id="switcher-header-scroll" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade border-0" id="switcher-profile" role="tabpanel" aria-labelledby="switcher-profile-tab" tabindex="0">
                        <div>
                            <div class="theme-colors">
                                <p class="switcher-style-head">Menu Colors:</p>
                                <div class="d-flex switcher-style pb-2">
                                    <div class="form-check switch-select me-3">
                                        <input class="form-check-input color-input color-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Light Menu" type="radio" name="menu-colors" id="switcher-menu-light" />
                                    </div>
                                    <div class="form-check switch-select me-3">
                                        <input class="form-check-input color-input color-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Dark Menu" type="radio" name="menu-colors" id="switcher-menu-dark" checked />
                                    </div>
                                    <div class="form-check switch-select me-3">
                                        <input class="form-check-input color-input color-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Color Menu" type="radio" name="menu-colors" id="switcher-menu-primary" />
                                    </div>
                                    <div class="form-check switch-select me-3">
                                        <input class="form-check-input color-input color-gradient" data-bs-toggle="tooltip" data-bs-placement="top" title="Gradient Menu" type="radio" name="menu-colors" id="switcher-menu-gradient" />
                                    </div>
                                    <div class="form-check switch-select me-3">
                                        <input
                                            class="form-check-input color-input color-transparent"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Transparent Menu"
                                            type="radio"
                                            name="menu-colors"
                                            id="switcher-menu-transparent"
                                            />
                                    </div>
                                </div>
                                <div class="px-4 pb-3 text-muted fs-11">Note:If you want to change color Menu dynamically change from below Theme Primary color picker</div>
                            </div>
                            <div class="theme-colors">
                                <p class="switcher-style-head">Header Colors:</p>
                                <div class="d-flex switcher-style pb-2">
                                    <div class="form-check switch-select me-3">
                                        <input class="form-check-input color-input color-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Light Header" type="radio" name="header-colors" id="switcher-header-light" checked />
                                    </div>
                                    <div class="form-check switch-select me-3">
                                        <input class="form-check-input color-input color-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Dark Header" type="radio" name="header-colors" id="switcher-header-dark" />
                                    </div>
                                    <div class="form-check switch-select me-3">
                                        <input class="form-check-input color-input color-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Color Header" type="radio" name="header-colors" id="switcher-header-primary" />
                                    </div>
                                    <div class="form-check switch-select me-3">
                                        <input class="form-check-input color-input color-gradient" data-bs-toggle="tooltip" data-bs-placement="top" title="Gradient Header" type="radio" name="header-colors" id="switcher-header-gradient" />
                                    </div>
                                    <div class="form-check switch-select me-3">
                                        <input
                                            class="form-check-input color-input color-transparent"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Transparent Header"
                                            type="radio"
                                            name="header-colors"
                                            id="switcher-header-transparent"
                                            />
                                    </div>
                                </div>
                                <div class="px-4 pb-3 text-muted fs-11">Note:If you want to change color Header dynamically change from below Theme Primary color picker</div>
                            </div>
                            <div class="theme-colors">
                                <p class="switcher-style-head">Theme Primary:</p>
                                <div class="d-flex flex-wrap align-items-center switcher-style">
                                    <div class="form-check switch-select me-3"><input class="form-check-input color-input color-primary-1" type="radio" name="theme-primary" id="switcher-primary" /></div>
                                    <div class="form-check switch-select me-3"><input class="form-check-input color-input color-primary-2" type="radio" name="theme-primary" id="switcher-primary1" /></div>
                                    <div class="form-check switch-select me-3"><input class="form-check-input color-input color-primary-3" type="radio" name="theme-primary" id="switcher-primary2" /></div>
                                    <div class="form-check switch-select me-3"><input class="form-check-input color-input color-primary-4" type="radio" name="theme-primary" id="switcher-primary3" /></div>
                                    <div class="form-check switch-select me-3"><input class="form-check-input color-input color-primary-5" type="radio" name="theme-primary" id="switcher-primary4" /></div>
                                    <div class="form-check switch-select ps-0 mt-1 color-primary-light">
                                        <div class="theme-container-primary"></div>
                                        <div class="pickr-container-primary"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="theme-colors">
                                <p class="switcher-style-head">Theme Background:</p>
                                <div class="d-flex flex-wrap align-items-center switcher-style">
                                    <div class="form-check switch-select me-3"><input class="form-check-input color-input color-bg-1" type="radio" name="theme-background" id="switcher-background" /></div>
                                    <div class="form-check switch-select me-3"><input class="form-check-input color-input color-bg-2" type="radio" name="theme-background" id="switcher-background1" /></div>
                                    <div class="form-check switch-select me-3"><input class="form-check-input color-input color-bg-3" type="radio" name="theme-background" id="switcher-background2" /></div>
                                    <div class="form-check switch-select me-3"><input class="form-check-input color-input color-bg-4" type="radio" name="theme-background" id="switcher-background3" /></div>
                                    <div class="form-check switch-select me-3"><input class="form-check-input color-input color-bg-5" type="radio" name="theme-background" id="switcher-background4" /></div>
                                    <div class="form-check switch-select ps-0 mt-1 tooltip-static-demo color-bg-transparent">
                                        <div class="theme-container-background"></div>
                                        <div class="pickr-container-background"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-image mb-3">
                                <p class="switcher-style-head">Menu With Background Image:</p>
                                <div class="d-flex flex-wrap align-items-center switcher-style">
                                    <div class="form-check switch-select m-2"><input class="form-check-input bgimage-input bg-img1" type="radio" name="theme-background" id="switcher-bg-img" /></div>
                                    <div class="form-check switch-select m-2"><input class="form-check-input bgimage-input bg-img2" type="radio" name="theme-background" id="switcher-bg-img1" /></div>
                                    <div class="form-check switch-select m-2"><input class="form-check-input bgimage-input bg-img3" type="radio" name="theme-background" id="switcher-bg-img2" /></div>
                                    <div class="form-check switch-select m-2"><input class="form-check-input bgimage-input bg-img4" type="radio" name="theme-background" id="switcher-bg-img3" /></div>
                                    <div class="form-check switch-select m-2"><input class="form-check-input bgimage-input bg-img5" type="radio" name="theme-background" id="switcher-bg-img4" /></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between canvas-footer flex-wrap">
                        <a href="https://themeforest.net/item/ynex-bootstrap-admin-dashboard-template/45551445" class="btn btn-primary m-1">Buy Now</a>
                        <a href="https://themeforest.net/user/spruko/portfolio" class="btn btn-secondary m-1">Our Portfolio</a> <a href="javascript:void(0);" id="reset-all" class="btn btn-danger m-1">Reset</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Switcher -->
        <div class="page">
            <!-- app-header -->
            <header class="app-header">
                <!-- Start::main-header-container -->
                <div class="main-header-container container-fluid">
                    <!-- Start::header-content-left -->
                    <div class="header-content-left">
                        <!-- Start::header-element -->
                        <div class="header-element">
                            <div class="horizontal-logo">
                                <a href="index.html" class="header-logo">
                                <img src="/assets/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo" /> <img src="/assets/images/brand-logos/toggle-logo.png" alt="logo" class="toggle-logo" />
                                <img src="/assets/images/brand-logos/desktop-dark.png" alt="logo" class="desktop-dark" /> <img src="/assets/images/brand-logos/toggle-dark.png" alt="logo" class="toggle-dark" />
                                </a>
                            </div>
                        </div>
                        <div class="header-element">
                            <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                        </div>
                    </div>
                    <div class="header-content-right">
                        <div class="header-element header-theme-mode">
                            <a href="javascript:void(0);" class="header-link layout-setting">
                            <span class="light-layout">
                            <i class="bx bx-moon header-link-icon"></i>
                            </span>
                            <span class="dark-layout">
                            <i class="bx bx-sun header-link-icon"></i>
                            </span>
                            </a>
                        </div>
                        <div class="header-element">
                            <!-- Start::header-link|dropdown-toggle -->
                            <a href="#" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <div class="me-sm-2 me-0"><img src="/assets/images/faces/9.jpg" alt="img" width="32" height="32" class="rounded-circle" /></div>
                                    <div class="d-sm-block d-none">
                                        <p class="fw-semibold mb-0 lh-1"><?php echo e(Auth::user()->username); ?></p>
                                        <span class="op-7 fw-normal d-block fs-11">Web Designer</span>
                                    </div>
                                </div>
                            </a>
                            <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
                                <li>
                                    <a class="dropdown-item d-flex" href="/"><i class="ti ti-logout fs-18 me-2 op-7"></i>Về trang chủ</a>
                                </li>
                            </ul>
                        </div>
                        <div class="header-element">
                            <a href="#" class="header-link switcher-icon" data-bs-toggle="offcanvas" data-bs-target="#switcher-canvas"> <i class="bx bx-cog header-link-icon"></i> </a>
                        </div>
                    </div>
                </div>
            </header>
            <aside class="app-sidebar sticky" id="sidebar">
                <!-- Start::main-sidebar-header -->
                <div class="main-sidebar-header">
                    <a href="index.html" class="header-logo">
                    <img src="<?php echo e(siteValue('logo')); ?>" alt="logo" class="desktop-logo" /> <img src="<?php echo e(siteValue('logo')); ?>" alt="logo" class="toggle-logo" />
                    <img src="<?php echo e(siteValue('logo')); ?>" alt="logo" class="desktop-dark" /> <img src="<?php echo e(siteValue('logo')); ?>" alt="logo" class="toggle-dark" />
                    </a>
                </div>
                <div class="main-sidebar" id="sidebar-scroll">
                    <nav class="main-menu-container nav nav-pills flex-column sub-open">
                        <div class="slide-left" id="slide-left">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                            </svg>
                        </div>
                        <ul class="main-menu">
                            <li class="mt-1 slide__category"><span class="category-name">Overview</span></li>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.dashboard')); ?>" class="side-menu__item">
                                <i class="bx bx-home side-menu__icon"></i> 
                                <span class="side-menu__label">Trang thống kê</span>
                                </a>
                            </li>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.user.history')); ?>" class="side-menu__item">
                                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                        <g fill="none">
                                            <circle cx="12" cy="12" r="9" fill="currentColor" opacity="0.16"/>
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 18.364A9 9 0 1 0 3 12.004V14"/>
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 12l2 2l2-2m6-4v5h5"/>
                                        </g>
                                    </svg>
                                    <span class="side-menu__label">Dòng tiền</span>
                                </a>
                            </li>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.history.payment')); ?>" class="side-menu__item">
                                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                        <g fill="none">
                                            <circle cx="12" cy="12" r="9" fill="currentColor" opacity="0.16"/>
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 18.364A9 9 0 1 0 3 12.004V14"/>
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 12l2 2l2-2m6-4v5h5"/>
                                        </g>
                                    </svg>
                                    <span class="side-menu__label">Lịch sử nạp tiền</span>
                                </a>
                            </li>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.history.orders')); ?>" class="side-menu__item">
                                <i class="bx bx-cart side-menu__icon"></i>
                                <span class="side-menu__label">Đơn hàng</span>
                                </a>
                            </li>
                            <?php if(request()->getHost() === env('APP_MAIN_SITE')): ?>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.history.product.orders')); ?>" class="side-menu__item">
                                    <i class="bx bx-cart side-menu__icon"></i>
                                    <span class="side-menu__label">Đơn sản phẩm</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.affiliates')); ?>" class="side-menu__item">
                                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5.931 6.936l1.275 4.249m5.607 5.609l4.251 1.275m-5.381-5.752l5.759-5.759M4 5.5a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0-3 0m13 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0-3 0m0 13a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0-3 0m-13-3a4.5 4.5 0 1 0 9 0a4.5 4.5 0 1 0-9 0"/></svg>
                                <span class="side-menu__label">Tiếp thị liên kết</span>
                                </a>
                            </li>
                            <li class="mt-1 slide__category"><span class="category-name">User/ Provider</span></li>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.user')); ?>" class="side-menu__item">
                                <i class="ti ti-users fs-16 side-menu__icon"></i>
                                <span class="side-menu__label">Thành viên</span>
                                </a>
                            </li>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.website.partner')); ?>" class="side-menu__item">
                                <i class="bx bx-store-alt side-menu__icon"></i>
                                <span class="side-menu__label">Website con</span>
                                </a>
                            </li>
                            <li class="mt-1 slide__category"><span class="category-name">Setting</span></li>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.website.config')); ?>" class="side-menu__item">
                                <i class="bx bx-cog side-menu__icon"></i>
                                <span class="side-menu__label">Cài đặt</span>
                                </a>
                            </li>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.payment.config')); ?>" class="side-menu__item">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="m12.67 2.217l8.5 4.75A1.5 1.5 0 0 1 22 8.31v1.44c0 .69-.56 1.25-1.25 1.25H20v8h1a1 1 0 1 1 0 2H3a1 1 0 1 1 0-2h1v-8h-.75C2.56 11 2 10.44 2 9.75V8.31c0-.522.27-1.002.706-1.274l8.623-4.819c.422-.211.92-.211 1.342 0z" class="duoicon-secondary-layer" opacity="0.3"/><path fill="currentColor" fill-rule="evenodd" d="M12 6a1 1 0 1 0 0 2a1 1 0 0 0 0-2m5 5H7v8h2v-6h2v6h2v-6h2v6h2z" class="duoicon-primary-layer"/></svg>
                                <span class="side-menu__label">Cổng nạp</span>
                                </a>
                            </li>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.cron')); ?>" class="side-menu__item">
                                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M10.021 1.021h6v2h-6zM20.04 7.41l1.434-1.434l-1.414-1.414l-1.433 1.433A8.99 8.99 0 0 0 7.53 5.881l1.42 1.44a7.04 7.04 0 0 1 4.06-1.3l.01.001v6.98l4.953 4.958A7.001 7.001 0 0 1 6.01 13.021h3l-4-4l-4 4h3A9 9 0 1 0 20.04 7.41"/></svg>
                                    <span class="side-menu__label">Link Cron</span>
                                </a>
                            </li>
                            <li class="mt-1 slide__category"><span class="category-name">Services & Products</span></li>
                             <?php if(request()->getHost() === env('APP_MAIN_SITE')): ?>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.product.category')); ?>" class="side-menu__item">
                                    <svg class="side-menu__icon"  xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4"><path d="M44 14L24 4L4 14v20l20 10l20-10z"/><path stroke-linecap="round" d="m4 14l20 10m0 20V24m20-10L24 24M34 9L14 19"/></g></svg>
                                    <span class="side-menu__label">Tài Nguyên</span>
                                </a>
                            </li>
                           
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.service.smm')); ?>" class="side-menu__item">
                                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 48 48">
                                        <defs>
                                            <mask id="ipTConnect0">
                                                <g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4">
                                                    <path fill="#555555" fill-rule="evenodd" d="M8 12a4 4 0 1 0 0-8a4 4 0 0 0 0 8m2 30a6 6 0 1 0 0-12a6 6 0 0 0 0 12m28 2a6 6 0 1 0 0-12a6 6 0 0 0 0 12M22 28a8 8 0 1 0 0-16a8 8 0 0 0 0 16m12-16a4 4 0 1 0 0-8a4 4 0 0 0 0 8" clip-rule="evenodd"/>
                                                    <path d="m11 11l4 4m15-3l-2 2m6 19.5L28 26m-14 5l4-4"/>
                                                </g>
                                            </mask>
                                        </defs>
                                        <path fill="currentColor" d="M0 0h48v48H0z" mask="url(#ipTConnect0)"/>
                                    </svg>
                                    <span class="side-menu__label">API Provider</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if(request()->getHost() === env('APP_MAIN_SITE')): ?>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.service.platform')); ?>" class="side-menu__item">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="19.38px" height="20px" viewBox="0 0 496 512"><path fill="currentColor" d="M88 216c81.7 10.2 273.7 102.3 304 232H0c99.5-8.1 184.5-137 88-232m32-152c32.3 35.6 47.7 83.9 46.4 133.6C249.3 231.3 373.7 321.3 400 448h96C455.3 231.9 222.8 79.5 120 64"/></svg>
                                <span class="side-menu__label">Nền tảng MXH</span>
                                </a>
                            </li>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.service')); ?>" class="side-menu__item">
                                <i class="bx bx-layer side-menu__icon"></i>
                                <span class="side-menu__label">Dịch vụ</span>
                                </a>
                            </li>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.server')); ?>" class="side-menu__item">
                                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"><path fill="currentColor" d="M6 13h12c1.886 0 2.828 0 3.414.586S22 15.114 22 17s0 2.828-.586 3.414S19.886 21 18 21H6c-1.886 0-2.828 0-3.414-.586S2 18.886 2 17s0-2.828.586-3.414S4.114 13 6 13M6 3h12c1.886 0 2.828 0 3.414.586S22 5.114 22 7s0 2.828-.586 3.414S19.886 11 18 11H6c-1.886 0-2.828 0-3.414-.586S2 8.886 2 7s0-2.828.586-3.414S4.114 3 6 3" opacity="0.5"/><path fill="currentColor" d="M10.25 7a.75.75 0 0 1 .75-.75h7a.75.75 0 0 1 0 1.5h-7a.75.75 0 0 1-.75-.75m-5 0A.75.75 0 0 1 6 6.25h2a.75.75 0 0 1 0 1.5H6A.75.75 0 0 1 5.25 7m5 10a.75.75 0 0 1 .75-.75h7a.75.75 0 0 1 0 1.5h-7a.75.75 0 0 1-.75-.75m-5 0a.75.75 0 0 1 .75-.75h2a.75.75 0 0 1 0 1.5H6a.75.75 0 0 1-.75-.75"/></svg>
                                <span class="side-menu__label">Máy chủ</span>
                                </a>
                            </li>
                            <?php else: ?>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.server')); ?>" class="side-menu__item">
                                <i class="bx bx-layer side-menu__icon"></i>
                                <span class="side-menu__label">Dịch vụ</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.voucher')); ?>" class="side-menu__item">
                                <i class="bx bx-gift side-menu__icon"></i>
                                <span class="side-menu__label">Mã giảm giá</span>
                                </a>
                            </li>
                            <li class="mt-1 slide__category"><span class="category-name">Nnotification</span></li>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.notify')); ?>" class="side-menu__item">
                                <i class="bx bx-bell side-menu__icon"></i>
                                <span class="side-menu__label">Thông báo</span>
                                </a>
                            </li>
                            <li class="mt-1 slide">
                                <a href="<?php echo e(route('admin.ticket.ticket')); ?>" class="side-menu__item">
                                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M20 6H4l8 4.99zM4 8v10h16V8l-8 5z" opacity="0.3"/>
                                        <path fill="currentColor" d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 2l-8 4.99L4 6zm0 12H4V8l8 5l8-5z"/>
                                    </svg>
                                    <span class="side-menu__label">Xử lí hỗ trợ</span>
                                </a>
                            </li>
                        </ul>
                        <div class="slide-right" id="slide-right">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                            </svg>
                        </div>
                    </nav>
                </div>
            </aside>
            <div class="main-content app-content">
                <div class="container-fluid">
                    <!-- Start::page-header -->
                    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    </div>
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
            <footer class="footer mt-auto py-3 bg-white text-center">
                <div class="container">
                    <span class="text-muted">
                    Copyright © <span id="year"></span>. Designed with <span class="bi bi-heart-fill text-danger"></span> by
                    <a href="https://zalo.me/0397333616"> <span class="fw-semibold text-primary text-decoration-underline">KHOCODEVIP.COM</span> </a> All rights reserved
                    </span>
                </div>
            </footer>
        </div>
        <div class="scrollToTop">
            <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
        </div>
        <div id="responsive-overlay"></div>
        <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/js/defaultmenu.min.js"></script>
        <script src="/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/assets/js/simplebar.js"></script>
        <script src="/assets/js/custom.js"></script>
        <script src="/assets/js/custom-switcher.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.js"></script>
        <script src="/app/js/app.js?duy-time=<?php echo e(time()); ?>"></script>
        <script src="/app/js/plugins/dataTables.min.js"></script>
        <script src="/app/js/plugins/dataTables.bootstrap5.min.js"></script>
        <?php echo site('script_footer'); ?>

        <?php if(session('success')): ?>
        <script>
            Swal.fire({
                title: 'Thành công',
                text: '<?php echo e(session('success')); ?>',
                icon: 'success',
                timer: 1000,
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
                timer: 5000,
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
</html><?php /**PATH /home/dailysie/khosubvip.top/resources/views/admin/layouts/app.blade.php ENDPATH**/ ?>