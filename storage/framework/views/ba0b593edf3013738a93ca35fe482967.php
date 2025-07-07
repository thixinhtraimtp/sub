<?php $__env->startSection('title', 'Danh sách dịch vụ '); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">Danh sách dịch vụ</h5>
            </div>
            <div class="card-body">
                <div class="form-group d-flex justify-content-between align-items-center gap-2 mb-3">
                    <a href="<?php echo e(route('admin.service')); ?>" class="btn btn-primary-gradient">
                        <svg class="fs-2" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"><path fill="currentColor" d="M4 20v-2h2.75l-.4-.35q-1.225-1.225-1.787-2.662T4 12.05q0-2.775 1.663-4.937T10 4.25v2.1Q8.2 7 7.1 8.563T6 12.05q0 1.125.425 2.188T7.75 16.2l.25.25V14h2v6zm10-.25v-2.1q1.8-.65 2.9-2.212T18 11.95q0-1.125-.425-2.187T16.25 7.8L16 7.55V10h-2V4h6v2h-2.75l.4.35q1.225 1.225 1.788 2.663T20 11.95q0 2.775-1.662 4.938T14 19.75"/></svg> 
                        Làm mới
                    </a>
                    <button class="btn btn-danger-gradient" data-bs-toggle="modal" data-bs-target="#new">
                        <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="tooltip" title="Thêm mới" width="20px" height="20px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M20 14h-6v6h-4v-6H4v-4h6V4h4v6h6z"/>
                        </svg>
                    </button>
                </div>
                <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                    <table id="data-table" class="table table-hover table-vcenter text-center mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thao tác</th>
                                <th>Tên nền tảng</th>
                                <th>Tên dịch vụ</th>
                                <th>Đường đẫn</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold">
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($service->id); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.service.edit', ['id' => $service->id])); ?>"
                                        class="btn btn-sm btn-primary-gradient" data-bs-toggle="tooltip" title="Chỉnh sửa">
                                    <i class="ti ti-pencil"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.service.delete', ['id' => $service->id])); ?>"
                                        class="btn btn-sm btn-danger-gradient" data-bs-toggle="tooltip" title="Xóa">
                                    <i class="ti ti-trash"></i>
                                    </a>
                                </td>
                                <td><?php echo e($service->platform->name); ?></td>
                                <td><?php echo e($service->name); ?></td>
                                <td><?php echo e($service->slug); ?></td>
                                <td>
                                    <?php if($service->status == 'active'): ?>
                                    <span class="badge bg-success-gradient">Hoạt động</span>
                                    <?php else: ?>
                                    <span class="badge bg-danger-gradient">Không hoạt động</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($service->created_at); ?></td>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new">Thêm mới dịch vụ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createService" action="<?php echo e(route('admin.service.create')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select name="platform_id" id="platform" class="form-select">
                                        <option value="">-- Chọn nền tảng --</option>
                                        <?php $__currentLoopData = \App\Models\ServicePlatform::where('domain', env('APP_MAIN_SITE'))->orderBy('order', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($platform->id); ?>" <?php if(old('platform_id') == $platform->id): ?> selected <?php endif; ?>><?php echo e($platform->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <label for="platform">Chọn nền tảng</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên dịch vụ"
                                        value="<?php echo e(old('name')); ?>">
                                    <label for="name">Tên dịch vụ</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="image" name="image" placeholder="Ảnh dịch vụ"
                                        value="<?php echo e(old('image')); ?>">
                                    <label for="image">Image</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Đường dẫn"
                                        value="<?php echo e(old('slug')); ?>">
                                    <label for="slug">Đường dẫn</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <select name="status" id="status" class="form-select">
                                    <option value="active" <?php if(old('status') == 'active'): ?> selected <?php endif; ?>>Hoạt động</option>
                                    <option value="inactive" <?php if(old('status') == 'inactive'): ?> selected <?php endif; ?>>Không hoạt động</option>
                                    </select>
                                    <label for="status">Trạng thái</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="note" id="note" class="form-control" cols="30" rows="4" style="height: 120px;">
<p>⚠️Kiểm tra định dạng Link cẩn thận trước khi đặt hàng. Nếu sai định dạng Link sẽ không được hỗ trợ.</p><p>⚠️Vui lòng đảm bảo tài khoản của bạn ở chế độ công khai, Không riêng tư.</p><p>⚠️Không đặt nhiều đơn hàng cho cùng một liên kết trước khi hoàn thành. </p></textarea>
                            <label for="note">Ghi chú</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="details" id="details" class="form-control" cols="30" rows="4" style="height: 180px;">
<p>Nghiêm cấm buff các đơn có nội dung vi phạm pháp luật, chính trị, đồ trụy... Nếu cố tình buff bạn sẽ bị trừ hết tiền và ban khỏi hệ thống vĩnh viễn, và phải chịu hoàn toàn trách nhiệm trước pháp luật.</p><p>Nếu đơn đang chạy trên hệ thống mà bạn vẫn mua ở các hệ thống bên khác hoặc đè nhiều đơn, nếu có tình trạng hụt, thiếu số lượng giữa 2 bên thì sẽ không được xử lí.</p><p>Đơn cài sai thông tin hoặc lỗi trong quá trình tăng hệ thống sẽ không hoàn lại tiền.</p><p>Nếu gặp lỗi hãy nhắn tin hỗ trợ phía bên phải góc màn hình hoặc vào mục liên hệ hỗ trợ để được hỗ trợ tốt nhất</p></textarea>
                            <label for="details">Lưu ý</label>
                        </div>
                        <div class="form-floating mb-3" hidden>
                            <textarea name="blogs" id="blogs" class="form-control" cols="30" rows="8" style="height: 120px;"></textarea>
                            <label for="blogs">Bài viết</label>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary-gradient col-12">
                            <i class="fas fa-save"></i> Thêm mới
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startSection('script'); ?>
<script>
    document.getElementById('createService').addEventListener('submit', function(event) {
        event.preventDefault(); 
    
        const form = event.target; 
        const formData = new FormData(form); 
    
        fetch("<?php echo e(route('admin.service.create')); ?>", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    title: 'Thành công!',
                    text: 'Dịch vụ đã được tạo thành công.',
                    icon: 'success',
                    showCancelButton: true, 
                    confirmButtonText: 'Thêm tiếp',
                    cancelButtonText: 'Đóng',
                }).then((result) => {
                    if (result.isConfirmed) {
                    } else {
                        location.reload();
                    }
                });
            } else {
                Swal.fire({
                    title: 'Lỗi!',
                    text: data.errors.join(', '), 
                    icon: 'error',
                    confirmButtonText: 'Đóng'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    
</script>
<script src="/app/js/plugins/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        height: '400',
        selector: '#blogs',
        content_style: 'body { font-family: "Inter", sans-serif; }',
        menubar: false,
        toolbar: [
            'styleselect fontselect fontsizeselect',
            'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify | forecolor backcolor |',
            'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'
        ],
        plugins: 'advlist autolink link image lists charmap print preview code'
    });
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dailysie/hacksub.website/resources/views/admin/service/service.blade.php ENDPATH**/ ?>