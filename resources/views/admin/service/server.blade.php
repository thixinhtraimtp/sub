@extends('admin.layouts.app')
@section('title', 'Danh sách máy chủ')
@section('content')
<div class="card-body pc-component">
    <div id="createserverv2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createserverv2" >
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createserverv2">Nhập dịch vụ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form id="createServerV2"action="{{ route('admin.server.create.v2') }}" method="POST">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                        <select id="itemsPerPageSelect" class="form-control">
                                            <option value="10" selected>- 10 -</option>
                                            <option value="20" >- 20 -</option>
                                            <option value="50">- 50 -</option>
                                            <option value="100">- 100 -</option>
                                            <option value="500">- 500 -</option>
                                            <option value="1000">- 1000 -</option>
                                            <option value="10000">- 10000 -</option>
                                        </select>
                                        <label for="itemsPerPageSelect">Hiển thị</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <select name="providerName" id="apiSelect" class="form-control">
                                            <option value="">-- Chọn API SMM --</option>
                                            @foreach ($smm as $sitesmm)
                                            <option value="{{$sitesmm['name']}}" data-api-key="{{$sitesmm['token']}}" data-tigia="{{$sitesmm['tigia']}}">{{$sitesmm['name']}}</option>
                                            @endforeach
                                        </select>
                                        <label for="providerName">Nguồn dịch vụ</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="categorySelect" id="categorySelect" class="form-control" disabled>
                                            <option value="">-- Chọn danh mục --</option>
                                        </select>
                                        <label for="providerName">Danh mục</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                                    <table class="table text-nowrap table-striped table-hover table-bordered" id="serviceTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center" data-orderable="false">
                                                    <input type="checkbox" id="checked_all" name="checked_all"  class="form-check-input">
                                                </th>
                                                <th>ID</th>
                                                <th>Dịch Vụ</th>
                                                <th>Giá</th>
                                                <th>Loại</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-bold"></tbody>
                                    </table>
                                    <div class="pagination-server " id="paginationControls"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <select name="service" id="" class="form-control">
                                            @foreach (\App\Models\ServicePlatform::where('domain',
                                            env('APP_MAIN_SITE'))->orderBy('order', 'asc')->get() as $key => $platform)
                                            <option value="">-- {{ $platform->name }} --</option>
                                            @foreach ($platform->services as $service)
                                            <option value="{{ $service->id }}"
                                            {{ old('service') == $service->id ? 'selected' : '' }}>
                                            --- {{ $service->name }} ---
                                            </option>
                                            @endforeach
                                            @endforeach
                                        </select>
                                        <label for="service">Dịch vụ</label>
                                    </div>
                                </div>
                                <div class="col-md-12" hidden>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="providerServer"
                                            name="providerServer" value="{{ old('providerServer') }}">
                                        <label for="providerServer">Máy chủ gốc</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="comments_status" id="comments_status" class="form-control">
                                        <option value="off"
                                        {{ old('comments_status') == 'off' ? 'selected' : '' }}>
                                        Tắt
                                        </option>
                                        <option value="on"
                                        {{ old('comments_status') == 'on' ? 'selected' : '' }}>
                                        Bật
                                        </option>
                                        </select>
                                        <label for="comments_status">Bình luận</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="quantity_status" id="quantity_status" class="form-control">
                                        <option value="on"
                                        {{ old('quantity_status') == 'on' ? 'selected' : '' }}>
                                        Bật
                                        </option>
                                        <option value="off"
                                        {{ old('quantity_status') == 'off' ? 'selected' : '' }}>
                                        Tắt
                                        </option>
                                        </select>
                                        <label for="quantity_status">Số lượng</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <button type="submit" class="btn btn-primary-gradient w-100">
                                        <i class="fas fa-save"></i> Thêm máy chủ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body pc-component">
    <div id="new" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="new" >
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new">Thêm mới máy chủ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="serverCreate" action="{{ route('admin.server.create') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-floating mb-3">
                                    <select name="service" id="" class="form-control">
                                        @foreach (\App\Models\ServicePlatform::where('domain',
                                        env('APP_MAIN_SITE'))->orderBy('order', 'asc')->get() as $key => $platform)
                                        <option value="">-- {{ $platform->name }} --</option>
                                        @foreach ($platform->services as $service)
                                        <option value="{{ $service->id }}"
                                        {{ old('service') == $service->id ? 'selected' : '' }}>
                                        --- {{ $service->name }} ---
                                        </option>
                                        @endforeach
                                        @endforeach
                                    </select>
                                    <label for="service">Dịch vụ</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Tiêu đề máy chủ" value="{{ old('name') }}">
                                    <label for="name">Tiêu đề máy chủ</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="details" id="details" class="form-control"
                                        placeholder="Mô tả máy chủ" rows="5"
                                        style="height: 200px;"></textarea>
                                    <label for="details">Mô tả máy chủ</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <select name="package_id" id="package_id" class="form-control">
                                                <option value="">-- Chọn máy chủ --</option>
                                                @for ($i = 1; $i <= 50; $i++) <option value="{{ $i }}"
                                                {{ old('package_id') == $i ? 'selected' : '' }}>
                                                Máy chủ {{ $i }}
                                                </option>
                                                @endfor
                                            </select>
                                            <label for="package_id">Máy chủ</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating mb-3">
                                            <select name="get_uid" id="get_uid" class="form-control">
                                            <option value="off" {{ old('get_uid') == 'off' ? 'selected' : '' }}>
                                            Tắt</option>
                                            <option value="on" {{ old('get_uid') == 'on' ? 'selected' : '' }}>
                                            Bật</option>
                                            </select>
                                            <label for="get_uid">Tự động lấy UID</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating mb-3">
                                            <select name="auto_price" id="auto_price" class="form-control">
                                            <option value="on" {{ old('auto_price') == 'on' ? 'selected' : '' }}>
                                            Bật</option>
                                            <option value="off" {{ old('auto_price') == 'off' ? 'selected' : '' }}>
                                            Tắt</option>
                                            </select>
                                            <label for="auto_price">Tự động update gía</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="limit_day" id="limit_day"
                                                placeholder="Giới hạn ngày" min="0" value="0">
                                            <label for="limit_day">Giới hạn ngày (Nhập 0
                                            thì sẽ không giới hạn)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="min" name="min"
                                                value="{{ old('min') }}">
                                            <label for="min">Mua tôi thiểu</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="max" name="max"
                                                value="{{ old('max') }}">
                                            <label for="max">Mua tôi đa</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="percents" name="percents"
                                                value="{{ old('percents') }}">
                                            <label for="percents">% số lượng đơn</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="price_member"
                                                name="price_member" value="{{ old('price_member') }}">
                                            <label for="price_member">Giá thành viên</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="price_collaborator"
                                                name="price_collaborator" value="{{ old('price_collaborator') }}">
                                            <label for="price_collaborator">Giá cộng tác viên</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="price_agency"
                                                name="price_agency" value="{{ old('price_agency') }}">
                                            <label for="price_agency">Giá đại lý</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="price_distributor"
                                                name="price_distributor" value="{{ old('price_distributor') }}">
                                            <label for="price_distributor">Giá nhà phân bón</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <select name="providerName" id="providerName" class="form-control">
                                                <option value="sharegiare"
                                                {{ old('providerName') == 'sharegiare' ? 'selected' : '' }}>
                                                Sharegiare.xyz</option>
                                                <option value="trumsubre"
                                                {{ old('providerName') == 'trumsubre' ? 'selected' : '' }}>
                                                Trumsubre.com</option>
                                                <option value="2mxh"
                                                {{ old('providerName') == '2mxh' ? 'selected' : '' }}>
                                                App.2mxh.com</option>
                                                <option value="tuongtacpro"
                                                {{ old('providerName') == 'tuongtacpro' ? 'selected' : '' }}>
                                                Tuongtac.pro</option>
                                                <option value="baostar"
                                                {{ old('providerName') == 'baostar' ? 'selected' : '' }}>
                                                Dichvu.baostar.pro</option>
                                                <option value="smmking"
                                                {{ old('providerName') == 'smmking' ? 'selected' : '' }}>
                                                Smmking.vip</option>
                                                <option value="hacklike17"
                                                {{ old('providerName') == 'hacklike17' ? 'selected' : '' }}>
                                                Hacklike17.com</option>
                                                <option value="traodoisub"
                                                {{ old('providerName') == 'traodoisub' ? 'selected' : '' }}>
                                                Traodoisub.com</option>
                                                <option value="dontay"
                                                {{ old('providerName') == 'dontay' ? 'selected' : '' }}>
                                                Đơn tay</option>
                                                @foreach ($smm as $sitesmm)
                                                <option value="{{$sitesmm['name']}}">{{$sitesmm['name']}}</option>
                                                @endforeach
                                            </select>
                                            <label for="providerName">Nguồn dịch vụ</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="providerLink"
                                                name="providerLink" value="{{ old('providerLink') }}">
                                            <label for="providerLink">Đường dẫn dịch vụ</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="providerServer"
                                                name="providerServer" value="{{ old('providerServer') }}">
                                            <label for="providerServer">Máy chủ gốc</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6" hidden>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="providerKey"
                                                name="providerKey" value="null">
                                            <label for="providerKey">Mã dịch vụ</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <select name="refund_status" id="refund_status" class="form-control">
                                            <option value="on"
                                            {{ old('refund_status') == 'on' ? 'selected' : '' }}>
                                            Có hoàn tiền
                                            </option>
                                            <option value="off"
                                            {{ old('refund_status') == 'off' ? 'selected' : '' }}>
                                            Không hoàn tiền
                                            </option>
                                            </select>
                                            <label for="refund_status">Hoàn tiền</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <select name="warranty_status" id="warranty_status" class="form-control">
                                            <option value="on"
                                            {{ old('warranty_status') == 'on' ? 'selected' : '' }}>
                                            Có Bảo hành
                                            </option>
                                            <option value="off"
                                            {{ old('warranty_status') == 'off' ? 'selected' : '' }}>
                                            Không Bảo hành
                                            </option>
                                            </select>
                                            <label for="warranty_status">Bảo hành</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <select name="renews_status" id="renews_status" class="form-control">
                                            <option value="off"
                                            {{ old('renews_status') == 'off' ? 'selected' : '' }}>
                                            Không Gia hạn
                                            </option>
                                            <option value="on"
                                            {{ old('renews_status') == 'on' ? 'selected' : '' }}>
                                            Có Gia hạn
                                            </option>
                                            </select>
                                            <label for="renews_status">Gia hạn</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select name="status" id="status" class="form-control">
                                            <option value="active"
                                            {{ old('status') == 'active' ? 'selected' : '' }}>
                                            Hoạt động
                                            </option>
                                            <option value="inactive"
                                            {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            Không hoạt động
                                            </option>
                                            </select>
                                            <label for="status">Trạng thái</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select name="visibility" id="visibility" class="form-control">
                                            <option value="public"
                                            {{ old('visibility') == 'public' ? 'selected' : '' }}>
                                            Công khai
                                            </option>
                                            <option value="private"
                                            {{ old('visibility') == 'private' ? 'selected' : '' }}>
                                            Riêng tư
                                            </option>
                                            </select>
                                            <label for="visibility">Hiển thị</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select name="reaction_status" id="reaction_status" class="form-control">
                                            <option value="off"
                                            {{ old('reaction_status') == 'off' ? 'selected' : '' }}>
                                            Tắt
                                            </option>
                                            <option value="on"
                                            {{ old('reaction_status') == 'on' ? 'selected' : '' }}>
                                            Bật
                                            </option>
                                            </select>
                                            <label for="reaction_status">Cảm xúc</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select name="quantity_status" id="quantity_status" class="form-control">
                                            <option value="on"
                                            {{ old('quantity_status') == 'on' ? 'selected' : '' }}>
                                            Bật
                                            </option>
                                            <option value="off"
                                            {{ old('quantity_status') == 'off' ? 'selected' : '' }}>
                                            Tắt
                                            </option>
                                            </select>
                                            <label for="quantity_status">Số lượng</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select name="comments_status" id="comments_status" class="form-control">
                                            <option value="off"
                                            {{ old('comments_status') == 'off' ? 'selected' : '' }}>
                                            Tắt
                                            </option>
                                            <option value="on"
                                            {{ old('comments_status') == 'on' ? 'selected' : '' }}>
                                            Bật
                                            </option>
                                            </select>
                                            <label for="comments_status">Bình luận</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select name="minutes_status" id="minutes_status" class="form-control">
                                            <option value="off"
                                            {{ old('minutes_status') == 'off' ? 'selected' : '' }}>
                                            Tắt
                                            </option>
                                            <option value="on"
                                            {{ old('minutes_status') == 'on' ? 'selected' : '' }}>
                                            Bật
                                            </option>
                                            </select>
                                            <label for="minutes_status">Số phút</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select name="time_status" id="time_status" class="form-control">
                                            <option value="off"
                                            {{ old('time_status') == 'off' ? 'selected' : '' }}>
                                            Tắt
                                            </option>
                                            <option value="on"
                                            {{ old('time_status') == 'on' ? 'selected' : '' }}>
                                            Bật
                                            </option>
                                            </select>
                                            <label for="time_status">Thời gian</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select name="posts_status" id="posts_status" class="form-control">
                                            <option value="off"
                                            {{ old('posts_status') == 'off' ? 'selected' : '' }}>
                                            Tắt
                                            </option>
                                            <option value="on"
                                            {{ old('posts_status') == 'on' ? 'selected' : '' }}>
                                            Bật
                                            </option>
                                            </select>
                                            <label for="posts_status">Bài viết</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle"></i> <strong>Lưu ý:</strong> Bạn
                                            cần nhập dữ liệu cảm xúc theo ví dụ như sau:
                                            <code>LIKE,HAHA,COMMENT</code> hoặc tất cả là <code>ALL</code>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="reaction_data"
                                                name="reaction_data" value="ALL">
                                            <label for="reaction_data">Dữ liệu cảm xúc</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle"></i> <strong>Lưu ý:</strong>
                                            Thời gian tính theo giây và phải là số nguyên dương
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="minutes_data"
                                                name="minutes_data" value="{{ old('minutes_data') }}">
                                            <label for="minutes_data">Dữ liệu thời gian</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary-gradient w-100">
                            <i class="fas fa-save"></i> Thêm máy chủ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 text-right mb-3">
        <button class="btn btn-primary-gradient" data-bs-toggle="modal" data-bs-target="#createserverv2">
            <i class="ti ti-plus fw-bold"></i> Nhập dịch vụ
        </button>
    </div>
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">Danh sách máy chủ</h5>
                <div class="ms-auto">
                    <button class="btn btn-sm btn-danger-gradient" data-bs-toggle="modal" data-bs-target="#new">
                        <i class="ti ti-plus fw-bold"></i> Thêm mới
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="row row-cols-lg-auto">
                        <div class="col-lg col-md-4 col-6">
                            <div class="form-group mb-3">
                                <select name="service" id="service" class="form-control">
                                    <option value="">-- Dịch vụ --</option>
                                    @foreach (\App\Models\ServicePlatform::where('domain',env('APP_MAIN_SITE'))->orderBy('order', 'asc')->get() as $key => $platform)
                                    <option value="">-- {{ $platform->name }} --</option>
                                    @foreach ($platform->services as $service)
                                    <option value="{{ $service->id }}" {{ request()->service == $service->id ? 'selected' : '' }}> --- {{ $service->name }} --- </option>
                                    @endforeach @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg col-md-4 col-6">
                            <div class="form-group mb-3">
                                <select name="visibility" id="visibility" class="form-control">
                                    <option value="">-- Hiển thị --</option>
                                    <option value="public" {{ request()->visibility == 'public' ? 'selected' : '' }}> Công khai </option>
                                    <option value="private" {{ request()->visibility == 'private' ? 'selected' : '' }}> Riêng tư </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg col-md-4 col-6">
                            <div class="form-group mb-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="">-- Trạng thái --</option>
                                    <option value="active" {{ request()->status == 'active' ? 'selected' : '' }}> Hoạt động </option>
                                    <option value="inactive" {{ request()->status == 'inactive' ? 'selected' : '' }}> Không hoạt động </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg col-md-4 col-6">
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" placeholder="Tìm kiếm dữ liệu" name="search" value="{{ request()->search }}" />
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary mr-1 mb-3"><i class="ti ti-search"></i> Search</button>
                                <a href="{{ route('admin.server') }}" class="btn btn-secondary mr-1 mb-3"> <i class="ti ti-rotate-clockwise"></i> Làm mới </a>
                                <button id="fetchPrice" class="btn btn-warning mr-1 mb-3"><i class="ti ti-coin"></i> Đồng bộ</button>
                                <a href="{{ route('admin.server.clear.price') }}" class="btn btn-danger mr-1 mb-3"> <i class="ti ti-coin"></i> Xoá giá cũ </a>
                        </div>
                    </div>
                </form>
                <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                    <table id="data-table" class="table text-nowrap table-striped table-hover table-bordered">
                        <thead class="mt-2">
                            <tr>
                                <th>
                                    <form action="{{ route('admin.server.delete.checked') }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <input type="checkbox" id="check_all" name="checked_all"  class="form-check-input">
                                            <input type="text" class="form-control" id="checked_server" name="checked_server" value="" hidden>
                                            <button type="submit" class="btn btn-sm bg-danger-gradient"  data-bs-toggle="tooltip" title="Xóa"><i class="ti ti-trash"></i></button>
                                        </div>
                                    </form>
                                </th>
                                <th>Thao tác</th>
                                <th>Thông tin</th>
                                <th>Bảng giá</th>
                                <th>Thao tác Máy chủ</th>
                                <th>Nguồn dịch vụ</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold">
                            @foreach ($servers as $server)
                            <tr>
                                <td><input class="form-check-input checkbox" type="checkbox" name="check_ids[]" value="{{ $server->id }}" class="service-checkbox"> {{ $server->id }}</td>
                                <td>
                                    <a href="{{ route('admin.server.edit', ['id' => $server->id]) }}"
                                        class="btn btn-sm btn-success-gradient" data-bs-toggle="tooltip"
                                        title="Xem chi tiết">
                                    <i class="ti ti-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.server.delete', ['id' => $server->id]) }}"
                                        class="btn btn-sm btn-danger-gradient" data-bs-toggle="tooltip" title="Xóa">
                                    <i class="ti ti-trash"></i>
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
                                            <strong>Trạng thái:</strong> {!!
                                            $server->getStatusLabel($server->status, true) !!}
                                        </li>
                                        <li>
                                            <strong>Hiển thị:</strong> {!!
                                            $server->getVisibilityLabel($server->visibility, true) !!}
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <li>
                                            <strong>Giá gốc:</strong>
                                            {{ $server->price ?? 0}}đ
                                        </li>
                                        <li>
                                            <strong class="text-success">Giá thành viên:</strong>
                                            {{$server->price_member}}đ
                                        </li>
                                        <li>
                                            <strong class="text-primary">Giá cộng tác viên:</strong>
                                            {{ $server->price_collaborator}}đ
                                        </li>
                                        <li>
                                            <strong class="text-info">Giá đại lý:</strong>
                                            {{ $server->price_agency }}đ
                                        </li>
                                        <li>
                                            <strong class="text-danger">Giá nhà phân phối:</strong>
                                            {{ $server->price_distributor}}đ
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <li>
                                            <strong>Số lượng:</strong> {!!
                                            $server->getActionStatusLabel($server->actions->first()->quantity_status,
                                            true) !!}
                                        </li>
                                        <li>
                                            <strong>Cảm xúc:</strong> {!!
                                            $server->getActionStatusLabel($server->actions->first()->reaction_status,
                                            true) !!}
                                        </li>
                                        <li>
                                            <strong>Bình luận:</strong> {!!
                                            $server->getActionStatusLabel($server->actions->first()->comments_status,
                                            true) !!}
                                        </li>
                                        <li>
                                            <strong>Số phút:</strong> {!!
                                            $server->getActionStatusLabel($server->actions->first()->minutes_status,
                                            true) !!}
                                        </li>
                                        <li>
                                            <strong>Thời gian:</strong> {!!
                                            $server->getActionStatusLabel($server->actions->first()->time_status,
                                            true) !!}
                                        </li>
                                        <li>
                                            <strong>Bài viết:</strong> {!!
                                            $server->getActionStatusLabel($server->actions->first()->posts_status,
                                            true) !!}
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <ul>
                                        <li>
                                            <strong>Nguồn:</strong> {{ $server->providerName }}
                                        </li>
                                        <li>
                                            <strong>Máy chủ:</strong> {{ $server->providerServer }}
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    {{ $server->created_at->diffForHumans() }}
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


<script src="/assets/js/app/server.js"></script>
<script>
    $(document).ready(function() {
        $("#checked_all").on('change', function() {
            if ($(this).prop("checked")) {
                $("input[name='checked_ids[]']").prop("checked", true);
            } else {
                $("input[name='checked_ids[]']").prop("checked", false);
            }
            updateProviderServer();
        });
    });
    document.getElementById('check_all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll("input[name='check_ids[]']");
        const isChecked = this.checked; 
        checkboxes.forEach(function(checkbox) {
        checkbox.checked = isChecked;
        });
        updateCheckedServer();
    });
    
    document.querySelectorAll("input[name='check_ids[]']").forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        updateCheckedServer();
        });
    });
    function updateCheckedServer() {
    const checkedIds = [];
    document.querySelectorAll("input[name='check_ids[]']:checked").forEach(function(checkbox) {
        checkedIds.push(checkbox.value);
        });
        document.getElementById("checked_server").value = checkedIds.join(" ");
    }
</script>
@endsection