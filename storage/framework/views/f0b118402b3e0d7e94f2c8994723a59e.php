<?php $__env->startSection('title', 'Trang thống kê'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top">
                    <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-primary">
                            <svg class="svg-white" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                <rect fill="none" height="24" width="24"></rect>
                                <g>
                                    <path d="M4,13c1.1,0,2-0.9,2-2c0-1.1-0.9-2-2-2s-2,0.9-2,2C2,12.1,2.9,13,4,13z M5.13,14.1C4.76,14.04,4.39,14,4,14 c-0.99,0-1.93,0.21-2.78,0.58C0.48,14.9,0,15.62,0,16.43V18l4.5,0v-1.61C4.5,15.56,4.73,14.78,5.13,14.1z M20,13c1.1,0,2-0.9,2-2 c0-1.1-0.9-2-2-2s-2,0.9-2,2C18,12.1,18.9,13,20,13z M24,16.43c0-0.81-0.48-1.53-1.22-1.85C21.93,14.21,20.99,14,20,14 c-0.39,0-0.76,0.04-1.13,0.1c0.4,0.68,0.63,1.46,0.63,2.29V18l4.5,0V16.43z M16.24,13.65c-1.17-0.52-2.61-0.9-4.24-0.9 c-1.63,0-3.07,0.39-4.24,0.9C6.68,14.13,6,15.21,6,16.39V18h12v-1.61C18,15.21,17.32,14.13,16.24,13.65z M8.07,16 c0.09-0.23,0.13-0.39,0.91-0.69c0.97-0.38,1.99-0.56,3.02-0.56s2.05,0.18,3.02,0.56c0.77,0.3,0.81,0.46,0.91,0.69H8.07z M12,8 c0.55,0,1,0.45,1,1s-0.45,1-1,1s-1-0.45-1-1S11.45,8,12,8 M12,6c-1.66,0-3,1.34-3,3c0,1.66,1.34,3,3,3s3-1.34,3-3 C15,7.34,13.66,6,12,6L12,6z">
                                    </path>
                                </g>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                <?php echo e(number_format($totalUser)); ?>                                  
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">TỔNG THÀNH VIÊN</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top">
                    <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-primary">
                            <svg class="svg-white" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                <rect fill="none" height="24" width="24"></rect>
                                <g>
                                    <path d="M4,13c1.1,0,2-0.9,2-2c0-1.1-0.9-2-2-2s-2,0.9-2,2C2,12.1,2.9,13,4,13z M5.13,14.1C4.76,14.04,4.39,14,4,14 c-0.99,0-1.93,0.21-2.78,0.58C0.48,14.9,0,15.62,0,16.43V18l4.5,0v-1.61C4.5,15.56,4.73,14.78,5.13,14.1z M20,13c1.1,0,2-0.9,2-2 c0-1.1-0.9-2-2-2s-2,0.9-2,2C18,12.1,18.9,13,20,13z M24,16.43c0-0.81-0.48-1.53-1.22-1.85C21.93,14.21,20.99,14,20,14 c-0.39,0-0.76,0.04-1.13,0.1c0.4,0.68,0.63,1.46,0.63,2.29V18l4.5,0V16.43z M16.24,13.65c-1.17-0.52-2.61-0.9-4.24-0.9 c-1.63,0-3.07,0.39-4.24,0.9C6.68,14.13,6,15.21,6,16.39V18h12v-1.61C18,15.21,17.32,14.13,16.24,13.65z M8.07,16 c0.09-0.23,0.13-0.39,0.91-0.69c0.97-0.38,1.99-0.56,3.02-0.56s2.05,0.18,3.02,0.56c0.77,0.3,0.81,0.46,0.91,0.69H8.07z M12,8 c0.55,0,1,0.45,1,1s-0.45,1-1,1s-1-0.45-1-1S11.45,8,12,8 M12,6c-1.66,0-3,1.34-3,3c0,1.66,1.34,3,3,3s3-1.34,3-3 C15,7.34,13.66,6,12,6L12,6z">
                                    </path>
                                </g>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                <?php echo e(number_format($totalUserToday)); ?>                           
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">THÀNH VIÊN HÔM NAY</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top">
                    <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M3 10V8a2 2 0 0 1 2-2h2m-4 4c1.333 0 4-.8 4-4m-4 4v4m18-4V8a2 2 0 0 0-2-2h-2m4 4c-1.333 0-4-.8-4-4m4 4v4M7 6h10m4 8v2a2 2 0 0 1-2 2h-2m4-4c-1.333 0-4 .8-4 4m0 0H7m-4-4v2a2 2 0 0 0 2 2h2m-4-4c1.333 0 4 .8 4 4"/>
                                    <circle cx="12" cy="12" r="2"/>
                                </g>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                <?php echo e(number_format($totalRecharge)); ?>                                   
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">TỔNG NẠP</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top">
                    <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M3 10V8a2 2 0 0 1 2-2h2m-4 4c1.333 0 4-.8 4-4m-4 4v4m18-4V8a2 2 0 0 0-2-2h-2m4 4c-1.333 0-4-.8-4-4m4 4v4M7 6h10m4 8v2a2 2 0 0 1-2 2h-2m4-4c-1.333 0-4 .8-4 4m0 0H7m-4-4v2a2 2 0 0 0 2 2h2m-4-4c1.333 0 4 .8 4 4"/>
                                    <circle cx="12" cy="12" r="2"/>
                                </g>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                <?php echo e(number_format($totalBalance)); ?>                                 
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">TỔNG SỐ DƯ</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top">
                    <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M8.422 20.618C10.178 21.54 11.056 22 12 22V12L2.638 7.073l-.04.067C2 8.154 2 9.417 2 11.942v.117c0 2.524 0 3.787.597 4.801c.598 1.015 1.674 1.58 3.825 2.709z"/>
                                <path fill="currentColor" d="m17.577 4.432l-2-1.05C13.822 2.461 12.944 2 12 2c-.945 0-1.822.46-3.578 1.382l-2 1.05C4.318 5.536 3.242 6.1 2.638 7.072L12 12l9.362-4.927c-.606-.973-1.68-1.537-3.785-2.641" opacity="0.7"/>
                                <path fill="currentColor" d="m21.403 7.14l-.041-.067L12 12v10c.944 0 1.822-.46 3.578-1.382l2-1.05c2.151-1.129 3.227-1.693 3.825-2.708c.597-1.014.597-2.277.597-4.8v-.117c0-2.525 0-3.788-.597-4.802" opacity="0.5"/>
                                <path fill="currentColor" d="m6.323 4.484l.1-.052l1.493-.784l9.1 5.005l4.025-2.011q.205.232.362.498c.15.254.262.524.346.825L17.75 9.964V13a.75.75 0 0 1-1.5 0v-2.286l-3.5 1.75v9.44A3 3 0 0 1 12 22c-.248 0-.493-.032-.75-.096v-9.44l-8.998-4.5c.084-.3.196-.57.346-.824q.156-.266.362-.498l9.04 4.52l3.387-1.693z"/>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                <?php echo e(number_format($totalOrder)); ?>                                  
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">TỔNG ĐƠN HÀNG</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top">
                    <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M8.422 20.618C10.178 21.54 11.056 22 12 22V12L2.638 7.073l-.04.067C2 8.154 2 9.417 2 11.942v.117c0 2.524 0 3.787.597 4.801c.598 1.015 1.674 1.58 3.825 2.709z"/>
                                <path fill="currentColor" d="m17.577 4.432l-2-1.05C13.822 2.461 12.944 2 12 2c-.945 0-1.822.46-3.578 1.382l-2 1.05C4.318 5.536 3.242 6.1 2.638 7.072L12 12l9.362-4.927c-.606-.973-1.68-1.537-3.785-2.641" opacity="0.7"/>
                                <path fill="currentColor" d="m21.403 7.14l-.041-.067L12 12v10c.944 0 1.822-.46 3.578-1.382l2-1.05c2.151-1.129 3.227-1.693 3.825-2.708c.597-1.014.597-2.277.597-4.8v-.117c0-2.525 0-3.788-.597-4.802" opacity="0.5"/>
                                <path fill="currentColor" d="m6.323 4.484l.1-.052l1.493-.784l9.1 5.005l4.025-2.011q.205.232.362.498c.15.254.262.524.346.825L17.75 9.964V13a.75.75 0 0 1-1.5 0v-2.286l-3.5 1.75v9.44A3 3 0 0 1 12 22c-.248 0-.493-.032-.75-.096v-9.44l-8.998-4.5c.084-.3.196-.57.346-.824q.156-.266.362-.498l9.04 4.52l3.387-1.693z"/>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                <?php echo e(number_format($OrderToday)); ?>                                
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">ĐƠN HÀNG HÔM NAY</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top">
                    <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M3 10V8a2 2 0 0 1 2-2h2m-4 4c1.333 0 4-.8 4-4m-4 4v4m18-4V8a2 2 0 0 0-2-2h-2m4 4c-1.333 0-4-.8-4-4m4 4v4M7 6h10m4 8v2a2 2 0 0 1-2 2h-2m4-4c-1.333 0-4 .8-4 4m0 0H7m-4-4v2a2 2 0 0 0 2 2h2m-4-4c1.333 0 4 .8 4 4"/>
                                    <circle cx="12" cy="12" r="2"/>
                                </g>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                <?php echo e(number_format($totalRevenue)); ?>                                  
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">TỔNG DOANH THU</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top">
                    <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M3 10V8a2 2 0 0 1 2-2h2m-4 4c1.333 0 4-.8 4-4m-4 4v4m18-4V8a2 2 0 0 0-2-2h-2m4 4c-1.333 0-4-.8-4-4m4 4v4M7 6h10m4 8v2a2 2 0 0 1-2 2h-2m4-4c-1.333 0-4 .8-4 4m0 0H7m-4-4v2a2 2 0 0 0 2 2h2m-4-4c1.333 0 4 .8 4 4"/>
                                    <circle cx="12" cy="12" r="2"/>
                                </g>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                <?php echo e(number_format($totalRenvenueToday)); ?>                                   
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">DOANH THU HÔM NAY</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">THỐNG KÊ NGƯỜI DÙNG</h5>
                <div class="ms-auto">
                    <img class="text-right" src="/assets/images/apps/live.png" width="60px">
                </div>
            </div>
            <div class="card-body">
                <div id="user-statistics"></div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">THỐNG KÊ NẠP TIỀN</h5>
                <div class="ms-auto">
                    <img class="text-right" src="/assets/images/apps/live.png" width="60px">
                </div>
            </div>
            <div class="card-body">
                <div id="recharge-statistics"></div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">THỐNG KÊ TRẠNG THÁI ĐƠN HÀNG</h5>
                <div class="ms-auto">
                    <img class="text-right" src="/assets/images/apps/live.png" width="60px">
                </div>
            </div>
            <div class="card-body">
                <div id="order-statistics"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-animate" id="notiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mb-3">
                    <h3>THÔNG BÁO</h3>
                </div>
                <?php echo configValue('urgent_notice'); ?>

                <div class="mt-2 d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-primary-gradient shadow-2" id="btn-close-notice">Tôi đã đọc</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
        $(document).ready(function() {
            let isNoticeModal = localStorage.getItem('isNoticeModal');

            let time = 5 * 60 * 1000; 

            if (new Date().getTime() - isNoticeModal > time) {
                $('#notiModal').modal('show');
            }

            $('#btn-close-notice').click(function() {
                localStorage.setItem('isNoticeModal', new Date().getTime());
                $('#notiModal').modal('hide');
            });

        });
    </script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/app/js/plugins/apexcharts.min.js"></script>
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
          '#F4A6A6', '#04A9F5', '#4B0082', '#FF8C00', '#F44236', '#28a745'
        ],
        series: [
          {
            name: 'Đang chờ',
            data: <?php echo json_encode($totalOrderStatus['totalPending'], 15, 512) ?>
          },
          {
            name: 'Đang chạy',
            data: <?php echo json_encode($totalOrderStatus['totalProcessing'], 15, 512) ?>
          },
          {
            name: 'Đã huỷ',
            data: <?php echo json_encode($totalOrderStatus['totalCanceled'], 15, 512) ?>
          },
          {
            name: 'Chờ hoàn tiền',
            data: <?php echo json_encode($totalOrderStatus['totalPendingRefundCancel'], 15, 512) ?>
          },
          {
            name: 'Hoàn tiền',
            data: <?php echo json_encode($totalOrderStatus['totalRefund'], 15, 512) ?>
          },
          {
            name: 'Hoàn thành',
            data: <?php echo json_encode($totalOrderStatus['totalCompleted'], 15, 512) ?>
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
<script>
  'use strict';
  setTimeout(function () {
    (function () {
  var options = {
    chart: {
      height: 350,
      type: 'bar', 
    },
    dataLabels: {
      enabled: true
    },
    colors: ['#04A9F5'], 
    series: [{
      name: 'Người dùng',
      data: <?php echo json_encode($data['user'], 15, 512) ?> 
    }],
    xaxis: {
      categories: <?php echo json_encode($labels, 15, 512) ?>,
    },
    tooltip: {
      shared: true,
      intersect: false
    }
  };

    var chart = new ApexCharts(document.querySelector("#user-statistics"), options);
    chart.render();
})();
}, 700);
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
          enabled: true
        },
        stroke: {
          curve: 'smooth'
        },
        colors: [
          '#04A9F5'
        ],
        series: [{
            name: 'Nạp tiền',
            data: <?php echo json_encode($data['recharge'], 15, 512) ?>
        }],
        xaxis: {
          categories: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
        },
        tooltip: {
          shared: true,
          intersect: false
        }
      };

      var chart_order_statistics = new ApexCharts(document.querySelector('#recharge-statistics'), options_order_statistics);
      chart_order_statistics.render();
    })();
  }, 700);
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dailysie/hacksub.website/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>