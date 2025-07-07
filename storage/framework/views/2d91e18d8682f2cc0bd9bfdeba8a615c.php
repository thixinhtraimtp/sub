<?php $__env->startSection('title', 'Danh sách Website Con'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title">DANH SÁCH WEBSITE CON</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                        <table id="data-table" class="table text-nowrap table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Thao tác</th>
                                    <th>Tên Website</th>
                                    <th>Trạng thái</th>
                                    <th>Trạng thái Cloudflare</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $partnerWebsites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partnerWebsite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($partnerWebsite->id); ?></td>
                                        <td>
                                            
                                            <a href="<?php echo e(route('admin.website.partner.delete', $partnerWebsite->id)); ?>"
                                                class="btn btn-danger-gradient btn-sm" data-bs-toggle="tooltip"
                                                title="Xóa">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            
                                            <?php if($partnerWebsite->status !== 'active'): ?>
                                                <a href="<?php echo e(route('admin.website.partner.active', $partnerWebsite->id)); ?>"
                                                    class="btn btn-success-gradient btn-sm" data-bs-toggle="tooltip"
                                                    title="Kích hoạt">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                                
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($partnerWebsite->name); ?></td>
                                        <td>
                                            <?php if($partnerWebsite->status == 'active'): ?>
                                                <span class="badge bg-success-gradient">Hoạt động</span>
                                            <?php elseif($partnerWebsite->status == 'inactive'): ?>
                                                <span class="badge bg-danger-gradient">Không hoạt động</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning-gradient">Chờ kích hoạt</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($partnerWebsite->zone_status == 'active'): ?>
                                                <span class="badge bg-success-gradient">Hoạt động</span>
                                            <?php elseif($partnerWebsite->zone_status == 'inactive'): ?>
                                                <span class="badge bg-danger-gradient">Không hoạt động</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning-gradient">Chờ kích hoạt</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($partnerWebsite->created_at); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php if(getDomain() == env('APP_MAIN_SITE')): ?>
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title">DANH SÁCH TẤT CẢ WEBSITE CON/ CHÁU</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                        <table id="data-table-2" class="table text-nowrap table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Thao tác</th>
                                    <th>Tên Website</th>
                                    <th>Site Mẹ</th>
                                    <th>Trạng thái</th>
                                    <th>Trạng thái Cloudflare</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $allPartnerWebsites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partnerWebsite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($partnerWebsite->id); ?></td>
                                        <td>
                                            
                                            <a href="<?php echo e(route('admin.website.partner.delete', $partnerWebsite->id)); ?>"
                                                class="btn btn-danger-gradient btn-sm" data-bs-toggle="tooltip" title="Xoá">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <a href="<?php echo e(route('admin.website.partner.reset', $partnerWebsite->id)); ?>" class="btn btn-warning-gradient btn-sm" data-bs-toggle="tooltip" title="Duyệt lại">
                                                <i class="fa fa-sync"></i>
                                            </a>
                                            
                                            <?php if($partnerWebsite->status !== 'active'): ?>
                                                <a href="<?php echo e(route('admin.website.partner.active', $partnerWebsite->id)); ?>"
                                                    class="btn btn-success-gradient btn-sm" data-bs-toggle="tooltip" title="Kích hoạt">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            <?php endif; ?>
                                            
                                        </td>
                                        <td><?php echo e($partnerWebsite->name); ?></td>
                                        <td><?php echo e($partnerWebsite->domain); ?></td>
                                        <td>
                                            <?php if($partnerWebsite->status == 'active'): ?>
                                                <span class="badge bg-success-gradient">Hoạt động</span>
                                            <?php elseif($partnerWebsite->status == 'inactive'): ?>
                                                <span class="badge bg-danger-gradient">Không hoạt động</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning-gradient">Chờ kích hoạt</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($partnerWebsite->zone_status == 'active'): ?>
                                                <span class="badge bg-success-gradient">Hoạt động</span>
                                            <?php elseif($partnerWebsite->zone_status == 'inactive'): ?>
                                                <span class="badge bg-danger-gradient">Không hoạt động</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning-gradient">Chờ kích hoạt</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($partnerWebsite->created_at); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $('#data-table-2').DataTable();
    $('#jsource-table').DataTable({
        data: dataSet,
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tkhosubviptop/public_html/resources/views/admin/partner/website.blade.php ENDPATH**/ ?>