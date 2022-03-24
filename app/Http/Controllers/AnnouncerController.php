<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Validator, Redirect, Response, File;

class AnnouncerController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('announcer.index');
    }


    public function create()
    {
        return view('announcer.create');
    }

    public function storeImage(Request $request)
    {

        $_id = $request->input('_id');

        $image = "";
        $audio = "";

        if ($file = $request->file('file')) {
            //Almacenar imagen en carpeta nombrada con el id del evento y concatenando la fecha y el indice al final del nombre
            $path = 'announcer/img/' . $_id . '/';
            $name = time() . '_.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $name);
            $image =  "storage/" . $path . $name;
        }

        if ($file = $request->file('audioLocutor')) {
            //Almacenar imagen en carpeta nombrada con el id del evento y concatenando la fecha y el indice al final del nombre
            $path = 'announcer/audio/' . $_id . '/';
            $name = time() . '_.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $name);
            $audio =  "storage/" . $path . $name;
        }


        $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/announcer/" . $_id;

        $client = new Client();

        $r = $client->request('PUT', $url, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'url_image' => $image,
                'url_audio' => $audio,
            ]

        ]);

        $response_code = $r->getStatusCode();
        $response = json_decode((string) $r->getBody(), true);

        return redirect('announcer')->with('success', 'Locutor creado satisfactoriamente');
    }
}
