@extends('admin.layouts.app')
@section('title', 'Hỗ trợ Ticket')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">Danh sách ticket hỗ tợ</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                    <table id="data-table" class="table text-nowrap table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thao tác</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung ticket</th>
                                <th>Độ ưu tiên</th>
                                <th>Nội dung đã phản hồi</th>
                                <th>Trạng thái</th>
                                <th>Thời gian tạo</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold">
                            @foreach ($ticket as $tickets)
                            <tr>
                                <td>{{ $tickets->id }}</td>
                                <td> 
                                    <a href="{{ route('admin.ticket.ticket.edit', ['id' => $tickets->id]) }}"
                                        class="btn btn-sm btn-success"
                                        data-bs-toggle="tooltip" title="Xem chi tiết">
                                    <i class="ti ti-eye"></i>
                                    </a> 
                                    <a href="{{ route('admin.ticket.ticket.delete', ['id' => $tickets->id]) }}"
                                        class="btn btn-sm btn-danger"
                                        data-bs-toggle="tooltip" title="Xóa">
                                    <i class="ti ti-trash"></i>
                                    </a>
                                </td>
                                <td>
                                    {{ $tickets->title }}
                                </td>
                                <td>
                                    {!! $tickets->body !!}
                                </td>
                                <td>{{ $tickets->level }}</td>
                                <td>
                                    {!! $tickets->reply !!}
                                </td>
                                <td>{!! statusTicket($tickets->status) !!}</td>
                                <td>{{ $tickets->created_at->diffForHumans() }}</td>
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
@endsection