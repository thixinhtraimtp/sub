@extends('guard.layouts.app')
@section('title', 'Tài khoản đã mua')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="form-group mb-3">
                            <label for="search">Tìm kiếm</label>

                            <div class="input-group">
                                <input type="text" class="form-control" id="search" name="search"
                                    placeholder="Nhập tên sản phẩm">
                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Dữ liệu</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($products->isEmpty())
                                    @include('admin.components.table-search-not-found', ['colspan' => 7])
                                @endif
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->product->name ?? "Không tồn tại" }}</td>
                                        <td>{{ number_format($product->price) }} VNĐ</td>
                                        <td>{{ number_format($product->total) }} VNĐ</td>
                                        <td>
                                            @if ($product->status == 'success')
                                                <span class="badge bg-success">Thành công</span>
                                            @else
                                                <span class="badge bg-danger">Thất bại</span>
                                            @endif
                                        </td>
                                        <td>
                                            <textarea class="form-control" rows="1" readonly>{{ $product->data }}</textarea>
                                        </td>
                                        <td>{{ $product->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end align-items-center">
                            {{ $products->appends(request()->input())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
