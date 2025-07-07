<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServerAction;
use App\Models\Service;
use App\Models\Smm;
use App\Models\User;
use App\Models\PartnerWebsite;
use App\Models\ServiceServer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ServiceServerController extends Controller
{
    public function viewServer(Request $request)
    {
        if ($request->getHost() === env("APP_MAIN_SITE")) {
            $search = $request->search;
            $service = $request->service;
            $visibility = $request->visibility;
            $status = $request->status;
            $soluong = $request->soluong;
            $smm = Smm::where("domain", env("APP_MAIN_SITE"))->get();
            $servers = ServiceServer::where("domain", request()->getHost())
                ->when($search, function ($query, $search) {
                    return $query
                        ->where("name", "like", "%" . $search . "%")
                        ->orWhere("id", "like", "%" . $search . "%");
                })
                ->when($service, function ($query, $service) {
                    return $query->whereHas("service", function ($query) use (
                        $service
                    ) {
                        $query->where("id", $service);
                    });
                })
                ->when($visibility, function ($query, $visibility) {
                    return $query->where("visibility", $visibility);
                })
                ->when($status, function ($query, $status) {
                    return $query->where("status", $status);
                })
                ->orderBy("id", "DESC")
                //->paginate($soluong);
                ->get();

            return view("admin.service.server", compact("servers", "smm"));
        } else {
            $search = $request->search;
            $service = $request->service;
            $visibility = $request->visibility;
            $status = $request->status;
            $partner = PartnerWebsite::where("name", getDomain())->first();
            $usernss = User::where("id", $partner->user_id)->first();
            $servers = ServiceServer::where("domain", $partner->domain)->get();

            foreach ($servers as $server) {
                $serverExist = ServiceServer::where(
                    "package_id",
                    $server->package_id
                )
                    ->where("service_id", $server->service_id)
                    ->where("domain", request()->getHost())
                    ->first();

                $priceCurrent = $server->levelPrice($usernss->level);
                $priceMember = $priceCurrent + ($priceCurrent * 5) / 100;
                $priceCollaborator = $priceCurrent + ($priceCurrent * 4) / 100;
                $priceAgency = $priceCurrent + ($priceCurrent * 3) / 100;
                $priceDistributor = $priceCurrent + ($priceCurrent * 2) / 100;
                if (!$serverExist) {
                    // giá đối tác thành viên cộng tác viên đại lý nhà phân phối sẽ được nhân với giá %
                    // thành viên sẽ nhâm với 1.5 %
                    // cộng tác viên sẽ nhân với 1.3 %
                    // đại lý sẽ nhân với 1 %
                    // nhà phân phối sẽ nhân với 0.8 %
                    // giá sẽ được cập nhật theo giá của dịch vụ

                    $new = new ServiceServer();
                    $new->service_id = $server->service_id;
                    $new->name = $server->name;
                    $new->details = $server->details;
                    $new->package_id = $server->package_id;
                    $new->percents = $server->percents;
                    $new->price = $server->levelPrice($usernss->level);
                    $new->price_update = $server->levelPrice($usernss->level);
                    $new->price_member = $priceMember;
                    $new->price_collaborator = $priceCollaborator;
                    $new->price_agency = $priceAgency;
                    $new->price_distributor = $priceDistributor;
                    $new->min = $server->min;
                    $new->max = $server->max;
                    $new->limit_day = $server->limit_day;
                    $new->status = $server->status;
                    $new->visibility = $server->visibility;
                    $new->domain = request()->getHost();
                    $new->updated_at = $server->updated_at;
                    $new->save();

                    // action
                    $action = $server->action;
                    $ac = new ServerAction();
                    $ac->server_id = $new->id;
                    $ac->get_uid = $action->get_uid;
                    $ac->auto_price = $action->auto_price;
                    $ac->quantity_status = $action->quantity_status;
                    $ac->reaction_status = $action->reaction_status;
                    $ac->reaction_data = $action->reaction_data;
                    $ac->comments_status = $action->comments_status;
                    $ac->comments_data = $action->comments_data;
                    $ac->minutes_status = $action->minutes_status;
                    $ac->minutes_data = $action->minutes_data;
                    $ac->time_status = $action->time_status;
                    $ac->time_data = $action->time_data;
                    $ac->posts_status = $action->posts_status;
                    $ac->posts_data = $action->posts_data;
                    $ac->refund_status = $action->refund_status;
                    $ac->warranty_status = $action->warranty_status;
                    $ac->domain = request()->getHost();
                    $ac->save();
                } else {
                    if ($server->updated_at > $serverExist->updated_at) {
                        $serverExist->name = $server->name;
                        $serverExist->details = $server->details;
                        $serverExist->package_id = $server->package_id;
                        $serverExist->price = $server->levelPrice(
                            $usernss->level
                        );
                        $serverExist->min = $server->min;
                        $serverExist->max = $server->max;
                        $serverExist->limit_day = $server->limit_day;
                        $serverExist->status = $server->status;
                        $serverExist->visibility = $server->visibility;
                        $serverExist->updated_at = $server->updated_at;
                        $serverExist->save();

                        // action
                        $action = $server->action;
                        $ac = $serverExist->action;
                        $ac->get_uid = $action->get_uid;
                        $ac->auto_price = $action->auto_price;
                        $ac->quantity_status = $action->quantity_status;
                        $ac->reaction_status = $action->reaction_status;
                        $ac->reaction_data = $action->reaction_data;
                        $ac->comments_status = $action->comments_status;
                        $ac->comments_data = $action->comments_data;
                        $ac->minutes_status = $action->minutes_status;
                        $ac->minutes_data = $action->minutes_data;
                        $ac->time_status = $action->time_status;
                        $ac->time_data = $action->time_data;
                        $ac->posts_status = $action->posts_status;
                        $ac->posts_data = $action->posts_data;
                        $ac->refund_status = $action->refund_status;
                        $ac->warranty_status = $action->warranty_status;
                        $ac->domain = request()->getHost();
                        $ac->save();
                    } else {
                    }
                }
            }

            $servers = ServiceServer::where("domain", request()->getHost())
                ->when($search, function ($query, $search) {
                    return $query
                        ->where("name", "like", "%" . $search . "%")
                        ->orWhere("slug", "like", "%" . $search . "%");
                })
                ->when($service, function ($query, $service) {
                    return $query->whereHas("service", function ($query) use (
                        $service
                    ) {
                        $query->where("id", $service);
                    });
                })
                ->when($visibility, function ($query, $visibility) {
                    return $query->where("visibility", $visibility);
                })
                ->when($status, function ($query, $status) {
                    return $query->where("status", $status);
                })
                ->orderBy("id", "DESC")
                ->get();

            return view("admin.service.partner.server", compact("servers"));
        }
    }

    public function smmChecking(Request $request)
    {
        $valid = Validator::make($request->all(), [
            "name" => "required",
        ]);

        if ($valid->fails()) {
            return resApi("error", $valid->errors()->first());
        } else {
            $smm = Smm::where("name", $request->name)->first();
            if ($smm) {
                $path = $smm->name;
                $post = [
                    "key" => $smm->token,
                    "action" => "services",
                ];

                $services = curl_smm($path, $post);

                //  var_dump($request->name);
                if (is_array($services) || empty($services["error"])) {
                    $categories = [];

                    foreach ($services as $service) {
                        $categories[$service["category"]] = true;
                    }

                    $uniqueCategories = array_keys($categories);
                    return resApi("success", "Thành công", $uniqueCategories);
                }
            } else {
                return resApi("error", "Không tìm thấy dịch vụ");
            }
        }
    }

    public function smmserviceeeChecking(Request $request)
    {
        $valid = Validator::make($request->all(), [
            "name" => "required",
        ]);

        if ($valid->fails()) {
            return resApi("error", $valid->errors()->first());
        } else {
            $lam = explode("_", $request->name);

            $smm = Smm::where("name", $lam[0])->first();
            if ($smm) {
                $path = $smm->name;
                $post1 = [
                    "key" => $smm->token,
                    "action" => "balance",
                ];

                $balance = curl_smm($path, $post1);
                $post = [
                    "key" => $smm->token,
                    "action" => "services",
                ];
                if ($balance["currency"] == "VND") {
                    $money = "VND";
                } else {
                    $money = "USD";
                }

                $services = curl_smm($path, $post);
                if (is_array($services) || empty($services["error"])) {
                    $service_2_data = [];

                    foreach ($services as $service) {
                        if ($service["category"] == $lam[1]) {
                            $service["money"] = $money;
                            $service_2_data[] = $service; // Sử dụng [] để thêm phần tử vào mảng
                        }
                    }

                    return resApi("success", "Thành công", $service_2_data);
                }
            } else {
                return resApi("error", "Không tìm thấy dịch vụ");
            }
        }
    }

    public function smmserviceChecking(Request $request)
    {
        $valid = Validator::make($request->all(), [
            "name" => "required",
        ]);

        if ($valid->fails()) {
            return resApi("error", $valid->errors()->first());
        } else {
            $lam = explode("_", $request->name);

            $smm = Smm::where("name", $lam[0])->first();
            if ($smm) {
                $path = $smm->name;
                $post1 = [
                    "key" => $smm->token,
                    "action" => "balance",
                ];

                $balance = curl_smm($path, $post1);
                $post = [
                    "key" => $smm->token,
                    "action" => "services",
                ];
                if ($balance["currency"] == "VND") {
                    $money = "VND";
                    $services = curl_smm($path, $post);
                    if (is_array($services) || empty($services["error"])) {
                        $service_2_data = null;

                        foreach ($services as $service) {
                            if ($service["service"] == $lam[1]) {
                                $service["money"] = $money;
                                $service["rate"] = $service["rate"] * 1000;
                                $service_2_data = $service;
                                break;
                            }
                        }
                        return resApi("success", "Thành công", $service_2_data);
                    }
                } else {
                    $money = "USD";
                    $services = curl_smm($path, $post);
                    if (is_array($services) || empty($services["error"])) {
                        $service_2_data = null;

                        foreach ($services as $service) {
                            if ($service["service"] == $lam[1]) {
                                $service["money"] = $money;
                                $service_2_data = $service;
                                break;
                            }
                        }
                        return resApi("success", "Thành công", $service_2_data);
                    }
                }
            } else {
                return resApi("error", "Không tìm thấy dịch vụ");
            }
        }
    }

    public function viewServerSmm(Request $request)
    {
        $search = $request->search;
        $service = $request->service;
        $visibility = $request->visibility;
        $status = $request->status;
        $soluong = $request->soluong;
        $smm = Smm::where("domain", env("APP_MAIN_SITE"))->get();
        $servers = ServiceServer::where("domain", request()->getHost())
            ->when($search, function ($query, $search) {
                return $query
                    ->where("name", "like", "%" . $search . "%")
                    ->orWhere("id", "like", "%" . $search . "%");
            })
            ->when($service, function ($query, $service) {
                return $query->whereHas("service", function ($query) use (
                    $service
                ) {
                    $query->where("id", $service);
                });
            })
            ->when($visibility, function ($query, $visibility) {
                return $query->where("visibility", $visibility);
            })
            ->when($status, function ($query, $status) {
                return $query->where("status", $status);
            })
            ->orderBy("id", "DESC")
            ->paginate($soluong);

        return view("admin.service.server-smm", compact("servers", "smm"));
    }

    public function viewEditServer($id)
    {
        if (request()->getHost() === env("APP_MAIN_SITE")) {
            $server = ServiceServer::where("id", $id)
                ->where("domain", request()->getHost())
                ->first();
            if (!$server) {
                return redirect()
                    ->back()
                    ->with("error", "Máy chủ này không tồn tại");
            }
            $smm = Smm::where("domain", env("APP_MAIN_SITE"))->get();
            return view("admin.service.server-edit", compact("server", "smm"));
        } else {
            $server = ServiceServer::where("id", $id)
                ->where("domain", request()->getHost())
                ->first();
            if (!$server) {
                return redirect()
                    ->back()
                    ->with("error", "Máy chủ này không tồn tại");
            }
            $smm = Smm::where("domain", env("APP_MAIN_SITE"))->get();
            return view(
                "admin.service.partner.server-edit",
                compact("server", "smm")
            );
        }
    }

    public function updatePrice(Request $request)
    {
        $valid = Validator::make($request->all(), [
            "price" => "required|numeric",
            "type" => "required|in:default,update",
            "action" => "required|in:default,percent",
        ]);

        if ($valid->fails()) {
            return redirect()
                ->back()
                ->with("error", $valid->errors()->first());
        } else {
            $servers = ServiceServer::where(
                "domain",
                request()->getHost()
            )->get();
            foreach ($servers as $server) {
                if ($request->type == "default") {
                    if ($request->action == "default") {
                        // các giá cấp bậc sẽ được cập nhật theo giá mặc định
                        $priceMember = $request->price + $server->price_member;
                        $priceCollaborator =
                            $request->price + $server->price_collaborator;
                        $priceAgency = $request->price + $server->price_agency;
                        $priceDistributor =
                            $request->price + $server->price_distributor;
                        $server->update([
                            "price_update" => $server->price,
                            "price_member" => $priceMember,
                            "price_collaborator" => $priceCollaborator,
                            "price_agency" => $priceAgency,
                            "price_distributor" => $priceDistributor,
                        ]);
                    }
                    if ($request->action == "percent") {
                        $priceMember =
                            $server->price +
                            ($server->price * siteValue("price")) / 100;
                        $priceCollaborator =
                            $server->price +
                            ($server->price * siteValue("price_collaborator")) /
                                100;
                        $priceAgency =
                            $server->price +
                            ($server->price * siteValue("price_agency")) / 100;
                        $priceDistributor =
                            $server->price +
                            ($server->price * siteValue("price_distributor")) /
                                100;
                        $server->update([
                            "price_update" => $server->price,
                            "price_member" => $priceMember,
                            "price_collaborator" => $priceCollaborator,
                            "price_agency" => $priceAgency,
                            "price_distributor" => $priceDistributor,
                        ]);
                    }
                } else {
                    if ($server->price !== $server->price_update) {
                        if ($request->action == "default") {
                            // các giá cấp bậc sẽ được cập nhật theo giá mặc định
                            $priceMember =
                                $request->price + $server->price_member;
                            $priceCollaborator =
                                $request->price + $server->price_collaborator;
                            $priceAgency =
                                $request->price + $server->price_agency;
                            $priceDistributor =
                                $request->price + $server->price_distributor;
                            $server->update([
                                "price_member" => $priceMember,
                                "price_collaborator" => $priceCollaborator,
                                "price_agency" => $priceAgency,
                                "price_distributor" => $priceDistributor,
                            ]);
                        }
                        if ($request->action == "percent") {
                            $priceMember =
                                $server->price +
                                ($server->price * siteValue("price")) / 100;
                            $priceCollaborator =
                                $server->price +
                                ($server->price *
                                    siteValue("price_collaborator")) /
                                    100;
                            $priceAgency =
                                $server->price +
                                ($server->price * siteValue("price_agency")) /
                                    100;
                            $priceDistributor =
                                $server->price +
                                ($server->price *
                                    siteValue("price_distributor")) /
                                    100;
                            $server->update([
                                "price_member" => $priceMember,
                                "price_collaborator" => $priceCollaborator,
                                "price_agency" => $priceAgency,
                                "price_distributor" => $priceDistributor,
                            ]);
                        }
                    }
                }
            }
            return redirect()
                ->back()
                ->with("success", "Cập nhật giá thành công");
        }
    }

    public function createServer(Request $request)
    {
        $valid = Validator::make($request->all(), [
            "service" => "required|integer",
            "name" => "required|string",
            "details" => "required|string",
            //"package_id" => "required|integer",
            "get_uid" => "required|in:on,off",
            "limit_day" => "required|integer",
            "min" => "required|integer|min:1",
            "max" => "required|integer|min:1",
            "percents" => "required|numeric",
            "price_member" => "required|numeric|min:0",
            "price_collaborator" => "required|numeric|min:0",
            "price_agency" => "required|numeric|min:0",
            "price_distributor" => "required|numeric|min:0",
            "providerName" => "required|string",
            "providerLink" => "required|string",
            "providerServer" => "required|string",
            "providerKey" => "required|string",
            "refund_status" => "required|in:on,off",
            "warranty_status" => "required|in:on,off",
            "renews_status" => "required|in:on,off",
            "status" => "required|in:active,inactive",
            "visibility" => "required|in:public,private",
            "reaction_status" => "required|in:on,off",
            "quantity_status" => "required|in:on,off",
            "comments_status" => "required|in:on,off",
            "minutes_status" => "required|in:on,off",
            "time_status" => "required|in:on,off",
            "posts_status" => "required|in:on,off",
        ]);

        if ($valid->fails()) {
            return redirect()
                ->back()
                ->with("error", $valid->errors()->first())
                ->withInput();
        } else {
            $service = Service::where("id", $request->service)
                ->where("domain", env("APP_MAIN_SITE"))
                ->first();

            if (!$service) {
                return redirect()
                    ->back()
                    ->with("error", "Dịch vụ này không tồn tại")
                    ->withInput();
            }

            $packageId = ServiceServer::value('id'); 

            $server = ServiceServer::where("package_id", $request->package_id)
                ->where("service_id", $request->service)
                ->where("domain", request()->getHost())
                ->first();

            if ($server) {
                return redirect()
                    ->back()
                    ->with("error", "Máy chủ này đã tồn tại")
                    ->withInput();
            }

            $server = $service->servers()->create([
                "name" => $request->name,
                "details" => $request->details,
                "package_id" => $packageId,
                "limit_day" => $request->limit_day,
                "min" => $request->min,
                "percents" => $request->percents,
                "max" => $request->max,
                "price_update" => $request->price_update ?? 0,
                "price_member" => $request->price_member,
                "price_collaborator" => $request->price_collaborator,
                "price_agency" => $request->price_agency,
                "price_distributor" => $request->price_distributor,
                "providerName" => $request->providerName,
                "providerLink" => $request->providerLink,
                "providerServer" => $request->providerServer,
                "providerKey" => $request->providerKey,
                "status" => $request->status,
                "visibility" => $request->visibility,
                "domain" => request()->getHost(),
            ]);
            if (
                $request->reaction_data == "ALL" ||
                $request->reaction_data == "all"
            ) {
                $reac = "LIKE,HAHA,SAD,LOVE,WOW,CARE,ANGRY";
            } else {
                $reac = $request->reaction_data;
            }
            $server->actions()->create([
                "get_uid" => $request->get_uid,
                "auto_price" => $request->auto_price,
                "quantity_status" => $request->quantity_status,
                "reaction_status" => $request->reaction_status,
                "reaction_data" => $reac,
                "comments_status" => $request->comments_status,
                "comments_data" => $request->comments_data,
                "minutes_status" => $request->minutes_status,
                "minutes_data" => $request->minutes_data,
                "domain" => request()->getHost(),
                "time_status" => $request->time_status,
                "time_data" => $request->time_data,
                "posts_status" => $request->posts_status,
                "posts_data" => $request->posts_data,
                "refund_status" => $request->refund_status,
                "warranty_status" => $request->warranty_status,
                "renews_status" => $request->renews_status,
            ]);

            return redirect()
                ->back()
                ->with("success", "Tạo máy chủ thành công");
        }
    }

    public function createServerV2(Request $request)
    {
        $service = Service::where("id", $request->service)
            ->where("domain", env("APP_MAIN_SITE"))
            ->first();

        if (!$service) {
            return response()->json(
                [
                    "status" => "error",
                    "message" => "Dịch vụ này không tồn tại",
                ],
                404
            );
        }

        $providerServers = explode(" ", $request->providerServer);

        foreach ($providerServers as $serverData) {
            $server = $service->servers()->create([
                "name" => $request->name ?? "null",
                "details" => $request->details ?? "- No data -",
                "limit_day" => $request->limit_day ?? 0,
                "min" => $request->min ?? 100,
                "percents" => $request->percents ?? 100,
                "max" => $request->max ?? 100000000,
                "price_update" => $request->price_update ?? 0,
                "price_member" => $request->price_member ?? 100,
                "price_collaborator" => $request->price_collaborator ?? 100,
                "price_agency" => $request->price_agency ?? 100,
                "price_distributor" => $request->price_distributor ?? 100,
                "providerName" => $request->providerName,
                "providerLink" => $request->providerLink ?? "null",
                "providerServer" => $serverData,
                "providerKey" => $request->providerKey ?? "null",
                "status" => $request->status ?? "inactive",
                "visibility" => $request->visibility ?? "public",
                "domain" => request()->getHost(),
            ]);

            $server->update(["package_id" => $server->id]);

            if (
                $request->reaction_data == "ALL" ||
                $request->reaction_data == "all"
            ) {
                $reac = "LIKE,HAHA,SAD,LOVE,WOW,CARE,ANGRY";
            } else {
                $reac = $request->reaction_data;
            }

            $server->actions()->create([
                "get_uid" => $request->get_uid ?? "off",
                "auto_price" => $request->auto_price ?? "on",
                "quantity_status" => $request->quantity_status ?? "on",
                "reaction_status" => $request->reaction_status ?? "off",
                "reaction_data" => $reac ?? "ALL",
                "comments_status" => $request->comments_status ?? "off",
                "comments_data" => $request->comments_data ?? "",
                "minutes_status" => $request->minutes_status ?? "off",
                "minutes_data" => $request->minutes_data ?? "",
                "domain" => request()->getHost(),
                "time_status" => $request->time_status ?? "off",
                "time_data" => $request->time_data ?? "",
                "posts_status" => $request->posts_status ?? "off",
                "posts_data" => $request->posts_data ?? "",
                "refund_status" => $request->refund_status ?? "on",
                "warranty_status" => $request->warranty_status ?? "on",
                "renews_status" => $request->renews_status ?? "on",
            ]);
        }

        return response()->json([
            "status" => "success",
            "message" => "Tạo máy chủ thành công",
        ]);
    }

    public function updateServer(Request $request, $id)
    {
        if (request()->getHost() === env("APP_MAIN_SITE")) {
            $valid = Validator::make($request->all(), [
                "service" => "required|integer",
                "name" => "required|string",
                "details" => "required|string",
                "package_id" => "required|integer",
                "get_uid" => "required|in:on,off",
                "percents" => "required|numeric",
                "limit_day" => "required|integer",
                "min" => "required|integer|min:1",
                "max" => "required|integer|min:1",
                "price_member" => "required|numeric|min:0",
                "price_collaborator" => "required|numeric|min:0",
                "price_agency" => "required|numeric|min:0",
                "price_distributor" => "required|numeric|min:0",

                "providerLink" => "required|string",
                "providerServer" => "required|string",
                "providerKey" => "required|string",
                "refund_status" => "required|in:on,off",
                "warranty_status" => "required|in:on,off",
                "renews_status" => "required|in:on,off",
                "status" => "required|in:active,inactive",
                "visibility" => "required|in:public,private",
                "reaction_status" => "required|in:on,off",
                "quantity_status" => "required|in:on,off",
                "comments_status" => "required|in:on,off",
                "minutes_status" => "required|in:on,off",
                "time_status" => "required|in:on,off",
                "posts_status" => "required|in:on,off",
            ]);

            if ($valid->fails()) {
                return redirect()
                    ->back()
                    ->with("error", $valid->errors()->first())
                    ->withInput();
            } else {
                $server = ServiceServer::where("id", $id)
                    ->where("domain", request()->getHost())
                    ->first();
                if (!$server) {
                    return redirect()
                        ->back()
                        ->with("error", "Máy chủ này không tồn tại")
                        ->withInput();
                }

                $packageIdCheck = ServiceServer::where(
                    "package_id",
                    "!=",
                    $server->package_id
                )
                    ->where("package_id", $request->package_id)
                    ->where("service_id", $request->service)
                    ->where("domain", request()->getHost())
                    ->first();
                if ($packageIdCheck) {
                    return redirect()
                        ->back()
                        ->with("error", "Máy chủ này đã tồn tại")
                        ->withInput();
                }

                $service = Service::where("id", $request->service)
                    ->where("domain", env("APP_MAIN_SITE"))
                    ->first();

                if (!$service) {
                    return redirect()
                        ->back()
                        ->with("error", "Dịch vụ này không tồn tại")
                        ->withInput();
                }

                $server->update([
                    "price_member" => $request->price_member,
                    "price_collaborator" => $request->price_collaborator,
                    "price_agency" => $request->price_agency,
                    "price_distributor" => $request->price_distributor,
                ]);

                $pertner = PartnerWebsite::where(
                    "domain",
                    env("APP_MAIN_SITE")
                )->get();

                foreach ($pertner as $sitecon) {
                    $usernss = User::where("id", $sitecon->user_id)->first();
                    $priceCurrent = $server->levelPrice($usernss->level);
                    $priceMember = $priceCurrent + ($priceCurrent * 10) / 100;
                    $priceCollaborator =
                        $priceCurrent + ($priceCurrent * 9) / 100;
                    $priceAgency = $priceCurrent + ($priceCurrent * 8) / 100;
                    $priceDistributor =
                        $priceCurrent + ($priceCurrent * 7) / 100;

                    $server_con = ServiceServer::where(
                        "package_id",
                        $server->package_id
                    )
                        ->where("service_id", $server->service_id)
                        ->where("domain", $sitecon->name)
                        ->first();
                    if ($server_con) {
                        $server_con->update([
                            "name" => $request->name,
                            "package_id" => $request->package_id,
                            "details" => $request->details,
                            "limit_day" => $request->limit_day,
                            "percents" => $request->percents,
                            "min" => $request->min,
                            "max" => $request->max,
                            "status" => $request->status,
                            "visibility" => $request->visibility,
                            "price_member" => $priceMember,
                            "price_collaborator" => $priceCollaborator,
                            "price_agency" => $priceAgency,
                            "price_distributor" => $priceDistributor,
                            "price" => $server->levelPrice($usernss->level),
                            "price_update" => $server->levelPrice(
                                $usernss->level
                            ),
                            "status" => $request->status,
                            "visibility" => $request->visibility,
                        ]);
                    }
                }
                $server->update([
                    "name" => $request->name,
                    "details" => $request->details,
                    "package_id" => $request->package_id,
                    "limit_day" => $request->limit_day,
                    "percents" => $request->percents,
                    "min" => $request->min,
                    "max" => $request->max,

                    "providerName" => $request->providerName,
                    "providerLink" => $request->providerLink,
                    "providerServer" => $request->providerServer,
                    "providerKey" => $request->providerKey,
                    "status" => $request->status,
                    "visibility" => $request->visibility,
                ]);
                if (
                    $request->reaction_data == "ALL" ||
                    $request->reaction_data == "all"
                ) {
                    $reac = "LIKE,HAHA,SAD,LOVE,WOW,CARE,ANGRY";
                } else {
                    $reac = $request->reaction_data;
                }
                $server->actions()->update([
                    "get_uid" => $request->get_uid,
                    "auto_price" => $request->auto_price,
                    "quantity_status" => $request->quantity_status,
                    "reaction_status" => $request->reaction_status,
                    "reaction_data" => $reac,
                    "comments_status" => $request->comments_status,
                    "comments_data" => $request->comments_data,
                    "minutes_status" => $request->minutes_status,
                    "minutes_data" => $request->minutes_data,
                    "time_status" => $request->time_status,
                    "time_data" => $request->time_data,
                    "posts_status" => $request->posts_status,
                    "posts_data" => $request->posts_data,
                    "refund_status" => $request->refund_status,
                    "warranty_status" => $request->warranty_status,
                    "renews_status" => $request->renews_status,
                ]);
                return redirect()
                    ->back()
                    ->with("success", "Cập nhật máy chủ thành công");
            }
        } else {
            $valid = Validator::make($request->all(), [
                "name" => "required|string",
                "details" => "required|string",
                "price_member" => "required|numeric|min:0",
                "price_collaborator" => "required|numeric|min:0",
                "price_agency" => "required|numeric|min:0",
                "price_distributor" => "required|numeric|min:0",
                "status" => "required|in:active,inactive",
            ]);

            if ($valid->fails()) {
                return redirect()
                    ->back()
                    ->with("error", $valid->errors()->first())
                    ->withInput();
            } else {
                $server = ServiceServer::where("id", $id)
                    ->where("domain", request()->getHost())
                    ->first();
                if (!$server) {
                    return redirect()
                        ->back()
                        ->with("error", "Máy chủ này không tồn tại")
                        ->withInput();
                }

                $service = Service::where("id", $server->service_id)
                    ->where("domain", env("APP_MAIN_SITE"))
                    ->first();

                if (!$service) {
                    return redirect()
                        ->back()
                        ->with("error", "Dịch vụ này không tồn tại")
                        ->withInput();
                }

                $server->update([
                    "name" => $request->name,
                    "details" => $request->details,
                    "price_member" => $request->price_member,
                    "price_collaborator" => $request->price_collaborator,
                    "price_agency" => $request->price_agency,
                    "price_distributor" => $request->price_distributor,
                    "status" => $request->status,
                    "visibility" => $request->visibility,
                ]);

                $pertner = PartnerWebsite::where(
                    "domain",
                    request()->getHost()
                )->get();

                foreach ($pertner as $sitecon) {
                    $usernss = User::where("id", $sitecon->user_id)->first();
                    $priceCurrent = $server->levelPrice($usernss->level);
                    $priceMember = $priceCurrent + ($priceCurrent * 10) / 100;
                    $priceCollaborator =
                        $priceCurrent + ($priceCurrent * 9) / 100;
                    $priceAgency = $priceCurrent + ($priceCurrent * 8) / 100;
                    $priceDistributor =
                        $priceCurrent + ($priceCurrent * 7) / 100;

                    $server_con = ServiceServer::where(
                        "package_id",
                        $server->package_id
                    )
                        ->where("service_id", $server->service_id)
                        ->where("domain", $sitecon->name)
                        ->first();
                    if ($server_con) {
                        $server_con->update([
                            "name" => $request->name,
                            "details" => $request->details,
                            "limit_day" => $request->limit_day,
                            "percents" => $request->percents,
                            "min" => $request->min,
                            "max" => $request->max,
                            "status" => $request->status,
                            "visibility" => $request->visibility,
                            "price_member" => $priceMember,
                            "price_collaborator" => $priceCollaborator,
                            "price_agency" => $priceAgency,
                            "price_distributor" => $priceDistributor,
                            "price" => $server->levelPrice($usernss->level),
                            "price_update" => $server->levelPrice(
                                $usernss->level
                            ),
                        ]);
                    }
                }
                return redirect()
                    ->back()
                    ->with("success", "Cập nhật máy chủ thành công");
            }
        }
    }
    public function deleteServer($id)
    {
        $server = ServiceServer::where("id", $id)
            ->where("domain", request()->getHost())
            ->first();
        if (!$server) {
            return redirect()
                ->back()
                ->with("error", "Máy chủ này không tồn tại");
        }
        $pertner = PartnerWebsite::where("domain", request()->getHost())->get();
        $server->actions()->delete();
        $server->delete();
        foreach ($pertner as $sitrocn) {
            $server_con = ServiceServer::where(
                "package_id",
                $server->package_id
            )
                ->where("service_id", $server->service_id)
                ->where("domain", $sitrocn->name)
                ->first();
            if ($server_con) {
                $server_con->actions()->delete();
                $server_con->delete();
            }
        }
        return redirect()
            ->back()
            ->with("success", "Xóa máy chủ thành công");
    }

    public function deleteServerChecked(Request $request)
    {
        $ids = explode(" ", $request->input("checked_server"));
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $server = ServiceServer::where("id", $id)
                    ->where("domain", request()->getHost())
                    ->first();

                if ($server) {
                    $server->actions()->delete();
                    $server->delete();
                }
            }
            return redirect()
                ->back()
                ->with("success", "Xóa máy chủ thành công");
        } else {
            return redirect()
                ->back()
                ->with("error", "Không có ID nào để xóa");
        }
    }

    public function clearPrice()
    {
        $servers = ServiceServer::where("domain", env("APP_MAIN_SITE"))->get();
        foreach ($servers as $server) {
            $server->price_update = null;
            $server->save();
        }
        return redirect()
            ->back()
            ->with(
                "success",
                "Xóa giá cũ thành công, vui lòng đòng bộ để cập nhật giá mới"
            );
    }

    public function serverDeleteAll()
    {
        $server = ServiceServer::where("domain", getDomain())->get();
        foreach ($server as $item) {
            $item->actions()->delete();
            $item->delete();
        }
        return redirect()
            ->back()
            ->with("success", "Xóa máy chủ thành công");
    }
}
