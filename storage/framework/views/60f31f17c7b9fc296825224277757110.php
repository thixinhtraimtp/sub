<?php $__env->startSection('title', 'Cấp Bậc & Dịch Vụ'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="multi-collapse collapse show" id="pricemonth" style="">
            <div class="row">
                <?php if((Auth::user()->level) == 'member'): ?>
                <div class="col-md-6 col-xxl-3">
                    <div class="card price-card">
                        <div class="card-body price-head bg-light-primary">
                            <h5 class="text-primary">Thành Viên</h5>
                            <h2 class="font-bold text-primary">0đ</h2>
                            <div class="price-icon bg-light-primary">
                                <i class="ph-duotone ph-rocket text-primary"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled product-list">
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Tổng nạp đạt: 0đ.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Nhóm chat hỗ trợ 24/7.</li>
                                <li class="disable"><i class="ph-duotone ph-check-circle"></i>Giảm giá dịch vụ.</li>
                                <li class="disable"><i class="ph-duotone ph-check-circle"></i>Ưu đãi quyền lợi riêng.</li>
                                <li class="disable"><i class="ph-duotone ph-check-circle"></i>Giao diện Website riêng.</li>
                            </ul>
                            <div class="d-grid">
                                <button class="btn btn-primary">Current Plan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-md-6 col-xxl-3">
                    <div class="card price-card">
                        <div class="card-body price-head bg-light-secondary">
                            <h5 class="text-secondary">Thành Viên</h5>
                            <h2 class="font-bold text-secondary">0đ</h2>
                            <div class="price-icon bg-light-secondary">
                                <i class="ph-duotone ph-rocket text-secondary"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled product-list">
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Tổng nạp đạt: 0đ.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Nhóm chat hỗ trợ 24/7.</li>
                                <li class="disable"><i class="ph-duotone ph-check-circle"></i>Giảm giá dịch vụ.</li>
                                <li class="disable"><i class="ph-duotone ph-check-circle"></i>Ưu đãi quyền lợi riêng.</li>
                                <li class="disable"><i class="ph-duotone ph-check-circle"></i>Giao diện Website riêng.</li>
                            </ul>
                            <div class="d-grid">
                                <a href="<?php echo e(route('account.recharge')); ?>" target="_blank" class="btn btn-outline-secondary">Upgrade Plan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if((Auth::user()->level) == 'collaborator'): ?>
                <div class="col-md-6 col-xxl-3">
                    <div class="card price-card">
                        <div class="card-body price-head bg-light-primary">
                            <h5 class="text-primary">Cộng Tác Viên</h5>
                            <h2 class="font-bold text-primary"><?php echo e(number_format(site('collaborator'))); ?>đ</h2>
                            <div class="price-icon bg-light-primary">
                                <i class="ph-duotone ph-grains text-primary"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled product-list">
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Tổng nạp đạt: <?php echo e(number_format(site('collaborator'))); ?>đ.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Nhóm chat hỗ trợ 24/7.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Giảm giá dịch vụ.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Ưu đãi quyền lợi riêng.</li>
                                <li class="disable"><i class="ph-duotone ph-check-circle"></i>Giao diện Website riêng.</li>
                            </ul>
                            <div class="d-grid">
                                <button class="btn btn-primary">Current Plan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-md-6 col-xxl-3">
                    <div class="card price-card">
                        <div class="card-body price-head bg-light-secondary">
                            <h5 class="text-secondary">Cộng Tác Viên</h5>
                            <h2 class="font-bold text-secondary"><?php echo e(number_format(site('collaborator'))); ?>đ</h2>
                            <div class="price-icon bg-light-secondary">
                                <i class="ph-duotone ph-grains text-secondary"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled product-list">
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Tổng nạp đạt: <?php echo e(number_format(site('collaborator'))); ?>đ.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Nhóm chat hỗ trợ 24/7.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Giảm giá dịch vụ.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Ưu đãi quyền lợi riêng.</li>
                                <li class="disable"><i class="ph-duotone ph-check-circle"></i>Giao diện Website riêng.</li>
                            </ul>
                            <div class="d-grid">
                                <a href="<?php echo e(route('account.recharge')); ?>" target="_blank" class="btn btn-outline-secondary">Upgrade Plan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if((Auth::user()->level) == 'agency'): ?>
                <div class="col-md-6 col-xxl-3">
                    <div class="card price-card">
                        <div class="card-body price-head bg-light-primary">
                            <h5 class="text-primary">Đại Lý</h5>
                            <h2 class="font-bold text-primary"><?php echo e(number_format(site('agency'))); ?>đ</h2>
                            <div class="price-icon bg-light-primary">
                                <i class="ph-duotone ph-flower-lotus text-primary"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled product-list">
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Tổng nạp đạt: <?php echo e(number_format(site('agency'))); ?>đ.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Nhóm chat hỗ trợ 24/7.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Giảm giá dịch vụ.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Ưu đãi quyền lợi riêng.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Giao diện Website riêng.</li>
                            </ul>
                            <div class="d-grid">
                                <button class="btn btn-primary">Current Plan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-md-6 col-xxl-3">
                    <div class="card price-card">
                        <div class="card-body price-head bg-light-secondary">
                            <h5 class="text-secondary">Đại Lý</h5>
                            <h2 class="font-bold text-secondary"><?php echo e(number_format(site('agency'))); ?>đ</h2>
                            <div class="price-icon bg-light-secondary">
                                <i class="ph-duotone ph-flower-lotus text-secondary"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled product-list">
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Tổng nạp đạt: <?php echo e(number_format(site('agency'))); ?>đ.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Nhóm chat hỗ trợ 24/7.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Giảm giá dịch vụ.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Ưu đãi quyền lợi riêng.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Giao diện Website riêng.</li>
                            </ul>
                            <div class="d-grid">
                                <a href="<?php echo e(route('account.recharge')); ?>" target="_blank" class="btn btn-outline-secondary">Upgrade Plan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if((Auth::user()->level) == 'distributor'): ?>
                <div class="col-md-6 col-xxl-3">
                    <div class="card price-card">
                        <div class="card-body price-head bg-light-primary">
                            <h5 class="text-primary">Nhà Phân Phối</h5>
                            <h2 class="font-bold text-primary"><?php echo e(number_format(site('distributor'))); ?>đ</h2>
                            <div class="price-icon bg-light-primary">
                                <i class="ph-duotone ph-buildings text-primary"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled product-list">
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Tổng nạp đạt: <?php echo e(number_format(site('distributor'))); ?>đ.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Nhóm chat hỗ trợ 24/7.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Giảm giá dịch vụ.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Ưu đãi quyền lợi riêng.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Giao diện Website riêng.</li>
                            </ul>
                            <div class="d-grid">
                                <button class="btn btn-primary">Current Plan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-md-6 col-xxl-3">
                    <div class="card price-card">
                        <div class="card-body price-head bg-light-secondary">
                            <h5 class="text-secondary">Nhà Phân Phối</h5>
                            <h2 class="font-bold text-secondary"><?php echo e(number_format(site('distributor'))); ?>đ</h2>
                            <div class="price-icon bg-light-secondary">
                                <i class="ph-duotone ph-buildings text-secondary"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled product-list">
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Tổng nạp đạt: <?php echo e(number_format(site('distributor'))); ?>đ.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Nhóm chat hỗ trợ 24/7.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Giảm giá dịch vụ.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Ưu đãi quyền lợi riêng.</li>
                                <li class="enable"><i class="ph-duotone ph-check-circle"></i>Giao diện Website riêng.</li>
                            </ul>
                            <div class="d-grid">
                                <a href="<?php echo e(route('account.recharge')); ?>" target="_blank" class="btn btn-outline-secondary">Upgrade Plan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Bảng Giá Dịch Vụ</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <ul class="nav nav-pills row" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <?php $__currentLoopData = $platforms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="col-md-2 text-center">
                                <a class="nav-link <?php echo e($loop->first ? 'active' : ''); ?> d-flex align-items-center gap-1 justify-content-center"
                                    id="v-pills-<?php echo e($platform->id); ?>-tab" data-bs-toggle="pill"
                                    href="#v-pills-<?php echo e($platform->id); ?>" role="tab"
                                    aria-controls="v-pills-<?php echo e($platform->id); ?>" aria-selected="true">
                                <img src="<?php echo e($platform->image); ?>" class="wid-25" alt="">
                                <span><?php echo e($platform->name); ?></span>
                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="tab-content" id="v-pills-tabContent">
                            <?php $__currentLoopData = $platforms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tab-pane fade <?php echo e($loop->first ? 'show active' : ''); ?>"
                                id="v-pills-<?php echo e($platform->id); ?>" role="tabpanel"
                                aria-labelledby="v-pills-<?php echo e($platform->id); ?>-tab">
                                
                                <div class="accordion" id="accordionExample">
                                    <?php $__currentLoopData = $platform->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading<?php echo e($service->id); ?>">
                                            <button class="accordion-button collapsed font-bold" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse<?php echo e($service->id); ?>"
                                                aria-expanded="false"
                                                aria-controls="collapse<?php echo e($service->id); ?>">
                                                <?php echo e($service->name); ?>

                                            </button>
                                        </h2>
                                        <div id="collapse<?php echo e($service->id); ?>"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="heading<?php echo e($service->id); ?>"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="table-responsive">
                                                    <table
                                                        class="table table-bordered table-hover table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Thông tin</th>
                                                                <th>Máy chủ</th>
                                                                <th>Thành viên</th>
                                                                <th>Cộng tác viên</th>
                                                                <th>Đại lý</th>
                                                                <th>Nhà phân phối</th>
                                                                <th>Trạng thái</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $__currentLoopData = $service->servers->where('domain', request()->getHost()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr></tr>
                                                            <td>
                                                                <ul class="mb-0">
                                                                    <li class="fs-6 fw-bold">Thông tin:
                                                                        <?php echo e($server->name); ?>

                                                                    </li>
                                                                    <li class="fs-6 fw-bold">Min - Max:
                                                                        <?php echo e(number_format($server->min)); ?> ~
                                                                        <?php echo e(number_format($server->max)); ?>

                                                                    </li>
                                                                    <li class="fs-6 fw-bold">Giới hạn ngày:
                                                                        <span class="text-danger">
                                                                        <?php if($server->limit_day == 0): ?>
                                                                        Không giới hạn
                                                                        <?php else: ?>
                                                                        <?php echo e($server->limit_day); ?>

                                                                        <?php endif; ?>
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge bg-primary"><?php echo e($server->package_id); ?></span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge bg-success"><?php echo e($server->price_member); ?>đ</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge bg-info"><?php echo e($server->price_collaborator); ?>đ</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge bg-warning"><?php echo e($server->price_agency); ?>đ</span>
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-danger">
                                                                Liên hệ Admin
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <?php echo statusAction($server->status, true); ?>

                                                            </td>
                                                            </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('guard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tkhosubviptop/public_html/resources/views/guard/profile/services.blade.php ENDPATH**/ ?>