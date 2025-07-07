 <?php $__env->startSection('content'); ?> <?php $__env->startSection('title', 'Đặt hàng'); ?>
<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="card statistics-card-1">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avtar bg-brand-color-2 text-white me-3">
                        <i class="ph-duotone ph-scales f-26"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Conversion Rate</p>
                        <div class="d-flex align-items-end">
                            <h2 class="mb-0 f-w-500">8.57</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card statistics-card-1">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avtar bg-brand-color-2 text-white me-3">
                        <i class="ph-duotone ph-scales f-26"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Conversion Rate</p>
                        <div class="d-flex align-items-end">
                            <h2 class="mb-0 f-w-500">8.57</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card statistics-card-1">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avtar bg-brand-color-2 text-white me-3">
                        <i class="ph-duotone ph-scales f-26"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Conversion Rate</p>
                        <div class="d-flex align-items-end">
                            <h2 class="mb-0 f-w-500">8.57</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card statistics-card-1">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avtar bg-brand-color-2 text-white me-3">
                        <i class="ph-duotone ph-scales f-26"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Conversion Rate</p>
                        <div class="d-flex align-items-end">
                            <h2 class="mb-0 f-w-500">8.57</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h5>Khởi tạo đơn hàng</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('api.create.order')); ?>" method="POST" lamtilo-request="order">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card-inner">
                                <div class="preview-block">
                                    <div class="row gy-2">
                                        <div class="col-md-12">
                                            <input type="hidden" class="form-control" id="provider_package" name="provider_package" value="">
                                            <div class="form-group mb-3">
                                                <label class="form-label font-semibold">Link hoặc UID</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="object_id" name="object_id" onchange="checkPriceLt()" placeholder="Nhập link hoặc ID tuỳ các máy chủ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 ">
                                            <div class="form-group mb-3">
                                                <label class="form-label font-semibold">Nền tảng</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-control-select">
                                                        <select class="form-control font-semibold" id="platforms">
                                                            <option value="default_option" data-image="https://cdn.mypanel.link/4cgr8h/ewzs0f9k8ic2932y.gif">Tiktok</option>
                                                            <?php $__currentLoopData = \App\Models\ServicePlatform::where('domain', env('APP_MAIN_SITE'))->where('status', 'active')->orderBy('order', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($platform->status == 'active'): ?>
                                                            <option value="<?php echo e($platform->id); ?>" data-image="<?php echo e($platform->image); ?>"><?php echo e($platform->name); ?></option>
                                                            <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group mb-3">
                                                <label class="form-label font-semibold">Dịch vụ</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-control-select">
                                                        <select class="form-control font-semibold" id="services" name="services" placeholder="Chọn dịch vụ">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label font-semibold">Máy chủ</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-control-select">
                                                        <select class="form-control font-semibold" id="provider_server" name="provider_server"  onchange="checkPriceLt()">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="informationServer"></div>
                                        </div>
                                        <div class="col-md-12" id="quantity_type" style="display: none;">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control font-semibold" id="quantity" name="quantity" onkeyup="checkPriceLt()" placeholder="Số lượng"/>
                                                <span style="border-width:0px" class="input-group-text bg-primary text-white font-semibold" id="quantity_amount" onkeyup="checkPriceLt()">0đ</span>
                                            </div>
                                        </div>
                                        <div class="mb-5 reactions" id="reactions_type" style="display: none;">
                                            <label class="form-label" data-lang="Comments (1 per line)">Cảm xúc</label>
                                            <div class="">
                                                <div class=" form-check form-check-inline">
                                                    <label class="form-check-label " for="reaction0">
                                                    <input class="form-check-input checkbox d-none" type="radio" data-prices="101"
                                                        id="reaction0" name="reaction" value="like" checked="">
                                                    <img src="<?php echo e(asset('assets/pack-lamtilo/reaction/like.png')); ?>" alt="image"
                                                        class="d-block ml-2 rounded-circle" width="30">
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label " for="reaction1">
                                                    <input class="form-check-input checkbox d-none" type="radio" data-prices="100"
                                                        id="reaction1" name="reaction" value="love">
                                                    <img src="<?php echo e(asset('assets/pack-lamtilo/reaction/love.png')); ?>" alt="image"
                                                        class="d-block ml-2 rounded-circle" width="30">
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label " for="reaction2">
                                                    <input class="form-check-input checkbox d-none" type="radio" data-prices="100"
                                                        id="reaction2" name="reaction" value="care">
                                                    <img src="<?php echo e(asset('assets/pack-lamtilo/reaction/care.png')); ?>" alt="image"
                                                        class="d-block ml-2 rounded-circle" width="30">
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label " for="reaction3">
                                                    <input class="form-check-input checkbox d-none" type="radio" data-prices="100"
                                                        id="reaction3" name="reaction" value="haha">
                                                    <img src="<?php echo e(asset('assets/pack-lamtilo/reaction/haha.png')); ?>" alt="image"
                                                        class="d-block ml-2 rounded-circle" width="30">
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label " for="reaction4">
                                                    <input class="form-check-input checkbox d-none" type="radio" data-prices="100"
                                                        id="reaction4" name="reaction" value="wow">
                                                    <img src="<?php echo e(asset('assets/pack-lamtilo/reaction/wow.png')); ?>" alt="image"
                                                        class="d-block ml-2 rounded-circle" width="30">
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label " for="reaction6">
                                                    <input class="form-check-input checkbox d-none" type="radio" data-prices="100"
                                                        id="reaction6" name="reaction" value="sad">
                                                    <img src="<?php echo e(asset('assets/pack-lamtilo/reaction/sad.png')); ?>" alt="image"
                                                        class="d-block ml-2 rounded-circle" width="30">
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label " for="reaction7">
                                                    <input class="form-check-input checkbox d-none" type="radio" data-prices="100"
                                                        id="reaction7" name="reaction" value="angry">
                                                    <img src="<?php echo e(asset('assets/pack-lamtilo/reaction/angry.png')); ?>" alt="image"
                                                        class="d-block ml-2 rounded-circle" width="30">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-5 " id="speed_type" style="display: none;">
                                            <label class="form-label" data-lang="speeds (1 per line)">Tốc độ</label>
                                            <div class="">
                                                <div class="mb-2">
                                                    <div class="form-check"> <input type="radio" id="speed1" class="form-check-input"
                                                        onchange="bill()" name="speed" value="1" price="0"><label
                                                        class="form-check-label" for="speed1">Nhanh
                                                        (lên nhanh thì sẽ bị
                                                        nhanh tụt nhé.)</label>
                                                    </div>
                                                </div>
                                                <div class="mb-2">
                                                    <div class="form-check"><input type="radio" id="speed2" class="form-check-input"
                                                        onchange="bill()" name="speed" value="0" price="0"><label
                                                        class="form-check-label" for="speed2">Chậm (nên chọn cho ổn định,
                                                        sẽ không
                                                        chậm lắm đâu nhé.)</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-5 quantity" id="quantity_type" style="display: none;">
                                            <label class="form-label"><span data-lang="Quantity">Số lượng</span></label>
                                            <div class="input-group mb-2">
                                                <input type="text" onkeyup="checkPriceLt()" class="form-control" name="quantity"
                                                    placeholder="Số lượng cần lên" inputmode="text" id="quantityInput">
                                                <span class="input-group-text fw-bold text-primary charge amount_te" id="quantity_amount"> 0VND
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 comments" id="comments_type" style="display: none;">
                                            <label for="comments" class="form-label">
                                                <p>Nội dung bình luận: <span id="counter_comment" class="badge bg-success py-1">0</span></p>
                                                <div class="alert alert-warning text-warning mt-1 mb-0" id="">
                                                    - Mỗi comment một dòng<br>- Các ngôn từ bị cấm: dm|đm|đ m|d m|địt mẹ|dit
                                                    me|lol|lừađảo|conchó|trảtiền|mấtdạy|lừa đảo| con chó|trả tiền|mất dạy|lua dao|con
                                                    cho|tra tien|mat day
                                                </div>
                                            </label>
                                            <textarea class="form-control" name="comments" id="comments" rows="5"
                                                placeholder="Nhập nội dung bình luận" onkeyup="checkPriceLt()"></textarea>
                                        </div>
                                        <div class="form-group mb-3 minute" id="minute_type" style="display: none;">
                                            <label for="minute" class="form-label">
                                                <p>Số phút</p>
                                            </label>
                                            <select name="minutes" class="form-select" onchange="checkPriceLt()">
                                                <option value="15">15 phút</option>
                                                <option value="30">30 phút</option>
                                                <option value="60">60 phút</option>
                                                <option value="90">90 phút</option>
                                                <option value="120">120 phút</option>
                                                <option value="150">150 phút</option>
                                                <option value="180">180 phút</option>
                                                <option value="210">210 phút</option>
                                                <option value="240">240 phút</option>
                                                <option value="270">270 phút</option>
                                                <option value="300">300 phút</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12" id="time_type" style="display: none;">
                                                <div class="form-group mb-3">
                                                    <label for="duration" class="form-label">Thời gian:</label>
                                                    <select name="duration" id="duration" class="form-select" onchange="checkPriceLt()">
                                                        
                                                        <option value="30">30 Ngày</option>
                                                        <option value="60">60 Ngày</option>
                                                        <option value="90">90 Ngày</option>
                                                        <option value="120">120 Ngày</option>
                                                        <option value="150">150 Ngày</option>
                                                        <option value="180">180 Ngày</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-3" id="posts_type" style="display: none;">
                                                    <label for="posts" class="form-label">Số bài viết:</label>
                                                    
                                                    <select name="posts" id="posts" class="form-select">
                                                        <option value="unlimited">Không giới hạn</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label-outlined font-semibold">Ghi chú</label>
                                            <textarea type="text" class="form-control font-semibold form-control-outlined" style="min-height: 80px;"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary w-100 d-flex justify-content-center align-items-center rounded-lg" style="box-shadow: 0px 3px 0px #0776a9">Đặt hàng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="alert alert-success border-dashed font-semibold">
                                <p id="service_note"> • Vui lòng kiểm tra kĩ thông tin trước khi lên đơn.
                                <p>• Một số máy chủ có thể lên chậm do quá mọi người nên đặt số lượng nhỏ để test khi lên đơn lớn.</p>
                                </p>
                            </div>
                            <div class="alert alert-danger border-dashed font-semibold mt-3">
                                <p>• Nghiêm cấm buff các đơn có nội dung vi phạm pháp luật, chính trị, đồ trụy... Nếu cố tình buff bạn sẽ bị trừ hết tiền và ban khỏi hệ thống vĩnh viễn, và phải chịu hoàn toàn trách nhiệm trước pháp luật.&nbsp;</p>
                                <p>• Nếu đơn đang chạy trên hệ thống mà bạn vẫn mua ở các hệ thống bên khác, nếu có tình trạng hụt, thiếu số lượng giữa 2 bên thì sẽ không được xử lí.&nbsp;</p>
                                <p>• Đơn cài sai thông tin hoặc lỗi trong quá trình tăng hệ thống sẽ không hoàn lại tiền.</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<style>#services { height: 45px; } .select2-container .select2-selection--single { min-height: 45px; height: auto; line-height: 45px; font-weight: 600; border: 1.7px solid #dbdfea; border-radius: 0.625rem; } .select2-container--default .select2-results > .select2-results__options { max-height: 350px; overflow-y: auto; width: auto !important; } .select2-container--default .select2-results__option { line-height: 1.5; font-weight: 600; padding: 5px 15px; white-space: normal; word-wrap: break-word; width: 100%; } .select2-container--default .select2-results__options { scrollbar-width: thin; scrollbar-color: transparent transparent; } .select2-container--default .select2-results__options::-webkit-scrollbar { width: 1px; } .select2-container--default .select2-results__options::-webkit-scrollbar-thumb { background-color: transparent; border-radius: 5px; width: 1px; } .select2-container--default .select2-results__options::-webkit-scrollbar-track { background-color: transparent; } .select2-selection__arrow { display: none !important; } .select2-selection { padding-right: 0 !important; }</style>

<script>
    $(document).ready(function () {
      $('#platforms').select2({
        placeholder: '-- Chọn nền tảng --',
        allowClear: true,
        templateResult: formatState,  
        templateSelection: formatState,
        minimumResultsForSearch: 10, 
        language: {
            noResults: function () {
              return `
                   <div style="text-align: center">
                       <svg width="44" height="44" viewBox="0 0 184 152" xmlns="http://www.w3.org/2000/svg">
                           <g fill="none" fill-rule="evenodd">
                               <g transform="translate(24 31.67)">
                                   <ellipse fill-opacity=".8" fill="#F5F5F7" cx="67.797" cy="106.89" rx="67.797" ry="12.668"></ellipse>
                                   <path d="M122.034 69.674L98.109 40.229c-1.148-1.386-2.826-2.225-4.593-2.225h-51.44c-1.766 0-3.444.839-4.592 2.225L13.56 69.674v15.383h108.475V69.674z" fill="#AEB8C2"></path>
                                   <path d="M101.537 86.214L80.63 61.102c-1.001-1.207-2.507-1.867-4.048-1.867H31.724c-1.54 0-3.047.66-4.048 1.867L6.769 86.214v13.792h94.768V86.214z" fill="url(#linearGradient-1)" transform="translate(13.56)"></path>
                                   <path d="M33.83 0h67.933a4 4 0 0 1 4 4v93.344a4 4 0 0 1-4 4H33.83a4 4 0 0 1-4-4V4a4 4 0 0 1 4-4z" fill="#F5F5F7"></path>
                                   <path d="M42.678 9.953h50.237a2 2 0 0 1 2 2V36.91a2 2 0 0 1-2 2H42.678a2 2 0 0 1-2-2V11.953a2 2 0 0 1 2-2zM42.94 49.767h49.713a2.262 2.262 0 1 1 0 4.524H42.94a2.262 2.262 0 0 1 0-4.524zM42.94 61.53h49.713a2.262 2.262 0 1 1 0 4.525H42.94a2.262 2.262 0 0 1 0-4.525zM121.813 105.032c-.775 3.071-3.497 5.36-6.735 5.36H20.515c-3.238 0-5.96-2.29-6.734-5.36a7.309 7.309 0 0 1-.222-1.79V69.675h26.318c2.907 0 5.25 2.448 5.25 5.42v.04c0 2.971 2.37 5.37 5.277 5.37h34.785c2.907 0 5.277-2.421 5.277-5.393V75.1c0-2.972 2.343-5.426 5.25-5.426h26.318v33.569c0 .617-.077 1.216-.221 1.789z" fill="#DCE0E6"></path>
                               </g>
                           </g>
                       </svg>
                       <p class="font-semibold" style="color: #6c757d">Không có dữ liệu</p>
                   </div>
              `;
            }
          },
          escapeMarkup: function (markup) {
            return markup; // Không escape HTML
          }
      });
    
      $('#platforms').on('change', function () {
        const platform = $(this).val();
        const servicesSelect = $('#services');
        const inputFields = $('#provider_server');
      
        servicesSelect.empty();
        servicesSelect.append('<option value="" data-image="">-- Chọn dịch vụ --</option>');
        inputFields.empty();
        
        let services = [];
        <?php $__currentLoopData = \App\Models\ServicePlatform::where('domain', env('APP_MAIN_SITE'))->where('status', 'active')->orderBy('order', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          if (platform === '<?php echo e($platform->id); ?>') {
            services = [
              <?php $__currentLoopData = $platform->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                  value: '<?php echo e($service->id); ?>',
                  'data-image': '<?php echo e($platform->image); ?>',
                  note: `<?php echo $service->note; ?>`,
                  text: '<?php echo e($service->name); ?>'
                },
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ];
          }
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
        services.forEach(function (service) {
          const option = new Option(service.text, service.value);
          $(option).attr('data-image', service['data-image']);
          $(option).attr('data-note', service.note);
          servicesSelect.append(option);
        });
    
        servicesSelect.select2({
          placeholder: '-- Chọn dịch vụ --',
          allowClear: true,
          templateResult: formatState,
          templateSelection: formatState,
          minimumResultsForSearch: 10,
          language: {
            noResults: function () {
              return `
                   <div style="text-align: center">
                       <svg width="44" height="44" viewBox="0 0 184 152" xmlns="http://www.w3.org/2000/svg">
                           <g fill="none" fill-rule="evenodd">
                               <g transform="translate(24 31.67)">
                                   <ellipse fill-opacity=".8" fill="#F5F5F7" cx="67.797" cy="106.89" rx="67.797" ry="12.668"></ellipse>
                                   <path d="M122.034 69.674L98.109 40.229c-1.148-1.386-2.826-2.225-4.593-2.225h-51.44c-1.766 0-3.444.839-4.592 2.225L13.56 69.674v15.383h108.475V69.674z" fill="#AEB8C2"></path>
                                   <path d="M101.537 86.214L80.63 61.102c-1.001-1.207-2.507-1.867-4.048-1.867H31.724c-1.54 0-3.047.66-4.048 1.867L6.769 86.214v13.792h94.768V86.214z" fill="url(#linearGradient-1)" transform="translate(13.56)"></path>
                                   <path d="M33.83 0h67.933a4 4 0 0 1 4 4v93.344a4 4 0 0 1-4 4H33.83a4 4 0 0 1-4-4V4a4 4 0 0 1 4-4z" fill="#F5F5F7"></path>
                                   <path d="M42.678 9.953h50.237a2 2 0 0 1 2 2V36.91a2 2 0 0 1-2 2H42.678a2 2 0 0 1-2-2V11.953a2 2 0 0 1 2-2zM42.94 49.767h49.713a2.262 2.262 0 1 1 0 4.524H42.94a2.262 2.262 0 0 1 0-4.524zM42.94 61.53h49.713a2.262 2.262 0 1 1 0 4.525H42.94a2.262 2.262 0 0 1 0-4.525zM121.813 105.032c-.775 3.071-3.497 5.36-6.735 5.36H20.515c-3.238 0-5.96-2.29-6.734-5.36a7.309 7.309 0 0 1-.222-1.79V69.675h26.318c2.907 0 5.25 2.448 5.25 5.42v.04c0 2.971 2.37 5.37 5.277 5.37h34.785c2.907 0 5.277-2.421 5.277-5.393V75.1c0-2.972 2.343-5.426 5.25-5.426h26.318v33.569c0 .617-.077 1.216-.221 1.789z" fill="#DCE0E6"></path>
                               </g>
                           </g>
                       </svg>
                       <p class="font-semibold" style="color: #6c757d">Không có dữ liệu</p>
                   </div>
              `;
            }
          },
          escapeMarkup: function (markup) {
            return markup; // Không escape HTML
          }
        });
    
        // Lắng nghe sự kiện thay đổi của #services
        servicesSelect.on('change', function () {
          const service = $(this).val();
          inputFields.empty();
          inputFields.append('<option value="" data-image="https://cdn-icons-png.flaticon.com/128/14534/14534366.png">-- Chọn máy chủ --</option>');
          const selectedOption = $(this).find('option:selected');
          const note = selectedOption.attr('data-note');
    
          // Hiển thị ghi chú dịch vụ
          if (note) {
            $('#service_note').html(note);
          } else {
            $('#service_note').html('');
          }
    
          // Nếu đã chọn dịch vụ, thêm các server vào #provider_server
          if (service !== "") {
            <?php $__currentLoopData = \App\Models\ServicePlatform::where('domain', env('APP_MAIN_SITE'))->where('status', 'active')->orderBy('order', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php $__currentLoopData = $platform->services->where('domain', request()->getHost()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                if (service === '<?php echo e($serviceItem->id); ?>') {
                  $('#provider_package').val('<?php echo e($serviceItem->package); ?>');
                  inputFields.append(`
                    <?php $__currentLoopData = $serviceItem->servers->where('domain', request()->getHost()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option
                              id="provider-server-<?php echo e($server->package_id); ?>" 
                              value="<?php echo e($server->package_id); ?>" 
                              name="provider_server" 
                              platform="<?php echo e($platform->id); ?>" 
                              provider_package="<?php echo e($serviceItem->package); ?>" 
                              data-details="<?php echo e($server->details); ?>" 
                              data-min="<?php echo e($server->min); ?>" 
                              data-max="<?php echo e($server->max); ?>" 
                              data-quantity="<?php echo e($server->action->quantity_status); ?>" 
                              data-reaction="<?php echo e($server->action->reaction_status); ?>" 
                              data-comment="<?php echo e($server->action->comments_status); ?>" 
                              data-getuid="<?php echo e($server->action->get_uid); ?>" 
                              data-minute="<?php echo e($server->action->minutes_status); ?>" 
                              data-reaction_type="<?php echo e($server->action->reaction_data ?? 'all'); ?>" 
                              data-comment_type="<?php echo e($server->action->comments_data); ?>" 
                              data-minute_type="<?php echo e($server->action->minutes_data); ?>" 
                              data-posts="<?php echo e($server->action->posts_status); ?>" 
                              data-posts_type="<?php echo e($server->action->posts_data); ?>" 
                              data-time="<?php echo e($server->action->time_status); ?>" 
                              data-time_type="<?php echo e($server->action->time_data); ?>" 
                              data-image="<?php echo e($platform->image); ?>"
                              onclick="checkPrice()"
                            <?php if(Auth::check()): ?> 
                                data-price="<?php echo e($server->levelPrice(Auth::user()->level)); ?>" 
                            <?php else: ?> 
                                data-price="<?php echo e($server->price_member); ?>" 
                            <?php endif; ?> 
                    data-info='
                                <span class="font-semibold text-primary">[MC: <?php echo e($server->id); ?>] </span> <span >- <?php echo ucwords($server->name); ?> - </span> <span class="text-danger font-semibold"><?php echo e($server->price_member); ?>đ</span>
                                    <br>
                                <span class="badge rounded-pill bg-primary font-semibold" style="box-shadow: 0px 2px 0px #293D97">Sv: <?php echo e($server->id); ?></span>
                                <span class="badge rounded-pill bg-info font-semibold" style="box-shadow: 0px 2px 0px #088fa3">
                                <?php if(Auth::check()): ?>
                                    <?php echo e($server->levelPrice(Auth::user()->level) * 1000); ?>đ per 1000
                                <?php else: ?>
                                    <?php echo e($server->price_member); ?>đ
                                <?php endif; ?>
                                </span>
                            <?php if($server->status === 'active'): ?>
                                <?php if($server->limit_day > 0): ?>
                                    <span class="badge rounded-pill bg-warning font-semibold" style="box-shadow: 0px 2px 0px #cd9c00">Giới hạn: <?php echo e(number_format($server->limit_day)); ?> đơn/ Ngày</span>
                                <?php endif; ?>
                                <span class="badge rounded-pill bg-success font-semibold" style="box-shadow: 0px 2px 0px #0b7452">Hoạt động</span>
                            <?php else: ?>
                                <span class="badge rounded-pill bg-danger font-semibold" style="box-shadow: 0px 2px 0px #bf1526">Bảo trì</span>
                            <?php endif; ?>
                                '>
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  `);
                }
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          }
        });
      });
    
      // Hàm formatState để hiển thị hình ảnh và tên cho các lựa chọn trong Select2
      function formatState(state) {
        if (!state.id) {
          return state.text;
        }
        var $state = $('<span><img src="' + $(state.element).data('image') + '" style="width: 24px; height: 24px; margin-right: 10px; vertical-align: middle; display: inline-block;" /> ' + state.text + '</span>');
        return $state;
      }
    
      // Khởi tạo Select2 cho #provider_server
      $('#services, #provider_server').select2({
        placeholder: '-- Chọn dịch vụ --',
        templateResult: function (state) {
          if (!state.id) {
            return state.text;
          }
          const image = $(state.element).data("image") || "";
          const info = $(state.element).data("info") || "";
          const customContent = `
            <span>
              <img src="${image}" style="width: 24px; height: 24px; margin-right: 10px;" />
                ${info}
            </span>
          `;
          return $(customContent);
        },
        templateSelection: function (state) {
          if (!state.id) {
            return state.text;
          }
          const image = $(state.element).data("image") || "";
          const info = $(state.element).data("info") || "";
          const customContent = `
            <span>
              <img src="${image}" style="width: 24px; height: 24px; margin-right: 10px;" />
                ${info}
            </span>
          `;
          return $(customContent);
        },
        dropdownParent: $("body"),
        minimumResultsForSearch: Infinity,
        language: {
          noResults: function () {
            return `
                   <div style="text-align: center">
                       <svg width="44" height="44" viewBox="0 0 184 152" xmlns="http://www.w3.org/2000/svg">
                           <g fill="none" fill-rule="evenodd">
                               <g transform="translate(24 31.67)">
                                   <ellipse fill-opacity=".8" fill="#F5F5F7" cx="67.797" cy="106.89" rx="67.797" ry="12.668"></ellipse>
                                   <path d="M122.034 69.674L98.109 40.229c-1.148-1.386-2.826-2.225-4.593-2.225h-51.44c-1.766 0-3.444.839-4.592 2.225L13.56 69.674v15.383h108.475V69.674z" fill="#AEB8C2"></path>
                                   <path d="M101.537 86.214L80.63 61.102c-1.001-1.207-2.507-1.867-4.048-1.867H31.724c-1.54 0-3.047.66-4.048 1.867L6.769 86.214v13.792h94.768V86.214z" fill="url(#linearGradient-1)" transform="translate(13.56)"></path>
                                   <path d="M33.83 0h67.933a4 4 0 0 1 4 4v93.344a4 4 0 0 1-4 4H33.83a4 4 0 0 1-4-4V4a4 4 0 0 1 4-4z" fill="#F5F5F7"></path>
                                   <path d="M42.678 9.953h50.237a2 2 0 0 1 2 2V36.91a2 2 0 0 1-2 2H42.678a2 2 0 0 1-2-2V11.953a2 2 0 0 1 2-2zM42.94 49.767h49.713a2.262 2.262 0 1 1 0 4.524H42.94a2.262 2.262 0 0 1 0-4.524zM42.94 61.53h49.713a2.262 2.262 0 1 1 0 4.525H42.94a2.262 2.262 0 0 1 0-4.525zM121.813 105.032c-.775 3.071-3.497 5.36-6.735 5.36H20.515c-3.238 0-5.96-2.29-6.734-5.36a7.309 7.309 0 0 1-.222-1.79V69.675h26.318c2.907 0 5.25 2.448 5.25 5.42v.04c0 2.971 2.37 5.37 5.277 5.37h34.785c2.907 0 5.277-2.421 5.277-5.393V75.1c0-2.972 2.343-5.426 5.25-5.426h26.318v33.569c0 .617-.077 1.216-.221 1.789z" fill="#DCE0E6"></path>
                               </g>
                           </g>
                       </svg>
                       <p class="font-semibold" style="color: #6c757d">Không có dữ liệu</p>
                   </div>
            `;
          }
        },
        escapeMarkup: function (markup) {
          return markup; // Không escape HTML
        },
      });
    
      // Vô hiệu hóa việc mở bàn phím khi nhấn vào ô select
      $('#platforms').on('select2:opening', function (e) {
        $(this).siblings(".select2-container").find(".select2-search__field").focus();
      });
    });
</script>

<script src="<?php echo e(asset('assets/pack-lamtilo/js/service.js?time=')); ?><?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('guard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/trumsubr/public_html/resources/views/guard/service/new.blade.php ENDPATH**/ ?>