@extends('guard.layouts.app')
@section('title', 'Nạp tiền')
@section('content')
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="row">
            <div class="col-6 d-grid gap-2">
                <a href="{{ route('account.recharge')}}" class="btn btn-primary">
                Ngân hàng</a>
            </div>
            <div class="col-6 d-grid gap-2">
                <a href="{{ route('account.card')}}" class="btn btn-outline-primary">
                Thẻ cào</a>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-danger mb-3">
                    - Cố tình nạp dưới mức nạp không hỗ trợ<br>
                    - Nạp sai cú pháp, sai số tài khoản, sai ngân hàng sẽ bị trừ 20% phí giao dịch. Vd: nạp 100k sai nội
                    dung sẽ chỉ nhận được 80k coin và phải liên hệ admin để cộng tay.
                </div>
                <div class="row">
                    @if ($momo->status === 'active')
                    <div class="col-md-6 col-sm-6">
                        <div class="alert alert-danger fw-bold border border-white" role="alert" style="display: flex;">
                            <div style="width: 150%;">
                                <div class="mb-2 ">
                                    <img src="{{ asset($momo->logo) }}" alt="Logo momo" width="210" class="text-center">
                                </div>
                                <div class="mb-2">
                                    Số Tài khoản:
                                    <b class="fw-bold cursor-pointer text-success"
                                        onclick="coppy('{{ $momo->account_number }}')">
                                    {{ $momo->account_number }} <i class="fas fa-copy"></i>
                                    </b>
                                </div>
                                <div class="mb-2">
                                    Chủ tài khoản: <b>{{ $momo->account_name }}</b>
                                </div>
                                <div class="mb-2">
                                    Số tiền tối thiểu: <b>{{ number_format($momo->min_recharge) }} VNĐ</b>
                                </div>
                                <div class="mb-2">
                                    Nội dung chuyển khoản:
                                    <b onclick="coppy('{{ siteValue('transfer_code') }}{{ Auth::user()->id }}')"
                                        class="cursor-pointer text-success">
                                    {{ siteValue('transfer_code') }}{{ Auth::user()->id }} <i
                                        class="fas fa-copy"></i>
                                    </b>
                                </div>
                                <div class="text-center mt-3" hidden>
                                    <button type="button" class="btn btn-danger btn-sm text-sm rounded"
                                        data-bs-toggle="modal" data-bs-target="">
                                    <i class="fas fa-file-invoice"></i> Tạo Hoá đơn
                                    </button>
                                </div>
                            </div>
                            <div class="qrbank text-center mt-3">
                                <img src="https://momosv3.apimienphi.com/api/QRCode?phone={{ $momo->account_number }}&note={{ siteValue('transfer_code') }}{{ Auth::user()->id }}&amount="
                                    alt="QR CODE" width="80%">
                            </div>
                            <!-- Modal -->
                            <!-- Modal -->
                        </div>
                    </div>
                    @endif
                    @if ($vietcombank->status === 'active')
                    <div class="col-md-6 col-sm-6">
                        <div class="alert alert-success fw-bold border border-white" role="alert"
                            style="display: flex;">
                            <div style="width: 150%;">
                                <div class="mb-2 ">
                                    <img src="{{ asset($vietcombank->logo) }}" alt="Logo vietcombank" width="100"
                                        class="text-center">
                                </div>
                                <div class="mb-2">
                                    Số Tài khoản:
                                    <b class="fw-bold cursor-pointer text-success"
                                        onclick="coppy('{{ $vietcombank->account_number }}')">
                                    {{ $vietcombank->account_number }} <i class="fas fa-copy"></i>
                                    </b>
                                </div>
                                <div class="mb-2">
                                    Chủ tài khoản: <b>{{ $vietcombank->account_name }}</b>
                                </div>
                                <div class="mb-2">
                                    Số tiền tối thiểu: <b>{{ number_format($vietcombank->min_recharge) }} VNĐ</b>
                                </div>
                                <div class="mb-2">
                                    Nội dung chuyển khoản:
                                    <b onclick="coppy('{{ siteValue('transfer_code') }}{{ Auth::user()->id }}')"
                                        class="cursor-pointer text-success">
                                    {{ siteValue('transfer_code') }}{{ Auth::user()->id }} <i
                                        class="fas fa-copy"></i>
                                    </b>
                                </div>
                                <div class="text-center mt-3" hidden>
                                    <button type="button" class="btn btn-success btn-sm text-sm rounded"
                                        data-bs-toggle="modal" data-bs-target="#billCreateModalVietcombank">
                                    <i class="fas fa-file-invoice"></i> Tạo Hoá đơn
                                    </button>
                                </div>
                            </div>
                            <div class="qrbank text-center mt-3">
                                <img src="https://img.vietqr.io/image/vietcombank-{{ $vietcombank->account_number }}-qr_only.jpg?accountName={{ $vietcombank->account_name }}&addInfo={{ siteValue('transfer_code') }}{{ Auth::user()->id }}&amount="
                                    alt="QR CODE" width="80%">
                            </div>
                            <!-- Modal -->
                            <div class="modal fade text-dark" id="billCreateModalVietcombank" tabindex="-1"
                                aria-labelledby="billCreateModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="billCreateModalLabel">Nhập số tiền cần
                                                nạp
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('recharge.post') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="bank_code" value="Vietcombank">
                                            <div class="modal-body" id="t2">
                                                <div class="form-group">
                                                    <label for="amount" class="form-label">Số tiền</label>
                                                    <input type="number" class="form-control" id="amount"
                                                        oninput="changeAmount(this.value, 1)" name="amount">
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="">
                                                        <div class="fw-bold">Số tiền cần thanh toán</div>
                                                        <span id="amountPayVietcombank"
                                                            class="fw-bold text-primary fs-4">0</span> VNĐ
                                                    </div>
                                                    <div class="">
                                                        <div class="fw-bold">Số tiền nhận được</div>
                                                        <span id="amountReceivesVietcombank"
                                                            class="fw-bold text-success fs-4">0</span> VNĐ
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Tạo hoá
                                                đơn</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if ($acb->status === 'active')
                    <div class="col-md-6 col-sm-6">
                        <div class="alert alert-info border border-white fw-bold" role="alert" style="display: flex;">
                            <div style="width: 150%;">
                                <div class="mb-2 ">
                                    <img src="{{ asset($acb->logo) }}" alt="Logo ACB" width="100" class="text-center">
                                </div>
                                <div class="mb-2">
                                    Số Tài khoản:
                                    <b class="fw-bold cursor-pointer text-success"
                                        onclick="coppy('{{ $acb->account_number }}')">
                                    {{ $acb->account_number }} <i class="fas fa-copy"></i>
                                    </b>
                                </div>
                                <div class="mb-2">
                                    Chủ tài khoản: <b>{{ $acb->account_name }}</b>
                                </div>
                                <div class="mb-2">
                                    Số tiền tối thiểu: <b>{{ number_format($acb->min_recharge) }} VNĐ</b>
                                </div>
                                <div class="mb-2">
                                    Nội dung chuyển khoản:
                                    <b onclick="coppy('{{ siteValue('transfer_code') }}{{ Auth::user()->id }}')"
                                        class="cursor-pointer text-success">
                                    {{ siteValue('transfer_code') }}{{ Auth::user()->id }} <i
                                        class="fas fa-copy"></i>
                                    </b>
                                </div>
                                <div class="text-center mt-3" hidden>
                                    <button type="button" class="btn btn-info btn-sm text-sm rounded"
                                        data-bs-toggle="modal" data-bs-target="#billCreateModalAcb">
                                    <i class="fas fa-file-invoice"></i> Tạo Hoá đơn
                                    </button>
                                </div>
                            </div>
                            <div class="qrbank text-center mt-3">
                                <img src="https://img.vietqr.io/image/ACB-{{ $acb->account_number }}-qr_only.jpg?accountName={{ $acb->account_name }}&addInfo={{ siteValue('transfer_code') }}{{ Auth::user()->id }}&amount="
                                    alt="QR CODE" width="80%">
                            </div>
                            <!-- Modal -->
                            <div class="modal fade text-dark" id="billCreateModalAcb" tabindex="-1"
                                aria-labelledby="billCreateModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="billCreateModalLabel">Nhập số tiền cần nạp</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('recharge.post') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="bank_code" value="ACB">
                                            <div class="modal-body" id="t2">
                                                <div class="form-group">
                                                    <label for="amount" class="form-label">Số tiền</label>
                                                    <input type="number" class="form-control" id="amount"
                                                        oninput="changeAmount(this.value, 2)" name="amount">
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mt-3">
                                                    <div class="">
                                                        <div class="fw-bold">Số tiền cần thanh toán</div>
                                                        <span id="amountPayACB"
                                                            class="fw-bold text-primary fs-4">0</span> VNĐ
                                                    </div>
                                                    <div class="">
                                                        <div class="fw-bold">Số tiền nhận được</div>
                                                        <span id="amountReceivesACB"
                                                            class="fw-bold text-success fs-4">0</span>
                                                        VNĐ
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Tạo hoá đơn</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if ($bidv->status === 'active')
                    <div class="col-md-6 col-sm-6">
                        <div class="alert alert-info border border-white fw-bold" role="alert" style="display: flex;">
                            <div style="width: 150%;">
                                <div class="mb-2 ">
                                    <img src="{{ asset($bidv->logo) }}" alt="Logo ACB" width="100" class="text-center">
                                </div>
                                <div class="mb-2">
                                    Số Tài khoản:
                                    <b class="fw-bold cursor-pointer text-success"
                                        onclick="coppy('{{ $bidv->account_number }}')">
                                    {{ $bidv->account_number }} <i class="fas fa-copy"></i>
                                    </b>
                                </div>
                                <div class="mb-2">
                                    Chủ tài khoản: <b>{{ $bidv->account_name }}</b>
                                </div>
                                <div class="mb-2">
                                    Số tiền tối thiểu: <b>{{ number_format($bidv->min_recharge) }} VNĐ</b>
                                </div>
                                <div class="mb-2">
                                    Nội dung chuyển khoản:
                                    <b onclick="coppy('{{ siteValue('transfer_code') }}{{ Auth::user()->id }}')"
                                        class="cursor-pointer text-success">
                                    {{ siteValue('transfer_code') }}{{ Auth::user()->id }} <i
                                        class="fas fa-copy"></i>
                                    </b>
                                </div>
                                <div class="text-center mt-3" hidden>
                                    <button type="button" class="btn btn-info btn-sm text-sm rounded"
                                        data-bs-toggle="modal" data-bs-target="#billCreateModalBIDV">
                                    <i class="fas fa-file-invoice"></i> Tạo Hoá đơn
                                    </button>
                                </div>
                            </div>
                            <div class="qrbank text-center mt-3">
                                <img src="https://img.vietqr.io/image/BIDV-{{ $bidv->account_number }}-qr_only.jpg?accountName={{ $bidv->account_name }}&addInfo={{ siteValue('transfer_code') }}{{ Auth::user()->id }}&amount="
                                    alt="QR CODE" width="80%">
                            </div>
                            <!-- Modal -->
                            <div class="modal fade text-dark" id="billCreateModalBIDV" tabindex="-1"
                                aria-labelledby="billCreateModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="billCreateModalLabel">Nhập số tiền cần nạp</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('recharge.post') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="bank_code" value="BIDV">
                                            <div class="modal-body" id="t2">
                                                <div class="form-group">
                                                    <label for="amount" class="form-label">Số tiền</label>
                                                    <input type="number" class="form-control" id="amount"
                                                        oninput="changeAmount(this.value, 8)" name="amount">
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mt-3">
                                                    <div class="">
                                                        <div class="fw-bold">Số tiền cần thanh toán</div>
                                                        <span id="amountPayBIDV"
                                                            class="fw-bold text-primary fs-4">0</span> VNĐ
                                                    </div>
                                                    <div class="">
                                                        <div class="fw-bold">Số tiền nhận được</div>
                                                        <span id="amountReceivesBIDV"
                                                            class="fw-bold text-success fs-4">0</span>
                                                        VNĐ
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Tạo hoá đơn</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if ($mbbank->status === 'active')
                    <div class="col-md-6 col-sm-6">
                        <div class="alert alert-primary fw-bold " role="alert" style="display: flex;">
                            <div style="width: 150%;">
                                <div class="mb-2 ">
                                    <img src="{{ asset($mbbank->logo) }}" alt="Logo mbbank" width="100"
                                        class="text-center">
                                </div>
                                <div class="mb-2">
                                    Số Tài khoản:
                                    <b class="fw-bold cursor-pointer text-success"
                                        onclick="coppy('{{ $mbbank->account_number }}')">
                                    {{ $mbbank->account_number }} <i class="fas fa-copy"></i>
                                    </b>
                                </div>
                                <div class="mb-2">
                                    Chủ tài khoản: <b>{{ $mbbank->account_name }}</b>
                                </div>
                                <div class="mb-2">
                                    Số tiền tối thiểu: <b>{{ number_format($mbbank->min_recharge) }} VNĐ</b>
                                </div>
                                <div class="mb-2">
                                    Nội dung chuyển khoản:
                                    <b onclick="coppy('{{ siteValue('transfer_code') }}{{ Auth::user()->id }}')"
                                        class="cursor-pointer text-success">
                                    {{ siteValue('transfer_code') }}{{ Auth::user()->id }} <i
                                        class="fas fa-copy"></i>
                                    </b>
                                </div>
                                <div class="text-center mt-3" hidden>
                                    <button type="button" class="btn btn-primary btn-sm text-sm rounded"
                                        data-bs-toggle="modal" data-bs-target="#billCreateModalMbbank">
                                    <i class="fas fa-file-invoice"></i> Tạo Hoá đơn
                                    </button>
                                </div>
                            </div>
                            <div class="qrbank text-center mt-3">
                                <img src="https://img.vietqr.io/image/mbbank-{{ $mbbank->account_number }}-qr_only.jpg?accountName={{ $mbbank->account_name }}&addInfo={{ siteValue('transfer_code') }}{{ Auth::user()->id }}&amount="
                                    alt="QR CODE" width="80%">
                            </div>
                            <!-- Modal -->
                            <div class="modal fade text-dark" id="billCreateModalMbbank" tabindex="-1"
                                aria-labelledby="billCreateModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="billCreateModalLabel">Nhập số tiền cần
                                                nạp
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('recharge.post') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="bank_code" value="MBBank">
                                            <div class="modal-body" id="t2">
                                                <div class="form-group">
                                                    <label for="amount" class="form-label">Số tiền</label>
                                                    <input type="number" class="form-control" id="amount"
                                                        oninput="changeAmount(this.value, 0)" name="amount">
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="">
                                                        <div class="fw-bold">Số tiền cần thanh toán</div>
                                                        <span id="amountPayMbbank"
                                                            class="fw-bold text-primary fs-4">0</span>
                                                        VNĐ
                                                    </div>
                                                    <div class="">
                                                        <div class="fw-bold">Số tiền nhận được</div>
                                                        <span id="amountReceivesMbbank"
                                                            class="fw-bold text-success fs-4">0</span> VNĐ
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Tạo hoá
                                                đơn</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Lịch sử nạp tiền</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dom-table" class="table table-bordered table-hover table-striped ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mã giao dịch</th>
                                <th>Loại giao dịch</th>
                                <th>Cổng thanh toán</th>
                                <th>Người chuyển</th>
                                <th>Số tiền</th>
                                <th>Nội dung</th>
                                <th>Trạng thái</th>
                                <th>Thời gian</th>
                                <th hidden>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $historys)
                            <tr>
                                <td>{{ $historys->id }}</td>
                                <td><span class="badge bg-success"> {{$historys->bank_code }}</span></td>
                                <td><span class="badge bg-primary"> {{ $historys->payment_method }}</span></td>
                                <td>{{ $historys->bank_name }}</td>
                                <td>Không xác định</td>
                                <td>{{ number_format($historys->real_amount) }} VNĐ</td>
                                <td><textarea class="form-control" rows="2" style="width: 200px;"
                                    readonly>{{ $historys->note }}</textarea></td>
                                <td>{!! statusRecharge($historys->status, true) !!}</td>
                                <td>{{ $historys->created_at }}</td>
                                <td hidden>
                                    @if ($historys->status == 'Pending')
                                    <a href="{{ route('account.recharge.payment', ['id' => $historys->order_code]) }}"
                                        class="btn btn-primary btn-sm btn-icon" data-bs-toggle="tooltip"
                                        title="Xem chi tiết">
                                    <i class="la la-eye"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    const promotion = 0;
    
    function changeAmount(amount, type) {
        // const amountPay = document.getElementById('amountPay');
        // const amountReceives = document.getElementById('amountReceives');
        // amountPay.innerText = Intl.NumberFormat().format(amount);
        // const receives = amount - (amount * promotion / 100);
        // amountReceives.innerText = Intl.NumberFormat().format(receives);
    
        const amountPayMbbank = document.getElementById('amountPayMbbank');
        const amountReceivesMbbank = document.getElementById('amountReceivesMbbank');
        const amountPayVietcombank = document.getElementById('amountPayVietcombank');
        const amountReceivesVietcombank = document.getElementById('amountReceivesVietcombank');
        const amountPayACB = document.getElementById('amountPayACB');
        const amountReceivesACB = document.getElementById('amountReceivesACB');
        
        const amountPayBIDV = document.getElementById('amountPayBIDV');
        const amountReceivesBIDV = document.getElementById('amountReceivesBIDV');
        
        const amountPayViettin = document.getElementById('amountPayViettin');
        const amountReceivesViettin = document.getElementById('amountReceivesViettin');
    
    
        if (type === 0) {
            amountPayMbbank.innerText = Intl.NumberFormat().format(amount);
            const receives = amount - (amount * promotion / 100);
            amountReceivesMbbank.innerText = Intl.NumberFormat().format(receives);
        } else if (type === 1) {
            amountPayVietcombank.innerText = Intl.NumberFormat().format(amount);
            const receives = amount - (amount * promotion / 100);
            amountReceivesVietcombank.innerText = Intl.NumberFormat().format(receives);
        } else if (type === 2) {
            amountPayACB.innerText = Intl.NumberFormat().format(amount);
            const receives = amount - (amount * promotion / 100);
            amountReceivesACB.innerText = Intl.NumberFormat().format(receives);
        } else if (type === 3) {
            amountPayViettin.innerText = Intl.NumberFormat().format(amount);
            const receives = amount - (amount * promotion / 100);
            amountReceivesViettin.innerText = Intl.NumberFormat().format(receives);
        }else if (type === 8) {
            amountPayBIDV.innerText = Intl.NumberFormat().format(amount);
            const receives = amount - (amount * promotion / 100);
            amountReceivesBIDV.innerText = Intl.NumberFormat().format(receives);
        }
    }
</script>
@endsection