@extends('admin.layouts.app')
@section('title', 'Cấu hình nạp tiền')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">Khuyến mãi</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.payment.config.update') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="date" name="start_promotion" id="start_promotion"
                            value="{{ siteValue('start_promotion') }}" class="form-control">
                        <label for="start_promotion">Ngày bắt đầu khuyến mãi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" name="end_promotion" id="end_promotion"
                            value="{{ siteValue('end_promotion') }}" class="form-control">
                        <label for="end_promotion">Ngày kết thúc khuyến mãi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="percent_promotion" id="percent_promotion"
                            value="{{ siteValue('percent_promotion') }}" class="form-control">
                        <label for="percent_promotion">Phần trăm khuyến mãi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="transfer_code" id="transfer_code"
                            value="{{ siteValue('transfer_code') }}" class="form-control">
                        <label for="transfer_code">Nội dung chuyển khoản</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary-gradient w-100">
                        <i class="fas fa-save"></i>
                        Lưu cấu hình
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">Cấu hình nạp thẻ cào: <span><a href="https://{{ configValue('api_recharge_card') }}/" target="blank_" style="text-transform: uppercase;">{{ configValue('api_recharge_card') }}</a></span></h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.website.update') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="partner_id" id="partner_id" value="{{ siteValue('partner_id') }}"
                            placeholder="Nhập dữ liệu">
                        <label for="partner_id">Partner Id</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="partner_key" id="partner_key" value="{{ siteValue('partner_key') }}"
                            placeholder="Nhập dữ liệu">
                        <label for="partner_key">Partner Key</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="percent" id="percent" value="{{ siteValue('percent') }}"
                            placeholder="Nhập dữ liệu">
                        <label for="percent">Chiết khấu</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control text-dark" value="https://{{getDomain()}}/api/v1/card"
                            placeholder="Nhập dữ liệu" readonly>
                        <label for="">Link callback</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary-gradient w-100">
                        <i class="fas fa-save"></i>
                        Lưu cấu hình
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="card-title">Cổng thanh toán: <a href="https://{{ configValue('api_deposit') }}/" target="blank_" style="text-transform: uppercase;" class="text-warning">{{ configValue('api_deposit') }}</a></h5>
            </div>
            <div class="card-body">
                <div class="table-responsive table-wrapper mb-3 table-wrapper mb-3">
                    <table class="table text-nowrap table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Ngân hàng</th>
                                <th>Thao tác</th>
                                <th>Số tài khoản</th>
                                <th>Chủ tài khoản</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold">
                            <tr>
                                <td class="text-primary">MOMO <a href="https://api.web2m.com/" target="blank_" class="text-warning">( API.WEB2M.COM )</a></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success-gradient"data-bs-toggle="modal" data-bs-target="#momo"><i class="ti ti-eye" data-bs-toggle="tooltip" title="Xem thêm"></i></button>
                                </td>
                                <td>{{ $momo->account_number }}</td>
                                <td>{{ $momo->account_name }}</td>
                                <td>
                                @if ($momo->status == 'active')
                                    <span class="badge bg-success-gradient">Hoạt động</span>
                                @else
                                    <span class="badge bg-danger-gradient">Không hoạt động</span>
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-primary">MBBANK</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success-gradient" data-bs-toggle="modal" data-bs-target="#mbbank"><i class="ti ti-eye" data-bs-toggle="tooltip" title="Xem thêm"></i></button>
                                </td>
                                <td>{{ $mbbank->account_number }}</td>
                                <td>{{ $mbbank->account_name }}</td>
                                <td>
                                @if ($mbbank->status == 'active')
                                    <span class="badge bg-success-gradient">Hoạt động</span>
                                @else
                                    <span class="badge bg-danger-gradient">Không hoạt động</span>
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-primary">VIETCOMBANK</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success-gradient" data-bs-toggle="modal" data-bs-target="#vietcombank"><i class="ti ti-eye" data-bs-toggle="tooltip" title="Xem thêm"></i></button>
                                </td>
                                <td>{{ $vietcombank->account_number }}</td>
                                <td>{{ $vietcombank->account_name }}</td>
                                <td>
                                @if ($vietcombank->status == 'active')
                                    <span class="badge bg-success-gradient">Hoạt động</span>
                                @else
                                    <span class="badge bg-danger-gradient">Không hoạt động</span>
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-primary">ACB</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success-gradient" data-bs-toggle="modal" data-bs-target="#acb"><i class="ti ti-eye" data-bs-toggle="tooltip" title="Xem thêm"></i></button>
                                </td>
                                <td>{{ $acb->account_number }}</td>
                                <td>{{ $acb->account_name }}</td>
                                <td>
                                @if ($acb->status == 'active')
                                    <span class="badge bg-success-gradient">Hoạt động</span>
                                @else
                                    <span class="badge bg-danger-gradient">Không hoạt động</span>
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-primary">BIDV</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success-gradient" data-bs-toggle="modal" data-bs-target="#bidv"><i class="ti ti-eye" data-bs-toggle="tooltip" title="Xem thêm"></i></button>
                                </td>
                                <td>{{ $bidv->account_number }}</td>
                                <td>{{ $bidv->account_name }}</td>
                                <td>
                                @if ($bidv->status == 'active')
                                    <span class="badge bg-success-gradient">Hoạt động</span>
                                @else
                                    <span class="badge bg-danger-gradient">Không hoạt động</span>
                                @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body pc-component">
    <div id="momo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="momo" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="momo">Cấu hình thanh toán MOMO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route('admin.payment.update', ['bank_name' => $momo->bank_name]) }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <select name="status" id="status" class="form-select">
                        <option value="active" {{ $momo->status == 'active' ? 'selected' : '' }}>Bật</option>
                        <option value="inactive" {{ $momo->status == 'inactive' ? 'selected' : '' }}>Tắt</option>
                        </select>
                        <label for="status">Trạng thái</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_name" id="account_name" value="{{ $momo->account_name }}"
                            placeholder="Nhập dữ liệu">
                        <label for="account_name">Chủ tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_number" id="account_number" value="{{ $momo->account_number }}"
                            placeholder="Nhập dữ liệu">
                        <label for="account_number">Số điện thoại</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="min_recharge" id="min_recharge" value="{{ $momo->min_recharge ?? 10000}}"
                            placeholder="Nhập dữ liệu">
                        <label for="min_recharge">Nạp tối thiểu</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="api_key" id="api_key" value="{{ $momo->token }}"
                            placeholder="Nhập dữ liệu">
                        <label for="api_key">Token API Bank</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary-gradient w-100">
                        <i class="fas fa-save"></i>
                        Lưu cấu hình
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body pc-component">
    <div id="mbbank" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mbbank" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mbbank">Cấu hình thanh toán MB BANK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route('admin.payment.update', ['bank_name' => $mbbank->bank_name]) }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <select name="status" id="status" class="form-select">
                        <option value="active" {{ $mbbank->status == 'active' ? 'selected' : '' }}>Bật</option>
                        <option value="inactive" {{ $mbbank->status == 'inactive' ? 'selected' : '' }}>Tắt</option>
                        </select>
                        <label for="status">Trạng thái</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_name" id="account_name" value="{{ $mbbank->account_name }}"
                            placeholder="Nhập dữ liệu">
                        <label for="account_name">Chủ tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_number" value="{{ $mbbank->account_number }}"
                            id="account_number" placeholder="Nhập dữ liệu">
                        <label for="account_number">Số tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="min_recharge" id="min_recharge" value="{{ $mbbank->min_recharge }}"
                            placeholder="Nhập dữ liệu">
                        <label for="min_recharge">Nạp tối thiểu</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="text" class="form-control" name="account_username" id="account_username" value="{{ $mbbank->account_number ?? '#'}}"
                            placeholder="Nhập dữ liệu">
                        <label for="account_username">Tài khoản</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="password" class="form-control" name="account_password" id="account_password" value="{{ $mbbank->account_password ?? '#'}}"
                            placeholder="Nhập dữ liệu">
                        <label for="account_password">Mật khẩu</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="api_key" id="api_key" value="{{ $mbbank->token }}"
                            placeholder="Nhập dữ liệu">
                        <label for="api_key">Token API</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary-gradient w-100">
                        <i class="fas fa-save"></i>
                        Lưu cấu hình
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body pc-component">
    <div id="vietcombank" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vietcombank" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vietcombank">Cấu hình thanh toán VIETCOMBANK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route('admin.payment.update', ['bank_name' => $vietcombank->bank_name]) }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <select name="status" id="status" class="form-select">
                        <option value="active" {{ $vietcombank->status == 'active' ? 'selected' : '' }}>Bật</option>
                        <option value="inactive" {{ $vietcombank->status == 'inactive' ? 'selected' : '' }}>Tắt</option>
                        </select>
                        <label for="status">Trạng thái</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_name" id="account_name" value="{{ $vietcombank->account_name }}"
                            placeholder="Nhập dữ liệu">
                        <label for="account_name">Chủ tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_number" value="{{ $vietcombank->account_number }}"
                            id="account_number" placeholder="Nhập dữ liệu">
                        <label for="account_number">Số tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="min_recharge" id="min_recharge" value="{{ $vietcombank->min_recharge ?? '10000' }}"
                            placeholder="Nhập dữ liệu">
                        <label for="min_recharge">Nạp tối thiểu</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="text" class="form-control" name="account_username" id="account_username" value="{{ $vietcombank->bank_account ?? '#' }}"
                            placeholder="Nhập dữ liệu">
                        <label for="account_username">Tài khoản</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="password" class="form-control" name="account_password" id="account_password" value="{{ $vietcombank->bank_password ?? '#'}}"
                            placeholder="Nhập dữ liệu">
                        <label for="account_password">Mật khẩu</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="api_key" id="api_key" value="{{ $vietcombank->token }}"
                            placeholder="Nhập dữ liệu">
                        <label for="api_key">Token API</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary-gradient w-100">
                        <i class="fas fa-save"></i>
                        Lưu cấu hình
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body pc-component">
    <div id="acb" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="acb" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="acb">Cấu hình thanh toán ACB</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route('admin.payment.update', ['bank_name' => $acb->bank_name]) }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <select name="status" id="status" class="form-select">
                        <option value="active" {{ $acb->status == 'active' ? 'selected' : '' }}>Bật</option>
                        <option value="inactive" {{ $acb->status == 'inactive' ? 'selected' : '' }}>Tắt</option>
                        </select>
                        <label for="status">Trạng thái</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_name" id="account_name" value="{{ $acb->account_name }}"
                            placeholder="Nhập dữ liệu">
                        <label for="account_name">Chủ tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_number" value="{{ $acb->account_number }}"
                            id="account_number" placeholder="Nhập dữ liệu">
                        <label for="account_number">Số tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="min_recharge" id="min_recharge" value="{{ $acb->min_recharge ?? '10000'}}"
                            placeholder="Nhập dữ liệu">
                        <label for="min_recharge">Nạp tối thiểu</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="text" class="form-control" name="account_username" id="account_username" value="{{ $acb->bank_account ?? '#' }}"
                            placeholder="Nhập dữ liệu">
                        <label for="account_username">Tài khoản</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="password" class="form-control" name="account_password" id="account_password" value="{{ $acb->bank_password ?? '#' }}"
                            placeholder="Nhập dữ liệu">
                        <label for="account_password">Mật khẩu</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="api_key" id="api_key" value="{{ $acb->token }}"
                            placeholder="Nhập dữ liệu">
                        <label for="api_key">Token API</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary-gradient w-100">
                        <i class="fas fa-save"></i>
                        Lưu cấu hình
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body pc-component">
    <div id="bidv" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="bidv" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bidv">Cấu hình thanh toán BIDV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route('admin.payment.update', ['bank_name' => $bidv->bank_name]) }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <select name="status" id="status" class="form-select">
                        <option value="active" {{ $bidv->status == 'active' ? 'selected' : '' }}>Bật</option>
                        <option value="inactive" {{ $bidv->status == 'inactive' ? 'selected' : '' }}>Tắt</option>
                        </select>
                        <label for="status">Trạng thái</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_name" id="account_name" value="{{ $bidv->account_name }}"
                            placeholder="Nhập dữ liệu">
                        <label for="account_name">Chủ tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="account_number" value="{{ $bidv->account_number }}"
                            id="account_number" placeholder="Nhập dữ liệu">
                        <label for="account_number">Số tài khoản</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="min_recharge" id="min_recharge" value="{{ $bidv->min_recharge ?? '10000'}}"
                            placeholder="Nhập dữ liệu">
                        <label for="min_recharge">Nạp tối thiểu</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="text" class="form-control" name="account_username" id="account_username" value="{{ $bidv->bank_account ?? '#'}}"
                            placeholder="Nhập dữ liệu">
                        <label for="account_username">Tài khoản</label>
                    </div>
                    <div class="form-floating mb-3" hidden>
                        <input type="password" class="form-control" name="account_password" id="account_password" value="{{ $bidv->bank_password ?? '#'}}"
                            placeholder="Nhập dữ liệu">
                        <label for="account_password">Mật khẩu</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="api_key" id="api_key" value="{{ $bidv->token }}"
                            placeholder="Nhập dữ liệu">
                        <label for="api_key">Token API</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary-gradient w-100">
                        <i class="fas fa-save"></i>
                        Lưu cấu hình
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection