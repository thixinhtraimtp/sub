<?php

use App\Models\ConfigSite;
use Illuminate\Support\Carbon;

if (!function_exists('siteValue')) {
    function siteValue($column, $domain = null)
    {
        $domain = $domain ? $domain : request()->getHost();

        $configSite = ConfigSite::where('domain', $domain)->where('status', 'active')->first();
        if ($configSite) {
            return $configSite->$column;
        } else {
            return null;
        }
    }
}

if (!function_exists('statusCard')) {
    function statusCard($status)
    {
        switch ($status) {
        case 'Pending':
            return '<span class="badge bg-warning badge-warning">Chờ xử lý</span>';
            break;
        case 'Processing':
            return '<span class="badge bg-primary badge-primary">Đang xử lý</span>';
            break;
        case 'Success':
            return '<span class="badge bg-success badge-success">Thẻ đúng</span>';
            break;
        case 'Cancel':
            return '<span class="badge bg-danger badge-danger">Đã Hủy</span>';
            break;
        case 'Error':
            return '<span class="badge bg-danger badge-danger">Thẻ sai hoặc đã sử dụng</span>';
            break;
        default:
            return '<span class="badge bg-secondary badge-secondary">Không xác định</span>';
            break;
    }
    }
}

function trumcard1s($partner_id, $telco, $code, $serial, $amount, $request_id, $sign, $command = 'charging'){
    $url = "https://" . configValue('api_recharge_card') . "/chargingws/v2";
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://" . configValue('api_recharge_card') . "/chargingws/v2",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('telco' => $telco, 'code' => $code, 'serial' => $serial, 'amount' => $amount, 'request_id' => $request_id, 'partner_id' => $partner_id, 'sign' => $sign, 'command' => $command),
       
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response, true);
}

if (!function_exists('site')) {
    function site($column, $domain = null)
    {
        $domain = $domain ? $domain : request()->getHost();
        $configSite = ConfigSite::where('domain', $domain)->where('status', 'active')->first();
        if ($configSite) {
            return $configSite->$column;
        } else {
            return null;
        }
    }
}

if (!function_exists('configValue')) {
    function configValue($column)
    {
        $config = \App\Models\Config::first(); 
        if ($config) {
            return $config->$column;
        } else {
            return null;
        }
    }
}

 
if (!function_exists('statusAction')) {
    function statusAction($status, $html = false)
    {
        if ($html) {
            switch ($status) {
                case 'active':
                    return '<span class="badge bg-success">Hoạt động</span>';
                case 'inactive':
                    return '<span class="badge bg-danger">Không hoạt động</span>';
                default:
                    return '<span class="badge bg-success">Hoạt động</span>';
            }
        }

        switch ($status) {
            case 'active':
                return 'Hoạt động';
            case 'inactive':
                return 'Không hoạt động';
            default:
                return 'Hoạt động';
        }
    }
}


 
if (!function_exists('statusRecharge')) {
    function statusRecharge($status, $html = false)
    {
        if ($html) {
            switch ($status) {
                case 'Success':
                    return '<span class="badge bg-success">Thành công</span>';
                case 'Pending':
                    return '<span class="badge bg-warning">Đang chờ thanh toán</span>';
                case 'Failed':
                    return '<span class="badge bg-danger">Thất bại</span>';
                default:
                    return '<span class="badge bg-success">Đang chờ thanh toán</span>';
            }
        }

        switch ($status) {
            case 'Success':
                return 'Thành công';
            case 'Failed':
                return 'Thất bại';
            case 'Pending':
                return 'Đang chờ thanh toán';
            default:
                return 'Đang chờ thanh toán';
        }
    }
}



