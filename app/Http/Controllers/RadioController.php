<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Validator, Redirect, Response, File;

class RadioController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('radio.index');
    }


    public function create()
    {
        return view('radio.create');
    }

    public function storeImage(Request $request)
    {

        $_id = $request->input('_id');
        $image = "";

        if ($file = $request->file('file')) {
            //Almacenar imagen en carpeta nombrada con el id del evento y concatenando la fecha y el indice al final del nombre
            $path = 'radio/img/' . $_id . '/';
            $name = time() . '_.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $name);
            $image =  "storage/" . $path . $name;
        }


        $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/radio/" . $_id;

        $client = new Client();

        $r = $client->request('PUT', $url, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'url_image' => $image
            ]

        ]);


        $response_code = $r->getStatusCode();
        $response = json_decode((string) $r->getBody(), true);

        return redirect('radio')->with('success', 'Emisora creada satisfactoriamente');
    }


    public function edit($id, Request $request)
    {
        $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/radio/" . $id;

        $client = new Client();

        $r = $client->request('GET', $url, [
            'headers' => ['Content-Type' => 'application/json']
            // 'json' => [
            //     'email' => $request['email'],
            //     'password' => $request['password']
            // ]

        ]);


        $response_code = $r->getStatusCode();
        $response = json_decode((string) $r->getBody(), true);

        $response['Message ']['new_url_image'] = "";

        // dd($response["Message "]);

        return view('radio.edit')->with('response', $response['Message ']);
    }

    public function storeImageIndex(Request $request)
    {

        $_id_radio = $request->input('_id_radio');


        if ($file = $request->file('imgRadio')) {

            $path = 'radio/img/' . $_id_radio . '/';
            $name = time() . '_.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $name);

            $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/radio/" . $_id_radio;

            $client = new Client();

            $r = $client->request('PUT', $url, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    "url_image" => "storage/" . $path . $name,
                ]

            ]);


            $response_code = $r->getStatusCode();
            $response = json_decode((string) $r->getBody(), true);

            return redirect('radio')->with('success', 'Emisora modificada satisfactoriamente');
        }
    }
}
