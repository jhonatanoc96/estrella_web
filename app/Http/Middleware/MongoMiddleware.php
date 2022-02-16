<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class MongoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // dd($request);
        // Recibir variable de sesión
        $token = $request->session()->get('token');
        $uid = $request->session()->get('uid');
        $name = $request->session()->get('name');
        $last_name = $request->session()->get('last_name');
        $email = $request->session()->get('email');
        $phone_number = $request->session()->get('phone_number');
        $state = $request->session()->get('state');
        $id_user_type = $request->session()->get('id_user_type');

        if ($token == null) {
            return redirect('/login')->with('error', "La sesión ha expirado, por favor inicie sesión nuevamente.");
        }
        
        // Declarar variable de sesión que durará otro request
        $request->session()->put('token', $token);
        $request->session()->put('uid', $uid);
        $request->session()->put('name', $name);
        $request->session()->put('last_name', $last_name);
        $request->session()->put('email', $email);
        $request->session()->put('phone_number', $phone_number);
        $request->session()->put('state', $state);
        $request->session()->put('id_user_type', $id_user_type);

        return $next($request);
    }
}