if (!function_exists('levelUser')) {
    function levelUser($level, $html = false)
    {
        if ($html) {
            switch ($level) {
                case 'member':
                    return '<span class="badge bg-primary">Thành viên</span>';
                case 'collaborator':
                    return '<span class="badge bg-warning">Cộng tác viên</span>';
                case 'agency':
                    return '<span class="badge bg-info">Đại lý</span>';
                case 'distributor':
                    return '<span class="badge bg-success">Nhà phân phối</span>';
                default:
                    return '<span class="badge bg-primary">Thành viên</span>';
            }
        }

        switch ($level) {
            case 'member':
                return 'Thành viên';
            case 'collaborator':
                return 'Cộng tác viên';
            case 'agency':
                return 'Đại lý';
            case 'distributor':
                return 'Nhà phân phối';
            default:
                return 'Thành viên';
        }
    }
}




if (!function_exists('statusTicket')) {
    function statusTicket($level)
    {
    
        switch ($level) {
            case 'pending':
                return '<span class="badge bg-warning">Chờ Phản Hồi</span>';
            case 'success':
                return '<span class="badge bg-success">Đã Phản Hồi</span>';
                
            default:
                return '<span class="badge bg-warning">Chờ Phản Hồi</span>';
        }
        
    }
}



if (!function_exists('getDomain')) {
    function getDomain()
    {
        return request()->getHost() ?? env('APP_MAIN_SITE');
    }
}

if (!function_exists('statusOrder')) {
    function statusOrder($status, $html = false, $isBreak = false)
    {
        //Processing, Completed, Cancelled, Refunded, Failed, Pending, Partially Refunded, Partially Completed, WaitingForRefund,
        if ($html) {
            switch ($status) {
                case 'Running':
                    return '<span class="badge bg-primary">Đang chạy</span>';
                case 'Processing':
                    return '<span class="badge bg-info">Đang xử lý</span>';
                case 'Holding':
                    return '<span class="badge bg-warning">Tạm dừng</span>';
                case 'Completed':
                    return '<span class="badge bg-success">Hoàn thành</span>';
                case 'Cancelled':
                    return '<span class="badge bg-danger">Đã hủy</span>';
                case 'Refunded':
                    return '<span class="badge bg-danger">Đã hoàn tiền</span>';
                case 'Failed':
                    return '<span class="badge bg-danger">Thất bại</span>';
                case 'Pending':
                    return '<span class="badge bg-warning">Chờ xử lý</span>';
                    
                case 'PendingRefundCancel':
                    return '<span class="badge bg-danger">Đơn đang xử lí hoàn</span>';
                  case 'PendingRefundPartial':
                    return '<span class="badge bg-danger">Đơn đang xử lí hoàn</span>';
                case 'Partially Refunded':
                    return '<span class="badge bg-danger">Hoàn tiền một phần</span>';
                    
                case 'Partial':
                    return '<span class="badge bg-danger">Hoàn tiền một phần</span>';
                case 'Partially Completed':
                    return '<span class="badge bg-warning">Hoàn thành một phần</span>';
                case 'WaitingForRefund':
                    return '<span class="badge bg-warning">Chờ hoàn tiền</span>';
                case 'Expired':
                    return '<span class="badge bg-danger">Đã Hết hạn</span>';
                case 'Success':
                    return '<span class="badge bg-success">Thành công</span>';
                case 'Active':
                    return '<span class="badge bg-primary">Đang hoạt động</span>';
                default:
                    return '<span class="badge bg-info">Đang xử lý</span>';
            }
        } else {
            switch ($status) {
                case 'Running':
                    return 'Đang chạy';
                case 'Processing':
                    return 'Đang xử lý';
                case 'Completed':
                    return 'Hoàn thành';
                case 'Cancelled':
                    return 'Đã hủy';
                case 'Refunded':
                    return 'Đã hoàn tiền';
                case 'Failed':
                    return 'Thất bại';
                case 'Pending':
                    return 'Chờ xử lý';
                case 'Partially Refunded':
                    return 'Hoàn tiền một phần';
                case 'Partially Completed':
                    return 'Hoàn thành một phần';
                case 'WaitingForRefund':
                    return 'Chờ hoàn tiền';
                case 'Expired':
                    return 'Hết hạn';
                default:
                    return 'Đang xử lý';
            }
        }
    }
}


