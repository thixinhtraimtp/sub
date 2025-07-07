<?php if(site('landing') == 'off'): ?> 
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
    <meta name="description" content="<?php echo e(siteValue('description')); ?>">
    <meta name="keywords" content="<?php echo e(siteValue('keywords')); ?>">
    <meta name="author" content="<?php echo e(siteValue('author')); ?>">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="<?php echo e(siteValue('title')); ?>">
    <meta property="og:description" content="<?php echo e(siteValue('description')); ?>">
    <meta property="og:image" content="<?php echo e(siteValue('thumbnail')); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:site_name" content="<?php echo e(siteValue('title')); ?>">
    <meta property="og:type" content="website">
    <script type="module" crossorigin src="/main/js/theme.js"></script>
    <script type="module" crossorigin src="/main/js/navigation.js"></script>
    <script type="module" crossorigin src="/main/js/mode.js"></script>
    <script type="module" crossorigin src="/main/js/home.js"></script>
    <link rel="stylesheet" href="/main/css/main.css">
    <link href="/main/css/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link href="/main/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
      <script>
        const urlParams = new URLSearchParams(window.location.search);
        const redirectTo = urlParams.get('redirect'); 
        
        if (redirectTo) {
            window.location.href = redirectTo;
        } else {
            window.location.href = "/home"; 
        }
    </script>
</body>
</html>
<?php endif; ?>
<?php if(site('landing') == '0'): ?> 
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo e(request()->getHost()); ?> HỆ THỐNG DỊCH VỤ MẠNG XÃ HỘI, SOCIAL MEDIA MARKETING 2024 | <?php echo e(request()->getHost()); ?></title>
    <meta name="description" content="<?php echo e(siteValue('description')); ?>">
    <meta name="keywords" content="<?php echo e(siteValue('keywords')); ?>">
    <meta name="author" content="<?php echo e(siteValue('author')); ?>">
    <meta name="robots" content="index, follow">
    <link rel="icon" href="<?php echo e(siteValue('favicon')); ?>" type="image/x-icon"> 
    
    <link rel="shortcut icon" href="<?php echo e(siteValue('favicon')); ?>" type="image/x-icon">

    <link href="/landing/landing/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/landing/landing/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="/landing/landing/vendor/slick/slick.min.css" rel="stylesheet">
    <link href="/landing/landing/vendor/slick/slick-theme.min.css" rel="stylesheet">
    <link href="/landing/landing/css/style.css" rel="stylesheet">
    <link href="/landing/landing/vendor/font/stylesheet.css" rel="stylesheet">
    <link href="/landing/landing/vendor/animation/animate.min.css" rel="stylesheet">
    
</head>

<body>
    <div class="body-color2">
        <nav class="navbar navbar-expand-lg navbar-dark osahan-nav">
            <div class="container">
                <a class="navbar-brand text-dark font-weight-bold" href="<?php echo e(route('home')); ?>">
                    <img class="logo" src="<?php echo e(siteValue('logo')); ?>" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="<?php echo e(route('home')); ?>">Trang Chủ</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>">Dịch Vụ</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto login-btn">
                        <li class="nav-item pm-2">
                            <a class="nav-link" href="<?php echo e(route('register')); ?>">Đăng Ký</a>
                        </li>
                        <li class="nav-item active ml-1">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>">Đăng Nhập</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <header class="pt-5">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-md-8 mx-auto text-center header-title">
                        <div class="slideanim">
                            <h1 class="font-weight-bold mb-4"><?php echo e(Str::upper(request()->getHost())); ?> HỆ THỐNG DỊCH VỤ MẠNG XÃ HỘI, SOCIAL MEDIA
                                MARKETING 2024</h1>
                            <p class="h5 text-dark">Nền Tảng Tăng Tương Tác Uy Tín Và Tin Cậy Nhất Cho Các Dịch Vụ
                                Truyền Thông Mạng Xã Hội.</p>
                            <div class="button py-5">
                                <span class="px-2">
                                    <a href="<?php echo e(route('register')); ?>"
                                        class="btn btn-primary btn-lg text-decoration-none">Đăng Ký</a>
                                </span>
                                <span class="px-2">
                                    <a href="<?php echo e(route('login')); ?>" class="btn btn-light btn-lg">Đăng Nhập</a>
                                </span>
                            </div>
                        </div>
                        <img src="/landing/landing/img/2681613.png" class="img-fluid header-img slideanim">
                    </div>
                </div>
            </div>
        </header>
        undefined
    </div>undefined<div class="container-body mt-n5">
        <div class="container">
            <section class="py-5 border-bottom slideanim">
                <div class="row d-flex align-items-center mb-4 mt-lg-5">
                    <div class="col-1">
                        <hr class="text-muted">
                    </div>
                    <div class="col-3">
                        <p class="text-muted m-0">
                            <em>Đặc Trưng</em>
                        </p>
                    </div>
                </div>
                <div class="row d-flex align-items-center mb-5">
                    <div class="col-md-6 pr-lg-5">
                        <h1>Giải pháp của chúng tôi<br>dành cho bạn</h1>
                    </div>
                    <div class="col-md-6 pl-lg-5">
                        <p class="m-0"><?php echo e(request()->getHost()); ?> là việc sử dụng các nền tảng truyền thông xã hội như Instagram,
                            Facebook, Youtube, TikTok, Shopee và nhiều nền tảng khác để quảng bá bản thân hoặc công ty
                            của bạn.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center mb-4">
                        <i class="icofont-pie-chart features-icofont-skin rounded-pill mr-4"></i>
                        <span>
                            <h6 class="mb-0 font-weight-bold text-dark">Phân tích dữ liệu</h6>
                            <p class="mb-2">Với 10 năm hoạt động trong lĩnh vực Digital Marketing, chúng tôi đã thiết
                                lập hệ thống kinh doanh cho rất nhiều khách hàng với rất nhiều sản phẩm.</p>
                            <p class="mb-0 learn-more">
                                <a href="<?php echo e(route('login')); ?>" class="text-decoration-none">Tìm hiểu thêm<i
                                        class="icofont-rounded-right"></i>
                                </a>
                            </p>
                        </span>
                    </div>
                    <div class="col-md-6 d-flex align-items-center mb-4">
                        <i class="icofont-safety features-icofont-skin rounded-pill mr-4"></i>
                        <span href="#" class="text-decoration-none">
                            <h6 class="mb-0 font-weight-bold text-dark">Quản lý bảo mật</h6>
                            <p class="mb-2">Chúng tôi cam kết sẽ bảo mật thông tin người dùng 1 cách tốt nhất. Không
                                để thất thoát dữ liệu thông tin cá nhân.</p>
                            <p class="mb-0 learn-more">
                                <a href="<?php echo e(route('login')); ?>" class="text-decoration-none">Tìm hiểu thêm<i
                                        class="icofont-rounded-right"></i>
                                </a>
                            </p>
                        </span>
                    </div>
                </div>
                <div class="row mt-lg-3">
                    <div class="col-md-6 d-flex align-items-center mb-4">
                        <i class="icofont-bars features-icofont-blue rounded-pill mr-4"></i>
                        <span href="#" class="text-decoration-none">
                            <h6 class="mb-0 font-weight-bold text-dark">Gia tăng lợi nhuận</h6>
                            <p class="mb-2">Với tôn chỉ hoạt động của chúng tôi “Tạo ra lợi nhuận cho khách hàng” Cho
                                nên lợi nhuận của khách hàng chính là sự sống còn của chúng tôi. </p>
                            <p class="mb-0 learn-more">
                                <a href="<?php echo e(route('login')); ?>" class="text-decoration-none">Tìm hiểu thêm
                                    <i class="icofont-rounded-right"></i>
                                </a>
                            </p>
                        </span>
                    </div>
                    <div class="col-md-6 d-flex align-items-center mb-4">
                        <i class="icofont-hand-up features-icofont-blue rounded-pill mr-4"></i>
                        <span href="#" class="text-decoration-none">
                            <h6 class="mb-0 font-weight-bold text-dark">Quản lý và hỗ trợ</h6>
                            <p class="mb-2">Chúng tôi sẽ luôn cùng đồng hành với sự phát triển của bạn cho đến khi
                                bạn không còn cần chúng tôi nữa. </p>
                            <p class="mb-0 learn-more">
                                <a href="<?php echo e(route('login')); ?>" class="text-decoration-none">Tìm hiểu thêm<i
                                        class="icofont-rounded-right"></i>
                                </a>
                            </p>
                        </span>
                    </div>
                </div>
            </section>


            <div class="row collaborate py-5 d-flex align-items-center slideanim">
                <div class="col-md-6 pr-lg-5">
                    <img src="/landing/image/avzdsWC.png" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <div class="row d-flex align-items-center mb-4">
                        <div class="col-2">
                            <hr class="text-muted">
                        </div>
                        <div class="col-3">
                            <p class="text-muted m-0">
                                <em>Danh mục</em>
                            </p>
                        </div>
                    </div>
                    <h1>Nền Tảng Tăng Tương Tác Uy Tín Và Tin Cậy Nhất Cho Các Dịch Vụ Truyền Thông Mạng Xã Hội.</h1>
                    <p class="mt-3">Những Gì Bạn Cần Tăng - Chúng Tôi Có Cung Cấp
                        Phát triển mọi nền tảng mạng xã hội của bạn với dịch vụ của chúng tôi. </p>
                    <div class="row pt-4">
                        <div class="col-md-6">
                            <p>
                                <i class="icofont-check-circled text-success mr-4"></i>
                                <span class="font-weight-bold">Dịch vụ Facebook</span>
                            </p>
                            <p>
                                <i class="icofont-check-circled text-success mr-4"></i>
                                <span class="font-weight-bold">Dịch vụ TikTok</span>
                            </p>
                            <p>
                                <i class="icofont-check-circled text-success mr-4"></i>
                                <span class="font-weight-bold">Dịch vụ Youtube</span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <i class="icofont-check-circled text-success mr-4"></i>
                                <span class="font-weight-bold">Dịch vụ Instagram</span>
                            </p>
                            <p>
                                <i class="icofont-check-circled text-success mr-4"></i>
                                <span class="font-weight-bold">Dịch vụ Twitter </span>
                            </p>
                            <p>
                                <i class="icofont-check-circled text-success mr-4"></i>
                                <span class="font-weight-bold">Nhiều dịch vụ khác</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            </section>
        </div>
    </div>
    <footer class="bg-light slideanim py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a class="navbar-brand text-dark font-weight-bold" href="<?php echo e(route('landing')); ?>">
                        <img class="footer-logo" src="<?php echo e(siteValue('logo')); ?>" alt="logo">
                    </a>
                    <div class="social-icons mt-lg-5">
                        <a href="<?php echo e(route('home')); ?>#" class="text-white text-decoration-none">
                            <i class="icofont-twitter p-1 rounded-pill mr-2"></i>
                        </a>
                        <a href="<?php echo e(route('home')); ?>#" class="text-white text-decoration-none">
                            <i class="icofont-facebook p-1 rounded-pill mr-2"></i>
                        </a>
                        <a href="<?php echo e(route('home')); ?>#" class="text-white text-decoration-none">
                            <i class="icofont-linkedin p-1 rounded-pill mr-2"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-2">
                    <p class="font-weight-bold">Sản phẩm</p>
                    <ul class="list-unstyled m-0">
                        <li>
                            <a href="<?php echo e(route('home')); ?>#" class="text-decoration-none text-dark">Trang chủ</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('home')); ?>#" class="text-decoration-none text-dark">Đặc trưng</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('home')); ?>#" class="text-decoration-none text-dark">Tài liệu</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('home')); ?>#" class="text-decoration-none text-dark">Giới thiệu</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('home')); ?>#" class="text-decoration-none text-dark">Định giá
                        </li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <p class="font-weight-bold">Danh sách</p>
                    <ul class="list-unstyled m-0">
                        <li>
                            <a href="<?php echo e(route('home')); ?>#" class="text-decoration-none text-dark">Tài liệu</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('home')); ?>#" class="text-decoration-none text-dark">Thiết kế</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('home')); ?>#" class="text-decoration-none text-dark">Chủ đề</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('home')); ?>#" class="text-decoration-none text-dark">Minh họa</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('home')); ?>#" class="text-decoration-none text-dark">UI kit</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <p class="font-weight-bold">Công TY</p>
                    <ul class="list-unstyled m-0">
                        <li>
                            <a href="<?php echo e(route('home')); ?>#" class="text-decoration-none text-dark">Liên hệ</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('home')); ?>#" class="text-decoration-none text-dark">Điều kiện</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('home')); ?>#" class="text-decoration-none text-dark">Chính sách bảo
                                mật</a>
                        </li>

                    </ul>
                </div>
                <div class="col-md-2">
                    <p class="font-weight-bold">Nhiều hơn</p>
                    <ul class="list-unstyled m-0">
                        <li>
                            <a href="<?php echo e(route('home')); ?>#" class="text-decoration-none text-dark">Tài liệu</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('home')); ?>#" class="text-decoration-none text-dark">Giấy phép</a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('home')); ?>#" class="text-decoration-none text-dark">Hỗ trợ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <div class="py-4 osahan-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-dark m-0">© 20<?php echo e(date('y')); ?> <?php echo e(Str::upper(request()->getHost())); ?>. Quản lý
                        vận hành bởi : <?php echo e(siteValue('author')); ?>.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="/landing/landing/vendor/jquery/jquery.min.js"></script>
    <script src="/landing/landing/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/landing/landing/vendor/slick/slick.min.js"></script>
    <script src="/landing/landing/vendor/animations/float-panel.js"></script>
    <script src="/landing/landing/js/osahan.js"></script>
</body>

</html>

<?php endif; ?>
<?php if(site('landing') == '1'): ?> 
<!doctype html>
<html class="no-js" lang="<?php echo e(str_replace('-', '_', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo e(strtoupper(siteValue('name_site'))); ?> SMM Panel - Social Services</title>
    <meta name="description" content="<?php echo e(siteValue('description')); ?>">
    <meta name="keywords" content="<?php echo e(siteValue('keywords')); ?>">
    <meta name="author" content="<?php echo e(siteValue('author')); ?>">
    <meta name="robots" content="index, follow">

    <!-- [Open Graph] -->
    <meta property="og:title" content="<?php echo e(siteValue('title')); ?>">
    <meta property="og:description" content="<?php echo e(siteValue('description')); ?>">
    <meta property="og:image" content="<?php echo e(siteValue('thumbnail')); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:site_name" content="<?php echo e(siteValue('title')); ?>">
    <meta property="og:type" content="website">

    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="<?php echo e(siteValue('title')); ?>">
    <meta name="twitter:title" content="<?php echo e(siteValue('title')); ?>">
    <meta name="twitter:description" content="<?php echo e(siteValue('description')); ?>">
    <meta name="twitter:image" content="<?php echo e(siteValue('thumbnail')); ?>">
    <meta name="twitter:image:alt" content="<?php echo e(siteValue('title')); ?>">
    <meta name="twitter:creator" content="<?php echo e(siteValue('author')); ?>">
    <meta name="twitter:url" content="<?php echo e(url()->current()); ?>">
    <meta name="twitter:domain" content="<?php echo e(url()->current()); ?>">
    <meta name="twitter:label1" content="Written by Lâm Tilo">
    <meta name="twitter:data1" content="<?php echo e(siteValue('author')); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(siteValue('favicon')); ?>" type="image/x-icon"> <!-- [Font] Family -->
    <link rel="shortcut icon" href="<?php echo e(siteValue('favicon')); ?>" type="image/x-icon">
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="/landing-lamtilo/1/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/landing-lamtilo/1/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
 
</head>

