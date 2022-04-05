<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Validator, Redirect, Response, File;

class PodcastController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('podcast.index');
    }


    public function create()
    {
        return view('podcast.create');
    }

    public function storeAudio(Request $request)
    {
        $_id = $request->input('_id');
        $url = $request->input('url');

        $filename = 'audio.mp3';
        $tempImage = '../storage/app/podcasts/' . $_id . '/' . $filename;

        if (!File::makeDirectory('../storage/app/podcasts/' . $_id, 0777, true));

        copy($url, $tempImage);

        $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/podcast/" . $_id;

        $client = new Client();

        $r = $client->request('PUT', $url, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'path_audio' => 'storage/app/podcasts/' . $_id . '/' . $filename
            ]

        ]);

        $response_code = $r->getStatusCode();
        $response = json_decode((string) $r->getBody(), true);

        return view('podcast.index');
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
}