if (!function_exists('statusOrder1')) {
    function statusOrder1($status, $html = false, $isBreak = false)
    {
        //Processing, Completed, Cancelled, Refunded, Failed, Pending, Partially Refunded, Partially Completed, WaitingForRefund,
        if ($html) {
            switch ($status) {
                case 'Running':
                    return '<span class="text-primary">Đang chạy</span>';
                case 'Processing':
                    return '<span class="text-info">Đang xử lý</span>';
                case 'Holding':
                    return '<span class="text-warning">Tạm dừng</span>';
                case 'Completed':
                    return '<span class="text-success">Hoàn thành</span>';
                case 'Cancelled':
                    return '<span class="text-danger">Đã hủy</span>';
                case 'Refunded':
                    return '<span class="text-danger">Đã hoàn tiền</span>';
                case 'Failed':
                    return '<span class="text-danger">Thất bại</span>';
                case 'Pending':
                    return '<span class="text-warning">Chờ xử lý</span>';
                case 'Partially Refunded':
                    return '<span class="text-danger">Hoàn tiền một phần</span>';
                case 'Partially Completed':
                    return '<span class="text-warning">Hoàn thành một phần</span>';
                case 'WaitingForRefund':
                    return '<span class="text-warning">Chờ hoàn tiền</span>';
                case 'Expired':
                    return '<span class="text-danger">Đã Hết hạn</span>';
                case 'Success':
                    return '<span class="text-success">Thành công</span>';
                case 'Active':
                    return '<span class="text-primary">Đang hoạt động</span>';
                default:
                    return '<span class="text-info">Đang xử lý</span>';
            }
        } else {
            switch ($status) {
                case 'Running':
                    return 'Đang chạy';
                case 'Processing':
                    return 'Đang xử lý';
                case 'Completed':
                    return 'Hoàn thành';
                case 'Cancelled':
                    return 'Đã hủy';
                case 'Refunded':
                    return 'Đã hoàn tiền';
                case 'Failed':
                    return 'Thất bại';
                case 'Pending':
                    return 'Chờ xử lý';
                case 'Partially Refunded':
                    return 'Hoàn tiền một phần';
                case 'Partially Completed':
                    return 'Hoàn thành một phần';
                case 'WaitingForRefund':
                    return 'Chờ hoàn tiền';
                case 'Expired':
                    return 'Hết hạn';
                default:
                    return 'Đang xử lý';
            }
        }
    }
}

// đếm số ngày còn lại trong remaining
if (!function_exists('remainingDays')) {
    function remainingDays($start, int $duration = 0, $m = false)
    {
        $startDate = Carbon::parse($start);

        // echo($duration . 'fkdsjlfkj');
        $endDate = $startDate->copy()->addDays($duration);

        $currentDate = Carbon::now();

        if ($currentDate->gte($endDate)) {
            return "Hết hạn";
        } else {
            $daysLeft = $currentDate->diffInDays($endDate);
            $daysLeft = number_format($daysLeft, 0, ',', '.');
            return $m === true ? $daysLeft . "Ngày" : $daysLeft;
        }
    }
}
if (!function_exists('curl_smm')) {
    function curl_smm($url, $data)
    {
       $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        
         
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response, true);
        return $result;

    }
}
if (!function_exists('timeago')) {
function timeago($date)
{
  $timestamp = strtotime($date);

  $strTime = ["giây", "phút", "giờ", "ngày", "tháng", "năm"];
  $length = ["60", "60", "24", "30", "12", "10"];

  $currentTime = time();
  if ($currentTime >= $timestamp) :
    $diff     = time() - $timestamp;
    for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
      $diff = $diff / $length[$i];
    }

    $diff = round($diff);
    return $diff . " " . $strTime[$i] . " ";
  endif;
}
}
function resApi($status = 'error', $message = 'Có lỗi xảy ra', $data = null)
{
    return response()->json([
        'status' => $status,
        'message' => $message,
        'data' => $data
    ]);
}
if (!function_exists('formatPrice')) {
    function formatPrice($price)
    {
        return number_format($price, 0, ',', '.');
    }
}