<body id="kt_body" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" data-bs-offset="200"
    class="bg-white position-relative">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Header Section-->
        <div class="mb-0" id="home">
            <!--begin::Wrapper-->
            <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg"
                style="background-image: url(https://cdn.nmhpanel.com/1/media/svg/illustrations/landing.svg)">
                <!--begin::Header-->
                <div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header"
                    data-kt-sticky-offset="{default: '200px', lg: '300px'}">
                    <!--begin::Container-->
                    <div class="container">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-center justify-content-between">
                            <!--begin::Logo-->
                            <div class="d-flex align-items-center flex-equal">
                                <!--begin::Mobile menu toggle-->
                                <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none"
                                    id="kt_landing_menu_toggle">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                                    <span class="svg-icon svg-icon-2hx">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                                fill="black" />
                                            <path opacity="0.3"
                                                d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--end::Mobile menu toggle-->
                                <!--begin::Logo image-->
                                <a href="/">
                                    <img alt="Logo" src="<?php echo e(siteValue('logo')); ?>" class="logo-default h-25px h-lg-25px" />
                                    <img alt="Logo" src="<?php echo e(siteValue('logo')); ?>" class="logo-sticky h-20px h-lg-25px" />
                                </a>
                                <!--end::Logo image-->
                            </div>
                            <!--end::Logo-->
                            <!--begin::Menu wrapper-->
                            <div class="d-lg-block" id="kt_header_nav_wrapper">
                                <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true"
                                    data-kt-drawer-name="landing-menu"
                                    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                                    data-kt-drawer-width="200px" data-kt-drawer-direction="start"
                                    data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true"
                                    data-kt-swapper-mode="prepend"
                                    data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
                                    <!--begin::Menu-->
                                    <div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-500 menu-state-title-primary nav nav-flush fs-5 fw-bold"
                                        id="kt_landing_menu">
                                        <!--begin::Menu item-->
                                        <div class="menu-item">
                                            <!--begin::Menu link-->
                                            <a class="menu-link nav-link active py-3 px-4 px-xxl-6" href="#kt_body"
                                                data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Home</a>
                                            <!--end::Menu link-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item">
                                            <!--begin::Menu link-->
                                            <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#how-it-works"
                                                data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">How it
                                                Works</a>
                                            <!--end::Menu link-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item">
                                            <!--begin::Menu link-->
                                            <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#achievements"
                                                data-kt-scroll-toggle="true"
                                                data-kt-drawer-dismiss="true">Achievements</a>
                                            <!--end::Menu link-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item">
                                            <!--begin::Menu link-->
                                            <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#pricing"
                                                data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Pricing</a>
                                            <!--end::Menu link-->
                                        </div>
                                        <!--end::Menu item-->
                                        <div class="menu-item">
                                            <!--begin::Menu link-->
                                            <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="/auth/login"
                                                data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Services</a>
                                            <!--end::Menu link-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--end::Menu item-->
                                        <div class="menu-item">
                                            <!--begin::Menu link-->
                                            <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="/">Blog</a>
                                            <!--end::Menu link-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item">
                                            <!--begin::Menu link-->
                                            <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="<?php echo e(route('home')); ?>"
                                                data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Sign up</a>
                                            <!--end::Menu link-->
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                            </div>
                            <div class="flex-equal text-end">
                                <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">Sign in</a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary w-350px px-2"
                                    data-kt-menu="true">
                                    <div class="menu-item pt-5">
                                        <div class="menu-content">
                                            <div class="form-floating">
                                                <input type="text" class="form-control form-control-solid username"
                                                    placeholder="Username">
                                                <label for="floatingInput">Username</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <div class="menu-content">
                                            <div class="form-floating">
                                                <input type="password" class="form-control form-control-solid password"
                                                    placeholder="Password"
                                                    onkeypress="if (event.key == 'Enter') {event.preventDefault(); app.on.click.signin(document.querySelector('.username').value, document.querySelector('.password').value, grecaptcha.getResponse());}">
                                                <label for="floatingInput">Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <div class="menu-content">
                                            <div class="d-flex justify-content-center">
                                                <div class="g-recaptcha"
                                                    data-sitekey="6LcW2R4TAAAAAF-SyPprSCd8s7F4stsuo4SOoV2M">
                                                    <div style="width: 304px; height: 78px;">
                                                        <div><iframe title="reCAPTCHA" width="304" height="78"
                                                                role="presentation" name="a-c4zp0t2jwwg1"
                                                                frameborder="0" scrolling="no"
                                                                sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox allow-storage-access-by-user-activation"
                                                                src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LcW2R4TAAAAAF-SyPprSCd8s7F4stsuo4SOoV2M&amp;co=ZmlsZTo.&amp;hl=en&amp;v=Xv-KF0LlBu_a0FJ9I5YSlX5m&amp;size=normal&amp;cb=x6bij0ld7byz"></iframe>
                                                        </div><textarea id="g-recaptcha-response"
                                                            name="g-recaptcha-response" class="g-recaptcha-response"
                                                            style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>
                                                    </div><iframe style="display: none;"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <div class="menu-content">
                                            <button type="button" class="btn btn-lg btn-primary w-100"
                                                onclick="app.on.click.signin(document.querySelector('.username').value, document.querySelector('.password').value, grecaptcha.getResponse())">Sign
                                                In</button>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <div class="menu-content text-center">
                                            <div class="text-gray-400">New Here ?
                                                <a href="<?php echo e(route('home')); ?>" class="link-primary fw-bolder">Create an
                                                    Account</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menu-item">
                                        <div class="menu-content text-center">
                                            <div class="text-gray-400">Forgot Password ?
                                                <a href="password-reset.html" class="link-primary fw-bolder">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                <!--begin::Landing hero-->
                <div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
                    <!--begin::Heading-->
                    <div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
                        <!--begin::Title-->
                        <h1 class="text-white lh-base fw-bolder fs-2x fs-lg-3x mb-15">Hệ thống Dịch Vụ MXH rẻ nhất!
                            <br />
                            <span
                                style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
                                <span id="kt_landing_hero_text"><?php echo e(strtoupper(siteValue('name_site'))); ?> SMM Panel -
                                    Social Services</span>
                            </span>
                        </h1>
                        <!--end::Title-->
                        <!--begin::Action-->
                        <a href="/auth/register" class="btn btn-primary py-5 fs-3">Sign up now!</a>
                        <!--end::Action-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Clients-->
                    <div class="d-flex flex-center flex-wrap position-relative px-5">
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip">
                            <img src="https://cdn.nmhpanel.com/1/media/svg/brand-logos/youtube.svg"
                                class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip">
                            <img src="https://cdn.nmhpanel.com/1/media/svg/brand-logos/google-icon.svg"
                                class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip">
                            <img src="https://cdn.nmhpanel.com/1/media/svg/brand-logos/facebook-1.svg"
                                class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip">
                            <img src="https://cdn.nmhpanel.com/1/media/svg/brand-logos/instagram-2-1.svg"
                                class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip">
                            <img src="https://cdn.nmhpanel.com/1/media/svg/brand-logos/twitter.svg"
                                class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip">
                            <img src="https://cdn.nmhpanel.com/1/media/svg/brand-logos/telegram-2.svg"
                                class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip">
                            <img src="https://cdn.nmhpanel.com/1/media/svg/brand-logos/pinterest.svg"
                                class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--end::Client-->
                    </div>
                    <!--end::Clients-->
                </div>
                <!--end::Landing hero-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Header Section-->
        <!--begin::How It Works Section-->
        <div class="mt-20">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Heading-->
                <div class="text-center mb-17">
                    <!--begin::Title-->
                    <h3 class="fs-2hx text-dark mb-5" id="how-it-works" data-kt-scroll-offset="{default: 100, lg: 150}">
                        How it Works</h3>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="fs-5 text-muted fw-bold">Save thousands to millions of bucks by using my services
                        <br />for different amazing and great useful admin
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Heading-->
                <!--begin::Row-->
                <div class="row w-100 gy-10 mb-md-20">
                    <!--begin::Col-->
                    <div class="col-md-4 px-5">
                        <!--begin::Story-->
                        <div class="text-center mb-10 mb-md-0">
                            <!--begin::Illustration-->
                            <img src="/landing-lamtilo/1/media/illustrations/sketchy-1/2.png" class="mh-125px mb-9"
                                alt="" />
                            <!--end::Illustration-->
                            <!--begin::Heading-->
                            <div class="d-flex flex-center mb-5">
                                <!--begin::Badge-->
                                <span class="badge badge-circle badge-light-success fw-bolder p-5 me-3 fs-3">1</span>
                                <!--end::Badge-->
                                <!--begin::Title-->
                                <div class="fs-5 fs-lg-3 fw-bolder text-dark">Sign Up</div>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Description-->
                            <div class="fw-bold fs-6 fs-lg-4 text-muted">First you need have account for login then you
                                can see dashboard. Your info is safe, we not share it to others.</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Story-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-4 px-5">
                        <!--begin::Story-->
                        <div class="text-center mb-10 mb-md-0">
                            <!--begin::Illustration-->
                            <img src="/landing-lamtilo/1/media/illustrations/sketchy-1/8.png" class="mh-125px mb-9"
                                alt="" />
                            <!--end::Illustration-->
                            <!--begin::Heading-->
                            <div class="d-flex flex-center mb-5">
                                <!--begin::Badge-->
                                <span class="badge badge-circle badge-light-success fw-bolder p-5 me-3 fs-3">2</span>
                                <!--end::Badge-->
                                <!--begin::Title-->
                                <div class="fs-5 fs-lg-3 fw-bolder text-dark">Add funds</div>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Description-->
                            <div class="fw-bold fs-6 fs-lg-4 text-muted">You need deposit fund to your account in
                                deposit iseasy and secure. We have many payment methods for you.</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Story-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-4 px-5">
                        <!--begin::Story-->
                        <div class="text-center mb-10 mb-md-0">
                            <!--begin::Illustration-->
                            <img src="/landing-lamtilo/1/media/illustrations/sketchy-1/12.png" class="mh-125px mb-9"
                                alt="" />
                            <!--end::Illustration-->
                            <!--begin::Heading-->
                            <div class="d-flex flex-center mb-5">
                                <!--begin::Badge-->
                                <span class="badge badge-circle badge-light-success fw-bolder p-5 me-3 fs-3">3</span>
                                <!--end::Badge-->
                                <!--begin::Title-->
                                <div class="fs-5 fs-lg-3 fw-bolder text-dark">Create order</div>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Description-->
                            <div class="fw-bold fs-6 fs-lg-4 text-muted">You have balance in your account, so now you
                                can place orders with services you want. That's easy</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Story-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::How It Works Section-->
        <!--begin::Statistics Section-->
        <div class="mt-20">
            <!--begin::Wrapper-->
            <div class="pb-15 pt-18 landing-dark-bg">
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Heading-->
                    <div class="text-center mt-20 mb-18" id="achievements"
                        data-kt-scroll-offset="{default: 100, lg: 150}">
                        <!--begin::Title-->
                        <h3 class="fs-2hx text-white fw-bolder mb-5">We Make Things Better</h3>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="fs-5 text-gray-700 fw-bold">Save thousands to millions of bucks by using single tool
                            <br />for different amazing and great useful admin
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Statistics-->
                    <div class="d-flex flex-center">
                        <!--begin::Items-->
                        <div class="d-flex flex-wrap flex-center justify-content-lg-between mb-15 mx-auto w-xl-900px">
                            <!--begin::Item-->
                            <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain"
                                style="background-image: url('https_/cdn.nmhpanel.com/1/media/svg/misc/octagon.html')">
                                <!--begin::Symbol-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect x="2" y="2" width="9" height="9" rx="2" fill="white" />
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="white" />
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="white" />
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="white" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--end::Symbol-->
                                <!--begin::Info-->
                                <div class="mb-0">
                                    <!--begin::Value-->
                                    <div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
                                        <div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="81960947"
                                            data-kt-countup-suffix="+">0</div>
                                    </div>
                                    <!--end::Value-->
                                    <!--begin::Label-->
                                    <div class="d-flex flex-center mt-2">
                                        <span class="text-gray-600 fw-bold fs-5 lh-0">Orders</span>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain"
                                style="background-image: url('https://cdn.nmhpanel.com/1/media/svg/misc/octagon.svg')">
                                <!--begin::Symbol-->
                                <!--begin::Svg Icon | path: icons/duotune/graphs/gra008.svg-->
                                <span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M13 10.9128V3.01281C13 2.41281 13.5 1.91281 14.1 2.01281C16.1 2.21281 17.9 3.11284 19.3 4.61284C20.7 6.01284 21.6 7.91285 21.9 9.81285C22 10.4129 21.5 10.9128 20.9 10.9128H13Z"
                                            fill="white" />
                                        <path opacity="0.3"
                                            d="M13 12.9128V20.8129C13 21.4129 13.5 21.9129 14.1 21.8129C16.1 21.6129 17.9 20.7128 19.3 19.2128C20.7 17.8128 21.6 15.9128 21.9 14.0128C22 13.4128 21.5 12.9128 20.9 12.9128H13Z"
                                            fill="white" />
                                        <path opacity="0.3"
                                            d="M11 19.8129C11 20.4129 10.5 20.9129 9.89999 20.8129C5.49999 20.2129 2 16.5128 2 11.9128C2 7.31283 5.39999 3.51281 9.89999 3.01281C10.5 2.91281 11 3.41281 11 4.01281V19.8129Z"
                                            fill="white" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--end::Symbol-->
                                <!--begin::Info-->
                                <div class="mb-0">
                                    <!--begin::Value-->
                                    <div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
                                        <div class="min-w-70px" data-kt-countup="false">$ 0.0001</div>
                                    </div>
                                    <!--end::Value-->
                                    <!--begin::Label-->
                                    <div class="d-flex flex-center mt-2">
                                        <span class="text-gray-600 fw-bold fs-5 lh-0">Price Starting From</span>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain"
                                style="background-image: url('https://cdn.nmhpanel.com/1/media/svg/misc/octagon.svg')">
                                <!--begin::Symbol-->
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                                <span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z"
                                            fill="white" />
                                        <path opacity="0.3"
                                            d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z"
                                            fill="white" />
                                        <path opacity="0.3"
                                            d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z"
                                            fill="white" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--end::Symbol-->
                                <!--begin::Info-->
                                <div class="mb-0">
                                    <!--begin::Value-->
                                    <div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
                                        <div class="min-w-70px">0.1 sec</div>
                                    </div>
                                    <!--end::Value-->
                                    <!--begin::Label-->
                                    <div class="d-flex flex-center mt-2">
                                        <span class="text-gray-600 fw-bold fs-5 lh-0">An Order Is Made Every</span>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Items-->
                    </div>
                    <!--end::Statistics-->
                    <!--begin::Plans-->
                    <div class="d-flex flex-column container pt-lg-20 mt-20">
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <h1 class="fs-2hx fw-bolder text-white mb-5" id="pricing"
                                data-kt-scroll-offset="{default: 100, lg: 150}">Cheapest SMM Panel For Resellers</h1>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Pricing-->
                        <div class="text-center" id="kt_pricing">
                            <!--begin::Row-->
                            <div class="row g-10">
                                <!--begin::Col-->
                                <div class="col-xl-4">
                                    <div class="d-flex h-100 align-items-center">
                                        <!--begin::Option-->
                                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-15 px-10">
                                            <!--begin::Heading-->
                                            <div class="mb-7 text-center">
                                                <!--begin::Title-->
                                                <h1 class="text-dark mb-5 fw-boldest">Facebook</h1>
                                                <!--end::Title-->
                                                <!--begin::Description-->
                                                <div class="text-gray-400 fw-bold mb-5">Like, share, comments, ...</div>
                                                <!--end::Description-->
                                                <!--begin::Price-->
                                                <div class="text-center">
                                                    <span class="mb-2 text-primary">from $</span>
                                                    <span class="fs-3x fw-bolder text-primary">0.01</span>
                                                </div>
                                                <!--end::Price-->
                                            </div>
                                            <!--end::Heading-->
                                        </div>
                                        <!--end::Option-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-4">
                                    <div class="d-flex h-100 align-items-center">
                                        <!--begin::Option-->
                                        <div
                                            class="w-100 d-flex flex-column flex-center rounded-3 bg-primary py-20 px-10">
                                            <!--begin::Heading-->
                                            <div class="mb-7 text-center">
                                                <!--begin::Title-->
                                                <h1 class="text-white mb-5 fw-boldest">Youtube</h1>
                                                <!--end::Title-->
                                                <!--begin::Description-->
                                                <div class="text-white opacity-75 fw-bold mb-5">Views, subscribes,
                                                    likes, ...</div>
                                                <!--end::Description-->
                                                <!--begin::Price-->
                                                <div class="text-center">
                                                    <span class="mb-2 text-white">from $</span>
                                                    <span class="fs-3x fw-bolder text-white">0.25</span>
                                                </div>
                                                <!--end::Price-->
                                            </div>
                                            <!--end::Heading-->
                                        </div>
                                        <!--end::Option-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-4">
                                    <div class="d-flex h-100 align-items-center">
                                        <!--begin::Option-->
                                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-15 px-10">
                                            <!--begin::Heading-->
                                            <div class="mb-7 text-center">
                                                <!--begin::Title-->
                                                <h1 class="text-dark mb-5 fw-boldest">Twitter</h1>
                                                <!--end::Title-->
                                                <!--begin::Description-->
                                                <div class="text-gray-400 fw-bold mb-5">Follow, share, ...</div>
                                                <!--end::Description-->
                                                <!--begin::Price-->
                                                <div class="text-center">
                                                    <span class="mb-2 text-primary">from $</span>
                                                    <span class="fs-3x fw-bolder text-primary">0.18</span>
                                                </div>
                                                <!--end::Price-->
                                            </div>
                                            <!--end::Heading-->
                                        </div>
                                        <!--end::Option-->
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Pricing-->
                    </div>
                    <!--end::Plans-->
                    <div class="d-flex flex-center mt-20">
                        <!--begin::Action-->
                        <a href="/auth/login" class="btn btn-primary py-5 fs-3">Service List</a>
                        <!--end::Action-->
                    </div>
                </div>
                <!--end::Container-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Statistics Section-->

        <!--begin::Testimonials Section-->
        <div class="mt-20 mb-n20 position-relative z-index-2">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Heading-->
                <div class="text-center mb-17">
                    <!--begin::Title-->
                    <h3 class="fs-2hx text-dark mb-5" id="clients" data-kt-scroll-offset="{default: 125, lg: 150}">What
                        Our Clients Say</h3>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="fs-5 text-muted fw-bold">Happy Clients</div>
                    <!--end::Description-->
                </div>
                <!--end::Heading-->
                <!--begin::Row-->
                <div class="row g-lg-10 mb-10 mb-lg-20">
                    <!--begin::Col-->
                    <div class="col-lg-4">
                        <!--begin::Testimonial-->
                        <div
                            class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                            <!--begin::Wrapper-->
                            <div class="mb-7">
                                <!--begin::Rating-->
                                <div class="rating mb-6">
                                    <div class="rating-label me-2 checked">
                                        <i class="fa fa-star fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="fa fa-star fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="fa fa-star fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="fa fa-star fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="fa fa-star fs-5"></i>
                                    </div>
                                </div>
                                <!--end::Rating-->
                                <!--begin::Feedback-->
                                <div class="text-gray-500 fw-bold fs-4">Exceeded expected result. Highly recommended if
                                    you like to boost view of your video on any social media. Will definitely will use
                                    smmstore again . </div>
                                <!--end::Feedback-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Author-->
                            <div class="d-flex align-items-center">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-circle symbol-50px me-5">
                                    <img src="/landing-lamtilo/1/media/avatars/300-1.jpg" class="" alt="" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Name-->
                                <div class="flex-grow-1">
                                    <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Paul Miles</a>
                                </div>
                                <!--end::Name-->
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Testimonial-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-lg-4">
                        <!--begin::Testimonial-->
                        <div
                            class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                            <!--begin::Wrapper-->
                            <div class="mb-7">
                                <!--begin::Rating-->
                                <div class="rating mb-6">
                                    <div class="rating-label me-2 checked">
                                        <i class="fa fa-star fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="fa fa-star fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="fa fa-star fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="fa fa-star fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="fa fa-star fs-5"></i>
                                    </div>
                                </div>
                                <!--end::Rating-->
                                <!--begin::Feedback-->
                                <div class="text-gray-500 fw-bold fs-4">Go with this guy if you want quality and good
                                    communication. His overall service is amazing and I will continue to use his
                                    services. </div>
                                <!--end::Feedback-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Author-->
                            <div class="d-flex align-items-center">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-circle symbol-50px me-5">
                                    <img src="/landing-lamtilo/1/media/avatars/300-2.jpg" class="" alt="" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Name-->
                                <div class="flex-grow-1">
                                    <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Janya Clebert</a>
                                    <span class="text-muted d-block fw-bold">Development Lead</span>
                                </div>
                                <!--end::Name-->
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Testimonial-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-lg-4">
                        <!--begin::Testimonial-->
                        <div
                            class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                            <!--begin::Wrapper-->
                            <div class="mb-7">
                                <!--begin::Rating-->
                                <div class="rating mb-6">
                                    <div class="rating-label me-2 checked">
                                        <i class="fa fa-star fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="fa fa-star fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="fa fa-star fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="fa fa-star fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="fa fa-star fs-5"></i>
                                    </div>
                                </div>
                                <!--end::Rating-->
                                <!--begin::Feedback-->
                                <div class="text-gray-500 fw-bold fs-4">This panel did such a extremely good job.
                                    Excellent I would advise anyone to go to him! He will get the job done! </div>
                                <!--end::Feedback-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Author-->
                            <div class="d-flex align-items-center">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-circle symbol-50px me-5">
                                    <img src="/landing-lamtilo/1/media/avatars/300-16.jpg" class="" alt="" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Name-->
                                <div class="flex-grow-1">
                                    <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Steave Brown</a>
                                </div>
                                <!--end::Name-->
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Testimonial-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Highlight-->
                <div class="d-flex flex-stack flex-wrap flex-md-nowrap card-rounded shadow p-8 p-lg-12 mb-n5 mb-lg-n13"
                    style="background: linear-gradient(90deg, #20AA3E 0%, #03A588 100%);">
                    <!--begin::Content-->
                    <div class="my-2 me-5">
                        <!--begin::Title-->
                        <div class="fs-1 fs-lg-2qx fw-bolder text-white mb-2">Start creating orders now!
                        </div>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="fs-6 fs-lg-5 text-white fw-bold opacity-75">Creating orders with over 1,000 services
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Link-->
                    <a href="/auth/register"
                        class="btn btn-lg btn-outline border-2 btn-outline-white flex-shrink-0 my-2">Sign up</a>
                    <!--end::Link-->
                </div>
                <!--end::Highlight-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Testimonials Section-->
        <!--begin::Footer Section-->
        <div class="mb-0">
            <!--begin::Curve top-->
            <div class="landing-curve landing-dark-color">
                <svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z"
                        fill="currentColor"></path>
                </svg>
            </div>
            <!--end::Curve top-->
            <!--begin::Wrapper-->
            <div class="landing-dark-bg pt-20">
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Row-->
                    <div class="row py-10 py-lg-20">
                        <!--begin::Col-->
                        <div class="col-lg-6 pe-lg-16 mb-10 mb-lg-0">
                            <!--begin::Block-->
                            <div class="rounded landing-dark-border p-9 mb-10">
                                <!--begin::Title-->
                                <h2 class="text-white">Would you need more infomation?</h2>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <span class="fw-normal fs-4 text-gray-700">Email us to
                                    <a href="#"
                                        class="text-white opacity-50 text-hover-primary"><?php echo e(strtoupper(siteValue('name_site'))); ?></a></span>
                                <!--end::Text-->
                            </div>
                            <!--end::Block-->
                            <!--begin::Block-->
                            <div class="rounded landing-dark-border p-9">
                                <!--begin::Title-->
                                <h2 class="text-white">Do you need reseller price?</h2>
                                <!--end::Title-->
                                <!--begin::Text-->
                                <span class="fw-normal fs-4 text-gray-700">Email us to
                                    <a href="#"
                                        class="text-white opacity-50 text-hover-primary"><?php echo e(strtoupper(siteValue('name_site'))); ?></a></span>
                                <!--end::Text-->
                            </div>
                            <!--end::Block-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-lg-6 ps-lg-16">
                            <!--begin::Navs-->
                            <div class="d-flex justify-content-center">
                                <!--begin::Links-->
                                <div class="d-flex fw-bold flex-column me-20">
                                    <!--begin::Subtitle-->
                                    <h4 class="fw-bolder text-gray-400 mb-6">More</h4>
                                    <!--end::Subtitle-->
                                    <!--begin::Link-->
                                    <a href="faqs.html"
                                        class="text-white opacity-50 text-hover-primary fs-5 mb-6">FAQ</a>
                                    <!--end::Link-->
                                    <!--begin::Link-->
                                    <a href="terms.html"
                                        class="text-white opacity-50 text-hover-primary fs-5 mb-6">Terms</a>
                                    <!--end::Link-->
                                    <!--begin::Link-->
                                    <a href="/auth/login"
                                        class="text-white opacity-50 text-hover-primary fs-5 mb-6">Services</a>
                                    <!--end::Link-->
                                    <!--begin::Link-->
                                    <a href="apidoc.html"
                                        class="text-white opacity-50 text-hover-primary fs-5 mb-6">API</a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Links-->
                                <!--begin::Links-->
                                <div class="d-flex fw-bold flex-column ms-lg-20">
                                    <!--begin::Subtitle-->
                                    <h4 class="fw-bolder text-gray-400 mb-6">Contact Us</h4>
                                    <!--end::Subtitle-->
                                    <!--begin::Link-->
                                    <a href="#" class="mb-6">
                                        <i class="fa fa-telegram me-2"></i>
                                        <span class="text-white opacity-50 text-hover-primary fs-5 mb-6"><?php echo e(site('telegram')); ?></span>
                                    </a>
                                    <!--end::Link-->
                                    <!--begin::Link-->
                                    <a href="#" class="mb-6">
                                        <i class="fa fa-phone me-2"></i>
                                        <span
                                            class="text-white opacity-50 text-hover-primary fs-5 mb-6"><?php echo e(site('zalo')); ?></span>
                                    </a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Links-->
                            </div>
                            <!--end::Navs-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
                <!--begin::Separator-->
                <div class="landing-dark-separator"></div>
                <!--end::Separator-->
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
                        <!--begin::Copyright-->
                        <div class="d-flex align-items-center order-2 order-md-1">
                            <!--begin::Logo-->
                            <a href="/">
                                <img alt="Logo" src="<?php echo e(siteValue('logo')); ?>" class="h-15px h-md-20px" />
                            </a>
                            <!--end::Logo image-->
                            <!--begin::Logo image-->
                            <span class="mx-5 fs-6 fw-bold text-gray-600 pt-1" href="/">© 2022
                                <?php echo e(strtoupper(siteValue('name_site'))); ?> SMM Panel - Social Services</span>
                            <!--end::Logo image-->
                        </div>
                        <!--end::Copyright-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Footer Section-->
        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
            <span class="svg-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                        fill="black" />
                    <path
                        d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                        fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Scrolltop-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LE10V4J842"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-LE10V4J842');
    </script>
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="/landing-lamtilo/1/plugins/global/plugins.bundle.js"></script>
    <script src="/landing-lamtilo/1/js/scripts.bundle.js"></script>
    <script src="https://kit.fontawesome.com/706d20f321.js" crossorigin="anonymous"></script>
    <!--end::Global Javascript Bundle-->

    <!--end::Javascript-->
</body>


</html>

<?php endif; ?>
<?php if(site('landing') == '2'): ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo e(site('name_site')); ?> | Hệ thống dịch vụ Mạng Xã Hội </title>

    <!-- [Open Graph] -->
    <meta property="og:title" content="<?php echo e(siteValue('title')); ?>">
    <meta property="og:description" content="<?php echo e(siteValue('description')); ?>">
    <meta property="og:image" content="<?php echo e(siteValue('thumbnail')); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:site_name" content="<?php echo e(siteValue('title')); ?>">
    <meta property="og:type" content="website">

    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="<?php echo e(siteValue('title')); ?>">
    <meta name="twitter:title" content="<?php echo e(siteValue('title')); ?>">
    <meta name="twitter:description" content="<?php echo e(siteValue('description')); ?>">
    <meta name="twitter:image" content="<?php echo e(siteValue('thumbnail')); ?>">
    <meta name="twitter:image:alt" content="<?php echo e(siteValue('title')); ?>">
    <meta name="twitter:creator" content="<?php echo e(siteValue('author')); ?>">
    <meta name="twitter:url" content="<?php echo e(url()->current()); ?>">
    <meta name="twitter:domain" content="<?php echo e(url()->current()); ?>">
    <meta name="twitter:data1" content="<?php echo e(siteValue('author')); ?>">

    <link rel="icon" href="<?php echo e(siteValue('favicon')); ?>" type="image/x-icon"> <!-- [Font] Family -->
    <link rel="shortcut icon" href="<?php echo e(siteValue('favicon')); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="/assets/media/favicon.ico?1663731514" />
    <!-- Header -->

    <link
      href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&amp;family=Montserrat:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.nmhpanel.com/landing/2/css/keyframes.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.nmhpanel.com/landing/2/css/ozh3iq8x6n32uim1.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.nmhpanel.com/landing/2/css/txuni0yqlmxhc6qc.css"
    />
    <script src="https://www.google.com/recaptcha/api.js"></script>
    
  </head>

  <body class="guest">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button
            type="button"
            class="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#navbar"
            aria-expanded="false"
            aria-controls="navbar"
          >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/"
            ><img src="<?php echo e(site('logo')); ?>" alt="" title=""
          /></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active">
              <a href="<?php echo e(route('home')); ?>"
                ><i class="navbar-icon fas fa-sign-in-alt"></i> Sign in</a
              >
            </li>
            <li>
              <a href="<?php echo e(route('home')); ?>"
                ><i class="navbar-icon fas fa-address-card"></i> Sign up</a
              >
            </li>
            <li>
              <a href=""
                ><i class="navbar-icon fas fa-window-restore"></i> Terms</a
              >
            </li>
            <li>
              <a href=""
                ><i class="navbar-icon fas fa-question-circle"></i> FAQs</a
              >
            </li>
            <li>
              <a href="<?php echo e(route('home')); ?>"
                ><i class="navbar-icon fas fa-server"></i> Services</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Main variables *content* -->
    <section id="top-sec">
      <div class="container">
        <div class="row">
          <div class="col-sm-7">
            <h1
              class="main-title"
              data-aos="fade-right"
              data-aos-duration="1500"
            >
              <span class="dela-font"><?php echo e(site('name_site')); ?> - #1</span> Cheapest SMM Panel
              For Resellers Over 8 Years!
            </h1>
            <p class="txt" data-aos="fade-right" data-aos-duration="1500">
              Get hundreds of High Quality Social Media Services from cheap smm
              panel in a distance of a click. <?php echo e(site('name_site')); ?> is a SMM Panel with
              more then 5 year on the market and more then 40 million orders
              processed successfully!
            </p>
            <a
              class="btn btn-primary"
              href="<?php echo e(route('home')); ?>"
              data-aos="fade-right"
              data-aos-duration="1500"
              >Sign up</a
            >
          </div>
          <div class="col-sm-5">
            <div
              class="top-sec-img-wrap"
              data-aos="fade-left"
              data-aos-duration="1500"
            >
              <div class="animation relative">
                <img
                  class="abs mob-girl"
                  alt="Privatesmm"
                  src="https://i.imgur.com/NdTuXLN.png"
                />
                <span class="abs top-icon icon1"></span>
                <span class="abs top-icon icon2"></span>
                <span class="abs top-icon icon3"></span>
                <span class="abs top-icon icon4"></span>
                <span class="abs top-icon icon5"></span>
                <span class="abs top-icon icon6"></span>
                <span class="abs top-icon icon7"></span>
                <span class="abs top-icon icon8"></span>
                <span class="abs top-icon icon9"></span>
                <span class="abs top-icon icon10"></span>
                <span class="abs top-icon icon11"></span>
                <span class="abs top-icon icon12"></span>
                <span class="abs top-icon icon13"></span>
                <img
                  class="abs shadow-red"
                  src="https://i.imgur.com/v7TxDp5.png"
                  alt="<?php echo e(site('name_site')); ?>"
                />
                <img
                  class="abs shadow-green"
                  src="https://i.imgur.com/lR5jtOd.png"
                  alt="<?php echo e(site('name_site')); ?>"
                />
              </div>
            </div>
          </div>
        </div>
        <div
          class="row frm-row"
          data-aos="zoom-in-up"
          data-aos-duration="1500"
          style="display: none;"
        >
          <div class="col-sm-12">
            <form method="post" action="/">
              <div class="row">
                <div class="col-sm-5">
                  <div class="form-group">
                    <span class="inpt-icon"><i class="fas fa-user"></i></span>
                    <input
                      type="text"
                      class="form-control username"
                      placeholder="Username"
                    />
                  </div>
                  <p class="have-acc">
                    Do not have an account? <a href="/signup">Sign up</a>
                  </p>
                </div>
                <div class="col-sm-5">
                  <div class="form-group">
                    <span class="inpt-icon"><i class="fas fa-key"></i></span>
                    <input
                      type="password"
                      class="form-control password"
                      placeholder="Password"
                      onkeypress="if (event.key == 'Enter') {event.preventDefault(); app.on.click.signin(document.querySelector('.username').value, document.querySelector('.password').value, 0);}"
                    />
                  </div>
                  <a href="/password-reset" class="forgot-pasword"
                    >Forgot password?</a
                  >
                </div>
                <div class="col-sm-2">
                  <button
                    type="button"
                    class="btn btn-primary"
                    onclick="app.on.click.signin(document.querySelector('.username').value, document.querySelector('.password').value, 0)"
                  >
                    Sign in
                  </button>
                </div>
              </div>
              
            </form>
          </div>
        </div>
      </div>
    </section>
    <section id="feature">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h2
              class="title"
              title="FEATURES"
              data-aos="fade-right"
              data-aos-duration="1500"
            >
              Intimate Your Business With The SocialLife
            </h2>
          </div>
        </div>
        <div class="row feature-row">
          <div class="col-sm-4">
            <div
              class="feature-box feature-box1"
              data-aos="fade-up"
              data-aos-duration="1500"
            >
              <img
                class="feature-img img-responsve"
                src="https://i.imgur.com/CMRpJ45.png"
                alt="<?php echo e(site('name_site')); ?>"
              />
              <h3 class="feature-title">FREE Child Panel</h3>
              <p class="feature-txt">
                <?php echo e(site('name_site')); ?> offer Free Child Panel like us ( different design )
                to Elite, VIP or Master Members for life time
              </p>
            </div>
          </div>
          <div class="col-sm-4">
            <div
              class="feature-box feature-box2"
              data-aos="fade-up"
              data-aos-duration="1500"
            >
              <img
                class="feature-img img-responsve"
                src="https://i.imgur.com/7AAoyue.png"
                alt="<?php echo e(site('name_site')); ?>"
              />
              <h3 class="feature-title">Cheapest Price</h3>
              <p class="feature-txt">
                <?php echo e(site('name_site')); ?> offer cheapest price services in whole market.
                <?php echo e(site('name_site')); ?> can beat any smm reseller panel in market.
              </p>
            </div>
          </div>
          <div class="col-sm-4">
            <div
              class="feature-box feature-box1"
              data-aos="fade-up"
              data-aos-duration="1500"
            >
              <img
                class="feature-img img-responsve"
                src="https://i.imgur.com/elAHA69.png"
                alt="<?php echo e(site('name_site')); ?>"
              />
              <h3 class="feature-title">User Friendly Dashboard</h3>
              <p class="feature-txt">
                <?php echo e(site('name_site')); ?> offer Free Child Panel like us ( different design )
                to Elite, VIP or Master Members for life time
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="best">
      <div class="container">
        <div
          class="row best-row"
          data-aos="zoom-in-up"
          data-aos-duration="1500"
        >
          <div class="col-sm-5">
            <div class="text-center">
              <img
                class="img-responsve"
                src="https://cdn.nmhpanel.com/landing/2/imgs/social.png"
                alt="<?php echo e(site('name_site')); ?>"
                width="300"
              />
            </div>
          </div>
          <div class="col-sm-8">
            <h2 class="title">Best Social Media Service</h2>
            <p class="txt">
              Tired of looking at hundreds of cheap smm panel with services that
              simple doesnt work? Check our cheapest smm panel major services
              for social media with the best quality and quicker delivery on the
              market!
            </p>
            <p class="txt">
              Finding the best smm panel or smm panel that fits your agency
              needs can be a tedious job! Check why you should trust <?php echo e(site('name_site')); ?>

              to delivery your social media services with a quick comparision.
            </p>
            <p class="txt">
              We take our costumers social media accounts as its our own
              accounts, at <?php echo e(site('name_site')); ?> all purchase are made safe using Sucure
              Payment gateway and the delivery is 100% guaranteed.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section id="stats">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <ul class="stats-ul" data-aos="zoom-in-up" data-aos-duration="1500">
              <li>
                <div class="stats-wrap">
                  <p class="stats-txt">Order Completed</p>
                  <h3 class="stats-title">40000000+</h3>
                  <img
                    class="img-responsive"
                    src="https://cdn.nmhpanel.com/landing/2/imgs/order.png"
                    alt="<?php echo e(site('name_site')); ?>"
                  />
                </div>
              </li>
              <li>
                <div class="stats-wrap">
                  <p class="stats-txt">Prices Starting From</p>
                  <h3 class="stats-title">0.001$/1k</h3>
                  <img
                    class="img-responsive"
                    src="https://cdn.nmhpanel.com/landing/2/imgs/brief-case.png"
                    alt="<?php echo e(site('name_site')); ?>"
                  />
                </div>
              </li>
              <li>
                <div class="stats-wrap">
                  <p class="stats-txt">An order is made every</p>
                  <h3 class="stats-title">0.14Sec</h3>
                  <img
                    class="img-responsive"
                    src="https://cdn.nmhpanel.com/landing/2/imgs/Layer-1.png"
                    alt="<?php echo e(site('name_site')); ?>"
                  />
                </div>
              </li>
            </ul>
            <ul
              class="stats-ul stats-ul-light"
              data-aos="zoom-in-up"
              data-aos-duration="1500"
            >
              <li>
                <div class="stats-wrap"></div>
              </li>
              <li>
                <div class="stats-wrap"></div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section id="testimonial">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h2 class="title" title="Testimonials">Happy Clients</h2>
          </div>
        </div>
        <div class="row testi-row">
          <div class="col-sm-3">
            <div
              class="testi-wrap"
              data-aos="fade-right"
              data-aos-duration="1500"
            >
              <div class="testi-head">
                <h4 class="test-title">Michelle Hawkins</h4>
              </div>
              <div class="testi-body">
                <div class="testi-stars">
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                </div>
                <p class="testi-txt">
                  Wow! This is amazing.<br />
                  I have been purchasing Instagram Likes for over a year and
                  never got a delay! <?php echo e(site('name_site')); ?> did a great job always.
                  Recommended for people looking for cheap smm panel
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div
              class="testi-wrap"
              data-aos="fade-right"
              data-aos-duration="1500"
            >
              <div class="testi-head">
                <h4 class="test-title">Peter Brown</h4>
              </div>
              <div class="testi-body">
                <div class="testi-stars">
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                </div>
                <p class="testi-txt">
                  I was looking for indian smm panel and found <?php echo e(site('name_site')); ?>.
                  Purchased 2000 Facebook Likes for our company and worked
                  indeed! Support is also in time always. Thanks
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div
              class="testi-wrap"
              data-aos="fade-left"
              data-aos-duration="1500"
            >
              <div class="testi-head">
                <h4 class="test-title">Carl Joe</h4>
              </div>
              <div class="testi-body">
                <div class="testi-stars">
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                </div>
                <p class="testi-txt">
                  Order 10000 Instagram Followers and Got my followers as
                  promised in time! Happy to Purchased from <?php echo e(site('name_site')); ?>. We will
                  Continue with <?php echo e(site('name_site')); ?> as smm panel india for our future
                  purchase.
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div
              class="testi-wrap"
              data-aos="fade-left"
              data-aos-duration="1500"
            >
              <div class="testi-head">
                <h4 class="test-title">Julia doe</h4>
              </div>
              <div class="testi-body">
                <div class="testi-stars">
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                  <i class="fas fa-star" aria-hidden="true"></i>
                </div>
                <p class="testi-txt">
                  I Just love the services, instant delivered my instagram likes
                  order and the Facebook Page likes<br />
                  I am buying from them long time and love to buy more in
                  future.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <ul class="footer-nav">
              <li><a href="/terms">Terms &amp; Condition</a></li>
              <li><a href="/privacypolicy">Privacy Policy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <p class="copyright text-center">
              Copyright 2022 All right Reserved
            </p>
          </div>
        </div>
      </div>
    </footer>
    
    <script
      type="text/javascript"
      src="https://cdn.nmhpanel.com/landing/2/js/jquery.min.js"
    ></script>
    <script
      src="https://kit.fontawesome.com/706d20f321.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>
