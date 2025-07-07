<?php $__env->startSection('title', 'Danh sách dịch vụ & nền tảng'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">Danh sách nền tảng</h5>
            </div>
            <div class="card-body">
                <div class="form-group d-flex justify-content-between align-items-center gap-2 mb-3">
                    <a href="<?php echo e(route('admin.service.platform')); ?>" class="btn btn-primary-gradient">
                        <svg class="fs-2" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M4 20v-2h2.75l-.4-.35q-1.225-1.225-1.787-2.662T4 12.05q0-2.775 1.663-4.937T10 4.25v2.1Q8.2 7 7.1 8.563T6 12.05q0 1.125.425 2.188T7.75 16.2l.25.25V14h2v6zm10-.25v-2.1q1.8-.65 2.9-2.212T18 11.95q0-1.125-.425-2.187T16.25 7.8L16 7.55V10h-2V4h6v2h-2.75l.4.35q1.225 1.225 1.788 2.663T20 11.95q0 2.775-1.662 4.938T14 19.75"/>
                        </svg>
                        Làm mới
                    </a>
                    <button class="btn btn-danger-gradient" data-bs-toggle="modal" data-bs-target="#new">
                        <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="tooltip" title="Thêm mới" width="20px" height="20px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M20 14h-6v6h-4v-6H4v-4h6V4h4v6h6z"/>
                        </svg>
                    </button>
                </div>
                <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                    <table id="data-table" class="table text-nowrap table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thao tác</th>
                                <th>Thứ tự</th>
                                <th>Tên nền tảng</th>
                                <th>Đường dẫn</th>
                                <th>Biểu tượng</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold">
                            <?php $__currentLoopData = $platforms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($platform->id); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.service.platform.edit', ['id' => $platform->id])); ?>"
                                        class="btn btn-sm btn-success-gradient"
                                        data-bs-toggle="tooltip" title="Xem chi tiết">
                                    <i class="ti ti-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.service.platform.delete', ['id' => $platform->id])); ?>"
                                        class="btn btn-sm btn-danger-gradient"
                                        data-bs-toggle="tooltip" title="Xóa">
                                    <i class="ti ti-trash"></i>
                                    </a>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-primary-gradient"><?php echo e($platform->order); ?></span>
                                </td>
                                <td><?php echo e($platform->name); ?></td>
                                <td><?php echo e($platform->slug); ?></td>
                                <td>
                                    <img src="<?php echo e($platform->image); ?>" alt="<?php echo e($platform->name); ?>"
                                        class="img-fluid" style="max-width: 50px">
                                </td>
                                <td>
                                    <?php if($platform->status == 'active'): ?>
                                    <span class="badge bg-success-gradient">Hoạt động</span>
                                    <?php else: ?>
                                    <span class="badge bg-danger-gradient">Không hoạt động</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($platform->created_at); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body pc-component">
    <div id="new" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="new" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new">Thêm mới API</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createServicePlatform" action="<?php echo e(route('admin.service.platform.create')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name"
                                placeholder="Tên nền tảng của dịch vụ" value="<?php echo e(old('name')); ?>" required>
                            <label for="name">Tên nền tảng</label>
                        </div>
                        <div class="form-floating mb-3" required>
                            <input type="text" class="form-control" name="slug"
                                placeholder="Đường dẫn của nền tảng" value="<?php echo e(old('slug')); ?>">
                            <label for="slug">Đường dẫn</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="image" placeholder="Nhập hình ảnh"
                                value="<?php echo e(old('image')); ?>" >
                            <label for="image">Hình ảnh</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary-gradient col-12">
                            <i class="fas fa-save"></i> Thêm mới
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    document.getElementById('createServicePlatform').addEventListener('submit', function (e) {
        e.preventDefault();
    
        let formData = new FormData(this);
        fetch("<?php echo e(route('admin.service.platform.create')); ?>", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                "Content-Type": "application/json",
            },
            body: JSON.stringify(Object.fromEntries(formData))
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "error") {
                let errorMessages = "";
                for (let field in data.errors) {
                    errorMessages += `${field}: ${data.errors[field].join(', ')}\n`;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Có lỗi xảy ra!',
                    text: errorMessages,
                    confirmButtonText: 'Đóng'
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: data.message || 'Nền tảng dịch vụ đã được tạo thành công.',
                    showCancelButton: true,
                    confirmButtonText: 'Đóng',
                    cancelButtonText: 'Thêm tiếp',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        document.getElementById('createServicePlatform').reset();
                    }
                });
            }
        })
        .catch(error => {
            console.error("Error:", error);
            Swal.fire({
                icon: 'error',
                title: 'Đã xảy ra lỗi không xác định!',
                text: 'Vui lòng thử lại sau.',
                confirmButtonText: 'Đóng'
            });
        });
    });
    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\socialmedia\app\resources\views/admin/service/platform.blade.php ENDPATH**/ ?>