
<?php $__env->startSection('title', 'Tiếp thị liên kết'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body p-3">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Hướng dẫn</button>
                    <button class="nav-link" id="v-pills-home-tab4" data-bs-toggle="pill" data-bs-target="#v-pills-home4" type="button" role="tab" aria-controls="v-pills-home4" aria-selected="false" tabindex="-1">Người được giới
                    thiệu</button>
                    <a class="nav-link text-center" href="<?php echo e(route('withdraw')); ?>" tabindex="-1">Rút
                    tiền</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Hướng dẫn</h4>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="fw-bold text-primary">
                                Kiếm Tiền Affiliate
                            </div>
                            <div class="">
                                <button class="btn btn-link-primary active">Số dư hiện tại: <span class="text-danger fw-bold"><?php echo e(number_format(Auth::user()->referral_money)); ?>₫</span></button>
                            </div>
                            <div class="">
                                <button class="btn btn-link-primary active">Số người đăng ký: <span class="text-danger fw-bold"><?php echo e(number_format($count)); ?></span></button>
                            </div>
                        </div>
                        <div class="mb-3">Kiếm thêm thu nhập với chương trình tiếp thị liên kết bằng cách mời mọi
                            người đăng ký qua liên kết được chúng tôi cấp riêng cho bạn dưới đây. Bạn sẽ kiếm được một
                            tỷ lệ phần trăm cố định từ khoản nạp của người được bạn giới thiệu mà không cần phải làm gì
                            cả. Số tiền bạn kiếm được được chúng tôi thanh toán tiền mặt hoặc bạn có thể chuyển vào hệ
                            thống của chúng tôi để sử dụng dịch vụ. Hoa hồng bạn sẽ được nhận trọn đời với tài khoản đó.
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">URL Giới thiệu của bạn</label>
                            <div class="col-md-5 mb-3">
                                <div class="input-group">
                                    <input type="text" id="content_codeRecharge" value="https://<?php echo e(getDomain()); ?>/ref/<?php echo e(Auth::user()->id); ?>"
                                        class="form-control">
                                    <button class="btn btn-secondary btn-copied" onclick="coppy('https://<?php echo e(getDomain()); ?>/ref/<?php echo e(Auth::user()->id); ?>');"
                                        data-clipboard-text="https://<?php echo e(getDomain()); ?>/ref/<?php echo e(Auth::user()->id); ?>"><i class="fa fa-copy fs-3"
                                        aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Phần trăm hoa hồng</label>
                            <p>Bạn sẽ nhận được <span class="text-danger fw-bold"><?php echo e(siteValue('percentage_commission_affiliate')); ?>% hoa hồng</span>
                                trên tổng số tiền mỗi lần
                                nạp của người được bạn giới thiệu
                            </p>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-home4" role="tabpanel" aria-labelledby="v-pills-home-tab4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Danh sách giới thiệu</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped  ">
                                <thead>
                                    <tr  >
                                        <th>STT</th>
                                        <th>Tài khoản</th>
                                        <th>Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($affiliates->isEmpty()): ?>
                                    <?php echo $__env->make('admin.components.table-search-not-found', ['colspan' => 8], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php else: ?>
                                    <?php $__currentLoopData = $affiliates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $affiliate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($affiliate->id); ?></td>
                                        <td><?php echo e($affiliate->username); ?></td>
                                        <td><?php echo e($affiliate->created_at); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center align-items-center">
                                <?php echo e($affiliates->appends(request()->all())->links('pagination::bootstrap-4')); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('guard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seeding1/public_html/resources/views/guard/ref.blade.php ENDPATH**/ ?>