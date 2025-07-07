@extends('admin.layouts.app')
@section('title', 'Danh sách máy chủ')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @foreach ($servers as $server)
                @if ($server->price !== $server->price_update)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Thông báo!</strong> Giá gốc của máy chủ <strong><a
                                href="{{ route('admin.server.edit', ['id' => $server->id]) }}">
                                {{ $server->name }}
                            </a></strong> đã được cập
                        nhật từ <strong>{{ number_format($server->price) }}đ</strong> thành
                        <strong>{{ number_format($server->price_update) }}đ</strong>.
                        Vui lòng kiểm tra lại thông tin trước khi thực hiện thay đổi.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h5 class="card-title">Cập nhật giá auto theo %</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.website.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Giá % Thành viên</label>
                                    <input type="text" class="form-control" name="price" value="{{ site('price') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Giá % Cộng tác viên</label>
                                    <input type="text" class="form-control" name="price_collaborator"  value="{{ site('price_collaborator') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Giá % Đại lí</label>
                                    <input type="text" class="form-control" name="price_agency"  value="{{ site('price_agency') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Giá % Nhà phân phối</label>
                                    <input type="text" class="form-control" name="price_distributor"  value="{{ site('price_distributor') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-3">
                                    <button id="fetchPrice" class="btn btn-warning"><i class="ti ti-coin"></i> Cập nhật giá</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Danh sách máy chủ</h5>                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary btn-sm text-sm" data-bs-toggle="modal"
                                    data-bs-target="#updatePrice">
                                    Cập nhật giá toàn bộ máy chủ
                                </button>
                                <a href="{{route('admin.server.delete.all')}}" class="btn btn-danger text-sm btn-sm">Xoá toàn bộ dịch vụ</a>
                            </div>
                            <form action="">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control" placeholder="Tìm kiếm dữ liệu"
                                                name="search" value="{{ request()->search }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <select name="service" id="service" class="form-control">
                                                <option value="">-- Dịch vụ --</option>
                                                @foreach (\App\Models\ServicePlatform::where('domain', env('APP_MAIN_SITE'))->orderBy('order', 'asc')->get() as $key => $platform)
                                                    <option value="">-- {{ $platform->name }} --</option>
                                                    @foreach ($platform->services as $service)
                                                        <option value="{{ $service->id }}"
                                                            {{ request()->service == $service->id ? 'selected' : '' }}>
                                                            --- {{ $service->name }} ---
                                                        </option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <select name="visibility" id="visibility" class="form-control">
                                                <option value="">-- Hiển thị --</option>
                                                <option value="public"
                                                    {{ request()->visibility == 'public' ? 'selected' : '' }}>
                                                    Công khai
                                                </option>
                                                <option value="private"
                                                    {{ request()->visibility == 'private' ? 'selected' : '' }}>
                                                    Riêng tư
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <select name="status" id="status" class="form-control">
                                                <option value="">-- Trạng thái --</option>
                                                <option value="active"
                                                    {{ request()->status == 'active' ? 'selected' : '' }}>
                                                    Hoạt động
                                                </option>
                                                <option value="inactive"
                                                    {{ request()->status == 'inactive' ? 'selected' : '' }}>
                                                    Không hoạt động
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group d-flex justify-content-between align-items-center gap-2 mb-3">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="ti ti-search"></i> Tìm kiếm
                                            </button>
                                            <a href="{{ route('admin.server') }}" class="btn btn-secondary w-100">
                                                <i class="ti ti-rotate-clockwise"></i> Làm mới
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                                <table id="data-table" class="table text-nowrap table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Thao tác</th>
                                            <th>Thông tin</th>
                                            <th>Bảng giá</th>
                                            <th>Thời gian</th>
                                            <th>Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($servers as $server)
                                                <tr>
                                                    <td>{{ $server->id }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.server.edit', ['id' => $server->id]) }}"
                                                            class="btn btn-sm btn-success" data-bs-toggle="tooltip"
                                                            title="Xem chi tiết">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <strong>Dịch vụ:</strong> {{ $server->name }}
                                                            </li>
                                                            <li>
                                                                <strong>Máy chủ:</strong> {{ $server->package_id }}
                                                            </li>
                                                            <li>
                                                                <strong>Khả dụng:</strong>
                                                                {{ number_format($server->min) }} -
                                                                {{ number_format($server->max) }}
                                                            </li>
                                                            <li>
                                                                <strong>Trạng thái:</strong> {!! $server->getStatusLabel($server->status, true) !!}
                                                            </li>
                                                            <li>
                                                                <strong>Hiển thị:</strong> {!! $server->getVisibilityLabel($server->visibility, true) !!}
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <strong>Giá gốc:</strong>
                                                                {{ $server->price ?? 0 }}đ
                                                            </li>
                                                            <li>
                                                                <strong class="text-success">Giá thành viên:</strong>
                                                                {{ $server->price_member }}đ
                                                            </li>
                                                            <li>
                                                                <strong class="text-primary">Giá cộng tác viên:</strong>
                                                                {{ $server->price_collaborator }}đ
                                                            </li>
                                                            <li>
                                                                <strong class="text-info">Giá đại lý:</strong>
                                                                {{ $server->price_agency }}đ
                                                            </li>
                                                            <li>
                                                                <strong class="text-danger">Giá nhà phân phối:</strong>
                                                                {{ $server->price_distributor }}đ
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        {{ $server->created_at->diffForHumans() }}
                                                    </td>
                                                    <td>
                                                        {{ $server->updated_at->diffForHumans() }}
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

    {{-- modal updatePrice --}}
    <div class="modal fade" id="updatePrice" tabindex="-1" aria-labelledby="updatePriceLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatePriceLabel">Cập nhật giá gốc toàn bộ máy chủ thay đổi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.server.update-price') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="price">Nhập giá cần tăng</label>
                            <input type="text" class="form-control" id="price" name="price"
                                placeholder="Nhập giá cần tăng" value="0">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Loại cập nhật</label>
                            <select name="type" id="type" class="form-control">
                                <option value="default">Cập nhật toàn bộ máy chủ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="action" class="form-label">Thao tác</label>
                            <select name="action" id="action" class="form-control">
                                <option value="default">Cập nhật cộng theo giá ở trên</option>
                                <option value="percent" hidden>Cập nhật theo %</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('fetchPrice').addEventListener('click', function(event) {
            event.preventDefault();
            const loadingSwal = Swal.fire({
                title: 'Đang cập nhật giá...',
                text: 'Vui lòng đợi...',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading(); 
                }
            });
            $.ajax({
                url: '{{route('cron-job.update-price')}}',
                type: 'GET',
                success: function(response) {
                    loadingSwal.close();
                    const message = response.message;
                    Swal.fire({
                        title: 'Thành công',
                        text: message,
                        icon: 'success',
                        confirmButtonText: 'Xác nhận'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    loadingSwal.close();
                    Swal.fire({
                        title: 'Lỗi',
                        text: 'Không thể lấy dữ liệu từ API. Vui lòng thử lại sau.',
                        icon: 'error',
                        confirmButtonText: 'Xác nhận'
                    }).then(() => {
                        location.reload();
                    });
                }
            });
        });
    </script>
@endsection