<?php endif; ?>
<?php if(site('landing') == '3'): ?> 

<!DOCTYPE html>
<html lang="en">
  <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo e(site('name_site')); ?> | Hệ thống dịch vụ Mạng Xã Hội </title>

    <!-- [Open Graph] -->
    <meta property="og:title" content="<?php echo e(siteValue('title')); ?>">
    <meta property="og:description" content="<?php echo e(siteValue('description')); ?>">
    <meta property="og:image" content="<?php echo e(siteValue('thumbnail')); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:site_name" content="<?php echo e(siteValue('title')); ?>">
    <meta property="og:type" content="website">

    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="<?php echo e(siteValue('title')); ?>">
    <meta name="twitter:title" content="<?php echo e(siteValue('title')); ?>">
    <meta name="twitter:description" content="<?php echo e(siteValue('description')); ?>">
    <meta name="twitter:image" content="<?php echo e(siteValue('thumbnail')); ?>">
    <meta name="twitter:image:alt" content="<?php echo e(siteValue('title')); ?>">
    <meta name="twitter:creator" content="<?php echo e(siteValue('author')); ?>">
    <meta name="twitter:url" content="<?php echo e(url()->current()); ?>">
    <meta name="twitter:domain" content="<?php echo e(url()->current()); ?>">
    <meta name="twitter:data1" content="<?php echo e(siteValue('author')); ?>">

    <link rel="icon" href="<?php echo e(siteValue('favicon')); ?>" type="image/x-icon"> <!-- [Font] Family -->
    <link rel="shortcut icon" href="<?php echo e(siteValue('favicon')); ?>" type="image/x-icon">

    <link rel="shortcut icon" href="/assets/media/favicon.ico?1663731514" />
    <!-- Header -->

    <link
      rel="stylesheet"
      href="https://cdn.nmhpanel.com/landing/3/css/keyframes_xs6iyi.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.nmhpanel.com/landing/3/css/2lug4h6ujh6g3ur2.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.nmhpanel.com/landing/3/css/nsjd1423e78k5h77.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.nmhpanel.com/landing/3/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.nmhpanel.com/landing/3/css/style.css"
    />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"
    />
    <script src="https://www.google.com/recaptcha/api.js"></script>
    
  </head>
  <body class="noAuth">
    <nav
      class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top"
      id="navbar"
    >
      <div class="container">
        <a class="navbar-brand" href="/">
          <img
            class="d-none d-sm-block"
            src="<?php echo e(siteValue('logo')); ?>"
            alt="smm panel"
            style="max-height: 40px"
          />
          <img
            class="d-lg-none"
            src="<?php echo e(siteValue('logo')); ?>"
            alt="smm panel"
            style="max-height: 30px"
          />
        </a>
        <button class="navbar-toggler" type="button" onclick="navToggleMob()">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?php echo e(route('home')); ?>"
                >Sign in</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?php echo e(route('home')); ?>"
                >Services</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page">FAQs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page">Terms</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page">API</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page">Sign up</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div id="navMob">
      <button id="cls" onclick="navToggleMob()">
        <i class="fas fa-times"></i>
      </button>
      <div class="nav_content">
        <div class="menu">
          <ul class="menu_mobs">
            <li><a href="/" class="active">Home</a></li>
            <li><a href="/services">Services</a></li>
            <li><a href="/faqs">FAQs</a></li>
            <li><a href="/terms">Terms</a></li>
            <li><a href="/api">Api</a></li>
          </ul>
        </div>
        <div class="btn">
          <a href="<?php echo e(route('home')); ?>">Sign in</a>
          <a href="<?php echo e(route('home')); ?>"
            >Sign up
            <span class="btn_icon"><i class="fas fa-arrow-right"></i></span
          ></a>
        </div>
      </div>
    </div>

    <main id="notLogin">
      <style>
        a {
          color: #000;
        }

        a:hover {
          color: #000;
        }
      </style>
      <!-- Hero Design -->
      <section id="hero">
        <div class="container">
          <div class="row d-flex align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="banner_content">
                <h1>
                  <span class="title_top"><?php echo e(site('name_site')); ?>'s - #1</span> <br />
                  Cheap SMM Panel <br />
                  For Resellers
                </h1>
                <p>296990 Orders until now!</p>
                <div class="mt-2">
                  <a href="<?php echo e(route('home')); ?>" class="btn btn-hero">Sign up now</a>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12" style="margin-top: 50px">
              <div class="banner_img">
                <div class="left_side_icons">
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/Emoji_1_qmgukx.png"
                    class="hero_icon icon1"
                    alt=""
                  />
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/Emoji_2_ncvqfp.png"
                    class="hero_icon icon2"
                    alt=""
                  />
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/Emoji_3_au0f9f.png"
                    class="hero_icon icon3"
                    alt=""
                  />
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/Emoji_4_mjifxt.png"
                    class="hero_icon icon4"
                    alt=""
                  />
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/Emoji_5_pcvnhq.png"
                    class="hero_icon icon5"
                    alt=""
                  />
                </div>
                <div class="banner_main_img">
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/hero_img_a5jofm.png"
                    class="img-fluid female_char"
                    alt=""
                  />
                </div>
                <div class="right_side_icons">
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/Emoji_6_ooql19.png"
                    class="hero_icon icon6"
                    alt=""
                  />
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/Emoji_7_iruoo8.png"
                    class="hero_icon icon7"
                    alt=""
                  />
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/Emoji_8_fkrpkp.png"
                    class="hero_icon icon8"
                    alt=""
                  />
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/Emoji_9_kvoomm.png"
                    class="hero_icon icon9"
                    alt=""
                  />
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/Emoji_10_xlfvnd.png"
                    class="hero_icon icon10"
                    alt=""
                  />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="login" style="display: none;">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="login_box">
                  <form>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="in_group">
                          <div class="icon"><i class="fas fa-user"></i></div>
                          <input
                            type="text"
                            class="form-control in_control username"
                            placeholder="Username"
                          />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="in_group">
                          <div class="icon"><i class="fas fa-lock"></i></div>
                          <input
                            type="password"
                            class="form-control in_control password"
                            placeholder="Password"
                            onkeypress="if (event.key == 'Enter') {event.preventDefault(); app.on.click.signin(document.querySelector('.username').value, document.querySelector('.password').value, 0);}"
                          />
                        </div>
                      </div>

                      <div class="col-md-4">
                        <button
                          type="button"
                          class="btn-signin btn-block"
                          onclick="app.on.click.signin(document.querySelector('.username').value, document.querySelector('.password').value, 0)"
                        >
                          Sign in
                        </button>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4"></div>
                      <div class="col-md-4">
                        <div class="forgot_password">
                          <a href="/password-reset">Forgot Password?</a>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="no_account">
                          <a href="<?php echo e(route('home')); ?>"
                            >Do not have an account? Sign up now</a
                          >
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="counter">
          <section class="stat-sec mt-5 mb-5">
            <div class="container">
              <div class="row shadedRow">
                <div class="col-sm-4">
                  <div class="stat-wrap">
                    <div class="stat-icon">
                      <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-desc">
                      <h5>0.14 SEC</h5>
                      <p>Make order easily</p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="stat-wrap">
                    <div class="stat-icon stat-icon2">
                      <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-desc">
                      <h5>296990</h5>
                      <p>Orders Completed</p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="stat-wrap">
                    <div class="stat-icon">
                      <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-desc">
                      <h5>$0.002/1K</h5>
                      <p>Price Starting</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </section>

      <section id="whySec">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <h2 class="why_title">
                Why Choose <?php echo e(site('name_site')); ?> as a Best SMM reseller panel?
              </h2>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
              <div class="why_item">
                <div class="why_item_wrap">
                  <div class="icon">
                    <img
                      src="https://cdn.nmhpanel.com/landing/3/imgs/why_icon_2_shxwec.png"
                      alt=""
                      class="img-fluid"
                    />
                  </div>
                  <div class="why_content">
                    <h4 class="why_item_title">Free Child Panel</h4>
                    <p>
                      <?php echo e(site('name_site')); ?> offer Free Child Panel like us ( different
                      design ) to Elite, VIP or Master Members for life time.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
              <div class="why_item">
                <div class="why_item_wrap">
                  <div class="icon">
                    <img
                      src="https://cdn.nmhpanel.com/landing/3/imgs/why_icon_1_v4llea.png"
                      alt=""
                      class="img-fluid"
                    />
                  </div>
                  <div class="why_content">
                    <h4 class="why_item_title">Cheapest Price</h4>
                    <p>
                      <?php echo e(site('name_site')); ?> offer cheapest price services in whole market.
                      We can beat any SMM reseller panel in market.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
              <div class="why_item">
                <div class="why_item_wrap">
                  <div class="icon">
                    <img
                      src="https://cdn.nmhpanel.com/landing/3/imgs/why_icon_3_s02ldd.png"
                      alt=""
                      class="img-fluid"
                    />
                  </div>
                  <div class="why_content">
                    <h4 class="why_item_title">24/7 Support</h4>
                    <p>
                      Our SMM panel has a 24/7 customer support team that is
                      ready to help you with your questions.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="deafultSec" class="bg_color_1 has_bg">
        <div class="container">
          <div class="row d-flex align-items-center">
            <div class="col-lg-5 col-md-5 col-sm-12 col-12">
              <div class="def_sec_content">
                <h2><a href="/services">Best Cheap SMM Panel Provider</a></h2>
                <p>
                  Social media management (SMM) is a laborious process that
                  every social media influencer or creator encounters. They
                  utilize online SMM panel networks to their advantage. These
                  professionals have past expertise managing creators' social
                  media presence across several platforms. New social media
                  platforms are being launched daily, and social media is
                  thriving. It's critical to stay current with any changes and
                  maintain your relevance among your peers.
                </p>
                <p>
                  <?php echo e(site('name_site')); ?> is the best cheap SMM Panel provider all around
                  the globe. If you want to boost your social media reach,
                  <?php echo e(site('name_site')); ?> is the best option for you, as they provide the
                  best service in cheap.
                </p>
                <div class="def_btn_wrap">
                  <a href="<?php echo e(route('home')); ?>" class="btn def_btn">Sign up Now</a>
                </div>
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-12">
              <div class="def_right_img">
                <img
                  src="https://cdn.nmhpanel.com/landing/3/imgs/user_friednly_dashboard_laptop_bru7q4.png"
                  alt=""
                  class="img-fluid insc_size"
                />
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="paymentSec">
        <div class="container">
          <div class="row">
            <div class="col-md-12 mb-5">
              <div class="sec_title mb-5">
                <h4 class="top_sm_title"><?php echo e(site('name_site')); ?> Accept</h4>
                <h2 class="title_normal">Multiple Payment Methods</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="showMob">
          <img
            src="https://cdn.nmhpanel.com/landing/3/imgs/payment_img_for_mob_e2l8gf.png"
            class="img-fluid"
            alt=""
          />
        </div>
        <div class="payment_item_2 mt-5">
          <img
            src="https://cdn.nmhpanel.com/landing/3/imgs/payment_methods_logo_line_2_yvu6mj.png"
            class="img-fluid"
            alt=""
          />
        </div>
      </section>

      <section id="deafultSec" class="bg_color_1 has_bg">
        <div class="container">
          <div class="row d-flex align-items-center">
            <div class="col-lg-5 col-md-5 col-sm-12 col-12">
              <div class="def_sec_content">
                <h2>SMM Panel in Low Price</h2>
                <p>
                  <?php echo e(site('name_site')); ?> is the greatest SMM reseller panel because it
                  recognizes the demands of the client and offers services in
                  accordance with those needs. Our primary goal is to offer smm
                  panels at affordable prices that enable our clients to expand
                  their social media presence across all social media platforms
                  and find the renown they desire. Our services are unique in
                  their kind, and we are very skilled at producing results
                  across all social media platforms, including Facebook,
                  Instagram, TikTok, and many others.
                </p>
                <p>
                  Our area of specialization is in the provision of
                  TikTok-related services. We offer TikTok hearts/likes, TikTok
                  views, and TikTok followers. These services are all quite
                  affordable and convenient. We also offer services connected to
                  other Social Media Platforms as such as Instagram followers,
                  likes, and views.
                </p>
                <div class="def_btn_wrap">
                  <a href="<?php echo e(route('home')); ?>" class="btn def_btn">Sign up Now</a>
                </div>
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-12">
              <div class="def_right_img">
                <img
                  src="https://cdn.nmhpanel.com/landing/3/imgs/zwJzgLp_1_nvedyh.png"
                  alt=""
                  class="img-fluid insc_size animations_float"
                />
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="testimonials">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="sec_title mb-5">
                <h2 class="title_normal">Our Clients Love Us</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonials" id="testimoniSlider">
          <div>
            <div class="testimonial_item">
              <div class="testimonials_wraper">
                <div class="item_icon"></div>
                <div class="testimoni_content">
                  <p class="mb-4">
                    I've had a great relationship with this team, they work
                    tirelessly to keep services working fast, and their team has
                    helped us numerously on our marketing campaigns. 10/10
                  </p>
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/star-5_nwmec3.png"
                    class="img-fluid"
                    alt=""
                  />
                  <h4>Jhon</h4>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div class="testimonial_item">
              <div class="testimonials_wraper">
                <div class="item_icon"></div>
                <div class="testimoni_content">
                  <p class="mb-4">
                    We've grown our Instagram followers by 128% over the past
                    year, as well as increased our engagement rate by 8% all
                    thanks to this gem of a service.
                  </p>
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/star-5_nwmec3.png"
                    class="img-fluid"
                    alt=""
                  />
                  <h4>maverik1999</h4>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div class="testimonial_item">
              <div class="testimonials_wraper">
                <div class="item_icon"></div>
                <div class="testimoni_content">
                  <p class="mb-4">
                    Great team, awesome tools, fast delivery, what more can I
                    ask for?
                  </p>
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/star-5_nwmec3.png"
                    class="img-fluid"
                    alt=""
                  />
                  <h4>Adam</h4>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div class="testimonial_item">
              <div class="testimonials_wraper">
                <div class="item_icon"></div>
                <div class="testimoni_content">
                  <p class="mb-4">
                    Service is very good, this is one of my favorite places to
                    buy Instagram Followers and Likes.
                  </p>
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/star-5_nwmec3.png"
                    class="img-fluid"
                    alt=""
                  />
                  <h4>Smith</h4>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div class="testimonial_item">
              <div class="testimonials_wraper">
                <div class="item_icon"></div>
                <div class="testimoni_content">
                  <p class="mb-4">
                    Our socials soared this year, giving us great exposure. Was
                    very simple to buy Instagram Views here.
                  </p>
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/star-5_nwmec3.png"
                    class="img-fluid"
                    alt=""
                  />
                  <h4>ABC456</h4>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div class="testimonial_item">
              <div class="testimonials_wraper">
                <div class="item_icon"></div>
                <div class="testimoni_content">
                  <p class="mb-4">
                    Exceeded expected result. Highly recommended if you like to
                    boost view of your video on any social media. Will
                    definitely will use <?php echo e(site('name_site')); ?> again .
                  </p>
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/star-5_nwmec3.png"
                    class="img-fluid"
                    alt=""
                  />
                  <h4>thetran11</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="deafultSec" class="bg_color_1">
        <div class="container">
          <div class="row d-flex align-items-center">
            <div class="col-lg-5 col-md-5 col-sm-12 col-12">
              <div class="def_sec_content">
                <h2>
                  Get started with <br />
                  the cheapest SMM Panel
                </h2>
                <p>
                  The most reliable SMM Panel in the market is <?php echo e(site('name_site')); ?>.
                  Smmclub offers the finest caliber SMM services because we
                  place the needs of our customers first. Our panel offers
                  premium services for incredibly low costs.
                </p>
                <p>
                  In order to inspire and motivate desired action, we engage
                  clients by delivering captivating messages through
                  sophisticated targeting. To engage and forge a true bond
                  between the brand and the consumer, we use a highly focused
                  strategy. So to get started with <?php echo e(site('name_site')); ?> as the cheapest
                  SMM panel, contact us now!
                </p>
                <div class="def_btn_wrap">
                  <a href="<?php echo e(route('home')); ?>" class="btn def_btn">Sign up Now</a>
                </div>
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-12">
              <div class="def_animations">
                <div class="animations_left">
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/Emoji_1_qmgukx.png"
                    class="def_icon1"
                    alt=""
                  />
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/emoji_11_bia1m3.png"
                    class="def_icon2"
                    alt=""
                  />
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/Emoji_4_mjifxt.png"
                    class="def_icon3"
                    alt=""
                  />
                </div>
                <div class="main_img">
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/man_with_mic_co4oxw.png"
                    class="img-fluid"
                    alt=""
                  />
                </div>
                <div class="animations_right">
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/Emoji_7_iruoo8.png"
                    class="def_icon4"
                    alt=""
                  />
                  <img
                    src="https://cdn.nmhpanel.com/landing/3/imgs/emoji_12_z8fy4s.png"
                    class="def_icon5"
                    alt=""
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer id="footerV2">
      <div class="container">
        <div class="row footer_top">
          <div class="col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="footer_v2_logo">
              <a href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(siteValue('logo')); ?>" class="footer_logo" alt="smm panel" />
              </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <hr class="hr_primary" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="footer_bottom_links text-center">
              <span class="link">© Copyright 2024 <?php echo e(site('name_site')); ?> </span>
              <span class="divid">|</span>
              <a href="/faqs" class="link">FAQs</a>
              <span class="divid">|</span>
              <a href="/terms" class="link">Terms &amp; Conditions</a>
              <span class="divid">|</span>
              <a href="/terms" class="link">Privacy Policy</a>
              <span class="divid">|</span>
              <span class="link"> All Right Reserved </span>
            </div>
          </div>
        </div>
      </div>
    </footer>
    
    <script src="https://cdn.nmhpanel.com/landing/3/js/jquery.min.js"></script>
    <script src="https://cdn.nmhpanel.com/landing/3/js/0r4tywzonxftumui.js"></script>
    <script
      src="https://kit.fontawesome.com/706d20f321.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
      function navToggleMob() {
        let menuBox = document.getElementById("navMob");
        menuBox.classList.toggle("active");
      }

      $(window).scroll(function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 80) {
          $("#navbar").addClass("shrink");
        } else {
          $("#navbar").removeClass("shrink");
        }

        if (scroll >= 300) {
          $("#navbar").addClass("fixed-top");
        } else {
          $("#navbar").removeClass("fixed-top");
        }
      });

      $(".content-slider-1,.content-slider-2,.content-slider-3").slick({
        dots: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        speed: 500,
        adaptiveHeight: true,
        //fade: true,
        //cssEase: 'linear',
      });
      $(".social-slider").slick({
        dots: false,
        arrows: false,
        slidesToShow: 5,
        slidesToScroll: 5,
        infinite: true,
        speed: 500,
        //fade: true,
        //cssEase: 'linear',
        responsive: [
          {
            breakpoint: 550,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: false,
              dots: true,
              speed: 300,
            },
          },
        ],
      });
      $(".testimonial").slick({
        dots: false,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
          {
            breakpoint: 550,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: false,
              dots: true,
              speed: 300,
            },
          },
        ],
      });
      $("#testimoniSlider").slick({
        dots: false,
        infinite: true,
        speed: 300,
        autoplay: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        centerMode: true,
        arrows: false,
        responsive: [
          {
            breakpoint: 1260,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 550,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ],
      });

      $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
      if ($(window).width() < 991) {
        $("#wrapper").removeClass("toggled");
      } else {
        $("#wrapper").addClass("toggled");
      }
    </script>
    <script src="https:////cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>
<?php endif; ?>
<?php if(site('landing') == '4'): ?>

<!DOCTYPE html>
<html lang="en">
  <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo e(site('name_site')); ?> | Hệ thống dịch vụ Mạng Xã Hội </title>

    <!-- [Open Graph] -->
    <meta property="og:title" content="<?php echo e(siteValue('title')); ?>">
    <meta property="og:description" content="<?php echo e(siteValue('description')); ?>">
    <meta property="og:image" content="<?php echo e(siteValue('thumbnail')); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:site_name" content="<?php echo e(siteValue('title')); ?>">
    <meta property="og:type" content="website">

    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="<?php echo e(siteValue('title')); ?>">
    <meta name="twitter:title" content="<?php echo e(siteValue('title')); ?>">
    <meta name="twitter:description" content="<?php echo e(siteValue('description')); ?>">
    <meta name="twitter:image" content="<?php echo e(siteValue('thumbnail')); ?>">
    <meta name="twitter:image:alt" content="<?php echo e(siteValue('title')); ?>">
    <meta name="twitter:creator" content="<?php echo e(siteValue('author')); ?>">
    <meta name="twitter:url" content="<?php echo e(url()->current()); ?>">
    <meta name="twitter:domain" content="<?php echo e(url()->current()); ?>">
    <meta name="twitter:data1" content="<?php echo e(siteValue('author')); ?>">

    <link rel="icon" href="<?php echo e(siteValue('favicon')); ?>" type="image/x-icon"> <!-- [Font] Family -->
    <link rel="shortcut icon" href="<?php echo e(siteValue('favicon')); ?>" type="image/x-icon">

    <link rel="shortcut icon" href="/assets/media/favicon.ico?1663731514" />
    <!-- Header -->

    <link
      href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Material+Icons&amp;display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.nmhpanel.com/landing/5/css/gm8f1wxfa3ydbh0w.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.nmhpanel.com/landing/5/css/izwd2s011kmgtsny.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.nmhpanel.com/landing/5/css/all.min.css"
    />
    <script src="https://www.google.com/recaptcha/api.js"></script>
    
  </head>

  <body class="not-auth">
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button
            type="button"
            class="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#navbar"
            aria-expanded="false"
            aria-controls="navbar"
          >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">
            <img src="<?php echo e(siteValue('logo')); ?>" alt="<?php echo e(site('name_site')); ?>" title="" />
          </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/">Home</a></li>
            <li><a href="<?php echo e(route('home')); ?>">Sign in</a></li>
            <li><a href="<?php echo e(route('home')); ?>">Services</a></li>
            <li><a>FAQs</a></li>
            <li><a>Terms</a></li>
            <li><a>API</a></li>
            <li><a href="<?php echo e(route('home')); ?>">Sign up</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="inner-page">
      <section
        id="sec1"
        style="
          background-image: url(https://cdn.nmhpanel.com/landing/5/imgs/Layer-61-1.webp);
        "
      >
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <h1 class="main-title text-center">
                <?php echo e(site('name_site')); ?><br />
                #Destination No.1 SMM PANEL <br />
                Social Media Services Provider
              </h1>
              <p class="txt text-center">
                The most usable panel in the World with
                <b style="color: #f36c21; font-weight: bold">32,347,066</b>
                orders until now! Are you in?
              </p>
              <form class="home-form form-inline" style="display: none;">
                <div class="form-group inputDiv">
                  <span><i class="far fa-user"></i></span>
                  <input
                    type="text"
                    class="form-control username"
                    placeholder="Username"
                  />
                </div>
                <div class="form-group inputDiv">
                  <span><i class="fas fa-lock"></i></span>
                  <input
                    type="password"
                    class="form-control password"
                    placeholder="Password"
                    onkeypress="if (event.key == 'Enter') {event.preventDefault(); app.on.click.signin(document.querySelector('.username').value, document.querySelector('.password').value, 0);}"
                  />
                </div>
                <button
                  type="button"
                  class="btn btn-primary"
                  onclick="app.on.click.signin(document.querySelector('.username').value, document.querySelector('.password').value, 0)"
                >
                  Sign in
                </button>
                <a
                  href="<?php echo e(route('home')); ?>"
                  class="forgot-password pull-right pull-right-middle"
                  >Forgot password?</a
                >
                <div style="margin-top: 10px"></div>
                <span class="pull-left pull-left-middle"
                  >Do not have an account? <a href="<?php echo e(route('home')); ?>">Sign up</a></span
                >
              </form>
            </div>
            <div class="col-sm-12">
              <img
                class="shop-img"
                src="https://cdn.nmhpanel.com/landing/5/imgs/jkirtjcpl5j4sqds.png"
                alt=""
              />
            </div>
          </div>
        </div>
        <div class="cloudy-wrap">
          <img
            class="cloudy-img"
            src="https://cdn.nmhpanel.com/landing/5/imgs/buquzolalrz1kny2.png"
            alt=""
          />
          <img
            class="top-g-img"
            src="https://cdn.nmhpanel.com/landing/5/imgs/fj2oe7tzwcstg9ch.png"
            alt=""
          />
        </div>
      </section>
      <section id="sec2">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="social-slider">
                <div>
                  <div class="social-slider-wrap fb"></div>
                </div>
                <div>
                  <div class="social-slider-wrap insta"></div>
                </div>
                <div>
                  <div class="social-slider-wrap linked"></div>
                </div>
                <div>
                  <div class="social-slider-wrap twit"></div>
                </div>
                <div>
                  <div class="social-slider-wrap yt"></div>
                </div>
                <div>
                  <div class="social-slider-wrap fb"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section id="sec3">
        <div class="container">
          <div class="row title-row">
            <div class="col-sm-12">
              <h2>WHY CHOOSE US?</h2>
              <h3>We Make Your Life Easier By<br />Boosting Sales</h3>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="media hvr-bob">
                <div class="media-left media-middle">
                  <img
                    class="media-object"
                    src="https://cdn.nmhpanel.com/landing/5/imgs/2fmszwiwnz2imz4e.png"
                    alt="..."
                  />
                </div>
                <div class="media-body">
                  <h4 class="media-heading">Unbelievable Prices</h4>
                  <p>
                    Our prices are the cheapest in the market, starting at
                    0.01$.
                  </p>
                </div>
              </div>
              <!-- // media -->
            </div>
            <div class="col-sm-6">
              <div class="media hvr-bob">
                <div class="media-left media-middle">
                  <img
                    class="media-object"
                    src="https://cdn.nmhpanel.com/landing/5/imgs/mpy67pthp0olo061.png"
                    alt="..."
                  />
                </div>
                <div class="media-body">
                  <h4 class="media-heading">Delivered Within Minutes</h4>
                  <p>
                    Our delivery is automated and usually it takes minutes if
                    not seconds to deliver your order.
                  </p>
                </div>
              </div>
              <!-- // media -->
            </div>
          </div>
          <br />
          <br />
          <div class="row">
            <div class="col-sm-6">
              <div class="media hvr-bob">
                <div class="media-left media-middle">
                  <img
                    class="media-object"
                    src="https://cdn.nmhpanel.com/landing/5/imgs/tzlki0jcjhzohtwd.png"
                    alt="..."
                  />
                </div>
                <div class="media-body">
                  <h4 class="media-heading">Friendly Dashboard</h4>
                  <p>
                    We have the friendliest dashbord in the <?php echo e(site('name_site')); ?>! Updated
                    regularly with the best user friendly features.
                  </p>
                </div>
              </div>
              <!-- // media -->
            </div>
            <div class="col-sm-6">
              <div class="media hvr-bob">
                <div class="media-left media-middle">
                  <img
                    class="media-object"
                    src="https://cdn.nmhpanel.com/landing/5/imgs/tzlki0jcjhzohtwd.png"
                    alt="..."
                  />
                </div>
                <div class="media-body">
                  <h4 class="media-heading">Support 24/7</h4>
                  <p>
                    We are proud to have the best support in the <?php echo e(site('name_site')); ?>,
                    replying to your tickets 24/7.
                  </p>
                </div>
              </div>
              <!-- // media -->
            </div>
          </div>
        </div>
      </section>
      <section id="work">
        <div class="container">
          <div class="row title-row">
            <div class="col-sm-12">
              <h2>How It Works</h2>
              <h3>Our Work Process</h3>
              <p class="title-bottom-txt">
                <?php echo e(site('name_site')); ?> and our dedicated team are all set to give you and
                your business a new height on social media and the Internet. Our
                focus is on your instructions, As to where you want to grow your
                business. So we are ready to improve your business in every way.
                To take advantage of our service, you can follow only four
                easiest ways and give your business a new height.
              </p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <div class="work-wrap">
                <div class="work-top">
                  <h3>1</h3>
                  <h4>Signup</h4>
                </div>
                <div class="work-bottom">
                  <p>
                    Register into our <?php echo e(site('name_site')); ?>, fill up your data and get
                    ready to be famous.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="work-wrap">
                <div class="work-top">
                  <h3>2</h3>
                  <h4>Add Funds</h4>
                </div>
                <div class="work-bottom">
                  <p>
                    Add money to your SMM account and be ready to rise like a
                    star and give your business a new height.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="work-wrap">
                <div class="work-top">
                  <h3>3</h3>
                  <h4>Service Selection</h4>
                </div>
                <div class="work-bottom">
                  <p>
                    Select a service and place an order and get ready to start
                    receiving more and more publicity on Social Media and the
                    Internet.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="work-wrap">
                <div class="work-top">
                  <h3 class="noafter">4</h3>
                  <h4>Enjoy</h4>
                </div>
                <div class="work-bottom">
                  <p>Enjoy your popularity and stay with us.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section id="feature">
        <div class="container">
          <div class="row title-row">
            <div class="col-sm-12">
              <h2>Features Of</h2>
              <h3><?php echo e(site('name_site')); ?></h3>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="feature-slider">
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>Indian SMM Panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        We are very famous in selling our SMM services in a
                        unique way all over the world, all the more we loved
                        India because Indians love our service and our whole SMM
                        Panel Service is famous across the globe. And we are
                        also known as Indian SMM Panel.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>Cheap SMM Panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        If you are searching for cheap SMM panel solutions, look
                        no farther than <?php echo e(site('name_site')); ?>. All your SMM needs are
                        related to the utmost accountability and commitment.
                        Quality meets cost-effectiveness harmoniously to deliver
                        the best experience for each customer.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>SMM Provider Panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        As a trusted SMM provider panel company, we offer
                        responsible and reliable services to meet the changing
                        your needs of a large number of customers. You can
                        expect cost-efficient solutions from us. that's why
                        <?php echo e(site('name_site')); ?> is the world's best SMM Panel
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>Wholesale SMM Panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        You can contact <?php echo e(site('name_site')); ?> to buy SMM Panel Wholesale
                        Providers at the most affordable prices.<br />
                        We offer 24/7 support and 100% confidentiality for our
                        customers. As a customer, you will receive real-time
                        statics and tracking about the order.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>Google SMM Panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        Our Google SMM panel offers excellent features and
                        benefits for buyers. <br />
                        You can expect high quality, <br />
                        competitive pricing, instant services, responsive API,
                        <br />
                        Timely support, real-time statics, and 100%
                        confidentiality.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>Cheapest SMM Reseller Panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        Your search for the cheap SMM reseller panel quickly
                        ends with us. We offer a pleasurable and rewarding
                        purchase experience with us. Timely support is also best
                        to ensure 100% customer satisfaction. <?php echo e(site('name_site')); ?> is the
                        best SMM reseller panel
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>Paytm SMM Panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        <?php echo e(site('name_site')); ?> provides the most reliable and cost-efficient
                        Paytm SMM Panel services amongst our competitors. <br />
                        If you are searching for cheapest SMM Panels services in
                        India, <br />
                        our SMM Panel is the most suitable one for you.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>PayPal SMM Panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        Our reputation as the most dependable automatic and
                        cheapest PayPal SMM Pane service provider stands second
                        to none. We offer you the fastest social media marketing
                        tool, <br />
                        which is entirely developed only for resellers.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>SMM Reseller Panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        If you are on the lookout for Well Ranked SMM reseller
                        panel services,<br />
                        look no farther than <?php echo e(site('name_site')); ?>.<br />
                        Our prices are unbeatable.<br />
                        You can enjoy responsible<br />
                        and fast customer support solutions with us.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>Instagram SMM Panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        Our Instagram SMM Panel solutions fulfil your all needs
                        perfectly.<br />
                        We present a perfect Quality IG Services for all types
                        of industry.<br />
                        Our Instagram Services will boost your business quickly.
                        <br />You can expect 24/7 support from us.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>
                        PUBG SMM <br />
                        Panel
                      </h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        Are you searching for a trustworthy PUBG SMM Panel
                        service provider? You don’t have to look any farther
                        than <?php echo e(site('name_site')); ?>. We beat any price without making any
                        compromise quality in our services and reliability. We
                        can provide you only High-quality services quickly.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>
                        Best SMM <br />
                        Panel
                      </h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        If you want to realise the real power best SMM Panel,
                        you can make use of our services for all of your needs.
                        As a trusted SMM Panel provider, we guarantee the
                        highest to highest quality services for each customer.
                        Our pocket-friendly prices safeguard your interests
                        entirely.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>
                        Top SMM <br />
                        Panel
                      </h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        If you contact <?php echo e(site('name_site')); ?> to meet your (SMM) Social
                        Media Marketing needs,<br />
                        you can expect outstanding results from us. As a Top SMM
                        panel provider, <br />
                        we take care of your needs efficiently with a clear
                        focus on <br />
                        Quality or speed and affordability.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>SMM provider panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        <?php echo e(site('name_site')); ?> is the most reliable SMM Provider Panel
                        available on the market today. <br />
                        Being a reputed and reliable SMM provider panel,<br />
                        we are committed to meeting the unique needs of each
                        customer responsibly and affordably. Support always on
                        the top.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>Reseller Panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        At <?php echo e(site('name_site')); ?>, we have a professional and cheap reseller
                        panel that meets your SMM needs with 100% efficiency.
                        Efficacy and speed meet cost competence harmoniously to
                        deliver the best purchase experience for customers.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>Social SMM panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        If you want to buy cheap social media views, likes,
                        shares, and followers instantly, you can approach
                        <?php echo e(site('name_site')); ?>. Our fully automated Social SMM Panel USA
                        Followers live up to your expectations ideally.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>worldwide SMM panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        Our instant SMM panel works for your website’s
                        performance growth. You can make the best use of the
                        worldwide SMM panel and increase your website’s growth
                        worldwide. We also have customized offers for you on the
                        worldwide SMM panel.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>Social Media Marketing Panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        The SMM Panel (Social Media Marketing Panel) is a
                        website from which people purchase Best SMM Panel for
                        Social Media Services such as Instagram followers,
                        YouTube views, Facebook fan page likes, Twitter
                        followers, website traffic, Pubg facilities, and more.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>SEO Service Reseller Panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        We have come up with a trusted SEO service reseller
                        panel to improve your SEO efforts and help your business
                        rank on top of the search engine. We ensure you get a
                        trusted platform where you can grow your business
                        seamlessly.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="feature-slider-wrap">
                    <div class="feature-icon"></div>
                    <div class="feature-title">
                      <h5>Indian SMM Reseller Panel</h5>
                    </div>
                    <div class="feature-icon">
                      <p>
                        Our Indian SMM reseller panel will fit your business
                        needs easily and help derive the desired results out of
                        your campaign and prove the right value of your services
                        to your target audiences. Get a reliable SMM reseller
                        panel right away.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="feature-slider-nav"></div>
            </div>
          </div>
        </div>
      </section>
      <section id="sec7">
        <div class="container">
          <div class="row title-row">
            <div class="col-sm-12">
              <h3>Secure Payment</h3>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 text-center">
              <p class="">
                The most flexible digital commerce platform that can give<br />
                your business a real boost
              </p>
              <img
                class="img-responsive payment-logo"
                src="https://cdn.nmhpanel.com/landing/5/imgs/j4icr2gwpkjp4er4.png"
                alt="payment-logo"
              />
            </div>
          </div>
          <div class="cloudy-wrap">
            <img
              class="boy-search"
              src="https://cdn.nmhpanel.com/landing/5/imgs/3owgwh7f2nhcg312.png"
              alt="boy-search"
            />
            <img
              class="coin1"
              src="https://cdn.nmhpanel.com/landing/5/imgs/po1dbcdot13pnkkf.png"
              alt="coin1"
            />
            <img
              class="coin2"
              src="https://cdn.nmhpanel.com/landing/5/imgs/po1dbcdot13pnkkf.png"
              alt="coin2"
            />
            <img
              class="boy-tblt"
              src="https://cdn.nmhpanel.com/landing/5/imgs/hu2cbtrf2n2anck6.png"
              alt="boy-tblt"
            />
          </div>
        </div>
        <div class="cloudy-wrap">
          <img
            class="cloudy-img"
            src="https://cdn.nmhpanel.com/landing/5/imgs/buquzolalrz1kny2.png"
            alt=""
          />
        </div>
      </section>
      <section id="sec8">
        <div class="container">
          <div class="row">
            <div class="col-sm-7">
              <div class="slider2">
                <div>
                  <img
                    class="img-responsive"
                    src="https://cdn.nmhpanel.com/landing/5/imgs/z7lrb9b64u8s76hg.png"
                    alt=""
                  />
                </div>
                <div>
                  <img
                    class="img-responsive"
                    src="https://cdn.nmhpanel.com/landing/5/imgs/j0ce44knfdyyo1ic.png"
                    alt=""
                  />
                </div>
                <div>
                  <img
                    class="img-responsive"
                    src="https://cdn.nmhpanel.com/landing/5/imgs/z7lrb9b64u8s76hg.png"
                    alt=""
                  />
                </div>
              </div>
              <div class="slider2-nav"></div>
            </div>
            <div class="col-sm-5">
              <div class="row title-row">
                <div class="col-sm-12">
                  <h3>What We Offer<br />For Your Succes<br />Brand</h3>
                </div>
              </div>
              <p>
                We are only 24 hours a day and 7 times a week to help you and
                support you with all your demands and services around the day.
                Dont go anywhere else, we are here ready to serve you and help
                you with all of your SMM needs. <br />
                Users or Clients with SMM orders and in need of CHEAP SMM
                services are more then welcome in our SMM PANEL.
              </p>
              <a href="<?php echo e(route('home')); ?>" class="world-btn"
                >VIEW ALL SERVICES<i class="fas fa-long-arrow-alt-right"></i
              ></a>
            </div>
          </div>
        </div>
      </section>

      <section id="sec11">
        <div class="container">
          <div class="row title-row">
            <div class="col-sm-12">
              <h3>There Is Other Happy Customers</h3>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="testimonial">
                <div class="testi-all">
                  <div class="testi1">
                    <div class="test-star">
                      <img
                        class=""
                        src="https://cdn.nmhpanel.com/landing/5/imgs/dfft0suiy3ilm3gy.png"
                        alt="rating-star"
                      />
                    </div>
                    <div class="testi-title">
                      <h6>Kayana .R</h6>
                    </div>
                    <div class="testi-desc">
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Etiam erat turpis, tincidunt ut quam eu, sodales
                        vestibulum purus. Maecenas eget velit congue, cursus
                      </p>
                    </div>
                    <div class="testi-pic">
                      <div class="test-pic-prof kayana"></div>
                    </div>
                  </div>
                </div>

                <div class="testi-all">
                  <div class="testi2 text-center">
                    <div class="test-star">
                      <img
                        class=""
                        src="https://cdn.nmhpanel.com/landing/5/imgs/dfft0suiy3ilm3gy.png"
                        alt="rating-star"
                      />
                    </div>
                    <div class="testi-title">
                      <h6>Mike Andereson</h6>
                    </div>
                    <div class="testi-desc">
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Etiam erat turpis, tincidunt ut quam eu, sodales
                        vestibulum purus. Maecenas eget velit congue, cursus
                      </p>
                    </div>
                    <div class="testi-pic">
                      <div class="test-pic-prof mike"></div>
                    </div>
                  </div>
                </div>

                <div class="testi-all">
                  <div class="testi3 text-right">
                    <div class="test-star">
                      <img
                        class=""
                        src="https://cdn.nmhpanel.com/landing/5/imgs/dfft0suiy3ilm3gy.png"
                        alt="rating-star"
                      />
                    </div>
                    <div class="testi-title">
                      <h6>Kevin Peterson</h6>
                    </div>
                    <div class="testi-desc">
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Etiam erat turpis, tincidunt ut quam eu, sodales
                        vestibulum purus. Maecenas eget velit congue, cursus
                      </p>
                    </div>
                    <div class="testi-pic">
                      <div class="test-pic-prof kevin"></div>
                    </div>
                  </div>
                </div>

                <div class="testi-all">
                  <div class="testi4">
                    <div class="test-star">
                      <img
                        class=""
                        src="https://cdn.nmhpanel.com/landing/5/imgs/dfft0suiy3ilm3gy.png"
                        alt="rating-star"
                      />
                    </div>
                    <div class="testi-title">
                      <h6>John Smith</h6>
                    </div>
                    <div class="testi-desc">
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Etiam erat turpis, tincidunt ut quam eu, sodales
                        vestibulum purus. Maecenas eget velit congue, cursus
                      </p>
                    </div>
                    <div class="testi-pic">
                      <div class="test-pic-prof john"></div>
                    </div>
                  </div>
                </div>

                <div class="testi-all">
                  <div class="testi5 text-right">
                    <div class="test-star">
                      <img
                        class=""
                        src="https://cdn.nmhpanel.com/landing/5/imgs/dfft0suiy3ilm3gy.png"
                        alt="rating-star"
                      />
                    </div>
                    <div class="testi-title">
                      <h6>Kevin Peterson</h6>
                    </div>
                    <div class="testi-desc">
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Etiam erat turpis, tincidunt ut quam eu, sodales
                        vestibulum purus. Maecenas eget velit congue, cursus
                      </p>
                    </div>
                    <div class="testi-pic Kevin">
                      <div class="test-pic-prof Kevin"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="test-bottom-img">
            <img
              class=""
              src="https://cdn.nmhpanel.com/landing/5/imgs/syfnayio0xww830r.png"
              alt="test-big"
            />
          </div>

          <div class="row testimonial-mob">
            <div class="col-sm-4">
              <div class="test-mob-wrap">
                <div class="test-mob1">
                  <div class="test-mob-pic">
                    <img
                      class=""
                      src="https://cdn.nmhpanel.com/landing/5/imgs/sloapiojaeigtado.png"
                      alt=""
                    />
                  </div>
                  <div class="test-mob-star">
                    <img
                      class=""
                      src="https://cdn.nmhpanel.com/landing/5/imgs/dfft0suiy3ilm3gy.png"
                      alt="rating-star"
                    />
                  </div>
                  <div class="test-mob-title">
                    <h6>Kayana .R</h6>
                  </div>
                  <div class="test-mob-desc">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                      Etiam erat turpis, tincidunt ut quam eu, sodales
                      vestibulum purus. Maecenas eget velit congue, cursus
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="test-mob-wrap">
                <div class="test-mob1">
                  <div class="test-mob-pic">
                    <img
                      class=""
                      src="https://cdn.nmhpanel.com/landing/5/imgs/0gmh1fbjelqdd8jc.png"
                      alt=""
                    />
                  </div>
                  <div class="test-mob-star">
                    <img
                      class=""
                      src="https://cdn.nmhpanel.com/landing/5/imgs/dfft0suiy3ilm3gy.png"
                      alt="rating-star"
                    />
                  </div>
                  <div class="test-mob-title">
                    <h6>Mike Andereson</h6>
                  </div>
                  <div class="test-mob-desc">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                      Etiam erat turpis, tincidunt ut quam eu, sodales
                      vestibulum purus. Maecenas eget velit congue, cursus
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="test-mob-wrap">
                <div class="test-mob1">
                  <div class="test-mob-pic">
                    <img
                      class=""
                      src="https://cdn.nmhpanel.com/landing/5/imgs/cn6cp5s53hwt4lfu.png"
                      alt=""
                    />
                  </div>
                  <div class="test-mob-star">
                    <img
                      class=""
                      src="https://cdn.nmhpanel.com/landing/5/imgs/dfft0suiy3ilm3gy.png"
                      alt="rating-star"
                    />
                  </div>
                  <div class="test-mob-title">
                    <h6>Kevin Peterson</h6>
                  </div>
                  <div class="test-mob-desc">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                      Etiam erat turpis, tincidunt ut quam eu, sodales
                      vestibulum purus. Maecenas eget velit congue, cursus
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row testimonial-mob">
            <div class="col-sm-4">
              <div class="test-mob-wrap">
                <div class="test-mob1">
                  <div class="test-mob-pic">
                    <img
                      class=""
                      src="https://cdn.nmhpanel.com/landing/5/imgs/50hlkscpxngthrle.png"
                      alt=""
                    />
                  </div>
                  <div class="test-mob-star">
                    <img
                      class=""
                      src="https://cdn.nmhpanel.com/landing/5/imgs/dfft0suiy3ilm3gy.png"
                      alt="rating-star"
                    />
                  </div>
                  <div class="test-mob-title">
                    <h6>John Smith</h6>
                  </div>
                  <div class="test-mob-desc">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                      Etiam erat turpis, tincidunt ut quam eu, sodales
                      vestibulum purus. Maecenas eget velit congue, cursus
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-4"></div>
          </div>
        </div>
      </section>
      <section id="sec12">
        <div class="container">
          <div class="row title-row">
            <div class="col-sm-12">
              <h3>Our Company</h3>
              <p>
                We have a professional SMM Panel ready to serve you anytime you
                need with instant start and amazing speed to deliver your SMM
                work with efficacy and speed. We are waiting for your Cheap SMM
                orders starting today and please note that we accept auto
                payments for your orders and we have api to serve any SMM PANEL
                Owner around the globe.
              </p>
            </div>
          </div>

          <div class="row stat-row">
            <div class="col-sm-4">
              <div class="single-stat">
                <div class="single-stat-img">
                  <img
                    class="img-responsive"
                    src="https://cdn.nmhpanel.com/landing/5/imgs/a1dl1bes8kuo2h6a.png"
                    alt=""
                  />
                </div>
                <div class="single-stat-cont">
                  <h5>0.14 SEC</h5>
                  <p>An Order Is Made Every</p>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="single-stat">
                <div class="single-stat-img">
                  <img
                    class="img-responsive"
                    src="https://cdn.nmhpanel.com/landing/5/imgs/wf3r28uriadmsko9.png"
                    alt=""
                  />
                </div>
                <div class="single-stat-cont">
                  <h5>140,444,710</h5>
                  <p>Orders Completed</p>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="single-stat">
                <div class="single-stat-img">
                  <img
                    class="img-responsive"
                    src="https://cdn.nmhpanel.com/landing/5/imgs/9xwnwhg39h0iyn5g.png"
                    alt=""
                  />
                </div>
                <div class="single-stat-cont">
                  <h5>$0.01/1K</h5>
                  <p>Price Starting From</p>
                </div>
              </div>
            </div>
          </div>

          <div class="row likes-row withoutslider">
            <div class="col-sm-4">
              <div class="likes-row-wrap">
                <div class="likes-row-icon">
                  <img
                    class="like-row-img rubberBand"
                    src="https://cdn.nmhpanel.com/landing/5/imgs/nifqh71dg8q1ln7j.png"
                    alt="like-row1"
                  />
                </div>
                <div class="likes-row-body">
                  <h4>World's Best SMM Panel in the Market</h4>
                  <p>
                    Likes for all social networks. We have the best likes
                    services on the market.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="likes-row-wrap">
                <div class="likes-row-icon">
                  <img
                    class="like-row-img rubberBand"
                    src="https://cdn.nmhpanel.com/landing/5/imgs/w32ku6trxjj4e07h.png"
                    alt="like-row1"
                  />
                </div>
                <div class="likes-row-body">
                  <h4>Instagram Followers Reseller in India</h4>
                  <p>
                    Followers for all social networks. We have the best
                    followers services on the market.
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="likes-row-wrap">
                <div class="likes-row-icon">
                  <img
                    class="like-row-img rubberBand"
                    src="https://cdn.nmhpanel.com/landing/5/imgs/dgfb3bijzhp79ec1.png"
                    alt="like-row1"
                  />
                </div>
                <div class="likes-row-body">
                  <h4>Best and Affordable SMM Panel Provider</h4>
                  <p>
                    Views for all social networks. We have the best views
                    services on the market.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="row likes-row">
            <div class="col-sm-12">
              <div class="likes-row-slider">
                <div>
                  <div class="likes-row-wrap">
                    <div class="likes-row-icon">
                      <img
                        class="like-row-img rubberBand"
                        src=""
                        alt="like-row1"
                      />
                    </div>
                    <div class="likes-row-body">
                      <h4>World's Best SMM Panel in the Market</h4>
                      <p>
                        Likes for all social networks. We have the best likes
                        services on the market.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="likes-row-wrap">
                    <div class="likes-row-icon">
                      <img
                        class="like-row-img rubberBand"
                        src=""
                        alt="like-row1"
                      />
                    </div>
                    <div class="likes-row-body">
                      <h4>Instagram Followers Reseller in India</h4>
                      <p>
                        Followers for all social networks. We have the best
                        followers services on the market.
                      </p>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="likes-row-wrap">
                    <div class="likes-row-icon">
                      <img
                        class="like-row-img rubberBand"
                        src=""
                        alt="like-row1"
                      />
                    </div>
                    <div class="likes-row-body">
                      <h4>Best and Affordable SMM Panel Provider</h4>
                      <p>
                        Views for all social networks. We have the best views
                        services on the market.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="ready">
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <h3>Ready to start with us?</h3>
            </div>
            <div class="col-sm-6">
              <a href="<?php echo e(route('home')); ?>" class="joinBtn">Join us now</a>
            </div>
          </div>
        </div>
      </section>
      <script src="https://cdn.nmhpanel.com/landing/5/js/api.js"></script>
    </div>

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="ftr-logo">
              <img src="<?php echo e(siteValue('logo')); ?>" alt="ftr-logo" height="45px" />
            </div>
            <div class="ftr-txt">
              <p>
                <?php echo e(site('name_site')); ?> #Destination No.1 SMM PANEL Social Media Services
                Provider
              </p>
            </div>
            <div class="ftr-info">
              <a href="#" target="_blank"
                ><i class="fas fa-map-marker-alt"></i> <?php echo e(site('name_site')); ?></a
              >
              <a href="mailto:admin{{ site('name_site') }}" target="_blank"
                ><i class="fas fa-envelope"></i> Feedback</a
              >
            </div>
          </div>
          <div class="col-sm-6">
            <div class="ftr-nav">
              <div class="ftr-nav-title">
                <h6>Quick Links</h6>
              </div>
              <ul>
                <li><a href="/api">api</a></li>
                <li><a href="/terms">terms</a></li>
                <li><a>faqs</a></li>
                <li><a href="<?php echo e(route('home')); ?>">signin</a></li>
                <li><a href="<?php echo e(route('home')); ?>">signup</a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="row ftr-bottom">
          <div class="col-sm-6">
            <p>© Copyright 2022. All Rights Reserved</p>
          </div>
        </div>
      </div>
    </footer>
    
    <script
      type="text/javascript"
      src="https://cdn.nmhpanel.com/landing/5/js/jquery.min.js"
    ></script>
    <script
      type="text/javascript"
      src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
    ></script>
    <script type="text/javascript">
      $(document).ready(function () {
        $(".social-slider").slick({
          dots: false,
          infinite: true,
          speed: 300,
          slidesToShow: 4,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 0,
          speed: 9000,
          cssEase: "linear",
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 2,
                infinite: true,
                dots: false,
                autoplaySpeed: 0,
                speed: 9000,
              },
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 2,
              },
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
              },
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ],
        });
      });

      $(".slider1").slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 2,
        slidesToScroll: 2,
        appendArrows: $(".slider1-nav"),
        nextArrow:
          '<button class="right-arrow"><i class="fas fa-long-arrow-alt-right"></i></button>',
        prevArrow:
          '<button class="left-arrow"><i class="fas fa-long-arrow-alt-left"></i></button>',
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              infinite: true,
              dots: false,
            },
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            },
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ],
      });

      $(".slider2").slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 2,
        slidesToScroll: 2,
        appendArrows: $(".slider2-nav"),
        nextArrow:
          '<button class="right-arrow"><i class="fas fa-long-arrow-alt-right"></i></button>',
        prevArrow:
          '<button class="left-arrow"><i class="fas fa-long-arrow-alt-left"></i></button>',
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              infinite: true,
              dots: false,
            },
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            },
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
      });

      $(".slider3").slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        appendArrows: $(".slider3-nav"),
        nextArrow:
          '<button class="right-arrow"><i class="fas fa-long-arrow-alt-right"></i></button>',
        prevArrow:
          '<button class="left-arrow"><i class="fas fa-long-arrow-alt-left"></i></button>',
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: true,
              dots: false,
            },
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ],
      });

      $(".likes-row-slider").slick({
        dots: false,
        infinite: false,
        speed: 100,
        autoplay: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        appendArrows: $(".likes-row-nav"),
        nextArrow:
          '<button class="right-arrow"><i class="fas fa-long-arrow-alt-right"></i></button>',
        prevArrow:
          '<button class="left-arrow"><i class="fas fa-long-arrow-alt-left"></i></button>',
      });

      $(".feature-slider").slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        appendArrows: $(".feature-slider-nav"),
        nextArrow:
          '<button class="right-arrow"><i class="fas fa-long-arrow-alt-right"></i></button>',
        prevArrow:
          '<button class="left-arrow"><i class="fas fa-long-arrow-alt-left"></i></button>',
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              infinite: true,
              dots: false,
            },
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ],
      });
    </script>
    <script
      src="https://kit.fontawesome.com/706d20f321.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\socialmedia\app\resources\views/landing.blade.php ENDPATH**/ ?>