<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function userAuth(LoginFormRequest $request) {
        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Session::put('user', $request->all());
                return redirect()->route('home')->with(['message' => 'Успешно се најавивте!', 'status' => 'success']);
            } else {
                return redirect()->route('login')->with(['message' => 'Погрешни креденцијали!', 'status' => 'danger']);
            }
        } else {
            return view('login')->with(['message' => 'Е-мелјот не е регистриран!', 'status' => 'danger']);
        }
    }

    public function logout() {
        if (Session::has('user')) {
            Session::pull('user');
            return redirect('login');
        }
    }
}
