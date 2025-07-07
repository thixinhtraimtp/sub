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
                    <div class="table-responsive">
                        <table id="data-table" class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ngày giao dịch</th>
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
                                        <td>#{{ $key + 1 }}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                        <td>
                                            @if ($transaction->type == 'recharge')
                                                <span class="badge bg-success">Nạp tiền</span>
                                            @elseif ($transaction->type == 'order')
                                                <span class="badge bg-primary">Đơn hàng</span>
                                            @elseif($transaction->type == 'balance')
                                                <span class="badge bg-info">Thay đổi</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $transaction->tran_code }}</span>
                                        </td>
                                        <td class="fw-bold text-muted">{{ number_format($transaction->before_balance) }} VNĐ
                                        </td>
                                        <td class="fw-bold text-muted">
                                            @if ($transaction->action == 'add')
                                                <p class="mb-0 text-success">
                                                    +{{ number_format($transaction->first_balance) }} VNĐ</p>
                                            @elseif ($transaction->action == 'sub')
                                                <p class="mb-0 text-danger">
                                                    -{{ number_format($transaction->first_balance) }} VNĐ</p>
                                            @endif
                                        </td>
                                        <td class="fw-bold text-muted">{{ number_format($transaction->after_balance) }} VNĐ
                                        </td>
                                        <td>{{ $transaction->note }}</td>
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
