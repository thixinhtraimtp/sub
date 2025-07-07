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
    <script src="/assets/js/plugins/jquery-3.7.1.min.js"></script>

<script>
function replaceText() {
    const replacements = {
        "𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟": "Không bảo hành",
        "𝗥𝗘𝗙𝗜𝗟𝗟": "Bảo hành",
        "𝐋𝐢𝐟𝐞𝐓𝐢𝐦𝐞": "Bảo hành trọn đời",
        "Super Cheap": "Siêu rẻ",
        "𝐍𝐨𝐧 𝐃𝐫𝐨𝐩": "Không tụt",
        "Non Drop": "Không tụt",
        "𝐇𝐐 Profiles": "Tài khoản chất lượng cao",
        "𝐇𝐐": "Chất lượng cao",
        "Instant": "Đặt là chạy",
        "Real": "người thật",
        "𝗥𝗲𝗮𝗹": "người thật",
        "Day": " ngày",
        "Super Slow": "Tốc độ chậm",
        "Live Stream Views -": " Mắt live xem trong",
        "Live Stream Views Cheap -": "Mắt live giá rẻ xem trong",
        "minutes": "Phút",
        "Only Post/Photo": "Chỉ dành cho ảnh",
        "Flash": "Siêu tốc",
        "𝗢𝗹𝗱 𝗔𝗰𝗰𝗼𝘂𝗻𝘁": "Tài khoản cũ",
        "Instagram Premium Custom Story Comment": "Bình luận ngẫu nhiên Prenium",
        "Turkish": "Tài nguyên Thổ Nhĩ Kỳ",
        "ARAB": "Tài nguyên Ả Rập",
        "Spanish": "Tài nguyên Tây Ban Nha",
        "Instagram Comment Likes With Comment Link": "Like bình luận với Link liên kết",
        "Instagram Live Video Likes": "Tăng Like video Live",
        "Instagram Live Views": "Tăng View",
        "Blue Tick Verified": "Tài khoản Tick xanh",
        "Comments": "Bình luận ", 
        "Likes": " Like", 
        "With Blue Tick": "Tick xanh",
        "Impressions": "Ấn tượng",
        "Impressions": "Ấn tượng",
        "Instagram Views": "Tăng lượt xem Video/Reels",
        

    };

    function walk(node) {
        if (node.nodeType === 3) { // Text node
            let text = node.nodeValue;
            for (const [oldWord, newWord] of Object.entries(replacements)) {
                const regex = new RegExp(oldWord, 'gi');
                text = text.replace(regex, newWord);
            }
            node.nodeValue = text;
        } else if (node.nodeType === 1) { // Element node
            for (let child of node.childNodes) {
                walk(child); // Recursively walk through child nodes
            }
        }
    }

    walk(document.body); // Start walking from the body
}

window.addEventListener('load', replaceText);
</script>
</head>
<body>
<?php echo site('script_body'); ?>

    <header class="sticky top-0 z-40 flex h-18 w-full border-b border-default-200/95 bg-white/95 backdrop-blur-sm dark:bg-default-50/95 print:hidden">
        <nav class="flex w-full items-center gap-4 px-6">
            <div class="flex lg:hidden">
                <button type="button" class="text-default-500 hover:text-default-600" data-hs-overlay="#application-sidebar" aria-controls="application-sidebar" aria-label="Toggle navigation">
                    <i data-lucide="align-justify" class="h-6 w-6"></i>
                </button>
            </div>
            <div class="hidden lg:flex">
                <a href="<?php echo e(route('home')); ?>">
                    <img src="<?php echo e(site('logo')); ?>" alt="logo" class="flex h-10 w-full dark:hidden" />
                    <img src="<?php echo e(site('logo')); ?>" alt="logo" class="hidden h-10 w-full dark:flex" />
                </a>
            </div>
            <div class="hidden lg:flex">
                <label for="icon" class="sr-only">Search</label>
                <div class="relative hidden lg:flex">
                    <input type="search" class="block rounded-full border-default-200 bg-default-50 py-2.5 pe-4 ps-12 text-sm text-default-800 focus:border-primary focus:ring-primary lg:w-64" placeholder="Search for items..." />
                    <i class="ti ti-search absolute start-4 top-1/2 -translate-y-1/2 text-lg text-default-600"></i>
                </div>
            </div>
            <div class="ms-auto flex items-center gap-4">
                <button class="relative inline-flex h-10 w-10 flex-shrink-0 items-center justify-center gap-2 overflow-hidden rounded-full bg-default-100 align-middle font-medium text-default-700 transition-all hover:text-primary">
                    <i class="ti ti-sun text-xl after:absolute after:inset-0" id="light-theme"></i>
                    <i class="ti ti-moon text-xl after:absolute after:inset-0" id="dark-theme"></i>
                </button>
            </div>
            <div class="hidden lg:flex">
                <button data-toggle="fullscreen" class="inline-flex h-10 w-10 flex-shrink-0 items-center justify-center gap-2 rounded-full bg-default-100 align-middle font-medium text-default-700 transition-all hover:text-primary">
                    <i class="ti ti-maximize flex text-xl group-[-fullscreen]:hidden"></i>
                    <i class="ti ti-minimize hidden text-xl group-[-fullscreen]:flex"></i>
                </button>
            </div>
            <?php if(Auth::check()): ?>
            <div class="flex">
                <div class="hs-dropdown relative inline-flex">
                    <button id="hs-dropdown-with-header" type="button" class="hs-dropdown-toggle inline-flex flex-shrink-0 items-center justify-center gap-2 rounded-md align-middle text-xs font-medium text-default-700 transition-all">
                      <img class="inline-block h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?background=random&name=<?php echo e(Auth::user()->name); ?>" />
                      <div class="hidden text-start lg:block">
                          <p class="text-xs font-semibold text-default-700"><?php echo e(Auth::user()->name); ?></p>
                          <p class="mt-1 text-xs text-default-500"><?php echo e(Auth::user()->email); ?></p>
                      </div>
                    </button>
                    <div class="hs-dropdown-menu duration mt-2 hidden min-w-[12rem] rounded-lg border border-default-200 bg-white p-2 opacity-0 shadow-md transition-[opacity,margin] hs-dropdown-open:opacity-100 dark:bg-default-50">
                      <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-800 transition-all hover:bg-default-100" href="<?php echo e(route('account.profile')); ?>">
                          <i class="ti ti-user-circle me-2 text-base"></i>
                          Tài khoản
                      </a>
                      <hr class="-mx-2 my-2 border-default-200" />
                      <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-red-500 hover:bg-red-400/10" href="<?php echo e(route('logout')); ?>">
                          <i class="h-4 w-4" data-lucide="log-out"></i>
                          Đăng xuất
                      </a>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-sm text-center bg-primary hover:bg-primary-700 border-primary hover:border-primary-700 text-white rounded-md" style="box-shadow: 0px 3px 0px #0b7452">
                <span>Đăng nhập</span>
            </a>
            <?php endif; ?>
        </nav>
    </header>
    <div class="mt-5"></div>
    <div id="application-sidebar" class="hs-overlay fixed inset-y-0 start-0 z-60 hidden w-64 -translate-x-full transform overflow-y-auto border-e border-default-200 bg-white transition-all duration-300 hs-overlay-open:translate-x-0 dark:bg-default-50 lg:bottom-0 lg:end-auto lg:z-30 lg:block lg:translate-x-0 rtl:translate-x-full rtl:hs-overlay-open:translate-x-0 rtl:lg:translate-x-0 print:hidden">
        <div class="sticky top-0 flex h-18 items-center justify-start px-6">
            <a href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(site('logo')); ?>" class="flex h-10 dark:hidden lg:h-12" />
                <img src="<?php echo e(site('logo')); ?>" class="hidden h-10 dark:flex lg:h-12"/>
            </a>
        </div>
        <div class="hs-accordion-group h-[calc(100%-72px)] p-4" data-simplebar>
            <ul class="admin-menu flex w-full flex-col gap-1.5">
            <?php if(Auth::check() && Auth::user()->role === 'admin'): ?>
                <li class="menu-item">
                    <a  href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-collapse-open:bg-default-100">
                        <img src="https://cdn-icons-png.flaticon.com/128/1759/1759309.png" width="24" height="24" class="h-6 w-6">
                        <span class="font-semibold">Trang quản trị</span>
                    </a>
                </li>
            <?php endif; ?>
                <li class="menu-item">
                    <a  href="<?php echo e(route('home')); ?>" class="flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-collapse-open:bg-default-100">
                        <img src="https://cdn-icons-png.flaticon.com/128/609/609803.png" width="24" height="24" class="h-6 w-6">
                        <span class="font-semibold">Trang chủ</span>
                    </a>
                </li>
            <?php if(Auth::check()): ?>
                <li class="px-4 py-2 text-sm font-medium text-default-600">Apps</li>
                <li class="menu-item hs-accordion">
                    <a href="javascript:void(0)" class="hs-accordion-toggle flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-accordion-active:bg-default-100">
                        <img src="https://cdn-icons-png.flaticon.com/128/8515/8515390.png" width="24" height="24" class="h-6 w-6">
                        <span class="font-semibold">Quản lý chung</span>
                        <i class="ti ti-chevron-right ms-auto text-sm transition-all hs-accordion-active:rotate-90"></i>
                    </a>
                    <div class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                        <ul class="mt-2 flex flex-col gap-2">
                            <li class="menu-item">
                                <a href="<?php echo e(route('account.profile')); ?>" class="flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-collapse-open:bg-default-100">
                                    <i class="ti ti-circle-filled scale-[.25] text-lg"></i>
                                    <img src="https://cdn-icons-png.flaticon.com/128/11472/11472723.png" width="24" height="24" class="h-6 w-6">
                                    <span class="font-semibold">Tài khoản</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a  href="<?php echo e(route('account.transactions')); ?>" class="flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-collapse-open:bg-default-100">
                                    <i class="ti ti-circle-filled scale-[.25] text-lg"></i>
                                    <img src="https://cdn-icons-png.flaticon.com/128/18321/18321325.png" width="24" height="24" class="h-6 w-6">
                                    <span class="font-semibold">Dòng tiền</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="<?php echo e(route('account.progress')); ?>" class="flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-collapse-open:bg-default-100">
                                    <i class="ti ti-circle-filled scale-[.25] text-lg"></i>
                                    <img src="https://cdn-icons-png.flaticon.com/128/1532/1532688.png" width="24" height="24" class="h-6 w-6">
                                    <span class="font-semibold">Tiến trình</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('account.services')); ?>" class="flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-collapse-open:bg-default-100">
                                    <i class="ti ti-circle-filled scale-[.25] text-lg"></i>
                                    <img src="https://cdn-icons-png.flaticon.com/128/7634/7634463.png" width="24" height="24" class="h-6 w-6">
                                    <span class="font-semibold">Cấp bậc & Bảng giá</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="<?php echo e(route('create.website')); ?>" class="flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-collapse-open:bg-default-100">
                                    <i class="ti ti-circle-filled scale-[.25] text-lg"></i>
                                    <img src="https://cdn-icons-png.flaticon.com/128/1055/1055666.png" width="24" height="24" class="h-6 w-6">
                                    <span class="font-semibold">Tạo Website con</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="<?php echo e(route('ticket')); ?>" class="flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-collapse-open:bg-default-100">
                                    <i class="ti ti-circle-filled scale-[.25] text-lg"></i>
                                    <img src="https://cdn-icons-png.flaticon.com/128/8315/8315136.png" width="24" height="24" class="h-6 w-6">
                                    <span class="font-semibold">Ticket hỗ trợ</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                <li class="menu-item hs-accordion">
                    <a href="javascript:void(0)" class="hs-accordion-toggle flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-accordion-active:bg-default-100">
                        <img src="https://cdn-icons-png.flaticon.com/128/9548/9548542.png" width="24" height="24" class="h-6 w-6">
                            <span class="font-semibold">Nạp tiền</span>
                        <i class="ti ti-chevron-right ms-auto text-sm transition-all hs-accordion-active:rotate-90"></i>
                    </a>
                    <div class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                        <ul class="mt-2 flex flex-col gap-2">
                            <li class="menu-item">
                                <a href="<?php echo e(route('account.recharge')); ?>" class="flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-collapse-open:bg-default-100">
                                    <i class="ti ti-circle-filled scale-[.25] text-lg"></i>
                                    <img src="https://cdn-icons-png.flaticon.com/128/2830/2830289.png" width="24" height="24" class="h-6 w-6">
                                    <span class="font-semibold">Ngân hàng</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="<?php echo e(route('account.card')); ?>" class="flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-collapse-open:bg-default-100">
                                    <i class="ti ti-circle-filled scale-[.25] text-lg"></i>
                                    <img src="https://cdn-icons-png.flaticon.com/128/2611/2611083.png" width="24" height="24" class="h-6 w-6">
                                    <span class="font-semibold">Thẻ cào</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
                <li class="menu-item">
                    <a href="<?php echo e(route('rule')); ?>" class="flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-collapse-open:bg-default-100">
                        <img src="https://cdn-icons-png.flaticon.com/128/14671/14671775.png" width="24" height="24" class="h-6 w-6">
                        <span class="font-semibold">Điều khoản</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo e(route('api')); ?>" class="flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-collapse-open:bg-default-100">
                        <img src="https://cdn-icons-png.flaticon.com/128/15496/15496331.png" width="24" height="24" class="h-6 w-6">
                        <span class="font-semibold">Tài Liệu API</span>
                    </a>
                </li>
                <li class="px-4 py-2 text-sm font-medium text-default-600">Services</li>
                <?php if(site('status_massorder') == 'on'): ?>
                <li class="menu-item">
                    <a href="<?php echo e(route('mass')); ?>" class="flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-collapse-open:bg-default-100">
                        <img src="https://cdn-icons-png.flaticon.com/128/825/825561.png" width="24" height="24" class="h-6 w-6">
                        <span class="font-semibold">Đặt nhiều đơn</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if(site('status_smm') == 'on'): ?>
                <li class="menu-item">
                    <a href="<?php echo e(route('order')); ?>" class="flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-collapse-open:bg-default-100">
                        <img src="https://cdn-icons-png.flaticon.com/128/2435/2435292.png" width="24" height="24" class="h-6 w-6">
                        <span class="font-semibold">Đặt hàng</span>
                    </a>
                </li>
                <?php else: ?>
                
<?php $__currentLoopData = \App\Models\ServicePlatform::where('domain', env('APP_MAIN_SITE'))->where('status', 'active')->orderBy('order', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="menu-item hs-accordion">
                    <a href="javascript:void(0)" class="hs-accordion-toggle flex items-center gap-x-3.5 rounded-lg px-5 py-3 text-sm font-medium text-default-700 transition-all hover:bg-default-100 hs-accordion-active:bg-default-100">
                        <img src="<?php echo e($platform->image); ?>" width="24" height="24" alt="<?php echo e($platform->name); ?>" class="h-6 w-6">
                            <?php echo e($platform->name); ?>

                        <i class="ti ti-chevron-right ms-auto text-sm transition-all hs-accordion-active:rotate-90"></i>
                    </a>
                    <div class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                        <ul class="mt-2 flex flex-col gap-2">
<?php $__currentLoopData = $platform->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($service->status == 'inactive'): ?> 
<?php else: ?> 
                            <li class="menu-item">
                                <a href="<?php echo e(route('service', ['service' => $service->slug, 'platform' => $platform->slug])); ?>" class="flex items-center gap-x-3.5 rounded-full px-5 py-2 text-sm font-medium text-default-700 hover:bg-default-100">
                                    <i class="ti ti-circle-filled scale-[.25] text-sm"></i>
                                    <img src="<?php echo e($service->image); ?>" width="24" height="24" alt="<?php echo e($service->name); ?>" class="h-6 w-6">
                                    <span class="font-semibold"><?php echo e(ucwords($service->name)); ?></span>
                                </a>
                            </li>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ul>
<?php if(Auth::check()): ?>
            <div class="mt-2">
                <div class="-mb-4 flex flex-col items-center justify-center rounded-t-full border border-b-0 border-dashed border-primary-500/40 bg-primary-500/20 bg-cover bg-no-repeat px-4 pb-4 pt-10 text-center text-sm text-default-700" href="javascript:void(0)">
                    <div class="relative inline-flex h-16 w-16 items-center justify-center rounded-full border border-dashed border-primary bg-primary/20">
                        <img src="https://cdn-icons-png.flaticon.com/512/539/539549.png" alt="" class="absolute start-1/2 top-1/2 h-8 w-8 -translate-x-1/2 -translate-y-1/2" />
                    </div>
                    <p class="my-4 text-sm font-semibold text-primary-700">
                        🔥Nâng cấp tài khoản để nhận nhiều ưu đãi!
                    </p>
                    <a href="<?php echo e(route('account.services')); ?>" target="_blank" class="inline-flex items-center justify-center gap-2 rounded-full bg-primary px-4 py-2 text-sm font-medium text-white transition-all hover:bg-primary-600">
                        <i class="ti ti-brand-cashapp text-xl"></i>
                        Nâng cấp
                    </a>
                </div>
            </div>
<?php else: ?>
            <div class="mt-2">
                <div class="-mb-4 flex flex-col items-center justify-center rounded-t-full border border-b-0 border-dashed border-primary-500/40 bg-primary-500/20 bg-cover bg-no-repeat px-4 pb-4 pt-10 text-center text-sm text-default-700" href="javascript:void(0)">
                    <div class="relative inline-flex h-16 w-16 items-center justify-center rounded-full border border-dashed border-primary bg-primary/20">
                        <img src="https://cdn-icons-png.flaticon.com/512/539/539549.png" alt="" class="absolute start-1/2 top-1/2 h-8 w-8 -translate-x-1/2 -translate-y-1/2" />
                    </div>
                    <p class="my-4 text-sm font-semibold text-primary-700">
                        🔥Bạn chưa đăng nhập!
                    </p>
                    <a href="<?php echo e(route('login')); ?>" class="inline-flex items-center justify-center gap-2 rounded-full bg-primary px-4 py-2 text-sm font-medium text-white transition-all hover:bg-primary-600">
                        <i class="ti ti-brand-cashapp text-xl"></i>
                        Đăng nhập
                    </a>
                </div>
            </div>
<?php endif; ?>
        </div>
    </div>
    <div id="mobile-menu" class="hs-overlay fixed left-0 top-0 z-60 hidden h-full w-full max-w-[270px] -translate-x-full transform border-e border-e-default-200 bg-white transition-all hs-overlay-open:translate-x-0 dark:bg-default-50" tabindex="-1">
        <div class="flex h-16 items-center justify-center border-b border-dashed border-b-default-200 transition-all duration-300">
            <a href="<?php echo e(route('home')); ?>">
                <img src="" class="flex h-10 dark:hidden lg:h-12"  />
                <img src="" class="hidden h-10 dark:flex lg:h-12"  />
            </a>
        </div>
        <div data-simplebar class="h-[calc(100%-4rem)] overflow-y-auto">
            <nav class="hs-accordion-group flex w-full flex-col flex-wrap p-4">
            
            </nav>
        </div>
    </div>
    <div class="min-h-screen flex flex-col lg:ps-64 w-full">
        <div id="search-drawer" class="hs-overlay fixed inset-x-0 bottom-0 z-60 hidden h-full w-full max-w-full translate-y-full transform bg-white transition-all duration-300 hs-overlay-open:translate-y-0 dark:bg-default-50" tabindex="-1">
            <div class="flex h-16 items-center justify-between gap-4 border-b border-dashed border-default-200 px-4 transition-all duration-300">
                <button type="button" class="inline-flex h-10 w-10 flex-shrink-0 items-center justify-center gap-2 rounded-full bg-default-100 align-middle font-medium text-default-700 transition-all hover:text-primary" data-hs-overlay="#search-drawer">
                    <i class="ti ti-x text-xl"></i>
                </button>
                 <form class="relative mx-auto flex w-full">
            <input id="data-input" type="search" placeholder="Search for items..." class="w-full rounded-lg border-none bg-default-100 py-3 pe-6 ps-12 text-sm text-default-900 transition placeholder:text-default-600 focus:outline-none focus:ring-transparent" />
            <button type="button" aria-label="Click here to search input data" class="absolute inset-y-0 start-2 z-10 flex h-full w-10 shrink-0 cursor-default items-center justify-center focus:outline-none">
                <i data-lucide="search" class="h-6 w-6"></i>
            </button>
        </form>
    </div>

    <div class="">
        <div class="p-4 lg:p-8">
            <h4 class="text-base font-medium text-default-900">Recent</h4>
        </div>
        <div class="mb-4 px-4 pb-4">
            <div class="flex flex-col gap-2">
                <div id="close" class="flex items-center gap-2 rounded-md bg-default-100 px-4 py-3">
                    <i class="ti ti-clock shrink text-lg text-default-700"></i>
                    <span class="inline-block grow text-base font-medium text-default-700 transition-all hover:text-default-900">Fruits</span>
                    <div class="flex items-center gap-2">
                      <a href="#">
                          <i class="ti ti-arrow-up-right-circle align-middle text-lg text-default-700 transition-all hover:text-default-950"></i>
                      </a>
                      <span class="shrink" data-hs-remove-element="#close" role="button">
                          <i class="ti ti-x align-middle text-lg text-default-700 hover:text-red-500"></i>
                      </span>
                    </div>
                </div>
                <div id="close-two" class="flex items-center gap-2 rounded-md bg-default-100 px-4 py-3">
                    <i class="ti ti-clock shrink text-lg text-default-700"></i>
                    <span class="inline-block grow text-base font-medium text-default-700 transition-all hover:text-default-900">Fresh Vegetables</span>
                    <div class="flex items-center gap-2">
                      <a href="#">
                          <i class="ti ti-arrow-up-right-circle align-middle text-lg text-default-700 transition-all hover:text-default-950"></i>
                      </a>
                      <span class="shrink" data-hs-remove-element="#close-two" role="button">
                          <i class="ti ti-x align-middle text-lg text-default-700 hover:text-red-500"></i>
                      </span>
                    </div>
                </div>
                <div id="close-three" class="flex items-center gap-2 rounded-md bg-default-100 px-4 py-3">
                    <i class="ti ti-clock shrink text-lg text-default-700"></i>
                    <span class="inline-block grow text-base font-medium text-default-700 transition-all hover:text-default-900">Nuts And Berries</span>
                    <div class="flex items-center gap-2">
                      <a href="#">
                          <i class="ti ti-arrow-up-right-circle align-middle text-lg text-default-700 transition-all hover:text-default-950"></i>
                      </a>
                      <span class="shrink" data-hs-remove-element="#close-three" role="button">
                          <i class="ti ti-x align-middle text-lg text-default-700 hover:text-red-500"></i>
                      </span>
                    </div>
                </div>
                <div id="close-four" class="flex items-center gap-2 rounded-md bg-default-100 px-4 py-3">
                    <i class="ti ti-clock shrink text-lg text-default-700"></i>
                    <span class="inline-block grow text-base font-medium text-default-700 transition-all hover:text-default-900">Best Instructors</span>
                    <div class="flex items-center gap-2">
                      <a href="#">
                          <i class="ti ti-arrow-up-right-circle align-middle text-lg text-default-700 transition-all hover:text-default-950"></i>
                      </a>
                      <span class="shrink" data-hs-remove-element="#close-four" role="button">
                          <i class="ti ti-x align-middle text-lg text-default-700 hover:text-red-500"></i>
                      </span>
                    </div>
                </div>
                <div id="close-five" class="flex items-center gap-2 rounded-md bg-default-100 px-4 py-3">
                    <i class="ti ti-clock shrink text-lg text-default-700"></i>
                    <span class="inline-block grow text-base font-medium text-default-700 transition-all hover:text-default-900">Contact</span>
                    <div class="flex items-center gap-2">
                      <a href="#">
                          <i class="ti ti-arrow-up-right-circle align-middle text-lg text-default-700 transition-all hover:text-default-950"></i>
                      </a>
                      <span class="shrink" data-hs-remove-element="#close-five">
                          <i class="ti ti-x align-middle text-lg text-default-700 hover:text-red-500"></i>
                      </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

    <div class="menu fixed inset-x-0 bottom-0 z-40 lg:hidden">
        <?php if(Auth::check()): ?>
        <div class="grid h-16 w-full grid-cols-4 items-center border border-default-200 bg-white dark:bg-default-50">
            
            <a class="flex flex-col items-center justify-center gap-1 text-default-600 active" href="<?php echo e(route('home')); ?>">
                <i class="ti ti-smart-home text-xl"></i>
                <span class="text-xs font-medium tracking-wide sm:text-sm">Trang chủ</span>
            </a>
            <a class="flex flex-col items-center justify-center gap-1 text-default-600" href="<?php echo e(route('account.recharge')); ?>">
                <i class="ti ti-wallet text-xl"></i>
                <span class="text-xs font-medium tracking-wide sm:text-sm">Nạp tiền</span>
            </a>
            <a class="flex flex-col items-center justify-center gap-1 text-default-600" href="<?php echo e(route('account.profile')); ?>">
                <i class="ti ti-user-circle text-xl"></i>
                <span class="text-xs font-medium tracking-wide sm:text-sm">Tài khoản</span>
            </a>
            <a class="flex flex-col items-center justify-center gap-1 text-default-600" href="<?php echo e(route('logout')); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                <span class="text-xs font-medium tracking-wide sm:text-sm">Đăng xuất</span>
            </a>
        </div>
        <?php endif; ?>
    </div>

    <?php echo $__env->yieldContent('content'); ?>
    


    <?php echo site('script_footer'); ?>

     <footer class="mt-auto w-full border-t border-default-200 bg-white p-6 dark:bg-default-50 print:hidden">
        <div class="flex flex-wrap items-center justify-between gap-6">
            <p class="text-center font-semibold text-default-600 lg:text-start">
                Copyright © 20<?php echo e(date('y')); ?>. <a href="<?php echo e(siteValue('facebook')); ?>" target="_blank"><?php echo e(siteValue('name_site')); ?></a> - Social Media Marketing.</p></strong> 
            </p>

            <div class="flex justify-end gap-6 text-center">
                <a href="javascript:void(0)" class="font-semibold text-default-500">
                    Terms
                </a>
                <a href="javascript:void(0)" class="font-semibold text-default-500">
                    Privacy
                </a>
                <a href="javascript:void(0)" class="font-semibold text-default-500">
                    Cookies
                </a>
            </div>
        </div>
    </footer>
    <button class="fixed end-0 top-1/4 z-50" data-bs-toggle="tooltip" data-bs-placement="top" title="Hỗ trợ">
        <span class="relative inline-flex h-10 w-10 items-center justify-center gap-2 overflow-hidden rounded-s-xl bg-primary align-middle font-medium text-white transition-all hover:bg-primary-600" data-hs-overlay="#overlay-right">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.486 2 2 6.486 2 12v4.143C2 17.167 2.897 18 4 18h1a1 1 0 0 0 1-1v-5.143a1 1 0 0 0-1-1h-.908C4.648 6.987 7.978 4 12 4s7.352 2.987 7.908 6.857H19a1 1 0 0 0-1 1V18c0 1.103-.897 2-2 2h-2v-1h-4v3h6c2.206 0 4-1.794 4-4c1.103 0 2-.833 2-1.857V12c0-5.514-4.486-10-10-10"/></svg>
        <button type="button" Toggle right offcanvas></button>
            <div id="overlay-right" class="hs-overlay hs-overlay-open:translate-x-0 translate-x-full fixed top-0 right-0 transition-all duration-300 transform h-full max-w-xs w-full z-60 bg-white border-l border-default-200 dark:bg-default-50 hidden">
                <div class="flex justify-between items-center py-3 px-4 border-b border-default-200">
                    <h3 class="text-lg font-medium text-default-600">
                       Hỗ trợ
                    </h3>
                    <button type="button" class="hover:text-default-900" data-hs-overlay="#overlay-right">
                        <span class="sr-only">Close modal</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="x" class="lucide lucide-x h-6 w-6"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
                    </button>
                </div>
                <div class="grid xl:grid-cols-1 p-4">
                    <div class="border border-default-200 rounded-lg p-4 mt-4">
                    <a href="<?php echo e(siteValue('facebook')); ?>" target="_blank" class="text-default-900 font-semibold">Facebook hỗ trợ: <i><u><?php echo e(siteValue('facebook')); ?></u></i></a>
                    </div>
                    <div class="border border-default-200 rounded-lg p-4 mt-4">
                        <a href="<?php echo e(siteValue('zalo')); ?>" target="_blank" class="text-default-900 font-semibold">Zalo hỗ trợ: <i><u><?php echo e(siteValue('zalo')); ?></u></i></a>
                    </div>
                </div>
            </div>
        </span>
    </button>

        <script src="/main/js/sweetalert2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
        <script src="/asset-lamtilo/js/app.js"></script>
        <script src="/assets/js/ap.js?lamtilo-time=<?php echo e(time()); ?>"></script>
        <script src="/assets/js/lamtilo.js?lamtilo-time=<?php echo e(time()); ?>"></script>
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
    </body>
</html><?php /**PATH /home/seeding1/public_html/resources/views/guard/layouts/main.blade.php ENDPATH**/ ?>