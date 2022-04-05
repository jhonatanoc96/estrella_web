<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Validator, Redirect, Response, File;
use App\Exports\ContestExport;
use Maatwebsite\Excel\Facades\Excel;


class ContestController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('contest.index');
    }

    public function edit($id, Request $request)
    {
        $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/contest/" . $id;

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

        return view('contest.edit')->with('response', $response['Message ']);
    }

    public function images(Request $request)
    {
        dd($request);
        // dd($request->input('files[]'));


        // return view('contest.edit')->with('response', $response['record']);
    }

    public function storeImagesContest(Request $request)
    {

        $array = [];
        $_id = $request->input('_id');
        // dd($request->input('date'));

        if ($files = $request->file('filesContest')) {
            foreach ($files as $key => $file) {
                //Almacenar imagen en carpeta nombrada con el id del contest y concatenando la fecha y el indice al final del nombre
                // dd($file->getClientOriginalName());
                // dd($file->getClientOriginalExtension());
                $path = 'contest/img/' . $_id . '/';
                $name = time() . $key . '_.' . $file->getClientOriginalExtension();
                $file->storeAs($path, $name);
                array_push($array, "storage/" . $path . $name);
            }
        }

        $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/contest/" . $_id;

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

        return redirect('contest')->with('success', 'Concurso creado satisfactoriamente');
    }

    public function storeMainPhoto(Request $request)
    {

        $creation_date = $request->input('creation_date');
        $daysString = $request->input('days');
        $description = $request->input('description');
        $end_time = $request->input('end_time');
        $imagesString = $request->input('images');
        $namecontest = $request->input('name');
        $start_time = $request->input('start_time');
        $state = $request->input('state');
        $update_date = $request->input('update_date');
        $url_image = $request->input('url_image');
        $_id_contest = $request->input('_id_contest');

        $days = explode(",", $daysString);
        $images = explode(",", $imagesString);

        if ($file = $request->file('mainPhoto')) {

            $path = 'contest/img/' . $_id_contest . '/';
            $name = time() . '_.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $name);

            $items = array(
                "creation_date" => $creation_date,
                "days" => $days,
                "description" => $description,
                "end_time" => $end_time,
                "images" => $images,
                "name" => $namecontest,
                "start_time" => $start_time,
                "state" => $state,
                "update_date" => $update_date,
                "url_image" => $url_image,
                "new_url_image" => "storage/" . $path . $name,
                "_id" => $_id_contest,
            );
            json_encode($items);
            // dd($items);

            return view('contest.edit')->with('response', $items);

            // return redirect('contestEdit' . $_id_contest)->with('mainPhoto', "storage/" . $path . $name);

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
                "name" => $namecontest,
                "start_time" => $start_time,
                "state" => $state,
                "update_date" => $update_date,
                "url_image" => $url_image,
                "new_url_image" => "",
                "_id" => $_id_contest,
            );
            json_encode($items);
            // dd($items);

            return view('contest.edit')->with('response', $items);
        }
    }

    public function updateContest(Request $request)
    {

        $creation_date = $request->input('creation_date');
        $daysString = $request->input('days');
        $description = $request->input('description');
        $end_time = $request->input('end_time');
        $imagesString = $request->input('images');
        $namecontest = $request->input('name');
        $start_time = $request->input('start_time');
        $state = $request->input('state');
        $update_date = $request->input('update_date');
        $url_image = $request->input('url_image');
        $_id_contest = $request->input('_id_contest');

        $days = explode(",", $daysString);
        $images = explode(",", $imagesString);

        $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/contest/" . $_id_contest;

        $client = new Client();

        $r = $client->request('PUT', $url, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                "days" => $days,
                "description" => $description,
                "end_time" => $end_time,
                // "images" => $images,
                "name" => $namecontest,
                "start_time" => $start_time,
                "url_image" => $url_image,
            ]

        ]);


        $response_code = $r->getStatusCode();
        $response = json_decode((string) $r->getBody(), true);

        return redirect('contest')->with('success', 'Concurso modificado satisfactoriamente');
    }

    public function createImage(Request $request)
    {

        $_id = $request->input('id_contest');
        $imagesString = $request->input('current_images_contest');
        $images = explode(",", $imagesString);

        if ($file = $request->file('newPhotoContest')) {

            $path = 'contest/img/' . $_id . '/';
            $name = time() . '_.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $name);
            array_push($images, "storage/" . $path . $name);

            $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/contest/" . $_id;

            $client = new Client();

            $r = $client->request('PUT', $url, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    'images' => $images
                ]

            ]);


            $response_code = $r->getStatusCode();
            $response = json_decode((string) $r->getBody(), true);

            return redirect('contest')->with('success', 'Concurso modificado satisfactoriamente');
        }
    }


    public function create()
    {
        return view('contest.create');
    }


    public function storeImageIndex(Request $request)
    {

        $_id_contest = $request->input('_id_contest');


        if ($file = $request->file('imgContest')) {

            $path = 'contest/img/' . $_id_contest . '/';
            $name = time() . '_.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $name);

            $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/contest/" . $_id_contest;

            $client = new Client();

            $r = $client->request('PUT', $url, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => [
                    "url_image" => "storage/" . $path . $name,
                ]

            ]);


            $response_code = $r->getStatusCode();
            $response = json_decode((string) $r->getBody(), true);

            return redirect('contest')->with('success', 'Concurso modificado satisfactoriamente');
        }
    }


    public function export($id)
    {
        $url = "http://ec2-3-145-159-204.us-east-2.compute.amazonaws.com:3010/api/contest/" . $id;

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

        $export = new ContestExport($response['Message ']["competitor"]);

        return Excel::download($export, 'participantes.xlsx');
    }
}
