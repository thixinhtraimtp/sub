@extends('guard.layouts.app')
@section('title', 'Nhật Ký')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5>Nhật ký</h5>
        </div>
        <div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="dom-table" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Giao dịch</th>
                            <th>Thời gian</th>
                            <th>Mã giao dịch</th>
                            <th>Số tiền</th>
                            <th>Số dư trước</th>
                            <th>Số dư sau</th>
                            <th>Nội dung</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold">
                        @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($transaction->type == 'recharge')
                                <span class="badge bg-success">Nạp tiền</span>
                                @elseif ($transaction->type == 'order')
                                <span class="badge bg-primary">Tạo đơn</span>
                                @elseif ($transaction->type == 'refund')
                                <span class="badge bg-danger">Hoàn tiền</span>
                                @elseif ($transaction->type == 'balance')
                                <span class="badge bg-warning">Điều chỉnh số dư</span>
                                @endif
                            </td>
                            <td>{{ $transaction->created_at->diffForHumans() }}</td>
                            <td>{{ $transaction->tran_code }}</td>
                            <td>
                                @if ($transaction->action == 'add')
                                <span class="text-success">+{{ number_format($transaction->first_balance) }}</span>
                                @elseif ($transaction->action == 'sub')
                                <span class="text-danger">-{{ number_format($transaction->first_balance) }}</span>
                                @endif
                            </td>
                            <td class="text-primary">{{ number_format($transaction->before_balance) }}</td>
                            <td class="text-danger">{{ number_format($transaction->after_balance) }}</td>
                            <td>
                                <textarea class="form-control" rows="1" readonly>{{ $transaction->note }}</textarea>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection