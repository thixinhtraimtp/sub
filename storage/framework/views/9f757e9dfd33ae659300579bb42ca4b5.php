<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title', 'Tiến trình'); ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5>Tất cả tiến trình</h5>
        </div>
        <div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="data-table" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold">
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <ul>
                                    <li><b>ID: </b><?php echo e($order->id); ?></li>
                                    <li><b>Mã đơn: </b><i onclick="coppy('<?php echo e($order->order_code); ?>')"><?php echo e($order->order_code); ?> <i class="fas fa-copy"></i></i></li>
                                    <li><b>Thời gian: </b><?php echo e($order->created_at->diffForHumans()); ?></li>
                                    <li><?php echo e($order->created_at); ?> -</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <a href="<?php echo e(route('service', ['platform' => $order->service->platform->slug ?? 'Null', 'service' => $order->service->slug ?? 'Null'])); ?>">
                                        <li><b>Máy chủ <?php echo e(($order->server_id) ?? 'Không tìm thấy máy chủ'); ?> : </b><u class="text-sky-600"><?php echo e(($order->service->name) ?? 'Không tìm thấy dịch vụ'); ?></u></li>
                                    </a>
                                    <li>
                                        <b>Link: </b>
                                        <a href="javascript:;" onclick="coppy('<?php echo e($order->object_id); ?>')"><?php echo e($order->object_id); ?></a>
                                    </li>
                                    <li class="mt-1"><?php echo statusOrder($order->status, true); ?></li>
                                    <li class="mt-1">
                                        <a class="text-primary" href="<?php echo e(route('service', [ 'platform' => $order->service->platform->slug ?? 'Null', 'service' => $order->service->slug ?? 'Null'])); ?>">Đặt lại hàng<a> - 
                                        <a class="text-danger" href="<?php echo e(route('ticket')); ?>">Hỗ trợ</a>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <?php if(isset($order->server->action->refund_status) && $order->server->action->refund_status === 'on'): ?>                                <a href="javascript:;" class="btn btn-sm btn-warning"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Hoàn tiền"
                                    onclick="refundOrder('<?php echo e($order->order_code); ?>')">
                                <i class="fas fa-undo"></i>
                                <?php endif; ?>
                                
                                <?php if(isset($order->server->action->warranty_status) && $order->server->action->warranty_status === 'on'): ?>
                                <a href="javascript:;" class="btn btn-sm btn-info"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Bảo hành"
                                    onclick="warrantyOrder('<?php echo e($order->order_code); ?>')">
                                <i class="fas fa-sync"></i>
                                </a>
                                <?php endif; ?>
                                
                                <a href="javascript:;" class="btn btn-sm btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Cập nhật"
                                    onclick="updateOrder('<?php echo e($order->order_code); ?>')">
                                <i class="fas fa-cube"></i>
                                </a>
                                
                                <?php if(isset($order->server->action->renews_status) && $order->server->action->renews_status === 'on'): ?>
                                <a href="javascript:;" class="btn btn-sm btn-info"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Gia hạn"
                                    onclick="renewsOrder('<?php echo e($order->order_code); ?>')">
                                <i class="fas fa-sync"></i>
                                </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <ul>
                                    <li><b>Số tiền: </b><span class="text-primary"><?php echo e($order->price); ?>đ</span></li>
                                    <li><b>Số lượng: </b><span class="text-info"><?php echo e(number_format($order->orderdata()['quantity'])); ?></span></li>
                                    <li><b>Bắt đầu: </b><?php echo e(number_format($order->start)); ?></li>
                                    <li><b>Đã tăng: </b><?php echo e(number_format($order->buff)); ?></li>
                                </ul>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/pack-lamtilo/js/service1.js?time=')); ?><?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('guard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khosubv1/public_html/resources/views/guard/profile/progress.blade.php ENDPATH**/ ?>