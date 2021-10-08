<?php

namespace App\Http\Controllers;

use App\Models\Secret;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Spatie\ArrayToXml\ArrayToXml;

class SecretController extends Controller
{
    public function GetSecretByHash(Request $request, $hash)
    {
        $acceptHeader = $request->header("accept");
        $secret = Secret::where('hash', $hash)->first();
        $expiration = date('Y-m-d H:i:s',strtotime('+'. $secret->expiresAt .' minutes', strtotime($secret->createdAt)));

        if ($secret == null || $secret->remainingViews <= 0) {
            return response()->json([
                'message' => 'No more views.'
            ]);
        }
        if(Carbon::now(new DateTimeZone("Europe/Budapest")) > Carbon::create($expiration)) {
            return response()->json([
                'message' => 'Secret expired'
            ]);
        }
        else
        {
            $secret->remainingViews--;
            $secret->save();

            switch($acceptHeader) {
                case "application/json":
                    return response()->json($secret);
                    break;
                case "application/xml":
                    return ArrayToXml::convert($secret->toArray());
                    break;
                default:
                    return response()->json($secret);
                    break;
            }
        }
        return response()->json(['message' => 'miért jut el ide?']);
    }

    public function AddSecret(Request $request)
    {
        $secret = new Secret;
        $secret->hash = md5($request->secret);
        $secret->secretText = $request->secret;
        $secret->createdAt = date("Y-m-d H:i:s");
        $secret->expiresAt = $request->expiresAt;
        $secret->remainingViews = $request->expireAfterViews;
        $secret->save();

        return response()->json($secret);
    }
}
