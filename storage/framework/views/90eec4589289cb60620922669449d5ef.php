 
<?php $__env->startSection('content'); ?> 
<?php $__env->startSection('title', 'Trang chủ'); ?>
<div class="row">
    <div class="col-md-8">
        <div class="scroll-notification p-2" style="max-height: 800px">
            <?php $__currentLoopData = \App\Models\NoticeSystem::where('domain', request()->getHost())->orderBy('id', 'desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noticeSystem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-itemsThống Kê Đơn Hàng
-center mb-3">
                        <div class="flex-shrink-0">
                            <div class="chat-avtar">
                                <img class="rounded-circle img-fluid wid-40" src="../app/images/user/avatar-1.jpg" alt="User image">
                                <div class="bg-success chat-badge"></div>
                            </div>
                        </div>
                        <div class="flex-grow-1 mx-2">
                            <h5 class="mb-0"><?php echo e($noticeSystem->title); ?></h5>
                            <span class="text-sm text-muted"><?php echo e($noticeSystem->created_at); ?></span>
                        </div>
                    </div>
                    <p class="mb-3"><?php echo $noticeSystem->content; ?></p>
                    <div class="row my-3">
                        <div class="col">
                            <a href="javascript:void(0)" class="btn btn-link-dark m-1">
                            <i class="ph-duotone ph-thumbs-up me-1"></i> 450K <small class="text-muted">Likes</small></a>
                            <a href="javascript:void(0)" class="btn btn-link-secondary m-1">
                            <i class="ph-duotone ph-share-network me-1"></i>100 <small class="text-muted">Share</small></a>
                        </div>
                        <div class="col-auto text-end">
                            <div class="d-flex align-items-center">
                                <div class="user-group post-user-group">
                                    <img src="../app/images/user/avatar-1.jpg" alt="user-image" class="avtar">
                                    <img src="../app/images/user/avatar-2.jpg" alt="user-image" class="avtar">
                                    <span class="avtar bg-danger text-white"><span class="f-12">K</span></span>
                                    <img src="../app/images/user/avatar-3.jpg" alt="user-image" class="avtar">
                                    <span class="avtar bg-success text-white">
                                        <svg class="pc-icon m-0">
                                            <use xlink:href="#custom-user"></use>
                                        </svg>
                                    </span>
                                    <img src="../app/images/user/avatar-4.jpg" alt="user-image" class="avtar">
                                    <span class="avtar bg-light-primary text-primary"><span class="f-12">+2</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-3">
                        <div class="flex-shrink-0">
                            <img class="img-radius d-none d-sm-inline-flex me-3 wid-40 rounded-circle" src="https://ui-avatars.com/api/?background=random&name=<?php echo e(Auth::user()->name ?? 'Bạn chưa đăng nhập'); ?>" alt="User image">
                        </div>
                        <div class="flex-grow-1 me-3">
                            <div class="input-comment">
                                <input type="email" class="form-control" placeholder="Type a something...">
                                <ul class="list-inline start-0 mb-0">
                                    <li class="list-inline-item border-end pe-2 me-2">
                                        <a href="javascript:void(0)" class="avtar avtar-xs btn-link-warning">
                                        <i class="ti ti-mood-smile f-18"></i>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="list-inline end-0 mb-0">
                                    <li class="list-inline-item">
                                        <a href="javascript:void(0)" class="avtar avtar-xs btn-link-secondary">
                                        <i class="ti ti-photo f-18"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript:void(0)" class="avtar avtar-xs btn-link-secondary">
                                        <i class="ti ti-paperclip f-18"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="javascript:void(0)" class="avtar avtar-s btn btn-primary">
                            <i class="ti ti-send f-18"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <div class="card user-card">
            <div class="card-body">
                <div class="user-cover-bg">
                    <img src="/app/images/application/img-user-cover-1.jpg" alt="image" class="img-fluid">
                    <div class="cover-data">
                        <div class="d-inline-flex align-items-center">
                            <i class="ph-duotone ph-star text-warning me-1"></i>
                            4.5 <small class="text-white text-opacity-50">/ 5</small>
                        </div>
                    </div>
                </div>
                <div class="chat-avtar card-user-image">
                    <img src="https://ui-avatars.com/api/?background=random&name=<?php echo e(Auth::user()->name ?? 'Bạn chưa đăng nhập'); ?>" alt="user-image" class="img-thumbnail rounded-circle">
                    <i class="chat-badge bg-success"></i>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <div class="flex-grow-1">
                        <h6 class="mb-1"><?php echo e(Auth::user()->name ?? 'Bạn chưa đăng nhập'); ?></h6>
                        <p class="text-primary"><span>@</span><?php echo e(Auth::user()->username ?? 'Noname'); ?></p>
                    </div>
                    <div class="flex-shrink-0">
                        <button class="btn btn-primary btn-sm">Message</button>
                        <button class="btn btn-outline-secondary btn-sm ms-1">Follow</button>
                    </div>
                </div>
                <?php if(Auth::check()): ?>
                <div class="row g-3 my-3 text-center">
                    <div class="col-4">
                        <h6 class="mb-0"><?php echo e(number_format(Auth::user()->balance)); ?>đ</h6>
                        <small class="text-muted">Số dư</small>
                    </div>
                    <div class="col-4">
                        <h6 class="mb-0"><?php echo e(number_format(Auth::user()->total_recharge)); ?>đ</h6>
                        <small class="text-muted">Tổng nạp</small>
                    </div>
                    <div class="col-4">
                        <h6 class="mb-0"><?php echo e(number_format(Auth::user()->total_recharge - Auth::user()->balance, 0, ',', '.')); ?>đ</h6>
                        <small class="text-muted">Đã tiêu</small>
                    </div>
                </div>
                <?php endif; ?>
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-animate" id="notiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mb-3">
                    <h2>THÔNG BÁO</h2>
                </div>
                <?php echo siteValue('notice'); ?>

                <div class="mt-2 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary shadow-2" id="btn-close-notice">Tôi đã đọc</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/app/js/plugins/apexcharts.min.js"></script>
<?php if(Auth::check()): ?>
<script>
    const labels = <?php echo json_encode($labels, 15, 512) ?>;
    const rechargeData = <?php echo json_encode($data['recharge'], 15, 512) ?>;

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar', 
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Tổng nạp',
                    data: rechargeData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
  'use strict';
  setTimeout(function () {
    (function () {
      var options_order_statistics = {
        chart: {
          height: 350,
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        colors: [
        //'#F4C22B', 
        '#F4A6A6', 
        '#04A9F5', 
        '#4B0082', 
        '#FF8C00', 
        '#F44236', 
        '#28a745'],
        series: [
          //{
          //  name: 'Tổng đơn hàng',
          //  data: <?php echo json_encode($totalOrder, 15, 512) ?>
          //},
          {
            name: 'Đang chờ',
            data: <?php echo json_encode($totalPending, 15, 512) ?>
          },
          {
            name: 'Đang chạy',
            data: <?php echo json_encode($totalProcessing, 15, 512) ?>
          },
          {
            name: 'Đã huỷ',
            data: <?php echo json_encode($totalCanceled, 15, 512) ?>
          },
          {
            name: 'Chờ hoàn tiền',
            data: <?php echo json_encode($totalPendingRefundCancel, 15, 512) ?>
          },
          {
            name: 'Hoàn tiền',
            data: <?php echo json_encode($totalRefund, 15, 512) ?>
          },
          {
            name: 'Hoàn thành',
            data: <?php echo json_encode($totalCompleted, 15, 512) ?>
          }
        ],
        xaxis: {
          categories: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'], // Tháng trong năm
        },
        tooltip: {
          shared: true,
          intersect: false
        }
      };

      var chart_order_statistics = new ApexCharts(document.querySelector('#order-statistics'), options_order_statistics);
      chart_order_statistics.render();
    })();
  }, 700);
</script>
<?php else: ?>
<script>
    const rechargeData = Array.from({ length: 12 }, () => Math.floor(Math.random() * 1000));

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar', 
        data: {
            labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
            datasets: [
                {
                    label: 'Tổng nạp',
                    data: rechargeData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
  'use strict';
  setTimeout(function () {
    (function () {
      var options_order_statistics = {
        chart: {
          height: 350,
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        colors: [
          '#F4A6A6', 
          '#04A9F5', 
          '#4B0082', 
          '#FF8C00', 
          '#F44236', 
          '#28a745'
        ],
        series: [
          {
            name: 'Đang chờ',
            data: Array.from({ length: 12 }, () => Math.floor(Math.random() * 100)) 
          },
          {
            name: 'Đang chạy',
            data: Array.from({ length: 12 }, () => Math.floor(Math.random() * 100))
          },
          {
            name: 'Đã huỷ',
            data: Array.from({ length: 12 }, () => Math.floor(Math.random() * 50))
          },
          {
            name: 'Chờ hoàn tiền',
            data: Array.from({ length: 12 }, () => Math.floor(Math.random() * 20))
          },
          {
            name: 'Hoàn tiền',
            data: Array.from({ length: 12 }, () => Math.floor(Math.random() * 30))
          },
          {
            name: 'Hoàn thành',
            data: Array.from({ length: 12 }, () => Math.floor(Math.random() * 100))
          }
        ],
        xaxis: {
          categories: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
        },
        tooltip: {
          shared: true,
          intersect: false
        }
      };

      var chart_order_statistics = new ApexCharts(document.querySelector('#order-statistics'), options_order_statistics);
      chart_order_statistics.render();
    })();
  }, 700);
</script>

<?php endif; ?>
    <script>
        $(document).ready(function() {
            let isNoticeModal = localStorage.getItem('isNoticeModal');

            let time = 60 * 60 * 1000;

            if (new Date().getTime() - isNoticeModal > time) {
                $('#notiModal').modal('show');
            }

            $('#btn-close-notice').click(function() {
                localStorage.setItem('isNoticeModal', new Date().getTime());
                $('#notiModal').modal('hide');
            });

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('guard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dailysie/khosubvip.top/resources/views/guard/home.blade.php ENDPATH**/ ?>