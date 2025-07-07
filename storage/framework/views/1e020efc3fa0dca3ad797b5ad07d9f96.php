<?php $__env->startSection('title', 'Chỉnh sửa máy chủ'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title">Tạo mới dịch vụ</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.server.update', ['id' => $server->id])); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <select name="service" id="" class="form-select" disabled>
                                        <?php $__currentLoopData = \App\Models\ServicePlatform::where('domain', env('APP_MAIN_SITE'))->orderBy('order', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="">-- <?php echo e($platform->name); ?> --</option>
                                            <?php $__currentLoopData = $platform->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($service->id); ?>"
                                                    <?php echo e($server->service_id == $service->id ? 'selected' : ''); ?>>
                                                    <?php echo e($service->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <label for="service">Dịch vụ</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Tiêu đề máy chủ" value="<?php echo e($server->name); ?>">
                                    <label for="name">Tiêu đề máy chủ</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="details" id="details" class="form-control" placeholder="Mô tả máy chủ" rows="5"
                                        style="height: 200px;"><?php echo e($server->details); ?></textarea>
                                    <label for="details">Mô tả máy chủ</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <select name="package_id" id="package_id" class="form-select" disabled>
                                                <option value="">-- Chọn máy chủ --</option>
                                                <?php for($i = 1; $i <= 50; $i++): ?>
                                                    <option value="<?php echo e($i); ?>"
                                                        <?php echo e($server->package_id == $i ? 'selected' : ''); ?>>
                                                        Máy chủ <?php echo e($i); ?>

                                                    </option>
                                                <?php endfor; ?>
                                            </select>
                                            <label for="package_id">Máy chủ</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="price_member" name="price_member"
                                                value="<?php echo e($server->price_member); ?>">
                                            <label for="price_member">Giá thành viên</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="price_collaborator"
                                                name="price_collaborator" value="<?php echo e($server->price_collaborator); ?>">
                                            <label for="price_collaborator">Giá cộng tác viên</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="price_agency"
                                                name="price_agency" value="<?php echo e($server->price_agency); ?>">
                                            <label for="price_agency">Giá đại lý</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="price_distributor"
                                                name="price_distributor" value="<?php echo e($server->price_distributor); ?>">
                                            <label for="price_distributor">Giá nhà phân bón</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select name="status" id="status" class="form-select">
                                                <option value="active"
                                                    <?php echo e($server->status == 'active' ? 'selected' : ''); ?>>
                                                    Hoạt động
                                                </option>
                                                <option value="inactive"
                                                    <?php echo e($server->status == 'inactive' ? 'selected' : ''); ?>>
                                                    Không hoạt động
                                                </option>
                                            </select>
                                            <label for="status">Trạng thái</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select name="visibility" id="visibility" class="form-select">
                                                <option value="public"
                                                    <?php echo e($server->visibility == 'public' ? 'selected' : ''); ?>>
                                                    Công khai
                                                </option>
                                                <option value="private"
                                                    <?php echo e($server->visibility == 'private' ? 'selected' : ''); ?>>
                                                    Riêng tư
                                                </option>
                                            </select>
                                            <label for="visibility">Hiển thị</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save"></i> Sửa máy chủ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/trumsubr/public_html/resources/views/admin/service/partner/server-edit.blade.php ENDPATH**/ ?>