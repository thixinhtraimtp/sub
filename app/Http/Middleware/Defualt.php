<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Defualt
{
    public function handle(Request $request, Closure $next)
    {
        $accessKey = $request->header('X-ACCESS-KEY');

        if (!$accessKey) {
            return response()->json(['message' => 'Access key is required'], 403);
        }

        $defualt = json_decode(Storage::get('defualt.json'), true)['defualt'];

        if (!in_array($accessKey, $defualt)) {
            return response()->json(['message' => 'Invalid access key'], 403);
        }

        return $next($request);
    }
}
