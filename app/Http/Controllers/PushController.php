<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\CreateServiceCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PushController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Request $request){
        $this->validate($request,[
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        $user = auth()->user();
        $user->updatePushSubscription($endpoint, $key, $token);
        return response()->json(['success' => true],200);
    }
}
