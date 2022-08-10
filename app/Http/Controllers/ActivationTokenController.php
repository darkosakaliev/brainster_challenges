<?php

namespace App\Http\Controllers;

use App\Events\ActivateUser;
use App\Events\RegisteredUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ActivationTokenController extends Controller
{
    public function activate($email, $token) {
        $user = User::where('email', $email)->where('activation_token', $token)->first();

        if($user) {
            if(Carbon::now()->between($user->created_at, $user->created_at->addDay())) {
                event(new ActivateUser($user));
                return redirect()->route('token-activated');
            } else {
                return view('token-expired')->with(['user' => $user]);
            }
        } else {
            abort(401);
        }
    }

    public function resendToken($email, $token) {
        $user = User::where('email', $email)->where('activation_token', $token)->first();

        if($user) {
            $user->update([
                'activation_token' => Str::random(20),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            event(new RegisteredUser($user));
            return view('token-resend');
        }
    }
}
