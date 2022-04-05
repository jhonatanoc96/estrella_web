<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use GuzzleHttp\Client;


class ListenerExport implements FromArray

{
    protected $listeners;

    public function __construct(array $listeners)
    {
        $this->listeners = $listeners;
    }

    public function array(): array
    {
        return $this->listeners;
    }

    public function collection()
    {



        // $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:8080/api/empresa/";

        // $client = new Client();

        // $r = $client->request('GET', $url, [
        //     'headers' => ['Content-Type' => 'application/json']
        //     // 'json' => [
        //     //     'email' => $request['email'],
        //     //     'password' => $request['password']
        //     // ]

        // ]);


        // $response_code = $r->getStatusCode();
        // $response = json_decode((string) $r->getBody(), true);

        // return $response['records'];
    }
}
