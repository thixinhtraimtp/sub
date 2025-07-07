
<?php $__env->startSection('title','Cấu hình hệ thống'); ?>
<?php $__env->startSection('content'); ?><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                    class="btn btn-primary-gradient btn-sm" onclick="copyText()">https://<?php echo e(getDomain()); ?>/api/v1/payment/MOMO</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền MBBank</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="copyText()">https://<?php echo e(getDomain()); ?>/api/v1/payment/MBBank</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền Vietcombank</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://<?php echo e(getDomain()); ?>/api/v1/payment/Vietcombank</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền ACB</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://<?php echo e(getDomain()); ?>/api/v1/payment/ACB</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp thẻ cào</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://<?php echo e(getDomain()); ?>/api/v1/card</button>
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
                            <td class="fw-bold">Nạp tiền Momo</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://<?php echo e(getDomain()); ?>/api/v1/payment/MOMO</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền MBBank</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://<?php echo e(getDomain()); ?>/api/v1/payment/MBBank</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền Vietcombank</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://<?php echo e(getDomain()); ?>/api/v1/payment/Vietcombank</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền ACB</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://<?php echo e(getDomain()); ?>/api/v1/payment/ACB</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền BIDV</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://<?php echo e(getDomain()); ?>/api/v1/payment/BIDV</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp thẻ cào</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://<?php echo e(getDomain()); ?>/api/v1/card</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Cập nhật trạng thái đơn từ Site Mẹ</td>
                                <td>
                                    <span class="btn btn-primary-gradient btn-sm"><?php echo e(route('cron-job.update')); ?></button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Cập nhật giá dịch vụ từ Site Mẹ</td>
                                <td>
                                    <span class="btn btn-primary-gradient btn-sm"><?php echo e(route('cron-job.price.update')); ?></button>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><script>
function copyText() {
    const copyText = document.getElementById("myInput");
    copyText.select();
    copyText.setSelectionRange(0, 99999);  // For mobile devices

    try {
        navigator.clipboard.writeText(copyText.value).then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Sao chép thành công!',
                text: 'Đoạn văn bản đã được sao chép vào bộ nhớ tạm.',
            });
        });
    } catch (err) {
        Swal.fire({
            icon: 'error',
            title: 'Sao chép thất bại',
            text: 'Không thể sao chép văn bản.',
        });
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\socialmedia\app\resources\views/admin/cron.blade.php ENDPATH**/ ?>