<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\TelegramSdk;
use App\Models\Config;
use App\Models\ConfigSite;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServicePlatform;
use App\Models\ServerAction;
use App\Models\ServiceServer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DataAdminController extends Controller
{
    public function serviceChecking(Request $request)
    {
        $valid = Validator::make($request->all(), [
            "id" => "required",
        ]);

        if ($valid->fails()) {
            return resApi("error", $valid->errors()->first());
        } else {
            $lam = explode("_", $request->id);
            $social = ServicePlatform::where("domain", env("APP_MAIN_SITE"))
                ->where("id", $lam[0])
                ->first();
            if ($social) {
                $service_list = Service::where("domain", env("APP_MAIN_SITE"))
                    ->where("platform_id", $social->id)
                    ->get();

                $service_list = $service_list->map(function ($service) use (
                    $social
                ) {
                    $service->social_image = $social->image;
                    return $service;
                });
                if ($service_list->isNotEmpty()) {
                    return resApi("success", "Thành công", $service_list);
                } else {
                    return resApi("error", "Không tìm thấy dịch vụ");
                }
            } else {
                return resApi("error", "Không tìm thấy dịch vụ");
            }
        }
    }

    public function serverChecking(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $valid = Validator::make($request->all(), [
            "id" => "required|string",
        ]);

        if ($valid->fails()) {
            return resApi("error", $valid->errors()->first());
        }

        // Tách id từ request
        $lam = explode("-", $request->id);
        $serviceId = $lam[0];

        // Tìm dịch vụ
        $service = Service::where("domain", env("APP_MAIN_SITE"))
            ->where("id", $serviceId)
            ->first();

        if ($service) {
            // Lấy thông tin nền tảng xã hội
            $social = ServicePlatform::where("domain", env("APP_MAIN_SITE"))
                ->where("id", $service->platform_id)
                ->first();

            // Lấy danh sách dịch vụ
            $service_list = ServiceServer::where("domain", getDomain())
                ->where("service_id", $service->id)
                ->get();

            // Xử lý danh sách dịch vụ
            $service_list = $service_list->map(function ($service) use (
                $social
            ) {
                // Lấy thông tin từ ServerAction cho từng service
                $serviceAction = ServerAction::where("domain", getDomain())
                    ->where("server_id", $service->id)
                    ->first();

                // Gán thông tin nền tảng xã hội và xóa các thuộc tính không cần thiết
                $service->social_image = $social->image;
                unset($service->providerName);
                unset($service->providerLink);
                unset($service->providerServer);
                unset($service->providerKey);

                // Gán thông tin từ ServerAction nếu có
                if ($serviceAction) {
                    $service->quantity_status = $serviceAction->quantity_status;
                    $service->comments_status = $serviceAction->comments_status;
                    $service->reaction_status = $serviceAction->reaction_status;
                    $service->get_uid = $serviceAction->get_uid;
                    $service->minutes_status = $serviceAction->minutes_status;
                    $service->reaction_data = $serviceAction->reaction_data;
                    $service->comments_data = $serviceAction->comments_data;
                    $service->minutes_data = $serviceAction->minutes_data;
                    $service->posts_status = $serviceAction->posts_status;
                    $service->posts_data = $serviceAction->posts_data;
                    $service->time_status = $serviceAction->time_status;
                    $service->time_data = $serviceAction->time_data;
                    $service->price_user = $service->levelPrice(
                        Auth::user()->level
                    );
                }

                return $service;
            });

            // Kiểm tra và trả về dữ liệu
            if ($service_list->isNotEmpty()) {
                return resApi("success", "Thành công", $service_list);
            } else {
                return resApi("error", "Không tìm thấy dịch vụ", "false");
            }
        } else {
            return resApi("error", "Không tìm thấy dịch vụ");
        }
    }

    public function serverserviceChecking(Request $request)
    {
        // Validate the request
        $valid = Validator::make($request->all(), [
            "id" => "required",
        ]);

        if ($valid->fails()) {
            return resApi("error", $valid->errors()->first());
        }
        $lam = explode("-", $request->id);
        $lam1 = $lam[1];
        $lam12 = explode("_", $lam1);
        // Retrieve the service based on domain and id
        $services = ServiceServer::where("domain", getDomain())
            ->where("id", $lam12[1])
            ->first();

        if ($services) {
            // Retrieve the server action based on domain and server_id
            $service = ServerAction::where("domain", getDomain())
                ->where("server_id", $services->id)
                ->first();

            if ($service) {
                // Update the services status from the server action
                $services->minutes_status = $service->minutes_status;
                $services->quantity_status = $service->quantity_status;
                $services->reaction_status = $service->reaction_status;
                $services->posts_status = $service->posts_status;
                $services->time_status = $service->time_status;
                $services->duration_status = $service->duration_status;
                $services->comments_status = $service->comments_status;
                $services->price_user = $services->levelPrice(
                    Auth::user()->level
                );
            }

            unset($services->providerName);
            unset($services->price_distributor);
            unset($services->price_agency);
            unset($services->price_collaborator);
            unset($services->price);

            unset($services->price_update);
            unset($services->providerLink);
            unset($services->providerServer);
            unset($services->providerKey); // Xóa thuộc tính providerName

            // Manually set quantity_status to 'on'

            return resApi("success", "Thành công", $services);
        } else {
            return resApi("error", "Không tìm thấy dịch vụ");
        }
    }

    public function updateWebsiteConfig(Request $request)
    {
        $site_config = ConfigSite::where("domain", request()->getHost())
            ->where("status", "active")
            ->first();

        foreach ($request->all() as $key => $value) {
            if ($key != "_token") {
                $site_config->$key = $value;
            }
        }

        $site_config->save();

        return redirect()
            ->back()
            ->with("success", __("Website config updated"));
    }

    public function WebsiteSetting(Request $request)
    {
        $config = Config::first();

        foreach ($request->all() as $key => $value) {
            if ($key != "_token") {
                $config->$key = $value;
            }
        }

        $config->save();

        return redirect()
            ->back()
            ->with("success", __("Cập nhật thành công"));
    }
}
