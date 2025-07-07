
<?php $__env->startSection('title','Cấu hình hệ thống'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="fw-bold">Loại Cron</th>
                                <th class="fw-bold">Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(env('APP_MAIN_SITE') == request()->getHost()): ?>
                            <tr>
                                <td class="fw-bold">Nạp tiền Momo</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/MOMO')">https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/MOMO</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền MBBank</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/MBBANK')">https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/MBBANK</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền Vietcombank</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/VCB')">https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/VCB</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền ACB</td>
                                <td>
                                    <button class="btn btn-primary-gradient btn-sm" onclick="coppy('https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/ACB')">https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/ACB</button>
                                </td>
                            </tr>
                            <td class="fw-bold">Nạp tiền BIDV</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/BIDV')">https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/BIDV</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Callback thẻ</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://<?php echo e(getDomain()); ?>/api/v1/callback/card')">https://<?php echo e(getDomain()); ?>/api/v1/callback/card</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Check Giá SMM</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://<?php echo e(getDomain()); ?>/api/v1/price/smm</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Cập nhật đơn</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://<?php echo e(getDomain()); ?>/api/v1/status/order</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Hoàn tiền đơn hàng</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://<?php echo e(getDomain()); ?>/api/v1/refund/order</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền BIDV</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://<?php echo e(getDomain()); ?>/api/v1/payment/BIDV</button>
                                </td>
                            </tr>
                            <?php else: ?>
                            <tr>
                            <tr>
                                <td class="fw-bold">Nạp tiền Momo</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/MOMO')">https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/MOMO</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền MBBank</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/MBBANK')">https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/MBBANK</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền Vietcombank</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/VCB')">https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/VCB</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền ACB</td>
                                <td>
                                    <button class="btn btn-primary-gradient btn-sm" onclick="coppy('https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/ACB')">https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/ACB</button>
                                </td>
                            </tr>
                            <td class="fw-bold">Nạp tiền BIDV</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/BIDV')">https://<?php echo e(getDomain()); ?>/api/v1/cronJob/recharge/BIDV</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Callback thẻ</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://<?php echo e(getDomain()); ?>/api/v1/callback/card')">https://<?php echo e(getDomain()); ?>/api/v1/callback/card</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Cập nhật trạng thái đơn từ Site Mẹ</td>
                                <td>
                                    <span class="btn btn-primary-gradient btn-sm"><?php echo e(route('cron-job.update')); ?></button>
                                </td>
                            </tr>
                            <tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dailysie/hacksub.website/resources/views/admin/cron.blade.php ENDPATH**/ ?>