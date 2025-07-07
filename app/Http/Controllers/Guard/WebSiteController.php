<?php

namespace App\Http\Controllers\Guard;

use App\Http\Controllers\Controller;
use App\Library\CloudflareController;
use App\Models\PartnerWebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebSiteController extends Controller
{
    public function viewCreateWebsite()
    {

        $website = PartnerWebsite::where('user_id', Auth::user()->id)->where('domain', request()->getHost())->first();

        if (!$website) {
            $website = new \stdClass();
            $website->id = null;
            $website->user_id = Auth::user()->id;
            $website->name = null;
            $website->name_sever1 = env('NAME_SERVER1');
            $website->name_sever2 = env('NAME_SERVER2');
            $website->domain = request()->getHost();
        }
        else{
            if($website->name_sever1 == '' && $website->name_sever2 == ''){
                $website->name_sever1 = env('NAME_SERVER1');
                $website->name_sever2 = env('NAME_SERVER2');  
            }
            
        }

        return view('guard.website.create', compact('website'));
    }

    public function createWebsite(Request $request)
    {
        $request->validate([
            'domain' => 'required',
        ]);

        $website = PartnerWebsite::where('name', $request->domain)->where('user_id', '!=', Auth::user()->id)->first();

        if ($website) {
            return redirect()->back()->with('error', 'Tên miền đã tồn tại trong hệ thống!');
        } else {
            $website = PartnerWebsite::where('user_id', Auth::user()->id)->where('domain', request()->getHost())->first();

            if (!$website) {
                $website = new PartnerWebsite();
                $website->user_id = Auth::user()->id;
                $website->name = $request->domain;
                $website->url = 'https://' . $request->domain;
                $website->status = 'pending';
                $website->domain = request()->getHost(); 
              
                $cld = new CloudflareController();
                $add = $cld->addDomain($request->domain);
                // dd($add);
                if ($add['status'] == true) {
                    if(isset($add['data'])){
                        $zone_id = $add['data']['zone_id'];
                        $zone_status = $add['data']['zone_status'];
                        $name_sever1 = $add['data']['name_sever1'];
                        
                        $name_sever2 = $add['data']['name_sever2'];
                         
                        $zone_name = $add['data']['zone_name'];
                        $website->zone_data = json_encode($add['data']);
                        $website->zone_name = $zone_name;
                        
                        $website->name_sever1 = $name_sever1;
                         
                        $website->name_sever2 = $name_sever2;
                        $website->zone_id = $zone_id;
                        $website->zone_status = $zone_status;
                        $website->save();
                    }
                    else{
                        return redirect()->back()->with('error', 'Vui lòng thử lại sau hoặc liên hệ admin');
                    }
                    
                } else {
                    return redirect()->back()->with('error', $add['message']);
                }
            }

            if ($website->name != $request->domain) {
                $cld = new CloudflareController();
                $add = $cld->addDomain($request->domain);
                if ($add['status'] === 'success') {
                    $cld->deleteDomain($website->zone_id);
                    $zone_id = $add['data']['zone_id'];
                    $zone_status = $add['data']['zone_status'];
                    $zone_name = $add['data']['zone_name'];
                    $name_sever1 = $add['data']['name_sever1'];
                        
                    $name_sever2 = $add['data']['name_sever2'];
                    $website->name = $request->domain;
                    $website->url = 'https://' . $request->domain;
                    $website->zone_data = json_encode($add['data']);
                    $website->zone_name = $zone_name;
                    $website->zone_id = $zone_id;
                    
                    $website->name_sever1 = $name_sever1;
                         
                    $website->name_sever2 = $name_sever2;
                    $website->zone_status = $zone_status;
                    $website->name = $request->domain;
                    $website->status = 'pending';
                    $website->save();

                    // remove old domain

                } else {
                    return redirect()->back()->with('error', $add['message']);
                }
            }

            return redirect()->back()->with('success', 'Thay đổi dữ liệu thành công!');
        }



        return redirect()->route('new');
    }
}
