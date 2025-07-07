<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Smm;
use App\Models\Service;
use App\Models\ServicePlatform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function viewService(Request $request)
    {
        $search = $request->search;
        $platform_code = $request->platform;
        $smm = Smm::where("domain", env("APP_MAIN_SITE"))->get();
        $services = Service::where("domain", env("APP_MAIN_SITE"))
            ->when($search, function ($query, $search) {
                return $query
                    ->where("name", "like", "%" . $search . "%")
                    ->orWhere("status", "like", "%" . $search . "%")
                    ->orWhere("slug", "like", "%" . $search . "%");
            })
            ->when($platform_code, function ($query, $platform_code) {
                return $query->whereHas("platform", function ($query) use (
                    $platform_code
                ) {
                    $query->where("code", $platform_code);
                });
            })
            ->orderBy("id", "desc")
            ->get();

        return view("admin.service.service", compact("services", "smm"));
    }

    public function viewEditService($id)
    {
        $service = Service::where("id", $id)
            ->where("domain", env("APP_MAIN_SITE"))
            ->first();

        if (!$service) {
            return redirect()
                ->back()
                ->with("error", "Dịch vụ không tồn tại");
        }

        return view("admin.service.service-edit", compact("service"));
    }

    public function createService(Request $request)
    {
        $valid = Validator::make($request->all(), [
            "platform_id" => "required|exists:service_platforms,id",
            "name" => "required|string",
            "slug" => "required|string",
            //'image' => 'required|string',
            "note" => "required|string",
            "details" => "required|string",
            //'reaction_status' => 'required|in:on,off',
            //'quantity_status' => 'required|in:on,off',
            //'comments_status' => 'required|in:on,off',
            //'minutes_status' => 'required|in:on,off',
            //'time_status' => 'required|in:on,off',
            //'posts_status' => 'required|in:on,off',
            "status" => "required|in:active,inactive",
        ]);

        if ($valid->fails()) {
            return response()->json(
                [
                    "status" => "error",
                    "errors" => $valid->errors()->all(),
                ],
                422
            );
        } else {
            $slugNew = Str::slug($request->slug, "-");
            $existingService = Service::where("slug", $slugNew)->first();

            if ($existingService) {
                return response()->json(
                    [
                        "status" => "error",
                        "errors" => ["Đường dẫn đã tồn tại."],
                    ],
                    422
                );
            }

            $package = Str::slug($request->slug, "_");

            $code = Str::random(10);
            $order =
                Service::where("domain", env("APP_MAIN_SITE"))->max("order") +
                1;
            $service = new Service();
            $service->platform_id = $request->platform_id;
            $service->name = $request->name;
            $service->slug = $slugNew;
            $service->image =
                $request->image ??
                "https://cdn-icons-png.flaticon.com/128/7214/7214281.png";
            $service->note = $request->note;
            $service->details = $request->details;
            $service->blogs = $request->blogs;
            $service->status = $request->status;
            $service->package = $package;
            $service->code = $code;
            $service->order = $order;
            $service->reaction_status = $request->reaction_status ?? "off";
            $service->quantity_status = $request->quantity_status ?? "off";
            $service->comments_status = $request->comments_status ?? "off";
            $service->minutes_status = $request->minutes_status ?? "off";
            $service->time_status = $request->time_status ?? "off";
            $service->posts_status = $request->posts_status ?? "off";
            $service->domain = env("APP_MAIN_SITE");
            $service->save();

            return response()->json([
                "status" => "success",
                "message" => "Dịch vụ đã được tạo thành công.",
            ]);
        }
    }

    public function updateService(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            "platform_id" => "required|exists:service_platforms,id",
            "package" => "required|string", // add 'package' => 'required|string
            "name" => "required|string",
            "slug" => "required|string",
            "image" => "required|string",
            "details" => "required|string",
            "reaction_status" => "required|in:on,off",
            "quantity_status" => "required|in:on,off",
            "comments_status" => "required|in:on,off",
            "minutes_status" => "required|in:on,off",
            "time_status" => "required|in:on,off",
            "posts_status" => "required|in:on,off",
            "status" => "required|in:active,inactive",
        ]);

        if ($valid->fails()) {
            return redirect()
                ->back()
                ->with("error", $valid->errors()->first())
                ->withInput();
        } else {
            $slugNew = Str::slug($request->slug, "-");
            $package = Str::slug($request->package, "_");

            $checkSlug = Service::where("slug", $slugNew)
                ->where("id", "!=", $id)
                ->where("domain", env("APP_MAIN_SITE"))
                ->first();

            if ($checkSlug) {
                return redirect()
                    ->back()
                    ->with("error", "Đường dẫn đã tồn tại")
                    ->withInput();
            } else {
                $service = Service::where("id", $id)
                    ->where("domain", env("APP_MAIN_SITE"))
                    ->first();

                if ($service) {
                    $service->platform_id = $request->platform_id;
                    $service->name = $request->name;
                    $service->slug = $slugNew;
                    $service->image = $request->image;
                    $service->note = $request->note;
                    $service->details = $request->details;
                    $service->blogs = $request->blogs;
                    $service->status = $request->status;
                    $service->reaction_status = $request->reaction_status;
                    $service->quantity_status = $request->quantity_status;
                    $service->comments_status = $request->comments_status;
                    $service->minutes_status = $request->minutes_status;
                    $service->time_status = $request->time_status;
                    $service->posts_status = $request->posts_status;
                    $service->package = $package;
                    $service->save();

                    return redirect()
                        ->back()
                        ->with("success", "Cập nhật dịch vụ thành công");
                } else {
                    return redirect()
                        ->back()
                        ->with("error", "Dịch vụ không tồn tại");
                }
            }
        }
    }
    public function deleteService($id)
    {
        $service = Service::find($id);
        if ($service) {
            $service->delete();
            return redirect()
                ->back()
                ->with("success", "Xoá thành công dịch vụ: " . $service->name);
        } else {
            return redirect()
                ->back()
                ->with("error", "Không tìm thấy dịch vụ!");
        }
    }
}
