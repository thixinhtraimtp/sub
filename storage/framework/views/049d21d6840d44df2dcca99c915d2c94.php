
<?php $__env->startSection('title', 'Đặt hàng số lượng lớn'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header">
            <h4>Đặt đơn số lượng lớn</h4>
         </div>
         <div class="card-body p-4">
            <form action="<?php echo e(route('api.v2.create.order')); ?>" method="POST" lamtilo-request="order">
               <div class="mb-3">
                  <label class="form-label" data-lang="One order per line in format">Nhập mỗi đơn hàng là một dòng theo định dạng bên dưới</label>
                  <textarea class="form-control txa-bulk-order" rows="15" name="massorder" placeholder="Server_id | Link | Quantity
ID máy chủ | Link | Số lượng cần tăng
VD: 232 |<?php echo e(site('facebook')); ?>|10000">
</textarea>
               </div>
               <div class="mb-0">
                  <button type="submit" class="btn btn-primary w-100" data-lang="">Đặt hàng</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/pack-lamtilo/js/service.js?time=')); ?><?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('guard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/seeding1/public_html/resources/views/guard/mass.blade.php ENDPATH**/ ?>