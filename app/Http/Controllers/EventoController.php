<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Validator, Redirect, Response, File;

class EventoController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('eventos.index');
    }

    public function edit($id, Request $request)
    {
        $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/event/" . $id;

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

        return view('eventos.edit')->with('response', $response['Message ']);
    }

    public function images(Request $request)
    {
        dd($request);
        // dd($request->input('files[]'));


        // return view('eventos.edit')->with('response', $response['record']);
    }

    public function storeImages(Request $request)
    {

        $array = [];
        $_id = $request->input('_id');
        $date = $request->input('date');
        // dd($request->input('_id'));
        // dd($request->input('date'));

        if ($files = $request->file('files')) {
            foreach ($files as $key => $file) {
                //Almacenar imagen en carpeta nombrada con el id del evento y concatenando la fecha y el indice al final del nombre
                // dd($file->getClientOriginalName());
                // dd($file->getClientOriginalExtension());
                $path = 'events/img/' . $_id . '/';
                $name = time() . $key . '_.' . $file->getClientOriginalExtension();
                $file->storeAs($path, $name);
                array_push($array, "storage/" . $path . $name);
            }

            // return Response()->json([
            //     "success" => true,
            //     "file" => $array
            // ]);
        }

        $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/event/" . $_id;

        $client = new Client();

        $r = $client->request('PUT', $url, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'images' => $array,
                'url_image' => $array[0]
            ]

        ]);


        $response_code = $r->getStatusCode();
        $response = json_decode((string) $r->getBody(), true);

        return redirect('eventos')->with('success', 'Evento creado satisfactoriamente');
    }

    public function storeMainPhoto(Request $request)
    {

        $creation_date = $request->input('creation_date');
        $daysString = $request->input('days');
        $description = $request->input('description');
        $end_time = $request->input('end_time');
        $imagesString = $request->input('images');
        $nameEvent = $request->input('name');
        $start_time = $request->input('start_time');
        $state = $request->input('state');
        $update_date = $request->input('update_date');
        $url_image = $request->input('url_image');
        $_id_event = $request->input('_id_event');

        $days = explode(",", $daysString);
        $images = explode(",", $imagesString);

        if ($file = $request->file('mainPhoto')) {

            $path = 'events/img/' . $_id_event . '/';
            $name = time() . '_.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $name);

            $items = array(
                "creation_date" => $creation_date,
                "days" => $days,
                "description" => $description,
                "end_time" => $end_time,
                "images" => $images,
                "name" => $nameEvent,
                "start_time" => $start_time,
                "state" => $state,
                "update_date" => $update_date,
                "url_image" => $url_image,
                "new_url_image" => "storage/" . $path . $name,
                "_id" => $_id_event,
            );
            json_encode($items);
            // dd($items);

            return view('eventos.edit')->with('response', $items);

            // return redirect('eventosEdit' . $_id_event)->with('mainPhoto', "storage/" . $path . $name);

            // return Response()->json([
            //     "success" => true,
            //     "file" => "array"
            // ]);
        } else {
            $items = array(
                "creation_date" => $creation_date,
                "days" => $days,
                "description" => $description,
                "end_time" => $end_time,
                "images" => $images,
                "name" => $nameEvent,
                "start_time" => $start_time,
                "state" => $state,
                "update_date" => $update_date,
                "url_image" => $url_image,
                "new_url_image" => "",
                "_id" => $_id_event,
            );
            json_encode($items);
            // dd($items);

            return view('eventos.edit')->with('response', $items);
        }
    }

    public function updateEvent(Request $request)
    {

        $creation_date = $request->input('creation_date');
        $daysString = $request->input('days');
        $description = $request->input('description');
        $end_time = $request->input('end_time');
        $imagesString = $request->input('images');
        $nameEvent = $request->input('name');
        $start_time = $request->input('start_time');
        $state = $request->input('state');
        $update_date = $request->input('update_date');
        $url_image = $request->input('url_image');
        $_id_event = $request->input('_id_event');

        $days = explode(",", $daysString);
        $images = explode(",", $imagesString);

        $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/event/" . $_id_event;

        $client = new Client();

        $r = $client->request('PUT', $url, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                "days" => $days,
                "description" => $description,
                "end_time" => $end_time,
                // "images" => $images,
                "name" => $nameEvent,
                "start_time" => $start_time,
                "url_image" => $url_image,
            ]

        ]);


        $response_code = $r->getStatusCode();
        $response = json_decode((string) $r->getBody(), true);

        return redirect('eventos')->with('success', 'Evento modificado satisfactoriamente');
    }

    public function createImage(Request $request)
    {
        $_id = $request->input('id_evento');
        $imagesString = $request->input('current_images');
        $images = explode(",", $imagesString);
        
        if ($file = $request->file('newPhoto')) {
            
            $path = 'events/img/' . $_id . '/';
            $name = time() . '_.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $name);
            array_push($images, "storage/" . $path . $name);

            $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/event/" . $_id;

            $client = new Client();

            $r = $client->request('PUT', $url, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    'images' => $images
                ]

            ]);


            $response_code = $r->getStatusCode();
            $response = json_decode((string) $r->getBody(), true);

            return redirect('eventos')->with('success', 'Evento modificado satisfactoriamente');
        }
    }


    public function create()
    {
        return view('eventos.create');
    }
}
