@extends('guard.layouts.master')
@section('title', 'Thanh toán hóa đơn')

@section('content')

<div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Thanh toán hoá đơn</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="py-3 text-center  bg-light-primary text-primary rounded-2 fw-bold mb-4">
                        Nạp tiền qua chuyển khoản
                    </div>
                    <table class="table table-row-dashed table-row-gray-300 gy-7">
                        <tbody>
                            <tr>
                                <td>Ngân Hàng</td>
                                <td>
                                    <p class="text-info fw-bolder ng-binding bank-name" style="cursor: pointer; color: red !important; display: inline-block;">
                                        {{  $banks->bank_name }}
                                    </p>
                                     
                                </td>
                            </tr>
                            <tr>
                                <td>Tên chủ tài khoản</td>
                                <td>
                                    <p class="text-info fw-bolder ng-binding account-owner" style="cursor: pointer; color: red !important; display: inline-block;">
                                    {{  $banks->account_name }}</p>
                                    <button type="button" class="btn btn-primary text-sm btn-sm ml-3 btn-copy" style="float: right;" onclick="coppy(' {{  $banks->account_name }}')">
                                        Sao chép
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Số tài khoản</td>
                                <td>
                                    <p class="text-info fw-bolder ng-binding account-number" style="cursor: pointer; color: red !important; display: inline-block;">
                                    {{  $banks->account_number }}
                                    </p>
                                    <button type="button" class="btn btn-primary text-sm btn-sm ml-3 btn-copy" style="float: right;" onclick="coppy(' {{  $banks->account_number }}')">
                                        Sao chép
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Nội dung chuyển khoản</td>
                                <td>
                                    <p class="text-info fw-bolder ng-binding content-tranfer" style="cursor: pointer; color: red !important; display: inline-block;">
                                        {{ siteValue('transfer_code') }}{{ $payment->order_code }}</p>
                                    <button type="button" class="btn btn-primary text-sm btn-sm ml-3 btn-copy" style="float: right;" onclick="coppy('{{ siteValue('transfer_code') }}{{ $payment->order_code }}')">
                                        Sao chép
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Số tiền</td>
                                <td>
                                    <p class="text-info fw-bolder ng-binding amount-money" style="cursor: pointer; color: red !important; display: inline-block;">
                                        {{ number_format($payment->amount)}} VNĐ
                                    </p>
                                    <button type="button" class="btn btn-primary text-sm btn-sm ml-3 btn-copy" style="float: right;" onclick="coppy('{{  $payment->amount }}')">
                                        Sao chép
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="py-3 text-center  bg-light-primary text-primary rounded-2 fw-bold mb-4">
                        Nạp tiền qua quét mã QR
                    </div>
                    <div class="text-center mb-3">

                    @if ($payment->bank_name == 'MBBank')
                    <img src="https://img.vietqr.io/image/mb-{{ $banks->account_number }}-qronly2.jpg?accountName={{ $banks->account_name }}&addInfo={{ siteValue('transfer_code') }}{{ $payment->order_code }}&amount={{ $payment->amount }}"
                    alt="QR CODE" width="300">

                    @elseif ($payment->bank_name == 'Vietcombank')
                    <img src="https://img.vietqr.io/image/vietcombank-{{ $banks->account_number }}-qronly2.jpg?accountName={{ $banks->account_name }}&addInfo={{ siteValue('transfer_code') }}{{ $payment->order_code }}&amount={{ $payment->amount }}"
                    alt="QR CODE" width="300">

                    @elseif ($payment->bank_name == 'ACB')
                    <img src="https://img.vietqr.io/image/ACB-{{ $banks->account_number }}-qronly2.jpg?accountName={{ $banks->account_name }}&addInfo={{ siteValue('transfer_code') }}{{ $payment->order_code }}&amount={{ $payment->amount }}"
                    alt="QR CODE" width="300">
                    @endif
                    </div>
                    <div class="">
                        <h4 class="card-title">Hướng dẫn nạp tiền qua quét mã QR</h4>
                        <ul class="fw-bold">
                            <li>1. Đăng nhập ứng dụng Mobile Banking, chọn chức năng Scan QR và quét mã QR trên đây.</li>
                            <li>2. Nhập số tiền muốn nạp, kiểm tra thông tin đơn hàng (NH, chủ TK, số TK, Nội dung CK) trùng
                                khớp với thông tin CK bên trái.</li>
                            <li>3. Xác nhận giao dịch và chờ nhận thông báo giao dịch thành công.</li>
                        </ul>
                        <small>
                            <p class="text-danger">*Chú ý: mỗi mã QR chỉ dùng cho 1 giao dịch nạp tiền, không sử dụng lại
                            </p>
                        </small>
                    </div>
                </div>
                <div class="col-md-12">
                    
                    <div class="text-center mt-5">
                        
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection