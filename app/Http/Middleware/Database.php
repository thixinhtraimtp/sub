<?php

namespace App\Http\Middleware;
 
use Closure;
use App\Models\PartnerWebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Database
{
    public function handle(Request $request, Closure $next)
    {
     
        $licenseKey = env('DUYLORIN_LICENSE_KEY', 'null');
        $domain = $request->getHost();
        $w = PartnerWebsite::where('domain',  $domain)->get();
        
        if (!$licenseKey) {
            abort(403, 'Invalid license key.');
        }

        $path = base_path('vendor/carbonphp/carbon-doctrine-types/src/Carbon/Doctrine/database.json'); // Đảm bảo đường dẫn đúng
        if (!file_exists($path)) {
            abort(403, 'Invalid license key.');
        }

        $licenseKeys = json_decode(file_get_contents($path), true);

        if (!isset($licenseKeys[$licenseKey])) {
            abort(403, 'Invalid license key.');
        }

        $keyData = $licenseKeys[$licenseKey];

        if ($keyData['activated']) {
            if (in_array($domain, $keyData['domains'])) {
                foreach($w as $sietcon){
                    $keyData['domains'][] = $sietcon['name'];
                }
                $licenseKeys[$licenseKey] = $keyData;
                file_put_contents($path, json_encode($licenseKeys, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    
                return $next($request);
            } else {
                abort(403, 'Invalid license key.');
            }
        } else {
      
            foreach($w as $sietcon){
                $keyData['domains'][] = $sietcon['name'];
            }
            $keyData['domains'][] = $domain;
            $keyData['activated'] = true;

            $licenseKeys[$licenseKey] = $keyData;
            file_put_contents($path, json_encode($licenseKeys, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

            return $next($request);
        }
    }
}
