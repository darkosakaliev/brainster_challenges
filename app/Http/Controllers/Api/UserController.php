<?php

namespace App\Http\Controllers\Api;

use App\Events\RegisteredUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return response()->json($users);
    }

    public function store(Request $request) {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'activation_token' => Str::random(20),
        ]);

        if($user) {
            event(new RegisteredUser($user));
            return response()->json($user);
        }
    }

    public function activate($id) {
        $user = User::find($id);

        $user->update([
            'is_active' => 1,
        ]);
    }

    public function deactivate($id) {
        $user = User::find($id);

        $user->update([
            'is_active' => 0,
        ]);
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
    }
}
