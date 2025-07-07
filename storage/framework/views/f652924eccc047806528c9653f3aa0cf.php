<?php $__env->startSection('title', 'Tạo Website riêng'); ?>
<?php $__env->startSection('content'); ?>
<div class="alert bg-warning text-white" role="alert">
    - Bạn phải đạt cấp bậc cộng tác viên hoặc đại lý mới có thể tạo web con! <br>
    - Nghiêm cấm các tiên miền có chữ : Facebook, Instagram để tránh bị vi phạm bản quyền. <br>
    - Khách hàng tạo tài khoản và sử dụng dịch vụ ở site con. Tiền sẽ trừ vào tài khoản của đại
    lý ở
    site chính. Vì thế để khách hàng mua được tài khoản đại lý phải còn số dư. <br>
    - Hiện tại hệ thống hỗ trợ tất cả miền !!!<br>
</div>
<div class="card card-flush  mb-10">
    <div class="card-body row">
        <div class="col-lg-12 mb-5">
            <div class="form-group mb-3">
                <label class="form-label" for="">Api Token</label>
                <div class="input-group">
                    <input disabled="" class="form-control" type="text" value="<?php echo e(Auth::user()->api_token); ?>"
                        id="api_token" readonly="">
                    <button type="button" id="btn-reload-token" class="btn btn-primary"><i class="fa fa-sync"></i> Thay
                    Đổi</button>
                </div>
            </div>
            <div class="alert bg-primary text-white mb-2" role="alert">
                - Mọi người vui lòng lưu lại tên miền ở đây rồi sẽ hiện namesever ở dưới cho mọi người trỏ !
            </div>
            <div class="mb-3">
                <form action="<?php echo e(route('create.website.post')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <label for="domain" class="form-label">Tên miền</label>
                    <div class="input-group mb-5">
                        <input type="text" class="form-control" id="domain" placeholder="Tên miền"
                            autocomplete="off" name="domain" value="<?php echo e($website->name ?? ''); ?>">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu Miền Ngay</button>
                    </div>
                    <?php if($website->name != ''): ?>
                    <div class="alert bg-blue mb-5">
                        <ul class="mb-0 text-white text-center">
                            <strong>
                                <h5 class="text-white">
                                    Bạn vui lòng trỏ miền về NameServer sau:
                                </h5>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="border-top border-start border-end py-2 border-white bg-primary rounded-top-2 mb-0">
                                            <h5 class="text-white text-center mb-0">NAMESEVER 1</h5>
                                        </div>
                                        <div class="alert alert-primary border-white text-primary rounded-top-0 fw-bold fs-3 text-center">
                                            <span onclick="coppy('<?php echo e($website->name_sever1); ?>')" class="cursor-pointer"><?php echo e($website->name_sever1); ?> <i class="fas fa-copy"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="border-top border-start border-end py-2 border-white bg-primary rounded-top-2 mb-0">
                                            <h5 class="text-white text-center mb-0">NAMESEVER 2</h5>
                                        </div>
                                        <div class="alert alert-primary border-white text-primary rounded-top-0 fw-bold fs-3 text-center">
                                            <span onclick="coppy('<?php echo e($website->name_sever2); ?>')" class="cursor-pointer"><?php echo e($website->name_sever2); ?> <i class="fas fa-copy"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </strong>
                        </ul>
                    </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $('#btn-reload-token').click(function() {
            $.ajax({
                url: "<?php echo e(route('account.reload-user-token')); ?>",
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                $('#btn-reload-token').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý..').prop(
                    'disabled', true);
                    },
                    complete: function() {
                        $('#btn-reload-token').html('<i class="fa fa-sync"></i> Thay đổi').prop('disabled', false);
                    },
                success: function(data) {
                    $('#api_token').val(data.api_token);
                    swal("Đã thay đổi Api Token!", "success");
                },
                error: function() {
                    swal("Có lỗi xảy ra!", "error");
                }
            });
        });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('guard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seeding1/public_html/resources/views/guard/website/create.blade.php ENDPATH**/ ?>