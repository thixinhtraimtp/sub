
<?php $__env->startSection('title', 'Hỗ trợ Ticket'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">Danh sách ticket hỗ tợ</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                    <table id="data-table" class="table text-nowrap table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thao tác</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung ticket</th>
                                <th>Độ ưu tiên</th>
                                <th>Nội dung đã phản hồi</th>
                                <th>Trạng thái</th>
                                <th>Thời gian tạo</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold">
                            <?php $__currentLoopData = $ticket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tickets): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($tickets->id); ?></td>
                                <td> 
                                    <a href="<?php echo e(route('admin.ticket.ticket.edit', ['id' => $tickets->id])); ?>"
                                        class="btn btn-sm btn-success"
                                        data-bs-toggle="tooltip" title="Xem chi tiết">
                                    <i class="ti ti-eye"></i>
                                    </a> 
                                    <a href="<?php echo e(route('admin.ticket.ticket.delete', ['id' => $tickets->id])); ?>"
                                        class="btn btn-sm btn-danger"
                                        data-bs-toggle="tooltip" title="Xóa">
                                    <i class="ti ti-trash"></i>
                                    </a>
                                </td>
                                <td>
                                    <?php echo e($tickets->title); ?>

                                </td>
                                <td>
                                    <?php echo $tickets->body; ?>

                                </td>
                                <td><?php echo e($tickets->level); ?></td>
                                <td>
                                    <?php echo $tickets->reply; ?>

                                </td>
                                <td><?php echo statusTicket($tickets->status); ?></td>
                                <td><?php echo e($tickets->created_at->diffForHumans()); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khosubv1/public_html/resources/views/admin/ticket/ticket.blade.php ENDPATH**/ ?>