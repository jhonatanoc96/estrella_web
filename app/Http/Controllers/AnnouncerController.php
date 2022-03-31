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


    public function edit($id, Request $request)
    {
        $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/announcer/" . $id;

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
        $response['Message ']['new_url_audio'] = "";

        return view('announcer.edit')->with('response', $response['Message ']);
    }


    public function storeMainPhoto(Request $request)
    {

        $creation_date = $request->input('creation_date');
        $description = $request->input('description');
        $nameAnnouncer = $request->input('name');
        $lastname = $request->input('lastname');
        $state = $request->input('state');
        $update_date = $request->input('update_date');
        $url_image = $request->input('url_image');
        // $url_audio = $request->input('audio');
        $_id_announcer = $request->input('_id_announcer');

        if ($file = $request->file('mainPhotoAnnouncer')) {
            // dd($file);

            $path = 'announcer/img/' . $_id_announcer . '/';
            $name = time() . '_.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $name);

            $items = array(
                "creation_date" => $creation_date,
                "description" => $description,
                "name" => $nameAnnouncer,
                "last_name" => $lastname,
                "state" => $state,
                "update_date" => $update_date,
                "url_image" => $url_image,
                // "url_audio" => $url_audio,
                "new_url_image" => "storage/" . $path . $name,
                // "new_url_audio" => "storage/" . $path . $name,
                "_id" => $_id_announcer,
            );
            json_encode($items);

            return view('announcer.edit')->with('response', $items);
        } else {
            $items = array(
                "creation_date" => $creation_date,
                "description" => $description,
                "name" => $nameAnnouncer,
                "last_name" => $lastname,
                "state" => $state,
                "update_date" => $update_date,
                "url_image" => $url_image,
                // "url_audio" => $url_audio,
                "new_url_image" => "",
                // "new_url_audio" => "storage/" . $path . $name,
                "_id" => $_id_announcer,
            );
            json_encode($items);
            // dd($items);

            return view('announcer.edit')->with('response', $items);
        }
    }

    public function storeAudio(Request $request)
    {

        $_id_announcer = $request->input('_id_announcer');


        if ($file = $request->file('audioAnnouncer')) {

            $path = 'announcer/audio/' . $_id_announcer . '/';
            $name = time() . '_.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $name);

            $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/announcer/" . $_id_announcer;

            $client = new Client();

            $r = $client->request('PUT', $url, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    "url_audio" => "storage/" . $path . $name,
                ]

            ]);


            $response_code = $r->getStatusCode();
            $response = json_decode((string) $r->getBody(), true);

            return redirect('announcer')->with('success', 'Locutor modificado satisfactoriamente');
        }
    }


    public function update(Request $request)
    {

        $description = $request->input('description');
        $name = $request->input('name');
        $lastname = $request->input('lastname');
        $state = $request->input('state');
        $url_image = $request->input('url_image');
        $url_audio = $request->input('url_audio');
        $_id_announcer = $request->input('_id_announcer');

        $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/announcer/" . $_id_announcer;

        $client = new Client();

        $r = $client->request('PUT', $url, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                "description" => $description,
                "name" => $name,
                "last_name" => $lastname,
                "url_image" => $url_image,
                "url_audio" => $url_audio,
            ]

        ]);


        $response_code = $r->getStatusCode();
        $response = json_decode((string) $r->getBody(), true);

        return redirect('announcer')->with('success', 'Locutor modificado satisfactoriamente');
    }
}
