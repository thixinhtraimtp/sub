@extends('guard.layouts.app')
@section('content')
@section('title', $service->name . ' | ' . $platform->name)
<div class="col-md-12 ">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-justified nav-pills justify-content-center mb-3" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="order-tab" data-bs-toggle="tab" href="#order" role="tab"
                        aria-selected="true">
                    <i class="fa fa-shopping-cart"></i> Khởi Tạo Đơn
                    </a>
                </li>
                @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link" id="list-tab" data-bs-toggle="tab" href="#list" role="tab"
                        aria-selected="false" >
                    <i class="fa fa-history"></i> Danh Sách Đơn
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" id="list-tab" data-bs-toggle="tab" href="#list" role="tab"
                        aria-selected="false" disabled>
                    <i class="fa fa-history"></i> Danh Sách Đơn
                    </a>
                </li>
                @endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="order" role="tabpanel">
                    <div class="row">
                        <div class="col-sm-8 mb-3">
                            <form action="{{ route('api.create.order') }}" method="POST" lamtilo-request="order">
                                <input type="hidden" name="provider_package" value="{{ $service->package }}">
                                <div class="form-group mb-3">
                                    <label for="object_id" class="form-label text-dark">Link Hoặc UID:</label>
                                    <input type="text" class="form-control" id="object_id" name="object_id"
                                        placeholder="Nhập link hoặc ID tuỳ các máy chủ">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label text-dark">Máy chủ:</label>
                                    <div class="mb-2">
                                        @foreach ($service->servers->where('visibility', 'public')->where('domain', request()->getHost()) as $server)
                                        <div class="mb-1" d>
                                            <div class="form-check mb-2 d-flex align-items-center gap-2">
                                                <input  type="radio"
                                                class="form-check-input {{ $server->status === 'active' ? 'input-light-primary' : 'input-light-danger' }}"
                                                name="provider_server" value="sv-{{ $server->package_id }}"
                                                id="provider-server-{{ $server->package_id }}"
                                                data-details="{{ $server->details }}" data-min="{{ $server->min }}"
                                                data-max="{{ $server->max }}"
                                                data-quantity="{{ $server->action->quantity_status }}"
                                                data-reaction="{{ $server->action->reaction_status }}"
                                                data-comment="{{ $server->action->comments_status }}"
                                                data-getuid="{{ $server->action->get_uid }}"
                                                data-minute="{{ $server->action->minutes_status }}"
                                                data-reaction_type="{{ $server->action->reaction_data ?? 'all' }}"
                                                data-comment_type="{{ $server->action->comments_data }}"
                                                data-minute_type="{{ $server->action->minutes_data }}"
                                                data-posts="{{ $server->action->posts_status }}"
                                                data-posts_type="{{ $server->action->posts_data }}"
                                                data-time="{{ $server->action->time_status }}"
                                                data-time_type="{{ $server->action->time_data }}"
                                                data-price="{{ $server->levelPrice(Auth::user()->level ?? $server->price_member) }}"
                                                onclick="checkPrice()"
                                                @if ($server->status === 'inactive')
                                                disabled
                                                @endif
                                                >
                                                <label class="form-check-label text-dark"
                                                    for="provider-server-{{ $server->package_id }}">
                                                <span class="badge bg-secondary">MC: {{ $server->id }}
                                                </span>
                                                <span class="font-semibold">- {!! ucwords($server->name) !!} - </span>
                                                <span class="badge bg-primary">{{ $server->levelPrice(Auth::user()->level ?? $server->price_member) }}đ</span>
                                                @if ($server->status === 'inactive')
                                                <span class="badge bg-danger">Bảo trì</span>
                                                @else
                                                <span class="badge bg-success">Hoạt động</span>
                                                @endif
                                                @if ($server->limit_day > 0)
                                                <span class="badge bg-warning">Giới hạn: {{ number_format($server->limit_day) }} lần/ngày</span>
                                                @endif
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div id="informationServer"></div>
                                    </div>
                                </div>
                                <div class="form-group mb-3 reactions" id="reactions_type" style="display: none;">
                                    <label class="form-label text-dark">Cảm xúc:</label>
                                    <div class="mt-3">
                                        <div class=" form-check form-check-inline">
                                            <label class="form-check-label " for="reaction0">
                                            <input class="form-check-input checkbox d-none" type="radio"
                                                data-prices="101" id="reaction0" name="reaction" value="like"
                                                checked="">
                                            <img src="{{ asset('assets/pack-lamtilo/reaction/like.png') }}"
                                                alt="image" class="d-block ml-2 rounded-circle" width="35">
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label " for="reaction1">
                                            <input class="form-check-input checkbox d-none" type="radio"
                                                data-prices="100" id="reaction1" name="reaction" value="love">
                                            <img src="{{ asset('assets/pack-lamtilo/reaction/love.png') }}"
                                                alt="image" class="d-block ml-2 rounded-circle" width="35">
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label " for="reaction2">
                                            <input class="form-check-input checkbox d-none" type="radio"
                                                data-prices="100" id="reaction2" name="reaction" value="care">
                                            <img src="{{ asset('assets/pack-lamtilo/reaction/care.png') }}"
                                                alt="image" class="d-block ml-2 rounded-circle" width="35">
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label " for="reaction3">
                                            <input class="form-check-input checkbox d-none" type="radio"
                                                data-prices="100" id="reaction3" name="reaction" value="haha">
                                            <img src="{{ asset('assets/pack-lamtilo/reaction/haha.png') }}"
                                                alt="image" class="d-block ml-2 rounded-circle" width="35">
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label " for="reaction4">
                                            <input class="form-check-input checkbox d-none" type="radio"
                                                data-prices="100" id="reaction4" name="reaction" value="wow">
                                            <img src="{{ asset('assets/pack-lamtilo/reaction/wow.png') }}"
                                                alt="image" class="d-block ml-2 rounded-circle" width="35">
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label " for="reaction6">
                                            <input class="form-check-input checkbox d-none" type="radio"
                                                data-prices="100" id="reaction6" name="reaction" value="sad">
                                            <img src="{{ asset('assets/pack-lamtilo/reaction/sad.png') }}"
                                                alt="image" class="d-block ml-2 rounded-circle" width="35">
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label " for="reaction7">
                                            <input class="form-check-input checkbox d-none" type="radio"
                                                data-prices="100" id="reaction7" name="reaction" value="angry">
                                            <img src="{{ asset('assets/pack-lamtilo/reaction/angry.png') }}"
                                                alt="image" class="d-block ml-2 rounded-circle" width="35">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3 comments" id="comments_type" style="display: none;">
                                    <label for="comments" class="form-label text-dark">
                                        Nội dung bình luận: <span id="counter_comment"
                                            class="badge bg-success py-1">0</span>
                                        <span id="quantity_limitss">(0 ~ 0)</span>
                                        <div class="alert alert-danger text-danger mt-1 mb-0" id="">
                                            <strong>Lưu ý:</strong> Nếu bạn nhập nhiều bình luận, hệ thống sẽ chọn ngẫu
                                            nhiên 1 bình
                                            luận trong số đó để tăng<br>Các ngôn từ bị cấm: dm|đm|đ m|d m|địt mẹ|dit
                                            me|lol|lừađảo|conchó|trảtiền|mấtdạy|lừa đảo| con chó|trả tiền|mất dạy|lua
                                            dao|con cho|tra tien|mat day
                                        </div>
                                    </label>
                                    <textarea class="form-control" name="comments" id="comments" rows="3"
                                        placeholder="Nhập nội dung bình luận" onkeyup="checkPrice()"></textarea>
                                </div>
                                <div class="form-group mb-3 minute" id="minute_type" style="display: none;">
                                    <label for="minute" class="form-label text-dark">Số phút</label>
                                    <select name="minutes" class="form-select" onchange="checkPrice()">
                                        <option value="15">15 phút</option>
                                        <option value="30">30 phút</option>
                                        <option value="60">60 phút</option>
                                        <option value="90">90 phút</option>
                                        <option value="120">120 phút</option>
                                        <option value="150">150 phút</option>
                                        <option value="180">180 phút</option>
                                        <option value="210">210 phút</option>
                                        <option value="240">240 phút</option>
                                        <option value="270">270 phút</option>
                                        <option value="300">300 phút</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" id="time_type" style="display: none;">
                                        <div class="form-group mb-3">
                                            <label for="duration" class="form-label text-dark">Thời gian:</label>
                                            <select name="duration" id="duration" class="form-select"
                                                onchange="checkPrice()">
                                                {{-- 
                                                <option value="7">7 Ngày</option>
                                                <option value="15">15 Ngày</option>
                                                --}}
                                                <option value="30">30 Ngày</option>
                                                <option value="60">60 Ngày</option>
                                                <option value="90">90 Ngày</option>
                                                <option value="120">120 Ngày</option>
                                                <option value="150">150 Ngày</option>
                                                <option value="180">180 Ngày</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3" id="posts_type" style="display: none;">
                                            <label for="posts" class="form-label text-dark">Số bài viết:</label>
                                            {{-- <input type="number" class="form-control" id="posts" name="posts"
                                                onkeyup="checkPrice()" value="5" placeholder="Nhập thời gian"> --}}
                                            <select name="posts" id="posts" class="form-select">
                                                <option value="unlimited">Không giới hạn</option>
                                                {{-- 
                                                <option value="5">5 Bài viết</option>
                                                <option value="10">10 Bài viết</option>
                                                <option value="20">20 Bài viết</option>
                                                <option value="30">30 Bài viết</option>
                                                <option value="40">40 Bài viết</option>
                                                <option value="50">50 Bài viết</option>
                                                <option value="60">60 Bài viết</option>
                                                --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group mb-3 quantity" id="quantity_type">
                                            <label for="quantity" class="form-label text-dark">Số lượng: <span  id="quantity_limit">(0 ~ 0)</span></label>
                                            <input type="number" class="form-control" id="quantity" name="quantity" value="" onkeyup="checkPrice()" placeholder="Nhập số lượng" list="suggestions">
                                            <datalist id="suggestions">
                                                <option value="100">
                                                <option value="1000">
                                                <option value="10000">
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="voucher" class="form-label text-dark">Mã giảm giá:</label>
                                            <input type="text" class="form-control" id="voucher" name="voucher" placeholder="Nhập mã giảm giá (Nếu có)">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="note" class="form-label text-dark">Ghi chú:</label>
                                    <textarea class="form-control" name="note" id="note" rows="3"
                                        placeholder="Nhập ghi chú nếu cần"></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="alert bg-primary text-center text-white">
                                        <h3 class="alert-heading">Tổng thanh toán: <span class="text-danger"
                                            id="total_pay">0</span>
                                            VNĐ
                                        </h3>
                                        <p class="fs-4 mb-0" id="text-order">Bạn sẽ tăng <span class="text-danger"
                                            id="total_quantity">0</span>
                                            số
                                            lượng với giá <span class="text-danger" id="current_price">0</span> đ
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    @if (Auth::check())
                                    <button type="submit"  id="countdown"
                                        class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span>Tạo đơn hàng</span>
                                    </button>
                                    @else
                                    <a href="{{route('login')}}"
                                        class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span>Vui lòng đăng nhập để sử dụng dịch vụ!</span>
                                    </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-4">
                            <div class="card user-card">
                                <div class="card-body">
                                    <div class="user-cover-bg">
                                        <img src="/app/images/application/img-user-cover-1.jpg" alt="image" class="img-fluid">
                                        <div class="cover-data">
                                            <div class="d-inline-flex align-items-center">
                                                <i class="ph-duotone ph-star text-warning me-1"></i>
                                                4.5 <small class="text-white text-opacity-50">/ 5</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat-avtar card-user-image">
                                        <img src="https://ui-avatars.com/api/?background=random&name={{(Auth::user()->name) ?? 'Bạn chưa đăng nhập'}}" alt="user-image" class="img-thumbnail rounded-circle">
                                        <i class="chat-badge bg-success"></i>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{(Auth::user()->name) ?? 'Bạn chưa đăng nhập'}}</h6>
                                            <p class="text-primary"><span>@</span>{{ Auth::user()->username ?? 'Noname' }}</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button class="btn btn-primary btn-sm">Message</button>
                                            <button class="btn btn-outline-secondary btn-sm ms-1">Follow</button>
                                        </div>
                                    </div>
                                    @if (Auth::check())
                                    <div class="row g-3 my-3 text-center">
                                        <div class="col-4">
                                            <h6 class="mb-0">{{ number_format(Auth::user()->balance) }}đ</h6>
                                            <small class="text-muted">Số dư</small>
                                        </div>
                                        <div class="col-4">
                                            <h6 class="mb-0">{{ number_format(Auth::user()->total_recharge) }}đ</h6>
                                            <small class="text-muted">Tổng nạp</small>
                                        </div>
                                        <div class="col-4">
                                            <h6 class="mb-0">{{ number_format(Auth::user()->total_recharge - Auth::user()->balance, 0, ',', '.') }}đ</h6>
                                            <small class="text-muted">Đã tiêu</small>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="alert alert-info mb-3 font-semibold border-dashed" style="border-radius: 1rem">
                                <h5 class="alert-heading">Hướng dẫn</h5>
                                {!! $service->note !!}
                            </div>
                            <div class="alert alert-danger mb-3 font-semibold border-dashed" style="border-radius: 1rem">
                                <h5 class="alert-heading">LƯU Ý!</h5>
                                <p>• Nghiêm cấm buff các đơn có nội dung vi phạm pháp luật, chính trị, đồ trụy... Nếu cố tình buff bạn sẽ bị trừ hết tiền và ban khỏi hệ thống vĩnh viễn, và phải chịu hoàn toàn trách nhiệm trước pháp luật.&nbsp;</p>
                                <p>• Nếu đơn đang chạy trên hệ thống mà bạn vẫn mua ở các hệ thống bên khác, nếu có tình trạng hụt, thiếu số lượng giữa 2 bên thì sẽ không được xử lí.&nbsp;</p>
                                <p>• Đơn cài sai thông tin hoặc lỗi trong quá trình tăng hệ thống sẽ không hoàn lại tiền.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane show" id="list" role="tabpanel">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <form action="">
                                <div class="row mb-3">
                                    <div class="col-md-1">
                            <form action="">
                            <div class="row">
                            <div class="form-group">
                            <label for="start_date" class="form-label text-dark">Hiển
                            thị</label>
                            <select name="soluong" id="soluong" class="form-select"
                                onchange="this.form.submit()">
                            <option value="10" {{ request()->soluong == '10' ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request()->soluong == '25' ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request()->soluong == '50' ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request()->soluong == '100' ? 'selected' : '' }}>100</option>
                            </select>
                            </div>
                            </div>
                            </form>
                            </div>
                            <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                            <label for="start_date" class="form-label text-dark">Từ ngày</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                value="{{ request()->start_date }}">
                            </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                            <label for="end_date" class="form-label text-dark">Đến ngày</label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                value="{{ request()->end_date }}">
                            </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                            <label for="status" class="form-label text-dark">Trạng thái</label>
                            <select name="status" id="status" class="form-select">
                            <option value="">Tất cả</option>
                            <option value="Processing" {{ request()->status === 'Processing' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="Completed" {{ request()->status === 'Completed' ? 'selected' : '' }}>Đã hoàn thành
                            </option>
                            <option value="Cancelled" {{ request()->status === 'Cancelled' ? 'selected' : '' }}>Đã hủy</option>
                            <option value="Refunded" {{ request()->status === 'Refunded' ? 'selected' : '' }}>
                            Đã hoàn tiền</option>
                            <option value="Failed" {{ request()->status === 'Failed' ? 'selected' : '' }}>Thất
                            bại</option>
                            <option value="Pending" {{ request()->status === 'Pending' ? 'selected' : '' }}>
                            Chờ xử lý</option>
                            </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-lg-2">
                            <div class="form-group">
                            <label for="order_code" class="form-label text-dark">Mã đơn hàng</label>
                            <div class="input-group">
                            <input type="text" class="form-control" id="order_code"
                                name="order_code" value="{{ request()->order_code }}"
                                placeholder="Nhập mã đơn hàng">
                            <button type="submit" class="btn btn-primary d-flex align-items-center">
                            <i class="fas fa-search"></i>
                            </button>
                            </div>
                            </div>
                            </div>
                            </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover fw-bold">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Thao tác</th>
                                            <th>Mã gói</th>
                                            <th>Mã đơn hàng</th>
                                            <th>LINK/UID</th>
                                            <th>Máy chủ</th>
                                            @if ($service->quantity_status === 'on')
                                            <th>Số lượng</th>
                                            @endif
                                            @if ($service->reaction_status === 'on')
                                            <th>Cảm xúc</th>
                                            @endif
                                            @if ($service->comments_status === 'on')
                                            <th>Bình luận</th>
                                            @endif
                                            @if ($service->minute_status === 'on')
                                            <th>Số phút</th>
                                            @endif
                                            @if ($service->time_status === 'on')
                                            <th>Số ngày</th>
                                            <th>Còn lại</th>
                                            @endif
                                            {{-- @if ($service->posts_status === 'on')
                                            <th>Bài viết/Ngày</th>
                                            @endif --}}
                                            @if ($service->time_status !== 'on')
                                            <th>Ban đầu</th>
                                            <th>Đã tăng</th>
                                            @endif
                                            <th>Trạng thái</th>
                                            <th>Giá tiền</th>
                                            <th>Thanh toán</th>
                                            <th>Cập nhật</th>
                                            <th>Thời gian tạo</th>
                                            <th>Ghi chú</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-bold">
                                        @if ($orders->isEmpty())
                                        @include('admin.components.table-search-not-found', ['colspan' => 20])
                                        @else
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td class="">
                                                <div class="d-flex align-items-center gap-1">
                                                    @if (
                                                    $order->status !== 'Completed' &&
                                                    $order->status !== 'Refunded' &&
                                                    $order->status !== 'Cancelled' &&
                                                    $order->status !== 'Failed' &&
                                                    $order->status !== 'WaitingForRefund' &&
                                                    $order->status !== 'WaitingForRefund' &&
                                                    $order->status !== 'Failed' &&
                                                    $order->status !== 'Partially Refunded' &&
                                                    $order->status !== 'Partially Completed'
                                                    )
                                                    {{-- Hoàn tiền --}}
                                                    @if (isset($order->server->action->refund_status) && $order->server->action->refund_status === 'on')
                                                    <a href="javascript:;" class="btn btn-sm btn-warning"
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
                                                    @endif
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
                                                </div>
                                            </td>
                                            <td>{{ $order->service->package }}</td>
                                            <td> <a href="javascript:;" onclick="coppy('{{ $order->order_code }}')"
                                                class="text-success">{{ $order->order_code }} </a></td>
                                            <td>
                                                <a href="javascript:;"
                                                    onclick="coppy('{{ $order->object_id }}')">{{ $order->object_id }}</a>
                                            </td>
                                            <td><span class="badge bg-secondary">
                                                @php
                                                echo 'Sv' . $order->object_server;
                                                @endphp
                                                </span>
                                            </td>
                                            @if ($service->quantity_status === 'on')
                                            <td class="text-danger">{{ number_format($order->orderdata()['quantity']) }}
                                            </td>
                                            @endif
                                            @if ($service->reaction_status === 'on')
                                            <td>
                                                <div class=" form-check form-check-inline">
                                                    <label class="form-check-label " for="reaction0">
                                                    <input class="form-check-input checkbox d-none" type="radio"
                                                        data-prices="101" id="reaction0" name="reaction"
                                                        value="{{ $order->orderdata()['reaction'] }}" checked="">
                                                    <img src="/assets/pack-lamtilo/reaction/{{ $order->orderdata()['reaction'] }}.png"
                                                        alt="image" class="d-block ml-2 rounded-circle" width="35">
                                                    </label>
                                                </div>
                                            </td>
                                            @endif
                                            @if ($service->comments_status === 'on')
                                            <td>
                                                <textarea class="form-control note" rows="3"
                                                    readonly>{{ $order->orderdata()['comments'] }}</textarea>
                                            </td>
                                            @endif
                                            @if ($service->minute_status === 'on')
                                            <td>{{ $order->orderdata()['minute'] }} phút</td>
                                            @endif
                                            @if ($service->time_status === 'on')
                                            <td>{{ $order->orderdata()['duration'] }} ngày</td>
                                            <td>{{ remainingDays($order->time, $order->remaining, true) }}
                                            </td>
                                            @endif
                                            {{-- @if ($service->posts_status === 'on')
                                            <td>{{ $order->posts ?? 0 }}/{{ $order->orderdata()['posts'] }}</td>
                                            @endif --}}
                                            @if ($service->time_status !== 'on')
                                            <td class="text-primary">{{ number_format($order->start) }}</td>
                                            <td class="text-success">{{ number_format($order->buff) }}</td>
                                            @endif
                                            <td>
                                                {!! statusOrder($order->status, true) !!}
                                            </td>
                                            <td><span class="badge bg-danger">{{ $order->price }} đ</span></td>
                                            <td>
                                                <span class="badge bg-warning">
                                                {{ number_format($order->payment) }} đ
                                                </span>
                                            </td>
                                            <td class="text-success">{{ $order->updated_at->diffForHumans() }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>
                                                <textarea class="form-control note" rows="3"
                                                    readonly>{{ $order->note }}</textarea>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{ $orders->appends(request()->all())->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@if (site('confirm_payment') !== 'on')
<script src="{{ asset('assets/pack-lamtilo/js/order.js?time=') }}{{ time() }}"></script>
@else
<script src="{{ asset('assets/pack-lamtilo/js/service1.js?time=') }}{{ time() }}"></script>
@endif
@endsection