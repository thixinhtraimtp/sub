@extends('admin.layouts.app')
@section('title', 'Quản lí smm')
@section('content')
<div class="row">
    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top">
                    <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-secondary">
                            <svg class="fs-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M3 10V8a2 2 0 0 1 2-2h2m-4 4c1.333 0 4-.8 4-4m-4 4v4m18-4V8a2 2 0 0 0-2-2h-2m4 4c-1.333 0-4-.8-4-4m4 4v4M7 6h10m4 8v2a2 2 0 0 1-2 2h-2m4-4c-1.333 0-4 .8-4 4m0 0H7m-4-4v2a2 2 0 0 0 2 2h2m-4-4c1.333 0 4 .8 4 4"></path>
                                    <circle cx="12" cy="12" r="2"></circle>
                                </g>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                {{ number_format($totalBalance) }} VNĐ                 
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">TỔNG SỐ DƯ</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top">
                    <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-success">
                        <i class="ti ti-access-point fs-2"></i>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                             {{$totalActive}}                            
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">ĐANG HOẠT ĐỘNG</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top">
                    <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-info">
                        <i class="ti ti-lock fs-2"></i>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                {{$totalInactive}}
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">KHÔNG HOẠT ĐỘNG</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">Danh sách đối tác API</h5>
            </div>
            <div class="card-body">
                <div class="form-group d-flex justify-content-between align-items-center gap-2 mb-3">
                    <a href="{{ route('admin.service.smm.balance') }}" class="btn btn-primary-gradient">
                        <svg class="fs-2" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"><path fill="currentColor" d="M4 20v-2h2.75l-.4-.35q-1.225-1.225-1.787-2.662T4 12.05q0-2.775 1.663-4.937T10 4.25v2.1Q8.2 7 7.1 8.563T6 12.05q0 1.125.425 2.188T7.75 16.2l.25.25V14h2v6zm10-.25v-2.1q1.8-.65 2.9-2.212T18 11.95q0-1.125-.425-2.187T16.25 7.8L16 7.55V10h-2V4h6v2h-2.75l.4.35q1.225 1.225 1.788 2.663T20 11.95q0 2.775-1.662 4.938T14 19.75"/></svg> 
                        Đồng bộ
                    </a>
                    <button class="btn btn-danger-gradient" data-bs-toggle="modal" data-bs-target="#new">
                        <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="tooltip" title="Thêm mới"  width="20px" height="20px" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M20 14h-6v6h-4v-6H4v-4h6V4h4v6h6z"/>
                        </svg>
                    </button>
                </div>
                <div class="table-responsive">
                    <table id="data-table" class="table table-hover table-vcenter text-center mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thao tác</th>
                                <th>Thứ tự</th>
                                <th>Link smm</th>
                                <th>Token</th>
                                <th>Số dư</th>
                                <th>Trạng thái</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold">
                            @foreach ($smms as $smm)
                            <tr>
                                <td>{{ $smm->id }}</td>
                                <td>
                                    <a href="{{ route('admin.service.smm.edit', ['id' => $smm->id]) }}"
                                        class="btn btn-sm btn-success-gradient"
                                        data-bs-toggle="tooltip" title="Xem chi tiết">
                                    <i class="ti ti-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.service.smm.delete', ['id' => $smm->id]) }}"
                                        class="btn btn-sm btn-danger-gradient"
                                        data-bs-toggle="tooltip" title="Xóa">
                                    <i class="ti ti-trash"></i>
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-primary-gradient">{{ $smm->order }}</span>
                                </td>
                                <td><a href="{{ $smm->name }}" target="blank_">{{ $smm->name }}</a></td>
                                <td>{{ \Illuminate\Support\Str::limit($smm->token, 20) }}</td>
                                <td>{{ number_format($smm->balance) }} VNĐ</td>
                                <td>
                                    @if ($smm->status == 'active')
                                    <span class="badge bg-success-gradient">Hoạt động</span>
                                    @else
                                    <span class="badge bg-danger-gradient">Không hoạt động</span>
                                    @endif
                                </td>
                                <td>{{ $smm->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body pc-component">
    <div id="new" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="new" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new">Thêm mới API</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  id="smm-create" action="{{ route('admin.service.smm.create') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name"
                                placeholder="Đường link smm" value="{{ old('name') }}">
                            <label for="name">Link APIv2 SMM</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="token"
                                placeholder="Token của nguồn smm" value="{{ old('token') }}">
                            <label for="token">API Token</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="tigia"
                                placeholder="Nhập tỉ giá" value="26000">
                            <label for="tigia">Tỉ giá 1 USD = ?VNĐ</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="submit-btn" class="btn btn-primary col-12">
                            <i class="fas fa-save"></i> Thêm mới
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#smm-create').on('submit', function(e) {
            e.preventDefault();
    
            var formData = new FormData(this);
    
            $('#submit-btn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Đang xử lý...');
    
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        title: 'Thành công',
                        text: response.message || 'Thêm mới thành công!',
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Thêm mới',
                        cancelButtonText: 'Đóng',
                        customClass: {
                            confirmButton: 'swal2-confirm btn btn-success',
                            cancelButton: 'swal2-cancel btn btn-danger'
                        },
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#smm-create')[0].reset();
                            $('#submit-btn').prop('disabled', false).html('<i class="fas fa-save"></i> Thêm mới');
                        } else {
                            $('#submit-btn').prop('disabled', false).html('<i class="fas fa-save"></i> Thêm mới');
                            location.reload();  
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Lỗi',
                        text: 'Có lỗi xảy ra, vui lòng thử lại!',
                        icon: 'error',
                        confirmButtonText: 'Đóng',
                        customClass: {
                            confirmButton: 'swal2-confirm btn btn-danger'
                        }
                    });
    
                    $('#submit-btn').prop('disabled', false).html('<i class="fas fa-save"></i> Thêm mới');
                }
            });
        });
    });
</script>
@endsection