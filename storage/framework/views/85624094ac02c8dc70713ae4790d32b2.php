<?php $__env->startSection('title', 'Hỗ trợ Ticket'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center gap-3">
                    <h5 class="card-title">Hỗ trợ Ticket</h5>
                </div>
            </div>
            <div class="card-body pc-component">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home"
                            role="tab" aria-controls="pills-home" aria-selected="true">Danh sách
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile"
                            role="tab" aria-controls="pills-profile" aria-selected="false" tabindex="-1">Tạo mới
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <form action="" class="mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" name="search" id="search"
                                            placeholder="Tìm kiếm">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <select class="form-select" name="replied_status" id="replied_status">
                                            <option value="">Trạng thái</option>
                                            <option value="">Tất cả</option>
                                            <option value="0">Chưa xử lý</option>
                                            <option value="1">Đang xử lý</option>
                                            <option value="2">Đã xử lý</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered nowrap dataTable">
                                <thead>
                                    <tr >
                                        <th>#</th>
                                        <!-- <th>Thao tác</th> -->
                                        <th>Tiêu đề</th>
                                        <th>Nội dung</th>
                                        <th>Độ ưu tiên</th>
                                        <th>Nội dung phản hồi</th>
                                        <th>Trạng thái</th>
                                        <th>Thời gian tạo</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold">
                                    <?php if($ticket->isEmpty()): ?>
                                    <?php echo $__env->make('admin.components.table-search-not-found', [
                                    'colspan' => 8,
                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php else: ?>
                                    <?php $__currentLoopData = $ticket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tickets): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($tickets->id); ?></td>
                                        <!-- <td>
                                            <a href="<?php echo e(route('ticket.edit', ['id' => $tickets->id])); ?>"
                                                class="btn btn-sm btn-success"
                                                data-bs-toggle="tooltip" title="Xem chi tiết">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            
                                            </td> -->
                                        <td>
                                            <?php echo e($tickets->title); ?>

                                        </td>
                                        <td>
                                            <?php echo $tickets->body; ?>

                                        </td>
                                        <td><?php echo e($tickets->level); ?></td>
                                        <td>
                                            <?php echo $tickets->reply; ?>

                                        </td>
                                        <td><?php echo statusTicket($tickets->status); ?></td>
                                        <td><?php echo e($tickets->created_at->diffForHumans()); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center align-items-center">
                                <?php echo e($ticket->appends(request()->all())->links('pagination::bootstrap-4')); ?>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <form action="<?php echo e(route('ticket.post')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="title"
                                    placeholder="Tiêu đề" value="<?php echo e(old('title')); ?>">
                                <label for="title">Tiêu đề</label>
                            </div>
                            <div class="form-floating mb-3">
                                <label for="body">Nội dung </label>
                                <textarea class="form-control" id="body" name="body" placeholder="Nội dung" style="height: 100px"></textarea>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-control" name="level">
                                    <option value="Thấp">Thấp</option>
                                    <option value="Trung Bình">Trung Bình</option>
                                    <option value="Cao">Cao</option>
                                    <option value="Khẩn Cấp">Khẩn Cấp</option>
                                </select>
                                <label for="level">Độ Ưu Tiên</label>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary col-12">
                                <i class="fas fa-save"></i> Tạo ticket
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="/assets/js/plugins/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        height: '400',
        selector: '#body',
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
<?php echo $__env->make('guard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seeding1/public_html/resources/views/guard/ticket.blade.php ENDPATH**/ ?>