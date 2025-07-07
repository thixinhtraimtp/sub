@extends('guard.layouts.app')
@section('content')
@section('title', 'Tiến trình')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5>Tất cả tiến trình</h5>
        </div>
        <div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="data-table" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold">
                        @foreach ($orders as $order)
                        <tr>
                            <td>
                                <ul>
                                    <li><b>ID: </b>{{ $order->id }}</li>
                                    <li><b>Mã đơn: </b><i onclick="coppy('{{ $order->order_code }}')">{{ $order->order_code }} <i class="fas fa-copy"></i></i></li>
                                    <li><b>Thời gian: </b>{{ $order->created_at->diffForHumans() }}</li>
                                    <li>{{ $order->created_at }} -</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <a href="{{ route('service', ['platform' => $order->service->platform->slug ?? 'Null', 'service' => $order->service->slug ?? 'Null']) }}">
                                        <li><b>Máy chủ {{ ($order->server_id) ?? 'Không tìm thấy máy chủ' }} : </b><u class="text-sky-600">{{ ($order->service->name) ?? 'Không tìm thấy dịch vụ' }}</u></li>
                                    </a>
                                    <li>
                                        <b>Link: </b>
                                        <a href="javascript:;" onclick="coppy('{{ $order->object_id }}')">{{ $order->object_id }}</a>
                                    </li>
                                    <li class="mt-1">{!! statusOrder($order->status, true) !!}</li>
                                    <li class="mt-1">
                                        <a class="text-primary" href="{{ route('service', [ 'platform' => $order->service->platform->slug ?? 'Null', 'service' => $order->service->slug ?? 'Null']) }}">Đặt lại hàng<a> - 
                                        <a class="text-danger" href="{{route('ticket')}}">Hỗ trợ</a>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                @if (isset($order->server->action->refund_status) && $order->server->action->refund_status === 'on')                                <a href="javascript:;" class="btn btn-sm btn-warning"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Hoàn tiền"
                                    onclick="refundOrder('{{ $order->order_code }}')">
                                <i class="fas fa-undo"></i>
                                @endif
                                {{-- Bảo hành --}}
                                @if (isset($order->server->action->warranty_status) && $order->server->action->warranty_status === 'on')
                                <a href="javascript:;" class="btn btn-sm btn-info"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Bảo hành"
                                    onclick="warrantyOrder('{{ $order->order_code }}')">
                                <i class="fas fa-sync"></i>
                                </a>
                                @endif
                                {{-- Cập nhật --}}
                                <a href="javascript:;" class="btn btn-sm btn-primary"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Cập nhật"
                                    onclick="updateOrder('{{ $order->order_code }}')">
                                <i class="fas fa-cube"></i>
                                </a>
                                {{-- bảo hành --}}
                                @if (isset($order->server->action->renews_status) && $order->server->action->renews_status === 'on')
                                <a href="javascript:;" class="btn btn-sm btn-info"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Gia hạn"
                                    onclick="renewsOrder('{{ $order->order_code }}')">
                                <i class="fas fa-sync"></i>
                                </a>
                                @endif
                            </td>
                            <td>
                                <ul>
                                    <li><b>Số tiền: </b><span class="text-primary">{{ $order->price }}đ</span></li>
                                    <li><b>Số lượng: </b><span class="text-info">{{ number_format($order->orderdata()['quantity']) }}</span></li>
                                    <li><b>Bắt đầu: </b>{{ number_format($order->start) }}</li>
                                    <li><b>Đã tăng: </b>{{ number_format($order->buff) }}</li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('script')
<script src="{{ asset('assets/pack-lamtilo/js/service1.js?time=') }}{{ time() }}"></script>
@endsection
@endsection