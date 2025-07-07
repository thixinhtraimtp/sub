<?php

namespace App\Http\Controllers\CronJob;

use App\Http\Controllers\Api\Service\BoosterviewsController;
use App\Http\Controllers\Api\Service\CheoTuongTacController;
use App\Http\Controllers\Api\Service\TuongTacSaleController;
use App\Http\Controllers\Controller;
use App\Models\ServerAction;
use App\Models\ServiceServer;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Smm;
use App\Models\Order;
use App\Library\TelegramSdk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class PriceController extends Controller
{
    public function checkPriceService()
    {
        $smms = Smm::whereNotNull('token')->get();
        foreach ($smms as $smm) {
            $namesite = $smm['name'];
            $token = $smm['token'];
            $servers = ServiceServer::where('domain', env('APP_MAIN_SITE'))
                ->where('providerName', $namesite)
                ->get();
            if ($servers->isEmpty()) {
                continue;
            }
            $path = $namesite;
            $post = [
                'key' => $token,
                'action' => 'services',
            ];
            $services = curl_smm($path, $post);

            if (!is_array($services) || !empty($services['error'])) {
                continue;
            }
            $activeServiceIds = collect($services)
                ->pluck('service')
                ->toArray();

            foreach ($servers as $server) {
                if ($server->status !== 'inactive') {
                    if (in_array($server->providerServer, $activeServiceIds)) {
                        $server->status = 'active';
                    } else {
                        $server->status = 'inactive';
                    }
                    $server->save();
                }
            }

            foreach ($services as $service) {
                $service_id = $service['service'];
                $rate = $service['rate'];
                $name = $service['name'];
                $min = $service['min'];
                $max = $service['max'];
                $price = ($service['rate'] * $smm['tigia']) / 1000;
                foreach ($servers as $server) {
                    if ($server->providerServer == $service_id) {
                        if ($server->name == 'null') {
                            $server->name = $name;
                            $server->status = 'active';
                        }
                        $server->min = $min;
                        $server->max = $max;
                        $server->save();

                        if ($server->action->auto_price == 'on') {
                            if ($server->price_update != $price) {
                                $price_member1 = round($price + ($price * siteValue('price')) / 100, 2);
                                if ($price_member1 <= 0) {
                                    $price_member = round($price + ($price * siteValue('price')) / 100, 6);
                                } else {
                                    $price_member2 = round($price + ($price * siteValue('price')) / 100, 1);
                                    if ($price_member2 <= 0) {
                                        $price_member = round($price + ($price * siteValue('price')) / 100, 3);
                                    } else {
                                        $price_member = round($price + ($price * siteValue('price')) / 100, 1);
                                    }
                                }
                                $price_collaborator1 = round($price + ($price * siteValue('price_collaborator')) / 100, 2);
                                if ($price_collaborator1 <= 0) {
                                    $price_collaborator = round($price + ($price * siteValue('price_collaborator')) / 100, 6);
                                } else {
                                    $price_collaborator2 = round($price + ($price * siteValue('price_collaborator')) / 100, 1);
                                    if ($price_collaborator2 <= 0) {
                                        $price_collaborator = round($price + ($price * siteValue('price_collaborator')) / 100, 3);
                                    } else {
                                        $price_collaborator = round($price + ($price * siteValue('price_collaborator')) / 100, 1);
                                    }
                                }

                                $price_agency1 = round($price + ($price * siteValue('price_agency')) / 100, 2);

                                if ($price_agency1 <= 0) {
                                    $price_agency = round($price + ($price * siteValue('price_agency')) / 100, 6);
                                } else {
                                    $price_agency2 = round($price + ($price * siteValue('price_agency')) / 100, 1);
                                    if ($price_agency2 <= 0) {
                                        $price_agency = round($price + ($price * siteValue('price_agency')) / 100, 3);
                                    } else {
                                        $price_agency = round($price + ($price * siteValue('price_agency')) / 100, 1);
                                    }
                                }
                                $price_distributor1 = round($price + ($price * siteValue('price_distributor')) / 100, 2);
                                if ($price_distributor1 <= 0) {
                                    $price_distributor = round($price + ($price * siteValue('price_distributor')) / 100, 6);
                                } else {
                                    $price_distributor2 = round($price + ($price * siteValue('price_distributor')) / 100, 1);
                                    if ($price_distributor2 <= 0) {
                                        $price_distributor = round($price + ($price * siteValue('price_distributor')) / 100, 3);
                                    } else {
                                        $price_distributor = round($price + ($price * siteValue('price_distributor')) / 100, 1);
                                    }
                                }

                                if ($server->price_update < $price) {
                                    $ma = "Tăng giá";
                                    $server->price_member = $price_member;
                                    $server->price_collaborator = $price_collaborator;
                                    $server->price_agency = $price_agency;
                                    $server->price_distributor = $price_distributor;
                                } elseif ($server->price_update > $price) {
                                    $ma = "Giảm giá";
                                }

                                $server->price_update = $price;
                                $server->price = $price;
                                $server->save();
                            }
                        }
                    }
                }
            }
        }
        return response()->json([
            'code' => 200,
            'message' => 'Cập nhật giá thành công.',
            'status' => 'SUCCESS',
        ]);
    }

    public function updatePriceService(Request $request)
    {
        if (getDomain() !== env('APP_MAIN_SITE')) {
            $servers = ServiceServer::where('domain', request()->getHost())->get();
            foreach ($servers as $server) {
                $percentMember = site('price') ?? 20;
                $percentCollaborator = site('price_collaborator') ?? 18;
                $percentAgency = site('price_agency') ?? 17;
                $percentDistributor = site('price_distributor') ?? 15;

                $priceMember = round($server->price + ($server->price * $percentMember) / 100, 3);
                $priceCollaborator = round($server->price + ($server->price * $percentCollaborator) / 100, 3);
                $priceAgency = round($server->price + ($server->price * $percentAgency) / 100, 3);
                $priceDistributor = round($server->price + ($server->price * $percentDistributor) / 100, 3);
                $server->update([
                    'price_member' => $priceMember,
                    'price_collaborator' => $priceCollaborator,
                    'price_agency' => $priceAgency,
                    'price_distributor' => $priceDistributor,
                ]);
            }
        } else {
        }
    }
}
