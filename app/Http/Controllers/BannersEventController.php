<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Validator, Redirect, Response, File;

class BannersEventController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('bannersevent.index');
    }

    public function createImage(Request $request)
    {
        if ($file = $request->file('newPhoto')) {
            
            $path = 'bannersevent/img/';
            $name = time() . '_.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $name);
            
            $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/create-bannerevent/";
            
            $client = new Client();
            
            $r = $client->request('POST', $url, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    'url_image' => "storage/" . $path . $name,
                    'state' => true
                    ]
                    
                ]);

                
            $response_code = $r->getStatusCode();
            $response = json_decode((string) $r->getBody(), true);
            
            return redirect('bannersEvent')->with('success', 'Imagen creada satisfactoriamente');
        }
    }

}
