<?php $__env->startSection('title', $category->name); ?>
<style>
    .product-detail__info--sections {
    align-items: center;
    display: flex
    }
    .product-detail__info--sections>* {
    width: 33.3333333333%
    }
    .product-detail__info--section {
    align-items: center;
    display: flex;
    gap: 16px
    }
    .product-detail__info--section-skeleton {
    background: #f2f4f5;
    border-radius: 58px;
    height: 46px
    }
    .product-detail__info--section-icon {
    align-items: center;
    background: linear-gradient(11deg, #00bf5d, #00907c);
    border-radius: 30px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    height: 40px;
    justify-content: center;
    padding: 10px;
    width: 40px
    }
    .product-detail__info--section-icon i,
    .product-detail__info--section-icon img,
    .product-detail__info--section-icon svg {
    flex-shrink: 0;
    height: 24px;
    width: 24px
    }
    .product-detail__info--section-content {
    display: flex;
    flex-direction: column;
    gap: 2px
    }
    .product-detail__info--section-content-title {
    color: #263a4d;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    letter-spacing: .14px;
    line-height: 22px
    }
    .product-detail__info--section-content-value {
    color: #212f3f;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    letter-spacing: .175px;
    line-height: 22px
    }
    .product-detail__information-detail--title {
    border-left: 6px solid var(--bs-success);
    color: #212f3f;
    font-size: 20px;
    font-style: normal;
    font-weight: 700;
    letter-spacing: 0.5px;
    line-height: 28px;
    margin: 0;
    padding-left: 10px
    }
    .product-detail__information-detail--description {
    font-size: 15px;
    margin-top: 10px;
    }
    .product__option {
    margin-bottom: 18px;
    }
    .product__option:last-child {
    margin-bottom: 0;
    }
    .product__option-label {
    font-size: 13px;
    text-transform: uppercase;
    font-weight: 500;
    color: #6c757d;
    padding-bottom: 5px;
    }
    .product__actions {
    display: flex;
    flex-wrap: wrap;
    margin: -4px;
    }
    .product__actions-item {
    margin: 4px;
    }
    .product__quantity {
    width: 120px;
    }
    .product-images {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    }
    .product-images__list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    overflow: auto;
    }
    .product-images__item {
    border: 1px solid #e5e5e5;
    border-radius: 5px;
    overflow: hidden;
    width: 100px;
    height: 100px;
    cursor: pointer;
    }
    .product-images__item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    }
</style>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-5">
                        <div class="sticky-md-top mb-3">
                            <a class="img-post card social-gallery-card"
                                data-lightbox="<?php echo e(asset(json_decode($category->image, true)[0] ?? 'images/default-image.jpg')); ?>">
                                <img src="<?php echo e(asset(json_decode($category->image, true)[0] ?? 'images/default-image.jpg')); ?>"
                                    class="card-img d-block w-100" alt="Product images">
                                <div class="card-img-overlay">
                                    <i class="ti ti-eye"></i>
                                </div>
                            </a>
                        </div>
                        <div class="product-images">
                            <div class="product-images__list">
                                <?php $__currentLoopData = json_decode($category->image, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="product-images__item"
                                    data-lightbox="<?php echo e(asset($image)); ?>">
                                <img src="<?php echo e(asset($image)); ?>" alt="Product images">
                                </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 mb-5">
                        <span class="badge bg-success mb-3 f-14">Sản Phẩm</span>
                        <h3 class="product-detail__information-detail--title mb-0"><?php echo e($category->name); ?></h3>
                        <p class="product-detail__information-detail--description mb-0"><?php echo $category->note; ?></p>
                        <hr>
                        <div class="product-detail__info--sections mb-4">
                            <div class="product-detail__info--section" id="product-detail-info-experience">
                                <div class="product-detail__info--section-icon">
                                    <svg id="Layer" fill="white" height="512" viewBox="0 0 24 24" width="512"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path id="box"
                                            d="m10.48 11.15a4.285 4.285 0 0 0 .77.24v9.52a2.64 2.64 0 0 1 -.47-.17l-6-2.67a3 3 0 0 1 -1.78-2.74v-6.66a2.955 2.955 0 0 1 .11-.79zm4.34-2.23-8.15-3.83-1.89.84a2.909 2.909 0 0 0 -.91.63l7.21 3.21a2.268 2.268 0 0 0 1.84 0zm5.31-2.36a2.909 2.909 0 0 0 -.91-.63l-6-2.67a2.966 2.966 0 0 0 -2.44 0l-2.29 1.02 8.15 3.83zm.76 1.32-3.51 1.56v2.45a.75.75 0 1 1 -1.5 0v-1.79l-2.36 1.05a5.275 5.275 0 0 1 -.77.24v9.52a2.64 2.64 0 0 0 .47-.17l6-2.67a3 3 0 0 0 1.78-2.74v-6.66a2.955 2.955 0 0 0 -.11-.79z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="product-detail__info--section-content">
                                    <div class="product-detail__info--section-content-title">Tồn Kho</div>
                                    <div class="product-detail__info--section-content-value ipt-warehouse"><?php echo e(number_format($category->products->where('status', 'selling')->count())); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="product-price mb-3">
                            <span class="pro-title">Giá Tiền: </span>
                            <span class="pro-price"><?php echo e(number_format($category->price)); ?> VNĐ</span>
                        </div>
                        <div class="product__actions">
                            <button type="button" onclick="handleBuy()"
                                class="btn btn-primary product__actions-item">Mua Ngay</button>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6 justify-content-center"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#description"
                                    aria-selected="true" role="tab">Mô Tả</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                <?php echo $category->description; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $.ajaxSetup({
        headers: {
            "X-Access-Token": $('meta[name="access-token"]').attr('content')
        }
    });
    
    function handleBuy() {
        Swal.fire({
            title: 'Bạn muốn mua sản phẩm này?',
            text: "Hãy chắc chắn rằng bạn đã đọc kỹ thông tin sản phẩm trước khi mua!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Mua ngay',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo e(route('api.product.order')); ?>',
                    type: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        id_product: '<?php echo e($category->id); ?>'
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Đang xử lý...',
                            html: 'Vui lòng chờ trong giây lát',
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire(
                                'Thành công!',
                                response.message,
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Thất bại!',
                                response.message || 'Không có thông báo chi tiết',
                                'error'
                            );
                        }
                    },
                    error: function(xhr) {
                        // Kiểm tra nếu có lỗi trong response
                        let errorMessage = 'Có lỗi xảy ra, vui lòng thử lại sau';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message; // Lấy thông báo lỗi từ API
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            // Nếu có lỗi chi tiết (validation errors hoặc lỗi khác)
                            errorMessage = xhr.responseJSON.errors.join(' '); // Liên kết các lỗi nếu có
                        }
    
                        Swal.fire(
                            'Thất bại!',
                            errorMessage,
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('guard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cloudgam/public_html/resources/views/guard/product/view-category.blade.php ENDPATH**/ ?>