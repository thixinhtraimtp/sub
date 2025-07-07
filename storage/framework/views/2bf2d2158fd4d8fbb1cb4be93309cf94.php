<?php $__env->startSection('title', 'Chỉnh sửa máy chủ'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">Tạo mới dịch vụ</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.server.update', ['id' => $server->id])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-floating mb-3">
                                <select name="service" id="" class="form-select">
                                    <?php $__currentLoopData = \App\Models\ServicePlatform::where('domain',
                                    env('APP_MAIN_SITE'))->orderBy('order', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="">-- <?php echo e($platform->name); ?> --</option>
                                    <?php $__currentLoopData = $platform->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($service->id); ?>"
                                        <?php echo e($server->service_id == $service->id ? 'selected' : ''); ?>>
                                        <?php echo e($service->name); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <label for="service">Dịch vụ</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Tiêu đề máy chủ" value="<?php echo e($server->name); ?>">
                                <label for="name">Tiêu đề máy chủ</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea name="details" id="details" class="form-control" placeholder="Mô tả máy chủ"
                                    rows="5" style="height: 200px;"><?php echo e($server->details); ?></textarea>
                                <label for="details">Mô tả máy chủ</label>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="providerServer"
                                            name="package_id" value="<?php echo e($server->package_id); ?>" readonly>
                                        <label for="package_id">Máy chủ gốc</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                        <select name="get_uid" id="get_uid" class="form-select">
                                            <option value="">-- Chọn trạng thái --</option>
                                            <option value="on"
                                                <?php echo e($server->actions->first()->get_uid == 'on' ? 'selected' : ''); ?>>Bật
                                            </option>
                                            <option value="off"
                                                <?php echo e($server->actions->first()->get_uid == 'off' ? 'selected' : ''); ?>>Tắt
                                            </option>
                                        </select>
                                        <label for="get_uid">Tự động lấy UID</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                        <select name="auto_price" id="auto_price" class="form-select">
                                            <option value="">-- Chọn trạng thái --</option>
                                            <option value="on"
                                                <?php echo e($server->action->auto_price == 'on' ? 'selected' : ''); ?>>Bật
                                            </option>
                                            <option value="off"
                                                <?php echo e($server->action->auto_price == 'off' ? 'selected' : ''); ?>>Tắt
                                            </option>
                                        </select>
                                        <label for="auto_price">Tự động update gía</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="limit_day" id="limit_day"
                                            placeholder="Giới hạn ngày" min="0" value="<?php echo e($server->limit_day); ?>">
                                        <label for="limit_day">Giới hạn ngày (Nhập 0
                                            thì sẽ không giới hạn)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="min" name="min"
                                            value="<?php echo e($server->min); ?>">
                                        <label for="min">Mua tôi thiểu</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="max" name="max"
                                            value="<?php echo e($server->max); ?>">
                                        <label for="max">Mua tôi đa</label>
                                    </div>
                                </div>
                                
                                 <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="percents" name="percents"
                                        value="<?php echo e($server->percents); ?>">
                                    <label for="percents">% số lượng đơn</label>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="price_member" name="price_member"
                                            value="<?php echo e($server->price_member); ?>">
                                        <label for="price_member">Giá thành viên</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="price_collaborator"
                                            name="price_collaborator" value="<?php echo e($server->price_collaborator); ?>">
                                        <label for="price_collaborator">Giá cộng tác viên</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="price_agency" name="price_agency"
                                            value="<?php echo e($server->price_agency); ?>">
                                        <label for="price_agency">Giá đại lý</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="price_distributor"
                                            name="price_distributor" value="<?php echo e($server->price_distributor); ?>">
                                        <label for="price_distributor">Giá nhà phân bón</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <select name="providerName" id="providerName" class="form-select">
                                              <option value="sharegiare"
                                                <?php echo e($server->providerName == 'sharegiare' ? 'selected' : ''); ?>>
                                                Sharegiare.xyz</option>
                                            <option value="trumsubre"
                                                <?php echo e($server->providerName == 'trumsubre' ? 'selected' : ''); ?>>
                                                Trumsubre.com</option>
                                            <option value="2mxh"
                                                <?php echo e($server->providerName == '2mxh' ? 'selected' : ''); ?>>
                                                App.2mxh.com</option>
                                            <option value="tuongtacpro"
                                                <?php echo e($server->providerName == 'tuongtacpro' ? 'selected' : ''); ?>>
                                                Tuongtac.pro</option>
                                            <option value="baostar"
                                                <?php echo e($server->providerName == 'baostar' ? 'selected' : ''); ?>>
                                                Dichvu.baostar.pro</option>
                                            <option value="traodoisub"
                                                <?php echo e($server->providerName == 'traodoisub' ? 'selected' : ''); ?>>
                                              Traodoisub.com</option>
                                               <option value="tuongtaccheo"
                                                <?php echo e($server->providerName == 'tuongtaccheo' ? 'selected' : ''); ?>>
                                              Tuongtaccheo.com</option>
                                              
                                            <!--<option value="tanglikeauto"-->
                                            <!--    <?php echo e($server->providerName == 'tanglikeauto' ? 'selected' : ''); ?>>-->
                                            <!--  tanglikeauto.vn</option>-->
                                            <option value="hacklike17"
                                                <?php echo e($server->providerName == 'hacklike17' ? 'selected' : ''); ?>>
                                                Hacklike17.com</option>
                                    
                                            <option value="dontay"
                                                <?php echo e($server->providerName == 'dontay' ? 'selected' : ''); ?>>
                                                Đơn tay</option>
                                            <?php $__currentLoopData = $smm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sitesmm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <option value="<?php echo e($sitesmm['name']); ?>"
                                                <?php if($server->providerName==$sitesmm['name'] ): ?> selected <?php endif; ?>>
                                                <?php echo e($sitesmm['name']); ?></option>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <label for="providerName">Nguồn dịch vụ</label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="providerLink" name="providerLink"
                                            value="<?php echo e($server->providerLink); ?>">
                                        <label for="providerLink">Đường dẫn dịch vụ</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="providerServer"
                                            name="providerServer" value="<?php echo e($server->providerServer); ?>">
                                        <label for="providerServer">Máy chủ gốc</label>
                                    </div>
                                </div>
                                <div class="col-md-6" hidden>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="providerKey" name="providerKey"
                                            value="null">
                                        <label for="providerKey">Mã dịch vụ</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="refund_status" id="refund_status" class="form-select">
                                         
                                            <option value="off"
                                                <?php echo e($server->action->refund_status == 'off' ? 'selected' : ''); ?>>
                                                Không hoàn tiền
                                            </option>
                                               <option value="on"
                                                <?php echo e($server->action->refund_status == 'on' ? 'selected' : ''); ?>>
                                                Có hoàn tiền
                                            </option>
                                        </select>
                                        <label for="refund_status">Hoàn tiền</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="warranty_status" id="warranty_status" class="form-select">
                                           
                                            <option value="off"
                                                <?php echo e($server->action->warranty_status == 'off' ? 'selected' : ''); ?>>
                                                Không Bảo hành
                                            </option>
                                             <option value="on"
                                                <?php echo e($server->action->warranty_status == 'on' ? 'selected' : ''); ?>>
                                                Có Bảo hành
                                            </option>
                                        </select>
                                        <label for="warranty_status">Bảo hành</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="renews_status" id="renews_status" class="form-select">
                                             <option value="off"
                                                <?php echo e($server->action->renews_status == 'off' ? 'selected' : ''); ?>>
                                                Không Gia hạn
                                            </option>
                                            <option value="on"
                                                <?php echo e($server->action->renews_status == 'on' ? 'selected' : ''); ?>>
                                                Có Gia hạn
                                            </option>
                                           
                                        </select>
                                        <label for="renews_status">Gia hạn</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="status" id="status" class="form-select">
                                            <option value="active" <?php echo e($server->status == 'active' ? 'selected' : ''); ?>>
                                                Hoạt động
                                            </option>
                                            <option value="inactive"
                                                <?php echo e($server->status == 'inactive' ? 'selected' : ''); ?>>
                                                Không hoạt động
                                            </option>
                                        </select>
                                        <label for="status">Trạng thái</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="visibility" id="visibility" class="form-select">
                                            <option value="public"
                                                <?php echo e($server->visibility == 'public' ? 'selected' : ''); ?>>
                                                Công khai
                                            </option>
                                            <option value="private"
                                                <?php echo e($server->visibility == 'private' ? 'selected' : ''); ?>>
                                                Riêng tư
                                            </option>
                                        </select>
                                        <label for="visibility">Hiển thị</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="reaction_status" id="reaction_status" class="form-select">
                                            <option value="">-- Chọn trạng thái --</option>
                                            <option value="on"
                                                <?php echo e($server->actions->first()->reaction_status == 'on' ? 'selected' : ''); ?>>
                                                Bật
                                            </option>
                                            <option value="off"
                                                <?php echo e($server->actions->first()->reaction_status == 'off' ? 'selected' : ''); ?>>
                                                Tắt
                                            </option>
                                        </select>
                                        <label for="reaction_status">Cảm xúc</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="quantity_status" id="quantity_status" class="form-select">
                                            <option value="">-- Chọn trạng thái --</option>
                                            <option value="on"
                                                <?php echo e($server->actions->first()->quantity_status == 'on' ? 'selected' : ''); ?>>
                                                Bật
                                            </option>
                                            <option value="off"
                                                <?php echo e($server->actions->first()->quantity_status == 'off' ? 'selected' : ''); ?>>
                                                Tắt
                                            </option>
                                        </select>
                                        <label for="quantity_status">Số lượng</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="comments_status" id="comments_status" class="form-select">
                                            <option value="">-- Chọn trạng thái --</option>
                                            <option value="on"
                                                <?php echo e($server->actions->first()->comments_status == 'on' ? 'selected' : ''); ?>>
                                                Bật
                                            </option>
                                            <option value="off"
                                                <?php echo e($server->actions->first()->comments_status == 'off' ? 'selected' : ''); ?>>
                                                Tắt
                                            </option>
                                        </select>
                                        <label for="comments_status">Bình luận</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="minutes_status" id="minutes_status" class="form-select">
                                            <option value="">-- Chọn trạng thái --</option>
                                            <option value="on"
                                                <?php echo e($server->actions->first()->minutes_status == 'on' ? 'selected' : ''); ?>>
                                                Bật
                                            </option>
                                            <option value="off"
                                                <?php echo e($server->actions->first()->minutes_status == 'off' ? 'selected' : ''); ?>>
                                                Tắt
                                            </option>
                                        </select>
                                        <label for="minutes_status">Số phút</label>
                                    </div>
                                </div>

 
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="time_status" id="time_status" class="form-select">
                                            <option value="off"
                                                <?php echo e($server->actions->first()->time_status == 'off' ? 'selected' : ''); ?>>
                                                Tắt
                                            </option>
                                            <option value="on"
                                                <?php echo e($server->actions->first()->time_status == 'on' ? 'selected' : ''); ?>>
                                                Bật
                                            </option>
                                        </select>
                                        <label for="time_status">Thời gian</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="posts_status" id="posts_status" class="form-select">
                                            <option value="off"
                                                <?php echo e($server->actions->first()->posts_status == 'off' ? 'selected' : ''); ?>>
                                                Tắt
                                            </option>
                                            <option value="on"
                                                <?php echo e($server->actions->first()->posts_status == 'on' ? 'selected' : ''); ?>>
                                                Bật
                                            </option>
                                        </select>
                                        <label for="posts_status">Bài viết</label>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle"></i> <strong>Lưu ý:</strong> Bạn
                                        cần nhập dữ liệu cảm xúc theo ví dụ như sau:
                                        <code>LIKE,HAHA,COMMENT</code> hoặc tất cả là <code>ALL</code>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="reaction_data" name="reaction_data"
                                            value="<?php echo e($server->actions->first()->reaction_data); ?>">
                                        <label for="reaction_data">Dữ liệu cảm xúc</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle"></i> <strong>Lưu ý:</strong>
                                        Thời gian tính theo giây và phải là số nguyên dương
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="minutes_data" name="minutes_data"
                                            value="<?php echo e($server->actions->first()->minutes_data); ?>">
                                        <label for="minutes_data">Dữ liệu thời gian</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save"></i> Sửa máy chủ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudgam/public_html/resources/views/admin/service/server-edit.blade.php ENDPATH**/ ?>