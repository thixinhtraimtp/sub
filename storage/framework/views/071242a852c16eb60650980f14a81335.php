<?php $__env->startSection('title', 'Lịch sử đơn hàng'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col-md-12">
      <div class="card custom-card">
         <div class="card-header">
            <h4 class="card-title">Lịch sử tạo đơn</h4>
         </div>
         <div class="card-body">
            <form action="">
               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group mb-3">
                        <textarea type="text" class="form-control" id="search" name="search"
                           value="<?php echo e(request('search')); ?>" placeholder="Nhập nội dung cần tìm kiếm mỗi hàng 1 dòng" rows="3"><?php echo e(old('search', request('search'))); ?></textarea>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group mb-3">
                        <select name="status" id="status" class="form-control">
                           <option value="">Tất cả trạng thái</option>
                           <option value="Processing"
                           <?php echo e(request('status') == 'Processing' ? 'selected' : ''); ?>>Đang xử lý</option>
                           <option value="Running"
                           <?php echo e(request('status') == 'Running' ? 'selected' : ''); ?>>Đang chạy</option>
                           <option value="Completed" <?php echo e(request('status') == 'Completed' ? 'selected' : ''); ?>>
                           Hoàn thành</option>
                           <option value="Cancelled" <?php echo e(request('status') == 'Cancelled' ? 'selected' : ''); ?>>
                           Đã hủy</option>
                           <option value="Refunded" <?php echo e(request('status') == 'Refunded' ? 'selected' : ''); ?>>Đã
                           hoàn tiền</option>
                           <option value="Failed" <?php echo e(request('status') == 'Failed' ? 'selected' : ''); ?>>Thất
                           bại</option>
                           <option value="Pending" <?php echo e(request('status') == 'Pending' ? 'selected' : ''); ?>>Chờ
                           xử lý</option>
                           <option value="Partially Refunded"
                           <?php echo e(request('status') == 'Partially Refunded' ? 'selected' : ''); ?>>Hoàn tiền một
                           phần</option>
                           <option value="Partially Completed"
                           <?php echo e(request('status') == 'Partially Completed' ? 'selected' : ''); ?>>Hoàn thành
                           một phần</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <button type="submit" class="btn btn-primary w-100">
                        <i class="ti ti-search"></i>Tìm kiếm
                     </button>
                  </div>
               </div>
            </form>
            <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
               <table class="table text-nowrap table-striped table-hover table-bordered">
                  <thead>
                     <tr>
                        <th>Thông Tin</th>
                        <th>Thao tác</th>
                        <th>Bắt đầu</th>
                        <th>Đã chạy</th>
                        <th>Dữ liệu đối tác</th>
                        <th>Dữ liệu đơn hàng</th>
                        <th>Bình luận</th>
                        <th>Ghi chú</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if($orders->isEmpty()): ?>
                     <?php echo $__env->make('admin.components.table-search-not-found', ['colspan' => 8], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                     <?php else: ?>
                     <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td>
                            <ul>
                                <li>ID: <?php echo e($order->id); ?></li>
                                <li>Username: <?php echo e(optional($order->user)->username ?? 'Không tìm thấy tên người dùng'); ?></li>
                                <li>Mã đơn: <?php echo e($order->order_code); ?></li>
                                <li>Trạng Thái: <?php echo statusOrder($order->status, true); ?></li>
                            </ul>
                        <td>
                           
                           <form action="<?php echo e(route('admin.order.action', ['id' => $order->id])); ?>"
                              method="POST" class="d-flex flex-column align-items-center">
                              <?php echo csrf_field(); ?>
                              <div class="form-group">
                                 <select name="status" id="" class="form-control" style="width: 180px;">
                                 <option value="Processing"
                                 <?php echo e($order->status === 'Processing' ? 'selected' : ''); ?>>
                                 Đang xử lý</option>
                                 <option value="Completed"
                                 <?php echo e($order->status === 'Completed' ? 'selected' : ''); ?>>
                                 Hoàn thành</option>
                                 <option value="Cancelled"
                                 <?php echo e($order->status === 'Cancelled' ? 'selected' : ''); ?>>
                                 Đã hủy</option>
                                 <option value="Refunded"
                                 <?php echo e($order->status === 'Refunded' ? 'selected' : ''); ?>>
                                 Đã hoàn tiền</option>
                                 <option value="Failed"
                                 <?php echo e($order->status === 'Failed' ? 'selected' : ''); ?>>
                                 Thất bại</option>
                                 <option value="Pending"
                                 <?php echo e($order->status === 'Pending' ? 'selected' : ''); ?>>
                                 Chờ xử lý</option>
                                 <option value="Partially Refunded"
                                 <?php echo e($order->status === 'Partially Refunded' ? 'selected' : ''); ?>>
                                 Hoàn tiền một phần</option>
                                 <option value="Partially Completed"
                                 <?php echo e($order->status === 'Partially Completed' ? 'selected' : ''); ?>>
                                 Hoàn thành một phần</option>
                                 <option value="WaitingForRefund"
                                 <?php echo e($order->status === 'WaitingForRefund' ? 'selected' : ''); ?>>
                                 Chờ hoàn tiền</option>
                                 <option value="Expired"
                                 <?php echo e($order->status === 'Expired' ? 'selected' : ''); ?>>
                                 Hết hạn</option>
                                 <option value="Success"
                                 <?php echo e($order->status === 'Success' ? 'selected' : ''); ?>>
                                 Thành công</option>
                                 <option value="Active"
                                 <?php echo e($order->status === 'Active' ? 'selected' : ''); ?>>
                                 Đang hoạt động</option>
                                 </select>
                              </div>
                              <div class="">
                                 <button type="submit" class="btn btn-sm btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Cập nhật trạng thái">
                                 <i class="fas fa-check"></i>
                                 </button>
                              </div>
                           </form>
                           
                           <div class=" d-flex justify-content-center mt-1">
                              <a href="<?php echo e(route('admin.order.delete', ['id' => $order->id])); ?>"
                                 class="btn btn-sm btn-danger"
                                 onclick="return confirm('Bạn có chắc chắn muốn xoá đơn hàng này không?')"
                                 data-bs-toggle="tooltip" data-bs-placement="top" title="Xoá">
                              <i class="fas fa-trash"></i>
                              </a>
                           </div>
                        </td>
                        <td>
                           <form action="<?php echo e(route('admin.order.action.start', ['id' => $order->id])); ?>"
                              method="POST" class="d-flex flex-column align-items-center">
                              <?php echo csrf_field(); ?>
                              <div class="form-group">
                                 <input name="start" value="<?php echo e(number_format($order->start)); ?>" class="form-control" style="width: 100px;">
                              </div>
                              <div class="">
                                 <button type="submit" class="btn btn-sm btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Cập nhật">
                                 <i class="fas fa-check"></i>
                                 </button>
                              </div>
                           </form>
                        </td>
                        <td>
                           <form action="<?php echo e(route('admin.order.action.buff', ['id' => $order->id])); ?>"
                              method="POST" class="d-flex flex-column align-items-center">
                              <?php echo csrf_field(); ?>
                              <div class="form-group">
                                 <input name="buff" value = "<?php echo e(number_format($order->buff)); ?>" class="form-control" style="width: 100px;">
                              </div>
                              <div class="">
                                 <button type="submit" class="btn btn-sm btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Cập nhật">
                                 <i class="fas fa-check"></i>
                                 </button>
                              </div>
                           </form>
                        </td>
                        <td>
                           <ul>
                              <li>Mã đối tác: <?php echo e($order->order_id); ?></li>
                              <li>Đối tác: <?php echo e($order->orderProviderName); ?></li>
                              <li>Máy chủ đối tác: <span class="badge bg-primary"> <?php echo e($order->orderProviderServer); ?></span></li>
                              <li>Đường dẫn máy chủ đối tác: <span class="badge bg-primary"> <?php echo e($order->orderProviderPath); ?></span></li>
                           </ul>
                        </td>
                        <td>
                           <ul>
                              <li>Đường dẫn: <a href="javascript:;"
                                 onclick="coppy('<?php echo e($order->object_id); ?>')" class="text-success"><?php echo e($order->object_id); ?> </a> </li>
                              <li>Máy chủ: <span class="badge bg-primary"> <?php echo e($order->object_server); ?></span></li>
                              <li>Dịch vụ: <?php echo e($order->service->name ?? 'Không tìm thấy dữ liệu'); ?></li>
                              <li>Số lượng:
                                 <?php echo e(number_format(json_decode($order->order_data, true)['quantity'])); ?>

                              </li>
                              <li>Giá: <?php echo e($order->price); ?> đ</li>
                              <li>Thành tiền: <?php echo e(number_format($order->payment)); ?> đ</li>
                              <li>Thời gian tạo: <?php echo e($order->created_at); ?></li>
                           </ul>
                        </td>
                        <td>
                           <textarea class="form-control" rows="3" readonly><?php echo e(json_decode($order->order_data, true)['comments']); ?></textarea>
                        </td>
                        <td>
                           <textarea class="form-control" rows="3" readonly><?php echo e($order->note); ?></textarea>
                        </td>
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php endif; ?>
                  </tbody>
               </table>
               <div class="d-flex justify-content-center align-items-center pagination-style-1 mt-3 pagination-style-1 mt-3">
                  <?php echo e($orders->appends(request()->all())->links('pagination::bootstrap-4')); ?>

               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <?php if(getDomain() == env('APP_MAIN_SITE')): ?>
   <div class="col-md-12">
      <div class="card custom-card">
         <div class="card-header">
            <h5 class="card-title">Đơn tay cần tạo</h5>
         </div>
         <div class="card-body">
            <form action="">
               <div class="row">
                  <div class="col-md-3">
                     <div class="form-group mb-3">
                        <input type="text" class="form-control" id="search" name="search"
                           value="<?php echo e(request('search')); ?>" placeholder="Nhập tài khoản hoặc mã đơn hàng">
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group mb-3">
                        <select name="status" id="status" class="form-control">
                           <option value="">Tất cả trạng thái</option>
                           <option value="Processing"
                           <?php echo e(request('status') == 'Processing' ? 'selected' : ''); ?>>Đang xử lý</option>
                           <option value="Running"
                           <?php echo e(request('status') == 'Running' ? 'selected' : ''); ?>>Đang chạy</option>
                           <option value="Completed" <?php echo e(request('status') == 'Completed' ? 'selected' : ''); ?>>
                           Hoàn thành</option>
                           <option value="Cancelled" <?php echo e(request('status') == 'Cancelled' ? 'selected' : ''); ?>>
                           Đã hủy</option>
                           <option value="Refunded" <?php echo e(request('status') == 'Refunded' ? 'selected' : ''); ?>>Đã
                           hoàn tiền</option>
                           <option value="Failed" <?php echo e(request('status') == 'Failed' ? 'selected' : ''); ?>>Thất
                           bại</option>
                           <option value="Pending" <?php echo e(request('status') == 'Pending' ? 'selected' : ''); ?>>Chờ
                           xử lý</option>
                           <option value="Partially Refunded"
                           <?php echo e(request('status') == 'Partially Refunded' ? 'selected' : ''); ?>>Hoàn tiền một
                           phần</option>
                           <option value="Partially Completed"
                           <?php echo e(request('status') == 'Partially Completed' ? 'selected' : ''); ?>>Hoàn thành
                           một phần</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <button type="submit" class="btn btn-primary w-100">
                        <i class="ti ti-search"></i> Tìm kiếm
                     </button>
                  </div>
               </div>
            </form>
            <div class="table-responsive table-wrapper mb-3">
               <table class="table text-nowrap table-striped table-hover table-bordered">
                  <thead>
                     <tr>
                        <th>Thông Tin</th>
                        <th>Thao tác</th>
                        <th>Bắt đầu</th>
                        <th>Đã chạy</th>
                        <th>Dữ liệu đối tác</th>
                        <th>Dữ liệu đơn hàng</th>
                        <th>Bình luận</th>
                        <th>Ghi chú</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if($ordersDontay->isEmpty()): ?>
                     <?php echo $__env->make('admin.components.table-search-not-found', ['colspan' => 8], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                     <?php else: ?>
                     <?php $__currentLoopData = $ordersDontay; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php if($order->orderProviderName == 'dontay'): ?>
                     <tr>
                        <td>
                            <ul>
                                <li>ID: <?php echo e($order->id); ?></li>
                                <li>Username: <?php echo e(optional($order->user)->username ?? 'Không tìm thấy tên người dùng'); ?></li>
                                <li>Mã đơn: <?php echo e($order->order_code); ?></li>
                                <li>Trạng Thái: <?php echo statusOrder($order->status, true); ?></li>
                            </ul>
                        <td>
                        <td>
                           
                           <form action="<?php echo e(route('admin.order.action', ['id' => $order->id])); ?>"
                              method="POST" class="d-flex flex-column align-items-center">
                              <?php echo csrf_field(); ?>
                              <div class="form-group">
                                 <select name="status" id="" class="form-control" style="width: 180px;">
                                 <option value="Processing"
                                 <?php echo e($order->status === 'Processing' ? 'selected' : ''); ?>>
                                 Đang xử lý</option>
                                 <option value="Completed"
                                 <?php echo e($order->status === 'Completed' ? 'selected' : ''); ?>>
                                 Hoàn thành</option>
                                 <option value="Cancelled"
                                 <?php echo e($order->status === 'Cancelled' ? 'selected' : ''); ?>>
                                 Đã hủy</option>
                                 <option value="Refunded"
                                 <?php echo e($order->status === 'Refunded' ? 'selected' : ''); ?>>
                                 Đã hoàn tiền</option>
                                 <option value="Failed"
                                 <?php echo e($order->status === 'Failed' ? 'selected' : ''); ?>>
                                 Thất bại</option>
                                 <option value="Pending"
                                 <?php echo e($order->status === 'Pending' ? 'selected' : ''); ?>>
                                 Chờ xử lý</option>
                                 <option value="Partially Refunded"
                                 <?php echo e($order->status === 'Partially Refunded' ? 'selected' : ''); ?>>
                                 Hoàn tiền một phần</option>
                                 <option value="Partially Completed"
                                 <?php echo e($order->status === 'Partially Completed' ? 'selected' : ''); ?>>
                                 Hoàn thành một phần</option>
                                 <option value="WaitingForRefund"
                                 <?php echo e($order->status === 'WaitingForRefund' ? 'selected' : ''); ?>>
                                 Chờ hoàn tiền</option>
                                 <option value="Expired"
                                 <?php echo e($order->status === 'Expired' ? 'selected' : ''); ?>>
                                 Hết hạn</option>
                                 <option value="Success"
                                 <?php echo e($order->status === 'Success' ? 'selected' : ''); ?>>
                                 Thành công</option>
                                 <option value="Active"
                                 <?php echo e($order->status === 'Active' ? 'selected' : ''); ?>>
                                 Đang hoạt động</option>
                                 </select>
                              </div>
                              <div class="">
                                 <button type="submit" class="btn btn-sm btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Cập nhật trạng thái">
                                 <i class="fas fa-check"></i>
                                 </button>
                              </div>
                           </form>
                           
                           <div class=" d-flex justify-content-center mt-1">
                              <a href="<?php echo e(route('admin.order.delete', ['id' => $order->id])); ?>"
                                 class="btn btn-sm btn-danger"
                                 onclick="return confirm('Bạn có chắc chắn muốn xoá đơn hàng này không?')"
                                 data-bs-toggle="tooltip" data-bs-placement="top" title="Xoá">
                              <i class="fas fa-trash"></i>
                              </a>
                           </div>
                        </td>
                        <td><?php echo e(optional($order->user)->username ?? 'Không tìm thấy tên người dùng'); ?></td>
                        <td><?php echo e($order->order_code); ?></td>
                        <td>
                           <?php echo statusOrder($order->status, true); ?>

                        </td>
                        <td>
                           <form action="<?php echo e(route('admin.order.action.start', ['id' => $order->id])); ?>"
                              method="POST" class="d-flex flex-column align-items-center">
                              <?php echo csrf_field(); ?>
                              <div class="form-group">
                                 <input name="start" value="<?php echo e(number_format($order->start)); ?>" class="form-control" style="width: 100px;">
                              </div>
                              <div class="">
                                 <button type="submit" class="btn btn-sm btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Cập nhật">
                                 <i class="fas fa-check"></i>
                                 </button>
                              </div>
                           </form>
                        </td>
                        <td>
                           <form action="<?php echo e(route('admin.order.action.buff', ['id' => $order->id])); ?>"
                              method="POST" class="d-flex flex-column align-items-center">
                              <?php echo csrf_field(); ?>
                              <div class="form-group">
                                 <input name="buff" value = "<?php echo e(number_format($order->buff)); ?>" class="form-control" style="width: 100px;">
                              </div>
                              <div class="">
                                 <button type="submit" class="btn btn-sm btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Cập nhật">
                                 <i class="fas fa-check"></i>
                                 </button>
                              </div>
                           </form>
                        </td>
                        <td>
                           <ul>
                              <li>Mã đối tác: <?php echo e($order->order_id); ?></li>
                              <li>Đối tác: <?php echo e($order->orderProviderName); ?></li>
                              <li>Máy chủ đối tác: <span class="badge bg-primary"> <?php echo e($order->orderProviderServer); ?></span></li>
                              <li>Đường dẫn máy chủ đối tác: <span class="badge bg-primary"> <?php echo e($order->orderProviderPath); ?></span></li>
                           </ul>
                        </td>
                        <td>
                           <ul>
                              <li>Đường dẫn: <a href="javascript:;"
                                 onclick="coppy('<?php echo e($order->object_id); ?>')" class="text-success"><?php echo e($order->object_id); ?> </a> </li>
                              <li>Máy chủ: <span class="badge bg-primary"> <?php echo e($order->object_server); ?></span></li>
                              <li>Dịch vụ: <?php echo e($order->service->name ?? 'Không tìm thấy dữ liệu'); ?></li>
                              <li>Số lượng:
                                 <?php echo e(number_format(json_decode($order->order_data, true)['quantity'])); ?>

                              </li>
                              <li>Giá: <?php echo e($order->price); ?> đ</li>
                              <li>Thành tiền: <?php echo e(number_format($order->payment)); ?> đ</li>
                              <li>Thời gian tạo: <?php echo e($order->created_at); ?></li>
                           </ul>
                        </td>
                        <td>
                           <textarea class="form-control" rows="3" readonly><?php echo e(json_decode($order->order_data, true)['comments']); ?></textarea>
                        </td>
                        <td>
                           <textarea class="form-control" rows="3" readonly><?php echo e($order->note); ?></textarea>
                        </td>
                     </tr>
                     <?php endif; ?>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php endif; ?>
                  </tbody>
               </table>
               <div class="d-flex justify-content-center align-items-center pagination-style-1 mt-3">
                  <?php echo e($ordersDontay->appends(request()->all())->links('pagination::bootstrap-4')); ?>

               </div>
            </div>
         </div>
      </div>
   </div>
   <?php endif; ?>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card custom-card">
         <div class="card-header">
            <h5 class="card-title">Lịch sử đơn cần hoàn</h5>
         </div>
         <div class="card-body">
            <form action="">
               <div class="row">
                  <div class="col-md-3">
                     <div class="form-group mb-3">
                        <input type="text" class="form-control" id="search1" name="search1"
                           value="<?php echo e(request('search1')); ?>" placeholder="Nhập tài khoản hoặc mã đơn hàng">
                     </div>
                  </div>
                  <div class="col-md-2">
                     <button type="submit" class="btn btn-primary w-100">
                        <i class="ti ti-search"></i> Tìm kiếm
                     </button>
                  </div>
               </div>
            </form>
            <div class="table-responsive table-wrapper mb-3">
               <table class="table text-nowrap table-striped table-hover table-bordered">
                  <thead>
                     <tr>
                        <th>Thông Tin</th>
                        <th>Thao tác</th>
                        <th>Bắt đầu</th>
                        <th>Đã chạy</th>
                        <th>Dữ liệu đối tác</th>
                        <th>Dữ liệu đơn hàng</th>
                        <th>Bình luận</th>
                        <th>Ghi chú</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if($ordersrefund->isEmpty()): ?>
                     <?php echo $__env->make('admin.components.table-search-not-found', ['colspan' => 8], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                     <?php else: ?>
                     <?php $__currentLoopData = $ordersrefund; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td>
                            <ul>
                                <li>ID: <?php echo e($order->id); ?></li>
                                <li>Username: <?php echo e(optional($order->user)->username ?? 'Không tìm thấy tên người dùng'); ?></li>
                                <li>Mã đơn: <?php echo e($order->order_code); ?></li>
                                <li>Trạng Thái: <?php echo statusOrder($order->status, true); ?></li>
                            </ul>
                        <td>
                        <td>  <a href="javascript:;" class="btn btn-sm btn-warning"
                           data-bs-toggle="tooltip" data-bs-placement="top"
                           title="Hoàn tiền"
                           onclick="refundOrders('<?php echo e($order->order_code); ?>')">
                           <i class="fas fa-undo"></i>
                           </a>
                        </td>
                        <td>    <?php
                           if(isset($order->user->username)){
                           $lam = $order->user->username;
                           }
                           else{
                           $lam = '';
                           }
                           ?>
                           <?php echo e($lam); ?>

                        </td>
                        <td><?php echo e($order->order_code); ?></td>
                        <td>
                           <?php echo statusOrder($order->status, true); ?>

                        </td>
                        <td>
                           <form action="<?php echo e(route('admin.order.action.start', ['id' => $order->id])); ?>"
                              method="POST" class="d-flex flex-column align-items-center">
                              <?php echo csrf_field(); ?>
                              <div class="form-group">
                                 <input name="start" value="<?php echo e(number_format($order->start)); ?>" class="form-control" style="width: 100px;">
                              </div>
                              <div class="">
                                 <button type="submit" class="btn btn-sm btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Cập nhật">
                                 <i class="fas fa-check"></i>
                                 </button>
                              </div>
                           </form>
                        </td>
                        <td>
                           <form action="<?php echo e(route('admin.order.action.buff', ['id' => $order->id])); ?>"
                              method="POST" class="d-flex flex-column align-items-center">
                              <?php echo csrf_field(); ?>
                              <div class="form-group">
                                 <input name="buff" value = "<?php echo e(number_format($order->buff)); ?>" class="form-control" style="width: 100px;">
                              </div>
                              <div class="">
                                 <button type="submit" class="btn btn-sm btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Cập nhật">
                                 <i class="fas fa-check"></i>
                                 </button>
                              </div>
                           </form>
                        </td>
                        <td>
                           <ul>
                              <li>Mã đối tác: <?php echo e($order->order_id); ?></li>
                              <li>Đối tác: <?php echo e($order->orderProviderName); ?></li>
                              <li>Máy chủ đối tác: <span class="badge bg-primary"> <?php echo e($order->orderProviderServer); ?></span></li>
                              <li>Đường dẫn máy chủ đối tác: <span class="badge bg-primary"> <?php echo e($order->orderProviderPath); ?></span></li>
                           </ul>
                        </td>
                        <td>
                           <ul>
                              <li>Đường dẫn: <a href="javascript:;"
                                 onclick="coppy('<?php echo e($order->object_id); ?>')" class="text-success"><?php echo e($order->object_id); ?> </a> </li>
                              <li>Máy chủ: <span class="badge bg-primary"> <?php echo e($order->object_server); ?></span></li>
                              <li>Dịch vụ: <?php echo e($order->service->name ?? 'Không tìm thấy dữ liệu'); ?></li>
                              <li>Số lượng:
                                 <?php echo e(number_format(json_decode($order->order_data, true)['quantity'])); ?>

                              </li>
                              <li>Giá: <?php echo e($order->price); ?> đ</li>
                              <li>Thành tiền: <?php echo e(number_format($order->payment)); ?> đ</li>
                              <li>Thời gian tạo: <?php echo e($order->created_at); ?></li>
                           </ul>
                        </td>
                        <td>
                           <textarea class="form-control" rows="3" readonly><?php echo e(json_decode($order->order_data, true)['comments']); ?></textarea>
                        </td>
                        <td>
                           <textarea class="form-control" rows="3" readonly><?php echo e($order->note); ?></textarea>
                        </td>
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php endif; ?>
                  </tbody>
               </table>
               <div class="d-flex justify-content-center align-items-center pagination-style-1 mt-3">
                  <?php echo e($ordersrefund->appends(request()->all())->links('pagination::bootstrap-4')); ?>

               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
   function refundOrders(order_code) {
       Swal.fire({
           title: 'Xác nhận hoàn tiền ?',
           text: "Bạn chắc chắn muốn hoàn tiền cho đơn hàng này ?",
           icon: 'warning',
           showCloseButton: true,
           showCancelButton: true,
           confirmButtonText: "Hoàn tiền",
           cancelButtonColor: "rgb(224, 56, 56)",
           cancelButtonText: "Hủy"
       }).then(result => {
           if (result.isConfirmed) {
               $.ajax({
                   url: '/admin/order/refund',
                   method: 'POST',
                   data: {
                       order_code: order_code,
                       _token: $('meta[name="csrf-token"]').attr('content')  // CSRF Token
                   },
                   dataType: 'json',
                   beforeSend: function (xhr) {
                       xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content')); // Add CSRF Token to header
                       
                       Swal.fire({
                           title: 'Đang xử lý...',
                           showConfirmButton: false,
                           allowOutsideClick: false,
                           didOpen: () => {
                               Swal.showLoading();
                           },
                       });
                   },
                   success: function (response) {
                       if (response.status === 'success') {
                           Swal.fire({
                               icon: 'success',
                               title: "Thông báo",
                               text: response.message,
                               confirmButtonText: "Đồng ý !",
                           }).then(() => {
                               window.location.reload();
                           });
                       } else {
                           Swal.fire({
                               icon: 'error',
                               title: "Thông báo",
                               text: response.message,
                               confirmButtonText: "Đồng ý !",
                           });
                       }
                   },
                   error: function (xhr) {
                       Swal.fire({
                           icon: 'error',
                           title: "Thông báo",
                           text: xhr.responseJSON.message,
                           confirmButtonText: "Đồng ý !",
                       });
                   }
               })
           }
       })
   }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\socialmedia\app\resources\views/admin/history/orders.blade.php ENDPATH**/ ?>