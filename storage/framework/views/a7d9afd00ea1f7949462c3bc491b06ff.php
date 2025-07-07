<?php $__env->startSection('title','Cấu hình hệ thống'); ?>
<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('admin.website.update')); ?>" method="POST" id="theme" hidden>
    <?php echo csrf_field(); ?> 
    <div class="row">
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Dynamic Pagination</div>
                </div>
                <div class="card-body">
                    <div class="zoom-img">
                        <img src="https://cdn.nmhpanel.com/imgs/theme-Default.png?v=5" alt="">
                        <button type="button" class="btn btn-sm btn-primary-gradient" onclick="applyLanding(1)">Áp dụng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-2">
                        <div class="card custom-card">
                            <nav class="nav nav-tabs flex-column nav-style-5 mb-3" role="tablist">
                                <a class="nav-link active mb-1" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab-1" aria-selected="true">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 496 512">
                                        <path fill="currentColor" d="M88 216c81.7 10.2 273.7 102.3 304 232H0c99.5-8.1 184.5-137 88-232m32-152c32.3 35.6 47.7 83.9 46.4 133.6C249.3 231.3 373.7 321.3 400 448h96C455.3 231.9 222.8 79.5 120 64"/>
                                    </svg>
                                    Dịch vụ
                                </a>
                                <a class="nav-link mb-1" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab-2" aria-selected="false" tabindex="-1">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 1024 1024" style="fill: currentColor;">
                                        <path d="M79.36 432.256L591.744 944.64a32 32 0 0 0 35.2 6.784l253.44-108.544a32 32 0 0 0 9.984-52.032l-153.856-153.92a32 32 0 0 0-36.928-6.016l-69.888 34.944L358.08 394.24l35.008-69.888a32 32 0 0 0-5.952-36.928L233.152 133.568a32 32 0 0 0-52.032 10.048L72.512 397.056a32 32 0 0 0 6.784 35.2zm60.48-29.952l81.536-190.08L325.568 316.48l-24.64 49.216l-20.608 41.216l32.576 32.64l271.552 271.552l32.64 32.64l41.216-20.672l49.28-24.576l104.192 104.128l-190.08 81.472zM512 320v-64a256 256 0 0 1 256 256h-64a192 192 0 0 0-192-192m0-192V64a448 448 0 0 1 448 448h-64a384 384 0 0 0-384-384"/>
                                    </svg>
                                    Liên hệ
                                </a>
                                <a class="nav-link mb-1" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab-3" aria-selected="false" tabindex="-1">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M8 3a7 7 0 0 0 0 14h1.07a7 7 0 0 1 0-2H8A5 5 0 0 1 8 5h8a5 5 0 0 1 4.9 6a7 7 0 0 1 1.426 2A7 7 0 0 0 16 3zm3 13a5 5 0 1 1 9.172 2.757l2.535 2.536l-1.414 1.414l-2.536-2.535A5 5 0 0 1 11 16"/>
                                    </svg>
                                    SEO Website
                                </a>
                                <a class="nav-link mb-1" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab-4" aria-selected="false" tabindex="-1">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                        <circle cx="18" cy="6" r="3" fill="currentColor"/>
                                        <path fill="currentColor" d="M13 6c0-.712.153-1.387.422-2H6c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7.422A5 5 0 0 1 18 11a5 5 0 0 1-5-5"/>
                                    </svg>
                                    Thông báo
                                </a>
                                <a class="nav-link mb-1" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab-5" aria-selected="false" tabindex="-1">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M15.22 4.75L7.87 7.79l4.96 11.96l7.35-3.05zM11 10c-.55 0-1-.45-1-1s.45-1 1-1s1 .45 1 1s-.45 1-1 1" opacity="0.3"/>
                                        <path fill="currentColor" d="m3.87 11.18l-2.43 5.86c-.41 1.02.08 2.19 1.09 2.61l1.34.56zm18.16 4.77L17.07 3.98a2.01 2.01 0 0 0-1.81-1.23c-.26 0-.53.04-.79.15L7.1 5.95a2 2 0 0 0-1.08 2.6l4.96 11.97a2 2 0 0 0 2.6 1.08l7.36-3.05a1.994 1.994 0 0 0 1.09-2.6m-9.2 3.8L7.87 7.79l7.35-3.04h.01l4.95 11.95z"/>
                                        <circle cx="11" cy="9" r="1" fill="currentColor"/>
                                        <path fill="currentColor" d="m9.33 21.75l-3.45-8.34v6.34c0 1.1.9 2 2 2z"/>
                                    </svg>
                                    Giao diện
                                </a>
                                <a class="nav-link mb-1" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab-6" aria-selected="false" tabindex="-1">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="m3 2l1.578 17.834L12 22l7.468-2.165L21 2zm13.3 14.722l-4.293 1.204H12l-4.297-1.204l-.297-3.167h2.108l.15 1.526l2.335.639l2.34-.64l.245-3.05h-7.27l-.187-2.006h7.64l.174-2.006H6.924l-.176-2.006h10.506z"/>
                                    </svg>
                                    CSS/JS
                                </a>
                                <a class="nav-link mb-1" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab-7" aria-selected="false" tabindex="-1">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M17.688 21.744a2.02 2.02 0 0 1-1.242-.427l-4.03-3.122l-2.702 2.983a1 1 0 0 1-1.698-.383l-2.02-6.682l-3.626-1.26a2.042 2.042 0 0 1-.103-3.818L20.187 1.8a2.042 2.042 0 0 1 2.771 2.295L19.695 20.11a2.054 2.054 0 0 1-2.008 1.633Z" opacity="0.5"/>
                                        <path fill="currentColor" d="M8.973 21.506a1 1 0 0 1-.957-.71l-2.168-7.16a1 1 0 0 1 .495-1.176L16.91 6.958a1 1 0 0 1 1.17 1.594l-7.084 7.083l-1.044 5.072a1 1 0 0 1-.933.798z"/>
                                    </svg>
                                    Telegram
                                </a>
                                <a class="nav-link mb-1" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab-8" aria-selected="false" tabindex="-1">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 48 48">
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
                                    Kết nối
                                </a>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-10">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab-1" role="tabpanel">
                                <div class="">
                                    <div class="card-header">
                                        <h5 class="card-title">Dịch vụ</h5>
                                    </div>
                                    <div class="mt-3">
                                        <form action="<?php echo e(route('admin.website.update')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3">
                                                        <select name="maintain" id="maintain" class="form-select">
                                                        <option value="off"
                                                        <?php echo e(siteValue('maintain') == 'off' ? 'selected' : ''); ?>>Tắt
                                                        </option>
                                                        <option value="on"
                                                        <?php echo e(siteValue('maintain') == 'on' ? 'selected' : ''); ?>>Bật
                                                        </option>
                                                        </select>
                                                        <label for="logo">Bảo trì dịch vụ</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="madon" name="madon"
                                                            placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('madon')); ?>">
                                                        <label for="madon">Cấu hình mã đơn</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3">
                                                        <select name="confirm_payment" id="confirm_payment" class="form-select">
                                                        <option value="on"
                                                        <?php echo e(siteValue('confirm_payment') == 'on' ? 'selected' : ''); ?>>Bật
                                                        </option>
                                                        <option value="off"
                                                        <?php echo e(siteValue('confirm_payment') == 'off' ? 'selected' : ''); ?>>Tắt
                                                        </option>
                                                        </select>
                                                        <label for="confirm_payment">Xác nhận khi thanh toán</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="collaborator" name="collaborator" placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('collaborator')); ?>">
                                                        <label for="collaborator">Mức nạp Cộng Tác Viên</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="agency" name="agency" placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('agency')); ?>">
                                                        <label for="agency">Mức nạp Đại Lý</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="distributor" name="distributor" placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('distributor')); ?>">
                                                        <label for="distributor">Mức nạp Nhà Phân Phối</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control " name="price" value="<?php echo e(siteValue('price')); ?>" placeholder="Name">
                                                        <label><span class=" ps-3">Chiết khấu thành viên</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control " name="price_collaborator" value="<?php echo e(siteValue('price_collaborator')); ?>" placeholder="Name">
                                                        <label><span class=" ps-3">Chiết khấu CTV</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control " name="price_agency" value="<?php echo e(siteValue('price_agency')); ?>" placeholder="Name">
                                                        <label><span class=" ps-3">Chiết khấu đại lý</span></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control " name="price_distributor" value="<?php echo e(siteValue('price_distributor')); ?>" placeholder="Name">
                                                        <label><span class=" ps-3">Chiết khấu nhà phân phối</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary-gradient col-12">Lưu dữ liệu</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-2" role="tabpanel">
                                <div>
                                    <div class="card-header">
                                        <h5 class="card-title">Liên hệ</h5>
                                    </div>
                                    <div class="mt-3">
                                        <form id="website-update" action="<?php echo e(route('admin.website.update')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="nameadmin" name="nameadmin"
                                                            placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('nameadmin')); ?>">
                                                        <label for="nameadmin">Tên admin</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="avatar_admin" name="avatar_admin"
                                                            placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('avatar_admin')); ?>">
                                                        <label for="avatar_admin">Avatar Admin</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="facebook" name="facebook"
                                                            placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('facebook')); ?>">
                                                        <label for="facebook">Facebook</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="Zalo" name="Zalo"
                                                            placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('zalo')); ?>">
                                                        <label for="Zalo">Zalo</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="telegram" name="telegram"
                                                            placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('telegram')); ?>">
                                                        <label for="telegram">telegram</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary-gradient col-12">Lưu dữ liệu</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane text-muted" id="tab-3" role="tabpanel">
                                <div>
                                    <div class="card-header">
                                        <h5 class="card-title">Seo Website</h5>
                                    </div>
                                    <div class="mt-3">
                                        <form action="<?php echo e(route('admin.website.update')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="name_site" name="name_site"
                                                    placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('name_site')); ?>">
                                                <label for="name_site">Tên website</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="title" name="title"
                                                    placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('title')); ?>">
                                                <label for="title">Tiêu đề</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="description" name="description"
                                                    placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('description')); ?>">
                                                <label for="description">Mô tả</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="keywords" name="keywords"
                                                    placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('keywords')); ?>">
                                                <label for="keywords">Từ khoá</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="author" name="author"
                                                    placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('author')); ?>">
                                                <label for="author">Author</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="thumbnail" name="thumbnail"
                                                    placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('thumbnail')); ?>">
                                                <label for="thumbnail">Thumbnail</label>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary-gradient col-12">Lưu dữ liệu</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane text-muted" id="tab-4" role="tabpanel">
                                <div>
                                    <div class="card-header">
                                        <h5 class="card-title">Thông báo</h5>
                                    </div>
                                    <div class="mt-3">
                                        <form action="<?php echo e(route('admin.website.update')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-group mb-3">
                                                <label for="notice">Thông báo hệ Nổi</label>
                                                <input type="text" class="form-control" id="notice" name="notice"
                                                    placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('notice')); ?>">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary-gradient col-12">Lưu dữ liệu</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane text-muted" id="tab-5" role="tabpanel">
                                <div>
                                    <div class="card-header">
                                        <h5 class="card-title">Giao diện</h5>
                                    </div>
                                    <div class="mt-3">
                                        <form action="<?php echo e(route('admin.website.update')); ?>" method="POST">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-floating mb-3">
                                                        <select name="status_massorder" id="status_massorder" class="form-select">
                                                        <option value="on"
                                                        <?php echo e(siteValue('status_massorder') == 'on' ? 'selected' : ''); ?>>Hiện
                                                        </option>
                                                        <option value="off"
                                                        <?php echo e(siteValue('status_massorder') == 'off' ? 'selected' : ''); ?>>Ẩn
                                                        </option>
                                                        </select>
                                                        <label for="status_massorder">Đặt hàng số lượng lớn</label>
                                                    </div>
                                                </div>
                                                <!--
                                                    <?php if(getDomain() == env('APP_MAIN_SITE')): ?>
                                                    <div class="col-md-3">
                                                        <div class="form-floating mb-3">
                                                            <select name="status_smm" id="status_smm" class="form-select">
                                                                <option value="on"
                                                                    <?php echo e(siteValue('status_smm') == 'on' ? 'selected' : ''); ?>>Hiện
                                                                </option>
                                                                <option value="off"
                                                                    <?php echo e(siteValue('status_smm') == 'off' ? 'selected' : ''); ?>>Ẩn
                                                                </option>
                                                            </select>
                                                            <label for="status_services">Đặt dịch vụ V2</label>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="col-md-3">
                                                        <div class="form-floating mb-3">
                                                            <select name="status_services" id="status_services" class="form-select">
                                                                <option value="on"
                                                                    <?php echo e(siteValue('status_services') == 'on' ? 'selected' : ''); ?>>Hiện
                                                                </option>
                                                                <option value="off"
                                                                    <?php echo e(siteValue('status_services') == 'off' ? 'selected' : ''); ?>>Ẩn
                                                                </option>
                                                            </select>
                                                            <label for="status_services">Hiện dịch vụ ở trang chủ</label>
                                                        </div>
                                                    </div>
                                                    -->
                                                <div class="col-md-3">
                                                    <div class="form-floating mb-3">
                                                        <select name="theme_admin" id="theme_admin" class="form-select">
                                                            <option>-- Chọn màu --</option>
                                                            <option value="1"
                                                            <?php echo e(siteValue('theme_admin') == '1' ? 'selected' : ''); ?>>Xanh Biển
                                                            </option>
                                                            <option value="2"
                                                            <?php echo e(siteValue('theme_admin') == '2' ? 'selected' : ''); ?>>Tím đậm
                                                            </option>
                                                            <option value="3"
                                                            <?php echo e(siteValue('theme_admin') == '3' ? 'selected' : ''); ?>>Tím
                                                            </option>
                                                            <option value="4"
                                                            <?php echo e(siteValue('theme_admin') == '4' ? 'selected' : ''); ?>>Hồng
                                                            </option>
                                                            <option value="5"
                                                            <?php echo e(siteValue('theme_admin') == '5' ? 'selected' : ''); ?>>Đỏ
                                                            </option>
                                                            <option value="6"
                                                            <?php echo e(siteValue('theme_admin') == '6' ? 'selected' : ''); ?>>Cam đậm
                                                            </option>
                                                            <option value="7"
                                                            <?php echo e(siteValue('theme_admin') == '7' ? 'selected' : ''); ?>>Cam nhạt
                                                            </option>
                                                            <option value="8"
                                                            <?php echo e(siteValue('theme_admin') == '8' ? 'selected' : ''); ?>>Xanh Lục
                                                            </option>
                                                            <option value="9"
                                                            <?php echo e(siteValue('theme_admin') == '9' ? 'selected' : ''); ?>>Xanh Lá Mạ
                                                            </option>
                                                            <option value="10"
                                                            <?php echo e(siteValue('theme_admin') == '10' ? 'selected' : ''); ?>>Xanh lam
                                                            </option>
                                                        </select>
                                                        <label for="theme_admin">Chọn theme Admin</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating mb-3">
                                                        <select name="landing" id="landing" class="form-select">
                                                            <option value="">-- Chọn Landing --</option>
                                                            <option value="off"
                                                            <?php echo e(siteValue('landing') == 'off' ? 'selected' : ''); ?>>Ẩn Landing
                                                            </option>
                                                            <option value="0"
                                                            <?php echo e(siteValue('landing') == '0' ? 'selected' : ''); ?>>Mặc định
                                                            </option>
                                                            <option value="1"
                                                            <?php echo e(siteValue('landing') == '1' ? 'selected' : ''); ?>>Landing 1
                                                            </option>
                                                            <option value="2"
                                                            <?php echo e(siteValue('landing') == '2' ? 'selected' : ''); ?>>Landing 2
                                                            </option>
                                                            <option value="3"
                                                            <?php echo e(siteValue('landing') == '3' ? 'selected' : ''); ?>>Landing 3
                                                            </option>
                                                            <option value="4"
                                                            <?php echo e(siteValue('landing') == '4' ? 'selected' : ''); ?>>Landing 4
                                                            </option>
                                                        </select>
                                                        <label for="landing">Landing website</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Mặc định -->
                                                <div class="col-lg-2 col-sm-6 text-center">
                                                    <div class="card overlay overflow-hidden">
                                                        <div class="mt-3 p-0">
                                                            <div class="overlay-wrapper">
                                                                <img src="/main/images/landing0.png" class="w-100 rounded">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="mt-3">Mặc định</h4>
                                                </div>
                                                <!-- Tùy chọn 1 -->
                                                <div class="col-lg-2 col-sm-6 text-center">
                                                    <div class="card overlay overflow-hidden">
                                                        <div class="mt-3 p-0">
                                                            <div class="overlay-wrapper">
                                                                <img src="https://cdn.nmhpanel.com/imgs/theme-Default.png?v=5" class="w-100 rounded">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="mt-3">1</h4>
                                                </div>
                                                <!-- Tùy chọn 2 -->
                                                <div class="col-lg-2 col-sm-6 text-center">
                                                    <div class="card overlay overflow-hidden">
                                                        <div class="mt-3 p-0">
                                                            <div class="overlay-wrapper">
                                                                <img src="https://cdn.nmhpanel.com/imgs/theme-2.png?v=5" class="w-100 rounded">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="mt-3">2</h4>
                                                </div>
                                                <!-- Tùy chọn 3 -->
                                                <div class="col-lg-2 col-sm-6 text-center">
                                                    <div class="card overlay overflow-hidden">
                                                        <div class="mt-3 p-0">
                                                            <div class="overlay-wrapper">
                                                                <img src="https://cdn.nmhpanel.com/imgs/theme-3.png?v=5" class="w-100 rounded">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="mt-3">3</h4>
                                                </div>
                                                <!-- Tùy chọn 4 -->
                                                <div class="col-lg-2 col-sm-6 text-center">
                                                    <div class="card overlay overflow-hidden">
                                                        <div class="mt-3 p-0">
                                                            <div class="overlay-wrapper">
                                                                <img src="https://cdn.nmhpanel.com/imgs/theme-5.png?v=5" class="w-100 rounded">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h4 class="mt-3">4</h4>
                                                </div>
                                            </div>
                                            <?php echo csrf_field(); ?>
                                            <!--
                                                <div class="form-floating mb-3">
                                                     <select name="theme" id="theme" class="form-select">
                                                                <option value="">-- Chọn màu --</option>
                                                                <option value="dark"
                                                                    <?php echo e(siteValue('theme') == 'dark' ? 'selected' : ''); ?>>Tối
                                                                </option>
                                                                <option value="light"
                                                                    <?php echo e(siteValue('theme') == 'light' ? 'selected' : ''); ?>>Sáng
                                                                </option>
                                                            </select>
                                                    <label for="logo">Màu website</label>
                                                </div>
                                                -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="logo" name="logo" placeholder="Nhập dữ liệu"
                                                            value="<?php echo e(siteValue('logo')); ?>">
                                                        <label for="logo">Logo</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="favicon" name="favicon"
                                                            placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('favicon')); ?>">
                                                        <label for="favicon">Favicon</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary-gradient col-12">Lưu dữ liệu</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane text-muted" id="tab-6" role="tabpanel">
                                <div>
                                    <div class="card-header">
                                        <h5 class="card-title">CSS/JS</h5>
                                    </div>
                                    <div class="mt-3">
                                        <form action="<?php echo e(route('admin.website.update')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" id="script_head" name="script_head"
                                                            style="height: 150px;"
                                                            placeholder="Nhập dữ liệu"><?php echo e(siteValue('script_head')); ?></textarea>
                                                        <label for="script_head">Script head</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" id="script_body" name="script_body"
                                                            style="height: 150px;"
                                                            placeholder="Nhập dữ liệu"><?php echo e(siteValue('script_body')); ?></textarea>
                                                        <label for="scipt_body">Script Body</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" id="script_footer" name="script_footer"
                                                            style="height: 150px;"
                                                            placeholder="Nhập dữ liệu"><?php echo e(siteValue('script_footer')); ?></textarea>
                                                        <label for="script_footer">Script Footer</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary-gradient col-12">Lưu dữ liệu</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane text-muted" id="tab-7" role="tabpanel">
                                <div>
                                    <div class="card-header">
                                        <h5 class="card-title">Cấu hình Telegram</h5>
                                    </div>
                                    <div class="mt-3">
                                        <form action="<?php echo e(route('admin.website.update')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5 class="mb-3">Cấu hình Bot Thông báo</h5>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="telegram_bot_token"
                                                            name="telegram_bot_token" placeholder="Nhập dữ liệu"
                                                            value="<?php echo e(siteValue('telegram_bot_token')); ?>">
                                                        <label for="telegram_bot_token">Token Bot</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="telegram_chat_id" name="telegram_chat_id"
                                                            placeholder="Nhập dữ liệu" value="<?php echo e(siteValue('telegram_chat_id')); ?>">
                                                        <label for="telegram_chat_id">Chat ID</label>
                                                    </div>
                                                    <?php if(getDomain() == env('APP_MAIN_SITE')): ?>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="telegram_chat_id_dontay" name="telegram_chat_id_dontay"
                                                            placeholder="Nhập dữ liệu" value="<?php echo e(site('telegram_chat_id_dontay')); ?>">
                                                        <label for="telegram_chat_id_dontay">Chat ID nhận đơn tay</label>
                                                    </div>
                                                    <div class="form-floating mb-3" hidden>
                                                        <input type="text" class="form-control" id="telegram_chat_id_box" name="telegram_chat_id_box"
                                                            placeholder="Nhập dữ liệu" value="<?php echo e(site('telegram_chat_id_box')); ?>">
                                                        <label for="telegram_chat_id_box">Chat ID nhận thông báo cập nhật giá</label>
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="telegram_bot_username"
                                                            name="telegram_bot_username" placeholder="Nhập dữ liệu"
                                                            value="<?php echo e(siteValue('telegram_bot_username')); ?>">
                                                        <label for="telegram_bot_username">Username Bot</label>
                                                    </div>
                                                    <div class="">
                                                        <button type="submit" class="btn btn-primary-gradient">Lưu cấu hình</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5 class="mb-3">Cấu hình Bot Chat</h5>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="telegram_bot_chat_token"
                                                            name="telegram_bot_chat_token" placeholder="Nhập dữ liệu"
                                                            value="<?php echo e(siteValue('telegram_bot_chat_token')); ?>">
                                                        <label for="telegram_bot_chat_token">Token Bot</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="telegram_bot_chat_id"
                                                            name="telegram_bot_chat_id" placeholder="Nhập dữ liệu"
                                                            value="<?php echo e(siteValue('telegram_bot_chat_id')); ?>">
                                                        <label for="telegram_bot_chat_id">Chat ID</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="telegram_bot_chat_username"
                                                            name="telegram_bot_chat_username" placeholder="Nhập dữ liệu"
                                                            value="<?php echo e(siteValue('telegram_bot_chat_username')); ?>">
                                                        <label for="telegram_bot_chat_username">Username Bot</label>
                                                    </div>
                                                    <div class="">
                                                        <button type="button" class="btn btn-primary" id="btn-setWebhook">Set Webhook</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="tab-pane text-muted" id="tab-8" role="tabpanel">
                                <div>
                                    <div class="card-header">
                                        <h5 class="card-title">Kết nối API</h5>
                                    </div>
                                    <div class="mt-3">
                                        <?php if(getDomain() == env('APP_MAIN_SITE')): ?>
                                        <form action="<?php echo e(route('admin.website.setting')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="api_deposit"
                                                            name="api_deposit" placeholder="Nhập dữ liệu"
                                                            value="<?php echo e(configValue('api_deposit')); ?>">
                                                        <label for="api_deposit">API kiểm tra lịch sử nạp</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="api_recharge_card"
                                                            name="api_recharge_card" placeholder="Nhập dữ liệu"
                                                            value="<?php echo e(configValue('api_recharge_card')); ?>">
                                                        <label for="api_recharge_card">API đổi thẻ</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary-gradient">Lưu dữ liệu</button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php else: ?>
                                        <form action="<?php echo e(route('admin.website.update')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="api_deposit"
                                                            name="api_deposit" placeholder="Nhập dữ liệu"
                                                            value="<?php echo e(siteValue('api_deposit')); ?>">
                                                        <label for="api_deposit">API kiểm tra lịch sử nạp</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary-gradient col-12">Lưu dữ liệu</button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
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
        $('#btn-setWebhook').click(function() {
            $.ajax({
                url: "<?php echo e(route('admin.telegram.set-webhook')); ?>",
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    $('#btn-setWebhook').html('Đang xử lý...');
                },
                complete: function() {
                    $('#btn-setWebhook').html('Set Webhook');
                },
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công',
                            text: response.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Thất bại',
                            text: response.message,
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Thất bại',
                        text: 'Có lỗi xảy ra, vui lòng thử lại sau',
                    });
                }
            });
        });
    });
</script>
<script src="/app/js/plugins/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        height: '400',
        selector: '#notice',
        content_style: 'body { font-family: "Inter", sans-serif; }',
        menubar: false,
        toolbar: [
            'styleselect fontselect fontsizeselect',
            'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
            'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'
        ],
        plugins: 'advlist autolink link image lists charmap print preview code'
    });
</script>
<script>
function applyLanding(id) {
    var landingInput = document.getElementById('landing');
    landingInput.value = id;
    Swal.fire({
        title: 'Thành công!',
        text: 'Cập nhật landing ' + landingInput.value,
        icon: 'success',
        confirmButtonText: 'Đồng ý',
        timer: 1000,
        showConfirmButton: false, 
        willClose: () => {
            document.getElementById('theme').submit(); 
        }
    });
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dailysie/khosubvip.top/resources/views/admin/website/config.blade.php ENDPATH**/ ?>