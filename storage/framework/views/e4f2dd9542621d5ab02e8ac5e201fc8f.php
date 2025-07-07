<?php $__env->startSection('title', 'API Docs'); ?>
<?php $__env->startSection('content'); ?>
<div class="card card-flush ">
    <div class="card-body">
        <div class="table-responsive mb-5">
            <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                <tbody>
                    <tr>
                        <td class="text-gray-700">API URL</td>
                        <td class="fw-bolder">https://<?php echo e(getDomain()); ?>/api/v2</td>
                    </tr>
                    <tr>
                        <td class="text-gray-700">API Key</td>
                        <td class="fw-bolder"><span class="text-danger" id="key"><?php echo e(Auth::user()->api_token ?? 'Vui lòng đăng nhập để lấy API Token!'); ?></span> <a
                            href="javascript:;" onclick="newApikey()" class="ms-2"
                            id="btn-reload-token"><i
                            class="fa fa-refresh fs-4" aria-hidden="true"></i></a></td>
                    </tr>
                    <tr>
                        <td class="text-gray-700">HTTP Method</td>
                        <td class="fw-bolder">POST</td>
                    </tr>
                    <tr>
                        <td class="text-gray-700">Content-Type</td>
                        <td class="fw-bolder">application/x-www-form-urlencoded</td>
                    </tr>
                    <tr>
                        <td class="text-gray-700">Response</td>
                        <td class="fw-bolder">JSON</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex flex-column flex-md-row">
            <ul class="nav nav-tabs nav-pills border-0 flex-row flex-md-column me-5 mb-3 mb-md-0 fs-6" role="tablist">
                <li class="nav-item w-md-200px me-0" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#services" aria-selected="true"
                        role="tab">Services</a>
                </li>
                <li class="nav-item w-md-200px me-0" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#add" aria-selected="false" role="tab"
                        tabindex="-1">Add order</a>
                </li>
                <li class="nav-item w-md-200px me-0" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#status" aria-selected="false" role="tab"
                        tabindex="-1">Order status</a>
                </li>
                <li class="nav-item w-md-200px me-0" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#multistatus" aria-selected="false" role="tab"
                        tabindex="-1">Multiple orders status</a>
                </li>
                <li class="nav-item w-md-200px" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#balance" aria-selected="false" role="tab"
                        tabindex="-1">Balance</a>
                </li>
            </ul>
            <div class="tab-content w-100">
                <div class="tab-pane fade show active" id="services" role="tabpanel">
                    <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                        <tbody>
                            <tr class="bg-light">
                                <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                <td class="fw-bolder" data-lang="Description">Description</td>
                            </tr>
                            <tr>
                                <td>key</td>
                                <td>API Key </td>
                            </tr>
                            <tr>
                                <td>action</td>
                                <td>"services"</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6 data-lang="Example response">Example response</h6>
                    <div class="bg-light p-3">
                        <pre class="language-html mb-0">[
    {
        "service": 1,
        "name": "Facebook views",
        "type": "Default",
        "category": "Facebook",
        "rate": "2.5",
        "min": "200",
        "max": "10000",
        "refill": true
    },
    {
        "service": 2,
        "name": "Tiktok views",
        "type": "Default",
        "category": "Tiktok",
        "rate": "4",
        "min": "10",
        "max": "1500",
        "refill": false
    }
]</pre>
                    </div>
                </div>
                <div class="tab-pane fade" id="add" role="tabpanel">
                    <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                        <tbody>
                            <tr class="bg-light">
                                <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                <td class="fw-bolder" data-lang="Description">Description</td>
                            </tr>
                            <tr>
                                <td>key</td>
                                <td>API Key </td>
                            </tr>
                            <tr>
                                <td>action</td>
                                <td>"add"</td>
                            </tr>
                            <tr>
                                <td>service</td>
                                <td>Service ID</td>
                            </tr>
                            <tr>
                                <td>link</td>
                                <td>Link</td>
                            </tr>
                            <tr class="options default special special1">
                                <td>quantity</td>
                                <td>Needed quantity</td>
                            </tr>
                            <tr class="options special" style="display: none;">
                                <td>list</td>
                                <td>Suggest video list or Keyword search list</td>
                            </tr>
                            <tr class="options special1" style="display: none;">
                                <td>suggest</td>
                                <td>Suggest video list</td>
                            </tr>
                            <tr class="options special1" style="display: none;">
                                <td>search</td>
                                <td>Keyword search list</td>
                            </tr>
                            <tr class="options custom-comments" style="display: none;">
                                <td>comments</td>
                                <td>Comment list separated by \n</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6 data-lang="Example response">Example response</h6>
                    <div class="bg-light p-3">
                        <pre class="language-html mb-0">{
    "order": 99999
}</pre>
                    </div>
                </div>
                <div class="tab-pane fade" id="status" role="tabpanel">
                    <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                        <tbody>
                            <tr class="bg-light">
                                <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                <td class="fw-bolder" data-lang="Description">Description</td>
                            </tr>
                            <tr>
                                <td>key</td>
                                <td>API Key </td>
                            </tr>
                            <tr>
                                <td>action</td>
                                <td>"status"</td>
                            </tr>
                            <tr>
                                <td>order</td>
                                <td>Order ID</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6 data-lang="Example response">Example response</h6>
                    <div class="bg-light p-3">
                        <pre class="language-html mb-0">{
    "charge": "2.5",
    "start_count": "168",
    "status": "Completed",
    "remains": "-2"
}</pre>
                    </div>
                    <p><strong>Status</strong>: <em>Pending, Processing, In progress, Completed, Partial, Canceled</em>
                    </p>
                </div>
                <div class="tab-pane fade" id="multistatus" role="tabpanel">
                    <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                        <tbody>
                            <tr class="bg-light">
                                <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                <td class="fw-bolder" data-lang="Description">Description</td>
                            </tr>
                            <tr>
                                <td>key</td>
                                <td>API Key </td>
                            </tr>
                            <tr>
                                <td>action</td>
                                <td>"status"</td>
                            </tr>
                            <tr>
                                <td>orders</td>
                                <td>Order IDs separated by comma (E.g: 123,456,789) (Limit 100)</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6 data-lang="Example response">Example response</h6>
                    <div class="bg-light p-3">
                        <pre class="language-html mb-0">{
    "123": {
        "charge": "0.27819",
        "start_count": "3572",
        "status": "Partial",
        "remains": "157"
    },
    "456": {
        "error": "Incorrect order ID"
    },
    "789": {
        "charge": "1.44219",
        "start_count": "234",
        "status": "In progress",
        "remains": "10"
    }
}</pre>
                    </div>
                </div>
                <div class="tab-pane fade" id="balance" role="tabpanel">
                    <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                        <tbody>
                            <tr class="bg-light">
                                <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                <td class="fw-bolder" data-lang="Description">Description</td>
                            </tr>
                            <tr>
                                <td>key</td>
                                <td>API Key </td>
                            </tr>
                            <tr>
                                <td>action</td>
                                <td>"balance"</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6 data-lang="Example response">Example response</h6>
                    <div class="bg-light p-3">
                        <pre class="language-html mb-0">{
    "balance": "343423",
    "currency": "VND"
}</pre>
                    </div>
                </div>
                <div class="tab-pane fade" id="refill" role="tabpanel">
                    <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                        <tbody>
                            <tr class="bg-light">
                                <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                <td class="fw-bolder" data-lang="Description">Description</td>
                            </tr>
                            <tr>
                                <td>key</td>
                                <td>API Key </td>
                            </tr>
                            <tr>
                                <td>action</td>
                                <td>"refill"</td>
                            </tr>
                            <tr>
                                <td>order</td>
                                <td>Order ID</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6 data-lang="Example response">Example response</h6>
                    <div class="bg-light p-3">
                        <pre class="language-html mb-0">{
    "refill": "1"
}</pre>
                    </div>
                </div>
                <div class="tab-pane fade" id="refills" role="tabpanel">
                    <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                        <tbody>
                            <tr class="bg-light">
                                <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                <td class="fw-bolder" data-lang="Description">Description</td>
                            </tr>
                            <tr>
                                <td>key</td>
                                <td>API Key </td>
                            </tr>
                            <tr>
                                <td>action</td>
                                <td>"refill"</td>
                            </tr>
                            <tr>
                                <td>orders</td>
                                <td>Order IDs separated by comma (E.g: 123,456,789) (Limit 100)</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6 data-lang="Example response">Example response</h6>
                    <div class="bg-light p-3">
                        <pre class="language-html mb-0">{
    "refill": "1"
}</pre>
                    </div>
                </div>
                <div class="tab-pane fade" id="refill_status" role="tabpanel">
                    <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                        <tbody>
                            <tr class="bg-light">
                                <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                <td class="fw-bolder" data-lang="Description">Description</td>
                            </tr>
                            <tr>
                                <td>key</td>
                                <td>API Key </td>
                            </tr>
                            <tr>
                                <td>action</td>
                                <td>"refill_status"</td>
                            </tr>
                            <tr>
                                <td>refill</td>
                                <td>Refill ID</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6 data-lang="Example response">Example response</h6>
                    <div class="bg-light p-3">
                        <pre class="language-html mb-0">{
    "status": "Completed"
}</pre>
                    </div>
                </div>
                <div class="tab-pane fade" id="refills_status" role="tabpanel">
                    <table class="table align-middle table-row-bordered table-rounded border rounded gy-2 gs-5">
                        <tbody>
                            <tr class="bg-light">
                                <td class="fw-bolder" data-lang="Parameters">Parameters</td>
                                <td class="fw-bolder" data-lang="Description">Description</td>
                            </tr>
                            <tr>
                                <td>key</td>
                                <td>API Key </td>
                            </tr>
                            <tr>
                                <td>action</td>
                                <td>"refill_status"</td>
                            </tr>
                            <tr>
                                <td>refills</td>
                                <td>Refill IDs separated by comma (E.g: 123,456,789) (Limit 100)</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6 data-lang="Example response">Example response</h6>
                    <div class="bg-light p-3">
                        <pre class="language-html mb-0">[
    {
        "refill": 1,
        "status": "Completed"
    },
    {
        "refill": 2,
        "status": "Rejected"
    },
    {
        "refill": 3,
        "status": {
            "error": "Incorrect refill ID"
        }
    }
]</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $(document).ready(function() {
    
    
        $('#btn-reload-token').click(function() {
            $.ajax({
                url: "<?php echo e(route('account.reload-user-token')); ?>",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#key').text(data.api_token);
                    swal("Đã thay đổi Api Token!", "success");
                },
                error: function() {
                    swal("Có lỗi xảy ra!", "error");
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('guard.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/trumsubr/public_html/resources/views/guard/api.blade.php ENDPATH**/ ?>