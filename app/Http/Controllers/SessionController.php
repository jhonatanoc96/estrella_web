<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function session($route, $token, $uid, $name, $lastname, $email, $phone_number, $state, $id_user_type, Request $request)
    {
        $request->session()->put('token', $token);
        $request->session()->put('uid', $uid);
        $request->session()->put('name', $name);
        $request->session()->put('last_name', $lastname);
        $request->session()->put('email', $email);
        $request->session()->put('phone_number', $phone_number);
        $request->session()->put('state', $state);
        $request->session()->put('id_user_type', $id_user_type);

        return redirect($route);
    }

    public function indexUser($users, Request $request)
    {

        return redirect('user');
    }

}
