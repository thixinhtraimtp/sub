@extends('guard.layouts.app')
@section('title', 'Rút Tiền')
@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="card ">
            <div class="card-body">
                <div class="mb-3">
                    <h6 class="card-title mb-0">Yêu Cầu Rút Tiền</h6>
                </div>
                <div>
                    <form action="{{ route('withdraw.create') }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <div class="text-danger fw-bold">
                                <i>
                                Số tiền có thể rút: từ
                                <span class="text-primary">{{number_format(siteValue('min_withdraw_ref'))}} ₫</span> đến <span class="text-success">{{number_format(siteValue('max_withdraw_ref'))}} ₫</span>
                                <p class="text-danger">Số dư có thể rút của bạn là: <span class="text-warning">{{ number_format(Auth::user()->referral_money ?? 0) ?: '0đ' }}</span></p>
                                </i>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Số Tiền Rút</label>
                            <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" >
                        </div>
                        <div class="mb-3">
                            <label for="bank_name" class="form-label">Ngân Hàng</label>
                            <select name="bank_name" id="bank_name" class="form-control">
                                <option value="">Chọn Ngân Hàng Rút</option>
                                <option value="ICB">Ngân hàng CTG - VietinBank</option>
                                <option value="VCB">Ngân hàng VCB - Vietcombank</option>
                                <option value="BIDV">Ngân hàng BIDV - BIDV</option>
                                <option value="VBA">Ngân hàng VBA - Agribank</option>
                                <option value="OCB">Ngân hàng OCB - OCB</option>
                                <option value="MB">Ngân hàng MB - MBBank</option>
                                <option value="TCB">Ngân hàng TCB - Techcombank</option>
                                <option value="ACB">Ngân hàng ACB - ACB</option>
                                <option value="VPB">Ngân hàng VPB - VPBank</option>
                                <option value="TPB">Ngân hàng TPB - TPBank</option>
                                <option value="STB">Ngân hàng STB - Sacombank</option>
                                <option value="HDB">Ngân hàng HDB - HDBank</option>
                                <option value="VCCB">Ngân hàng VCCB - VietCapitalBank</option>
                                <option value="SCB">Ngân hàng SCB - SCB</option>
                                <option value="VIB">Ngân hàng VIB - VIB</option>
                                <option value="SHB">Ngân hàng SHB - SHB</option>
                                <option value="EIB">Ngân hàng EIB - Eximbank</option>
                                <option value="MSB">Ngân hàng MSB - MSB</option>
                                <option value="CAKE">Ngân hàng CAKE - CAKE</option>
                                <option value="Ubank">Ngân hàng Ubank - Ubank</option>
                                <option value="VTLMONEY">Ngân hàng VTLMONEY - ViettelMoney</option>
                                <option value="VNPTMONEY">Ngân hàng VNPTMONEY - VNPTMoney</option>
                                <option value="SGICB">Ngân hàng SGICB - SaigonBank</option>
                                <option value="BAB">Ngân hàng BAB - BacABank</option>
                                <option value="PVCB">Ngân hàng PVCB - PVcomBank</option>
                                <option value="Oceanbank">Ngân hàng Oceanbank - Oceanbank</option>
                                <option value="NCB">Ngân hàng NCB - NCB</option>
                                <option value="SHBVN">Ngân hàng SHBVN - ShinhanBank</option>
                                <option value="ABB">Ngân hàng ABB - ABBANK</option>
                                <option value="VAB">Ngân hàng VAB - VietABank</option>
                                <option value="NAB">Ngân hàng NAB - NamABank</option>
                                <option value="PGB">Ngân hàng PGB - PGBank</option>
                                <option value="VIETBANK">Ngân hàng VIETBANK - VietBank</option>
                                <option value="BVB">Ngân hàng BVB - BaoVietBank</option>
                                <option value="SEAB">Ngân hàng SEAB - SeABank</option>
                                <option value="COOPBANK">Ngân hàng COOPBANK - COOPBANK</option>
                                <option value="LPB">Ngân hàng LPB - LienVietPostBank</option>
                                <option value="KLB">Ngân hàng KLB - KienLongBank</option>
                                <option value="KBank">Ngân hàng KBank - KBank</option>
                                <option value="VRB">Ngân hàng VRB - VRB</option>
                                <option value="SCVN">Ngân hàng SCVN - StandardChartered</option>
                                <option value="NHB HN">Ngân hàng NHB HN - Nonghyup</option>
                                <option value="IVB">Ngân hàng IVB - IndovinaBank</option>
                                <option value="IBK - HCM">Ngân hàng IBK - HCM - IBKHCM</option>
                                <option value="KBHCM">Ngân hàng KBHCM - KookminHCM</option>
                                <option value="KBHN">Ngân hàng KBHN - KookminHN</option>
                                <option value="WVN">Ngân hàng WVN - Woori</option>
                                <option value="HSBC">Ngân hàng HSBC - HSBC</option>
                                <option value="CBB">Ngân hàng CBB - CBBank</option>
                                <option value="IBK - HN">Ngân hàng IBK - HN - IBKHN</option>
                                <option value="CIMB">Ngân hàng CIMB - CIMB</option>
                                <option value="DBS">Ngân hàng DBS - DBSBank</option>
                                <option value="DOB">Ngân hàng DOB - DongABank</option>
                                <option value="GPB">Ngân hàng GPB - GPBank</option>
                                <option value="PBVN">Ngân hàng PBVN - PublicBank</option>
                                <option value="UOB">Ngân hàng UOB - UnitedOverseas</option>
                                <option value="HLBVN">Ngân hàng HLBVN - HongLeong</option>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="account_number" class="form-label">Số Tài Khoản</label>
                                <input type="text" class="form-control" id="account_number" name="account_number" value="{{ old('account_number') }}" placeholder="Nhập số tài khoản">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="account_name" class="form-label">Chủ Tài Khoản</label>
                                <input type="text" class="form-control" id="account_name" name="account_name" value="{{ old('account_name') }}" placeholder="Nhập tên chủ tài khoản">
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100" type="submit">Rút Tiền Ngay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h5>Lịch sử rút tiền</h5>
            </div>
            <div class="card-body">
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Số Tiền</th>
                                <th>Ngân Hàng</th>
                                <th>Tài Khoản</th>
                                <th>Chủ Tài Khoản</th>
                                <th>Trạng Thái</th>
                                <th>Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdraws as $withdraw)
                                <td>{{ $withdraw->id }}</td>
                                <td>{{ number_format($withdraw->amount) }} ₫</td>
                                <td>{{ $withdraw->bank_name }}</td>
                                <td>{{ $withdraw->account_number }}</td>
                                <td>{{ $withdraw->account_name }}</td>
                                <td>
                                    @if ($withdraw->status == 'pending')
                                        <span class="badge bg-warning">Chờ xử lý</span>
                                    @elseif($withdraw->status == 'success')
                                        <span class="badge bg-success">Thành công</span>
                                    @endif
                                </td>
                                <td>{{ $withdraw->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center align-items-center mt-1">
                        {{ $withdraws->appends(request()->all())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection