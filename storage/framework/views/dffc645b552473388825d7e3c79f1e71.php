<?php $__env->startSection('title', 'Nạp tiền thẻ cào'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="row">
            <div class="col-6 d-grid gap-2">
                <a href="<?php echo e(route('account.recharge')); ?>" class="btn btn-outline-primary">
                Ngân hàng</a>
            </div>
            <div class="col-6 d-grid gap-2">
                <a href="<?php echo e(route('account.card')); ?>" class="btn btn-primary">
                Thẻ cào</a>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Nạp thẻ cào</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('account.card.post')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-12 mx-auto mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Loại thẻ</label>
                                <select name="card_type" id="card_type" class="form-control">
                                    <option value="VIETTEL">Viettel (Chiết khấu: <?php echo e(siteValue('percent')); ?>%)
                                    </option>
                                    <option value="MOBIFONE">Mobifone (Chiết khấu: <?php echo e(siteValue('percent')); ?>%)
                                    </option>
                                    <option value="VINAPHONE">Vinaphone (Chiết khấu: <?php echo e(siteValue('percent')); ?>%)
                                    </option>
                                    <option value="VIETNAMMOBILE">Vietnamobile (Chiết khấu:
                                        <?php echo e(siteValue('percent')); ?>%)
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mx-auto mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Mệnh giá</label>
                                <select name="card_value" id="card_value" class="form-control">
                                    <option value="10000">10,000 VNĐ</option>
                                    <option value="20000">20,000 VNĐ</option>
                                    <option value="30000">30,000 VNĐ</option>
                                    <option value="50000">50,000 VNĐ</option>
                                    <option value="100000">100,000 VNĐ</option>
                                    <option value="200000">200,000 VNĐ</option>
                                    <option value="300000">300,000 VNĐ</option>
                                    <option value="500000">500,000 VNĐ</option>
                                    <option value="1000000">1,000,000 VNĐ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mx-auto mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Seri</label>
                                <input type="text" name="card_seri" id="card_seri" class="form-control"
                                    placeholder="Nhập dữ liệu....">
                            </div>
                        </div>
                        <div class="col-md-12 mx-auto mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Mã thẻ</label>
                                <input type="text" name="card_code" id="card_code" class="form-control"
                                    placeholder="Nhập dữ liệu....">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary col-12" id="btnRechargeCard">Nạp thẻ cào</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Lịch sử nạp thẻ cào</h5>
            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table id="dom-table" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Loại thẻ</th>
                                <th>Mệnh giá</th>
                                <th>Seri</th>
                                <th>Mã thẻ</th>
                                <th>Thực nhận</th>
                                <th>Trạng thái</th>
                                <th>Thời gian gửi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($card->isEmpty()): ?>
                            <?php echo $__env->make('admin.components.table-search-not-found', ['colspan' => 12], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php else: ?>
                            <?php $__currentLoopData = $card; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item['id']); ?></td>
                                <td><?php echo e($item['card_type']); ?></td>
                                <td><?php echo e(number_format($item['card_amount'], 0, '.', ',')); ?> đ</td>
                                <td><?php echo e($item['card_serial']); ?></td>
                                <td><?php echo e($item['card_code']); ?></td>
                                <td><?php echo e(number_format($item['card_real_amount'], 0, '.', ',')); ?> đ</td>
                                <td><?php echo statusCard($item['status']); ?></td>
                                <td><?php echo e($item['created_at']); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('guard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khosubv1/public_html/resources/views/guard/card.blade.php ENDPATH**/ ?>