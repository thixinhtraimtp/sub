@extends('admin.layouts.app')
@section('title','Cấu hình hệ thống')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="fw-bold">Loại Cron</th>
                                <th class="fw-bold">Link</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr>
                                <td colspan="2" class="text-center fw-bold">
                                     (bắt buộc cron vòng lặp 60 - 120s trở lên nếu cron dưới sẽ bị khóa trang web) Thuê cron giá rẻ tại <a href="https://taowebnhanh.net/cronjob" target="_blank">https://taowebnhanh.net/cronjob</a>
                                </td>
                            </tr>
                            @if (env('APP_MAIN_SITE') == request()->getHost())
                            <tr>
                                <td class="fw-bold">Nạp tiền Momo</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://{{getDomain()}}/api/v1/cronJob/recharge/MOMO')">https://{{getDomain()}}/api/v1/cronJob/recharge/MOMO</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền MBBank</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://{{getDomain()}}/api/v1/cronJob/recharge/MBBANK')">https://{{getDomain()}}/api/v1/cronJob/recharge/MBBANK</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền Vietcombank</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://{{getDomain()}}/api/v1/cronJob/recharge/VCB')">https://{{getDomain()}}/api/v1/cronJob/recharge/VCB</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền ACB</td>
                                <td>
                                    <button class="btn btn-primary-gradient btn-sm" onclick="coppy('https://{{getDomain()}}/api/v1/cronJob/recharge/ACB')">https://{{getDomain()}}/api/v1/cronJob/recharge/ACB</button>
                                </td>
                            </tr>
                            <td class="fw-bold">Nạp tiền BIDV</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://{{getDomain()}}/api/v1/cronJob/recharge/BIDV')">https://{{getDomain()}}/api/v1/cronJob/recharge/BIDV</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Callback thẻ</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://{{getDomain()}}/api/v1/callback/card')">https://{{getDomain()}}/api/v1/callback/card</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Check Giá SMM</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://{{getDomain()}}/api/v1/price/smm</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Cập nhật đơn</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://{{getDomain()}}/api/v1/status/order</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Hoàn tiền đơn hàng</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://{{getDomain()}}/api/v1/refund/order</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền BIDV</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm">https://{{getDomain()}}/api/v1/payment/BIDV</button>
                                </td>
                            </tr>
                            @else
                            <tr>
                            <tr>
                                <td class="fw-bold">Nạp tiền Momo</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://{{getDomain()}}/api/v1/cronJob/recharge/MOMO')">https://{{getDomain()}}/api/v1/cronJob/recharge/MOMO</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền MBBank</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://{{getDomain()}}/api/v1/cronJob/recharge/MBBANK')">https://{{getDomain()}}/api/v1/cronJob/recharge/MBBANK</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền Vietcombank</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://{{getDomain()}}/api/v1/cronJob/recharge/VCB')">https://{{getDomain()}}/api/v1/cronJob/recharge/VCB</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Nạp tiền ACB</td>
                                <td>
                                    <button class="btn btn-primary-gradient btn-sm" onclick="coppy('https://{{getDomain()}}/api/v1/cronJob/recharge/ACB')">https://{{getDomain()}}/api/v1/cronJob/recharge/ACB</button>
                                </td>
                            </tr>
                            <td class="fw-bold">Nạp tiền BIDV</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://{{getDomain()}}/api/v1/cronJob/recharge/BIDV')">https://{{getDomain()}}/api/v1/cronJob/recharge/BIDV</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Callback thẻ</td>
                                <td><button
                                    class="btn btn-primary-gradient btn-sm" onclick="coppy('https://{{getDomain()}}/api/v1/callback/card')">https://{{getDomain()}}/api/v1/callback/card</button>
                                </td>
                            </tr>
                            <tr>
                            <td class="fw-bold">Cập nhật trạng thái đơn từ Site Mẹ(Bắt buộc Cron)</td>
                                <td>
                                    <span class="btn btn-primary-gradient btn-sm">{{ route('cron-job.update') }}</button>
                                </td>
                            </tr>
                            <tr>
                            @endif
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