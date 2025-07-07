
<?php $__env->startSection('title', 'Quản lí thông báo hệ thống'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-2">
                        <div class="card custom-card">
                            <nav class="nav nav-tabs flex-column nav-style-5 mb-3" role="tablist">
                                <a class="nav-link active mb-1" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab-1" aria-selected="true">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                        <path fill="currentColor" fill-rule="evenodd" d="M7.784 1.356a2.75 2.75 0 0 0-3.186 2.231l-2.43 13.787a2.75 2.75 0 0 0 2.23 3.186l11.818 2.084a2.75 2.75 0 0 0 3.185-2.23l2.432-13.788a2.75 2.75 0 0 0-2.231-3.186zM9.06 5.643A.75.75 0 1 0 8.8 7.12l7.878 1.39a.75.75 0 0 0 .26-1.478zm-1.563 4.548a.75.75 0 0 1 .869-.608l7.878 1.389a.75.75 0 1 1-.26 1.477l-7.879-1.39a.75.75 0 0 1-.608-.868m.174 3.33a.75.75 0 1 0-.26 1.477l4.924.869a.75.75 0 1 0 .26-1.478z" clip-rule="evenodd"/>
                                    </svg>
                                    Bài viết
                                </a>
                                <a class="nav-link mb-1" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab-2" aria-selected="false" tabindex="-1">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                        <circle cx="18" cy="6" r="3" fill="currentColor"></circle>
                                        <path fill="currentColor" d="M13 6c0-.712.153-1.387.422-2H6c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7.422A5 5 0 0 1 18 11a5 5 0 0 1-5-5"></path>
                                    </svg>
                                    Thông báo
                                </a>
                                <?php if(getDomain() == env('APP_MAIN_SITE')): ?>
                                <a class="nav-link mb-1" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab-3" aria-selected="false" tabindex="-1">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                        <path fill="currentColor" fill-rule="evenodd" d="M7.843 3.802C9.872 2.601 10.886 2 12 2s2.128.6 4.157 1.802l.686.406c2.029 1.202 3.043 1.803 3.6 2.792c.557.99.557 2.19.557 4.594v.812c0 2.403 0 3.605-.557 4.594s-1.571 1.59-3.6 2.791l-.686.407C14.128 21.399 13.114 22 12 22s-2.128-.6-4.157-1.802l-.686-.407c-2.029-1.2-3.043-1.802-3.6-2.791C3 16.01 3 14.81 3 12.406v-.812C3 9.19 3 7.989 3.557 7s1.571-1.59 3.6-2.792zM13 16a1 1 0 1 1-2 0a1 1 0 0 1 2 0m-1-9.75a.75.75 0 0 1 .75.75v6a.75.75 0 0 1-1.5 0V7a.75.75 0 0 1 .75-.75" clip-rule="evenodd"/>
                                    </svg>
                                    Thông báo khẩn
                                </a>
                                <?php endif; ?>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-10">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab-1" role="tabpanel">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <h5 class="card-title">Thêm bài viết</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo e(route('admin.notify.system.create')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="title" id="title" placeholder="Tiêu đề" value="<?php echo e(old('title')); ?>" required>
                                                <label for="title">Tiêu đề</label>
                                            </div>
                                            <div class="form-floating mb-3" hidden>
                                                <select name="color" id="color" class="form-select">
                                                    <option value="primary">Xanh dương</option>
                                                    <option value="secondary">Xám nhạt</option>
                                                    <option value="success">Xanh lá</option>
                                                    <option value="danger">Đỏ</option>
                                                    <option value="warning">Vàng</option>
                                                    <option value="info">Xanh nhạt</option>
                                                </select>
                                                <label for="color">Màu sắc</label>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="content">Nội dung</label>
                                                <textarea class="form-control" id="content" name="content" placeholder="Nội dung" style="height: 100px" value="<?php echo e(old('content')); ?>"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary w-100">Thêm bài viết</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <h5 class="card-title">Danh sách bài viết</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                                            <table id="data-table" class="table text-nowrap table-striped table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Thao tác</th>
                                                        <th>Người đăng</th>
                                                        <th>Tiêu đề</th>
                                                        <th>Nội dung</th>
                                                        <th>Màu sắc</th>
                                                        <th>Ngày tạo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $noticeSystems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($notification->id); ?></td>
                                                        <td>
                                                            <a href="<?php echo e(route('admin.notify.system.delete', ['id' => $notification->id])); ?>"
                                                                class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                        <td><?php echo e($notification->user->username); ?></td>
                                                        <td><?php echo e($notification->title); ?></td>
                                                        <td><?php echo $notification->content; ?></td>
                                                        <td><span class="badge bg-<?php echo e($notification->color); ?>"><?php echo e($notification->color); ?></span>
                                                        </td>
                                                        <td><?php echo e($notification->created_at); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-2" role="tabpanel">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <h5 class="card-title">Thông báo dịch vụ</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo e(route('admin.notify.service.create')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="title" id="title" placeholder="Tiêu đề" value="<?php echo e(old('title')); ?>" required>
                                                <label for="title">Tiêu đề</label>
                                            </div>
                                            <div class="form-floating mb-3" hidden>
                                                <select name="color" id="color" class="form-select">
                                                    <option value="primary">Xanh dương</option>
                                                    <option value="secondary">Xám nhạt</option>
                                                    <option value="success">Xanh lá</option>
                                                    <option value="danger">Đỏ</option>
                                                    <option value="warning">Vàng</option>
                                                    <option value="info">Xanh nhạt</option>
                                                </select>
                                                <label for="color">Màu sắc</label>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="content">Nội dung</label>
                                                <textarea class="form-control" id="content" name="content" placeholder="Nội dung" style="height: 100px" value="<?php echo e(old('content')); ?>"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary w-100">Thêm thông báo</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <h5 class="card-title">Danh sách thông báo</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                                            <table id="data-table-2" class="table text-nowrap table-striped table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Thao tác</th>
                                                        <th>Người đăng</th>
                                                        <th>Tiêu đề</th>
                                                        <th>Nội dung</th>
                                                        <th>Màu sắc</th>
                                                        <th>Ngày tạo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $noticeServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($notification->id); ?></td>
                                                        <td>
                                                            <a href="<?php echo e(route('admin.notify.service.delete', ['id' => $notification->id])); ?>"
                                                                class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                        <td><?php echo e($notification->user->username); ?></td>
                                                        <td><?php echo e($notification->title); ?></td>
                                                        <td><?php echo $notification->content; ?></td>
                                                        <td><span class="badge bg-<?php echo e($notification->color); ?>"><?php echo e($notification->color); ?></span>
                                                        </td>
                                                        <td><?php echo e($notification->created_at); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if(getDomain() == env('APP_MAIN_SITE')): ?>
                            <div class="tab-pane" id="tab-3" role="tabpanel">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <h5 class="card-title">Thông báo khẩn cấp</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle"></i> <strong>Lưu ý:</strong>
                                            Thông báo này sẽ hiển thị trong Admin tất cả các site con cháu, chút chít,...
                                        </div>
                                        <form action="<?php echo e(route('admin.website.setting')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <label for="urgent_notice">Nội dung</label>
                                                    <textarea class="form-control" id="urgent_notice" name="urgent_notice" placeholder="Nội dung" style="height: 100px"><?php echo e(configValue('urgent_notice')); ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary col-12">Lưu dữ liệu</button>
                                                </div>
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
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $('#data-table-2').DataTable();
    $('#jsource-table').DataTable({
        data: dataSet,
    });
</script>
<script src="/app/js/plugins/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        height: '400',
        selector: '#content, #urgent_notice',
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudgam/public_html/resources/views/admin/notification/index.blade.php ENDPATH**/ ?>