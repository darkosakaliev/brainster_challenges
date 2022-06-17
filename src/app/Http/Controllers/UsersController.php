<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function store(CreateUserFormRequest $request)
    {
        Session::put('user', $request->all());

        return view('info', ['user' => Session::get('user')])->with('message', 'Succesfully logged in!');
    }

    public function destroy()
    {
        Session::flush();
        return view('index');
    }
}
