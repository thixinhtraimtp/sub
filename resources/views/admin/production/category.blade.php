@extends('admin.layouts.app')
@section('title', 'Danh sách danh mục sản phẩm')
@section('content')
<div class="card-body pc-component">
    <div id="new" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="new" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new">THÊM MỚI DANH MỤC</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.product.category.create') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name"
                                placeholder="Tên nền tảng của dịch vụ" value="{{ old('name') }}" required>
                            <label for="name">Tên danh mục</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="slug"
                                placeholder="Đường dẫn của nền tảng" value="{{ old('slug') }}" required>
                            <label for="slug">Đường dẫn</label>
                        </div>
                        <div class="form-group mb-3">
                            <input type="file" class="form-control" name="image[]" placeholder="Nhập hình ảnh"
                                multiple value="{{ old('image') }}">
                            <label for="image">Hình ảnh: </label>
                            <small class="text-danger">Có thể thêm nhiều ảnh</small>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="note" id="note" placeholder="Ghi chú" rows="5">{{ old('note') }}</textarea>
                            <label for="description">Ghi chú</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="description" id="description" placeholder="Mô tả danh mục" rows="5">{{ old('description') }}</textarea>
                            <label for="description">Mô tả</label>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="price" placeholder="Giá" required>
                                    <label for="price">Giá</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary col-12">
                            <i class="fas fa-save"></i> Thêm mới
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex align-items-top">
                    <div class="me-3">
                        <span class="avatar avatar-md p-2 bg-warning-gradient">
                            <svg class="fs-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                                <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4">
                                    <path d="M44 14L24 4L4 14v20l20 10l20-10z"/>
                                    <path stroke-linecap="round" d="m4 14l20 10m0 20V24m20-10L24 24M34 9L14 19"/>
                                </g>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                {{$totalProductSelling}}         
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">SẢN PHẦM TỒN KHO</p>
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
                        <span class="avatar avatar-md p-2 bg-primary-gradient">
                            <svg class="fs-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                                <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4">
                                    <path d="M44 14L24 4L4 14v20l20 10l20-10z"/>
                                    <path stroke-linecap="round" d="m4 14l20 10m0 20V24m20-10L24 24M34 9L14 19"/>
                                </g>
                            </svg>
                        </span>
                    </div>
                    <div class="flex-fill">
                        <div class="d-flex mb-1 align-items-top justify-content-between">
                            <h5 class="fw-semibold mb-0 lh-1">
                                {{$totalProductOrder}}                                   
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">SẢN PHẨM ĐÃ BÁN</p>
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
                        <span class="avatar avatar-md p-2 bg-success-gradient">
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
                                {{number_format($totalProductProfit)}}đ           
                            </h5>
                        </div>
                        <p class="mb-0 fs-10 op-7 text-muted fw-semibold">LỢI NHUẬN SẢN PHẨM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">DANH MỤC TÀI NGUYÊN</h5>
                <div class="ms-auto">
                    <button class="btn btn-sm btn-danger-gradient" data-bs-toggle="modal" data-bs-target="#new">
                    <i class="ti ti-plus fw-bold"></i> Thêm mới
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                    <table id="data-table" class="table text-nowrap table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thao tác</th>
                                <th>Tên danh mục</th>
                                <th>Đường dẫn</th>
                                <th>Giá</th>
                                <th>Tồn kho</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold">
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{-- thêm đơn hàng --}}
                                    <a href="{{ route('admin.product.add', $category->id) }}"
                                        class="btn btn-sm btn-success-gradient" data-bs-toggle="tooltip" title="Thêm sản phẩm">
                                    <i class="ti ti-plus"></i>
                                    </a>
                                    <a href="{{ route('admin.product.category.edit', $category->id) }}"
                                        class="btn btn-sm btn-primary-gradient" data-bs-toggle="tooltip" title="Xem thêm">
                                    <i class="ti ti-pencil"></i>
                                    </a>
                                    <a href="{{ route('admin.product.category.delete', $category->id) }}"
                                        class="btn btn-sm btn-danger-gradient" data-bs-toggle="tooltip" title="Xoá">
                                    <i class="ti ti-trash"></i>
                                    </a>
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td><span class="badge bg-primary-gradient fw-bold">{{ number_format($category->price) }}đ</span></td>
                                <td>{{ $category->products->where('status', 'selling')->count() }}</td>
                                <td>
                                    @if ($category->products->where('user_buy_id', null)->count() > 0)
                                    <span class="badge bg-success-gradient">Còn hàng</span>
                                    @else
                                    <span class="badge bg-danger-gradient">Hết hàng</span>
                                    @endif
                                </td>
                                <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
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
<script src="/app/js/plugins/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        height: '400',
        selector: '#description',
        content_style: 'body { font-family: "Inter", sans-serif; }',
        menubar: false,
        toolbar: [
            'styleselect fontselect fontsizeselect',
            'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
            'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'
        ],
        plugins: 'advlist autolink link image lists charmap print preview code'
    });
</script>
@endsection