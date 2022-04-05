<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Validator, Redirect, Response, File;
use App\Exports\ListenerExport;
use Maatwebsite\Excel\Facades\Excel;

class ListenerController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('listener.index');
    }


    public function export()
    {

        $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/listener/";

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


        $export = new ListenerExport($response['Message ']);

        return Excel::download($export, 'club_de_oyentes.xlsx');
    }
}
