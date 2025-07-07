@extends('admin.layouts.app')
@section('title', 'Lịch sử giao dịch')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">Lịch sử giao dịch</h5>
            </div>
            <div class="card-body">
                <form action="" method="GET">
                    <div class="row row-cols-lg-auto g-3 mb-3">
                        <div class="col-md-1 col-6">
                            <select name="per_page" id="per_page" class="form-control " onchange="this.form.submit()">
                                @foreach([10, 25, 50, 100, 1000, 5000, 10000] as $option)
                                    <option value="{{ $option }}" {{ request('per_page') == $option ? 'selected' : '' }}>
                                        - {{ $option }} -
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg col-md-4 col-6">
                            <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Tìm kiếm...">
                        </div>
                        <div class="col-lg col-md-4 col-6">
                            <select name="type" class="form-control">
                                <option value="">-- Giao Dịch --</option>
                                <option value="recharge">Nạp Tiền</option>
                                <option value="order">Mua Đơn</option>
                                <option value="balance">Số dư</option>
                                <option value="refund">Hoàn tiền</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <button type="submit" class="btn btn-primary w-100"><i class="ti ti-search"></i> Tìm
                            Kiếm</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive table-wrapper mb-3">
                    <table class="table text-nowrap table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ngày giao dịch</th>
                                <th>Người dùng</th>
                                <th>Loại giao dịch</th>
                                <th>Mã giao dịch</th>
                                <th>Số dư</th>
                                <th>Số dư đầu</th>
                                <th>Số dư cuối</th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $key => $transaction)
                            <tr>
                                <td>#{{ $transaction->id }}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td>{{ $transaction->user->username }}</td>
                                <td>
                                    @if ($transaction->type == 'recharge')
                                    <span class="badge bg-success-gradient">Nạp tiền</span>
                                    @elseif ($transaction->type == 'order')
                                    <span class="badge bg-primary-gradient">Đơn hàng</span>
                                    @elseif($transaction->type == 'balance')
                                    <span class="badge bg-info-gradient">Thay đổi</span>
                                    @elseif($transaction->type == 'refund')
                                    <span class="badge bg-danger-gradient">Hoàn tiền</span>
                                    @elseif($transaction->type == 'withdraw')
                                    <span class="badge bg-warning-gradient">Tạo lệnh rút tiền</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-secondary-gradient">{{ $transaction->tran_code }}</span>
                                </td>
                                <td class="fw-bold text-muted">{{ number_format($transaction->before_balance) }} VNĐ
                                </td>
                                <td class="fw-bold text-muted">
                                    @if ($transaction->action == 'add')
                                    <p class="mb-0 text-successt">
                                        +{{ number_format($transaction->first_balance) }} VNĐ
                                    </p>
                                    @elseif ($transaction->action == 'sub')
                                    <p class="mb-0 text-danger">
                                        -{{ number_format($transaction->first_balance) }} VNĐ
                                    </p>
                                    @endif
                                </td>
                                <td class="fw-bold text-muted">{{ number_format($transaction->after_balance) }} VNĐ
                                </td>
                                <td>{{ $transaction->note }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center align-items-center mt-3 pagination-style-1">
                        {{ $transactions->appends(request()->all())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection