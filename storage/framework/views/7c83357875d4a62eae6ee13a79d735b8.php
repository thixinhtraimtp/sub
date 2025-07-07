<?php $__env->startSection('title', 'Chỉnh sửa dịch vụ'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title">Chỉnh sửa dịch vụ</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.service.update', ['id' => $service->id])); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-floating mb-3">
                            <select name="platform_id" id="platform_id" class="form-select">
                                <option>-- Chọn nền tảng --</option>
                                <?php $__currentLoopData = \App\Models\ServicePlatform::where('domain', env('APP_MAIN_SITE'))->orderBy('order', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($platform->id); ?>" <?php if(old('platform_id') == $platform->id): ?> selected <?php endif; ?>>
                                        <?php echo e($platform->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <label for="platform_id">Chọn nền tảng</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="package" id="package" class="form-control"
                                placeholder="Mã dịch vụ" value="<?php echo e(old('package') ?? $service->package); ?>">
                            <label for="name">Mã dịch vụ</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Tên dịch vụ" value="<?php echo e(old('name') ?? $service->name); ?>">
                            <label for="name">Tên dịch vụ</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="image" name="image"
                                placeholder="Tên dịch vụ" value="<?php echo e($service->image); ?>">
                            <label for="image">Image</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug"
                                value="<?php echo e(old('slug') ?? $service->slug); ?>">
                            <label for="slug">Đường dẫn</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="note" id="note" class="form-control" placeholder="Ghi chú" style="height: 100px"><?php echo e(old('note') ?? $service->note); ?></textarea>
                            <label for="note">Ghi chú</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="details" id="details" class="form-control" placeholder="Lưu ý" style="height: 100px"><?php echo e(old('details') ?? $service->details); ?></textarea>
                            <label for="details">Lưu ý</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="blogs" id="blogs" class="form-control" cols="30" rows="8" style="height: 120px;"><?php echo e(old('blogs') ?? $service->blogs); ?></textarea>
                            <label for="blogs">Bài viết</label>
                        </div>

                        <div class="row" hidden>
                            <h5 class="mb-3">Hiển thị dữ liệu trong bảng </h5>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-floating mb-3">
                                    <select name="reaction_status" id="" class="form-select">
                                        <option value="off" <?php if(old('reaction_status') == 'off' || $service->reaction_status == 'off'): ?> selected <?php endif; ?>>Tắt
                                        </option>
                                        <option value="on" <?php if(old('reaction_status') == 'on' || $service->reaction_status == 'on'): ?> selected <?php endif; ?>>Bật
                                        </option>
                                    </select>
                                    <label for="" class="form-label">Cột cảm xúc</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-floating mb-3">
                                    <select name="quantity_status" id="" class="form-select">
                                        <option value="off" <?php if(old('quantity_status') == 'off' || $service->quantity_status == 'off'): ?> selected <?php endif; ?>>Tắt
                                        </option>
                                        <option value="on" <?php if(old('quantity_status') == 'on' || $service->quantity_status == 'on'): ?> selected <?php endif; ?>>Bật
                                        </option>
                                    </select>
                                    <label for="" class="form-label">Cột số lượng</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-floating mb-3">
                                    <select name="comments_status" id="" class="form-select">
                                        <option value="off" <?php if(old('comments_status') == 'on' || $service->comments_status == 'on'): ?> selected <?php endif; ?>>Tắt
                                        </option>
                                        <option value="on" <?php if(old('comments_status') == 'on' || $service->comments_status == 'on'): ?> selected <?php endif; ?>>Bật
                                        </option>
                                    </select>
                                    <label for="" class="form-label">Cột bình luận</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-floating mb-3">
                                    <select name="minutes_status" id="" class="form-select">
                                        <option value="off" <?php if(old('minutes_status') == 'off' || $service->minutes_status == 'off'): ?> selected <?php endif; ?>>Tắt
                                        </option>
                                        <option value="on" <?php if(old('minutes_status') == 'on' || $service->minutes_status == 'on'): ?> selected <?php endif; ?>>Bật
                                        </option>
                                    </select>
                                    <label for="" class="form-label">Cột số phút</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-floating mb-3">
                                    <select name="time_status" id="" class="form-select">
                                        <option value="off" <?php if(old('time_status') == 'off' || $service->time_status == 'off'): ?> selected <?php endif; ?>>Tắt
                                        </option>
                                        <option value="on" <?php if(old('time_status') == 'on' || $service->time_status == 'on'): ?> selected <?php endif; ?>>Bật
                                        </option>
                                    </select>
                                    <label for="" class="form-label">Cột thời gian</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                                <div class="form-floating mb-3">
                                    <select name="posts_status" id="" class="form-select">
                                        <option value="off" <?php if(old('posts_status') == 'off' || $service->posts_status == 'off'): ?> selected <?php endif; ?>>Tắt
                                        </option>
                                        <option value="on" <?php if(old('posts_status') == 'on' || $service->posts_status == 'on'): ?> selected <?php endif; ?>>Bật
                                        </option>
                                    </select>
                                    <label for="" class="form-label">Cột bài viết</label>
                                </div>
                            </div>
                        </div>


                        <div class="form-floating mb-3">
                            <select name="status" id="status" class="form-select">
                                <option value="active" <?php if(old('status') == 'active' || $service->status == 'active'): ?> selected <?php endif; ?>>Hoạt
                                    động</option>
                                <option value="inactive" <?php if(old('status') == 'inactive' || $service->status == 'inactive'): ?> selected <?php endif; ?>>Không
                                    hoạt động</option>
                            </select>
                            <label for="status">Trạng thái</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary col-12">
                                <i class="fas fa-save"></i> Lưu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->startSection('script'); ?>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudgam/public_html/resources/views/admin/service/service-edit.blade.php ENDPATH**/ ?>